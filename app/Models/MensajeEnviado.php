<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeEnviado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_persona',
        'phone',
        'message',
        'user_id',
        'entrada_id',
        'fecha_envio'];
}
