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
        'gestion', 'tipo', 'hr', 'remitente', 'cite', 'referencia', 'nro_hojas', 'funcionario_id_remitente', 'funcionario_id_responsable', 'estado', 'registrado_por', 'registrado_por_id_direccion', 'registrado_por_id_unidad', 'actualizado_por', 'entity_id', 'estado_id', 'tipo_id'
    ];
}
