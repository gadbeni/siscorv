<?php

use Illuminate\Support\Facades\Route;

// Cotrollers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AjaxController;
use App\Http\Livewire\CertificateController;
use App\Http\Livewire\CreateCertificate;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\PersoneriasController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PeopleExtController;
use App\Http\Controllers\AdditionalJobController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmbargoController;
use App\Http\Controllers\EntidadController;
use App\Models\Category;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ExchangeController;
use App\Models\Derivation;

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
if(!env('APP_MAINTENANCE'))
{
    Route::get('login', function () {
        return redirect('admin/login');
    })->name('login');
}


Route::get('/', [HomeController::class, 'index']);
Route::post('/search', [HomeController::class, 'search'])->name('home.search');
Route::get('/buscartramite', [HomeController::class, 'searchtramite']);
Route::get('/maintenance', [MaintenanceController::class , 'maintenance'])->name('maintenance');

Route::get('/prueba', function()
{
    return view('prueba');
});

Route::group(['prefix' => 'admin'], function () {
    
    Voyager::routes();

    // entidades
    Route::get('entities', [EntidadController::class, 'index'])->name('voyager.entities.index');
    Route::get('entities/ajax/list/{search?}', [EntidadController::class, 'list']);


    // Entradas
    Route::resource('entradas', EntradasController::class);
    Route::get('entradas/ajax/list', [EntradasController::class, 'list']);
    Route::post('entradas/store/file', [EntradasController::class, 'store_file']);
    Route::post('entradas/store/derivacion', [EntradasController::class, 'store_derivacion'])->name('store.derivacion');
    Route::post('entradas/delete/derivacions', [EntradasController::class, 'delete_derivacions'])->name('delete.derivacions');
    Route::post('entradas/delete/derivacion', [EntradasController::class, 'delete_derivacion'])->name('delete.derivacion');
    Route::post('entradas/delete/derivacion/file', [EntradasController::class, 'delete_derivacion_file'])->name('delete.derivacion.file');
    Route::get('entradas/{entrada}/print', [EntradasController::class, 'print'])->name('entradas.print');
    Route::get('entradas/{entrada}/printhr', [EntradasController::class, 'printhr'])->name('entradas.printhr');
    Route::post('entradas/store/vias', [EntradasController::class, 'store_vias'])->name('store.vias');
    Route::post('entradas/nulledvia', [EntradasController::class, 'anulacion_via'])->name('via.nulled');

    // Bandeja
    Route::get('bandeja', [EntradasController::class, 'derivacion_index'])->name('bandeja.index');
    Route::get('bandeja/list/{funcionario_id}/{type}', [EntradasController::class, 'derivacion_list']);
    Route::get('bandeja/{id}', [EntradasController::class, 'derivacion_show'])->name('bandeja.show');
    Route::post('bandeja/delete/derivacion', [EntradasController::class, 'bandejaDerivationDelete'])->name('bandeja-derivation.delete');
    Route::post('bandeja/{id}/rechazar', [EntradasController::class, 'derivacion_rechazar'])->name('bandeja.rechazar');
    Route::post('bandeja/{id}/archivar', [EntradasController::class, 'derivacion_archivar'])->name('bandeja.archivar');

    Route::get('treejs/{id?}', [EntradasController::class, 'treeAjax'])->name('tree-ajax');
    
    Route::post('register-users', [UsersController::class, 'create_user'])->name('store.users');
    Route::put('update-user/{user}' ,[UsersController::class ,'update_user'])->name('update.users');
    Route::get('search', [UsersController::class, 'getFuncionariotocreate'])->name('user.getFuncionario');

    //Report RDE
    Route::get('report_list-document', [ReportController::class, 'view_list_document'])->name('view.list-document');
    Route::post('report/list-document', [ReportController::class, 'printf_list_document'])->name('prinft.list-document');

    // Report
    Route::get('report', [ReportController::class, 'view_report_list'])->name('view.report.list');
    Route::post('report/print/list', [ReportController::class, 'printf_report_list'])->name('print.report.list');
    

    //personas externas 
    Route::resource('people_exts', PeopleExtController::class);
    Route::post('people_exts/baja', [PeopleExtController::class, 'baja'])->name('people_exts.baja');
    Route::post('people_exts/activo', [PeopleExtController::class, 'activo'])->name('people_exts.activo');
    Route::post('people_exts/update', [PeopleExtController::class, 'update'])->name('people_exts.update');
    Route::delete('people_exts/delete', [PeopleExtController::class, 'destroy'])->name('people_exts.delete');

    //Cargos Adicionales
    Route::resource('additional_jobs', AdditionalJobController::class);
    Route::post('additional_jobs/baja', [AdditionalJobController::class, 'baja'])->name('additional_jobs.baja');
    Route::delete('additional_jobs/delete', [AdditionalJobController::class, 'destroy'])->name('additional_jobs.delete');

    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');

    Route::resource('exchange', ExchangeController::class);
    Route::post('exchange/search/print', [ExchangeController::class, 'print'])->name('exchange-search.print');
    Route::post('exchange/search/transfer', [ExchangeController::class, 'transfer'])->name('exchange-search.transfer');



    // LEVANTAMIENTO DE EMBARGO
    Route::get('embargos', [EmbargoController::class, 'index'])->name('voyager.embargos.index');
    Route::post('embargos/import/excel', [EmbargoController::class, 'importExcel'])->name('embargos-embargo.excel');
    Route::post('embargos/list/inhabilitar', [EmbargoController::class, 'inhabilitar'])->name('embargos-list.inhabilitar');
    Route::post('embargos/list/habilitar', [EmbargoController::class, 'habilitar'])->name('embargos-list.habilitar');







    Route::middleware(['auth'])->group(function () {
        //rutas para la obtencion de people para crear un tramite
        Route::get('/mamore/getpeople/',[AjaxController::class, 'getPeoples'])->name('mamore.getpeople');
        Route::get('/mamore/getpeoplederivacion/',[AjaxController::class, 'getPeoplesDerivacion'])->name('mamore.getpeoplederivacion');



        //rutas para los certificados
        Route::get('certificates', CertificateController::class)->name('list.certificates');
        Route::get('certificates/create', CreateCertificate::class)->name('certificate.create');
        Route::get('/certificados/getpersonas',[AjaxController::class, 'getPersonas'])->name('certificados.getPersonas');
        Route::get('/certificados/getfuncionarios/',[AjaxController::class, 'getFuncionarios'])->name('certificados.getFuncionario');// anular ruta
        Route::get('/certificados/getfuncionariosderivacion/',[AjaxController::class, 'getFuncionariosDerivacion'])->name('certificados.getFuncionariosDerivacion'); //anular

        Route::get('/certificados/{id}/show', [AjaxController::class,'imprimir'])->name('certificates.imprimir');

        //rutas para el modulo de personerias juridicas
        Route::resource('reservas',ReservasController::class);
        Route::post('anulareserva/{id}',[ReservasController::class,'nulled'])->name('reservas.nulled');
        Route::get('reservas/ajax/list', [ReservasController::class, 'list']);

        Route::resource('personerias',PersoneriasController::class);
        Route::get('personerias/ajax/list', [PersoneriasController::class, 'list']);

        //ruta para la busqueda de tramites externo e internos juntos
        Route::get('tramites',[TramiteController::class,'index'])->name('tramites_index');
        Route::get('get-tramites',[TramiteController::class,'documentosjson'])->name('tramites_json');

        //ruta para mostrar los tramites pronto a expiracion
        Route::get('getdocumexpired',[HomeController::class,'documents_expired'])->name('documents_expired');





        //peticiones ajax
        Route::get('cite/{id?}/{cite?}',[AjaxController::class,'getCite'])->name('cite.get');
    });
});

//ruta para la consulta de busqueda de disponibilidad de nombres de personerias disponible para el front-end+
Route::get('consultas/{search?}', [AjaxController::class,'consultareservas']);
//importar datos antiguos
Route::get('/import', [ImportController::class,'import']);
// Clear cache

Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');

Route::get('services', function () {
    return view('frontend.pages.servicios');
})->name('services');

Route::get('/{vue?}', function () {
    return view('frontend.pages.servicios');
})->where('vue', 'services');