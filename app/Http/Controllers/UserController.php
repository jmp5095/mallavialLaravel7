<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//inicio
use App\User;
use App\permisos\models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
  public function index()
  {
      $this->authorize('haveaccess','user.index');
      $users=User::orderBy('id','Asc')->paginate(2);

      return view('user.index',compact('users'));
  }

  public function create()
  {
    $this->authorize('haveaccess','user.create');

    // $this->authorize('create',User::class);
    $roles=Role::orderBy('id')->get();
    return view('user.create',compact('roles'));
  }

  public function store(Request $request)
  {
    $this->authorize('haveaccess','user.create');

   $request->validate([
     'identification'  => 'required|max:20|unique:users,identification',
     'name'  => 'required|max:50',
     'email' => 'required|max:50|unique:users,email,'
   ]);

    User::create([
       'identification' => $request['identification'],
       'name' => $request['name'],
       'last_name' => $request['last_name'],
       'email' => $request['email'],
       'password' => Hash::make($request['identification']),
       'role_id' => $request['role_id'],
   ]);

    return redirect()->route('user.index')
                ->with('status_success','Usuario creado con exito');
  }

  public function show(User $user)
  {
    $this->authorize('view',[$user,['user.show','userown.show']]);
    //consultar los roles
    $roles=Role::get();

    return view('user.view',compact('user','roles'));

  }

  public function edit(User $user)
  {
    $this->authorize('update',[$user,['user.update','userown.update']]);
    $roles=Role::get();
    return view('user.edit',compact('user','roles'));

  }

  public function update(Request $request, User $user)
  {
    $this->authorize('update',[$user,['user.update','userown.update']]);

    $request->validate([
      'identification'  => 'required|max:20|unique:users,identification,'.$user->id,
      'name'  => 'required|max:50',
      'email' => 'required|max:50|unique:users,email,'.$user->id,
    ]);


     $user->update($request->all());

       return redirect()->route('user.index')
                 ->with('status_success','Usuario actualizado con exito');
  }

  public function destroy(User $user)
  {
    $this->authorize('haveaccess','user.delete');
      $user->delete();
      return redirect()->route('user.index')
                ->with('status_success','Usuario eliminado con exito.');
  }


  public function miPerfil()
  {
      return view('user.perfil');
  }

}
