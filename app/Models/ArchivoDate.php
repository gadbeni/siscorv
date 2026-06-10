<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class ArchivoDate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;
    
    protected $fillable = [
        'entrada_id',
        'dateActual',
        'dateHistoria',
        'observation',
        'file',
        'registerUser_id',
        'deleted_at',
        'deletedUser_id'
    ];
}
