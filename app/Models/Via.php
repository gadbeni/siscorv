<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Via extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'funcionario_id', 'nombre', 'cargo', 'entrada_id',
        'people_id'
    ];
}
