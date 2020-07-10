<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//inicio
use App\permisos\models\Permission;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
//inicio
    public function index(){
      $user=auth()->user();
      $accesoCompleto=$user->roles['full-access'];

      if ($accesoCompleto=='yes') {
        $permisos=Permission::orderBy('id')->get();
      }else{
        $permisos=$user->roles->permissions;
      }
      return view('inicio',compact('permisos'));
    }


}
