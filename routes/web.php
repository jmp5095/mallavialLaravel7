<?php

use Illuminate\Support\Facades\Route;
use App\permisos\models\Role;
use App\permisos\models\Permission;
use App\User;

use Illuminate\Support\Facades\Cache;
//inicio
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;

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
    return view('welcome');
});

//rutas login
Auth::routes(['register' => false]);
Route::get('sesion', 'Auth\LoginController@showLoginForm')->name('sesion');
Route::get('/inicio', 'HomeController@index')->name('inicio');


//inicio
//rutas del role
Route::resource('/role', 'RoleController')->names('role');

//rutas del usuario
Route::resource('/user', 'UserController')->names('user');
Route::get('/usuario', 'UserController@index')->name('usuario');
//rutas tipos de identificacion
Route::resource('/tipoDeIdentificacion', 'IdentificationTypeController')->names('tipoDeIdentificacion');
