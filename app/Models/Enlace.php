<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class Enlace extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory, SoftDeletes;
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

