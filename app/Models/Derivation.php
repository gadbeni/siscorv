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
        'funcionario_id_de', 'funcionario_id_para', 'funcionario_nombre_para', 'funcionario_cargo_id_para', 
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
     * bandeja en EntradasController::derivacion_list(), para que el tablero y
     * el aviso de inicio de sesion no puedan mostrar una cifra distinta a la
     * que el funcionario encuentra al abrir su bandeja:
     *
     *   pendientes -> pestana "Pendientes" (ok = 'NO' y entrada NO urgente)
     *   urgentes   -> pestana "Urgentes"   (ok = 'NO' y entrada urgente)
     *   total      -> todas las derivaciones vigentes del mismo universo
     *
     * Universo comun a las tres: derivaciones no transferidas, sobre entradas
     * que no son de personeria (esas viven en su propio modulo) y cuyo estado
     * no es 4 ni 6 (tramites cerrados).
     *
     * Ojo con dos detalles, ambos fuente de errores anteriores:
     *  - "Pendientes" EXCLUYE los urgentes; son pestanas separadas y sumarlos
     *    en ambos lados los contaba dos veces.
     *  - NO se filtra por 'visto'. Un tramite abierto pero todavia sin derivar
     *    sigue estando en la bandeja, asi que debe seguir contando.
     *
     * @param  int|null  $funcionarioId  people_id del funcionario.
     * @return object  {total, pendientes, urgentes}
     */
    public static function resumenPara($funcionarioId)
    {
        $vacio = (object) ['total' => 0, 'pendientes' => 0, 'urgentes' => 0];

        if (is_null($funcionarioId)) {
            return $vacio;
        }

        // El join no filtra entradas borradas a proposito: la relacion entrada()
        // usa withTrashed(), y la bandeja consulta a traves de ella.
        $resumen = static::join('entradas', 'derivations.entrada_id', '=', 'entradas.id')
            ->where('derivations.people_id_para', $funcionarioId)
            ->where('derivations.transferred', 0)
            ->whereNull('derivations.deleted_at')
            ->where('entradas.personeria', 0)
            ->whereNotIn('entradas.estado_id', [4, 6])
            ->selectRaw("
                    COUNT(*) as total,
                    COUNT(CASE WHEN derivations.ok = 'NO' AND entradas.urgent = 0 THEN 1 END) as pendientes,
                    COUNT(CASE WHEN derivations.ok = 'NO' AND entradas.urgent = 1 THEN 1 END) as urgentes
            ")
            ->first();

        return $resumen ?: $vacio;
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
