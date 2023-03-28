<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchivoDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class FileController extends Controller
{
    public function UpdateDateEntrada(Request $request, $id)
    {
        // return $request;
        return $id;
    }
}
