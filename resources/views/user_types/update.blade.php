@extends('layouts.app')
@section('title')
    User types: Edit
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Editing a user type with ID: {{$userType->id}}</h1>

        <form action="{{route('user_types.update', $userType)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" disabled class="disabled font-weight-bold" value="{{$userType->type}}">
            </div>
            <div class="form-group" id="icon-container">
                <div>
                    <label for="icon">Current icon: {{isset($userType->icon) ? '' : 'None'}}</label>
                </div>
                @if(isset($userType->icon))
                    <div>
                        <img id="icon-img" src="/{{$userType->icon}}" alt="{{$userType->icon}}" style="max-width: 300px;" class="mb-4" />
                    </div>
                @endif

                <input type="file" name="icon" id="icon" placeholder="Choose an icon..." class="mb-4" />

                <div id="new-icon-container" style="display: none;">
                    <div>
                        <label for="icon">New icon:</label>
                    </div>

                    <div>
                        <img id="new-icon" src="/{{$userType->icon}}" alt="{{$userType->icon}}" style="max-width: 300px;" class="mb-4" />
                    </div>
                </div>


                @error('icon')
                    <p class="text-danger">{{$errors->first('icon')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description (maximum 255 characters)</label>
                <textarea
                    name="description"
                    class="form-control"
                    id="description"
                    rows="5"
                    placeholder="User type description..."
                    maxlength="255">{{old('description') ?? $userType->description}}</textarea>

                @error('description')
                <p class="text-danger">{{$errors->first('description')}}</p>
                @enderror
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button class="btn btn-lg btn-primary" type="submit">
                    Submit
                </button>
            </div>
        </form>

        <div class="d-flex justify-content-center mt-5">
            <a class="text-info h5" href="{{route('user_types.index')}}">
                Browse all user types
            </a>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        const icon = document.getElementById('icon');
        const newIconContainer = document.getElementById('new-icon-container');
        const newIcon = document.getElementById('new-icon');

        document.addEventListener('DOMContentLoaded', function() {
            icon.addEventListener('change', function(e) {
                if (!e.target.value) {
                    newIcon.setAttribute('src', '');
                    newIcon.setAttribute('alt', '');
                    newIconContainer.style.display = 'none';
                }
                else {
                    const reader = new FileReader();

                    reader.onload = e => {
                        newIcon.setAttribute('src', e.target.result);
                        newIcon.setAttribute('alt', 'New icon');
                        newIconContainer.style.display = 'block';
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
