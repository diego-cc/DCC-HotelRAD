<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (View::hasSection('title'))
            @yield('title')
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if (
                        Auth::user() &&
                        (Auth::user()->user_type_id === \App\UserType::whereRaw('lower(type) LIKE ?', ['%administrator%'])->value('id') ||
                        Auth::user()->user_type_id === \App\UserType::whereRaw('lower(type) LIKE ?', ['%manager%'])->value('id'))
                    )

                    <ul class="navbar-nav mr-auto ml-5">
                        <li
                            class=
                            "nav-item mr-4
                                {{\Illuminate\Support\Facades\Route::currentRouteName() === 'rates.index' ? 'active' : ''}}
                                "
                        >
                            <a class="nav-link" href="{{route('rates.index')}}">Rates</a>
                        </li>
                        <li
                            class="nav-item mr-4
                                {{\Illuminate\Support\Facades\Route::currentRouteName() === 'feedback_subjects.index' ? 'active' : ''}}
                                "
                        >
                            <a class="nav-link" href="{{route('feedback_subjects.index')}}">Feedback Subjects</a>
                        </li>
                        <li
                            class="nav-item mr-4
                                {{\Illuminate\Support\Facades\Route::currentRouteName() === 'room_statuses.index' ? 'active' : ''}}
                                "
                        >
                            <a class="nav-link" href="{{route('room_statuses.index')}}">Room statuses</a>
                        </li>

                        <li
                            class="nav-item mr-4
                                {{\Illuminate\Support\Facades\Route::currentRouteName() === 'user_types.index' ? 'active' : ''}}
                                "
                        >
                            <a class="nav-link" href="{{route('user_types.index')}}">User types</a>
                        </li>

                        <li
                            class="nav-item
                                {{\Illuminate\Support\Facades\Route::currentRouteName() === 'users.index' ? 'active' : ''}}
                                "
                        >
                            <a class="nav-link" href="{{route('users.index')}}">Users</a>
                        </li>
                    </ul>
                @endif


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a
                                    href="{{route('profiles.edit', Auth::user()->id)}}"
                                    class="dropdown-item"
                                >
                                    {{ __('My profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

@if (View::hasSection('scripts'))
   @yield('scripts')
@endif
</body>
</html>
