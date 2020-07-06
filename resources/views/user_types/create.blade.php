@extends('layouts.app')
@section('title')
    User types: Add
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Add a new user type</h1>


        <form action="{{route('user_types.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <div>
                    <p>Icon</p>
                </div>

                <div id="icon-container" class="mb-4" style="display:none;">
                    <img src="" alt="" id="icon-img" style="max-width: 300px; display: block;" />
                </div>

                <input type="file" name="icon" id="icon" placeholder="Choose an icon..." class="mb-4" />

            </div>
            <div class="form-group">
                <label for="type">Type <span class="text-danger">*</span></label>
                <input
                    required="required"
                    type="text"
                    id="type"
                    name="type"
                    maxlength="128"
                    class="form-control"
                    placeholder="User type..."
                    value="{{old('type')}}"
                />

                @error('type')
                <p class="text-danger">{{$errors->first('type')}}</p>
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
                    maxlength="255">{{old('description')}}</textarea>

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
        const iconContainer = document.getElementById('icon-container');
        const iconImg = document.getElementById('icon-img');
        const icon = document.getElementById('icon');

        document.addEventListener('DOMContentLoaded', function() {
            icon.addEventListener('change', function(e) {
                if (!e.target.value) {
                    iconImg.setAttribute('src', '');
                    iconImg.setAttribute('alt', '');
                    iconContainer.style.display = 'none';
                }
                else {
                    const reader = new FileReader();

                    reader.onload = e => {
                        iconImg.setAttribute('src', e.target.result);
                        iconImg.setAttribute('alt', 'New icon');
                        iconContainer.style.display = 'block';
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
