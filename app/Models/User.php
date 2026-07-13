<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
        'deleteuser_id',
        'must_change_password',
    ];

    protected static function booted()
    {
        // Al eliminar (soft delete): guarda quien elimino, cierra las
        // sesiones del usuario y registra el evento en el historial.
        static::deleted(function (User $user) {
            if (method_exists($user, 'isForceDeleting') && $user->isForceDeleting()) {
                return;
            }

            $user->deleteuser_id = auth()->id();
            $user->setRememberToken(Str::random(60));
            $user->saveQuietly();

            try {
                if (config('session.driver') === 'database' && Schema::hasTable('sessions')) {
                    DB::table('sessions')->where('user_id', $user->id)->delete();
                }
            } catch (\Throwable $e) {
                report($e);
            }

            UserHistorial::registrar($user, 'eliminado', UserHistorial::snapshot($user), null);
        });

        // Al restaurar: limpia quien elimino y registra el evento.
        static::restored(function (User $user) {
            $user->deleteuser_id = null;
            $user->saveQuietly();

            UserHistorial::registrar($user, 'restaurado', null, UserHistorial::snapshot($user));
        });
    }

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

    public function deletedBy(){
        return $this->belongsTo(User::class, 'deleteuser_id')->withTrashed();
    }

    public function historiales(){
        return $this->hasMany(UserHistorial::class, 'user_id')->orderByDesc('created_at');
    }

    public function isAdmin(){
        return $this->hasRole(['admin']);
    }
}
