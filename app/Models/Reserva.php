<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nombre_solicitante','nombre','localidad','numero_recibo','costo_reserva','fecha_inicio',
        'fecha_conclusion','municipio_id','user_id','estado_id','warehouse_id'
    ];

    public function municipio (){
        return $this->belongsTo(Municipio::class);
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function warehouse (){
        return $this->belongsTo(Warehouse::class);
    }

    public function estado (){
        return $this->belongsTo(Estado::class);
    }
}
