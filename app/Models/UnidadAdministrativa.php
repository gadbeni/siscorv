<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadAdministrativa extends Model
{
    use HasFactory;

    protected $connection = 'mamore';

    protected $table = 'unidades';

    protected $fillable = [
        'id',
        'direccion_id',
        'estado',
        'nombre',
        'sigla',
    ];
}
