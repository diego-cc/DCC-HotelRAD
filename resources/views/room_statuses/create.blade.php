@extends('layouts.app')
@section('title')
    Room statuses: Add
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Add a new room status</h1>

        <form action="{{route('room_statuses.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Status name <span class="text-danger">*</span> (maximum 16 characters)</label>
                <input
                    required="required"
                    type="text"
                    class="form-control form-control-lg"
                    id="name"
                    name="name"
                    placeholder="Status name..."
                    maxlength="16"
                    value="{{old('name')}}"
                />

                @error('name')
                    <p class="text-danger">{{$errors->first('name')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description <span class="text-danger">*</span> (maximum 255 characters)</label>
                <textarea
                    required="required"
                    name="description"
                    class="form-control"
                    id="description"
                    rows="10"
                    placeholder="Room status description..."
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
            <a class="text-info h5" href="{{route('room_statuses.index')}}">
                Browse all room statuses
            </a>
        </div>
    </div>
@endsection
