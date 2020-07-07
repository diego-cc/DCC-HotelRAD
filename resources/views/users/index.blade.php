@extends('layouts.app')
@section('title')
    users: Browse
@endsection
@section('content')
    @if (isset($msg))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{$msg}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <h1 class="text-center mb-5">All users</h1>

        <div class="text-center mb-5">
            <a href="{{route('users.create')}}" class="btn btn-lg btn-primary">Add a new user</a>
        </div>

        @if (count($users) < 1)
            <p class="lead text-center">No users available</p>
        @endif

        @if (count($users) > 0)
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">User type</th>
                    <th class="text-center" scope="col">Email verified at</th>
                    <th class="text-center" scope="col">Date created</th>
                    <th class="text-center" scope="col">Date updated</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th class="text-center" scope="row">{{$user->id}}</th>
                        <td class="text-center font-weight-bold">{{$user->name}}</td>
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center{{trim(strtolower($user->type)) === 'administrator' ? ' font-weight-bold text-danger' : ''}}">{{$user->type}}</td>
                        <td class="text-center">{{$user->email_verified_at ? \Carbon\Carbon::parse($user->email_verified_at)->isoFormat('LLLL') : 'Never'}}</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($user->created_at)->isoFormat('LLLL')}}</td>
                        <td class="text-center">{{$user->updated_at ? \Carbon\Carbon::parse($user->updated_at)->isoFormat('LLLL') : 'Never'}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('users.show', $user->id)}}" class="btn btn-info mr-4">View</a>
                                <a href="{{route('users.edit_type', $user->id)}}" class="btn btn-warning mr-4">Change type</a>
                                @includeIf('utils.delete', ['resource' => $user, 'type' => 'user'])
                                <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete-resource-{{$user->id}}">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $users->links() }}
            </div>

        @endif
    </div>
@endsection
