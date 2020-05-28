@extends('layouts.app')
@section('title')
    Feedback subjects: Add
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Add a new feedback subject</h1>

        <form action="{{route('feedback_subjects.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="subject">Subject <span class="text-danger">*</span> (maximum 24 characters)</label>
                <input
                    required="required"
                    type="text"
                    class="form-control form-control-lg"
                    id="subject"
                    name="subject"
                    placeholder="Subject"
                    max="24"
                    value="{{old('subject')}}"
                />

                @error('subject')
                    <p class="text-danger">{{$errors->first('subject')}}</p>
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
                    placeholder="Feedback subject description..."
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
            <a class="text-info h5" href="{{route('feedback_subjects.index')}}">
                Browse all feedback subjects
            </a>
        </div>
    </div>
@endsection
