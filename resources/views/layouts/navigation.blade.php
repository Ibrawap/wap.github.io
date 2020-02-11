<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-2">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name') }}
      {{-- <img src="{{ asset('images/logo-white.png') }}" alt="" width="150" class="mb-2"> --}}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('posts.index') }}">
            <i class="fa fa-comment"></i> {{ __('Forum') }}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('songs.index') }}">
            <i class="fa fa-music"></i> {{ __('Songs') }}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('albums.index') }}">
            <i class="fa fa-file-audio"></i> {{ __('Albums') }}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('videos.index') }}">
            <i class="fa fa-video"></i> {{ __('Videos') }}
          </a>
        </li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> {{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <img src="{{ Auth::user()->avatar }}" class="avatar img-fluid rounded-circle mr-1" alt=" {{ auth()->user()->username }}" />
            {{ Auth::user()->username }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('home') }}">
              <i class="fas fa-user"></i> {{ __('Dashboard') }}
            </a>
            <a class="dropdown-item" href="{{ route('user.profile.edit', auth()->id()) }}">
              <i class="fas fa-cog"></i> {{ __('Settings') }}
            </a>


            @if(Auth::user()->isAdmin())
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('post_categories.index') }}">
              <i class="fas fa-comment"></i> {{ __('Post category') }}
            </a>
            <a class="dropdown-item" href="{{ route('song_categories.index') }}">
              <i class="fas fa-music"></i> {{ __('Song category') }}
            </a>
            <a class="dropdown-item" href="{{ route('video_categories.index') }}">
              <i class="fas fa-video"></i> {{ __('Video category') }}
            </a>
            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fas fa-power-off"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>