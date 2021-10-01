<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personeria extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso','hojaruta','representante','ci','costo_personeria','costo_valoragregado',
        'caratula_notarial','caratula_expediente','folder_expediente','numero_testimonio','numero_resolucion',
        'fecha_resolucion','fecha_entrega','fecha_conclusion','archivo','numero_certificado',
        'documento_municipal','numero_documento','fecha_numerodocumento','reserva_id','departamento_id',
        'objeto_id','ambitoaplicacion_id','user_id','warehouse_id'
    ];

    public function reserva() {
        return $this->belongsTo(Reserva::class);
    }
}
