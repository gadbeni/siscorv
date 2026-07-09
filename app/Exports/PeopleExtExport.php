<?php

namespace App\Exports;

use App\Models\PeopleExt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeopleExtExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $direcciones = DB::connection('mamore')->table('direcciones')
            ->pluck('nombre', 'id');

        $unidades = DB::connection('mamore')->table('unidades')
            ->pluck('nombre', 'id');

        return PeopleExt::with('person')
            ->where('deleted_at', null)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) use ($direcciones, $unidades) {
                $person = $item->person;

                return [
                    'id' => $item->id,
                    'ci' => optional($person)->ci,
                    'funcionario' => trim(implode(' ', array_filter([
                        optional($person)->first_name,
                        optional($person)->paternal_surname,
                        optional($person)->maternal_surname,
                        optional($person)->married_surname,
                    ]))),
                    'cargo' => $item->cargo,
                    'direccion' => $direcciones->get($item->direccion_id),
                    'unidad' => $unidades->get($item->unidad_id),
                    'estado' => $item->status == 1 ? 'Activo' : 'Inactivo',
                    'observacion' => $item->observacion,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Id',
            'C.I.',
            'Funcionario',
            'Cargo',
            'Dirección',
            'Unidad',
            'Estado',
            'Observación',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
