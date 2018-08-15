<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ app()->version() }}</title>
    <link rel="stylesheet" href="https://dansup.github.io/bulma-templates/css/hero.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .left-paddingless{padding-left: 0px !important;}
        .right-paddingless{padding-right: 0px !important;}
        .left-sidebar {
            border-right: 1px solid #d7dadb;
        }
        .sidebar-menu-profile .card .card-content figure {margin:0 auto;}
        .sidebar-menu-profile .card .card-content .content {text-align: center;}
        .sidebar-menu-profile .card .card-content {padding: 0.8rem;}
        .sidebar-menu-item {
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="columns">
    <div class="column is-2 has-background-white left-sidebar right-paddingless">
        <aside class="menu">
            <nav class="navbar is-transparent sidebar-menu">
                <div class="navbar-brand">
                    <a class="navbar-item" href="https://bulma.io">
                        <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
                    </a>
                    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </nav>
            <div class="sidebar-menu-profile">
                <div class="card">
                    <div class="card-content">
                        <figure class="image is-96x96">
                            <img class="is-rounded" src="https://bulma.io/images/placeholders/96x96.png">
                        </figure>
                        <div class="content">
                            <h3>Sujit Baniya</h3>
                            <a href="#">@bulmaio</a>. <a href="#">#css</a> <a href="#">#responsive</a>
                            <br>
                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                        </div>
                    </div>
                </div>

            </div>
            <div class="sidebar-menu-item">
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
            </div>
        </aside>
    </div>
    <div class="column is-10 left-paddingless">
        <section class="header is-info is-medium is-bold" >
            <nav class="navbar is-transparent">
                <div id="navbarExampleTransparentExample" class="navbar-menu">


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
            </nav>
        </section>
        <section class="box cta is-shady">
            <p class="has-text-centered">
                <span class="tag is-primary">New</span> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea commodo consequat.
            </p>
        </section>
        <section class="container is-fluid">
            <div>
                <div class="columns features">
                    <div class="column is-4">
                        <div class="card is-shady">
                            <div class="card-image has-text-centered">
                                <i class="fa fa-paw"></i>
                            </div>
                            <div class="card-content">
                                <div class="content">
                                    <h4>Tristique senectus et netus et. </h4>
                                    <p>Purus semper eget duis at tellus at urna condimentum mattis. Non blandit massa enim nec.
                                        Integer enim neque volutpat ac tincidunt vitae semper quis. Accumsan tortor posuere ac ut
                                        consequat semper viverra nam.</p>
                                    <p><a href="#">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="card is-shady">
                            <div class="card-image has-text-centered">
                                <i class="fa fa-empire"></i>
                            </div>
                            <div class="card-content">
                                <div class="content">
                                    <h4>Tempor orci dapibus ultrices in.</h4>
                                    <p>Ut venenatis tellus in metus vulputate. Amet consectetur adipiscing elit pellentesque. Sed
                                        arcu non odio euismod lacinia at quis risus. Faucibus turpis in eu mi bibendum neque egestas
                                        cmonsu songue. Phasellus vestibulum lorem
                                        sed risus.</p>
                                    <p><a href="#">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="card is-shady">
                            <div class="card-image has-text-centered">
                                <i class="fa fa-apple"></i>
                            </div>
                            <div class="card-content">
                                <div class="content">
                                    <h4> Leo integer malesuada nunc vel risus. </h4>
                                    <p>Imperdiet dui accumsan sit amet nulla facilisi morbi. Fusce ut placerat orci nulla
                                        pellentesque dignissim enim. Libero id faucibus nisl tincidunt eget nullam. Commodo viverra
                                        maecenas accumsan lacus vel facilisis.</p>
                                    <p><a href="#">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro column is-8 is-offset-2">
                    <h2 class="title">Perfect for developers or designers!</h2><br>
                    <p class="subtitle">Vel fringilla est ullamcorper eget nulla facilisi. Nulla facilisi nullam vehicula ipsum a.
                        Neque egestas congue quisque egestas diam in arcu cursus.</p>
                </div>
                <div class="sandbox">
                    <div class="tile is-ancestor">
                        <div class="tile is-parent is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Hello World</p>
                                <p class="subtitle">What is up?</p>
                            </article>
                        </div>
                        <div class="tile is-parent is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Foo</p>
                                <p class="subtitle">Bar</p>
                            </article>
                        </div>
                        <div class="tile is-parent is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Third column</p>
                                <p class="subtitle">With some content</p>
                                <div class="content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                        pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat
                                        facilisis.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-ancestor">
                        <div class="tile is-vertical is-8">
                            <div class="tile">
                                <div class="tile is-parent is-vertical">
                                    <article class="tile is-child notification is-white">
                                        <p class="title">Vertical tiles</p>
                                        <p class="subtitle">Top box</p>
                                    </article>
                                    <article class="tile is-child notification is-white">
                                        <p class="title">Vertical tiles</p>
                                        <p class="subtitle">Bottom box</p>
                                    </article>
                                </div>
                                <div class="tile is-parent">
                                    <article class="tile is-child notification is-white">
                                        <p class="title">Middle box</p>
                                        <p class="subtitle">With an image</p>
                                        <figure class="image is-4by3">
                                            <img src="https://picsum.photos/640/480/?random" alt="Description">
                                        </figure>
                                    </article>
                                </div>
                            </div>
                            <div class="tile is-parent is-shady">
                                <article class="tile is-child notification is-white">
                                    <p class="title">Wide column</p>
                                    <p class="subtitle">Aligned with the right column</p>
                                    <div class="content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                            pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis
                                            feugiat facilisis.</p>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="tile is-parent is-shady">
                            <article class="tile is-child notification is-white">
                                <div class="content">
                                    <p class="title">Tall column</p>
                                    <p class="subtitle">With even more content</p>
                                    <div class="content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat
                                            pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida
                                            libero rhoncus ut. Morbi maximus, leo sit amet vehicula
                                            eleifend, nunc dui porta orci, quis semper odio felis ut quam.</p>
                                        <p>Suspendisse varius ligula in molestie lacinia. Maecenas varius eget ligula a sagittis.
                                            Pellentesque interdum, nisl nec interdum maximus, augue diam porttitor lorem, et
                                            sollicitudin felis neque sit amet erat. Maecenas imperdiet
                                            felis nisi, fringilla luctus felis hendrerit sit amet. Aenean vitae gravida diam,
                                            finibus dignissim turpis. Sed eget varius ligula, at volutpat tortor.</p>
                                        <p>Integer sollicitudin, tortor a mattis commodo, velit urna rhoncus erat, vitae congue
                                            lectus dolor consequat libero. Donec leo ligula, maximus et pellentesque sed, gravida a
                                            metus. Cras ullamcorper a nunc ac porta. Aliquam
                                            ut aliquet lacus, quis faucibus libero. Quisque non semper leo.</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-ancestor">
                        <div class="tile is-parent is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Side column</p>
                                <p class="subtitle">With some content</p>
                                <div class="content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                        pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat
                                        facilisis.</p>
                                </div>
                            </article>
                        </div>
                        <div class="tile is-parent is-8 is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Main column</p>
                                <p class="subtitle">With some content</p>
                                <div class="content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                        pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat
                                        facilisis.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-ancestor">
                        <div class="tile is-parent is-8 is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Murphy's law</p>
                                <p class="subtitle">Anything that can go wrong will go wrong</p>
                                <div class="content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                        pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat
                                        facilisis.</p>
                                </div>
                            </article>
                        </div>
                        <div class="tile is-parent is-shady">
                            <article class="tile is-child notification is-white">
                                <p class="title">Main column</p>
                                <p class="subtitle">With some content</p>
                                <div class="content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                        pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat
                                        facilisis.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer">
            <div class="container">
                <div class="columns">
                    <div class="column is-3 is-offset-2">
                        <h2><strong>Category</strong></h2>
                        <ul>
                            <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                            <li><a href="#">Vestibulum errato isse</a></li>
                            <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                            <li><a href="#">Aisia caisia</a></li>
                            <li><a href="#">Murphy's law</a></li>
                            <li><a href="#">Flimsy Lavenrock</a></li>
                            <li><a href="#">Maven Mousie Lavender</a></li>
                        </ul>
                    </div>
                    <div class="column is-3">
                        <h2><strong>Category</strong></h2>
                        <ul>
                            <li><a href="#">Labore et dolore magna aliqua</a></li>
                            <li><a href="#">Kanban airis sum eschelor</a></li>
                            <li><a href="#">Modular modern free</a></li>
                            <li><a href="#">The king of clubs</a></li>
                            <li><a href="#">The Discovery Dissipation</a></li>
                            <li><a href="#">Course Correction</a></li>
                            <li><a href="#">Better Angels</a></li>
                        </ul>
                    </div>
                    <div class="column is-4">
                        <h2><strong>Category</strong></h2>
                        <ul>
                            <li><a href="#">Objects in space</a></li>
                            <li><a href="#">Playing cards with coyote</a></li>
                            <li><a href="#">Goodbye Yellow Brick Road</a></li>
                            <li><a href="#">The Garden of Forking Paths</a></li>
                            <li><a href="#">Future Shock</a></li>
                        </ul>
                    </div>
                </div>
                <div class="content has-text-centered">
                    <p>
                        <a class="icon" href="https://github.com/dansup/bulma-templates">
                            <i class="fa fa-github"></i>
                        </a>
                    </p>
                    <div class="control level-item">
                        <a href="https://github.com/dansup/bulma-templates">
                            <div class="tags has-addons">
                                <span class="tag is-dark">Bulma Templates</span>
                                <span class="tag is-info">MIT license</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="app"></div>
        </section>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
