<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <b-container>
            <b-navbar toggleable="md" type="dark" variant="info">

                <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

                <b-navbar-brand href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</b-navbar-brand>

                <b-collapse is-nav id="nav_collapse">

                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            <b-nav-item href="{{ route('login') }}">{{ __('Login') }}</b-nav-item>
                            <b-nav-item href="{{ route('register') }}">{{ __('Register') }}</b-nav-item>
                        @else
                            <b-nav-item-dropdown right>
                                <!-- Using button-content slot -->
                                <template slot="button-content">
                                    {{ Auth::user()->name }}
                                </template>
                                <b-dropdown-item href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</b-dropdown-item>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </b-nav-item-dropdown>
                        @endguest
                    </b-navbar-nav>

                </b-collapse>
            </b-navbar>
        </b-container>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
