<?php
//probar rutas
Route::get('/test', function () {

  $user=User::find(2);

  $user->roles()->sync([3]);

  return $user;
  $user->roles()->sync([5]);
  return $user->havePermission('role.create');
});

//que ignore siertos metodos del controlador llamado
Route::resource('/user', 'UserController',
          ['except'=> ['store','create']])->names('user');
