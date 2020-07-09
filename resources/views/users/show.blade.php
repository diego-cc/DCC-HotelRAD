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

            <div class="d-flex flex-row justify-content-center mb-5">
                <a href="{{route('users.edit_type', $user)}}" class="btn btn-warning">Change type</a>

                @if (trim(strtolower($user->type)) !== 'administrator')
                    @includeIf('utils.delete', ['resource' => $user, 'type' => 'user'])
                    <button class="btn btn-danger ml-5" data-toggle="modal" data-target="#delete-resource-{{$user->id}}">Delete
                    </button>
                @endif
            </div>

            <hr class="mb-5">

            <h2 class="text-center mb-4">Profile</h2>
            <div class="text-center">
                @if(isset($user->profile->pic))
                    <img src="/{{$user->profile->pic}}" alt="Profile picture" style="max-width: 300px;" class="mb-4">
                @endif
                <p class="mb-4">Given name: {{$user->profile->given_name ?? 'Not provided'}}</p>
                <p class="mb-4">Family name: {{$user->profile->family_name ?? 'Not provided'}}</p>
                <p class="mb-4">Date of birth: {{$user->profile->dob ? \Carbon\Carbon::parse($user->profile->dob)->isoFormat('DD/MM/YYYY') : 'Not provided'}}</p>
                <p class="mb-4">Date created: {{\Carbon\Carbon::parse($user->created_at)->isoFormat('LLLL')}}</p>
                <p class="mb-4">Date updated: {{\Carbon\Carbon::parse($user->updated_at)->isoFormat('LLLL')}}</p>

            </div>



            <div class="d-flex justify-content-center _browse-all-btn mt-5">
                <a href="{{route('users.index')}}" class="text-info h5">Browse all users</a>
            </div>
        </div>
    </div>
@endsection
