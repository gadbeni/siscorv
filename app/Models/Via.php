<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class Via extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory,SoftDeletes;

    protected $fillable = [
        'funcionario_id', 'nombre', 'cargo', 'entrada_id',
        'people_id'
    ];
}
