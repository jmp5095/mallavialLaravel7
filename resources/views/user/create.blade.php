@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Crear Usuario</h3></div>

                <div class="card-body">

                    @include('custom.message')

                    <form class="" action="{{ route('user.store') }}" method="POST">
                      @csrf
                      <table>
                        <tbody>
                          <tr>
                            <td>
                              <label for="identification">Identificación</label>
                              <input style="width: 32.7em;" type="text" class="form-control" id="identification" name="identification" placeholder="Ingrese la identificacion"
                              value="{!! old('identification') !!}" >
                            </td>
                            <td >
                              <label for="identification">Tipo de identificación</label>
                              <select align="center" style="width: 15em;"  class="form-control" id="identification_type_id" name="identification_type_id" >
                                @foreach($identificaciones as $identificacion)
                                  <option value="{{$identificacion->id}}"> {{$identificacion->name}}</option>
                                @endforeach
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre" value="{!! old('name')!!}">
                      </div>
                      <div class="form-group">
                        <label for="last_name">Apellido</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese el apellido"
                        value="{!! old('last_name')!!}">
                      </div>
                      <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese el correo electrónico" value="{{ old('email') }}" >
                      </div>
                      <div class="">
                        <label for="role_id">Rol</label>
                        <select class="form-control" id="role_id" name="role_id" >
                          @foreach($roles as $role)
                            <option value="{{$role->id}}"
                            > {{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <hr>

                      <input class="btn btn-primary" type="submit" name="" value="Guardar">
                      <a class="btn btn-danger" href="{{route('user.index')}}">Cancelar</a>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
