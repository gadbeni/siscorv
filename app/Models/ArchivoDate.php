<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoDate extends Model
{
    use HasFactory;
    
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
