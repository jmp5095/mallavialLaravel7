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
          'identification_type_id' => "1",
      ]);
      //forania de admin para relacionarlo con el rol
      //$userAdmin->roles()->sync([$rolAdmin->id]);

      //creando permisos( todos los del rol), y guardando sus id en un array
      $permission_test=[];

      $permission=Permission::create([
        'name'=>'Listar roles',
        'slug'=>'role.index',
        'description'=>'Puede listar los roles.'
      ]);

      $permission=Permission::create([
        'name'=>'Crear rol',
        'slug'=>'role.create',
        'description'=>'puede crear roles'
      ]);

      $permission=Permission::create([
        'name'=>'Ver rol',
        'slug'=>'role.show',
        'description'=>'Puede ver los detalles de los roles'
      ]);


      $permission=Permission::create([
        'name'=>'Editar rol',
        'slug'=>'role.update',
        'description'=>'Puede editar los roles'
      ]);

      $permission=Permission::create([
        'name'=>'Borrar rol',
        'slug'=>'role.delete',
        'description'=>'Puede borrar los roles'
      ]);

      //creando permisos (todos los del usuario)
      $permission=Permission::create([
        'name'=>'Listar usuarios',
        'slug'=>'user.index',
        'description'=>'Puede listar los usuarios'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Crear usuario',
        'slug'=>'user.create',
        'description'=>'puede crear usuarios'
      ]);

      $permission=Permission::create([
        'name'=>'Ver usuario',
        'slug'=>'user.show',
        'description'=>'Puede ver los detalles de los usuarios'
      ]);
      $permission_all[]=$permission->id;

      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Editar usuario',
        'slug'=>'user.update',
        'description'=>'Puede editar los usuarios'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Borrar usuario',
        'slug'=>'user.delete',
        'description'=>'Puede borrar usuarios'
      ]);
      $permission_all[]=$permission->id;

      //new permission
      $permission=Permission::create([
        'name'=>'Ver perfi',
        'slug'=>'userown.show',
        'description'=>'Puede ver los datos de su propio usuario'
      ]);
      $permission_all[]=$permission->id;

      $permission=Permission::create([
        'name'=>'Actualizar perfilr',
        'slug'=>'userown.update',
        'description'=>'Puede actualizar su propio usuario'
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
                'identification'    => "1234" ,
                'name'    => "Test" ,
                'email'   => "test@test.com",
                'password' => Hash::make('test'),
                'role_id'   => "2",
                'identification_type_id' => "1",
            ]);
      //enlazamos o sincronizamos el usuario con el rol
      //$userTest->roles()->sync([$rolTest->id]);

    }

}
