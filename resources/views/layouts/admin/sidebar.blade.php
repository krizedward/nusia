  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
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
        @if(Auth::user()->level == 'student')
          <li class="header">MAIN NAVIGATION</li>

          <li class="{{ (Request::path() == 'home') ? 'active' : '' }}">
            <a href="{{ url('/home')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="{{ (Request::path() == 'schedule/'.Auth::user()->id)  ? 'active' : '' }}">
            <a href="{{ url('/schedule/'.Auth::user()->id) }}">
              <i class="fa fa-th-large"></i> <span>Schedule</span>
            </a>
          </li>

          <li class="{{ (Request::path() == 'instructors') ? 'active' : '' }}">
            <a href="{{ url('/instructors/') }}">
              <i class="fa fa-users"></i> <span>Instructor</span>
            </a>
          </li>

          <!-- 
          <li class="treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Learning</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('/student/learning/resource') }}"><i class="fa fa-circle-o"></i> Resource</a></li>
              <li><a href="{{ url('/student/learning/assignments') }}"><i class="fa fa-circle-o"></i> Assignments</a></li>
              <li><a href="{{ url('/student/learning/share-material') }}"><i class="fa fa-circle-o"></i> Share Material</a></li>
            </ul>
          </li>  -->

        @elseif(Auth::user()->level == 'instructor')
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="{{ url('/dashboard')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/instructor/schedule/')}}">
              <i class="fa fa-list-alt"></i> <span>Schedule</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/instructor/session/')}}">
              <i class="fa fa-th-large"></i> <span>Session</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/instructor/performance/')}}">
              <i class="ion ion-pie-graph"></i> <span>Performance</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>
        @else
          <li class="header">MAIN NAVIGATION</li>
        
          <li>
            <a href="{{ url('/dashboard')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/admin/tutorial')}}">
              <i class="fa fa-book"> </i><span>Tutorial</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/admin/teacher')}}">
              <i class="fa fa-user"> </i><span>Teacher</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/admin/student')}}">
              <i class="fa fa-users"> </i><span>Student</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>
        
          <li class="header">LEARNING NAVIGATION</li>

          <li>
            <a href="{{ url('/admin/booking')}}">
              <i class="fa fa-book"> </i><span>Booking</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/admin/schedule')}}">
              <i class="fa fa-table"> </i><span>Schedule</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{ url('/admin/payment')}}">
              <i class="fa fa-table"> </i><span>Payment</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>
        @endif
        

      </ul>
    </section>
    <!-- /.sidebar -->