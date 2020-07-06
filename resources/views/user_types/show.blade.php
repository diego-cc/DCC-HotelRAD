@extends('layouts.app')
@section('title')
    User types: show
@endsection

@section('styles')
    <link href="/css/rates/show.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Viewing details of a user type with ID: {{$userType->id}}</h1>

        <div class="container">
            @if ($userType->icon)
                <div class="d-flex flex-row justify-content-center mb-4">
                    <img src="/{{$userType->icon}}" alt="{{$userType->type}}" style="max-width: 300px;" />
                </div>
            @endif

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">ID:</p>
                <p class="font-weight-bolder">{{$userType->id}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Type:</p>
                <p class="text-info font-weight-bold">{{$userType->type}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Description:</p>
                <p>{{$userType->description ?? 'Unavailable'}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Date created:</p>
                <p>{{\Carbon\Carbon::parse($userType->created_at)->isoFormat('LLLL')}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center mb-4">
                <p class="mr-2">Date updated:</p>
                <p>
                    {{$userType->updated_at ? \Carbon\Carbon::parse($userType->updated_at)->isoFormat('LLLL') : 'Never'}}
                </p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <a href="{{route('user_types.edit', $userType->id)}}" class="btn btn-warning mr-5">Edit</a>

                @if (trim(strtolower($userType->type)) !== 'administrator')
                    @includeIf('utils.delete', ['resource' => $userType, 'type' => 'userType'])
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete-resource-{{$userType->id}}">Delete
                    </button>
                @endif
            </div>

            <div class="d-flex justify-content-center _browse-all-btn">
                <a href="{{route('user_types.index')}}" class="text-info h5">Browse all user types</a>
            </div>
        </div>
    </div>
@endsection
