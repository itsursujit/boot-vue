<!doctype html>
<html lang="en">
<head>
    <title>Laravel.io</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="wrapper flex">
        <div id="left-wrapper bg-grey p-10" class="w-1/6">
            <div id="logo-block">
                <div id="logo">
                    <a href="#">Logo</a>
                </div>
            </div>
            <div id="profile-block"></div>
            <div id="left-sidebar"></div>
        </div>
        <div id="body-wrapper bg-light" class="w-5/6">
            <div id="head-wrapper container mx-auto">
                <header>
                    <div class="navbar flex">
                        <div class="navbar-start w-1/2">
                            <ul>
                                <li><a href="">Menu Item 1</a></li>
                                <li><a href="">Menu Item 2</a></li>
                                <li><a href="">Menu Item 3</a></li>
                            </ul>
                        </div>
                        <div class="navbar-end w-1/2">
                            <ul>
                                <li><a href="">Menu Item 1</a></li>
                                <li><a href="">Menu Item 2</a></li>
                                <li><a href="">Menu Item 3</a></li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
            <div id="content-wrapper">
                <div class="content-menu"></div>
                <div class="content"></div>
            </div>
            <div id="foot-wrapper"></div>
        </div>
    </div>


</body>
</html>
