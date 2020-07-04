@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Usuarios</h2></div>
                <div class="">
                </div>
                <div class="card-body">

                  @include('custom.message')
                @can('haveaccess','user.create')
                  <a href="{{route('user.create')}}" class="btn btn-primary float-right" >
                    Crear
                  </a>
                @endcan
                </br></br>

                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Identificación</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        @can('haveaccess','user.view')
                          <th colspan=""></th>
                        @endcan
                        @can('haveaccess','user.edit')
                          <th colspan=""></th>
                        @endcan
                        @can('haveaccess','user.destroy')
                          <th colspan="3"></th>
                        @endcan
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <td>{{$user->identification}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles['name']}}</td>
                        @can('haveaccess','user.show')
                        <td>
                            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}"> Ver</a>
                        </td>
                        @endcan
                        @can('haveaccess','user.edit')
                        <td>
                            <a class="btn btn-success" href="{{ route('user.edit',$user->id) }}"> Editar</a>
                        </td>
                        @endcan
                        @can('haveaccess','user.destroy')
                        <td>
                            <form class="" action="{{ route('user.destroy',$user->id) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" name="button">Eliminar</button>
                            </form>
                        </td>
                        @endcan
                      </tr>
                      @endforeach
                    </tbody>
                    {{$users->links()}}
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
