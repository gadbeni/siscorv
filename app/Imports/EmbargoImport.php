<?php

namespace App\Imports;

use App\Models\Embargo;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;



class EmbargoImport implements ToModel
{
    public function model(array $row)
    {
        if (is_numeric($row[0])) {
            $people = Persona::where('people_id', '!=',null)->where('user_id', Auth::user()->id)->where('deleted_at', null)->first();

            return new Embargo([
                'nro'       => $row[0]??NULL,
                'nroPiet'   => $row[1]??NULL,
                'fechaPiet' => $row[2]??NULL,
                'rutNit' => $row[3]??NULL,
                'ci' => $row[4]??NULL,
                'nombre' => $row[5]??NULL,

                'montoEmbargo' => $row[6]??NULL,
                'notaEmbargo' => $row[7]??NULL,
                'montoLevantamiento' => $row[8]??NULL,
                'notaLevantamiento' => $row[9]??NULL,

                'fechaImportacion' => Carbon::now(),
                // 'nroImportacion' => $nro,
                'people_id' => $people->people_id??0



            ]);
        }
        else
        {
            return null;
        }

        
    }
}
