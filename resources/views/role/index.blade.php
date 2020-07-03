@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Roles y Permisos</h2></div>
                <div class="">
                </div>
                <div class="card-body">
                    <a href="{{route('role.create')}}" class="btn btn-primary float-right" >
                      Crear
                    </a>
                  </br></br>

                  @include('custom.message')

                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acceso completo</th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($roles as $role)
                      <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                        <td>{{$role['full-access']}}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('role.show',$role->id) }}"> Ver</a>

                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('role.edit',$role->id) }}"> Editar</a>

                        </td>
                        <td>
                          <form class="" action="{{ route('role.destroy',$role->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" name="button">Eliminar</button>
                          </form>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    {{$roles->links()}}
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
