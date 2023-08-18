<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Entrada extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    
    //protected $withCount = ['derivaciones'];

    protected $casts = [
        'details' => 'array',
        'deadline' => 'date',
        'fecha_registro' => 'datetime'
    ];

    protected $fillable = [
        'gestion', 'tipo', 'remitente', 'cite', 'referencia', 'nro_hojas', 'funcionario_id_remitente','deadline', 
        'unidad_id_remitente', 'direccion_id_remitente', 'funcionario_id_destino', 'funcionario_id_responsable', 
        'registrado_por', 'registrado_por_id_direccion', 'registrado_por_id_unidad', 'actualizado_por', 
        'fecha_actualizacion','fecha_registro','observacion_rechazo', 'detalles', 'entity_id', 'estado_id', 'tipo_id','details',
        'urgent','category_id', 'created_at',
        'people_id_de', 'job_de', 'people_id_para', 'job_para', 'personeria', 'user_id'
    ];

    public function person(){
        return $this->belongsTo(Person::class, 'people_id_para', 'id');
    }
    
    // public function getFechaRegistrotAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d\TH:i');
    // }

    function entity(){
        return $this->belongsTo(Entity::class);
    }

    function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    function archivos(){
        return $this->hasMany(Archivo::class);
    }

    function derivaciones(){
        return $this->hasMany(Derivation::class);
    }

    public function archivodate()
    {
        return $this->hasMany(ArchivoDate::class, 'entrada_id');
    }

    public function destinatario(){
        // return $this->belongsTo(Persona::class,'funcionario_id_destino','funcionario_id');
        return $this->belongsTo(Persona::class,'people_id_para','people_id');
    }

    function vias(){
        return $this->hasMany(Via::class);
    }

    public function parents()
    {
        return $this->morphMany(Derivation::class, 'parent');
    }
}
