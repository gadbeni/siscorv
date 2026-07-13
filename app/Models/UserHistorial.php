<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserHistorial extends Model
{
    use HasFactory;

    protected $table = 'user_historials';

    protected $fillable = [
        'user_id',
        'changed_by',
        'accion',
        'antes',
        'despues',
    ];

    protected $casts = [
        'antes' => 'array',
        'despues' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by')->withTrashed();
    }

    /**
     * Devuelve solo los campos que difieren entre antes y despues:
     * ['Campo' => ['antes' => ..., 'despues' => ...], ...]
     */
    public function getCambiosAttribute()
    {
        $antes = $this->antes ?? [];
        $despues = $this->despues ?? [];

        $campos = array_unique(array_merge(array_keys($antes), array_keys($despues)));

        $cambios = [];
        foreach ($campos as $campo) {
            $valorAntes = $antes[$campo] ?? null;
            $valorDespues = $despues[$campo] ?? null;
            if ($valorAntes !== $valorDespues) {
                $cambios[$campo] = [
                    'antes' => $valorAntes,
                    'despues' => $valorDespues,
                ];
            }
        }

        return $cambios;
    }

    /**
     * Registra un evento en el historial del usuario.
     */
    public static function registrar(User $user, $accion, $antes = null, $despues = null, $changedBy = null)
    {
        return self::create([
            'user_id' => $user->id,
            'changed_by' => $changedBy ?? auth()->id(),
            'accion' => $accion,
            'antes' => $antes,
            'despues' => $despues,
        ]);
    }

    /**
     * Snapshot completo y legible del usuario: todos los campos con
     * valores resueltos a nombres (rol, almacenes, direccion/unidad).
     * La contraseña nunca se incluye aqui.
     */
    public static function snapshot(User $user)
    {
        $user->load('role', 'warehouses', 'registeredBy');

        $direccion = 'Sin asignar';
        $unidad = 'Sin asignar';

        try {
            $persona = Persona::where('user_id', $user->id)->whereNull('deleted_at')->first();
            if ($persona && $persona->people_id) {
                $contrato = DB::connection('mamore')->table('contracts')
                    ->where('person_id', $persona->people_id)
                    ->where('status', 'firmado')
                    ->whereNull('deleted_at')
                    ->orderByDesc('id')
                    ->first();

                if ($contrato) {
                    if ($contrato->direccion_administrativa_id) {
                        $da = DireccionAdministrativa::find($contrato->direccion_administrativa_id);
                        $direccion = $da->nombre ?? $direccion;
                    }
                    if ($contrato->unidad_administrativa_id) {
                        $ua = UnidadAdministrativa::find($contrato->unidad_administrativa_id);
                        $unidad = $ua->nombre ?? $unidad;
                    }
                }
            }
        } catch (\Throwable $e) {
            $direccion = 'No disponible';
            $unidad = 'No disponible';
        }

        return [
            'Nombre' => $user->name,
            'Email' => $user->email,
            'Celular' => $user->phone ?: 'Sin registrar',
            'Rol' => $user->role->display_name ?? 'Sin rol',
            'Almacenes' => $user->warehouses->pluck('name')->implode(', ') ?: 'Sin almacenes',
            'Dirección administrativa' => $direccion,
            'Unidad administrativa' => $unidad,
            'Estado' => $user->status ? 'Activo' : 'Inactivo',
            'Debe cambiar contraseña' => $user->must_change_password ? 'Sí' : 'No',
            'Registrado por' => $user->registeredBy->name ?? 'Sistema',
        ];
    }
}
