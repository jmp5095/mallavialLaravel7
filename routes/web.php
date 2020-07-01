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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {

  $user=User::find(2);

  // $user->roles()->sync([3]);

  return $user;
  //$user->roles()->sync([5]);
  // return $user->havePermission('role.create');
});


//inicio
Route::resource('/role', 'RoleController')->names('role');
Route::resource('/user', 'UserController',
          ['except'=> ['store','create']])->names('user');
