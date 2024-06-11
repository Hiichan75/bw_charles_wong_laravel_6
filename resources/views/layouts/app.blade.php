<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GamerForum')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">GamerForum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('forum.index') }}">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq.index') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">Orders</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.user_messages') }}">My Messages</a>
                </li>

            </ul>
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show', Auth::user()->id) }}">Profile</a>
                </li>
                @if(Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>