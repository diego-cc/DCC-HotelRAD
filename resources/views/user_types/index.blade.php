@extends('layouts.app')
@section('title')
    User types: browse
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center mb-5">All user types</h1>

        <div class="text-center mb-5">
            <a href="{{route('user_types.create')}}" class="btn btn-lg btn-primary">Add a new user type</a>
        </div>

        @if (count($userTypes) < 1)
            <p class="lead text-center">No user types available</p>
        @endif

        @if (count($userTypes) > 0)
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Icon</th>
                    <th class="text-center" scope="col">Type</th>
                    <th class="text-center" scope="col">Description</th>
                    <th class="text-center" scope="col">Date created</th>
                    <th class="text-center" scope="col">Date updated</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userTypes as $ut)
                    <tr>
                        <th class="text-center" scope="row">{{$ut->id}}</th>
                        <td class="text-center">
                            @if ($ut->icon)
                                <img src="/{{$ut->icon}}" alt="{{$ut->type}}" style="max-width: 100px;" />
                            @else
                            Unavailable
                            @endif
                        </td>
                        <td class="text-center font-weight-bold">{{$ut->type}}</td>
                        <td class="text-center">{{$ut->description ?? 'Unavailable'}}</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($ut->created_at)->isoFormat('LLLL')}}</td>
                        <td class="text-center">{{$ut->updated_at ? \Carbon\Carbon::parse($ut->updated_at)->isoFormat('LLLL') : 'Never'}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('user_types.show', $ut->id)}}" class="btn btn-info mr-4">View</a>
                                <a href="{{route('user_types.edit', $ut->id)}}" class="btn btn-warning mr-4">Edit</a>
                                @if (trim(strtolower($ut->type)) !== 'administrator')
                                @includeIf('utils.delete', ['resource' => $ut, 'type' => 'userType'])
                                <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete-resource-{{$ut->id}}">Delete
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $userTypes->links() }}
            </div>

        @endif
    </div>
@endsection
