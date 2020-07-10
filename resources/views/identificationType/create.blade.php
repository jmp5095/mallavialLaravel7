@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Crear Tipo de identificacion</h3></div>

                <div class="card-body">

                    @include('custom.message')

                    <form class="" action="{{ route('tipoDeIdentificacion.store') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del tipo de identificacion" value="{!! old('name' )!!}">
                      </div>

                      <div class="form-group">
                        <label for="description" >Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                      </div>

                      <hr>

                      <input class="btn btn-primary" type="submit" name="" value="Guardar">
                      <a class="btn btn-danger" href="{{route('tipoDeIdentificacion.index')}}">Cancelar</a>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
