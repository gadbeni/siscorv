<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PjNameFile extends Model
{
    use HasFactory;

    protected $connection = 'sidepej_v2';

    protected $table = 'name_files';

    protected $fillable = [
        'nameReservation_id',
        'solicitud',
        'carnet',
        'deposito',
        'poder',
        'deleted_at'
    ];
}
