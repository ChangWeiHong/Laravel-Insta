<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="app-shell">
        <nav class="navbar navbar-expand-md app-topbar">
            <div class="container app-container">
                <a class="navbar-brand brand-lockup" href="{{ url('/') }}">
                    <span class="brand-mark"><img src="/icon/logo.svg" alt="first_Project"></span>
                    <span>first_Project</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                        <form class="app-search mx-auto my-3 my-md-0" action="{{ route('profiles.search') }}" method="GET">
                            <i class="bi bi-search"></i>
                            <input type="search" name="q" value="{{ request('q') }}" aria-label="Search" placeholder="Search creators">
                        </form>
                    @endauth

                    <ul class="navbar-nav ms-auto align-items-md-center gap-md-1">
                        @guest
                            <li class="nav-item">
                                <a class="nav-action" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>{{ __('Login') }}</span>
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-app-primary ms-md-2" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-action" href="{{ url('/') }}">
                                    <i class="bi bi-house-door"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-action" href="{{ url('/p/create') }}">
                                    <i class="bi bi-plus-square"></i>
                                    <span>Create</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-action" href="{{ route('profile.index', Auth::user()) }}">
                                    <i class="bi bi-person-circle"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-action dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="app-main">
            @yield('content')
        </main>
    </div>
</body>
</html>
