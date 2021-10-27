<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    
    //protected $withCount = ['derivaciones'];

    protected $casts = [
        'details' => 'array',
        'deadline' => 'date'
    ];

    protected $fillable = [
        'gestion', 'tipo', 'remitente', 'cite', 'referencia', 'nro_hojas', 'funcionario_id_remitente','deadline', 
        'unidad_id_remitente', 'direccion_id_remitente', 'funcionario_id_destino', 'funcionario_id_responsable', 
        'registrado_por', 'registrado_por_id_direccion', 'registrado_por_id_unidad', 'actualizado_por', 
        'fecha_actualizacion', 'observacion_rechazo', 'detalles', 'entity_id', 'estado_id', 'tipo_id','details',
        'urgent','category_id'
    ];

    function entity(){
        return $this->belongsTo(Entity::class)->withTrashed();
    }

    function estado(){
        return $this->belongsTo(Estado::class, 'estado_id')->withTrashed();
    }

    function archivos(){
        return $this->hasMany(Archivo::class)->withTrashed();
    }

    function derivaciones(){
        return $this->hasMany(Derivation::class)->withTrashed();
    }

    public function destinatario(){
        return $this->belongsTo(Persona::class,'funcionario_id_destino','funcionario_id');
    }

    function vias(){
        return $this->hasMany(Via::class)->withTrashed();
    }
}
