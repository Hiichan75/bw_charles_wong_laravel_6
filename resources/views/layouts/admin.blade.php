<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Admin Panel')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.news.index') }}">Manage News</a></li>
            <li><a href="{{ route('admin.faq.index') }}">Manage FAQ</a></li>
            <li><a href="{{ route('admin.contact.index') }}">Manage Contacts</a></li>
            <li><a href="{{ route('admin.product.index') }}">Manage Products</a></li>
        </ul>
    </nav>
    @yield('content')
</body>
</html>
