<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class Certificate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'price','codigo','type','descripcion','deuda','monto_deuda','user_id',
        'persona_id','warehouse_id', 'created_at'
    ];

}
