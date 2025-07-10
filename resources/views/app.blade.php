<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
     
    @if(app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    
    @stack('styles')
    <style>
    .language-switcher {
        text-align: right;
        padding: 10px;
    }
    .language-switcher a {
        margin: 0 5px;
        text-decoration: none;
    }
    .language-switcher a.active {
        font-weight: bold;
        text-decoration: underline;
    }
    </style>
</head>
<body>
    @include('header')
    
    <div class="container mt-4">
        @yield('content')
    </div>
    
    @include('footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>