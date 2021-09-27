<?php

namespace App\Imports;

use App\Models\OldData;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow, WithValidation};
class OldDataImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OldData([
            'numero_resolucion' => $row['numero_resolucion'],
            'fecha_resolucion' => $row['fecha_resolucion'],
            'razon_social' => $row['razon_social'],
            'provincia' => $row['provincia'],
            'municipio' => $row['municipio'],
            'warehouse_id' => $row['warehouse_id'],
        ]);
    }
}
