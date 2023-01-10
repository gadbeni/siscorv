<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archivo extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nombre_origen', 'entrada_id', 'ruta', 'user_id', 'nci', 'deleteUser_id'
    ];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
