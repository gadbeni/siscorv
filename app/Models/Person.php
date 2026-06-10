<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Person extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $connection = 'mamore';
    protected $table = 'people';

}
