@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Editar Datos de Usuario</h3></div>

                <div class="card-body">

                    @include('custom.message')

                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="identification">Identificación</label>
                        <input type="text" class="form-control" id="identification" name="identification" placeholder="Ingrese la identificacion"
                        value="{!! old('identification',$user->identification )!!}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{!! old('name',$user->name )!!}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="last_name">Apellido</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese el apellido"
                        value="{!! old('last_name',$user->last_name )!!}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email',$user->email) }}" disabled>
                      </div>
                      <div class="">
                        <label for="role_id">Role</label>
                        <select class="form-control" id="role_id" name="role_id" disabled>
                          @foreach($roles as $role)
                            <option value="{{$role->id}}"
                              @isset($user->roles['name'])
                                @if($user->roles['name']==$role->name)
                                  selected
                                @endif
                              @endisset
                            > {{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <hr>
                      @can('haveaccess','user.update')
                        <a class="btn btn-primary" href="{{route('user.edit',$user->id)}}">Editar</a>
                      @endcan
                      <a class="btn btn-danger" href="{{route('user.index')}}">Regresar</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
