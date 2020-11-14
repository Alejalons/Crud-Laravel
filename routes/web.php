<?php
use Illuminate\Auth\Middleware\Authenticate;
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

Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/empleados', 'EmpleadosController@index');
// Route::get('/empleados/create', 'EmpleadosController@create')->middleware('auth');
// Route::get('/empleados/create', 'EmpleadosController@create')->middleware('auth');
// Route::get('/empleados/create', 'EmpleadosController@create')->middleware('auth');


Route::resource('empleados', 'EmpleadosController');
Auth::routes();

Route::get('/home', 'EmpleadosController@index')->name('home');
