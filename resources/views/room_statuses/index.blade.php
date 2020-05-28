@extends('layouts.app')
@section('title')
    Room statuses: Browse
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center mb-5">All room statuses</h1>

        <div class="text-center mb-5">
            <a href="{{route('room_statuses.create')}}" class="btn btn-lg btn-primary">Add a new room status</a>
        </div>

        @if (count($roomStatuses) < 1)
            <p class="lead text-center">No room statuses available</p>
        @endif

        @if (count($roomStatuses) > 0)
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Description</th>
                    <th class="text-center" scope="col">Date created</th>
                    <th class="text-center" scope="col">Date updated</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roomStatuses as $roomStatus)
                    <tr>
                        <th class="text-center" scope="row">{{$roomStatus->id}}</th>
                        <td class="text-center font-weight-bold">{{$roomStatus->name}}</td>
                        <td class="text-center">{{$roomStatus->description}}</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($roomStatus->created_at)->isoFormat('LLLL')}}</td>
                        <td class="text-center">{{$roomStatus->updated_at ? \Carbon\Carbon::parse($roomStatus->updated_at)->isoFormat('LLLL') : 'Never'}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('room_statuses.show', $roomStatus)}}"
                                   class="btn btn-info mr-4">View</a>
                                <a href="{{route('room_statuses.edit', $roomStatus)}}"
                                   class="btn btn-warning mr-4">Edit</a>
                                @includeIf('utils.delete', ['resource' => $roomStatus, 'type' => 'roomStatus'])
                                <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete-resource-{{$roomStatus->id}}">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
