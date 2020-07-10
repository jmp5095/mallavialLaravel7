@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Tipos de identificaciones</h2></div>
                <div class="">
                </div>
                <div class="card-body">
                    <a href="{{route('tipoDeIdentificacion.create')}}" class="btn btn-primary float-right" >
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
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($identifications as $identification)
                      <tr>
                        <td>{{$identification->id}}</td>
                        <td>{{$identification->name}}</td>
                        <td>{{$identification->description}}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('tipoDeIdentificacion.show',$identification->id) }}"> Ver</a>
                        </td>
                        <td>
                          <a class="btn btn-success" href="{{ route('tipoDeIdentificacion.edit',$identification->id) }}"> Editar</a>
                        </td>
                        <td>
                            <form class="" action="{{ route('tipoDeIdentificacion.destroy',$identification->id) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" name="button">Eliminar</button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    {{($identifications->links())}}
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
