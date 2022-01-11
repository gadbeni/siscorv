<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Derivation extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $appends = ['img'];
  
    public function getImgAttribute()
    {
        return config('voyager.user.default_avatar');
        //return 'storage/users/default.png';
    }
    
    protected $fillable = [
        'funcionario_id_de', 'funcionario_id_para', 'funcionario_nombre_para', 'funcionario_cargo_id_para', 
        'funcionario_cargo_para', 'funcionario_direccion_id_para', 'funcionario_direccion_para', 
        'funcionario_unidad_id_para', 'funcionario_unidad_para', 'responsable_actual', 'logico', 'fisico', 
        'fecha_fisico', 'observacion', 'estado', 'registro_por', 'actualizado_por', 'entrada_id', 'visto', 
        'rechazo','parent_id','parent_type'
    ];

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
}
