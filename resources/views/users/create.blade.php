@extends('layouts.app')
@section('title')
    Users: Add
@endsection
@section('content')
    @if (isset($msg))
        @includeIf('utils.alert', compact('msg'))
    @endif

    <div class="container">
        <h1 class="text-center mb-5">Add a new user</h1>

        <form action="{{route('users.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input
                    required="required"
                    type="text"
                    id="name"
                    name="name"
                    maxlength="32"
                    class="form-control"
                    value="{{old('name')}}"
                />

                @error('name')
                <p class="text-danger">{{$errors->first('name')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="user_type_id">User type <span class="text-danger">*</span></label>

                <select id="user_type_id" name="user_type_id" class="custom-select" required="required">
                    @foreach($userTypes as $ut)
                        @if (old('user_type_id') === $ut->id)
                            <option value="{{$ut->id}}" selected>{{$ut->type}}</option>
                        @else
                            <option value="{{$ut->id}}">{{$ut->type}}</option>
                        @endif
                    @endforeach
                </select>

                @error('user_type_id')
                    <p class="text-danger">{{$errors->first('user_type_id')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required="required"
                    class="form-control"
                    value="{{old('email')}}"
                />

                @error('email')
                <p class="text-danger">{{$errors->first('email')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required="required"
                    class="form-control"
                    minlength="6"
                    maxlength="128"
                    placeholder="******"
                >

                @error('password')
                    <p class="text-danger">{{$errors->first('password')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm password <span class="text-danger">*</span></label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    required="required"
                    class="form-control"
                    minlength="6"
                    maxlength="128"
                    placeholder="******"
                >

                @error('confirm_password')
                    <p class="text-danger">{{$errors->first('confirm_password')}}</p>
                @enderror
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button class="btn btn-lg btn-primary" type="submit">
                    Submit
                </button>
            </div>
        </form>

        <div class="d-flex justify-content-center mt-5">
            <a class="text-info h5" href="{{route('users.index')}}">
                Browse all users
            </a>
        </div>
    </div>
@endsection
