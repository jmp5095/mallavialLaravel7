<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//inicio
use App\permisos\models\Role;
use App\permisos\models\Permission;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       Gate::authorize('haveaccess','role.index');

        $roles=Role::orderBy('id','Asc')->paginate(2);

        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       Gate::authorize('haveaccess','role.create');

        $permissions=Permission::get();

        return view('role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     Gate::authorize('haveaccess','role.create');

      $request->validate([
        'name'        => 'required|max:50|unique:roles,name',
        'full-access' => 'required|in:yes,no'
      ]);

      $role=Role::create($request->all());

      $role->permissions()->sync($request->get('permissions'));

      return redirect()->route('role.index')
                  ->with('status_success','Rol creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
     Gate::authorize('haveaccess','role.show');
      //consultar los permisos asignados
      $permission_role=[];
      foreach ($role->permissions as $permission) {
        $permission_role[]=$permission->id;
      }
      //consultar todos los permisos
      $permissions=Permission::get();
      return view('role.view',compact('permissions','role','permission_role'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //$rol=Role::findOrFail($id);
    public function edit(Role $role)
    {
     Gate::authorize('haveaccess','role.update');
      //consultar los permisos asignados
      $permission_role=[];
      foreach ($role->permissions as $permission) {
        $permission_role[]=$permission->id;
      }
      //consultar todos los permisos
      $permissions=Permission::get();
      return view('role.edit',compact('permissions','role','permission_role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
      Gate::authorize('haveaccess','role.update');
      $request->validate([
        'name'        => 'required|max:50|unique:roles,name,'.$role->id,
        // 'slug'        => 'required|max:50|unique:roles,slug,'.$role->id,
        'full-access' => 'required|in:yes,no'
      ]);
       $role->update($request->all());

      //if ($request->get('permissions')) {
        $role->permissions()->sync($request->get('permissions'));
      //}
         return redirect()->route('role.index')
                   ->with('status_success','Rol actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('haveaccess','role.delete');
        $role->delete();
        return redirect()->route('role.index')
                  ->with('status_success','Rol eliminado con exito');
    }
}
