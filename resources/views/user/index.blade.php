@extends('layouts.app')

@section('content')
<?php $permiso=false;?>
@can('haveaccess','user.show')
  <?php $permiso=true;?>
@endcan
@can('haveaccess','userown.show')
  <?php $permiso=true;?>
@endcan

<?php $permisoa=false;?>
@can('haveaccess','user.update')
  <?php $permisoa=true;?>
@endcan
@can('haveaccess','userown.update')
  <?php $permisoa=true;?>
@endcan
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
                        <th scope="col">Rol</th>
                        <?php if ($permiso): ?>
                          <th colspan=""></th>
                        <?php endif; ?>
                        <?php if ($permisoa): ?>
                          <th colspan=""></th>
                        <?php endif; ?>
                        @can('haveaccess','user.delete')
                          <th colspan=""></th>
                        @endcan

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <td>{{$user->identification}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->roles['name']}}</td>


                        <?php if ($permiso): ?>
                          <td>
                            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}"> Ver</a>
                          </td>
                        <?php endif; ?>
                        <?php if ($permisoa): ?>
                        <td>
                            <a class="btn btn-success" href="{{ route('user.edit',$user->id) }}"> Editar</a>
                        </td>
                        <?php endif; ?>
                        @can('haveaccess','user.delete')
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
