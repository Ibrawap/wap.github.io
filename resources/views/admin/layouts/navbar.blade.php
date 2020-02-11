<nav class="navbar navbar-expand navbar-light bg-white">
  <a class="sidebar-toggle d-flex mr-2">
    <i class="hamburger align-self-center"></i>
  </a>
  <div class="navbar-collapse collapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
          {{-- <i class="align-middle" data-feather="settings"></i> --}}
          <img src="{{ Auth::user()->avatar }}" class="avatar img-fluid rounded-circle mr-1" alt=" {{ auth()->user()->username }}" />
        </a>
        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
          <img src="{{ Auth::user()->avatar }}" class="avatar img-fluid rounded-circle mr-1" alt=" {{ auth()->user()->username }}" /> <span class="text-dark">{{ auth()->user()->username }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="/user/settings"><i class="align-middle mr-1" data-feather="settings"></i> Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="log-out"></i>Sign out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>