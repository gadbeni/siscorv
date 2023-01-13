<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enlace extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'fechaNota',
        'cite',
        'entidad',
        'institucion',
        'destinatario',
        'referencia',
        'fechaEntidad',
        'status',
        'registerUser_id',
        'deleted_at',
        'deleteUser_id'
    ];
}

