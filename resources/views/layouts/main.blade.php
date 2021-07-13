<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weblog - @yield('title', 'Main')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        a {
            text-decoration: none;
        }
        .navbar {
            background-color: #563d7c;
        }
        .navbar li.active a, .navbar li a, .navbar li a:hover, .navbar a.navbar-brand {
            color: #ffffff;
        }
        .navbar li a{
            color: #cbbde2;
        }
        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="{{url('/home')}}" class="navbar-brand">WebBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toogle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toogle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item {{(Request::is('/home') ? 'active' : '')}}">
                        <a href="{{url('/home')}}" aria-current="page" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item {{(Request::is('articles/new') ? 'active' : '')}}">
                        <a href="{{url('/articles/new')}}" class="nav-link">New Article</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <a style="color: #ffffff" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Author : {{ session()->get('name') }}</a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li class="dropdown-item"><p class="mb-0">
                        {{ session()->get('email') }} <br> <small>{{ session()->get('name') }}</small>
                    </p></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('signout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        @yield('content')
    </div>

    @section('page-script')
        <script src="{{ mix('js/app.js') }}"></script>
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', (event) => {
                tinymce.init({
                    selector: 'textarea#frm-content',
                    content_css: false,
                    skin: false
                });
            });
        </script>
    @show
</body>
</html>