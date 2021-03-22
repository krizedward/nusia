  <!-- Logo -->
    <a href="{{ route('registered.dashboard.index') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!--span class="logo-mini"><b>N</b></span-->
      <span class="logo-mini"><img src="{{ asset('header.ico') }}" alt="Header"></span>
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
          <!-- Chat: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="{{ route('registered.chat.index') }}" class="dropdown-toggle">
              <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;Chat
              <span class="sr-only">Toggle chat features</span>
            </a>
          </li>
          {{--
          <!-- Contact: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="{{ route('registered.contact.index') }}" class="dropdown-toggle">
              <i class="fa fa-question-circle-o"></i>
              <span class="sr-only">Toggle contact features</span>
            </a>
          </li>
          --}}
          {{--
          <!-- Notification: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="sr-only">Toggle notification features</span>
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
          --}}
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(Auth::user()->roles == 'Student' && Auth::user()->image_profile != 'user.jpg')
              <img src="{{ asset('uploads/student/profile/'. Auth::user()->image_profile) }}" class="user-image" alt="User Image">
              @elseif(Auth::user()->roles == 'Instructor' && Auth::user()->image_profile != 'user.jpg')
              <img src="{{ asset('uploads/instructor/'. Auth::user()->image_profile) }}" class="user-image" alt="User Image">
              @else
              <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  @if(Auth::user()->roles == 'Student' && Auth::user()->image_profile != 'user.jpg')
                      <img src="{{ asset('uploads/student/profile/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                  @elseif(Auth::user()->roles == 'Instructor' && Auth::user()->image_profile != 'user.jpg')
                      <img src="{{ asset('uploads/instructor/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                  @else
                      <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">
                  @endif
                <p>
                  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} - {{ Auth::user()->roles }}
                  <small>Joined {{ \Carbon\Carbon::parse(Auth::user()->created_at)->setTimezone(Auth::user()->timezone)->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('registered.profile.index') }}" class="btn btn-default btn-flat">Profile</a>
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
