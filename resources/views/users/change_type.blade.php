@extends('layouts.app')
@section('title')
    Users: Change type
@endsection
@section('content')
    @if (isset($msg))
        @includeIf('utils.alert', compact('msg'))
    @endif
    <div class="container">
        <h1 class="text-center mb-5">Changing type of user with ID: {{$user->id}}</h1>

        <form action="{{route('users.update_type', $user)}}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input
                    required="required"
                    type="text"
                    id="name"
                    name="name"
                    maxlength="32"
                    class="form-control disabled"
                    disabled
                    value="{{$user->name}}"
                />

                @error('name')
                <p class="text-danger">{{$errors->first('name')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required="required"
                    class="form-control disabled"
                    value="{{$user->email}}"
                    disabled
                />

                @error('email')
                <p class="text-danger">{{$errors->first('email')}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="user_type_id">User type <span class="text-danger">*</span></label>

                <select id="user_type_id" name="user_type_id" class="custom-select" required="required">
                    @foreach($userTypes as $ut)
                        @if ($ut->id === $user->user_type_id)
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
