<?php

use Illuminate\Support\Facades\Route;

// Cotrollers
use App\Http\Controllers\EntradasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Entradas
    Route::resource('entradas', EntradasController::class);
    Route::get('entradas/ajax/list', [EntradasController::class, 'list']);
    Route::post('entradas/store/file', [EntradasController::class, 'store_file']);
    Route::post('entradas/store/derivacion', [EntradasController::class, 'store_derivacion'])->name('store.derivacion');
    
    // Bandeja
    Route::get('bandeja', [EntradasController::class, 'derivacion_index'])->name('bandeja.index');
    Route::get('bandeja/{id}', [EntradasController::class, 'derivacion_show'])->name('bandeja.show');
    Route::post('bandeja/{id}/rechazar', [EntradasController::class, 'derivacion_rechazar'])->name('bandeja.rechazar');
});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
