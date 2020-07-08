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
    Profiles: Show
@endsection
@section('content')
    @if (isset($msg))
        @php
            $type = 'success';
        @endphp
        @includeIf('utils.alert', compact('msg', 'type'))
    @endif

    <div class="container">
        <h1 class="text-center mb-5">Profile details: {{$profile->user->name}}</h1>

        <form action="{{route('profiles.update', $profile)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group text-center" id="pic-container">
                <div class="mb-4">
                    <label for="pic">Current profile picture: {{isset($profile->pic) ? '' : 'None'}}</label>
                </div>
                @if(isset($profile->pic))
                    <div>
                        <img id="pic-img" src="/{{$profile->pic}}" alt="{{$profile->pic}}" style="max-width: 300px;" class="mb-4" />
                    </div>
                @endif

                <input type="file" name="pic" id="pic" placeholder="Choose an profile picture..." class="mb-4" />

                <div id="new-pic-container" style="display: none;">
                    <div>
                        <label for="new-pic">New profile picture:</label>
                    </div>

                    <div>
                        <img id="new-pic" src="/{{$profile->pic}}" alt="{{$profile->pic}}" style="max-width: 300px;" class="mb-4" />
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
    <script>
        const pic = document.getElementById('pic');
        const picOriginal = pic.value;
        const givenName = document.getElementById('given_name');
        const givenNameOriginal = givenName.value;
        const familyName = document.getElementById('family_name');
        const familyNameOriginal = familyName.value;
        const dob = document.getElementById('dob');
        const dobOriginal = dob.value;

        const newPicContainer = document.getElementById('new-pic-container');
        const newPic = document.getElementById('new-pic');

        document.addEventListener('DOMContentLoaded', function() {
            pic.addEventListener('change', function(e) {
                if (!e.target.value) {
                    newPic.setAttribute('src', '');
                    newPic.setAttribute('alt', '');
                    newPicContainer.style.display = 'none';
                }
                else {
                    const reader = new FileReader();

                    reader.onload = e => {
                        newPic.setAttribute('src', e.target.result);
                        newPic.setAttribute('alt', 'New profile picture');
                        newPicContainer.style.display = 'block';
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        const restore = document.getElementById('restore');

        restore.addEventListener('click', function (e) {
            e.preventDefault();
            pic.value = picOriginal;
            newPic.setAttribute('src', '');
            newPic.setAttribute('alt', '');
            givenName.value = givenNameOriginal;
            familyName.value = familyNameOriginal;
            dob.value = dobOriginal;
        })
    </script>
@endsection
