<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} {{ app()->version() }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body{background-color: #e6e6e6;}
            .left-paddingless{padding-left: 0px !important;}
            .right-paddingless{padding-right: 0px !important;}
            .right-border {
                border-right: thin solid #dcdcdc;
            }
        </style>
    </head>
    <body>
        <div class="container is-fluid is-marginless">
            <div class="columns">
                <div class="column is-one-fifth right-paddingless right-border">
                    <nav class="navbar has-shadow">
                        <div class="container is-fluid">
                            <div class="navbar-brand">
                                <a href="{{ url('/') }}" class="navbar-item">{{ config('app.name', 'Laravel') }}</a>

                                <div class="navbar-burger burger" data-target="navMenu">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="navbar-end">
                                    <div class="navbar-item">
                                        <button class="button is-default">Test</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <aside class="menu">
                        <p class="menu-label">
                            General
                        </p>
                        <ul class="menu-list">
                            <li><a>Dashboard</a></li>
                            <li><a>Customers</a></li>
                        </ul>
                        <p class="menu-label">
                            Administration
                        </p>
                        <ul class="menu-list">
                            <li><a>Team Settings</a></li>
                            <li>
                                <a class="is-active">Manage Your Team</a>
                                <ul>
                                    <li><a>Members</a></li>
                                    <li><a>Plugins</a></li>
                                    <li><a>Add a member</a></li>
                                </ul>
                            </li>
                            <li><a>Invitations</a></li>
                            <li><a>Cloud Storage Environment Settings</a></li>
                            <li><a>Authentication</a></li>
                        </ul>
                        <p class="menu-label">
                            Transactions
                        </p>
                        <ul class="menu-list">
                            <li><a>Payments</a></li>
                            <li><a>Transfers</a></li>
                            <li><a>Balance</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-four-fifths left-paddingless">
                    <div id="app">
                        <nav class="navbar has-shadow">
                            <div class="container is-fluid">
                                <div class="navbar-menu" id="navMenu">
                                    <div class="navbar-start"></div>

                                    <div class="navbar-end">
                                        @if (Auth::guest())
                                            <a class="navbar-item " href="{{ route('login') }}">Login</a>
                                            <a class="navbar-item " href="{{ route('register') }}">Register</a>
                                        @else
                                            <div class="navbar-item has-dropdown is-hoverable">
                                                <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                                                <div class="navbar-dropdown">
                                                    <a class="navbar-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </nav>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
