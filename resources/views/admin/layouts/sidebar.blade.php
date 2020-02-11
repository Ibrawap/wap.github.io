<div class="sidebar-content ">
  <a class="sidebar-brand" href="index-2.html">
    <img alt="logo" src="{{ asset('images/logo-white.png') }}" width="100%">
  </a>
  <ul class="sidebar-nav">
     <li class="sidebar-item active">
      <a href="{{ route('user.dashboard') }}" class="sidebar-link">
        <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="#auth" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Auth</span>
      </a>
      <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Sign In</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign Up</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="pages-reset-password.html">Reset Password</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="pages-404.html">404 Page</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="pages-500.html">500 Page</a></li>
      </ul>
    </li>
    <li class="sidebar-item">
      <a href="#layouts" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle" data-feather="music"></i> <span class="align-middle">Songs</span>
      </a>
      <ul id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('user.songs.index') }}">All</a>
        </li>
      </ul>
    </li>
    <li class="sidebar-item">
      <a href="#documentation" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Documentation</span>
      </a>
      <ul id="documentation" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="docs-introduction.html">Introduction</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="docs-installation.html">Getting Started</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="docs-plugins.html">Plugins</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="docs-changelog.html">Changelog</a></li>
      </ul>
    </li>
  </ul>
</div>