<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class MensajeEnviado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = [
        'nombre_persona',
        'phone',
        'message',
        'user_id',
        'entrada_id',
        'fecha_envio'];
}
