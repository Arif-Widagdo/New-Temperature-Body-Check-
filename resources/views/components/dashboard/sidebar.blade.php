<aside class="main-sidebar sidebar-dark-info elevation-4" >
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('dist/img/logos/logo.png') }}" alt="Check Temperature Logo" class="brand-image elevation-3" >
      <small class="brand-text font-weight-light text-info" style="font-family: 'Poppins', cursive; font-weight: 700 !important; line-height:0;">{{ __('Temperature Absence') }}</small>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('profile.update') }}" class="d-block name_user">{{ Auth::user()->name }} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @if(Auth::user()->position->name === 'Admin')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('positions.index') }}" class="nav-link {{ request()->is('admin/positions') ||  request()->is('admin/positions/**') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
              {{ __('User Positions') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                {{ __('Users Management') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('presences.index') }}" class="nav-link {{ request()->is('admin/presences') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                {{ __('User Attendance') }}
              </p>
            </a>
          </li>
        </ul>
        @else
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('employe.dashboard') }}" class="nav-link {{ request()->is('employe/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                {{ __('History') }}
              </p>
            </a>
          </li> --}}
        </ul>
        @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>