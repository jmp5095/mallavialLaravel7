@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Edit Role {{$role->id}}</h3></div>
                <div class="card-body">

                    @include('custom.message')

                    <form class="" action="{{ route('role.update', $role->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$role->name )!!}">
                      </div>
                      <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug',$role->slug) }}" >
                      </div>
                      <div class="form-group">
                        <label for="description" >Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description',$role->description) }}</textarea>
                      </div>

                      <hr>
                      <h3>Full access</h3>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="full-access" id="fullaccessyes" value="yes"
                        @if ($role['full-access']=='yes')
                          checked
                        @elseif (old('full-access')=='yes')
                          checked
                        @endif
                        >
                        <label class="form-check-label" for="fullaccessyes">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="full-access" id="fullaccessno" value="no"
                        @if ($role['full-access']=='no')
                          checked
                        @elseif (old('full-access')=='no')
                          checked
                        @endif
                        >
                        <label class="form-check-label" for="fullaccessno" >No</label>
                      </div>

                      <hr>
                      <h3>Permission List</h3>
                      @foreach($permissions as $permission)
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="permission_{{$permission->id}}" name="permissions[]" value="{{$permission->id}}"
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

                      <input class="btn btn-primary" type="submit" name="" value="Save">
                      <a class="btn btn-danger" href="{{route('role.index')}}">Back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
