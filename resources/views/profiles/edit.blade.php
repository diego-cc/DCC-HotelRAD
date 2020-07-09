<?php
/**********************************************************
 * Package: ${PACKAGE_NAME}
 * Project: dcc-hotelrad
 * File: edit.blade.php
 * Author: Diego <20026893@tafe.wa.edu.au>
 * Date: 2020-07-08
 * Version: 1.0.0
 * Description: add short description of file's purpose
 **********************************************************/

?>
@extends('layouts.app')
@section('title')
    Profiles: Edit
@endsection
@section('content')
    @if (session('msg'))
        @php
            $type = 'success';
            $msg = session('msg')
        @endphp
        @includeIf('utils.alert', compact('msg', 'type'))
    @endif

    <div class="container">
        <h1 class="text-center mb-5">Profile details: {{$profile->user->name}}</h1>

        <form action="{{route('profiles.update', $profile)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="user_id" value="{{$profile->user_id}}">
            <div class="form-group text-center" id="pic-container">
                <div class="mb-4">
                    <label for="pic">Current profile picture: {{isset($profile->pic) ? '' : 'None'}}</label>
                </div>

                <div id="current-pic-container" class="mb-5">
                    <img id="pic-img" src="{{$profile->pic ? '/'.$profile->pic : ''}}" alt="{{$profile->pic}}" style="max-width: 300px;"
                         class="mb-4"/>
                    <div id="remove-pic-btn-container">
                        <a href="#" class="btn btn-danger" id="remove-pic">Remove profile picture</a>
                    </div>
                </div>

                <input type="file" name="pic" id="pic" placeholder="Choose an profile picture..." class="mb-4"/>

                <div id="new-pic-container" style="display: none;">
                    <div>
                        <label for="new-pic">New profile picture:</label>
                    </div>

                    <div>
                        <img id="new-pic" src="/{{$profile->pic}}" alt="{{$profile->pic}}" style="max-width: 300px;"
                             class="mb-4"/>
                    </div>
                </div>

                @error('pic')
                <p class="text-danger">{{$errors->first('pic')}}</p>
                @enderror
            </div>

            <div class="form-group text-center mb-4">
                <label for="given_name">Given name</label>
                <input
                    type="text"
                    maxlength="128"
                    id="given_name"
                    name="given_name"
                    placeholder="Given name..."
                    class="form-control"
                    value="{{$profile->given_name}}"
                >

                @error('given_name')
                <p class="text-danger">{{$errors->first('given_name')}}</p>
                @enderror
            </div>

            <div class="form-group text-center">
                <label for="family_name">Family name</label>
                <input
                    type="text"
                    maxlength="128"
                    id="family_name"
                    name="family_name"
                    placeholder="Family name..."
                    class="form-control"
                    value="{{$profile->family_name}}"
                >

                @error('family_name')
                <p class="text-danger">{{$errors->first('family_name')}}</p>
                @enderror
            </div>

            <div class="form-group text-center">
                <label for="dob">Date of birth</label>
                <input
                    type="date"
                    id="dob"
                    name="dob"
                    class="form-control"
                    value="{{$profile->dob}}"
                >

                @error('dob')
                <p class="text-danger">{{$errors->first('dob')}}</p>
                @enderror
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button class="btn btn-lg btn-warning mx-5" id="restore">
                    Restore
                </button>
                <button class="btn btn-lg btn-primary" type="submit">
                    Save changes
                </button>
            </div>


        </form>
    </div>
@endsection
@section('scripts')
    <script src="/js/handle-pics.js"></script>
@endsection
