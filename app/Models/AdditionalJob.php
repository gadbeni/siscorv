<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class AdditionalJob extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['person_id', 'cargo', 'observacion', 'status', 'deleted_at'];

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

}
