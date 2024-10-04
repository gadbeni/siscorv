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
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\EntidadController;
use App\Models\Category;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\DirectorioTelefonicoController;

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
Route::get('login', function () {
    return redirect('admin/login');
})->name('login');


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
    Route::post('entradas/read/nci/file', [EntradasController::class, 'entradaFile'])->name('entradas-file-nci.store');
    Route::post('entradas/{id?}/date/update', [FileController::class, 'UpdateDateEntrada'])->name('entradas-date.update');//Para cambio d fecha del documemto y agrgera oc respaldo
    
    // Mensajes WhatsApp
    Route::get('entradas/{entrada}/mensajes', [MensajesController::class,'showMensajes'])->name('entradas.mensajes');
    Route::post('send-whatsapp', [EntradasController::class, 'send_message'])->name('send.whatsapp');


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
    Route::get('searchad/', [UsersController::class, 'getFuncionarioDireccionUnidad'])->name('user.getFuncionarioAll');

    //Report RDE
    Route::get('report/rde', [ReportController::class, 'rde_index'])->name('report.rde.index');
    Route::post('report/rde/list', [ReportController::class, 'rde_list'])->name('report.rde.list');
    Route::get('report/rde-documents', [ReportController::class, 'rde_documents_index'])->name('report.rde.documents.index');
    Route::post('report/list-document', [ReportController::class, 'rde_documents_list'])->name('prinft.list-document');

    //Ingreso
    Route::get('report/ingreso', [ReportController::class, 'view_report_ingreso'])->name('view.report.ingreso');
    Route::post('report/print/ingreso', [ReportController::class, 'printf_report_ingreso'])->name('print.report.ingreso');
    //para la bandeja de entrada
    Route::get('report/bandeja', [ReportController::class, 'view_report_bandeja'])->name('view.report.bandeja');
    Route::post('report/print/bandeja', [ReportController::class, 'printf_report_bandeja'])->name('print.report.bandeja');
    
    

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
    Route::get('embargos/list/ajax', [EmbargoController::class, 'list'])->name('voyager.embargos.list');
    Route::get('embargos/list/eliminar', [EmbargoController::class, 'eliminar'])->name('embargos.eliminar');
    Route::post('embargos/import/excel', [EmbargoController::class, 'importExcel'])->name('embargos-embargo.excel');
    Route::post('embargos/list/inhabilitar', [EmbargoController::class, 'inhabilitar'])->name('embargos-list.inhabilitar');
    Route::post('embargos/list/habilitar', [EmbargoController::class, 'habilitar'])->name('embargos-list.habilitar');


    //ENLACE TRAMITES Y CORRESPONDENCIA
    Route::get('enlaces/{enlace?}/file', [EnlaceController::class, 'indexFile'])->name('enlaces-file.index');
    Route::post('enlaces/file/store', [EnlaceController::class, 'storeFile'])->name('enlaces-file.store');
    Route::post('enlaces/file/delete', [EnlaceController::class, 'destroyFile'])->name('enlaces-file.delete');

    //Directorio Telefonico
    Route::get('directorio_telefonico', [DirectorioTelefonicoController::class, 'index'])->name('directorio-telefonico.index');
    Route::get('directorio_telefonico/ajax/list', [DirectorioTelefonicoController::class, 'list'])->name('directorio-telefonico.list');
    Route::get('directorio_telefonico/create', [DirectorioTelefonicoController::class, 'create'])->name('directorio-telefonico.create');
    Route::post('directorio_telefonico/store', [DirectorioTelefonicoController::class, 'store'])->name('directorio-telefonico.store');
    Route::get('directorio_telefonico/{id}/edit', [DirectorioTelefonicoController::class, 'edit'])->name('directorio-telefonico.edit');
    Route::put('directorio_telefonico/{id}/update', [DirectorioTelefonicoController::class, 'update'])->name('directorio-telefonico.update');
    Route::delete('directorio_telefonico/{id}/delete', [DirectorioTelefonicoController::class, 'destroy'])->name('directorio-telefonico.delete');
    //traer las unidades administrativas
    Route::get('directorio_telefonico/get-unidades/{direccion_id}', [DirectorioTelefonicoController::class, 'getUnidades'])->name('directorio-telefonico.get-unidades');










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
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada', 'alert-type' => 'success']);
})->name('clear.cache');

Route::get('services', function () {
    return view('frontend.pages.servicios');
})->name('services');

Route::get('/{vue?}', function () {
    return view('frontend.pages.servicios');
})->where('vue', 'services');