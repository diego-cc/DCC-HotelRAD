@extends('layouts.app')
@section('title')
   Room statuses: Edit
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Editing a room status with ID: {{$roomStatus->id}}</h1>

        <form action="{{route('room_statuses.update', $roomStatus)}}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="subject">Status name <span class="text-danger">*</span> (maximum 16 characters)</label>
                <input
                    required="required"
                    type="text"
                    class="form-control form-control-lg"
                    id="name"
                    name="name"
                    placeholder="Status name..."
                    maxlength="16"
                    value="{{$roomStatus->name}}"
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
                    maxlength="255">{{$roomStatus->description}}</textarea>

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
