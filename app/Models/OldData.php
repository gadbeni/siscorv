<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class OldData extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = [
        'numero_resolucion','fecha_resolucion','razon_social','provincia','municipio','localidad',
        'objeto','warehouse_id'
    ];
}
