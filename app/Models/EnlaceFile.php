<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnlaceFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'enlace_id',
        'nombre_origen',
        'ruta',
        'status',
        'registerUser_id',
        'deleted_at',
        'deleteUser_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'registerUser_id');
    }
}

    