<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\EleccionController;
use App\Http\Controllers\VotanteController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\FrenteController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\JuradoController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\AcercadeController;
use App\Models\Mesa;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::resource('/', 'WelcomeController');

//Route::get('/elecciones', 'EleccionController@index');
Route::get('/elecciones/{id}/archivar', 'EleccionController@archivar');

Route::resource('elecciones', 'EleccionController');

//Route::get('/eleciones-creadas', 'EleccionController@index');

Route::get('/home', 'ConfirmacionController@index')->name('confirmacion');

Route::resource('votante', 'VotanteController');

Route::get('/header', function () {
    return view('votante.header');
});

Route::resource('comite', 'ComiteController');

Route::resource('frente', 'FrenteController');

Route::resource('comunicados', 'ComunicadoController');

Route::resource('documentaciones', 'DocumentacionController');

Route::resource('mesas', 'MesaController');

Route::resource('jurados', 'JuradoController');

Route::get('/mesas/{id}/generate-jurados', 'MesaController@generateJurados')->name('mesas.generateJurados');

Route::get('/mesas/{id}/lista-jurados', 'MesaController@listaJurados');

Route::get('/mesas/{id}/acta', 'MesaController@visualizaracta');

Route::get('/jurados/{id}/edit', 'JuradoController@edit')->name('jurados.edit');

Route::get('/elecciones/{id}/boleta', 'EleccionController@showBoleta')->name('elecciones.boleta');

Route::get('/votantes/carga', 'VotanteController@showCarga')->name('votante.carga');

Route::post('/votantes/importCsv', 'VotanteController@importCsv')->name('votantes.importCsv');

Route::get('/elecciones/{id}/previsualizacion', 'EleccionController@mostrarPrevisualizacion')->name('elecciones.previsualizacion');



Route::get('/elecciones/{id}/registrar-resultados', 'EleccionController@registroResultados')
    ->name('elecciones.registrarResultados');

Route::patch('/elecciones/{id}/guardarResultados', 'EleccionController@guardarResultados')->name('elecciones.guardarResultados');

Route::get('/elecciones/{id}/editar-resultados', [EleccionController::class, 'editarRegistroResultados'])->name('elecciones.editarResultados');
Route::patch('/elecciones/{id}/guardar-edicion-resultados', [EleccionController::class, 'guardarEdicionResultados'])->name('elecciones.guardarEdicionResultados');



Route::get('/mesas/{id}/registroResultados', 'MesaController@registroResultados')->name('mesas.registroResultados');

Route::patch('/mesas/{id}/guardarResultados', 'MesaController@guardarResultados')->name('mesas.guardarResultados');

Route::get('/mesas/{id}/editar-resultados', [MesaController::class, 'editarRegistroResultados'])->name('mesas.editarResultados');
Route::patch('/mesas/{id}/guardar-edicion-resultados', [MesaController::class, 'guardarEdicionResultados'])->name('mesas.guardarEdicionResultados');
Route::get('/mesas/{id}/previsualizacion', 'MesaController@mostrarPrevisualizacion')->name('mesas.previsualizacion');

//Route::get('/registroResultados', function () {
  //return view('elecciones.registroResultados');
//});

Route::get('/reporte', 'ReporteController@index');
Route::get('/reporteGrafico/{id}', 'ReporteController@reporteGrafico');

Route::get('/generar-backup', [EleccionController::class, 'generarBackup']);

Route::get('/mesas/{id}/actapdf', 'MesaController@pdf')->name('mesas.actapdf');

Route::get('/generar-pdf/{id}','EleccionController@generarPDF')->name('elecciones.pdf');
Route::get('/generar-pdf1/{id}','EleccionController@generarPDF1')->name('elecciones1.pdf');

Route::get('/acercade', [AcercadeController::class, 'index']);

Route::get('/historial', [EleccionController::class, 'historial'])->name('buscar');
Route::get('/resultados', [EleccionController::class, 'buscar'])->name('resultados');


Route::get('/cargar-backup', [EleccionController::class, 'mostrarFormCargarBackup'])->name('cargar.backup.form');

Route::post('/cargar-backup', [EleccionController::class, 'cargarBackup'])->name('cargar.backup');





















//Route::get('/mesas-create', function () {
  //  return view('mesas.form');
//});
//Route::get('/mesas', function () {
  //  return view('mesas.index');
//});
//Route::get('/mesas', function () {
    //return view('mesas.lista-jurados');
//});
//Route::get('/registro-votante', function () {
    //return view('votante.form');
//});