<?php
Route::get('/test', function () {
    return Role::create([
      'name'=>'Admin',
      'slug'=>'admin',
      'description'=>'Administrator',
      'full-access'=>'yes'
    ]);


    return Role::create([
      'name'=>'Guest',
      'slug'=>'gues',
      'description'=>'gues',
      'full-access'=>'no'
    ]);


    return Role::create([
      'name'=>'Test',
      'slug'=>'test',
      'description'=>'test',
      'full-access'=>'no'
    ]);

  return Permission::create([
    'name'=>'List product',
    'slug'=>'product.index',
    'description'=> 'A user can list one product'
  ]);

  $rol= Role::find(2);
  $rol->permissions()->sync([1]);

  return $rol->permissions;

});

//disque facades
Route::get('/cache', function () {
    return Cache::get('key');
});

//METODOS PARA OTORGAR Y DENEGAR
//definicion
Gate::define('update-post', 'App\Policies\PostPolicy@miMetodo');
//definimos el metodo miMetodo en postPolicy
public function miMetodo()
{
    return FALSE;
}
//llamando el metodo Gate
$response = Gate::inspect('update-post');


if ($response->allowed()) {
  echo "tu si";
} else {
    echo "no no no men";
    Gate::authorize('DENEGADO');
}
