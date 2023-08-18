<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre','ap_paterno','ap_materno','ci','tipo','oficina','estado','registrado_por',
        'fecha_baja','baja_por','alfanum','full_name','departamento_id','funcionario_id','user_id',
        'people_id', 'first_name', 'last_name'
    ];
}
