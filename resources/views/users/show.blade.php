@extends('layouts.app')
@section('title')
    Users: Read
@endsection

@section('styles')
    <link href="/css/users/show.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Viewing details of a user with ID: {{$user->id}}</h1>

        <div class="container">
            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">ID:</p>
                <p class="font-weight-bolder">{{$user->id}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Name:</p>
                <p class="font-weight-bold text-info">{{$user->name}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Type:</p>
                <p class="{{trim(strtolower($user->type)) === 'administrator' ? 'font-weight-bold text-danger' : ''}}">{{$user->type}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Email:</p>
                <p>{{$user->email}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Email verified at:</p>
                <p>
                    {{$user->email_verified_at ? \Carbon\Carbon::parse($user->email_verified_at)->isoFormat('LLLL') : 'Never'}}
                </p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Date created:</p>
                <p>{{\Carbon\Carbon::parse($user->created_at)->isoFormat('LLLL')}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center mb-4">
                <p class="mr-2">Date updated:</p>
                <p>
                    {{$user->updated_at ? \Carbon\Carbon::parse($user->updated_at)->isoFormat('LLLL') : 'Never'}}
                </p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <a href="{{route('users.edit_type', $user)}}" class="btn btn-warning mr-5">Change type</a>

                @includeIf('utils.delete', ['resource' => $user, 'type' => 'user'])
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete-resource-{{$user->id}}">Delete
                </button>
            </div>

            <div class="d-flex justify-content-center _browse-all-btn mt-5">
                <a href="{{route('users.index')}}" class="text-info h5">Browse all users</a>
            </div>
        </div>
    </div>
@endsection
