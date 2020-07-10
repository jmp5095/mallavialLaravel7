@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <?php if ($user->id == auth()->user()->id): ?>
                    <h3>Mis datos</h3>
                  <?php else: ?>
                    <h3>Datos de usuario con identificación {{$user->id}}</h3>
                  <?php endif; ?>

                </div>

                <div class="card-body">

                    @include('custom.message')

                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <table>
                          <tbody>
                            <tr>
                              <td>
                                <label for="identification">Identificación</label>
                                <input style="width: 32.7em;" type="text" class="form-control" id="identification" name="identification" placeholder="Ingrese la identificacion"
                                value="{!! old('identification',$user->identification )!!}" disabled>
                              </td>
                              <td >
                                <label for="identification">Tipo de identificación</label>
                                <select align="center" style="width: 15em;"  class="form-control" id="identification_type_id" name="identification_type_id" disabled>
                                  @foreach($identificaciones as $identificacion)
                                    <option value="{{$identificacion->id}}"
                                      @isset($user->identification_type->id )
                                        @if($identificacion->id == $user->identification_type->id)
                                          selected
                                        @endif
                                      @endisset
                                    > {{$identificacion->name}}</option>
                                  @endforeach
                                </select>
                              </td>
                            </tr>
                          </tbody>
                        </table>



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
                      <br>

                      <hr>
                      
                      <?php
                      $permitido=false;
                       ?>
                      @can('haveaccess','user.update')
                        <?php $permitido=true ?>
                      @endcan
                      @can('haveaccess','userown.update')
                        <?php $permitido=true ?>
                      @endcan
                      <?php if ($permitido): ?>
                        <a class="btn btn-primary" href="{{route('user.edit',$user->id)}}">Editar</a>
                      <?php endif; ?>

                      <a class="btn btn-danger" href="{{route('user.index')}}">Regresar</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
