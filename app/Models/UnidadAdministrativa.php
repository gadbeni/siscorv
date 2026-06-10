<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class UnidadAdministrativa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

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
