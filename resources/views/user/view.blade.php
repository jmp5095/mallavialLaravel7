@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>User {{$user->id}}</h3></div>

                <div class="card-body">

                    @include('custom.message')

                      <div class="form-group">
                        <label for="name">Name</label>
                        <input disabled type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$user->name )!!}">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input disabled type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email',$user->email ) }}" >
                      </div>

                      <div class="">
                        <label for="roles">Role</label>
                        <select class="form-control" id="roles" name="roles"  disabled>
                          @foreach($role_user as $role)
                            <option value="{{$role->id}}">
                              <?php
                                $salida="Sin rol";
                                if (isset($user->roles[0]->name)) {
                                  $salida=$user->roles[0]->name;
                                }
                              ?>
                              {{$salida}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <hr>
                      <a class="btn btn-primary" href="{{ route('user.edit',$user->id)}}">Edit</a>
                      <a class="btn btn-danger" href="{{ route('user.index') }}" >Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
