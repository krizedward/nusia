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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
            </a>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} - {{ Auth::user()->roles }}
                  <small>{{ Auth::user()->created_at }}&nbsp;&nbsp;UTC+0</small>
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
