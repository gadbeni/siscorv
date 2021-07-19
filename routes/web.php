<?php

use Illuminate\Support\Facades\Route;

// Cotrollers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AjaxController;
use App\Http\Livewire\CertificateController;
use App\Http\Livewire\CreateCertificate;

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

Route::get('/', [HomeController::class, 'index']);
Route::post('/search', [HomeController::class, 'search'])->name('home.search');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Entradas
    Route::resource('entradas', EntradasController::class);
    Route::get('entradas/ajax/list', [EntradasController::class, 'list']);
    Route::post('entradas/store/file', [EntradasController::class, 'store_file']);
    Route::post('entradas/store/derivacion', [EntradasController::class, 'store_derivacion'])->name('store.derivacion');
    Route::post('entradas/delete/derivacion', [EntradasController::class, 'delete_derivacion'])->name('delete.derivacion');
    Route::post('entradas/delete/derivacion/file', [EntradasController::class, 'delete_derivacion_file'])->name('delete.derivacion.file');
    
    // Bandeja
    Route::get('bandeja', [EntradasController::class, 'derivacion_index'])->name('bandeja.index');
    Route::get('bandeja/{id}', [EntradasController::class, 'derivacion_show'])->name('bandeja.show');
    Route::post('bandeja/{id}/rechazar', [EntradasController::class, 'derivacion_rechazar'])->name('bandeja.rechazar');
    Route::post('bandeja/{id}/archivar', [EntradasController::class, 'derivacion_archivar'])->name('bandeja.archivar');
    
    Route::post('register-users', [UsersController::class, 'create_user'])->name('store.users');
    Route::put('update-user/{user}' ,[UsersController::class ,'update_user'])->name('update.users');
    Route::get('search/{name}', [UsersController::class, 'getFuncionario']);

    Route::middleware(['auth'])->group(function () {
        //rutas para los certificados
        Route::get('certificates', CertificateController::class)->name('list.certificates');
        Route::get('certificates/create', CreateCertificate::class)->name('certificate.create');
        Route::get('/certificados/getpersonas',[AjaxController::class, 'getPersonas'])->name('certificados.getPersonas');
        Route::get('/certificados/getfuncionarios/',[AjaxController::class, 'getFuncionarios'])->name('certificados.getFuncionario');

        Route::get('/certificados/{id}/show', [AjaxController::class,'imprimir'])->name('certificates.imprimir');
    });
});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
