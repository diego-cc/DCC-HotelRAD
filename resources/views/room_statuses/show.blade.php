@extends('layouts.app')
@section('title')
    Room statuses: Read
@endsection

@section('styles')
    <link href="/css/rates/show.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Viewing details of a room status with ID: {{$roomStatus->id}}</h1>

        <div class="container">
            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">ID:</p>
                <p class="font-weight-bolder">{{$roomStatus->id}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Name:</p>
                <p class="font-weight-bold">{{$roomStatus->name}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Description:</p>
                <p>{{$roomStatus->description}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Date created:</p>
                <p>{{\Carbon\Carbon::parse($roomStatus->created_at)->isoFormat('LLLL')}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center mb-4">
                <p class="mr-2">Date updated:</p>
                <p>
                    {{$roomStatus->updated_at ? \Carbon\Carbon::parse($roomStatus->updated_at)->isoFormat('LLLL') : 'Never'}}
                </p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <a href="{{route('room_statuses.edit', $roomStatus)}}" class="btn btn-warning mr-5">Edit</a>

                @includeIf('utils.delete', ['type' => 'roomStatus', 'resource'=> $roomStatus])
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete-resource-{{$roomStatus->id}}">
                    Delete
                </button>
            </div>

            <div class="d-flex justify-content-center _browse-all-btn">
                <a href="{{route('room_statuses.index')}}" class="text-info h5">Browse all room statuses</a>
            </div>
        </div>
    </div>
@endsection
