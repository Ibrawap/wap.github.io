<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('admin/css/classic.css') }}" rel="stylesheet">
    
    <script src="{{ asset('admin/js/settings.js') }}"></script>
  </head>
  <body>
    <div class="wrapper">
      <nav id="sidebar" class="sidebar">
        @include('user.layouts.sidebar')
      </nav>
      <div class="main">
        @include('user.layouts.navbar')
        <main class="content">
          @foreach(['info', 'error', 'success', 'warning'] as $type)
          @if(session()->has($type))
          <div class="alert alert-{{ $type }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon">
              <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
              {{ ucwords(session()->get($type)) }}
            </div>
          </div>
          @endif
          @endforeach
          @yield('content')
        </main>
        <footer class="footer">
          <div class="container-fluid">
            <div class="row text-muted">
              <div class="col-6 text-left">
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <a class="text-muted" href="#">Support</a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-muted" href="#">Help Center</a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-muted" href="#">Privacy</a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-muted" href="#">Terms of Service</a>
                  </li>
                </ul>
              </div>
              <div class="col-6 text-right">
                <p class="mb-0">
                  &copy; 2019 - <a href="index-2.html" class="text-muted">AppStack</a>
                </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="{{ asset('admin/js/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>