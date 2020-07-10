@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Rol con identificador {{$role->id}}</h3></div>

                <div class="card-body">

                    @include('custom.message')

                      <div class="form-group">
                        <label for="name">Nómbre</label>
                        <input disabled type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del rol"
                        value="{!! old('name',$role->name )!!}">
                      </div>

                      <div class="form-group">
                        <label for="description" >Descripción</label>
                        <textarea disabled class="form-control" id="description" name="description" rows="3">{{ old('description',$role->description) }}</textarea>
                      </div>

                      <hr>
                      <h3>Acceso completo</h3>
                      <div  class="form-check form-check-inline">
                        <input disabled class="form-check-input" type="radio" name="full-access" id="fullaccessyes" value="yes"
                        @if ($role['full-access']=='yes')
                          checked
                        @elseif (old('full-access')=='yes')
                          checked
                        @endif
                        >
                        <label class="form-check-label" for="fullaccessyes">Si</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input disabled class="form-check-input" type="radio" name="full-access" id="fullaccessno" value="no"
                        @if ($role['full-access']=='no')
                          checked
                        @elseif (old('full-access')=='no')
                          checked
                        @endif
                        >
                        <label class="form-check-label" for="fullaccessno" >No</label>
                      </div>

                      <hr>
                      <h3>Lista de permisos</h3>
                      @foreach($permissions as $permission)
                          <div class="custom-control custom-checkbox">
                            <input disabled type="checkbox" class="custom-control-input" id="permission_{{$permission->id}}" name="permissions[]" value="{{$permission->id}}"
                              @if ( is_array(old('permissions')) && in_array("$permission->id",old('permissions')) )
                                checked
                              @elseif ( is_array($permission_role) && in_array("$permission->id",$permission_role) )
                                checked
                              @endif
                            >

                            <label class="custom-control-label" for="permission_{{$permission->id}}">
                              {{$permission->id}} -
                              {{$permission->name}}
                              <em>({{$permission->description}})</em>
                            </label>
                          </div>
                      @endforeach
                      <hr>
                      @can('haveaccess','role.update')
                        <a href="{{ route('role.edit',$role->id) }}" class="btn btn-primary">Editar</a>
                      @endcan
                      <a href="{{ route('role.index') }}" class="btn btn-danger" >Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
