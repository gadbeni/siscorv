<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldData extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_resolucion','fecha_resolucion','razon_social','provincia','municipio','localidad',
        'objeto','warehouse_id'
    ];
}
