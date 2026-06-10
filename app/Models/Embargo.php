<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Embargo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;


    protected $fillable = [
        'nro',
        'nroPiet',
        'fechaPiet',
        'rutNit',
        'ci',
        'nombre',
        'montoEmbargo',
        'notaEmbargo',
        'montoLevantamiento',
        'notaLevantamiento',
        'status',
        'nroImportacion',
        'fechaImportacion',
        'people_id',
        'deleted_at'
    ];
}