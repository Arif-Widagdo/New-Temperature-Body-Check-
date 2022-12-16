 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('**/dashboard') ? 'active' : '' }}">{{ __("Dashboard") }}</a>
        </li>
         @if(Auth::user()->position->name === 'Admin')
        <li class="nav-item d-none d-md-inline-block">
          <a href="{{ route('positions.index') }}" class="nav-link {{ request()->is('admin/positions') ||  request()->is('admin/positions/**') ? 'active' : '' }}">{{ __('User Positions') }}</a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">{{ __('Users Management') }}</a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
          <a href="{{ route('presences.index') }}" class="nav-link {{ request()->is('admin/presences') ? 'active' : '' }}">{{ __('User Attendance') }}</a>
        </li>
        @endif
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Languange Dropdown Menu -->
         <li class="nav-item dropdown mr-2">
             <a class="nav-link d-flex align-items-center justify-content-between border btn bg-info px-2" data-toggle="dropdown" href="#">
                @if(app()->getLocale()=='id')
                <img src="{{ asset('dist/img/icon/id.png') }}" alt="user-image" width="18" height="18"style="box-shadow: 1px 1px 1px #37373a, -1px 0px 0px #7e7e7e; border-radius:100%; " class="mr-2">
                <span class="mr-2 text-bold">{{ __('Indonesian') }}</span>
                @else
                <img src="{{ asset('dist/img/icon/en.png') }}" alt="user-image" width="18" height="18"style="box-shadow: 1px 1px 1px #37373a, -1px 0px 0px #7e7e7e; border-radius:100%; " class="mr-2">
                <span class="mr-2 text-bold">{{ __('English') }}</span>
                @endif
                <span><i class="fas fa-angle-down"></i></span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-header text-left text-light">{{ __('Language') }}</span>
                 <div class="dropdown-divider"></div>
                 <a href="{{ url('locale/id') }}" class="dropdown-item">
                     <i class="fas fa-globe mr-2"></i> {{ __('Indonesian') }}
                     @if(app()->getLocale()=='id')
                     <span class="float-right text-sm badge badge-danger">{{ __('Active') }}</span>
                     @endif
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="{{ url('locale/en') }}" class="dropdown-item">
                     <i class="fas fa-globe mr-2"></i> {{ __('English') }}
                     @if(app()->getLocale()=='en')
                     <span class="float-right text-sm badge badge-danger">{{ __('Active') }}</span>
                     @endif
                 </a>
             </div>
         </li>
         <!-- Auth Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link d-flex align-items-center justify-content-between border btn btn bg-info px-2" data-toggle="dropdown" href="#">
                <span class="mr-2 user_name text-bold">{{ Auth::User()->name }} </span>
                <span><i class="fas fa-angle-down"></i></span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="{{ route('profile.edit') }}" class="dropdown-item dropdown-header text-left d-flex align-items-center">
                     <img src="{{ Auth::user()->picture }}" alt="" width="50"
                         class="img-circle elevation-2 user_picture">
                     <ul style="list-style-type: none; margin-left:-25px;">
                         <li class="name_user">
                             <p>{{ Auth::user()->name }}</p>
                         </li>
                         <li>
                             <p>{{ Auth::user()->email }}</p>
                         </li>
                     </ul>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="{{ route('profile.edit') }}" class="dropdown-item">
                     <i class="fas fa-cogs mr-2" style="width: 20px; height:20px"></i> {{ __('Settings Account') }}
                 </a>
                 <div class="dropdown-divider"></div>
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer text-left"
                         onclick="event.preventDefault(); this.closest('form').submit();">
                         <i class="fas fa-sign-out-alt mr-2" style="width: 20px; height:20px"></i> {{ __('Log Out') }}
                     </a>
                 </form>
             </div>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->