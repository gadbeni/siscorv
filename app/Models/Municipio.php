<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Municipio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['nombre','provincia_id'];

    public function provincia() {
        return $this->belongsTo(Provincia::class);
    }
}
