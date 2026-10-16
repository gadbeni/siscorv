<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class Derivation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $appends = ['img'];
  
    public function getImgAttribute()
    {
        return config('voyager.user.default_avatar');
    }
    
    protected $fillable = [
        'funcionario_id_de', 'funcionario_id_para', 'funcionario_nombre_para', 
        'funcionario_cargo_para', 'funcionario_direccion_id_para', 'funcionario_direccion_para', 
        'funcionario_unidad_id_para', 'funcionario_unidad_para', 'responsable_actual', 'logico', 'fisico', 
        'fecha_fisico', 'observacion', 'estado', 'registro_por', 'actualizado_por', 'entrada_id', 'visto', 
        'rechazo','parent_id','parent_type', 'via',
        'people_id_de', 'people_id_para',
        'derivation', 'ok', 'observationArchivado', 'transferred', 'transferredUser_id', 'transferredDetails', 'transferredPeople_id', 'transferredDate',
        'user_id'
    ];



    /**
     * Resumen de la bandeja de un funcionario.
     *
     * Los contadores replican EXACTAMENTE lo que lista cada pestana de la
     * bandeja en BandejaController::list(), para que el tablero y
     * el aviso de inicio de sesion no puedan mostrar una cifra distinta a la
     * que el funcionario encuentra al abrir su bandeja:
     *
     *   pendientes -> pestana "Pendientes" (ok = 'NO', entrada NO urgente, no via)
     *   urgentes   -> pestana "Urgentes"   (ok = 'NO', entrada urgente, no via)
     *   derivados  -> pestana "Derivados"  (ok = 'SI', no via)
     *   vias       -> pestana "Vias", solo las que esperan accion (ok = 'NO')
     *   vias_total -> pestana "Vias", todo lo que lista (ok = 'NO' o 'SI')
     *   archivados -> pestana "Archivados" (ok = 'ARCHIVADO', incluye vias)
     *   total      -> todas las derivaciones vigentes del universo comun
     *
     * Universo comun a todas menos "Archivados": derivaciones no transferidas,
     * sobre entradas que no son de personeria (esas viven en su propio modulo)
     * y cuyo estado no es 4 ni 6 (tramites cerrados). "Archivados" nunca filtro
     * por la entrada, por eso esas condiciones van dentro de cada CASE y no en
     * el WHERE.
     *
     * Ojo con tres detalles, todos fuente de errores anteriores:
     *  - "Pendientes" EXCLUYE los urgentes; son pestanas separadas y sumarlos
     *    en ambos lados los contaba dos veces.
     *  - Las vias (via = 1) tienen pestana propia y no cuentan como pendientes
     *    ni urgentes: el funcionario via solo toma conocimiento y archiva, no
     *    puede derivar ni rechazar (ver bandeja/read).
     *  - NO se filtra por 'visto'. Un tramite abierto pero todavia sin derivar
     *    sigue estando en la bandeja, asi que debe seguir contando.
     *
     * @param  int|null  $funcionarioId  people_id del funcionario.
     * @return object  {total, pendientes, urgentes, derivados, vias, vias_total, archivados}
     */
    public static function resumenPara($funcionarioId)
    {
        $vacio = (object) [
            'total' => 0, 'pendientes' => 0, 'urgentes' => 0, 'derivados' => 0,
            'vias' => 0, 'vias_total' => 0, 'archivados' => 0,
        ];

        if (is_null($funcionarioId)) {
            return $vacio;
        }

        $vigente = "entradas.personeria = 0 AND entradas.estado_id NOT IN (4, 6)";
        $esVia   = "derivations.via = 1";
        $noVia   = "COALESCE(derivations.via, 0) = 0";

        // El join no filtra entradas borradas a proposito: la relacion entrada()
        // usa withTrashed(), y la bandeja consulta a traves de ella.
        $resumen = static::join('entradas', 'derivations.entrada_id', '=', 'entradas.id')
            ->where('derivations.people_id_para', $funcionarioId)
            ->where('derivations.transferred', 0)
            ->whereNull('derivations.deleted_at')
            ->selectRaw("
                    COUNT(CASE WHEN $vigente THEN 1 END) as total,
                    COUNT(CASE WHEN $vigente AND $noVia AND derivations.ok = 'NO' AND entradas.urgent = 0 THEN 1 END) as pendientes,
                    COUNT(CASE WHEN $vigente AND $noVia AND derivations.ok = 'NO' AND entradas.urgent = 1 THEN 1 END) as urgentes,
                    COUNT(CASE WHEN $vigente AND $noVia AND derivations.ok = 'SI' THEN 1 END) as derivados,
                    COUNT(CASE WHEN $vigente AND $esVia AND derivations.ok = 'NO' THEN 1 END) as vias,
                    COUNT(CASE WHEN $vigente AND $esVia AND derivations.ok IN ('NO', 'SI') THEN 1 END) as vias_total,
                    COUNT(CASE WHEN derivations.ok = 'ARCHIVADO' THEN 1 END) as archivados
            ")
            ->first();

        return $resumen ?: $vacio;
    }

    /**
     * Derivaciones en las que el funcionario NO figura como via.
     * via admite NULL en filas antiguas; NULL cuenta como derivacion normal.
     */
    public function scopeSinVias($query)
    {
        return $query->where(function ($q) {
            $q->where('via', 0)->orWhereNull('via');
        });
    }

    public function scopeSoloVias($query)
    {
        return $query->where('via', 1);
    }

    function entrada(){
        return $this->belongsTo(Entrada::class, 'entrada_id')->withTrashed();
    }

    function derivationparent(){
        return $this->belongsTo(Entrada::class, 'parent_id');
    }

    public function parent()
    {
        return $this->morphTo();
    }

    public function parents()
    {
        return $this->morphMany(Derivation::class, 'parent');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
