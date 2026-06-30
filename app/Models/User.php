<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class User extends \TCG\Voyager\Models\User implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory, Notifiable, SoftDeletes;

    protected $with = ['warehouses'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id',
        'status',
        'register_user_id',
        'must_change_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
        'must_change_password' => 'boolean',
    ];

    public function getAvatarAttribute($value)
    {
        if (empty($value) || $value === config('voyager.user.default_avatar', 'users/default.png')) {
            return asset('images/usuario.png');
        }

        return $value;
    }

    public function warehouses(){
        return $this->belongsToMany(Warehouse::class);
    }

    public function registeredBy(){
        return $this->belongsTo(User::class, 'register_user_id');
    }

    public function isAdmin(){
        return $this->hasRole(['admin']);
    }
}
