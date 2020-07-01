<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//inicio
use App\User;
use App\permisos\models\Role;
use Illuminate\Support\Facades\Gate;


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
    // $this->authorize('create',User::class);
    // return 'hola';
  }


  public function show(User $user)
  {
    $this->authorize('view',[$user,['user.show','userown.show']]);
    //consultar los roles del usuario
    $role_user=Role::orderBy('name')->get();

    return view('user.view',compact('user','role_user'));

  }

  public function edit(User $user)
  {
    $this->authorize('update',[$user,['user.update','userown.update']]);
    $roles=Role::get();
    return view('user.edit',compact('user','roles'));

  }

  public function update(Request $request, User $user)
  {
    $this->authorize('view',$user);
    $request->validate([
      'name'  => 'required|max:50',
      'email' => 'required|max:50|unique:users,email,'.$user->id,
    ]);


     $user->update($request->all());
    //
    // //if ($request->get('permissions')) {
      $user->roles()->sync($request->get('roles'));
    // //}
       return redirect()->route('user.index')
                 ->with('status_success','Usuario updated successfully');
  }

  public function destroy(User $user)
  {
      $this->authorize('haveaccess','user.delete');;
      $user->delete();
      return redirect()->route('user.index')
                ->with('status_success','Role Removed successfully');
  }

}
