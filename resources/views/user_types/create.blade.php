@extends('layouts.app')
@section('title')
    User types: Add
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Add a new rate</h1>


        <form action="{{route('rates.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="rate">Rate <span class="text-danger">*</span></label>
                <input
                    required="required"
                    type="number"
                    class="form-control form-control-lg"
                    id="rate"
                    name="rate"
                    placeholder="0.00"
                    step="0.01"
                    min="0"
                    max="999999.99"
                    value="{{old('rate')}}"
                />

                @error('rate')
                <p class="text-danger">{{$errors->first('rate')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description <span class="text-danger">*</span> (maximum 48 characters)</label>
                <textarea
                    required="required"
                    name="description"
                    class="form-control"
                    id="description"
                    rows="5"
                    placeholder="Room description..."
                    maxlength="48">{{old('description')}}</textarea>

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
            <a class="text-info h5" href="{{route('rates.index')}}">
                Browse all rates
            </a>
        </div>
    </div>
@endsection
