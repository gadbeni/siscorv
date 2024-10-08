<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionAdministrativa extends Model
{
    use HasFactory;

    protected $connection = 'mamore';

    protected $table = 'direcciones';

    protected $fillable = [
        'id',
        'nombre',
        'sigla',
    ];
}
