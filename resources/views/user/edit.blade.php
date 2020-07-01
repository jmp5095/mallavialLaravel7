@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Edit User {{$user->id}}</h3></div>

                <div class="card-body">

                    @include('custom.message')

                    <form class="" action="{{ route('user.update', $user->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{!! old('name',$user->name )!!}">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email',$user->email) }}" >
                      </div>
                      <div class="">
                        <label for="roles">Role</label>
                        <select class="form-control" id="roles" name="roles" >
                          @foreach($roles as $role)
                            <option value="{{$role->id}}"
                              @isset($user->roles[0]->name)
                                @if($user->roles[0]->name==$role->name)
                                  selected
                                @endif
                              @endisset
                            > {{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <hr>

                      <input class="btn btn-primary" type="submit" name="" value="Save">
                      <a class="btn btn-danger" href="{{route('user.index')}}">Back</a>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
