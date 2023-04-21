<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PjNameReservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'sidepej_v2';
    protected $table = 'name_reservations';
    
    protected $fillable = [
        'entrada_id',
        'name',
        'phone',
        'applicant',
        'province_id',
        'municipality',
        'start',
        'finish',
        'receiptNumber',
        'amount',
        'status',
        'description',
        'registerUser_id',
        'deleted_at',
        'deletedUser_id'
    ];
}
