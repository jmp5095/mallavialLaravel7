<?php

use Illuminate\Database\Seeder;
//inicio
use App\User;
use App\permisos\models\Permission;
use App\permisos\models\Role;
use Illuminate\Support\Facades\Hash;

class permisosInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // inicio
      //truncate tablas vaciar y reiniciamos los id para mantener integridad de registros anteriores
      DB::statement("SET foreign_key_checks=0");
      //  DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        Permission::truncate();
        Role::truncate();
      DB::statement("SET foreign_key_checks=1");


      //Registrar en db por medio de Eloquent (modelo)

        //creamos el rol admin, pero antes aliminamos por si ya esta creado
      $rolAdmin=Role::where('name','Admin')->first();
      if ($rolAdmin) {
        $rolAdmin->delete();
      }

      $rolAdmin=Role::create([
        'name'=>'Admin',
      //  'slug'=>'admin',
        'description' => 'Administrator',
        'full-access'=>'yes'
      ]);

      //creamos el usuario admin, pero antes elmininamos por si ya esta registrado
      $userAdmin=User::where('email','admin@admin.com')->first();
      if ($userAdmin) {
        $userAdmin->delete();
      }
      $userAdmin=User::create([
          'identification'    => "1118303967" ,
          'name'    => "admin" ,
          'email'   => "admin@admin.com",
          'password' => Hash::make('admin'),
          'role_id'   => "1",
      ]);
      //forania de admin para relacionarlo con el rol
      //$userAdmin->roles()->sync([$rolAdmin->id]);

      //creando permisos( todos los del rol), y guardando sus id en un array
      $permission_test=[];

      $permission=Permission::create([
        'name'=>'List role',
        'slug'=>'role.index',
        'description'=>'A user can list roles'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Show role',
        'slug'=>'role.show',
        'description'=>'A user can see role'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Create role',
        'slug'=>'role.create',
        'description'=>'A user can create role'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Update role',
        'slug'=>'role.update',
        'description'=>'A user can update role'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Delete role',
        'slug'=>'role.delete',
        'description'=>'A user can delete role'
      ]);
      $permission_all[]=$permission->id;

      //creando permisos (todos los del usuario)
      $permission=Permission::create([
        'name'=>'List user',
        'slug'=>'user.index',
        'description'=>'A user can list user'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Show user',
        'slug'=>'user.show',
        'description'=>'A user can see user'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Create user',
        'slug'=>'user.create',
        'description'=>'A user can create user'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Update user',
        'slug'=>'user.update',
        'description'=>'A user can update user'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Delete user',
        'slug'=>'user.delete',
        'description'=>'A user can delete user'
      ]);
      $permission_all[]=$permission->id;

      //new permission
      $permission=Permission::create([
        'name'=>'show own user',
        'slug'=>'userown.show',
        'description'=>'A user see own user'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Update own user',
        'slug'=>'userown.update',
        'description'=>'A user can update own user'
      ]);
      //asignamos los permisos creados al rol admin
      //$rolAdmin->permissions()->sync($permission_all);

      //creamos el rol test, pero antes borramos si ya esta en la bd
      $rolTest=Role::where('name','Test')->first();
      if ($rolTest) {
        $rolTest->delete();
      }

      $rolTest=Role::create([
        'name'=>'Test',
        //'slug'=>'test',
        'description' => 'description test',
        'full-access'=>'no'
      ]);

            //creamos el usuario test pero antes eliminamos por si ya esta creado
            $userTest=User::where('email','test@test.com')->first();
            if ($userTest) {
              $userTest->delete();
            }

            $userTest=User::create([
                'identification'    => "12345667" ,
                'name'    => "Test" ,
                'email'   => "test@test.com",
                'password' => Hash::make('test'),
                'role_id'   => "2",
            ]);
      //enlazamos o sincronizamos el usuario con el rol
      //$userTest->roles()->sync([$rolTest->id]);

    }

}
