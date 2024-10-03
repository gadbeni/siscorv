<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorioTelefonico extends Model
{
    use HasFactory;

    protected $table = 'directorio_telefonicos';

    protected $fillable = [
        'cargo_responsable',
        'nombre',
        'numero_interno',
        'direccion_id',
        'unidad_id',
        'mamore_people_id',
    ];

    public function direccion_administrativa()
    {
        return $this->belongsTo(DireccionAdministrativa::class, 'direccion_id');
    }
    public function unidad_administrativa()
    {
        return $this->belongsTo(UnidadAdministrativa::class, 'unidad_id');
    }
}
