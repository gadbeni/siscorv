<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function reservas(){
        return $this->hasManyThrough(Reserva::class, Municipio::class);
    }
}
