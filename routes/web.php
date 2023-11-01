<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\EleccionController;
use App\Http\Controllers\VotanteController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\FrenteController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\JuradoController;
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

Route::resource('mesas', 'MesaController');

Route::resource('jurados', 'JuradoController');

Route::get('/mesas/{id}/generate-jurados', 'MesaController@generateJurados')->name('mesas.generateJurados');

Route::get('/mesas/{id}/lista-jurados', 'MesaController@listaJurados');

Route::get('/jurados/{id}/edit', 'JuradoController@edit')->name('jurados.edit');

Route::get('/elecciones/{id}/boleta', 'EleccionController@showBoleta')->name('elecciones.boleta');




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