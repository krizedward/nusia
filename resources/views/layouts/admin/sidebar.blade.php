  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

          <li class="header">MAIN NAVIGATION</li>

          <li class="{{ set_active('home') }}">
            <a href="{{ route('home')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

        @if(Auth::user()->roles == 'Student')
          <!-- Head_Navigasi -->
          <li class="header">STUDENT NAVIGATION</li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i> <span>Registration</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Grup</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i> <span>Course</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Schedule</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Material</a></li>
            </ul>
          </li>

          <li>
            <a href="#">
              <i class="fa fa-money"> </i><span> Payment</span>
            </a>
          </li>

        @elseif(Auth::user()->roles == 'Instructor')
          <!-- Head_Navigasi -->
          <li class="header">INSTRUCTOR NAVIGATION</li>
          
          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar"></i> <span>Schedule</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Grup</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar-check-o"></i> <span>Session</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Grup</a></li>
            </ul>
          </li>

          <li>
            <a href="#">
              <i class="fa fa-archive"> </i><span>Material</span>
            </a>
          </li>

        @elseif(Auth::user()->roles == 'Admin')
          <!-- Head_Navigasi -->
          <li class="header">ADMIN NAVIGATION</li>
          <!-- Navigasi_Menu -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>User</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Student</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Instructor</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i> <span>Registration</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Grup</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar"></i> <span>Schedule</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Grup</a></li>
            </ul>
          </li>

          <li>
            <a href="#">
              <i class="fa fa-archive"> </i><span> Material</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="fa fa-money"> </i><span> Payment</span>
            </a>
          </li>
          <!-- End_Navigasi_Menu -->
        @endif


      </ul>
    </section>
    <!-- /.sidebar -->

        <!-- Old 
          <li class="{{ set_active('classroom.index') }}">
            <a href="#">
              <i class="fa fa-home"></i> <span>Book Now</span>
            </a>
          </li>

          <li class="{{ set_active('schedule') }}">
            <a href="#">
              <i class="fa fa-th-large"></i> <span>Schedule</span>
            </a>
          </li>
          
          <li class="{{ (Request::path() == 'schedule/'.Auth::user()->id)  ? 'active' : '' }}">
            <a href="{{ url('/schedule/'.Auth::user()->id) }}">
              <i class="fa fa-th-large"></i> <span>Schedule</span>
            </a>
          </li>

          <li class="{{ (Request::path() == 'session/'.Auth::user()->id)  ? 'active' : '' }}">
            <a href="{{ url('/session/'.Auth::user()->id) }}">
              <i class="fa fa-user"></i> <span>Session</span>
            </a>
          </li>

          <li class="{{ set_active('material.index') }}">
            <a href="{{ url('/material') }}">
              <i class="fa fa-book"></i> <span>Share Material</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-th-large"></i> <span>Session</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="ion ion-pie-graph"></i> <span>Performance</span>
            </a>
          </li>  -->