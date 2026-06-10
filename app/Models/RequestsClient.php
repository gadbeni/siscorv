<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class RequestsClient extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;
    
    protected $fillable = ['ip', 'user_agent'];
}
