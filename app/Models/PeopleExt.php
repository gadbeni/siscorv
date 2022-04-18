<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleExt extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'direccion_id', 'unidad_id', 'cargo', 'observacion', 'status'];

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
