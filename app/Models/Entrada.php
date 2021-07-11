<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'gestion', 'tipo', 'remitente', 'cite', 'referencia', 'nro_hojas', 'funcionario_id_remitente', 'funcionario_id_responsable', 'registrado_por', 'registrado_por_id_direccion', 'registrado_por_id_unidad', 'actualizado_por', 'fecha_actualizacion', 'entity_id', 'estado_id', 'tipo_id'
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
}
