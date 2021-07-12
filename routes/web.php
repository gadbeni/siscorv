<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::post('register-users', [UsersController::class, 'create_user'])->name('store.users');
    Route::put('update-user/{user}' ,[UsersController::class ,'update_user'])->name('update.users');
    Route::get('search/{name}', [UsersController::class, 'getFuncionario']);

    //rutas para los certificados
    Route::get('certificates', CertificateController::class)->name('list.certificates');
    Route::get('certificate/create', CreateCertificate::class)->name('certificate.create');
    Route::get('/certificados/getPersonas',[AjaxController::class, 'getPersonas'])->name('certificados.getPersonas');
    Route::get('/certificados/getfuncionarios',[AjaxController::class, 'getFuncionario'])->name('certificados.getFuncionario');

});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
