@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Users</h2></div>
                <div class="">
                </div>
                <div class="card-body">

                  @include('custom.message')

                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th colspan=""></th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                          @isset($user->roles[0])
                            {{$user->roles[0]->name}}
                          @endisset
                        </td>
                        <td>{{$user->description}}</td>
                        <td>
                          @can('view',[$user,['user.show','userown.show']])
                            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}"> Show</a>
                          @endcan
                        </td>
                        <td>
                          @can('view',[$user,['user.update','userown.update']])
                            <a class="btn btn-success" href="{{ route('user.edit',$user->id) }}"> Edit</a>
                          @endcan
                        </td>
                        <td>
                          @can('haveaccess','user.delete')
                            <form class="" action="{{ route('user.destroy',$user->id) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" name="button">Delete</button>
                            </form>
                          @endcan
                        </td>
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
