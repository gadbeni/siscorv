<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class PjNameFile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

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

    public function name()
    {
        return $this->belongsTo(PjNameReservation::class, 'nameReservation_id');
    }
}
