<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\OldDataImport;

class ImportController extends Controller
{
    public function import()
    {
        (new OldDataImport)->import('nombres.csv');
        
        return redirect('/')->with('success', 'File imported successfully!');
    }
}
