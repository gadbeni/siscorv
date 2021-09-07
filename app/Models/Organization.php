<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','tipo'];

    public function scopeTiposdocumentos($query)
    {
        return $query->where('tipo', 'tptramites');
    }
}
