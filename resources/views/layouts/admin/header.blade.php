  <!-- Logo -->
    <a href="{{ route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Nusantara</b> Indonesia</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="{{ route('contact') }}" class="dropdown-toggle">
              <i class="fa fa-envelope-o"></i>
            </a>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You don't have notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(Auth::user()->roles == 'Student')
              <img src="{{ asset('uploads/student/profile/'. Auth::user()->image_profile) }}" class="user-image" alt="User Image">
              @elseif(Auth::user()->roles == 'Instructor')
              <img src="{{ asset('uploads/instructor/'. Auth::user()->image_profile) }}" class="user-image" alt="User Image">
              @else
              <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  @if(Auth::user()->roles == 'Student')
                      <img src="{{ asset('uploads/student/profile/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                  @elseif(Auth::user()->roles == 'Instructor')
                      <img src="{{ asset('uploads/instructor/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                  @else
                      <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">
                  @endif
                <p>
                  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} - {{ Auth::user()->roles }}
                  <small>Joined {{ \Carbon\Carbon::parse(Auth::user()->created_at)->setTimezone(Auth::user()->timezone) }} {{ \Carbon\Carbon::parse(Auth::user()->created_at)->setTimezone(Auth::user()->timezone)->tzName }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('profile',Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-default btn-flat">Sign out</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
