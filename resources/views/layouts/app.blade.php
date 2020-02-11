<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Welcome') | {{ config('app.name') }}</title>
    @yield('meta', @include('meta::manager'))
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="d-flex flex-column h-100">
    <div id="app">
        @include('layouts.navigation')
        
            <main role="main" class="flex-shrink-0">
               @yield('content')
            </main>
            
        @include('layouts.footer')
        </div>
    @include('partials.toastr-alert')
    <script>
      window.__auth = () => {
        try {
          return JSON.parse('{!! auth()->user() !!}')
        } catch(error) {
          return null
        }
      }
      window.__url = '{{ config('app.url') }}'
    </script>
    @yield('scripts')
</body>
</html>
