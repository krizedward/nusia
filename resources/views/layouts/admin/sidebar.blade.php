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
          
          <li class="header">MAIN NAVIGATION</li>

          <li class="{{ (Request::path() == 'home') ? 'active' : '' }}">
            <a href="{{ url('/home')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

        @if(Auth::user()->level == 'student')

           
          <li class="{{ set_active('schedule.index') }}">
            <a href="{{ route('schedule.index',Auth::user()->id) }}">
              <i class="fa fa-th-large"></i> <span>Schedule</span>
            </a>
          </li> 
          
          <li class="{{ set_active('classroom.index') }}">
            <a href="{{ url('/classroom') }}">
              <i class="fa fa-home"></i> <span>Classroom</span>
            </a>
          </li>

          <li class="{{ set_active('instructors.index') }}">
            <a href="{{ route('instructors.index') }}">
              <i class="fa fa-users"></i> <span>Instructor</span>
            </a>
          </li>

          <li class="{{ set_active(['material.index','material.student']) }}">
            <a href="{{ url('/material') }}">
              <i class="fa fa-book"></i> <span>Material</span>
            </a>
          </li>

          <li class="{{ set_active('calendar.index') }}">
            <a href="{{ route('calendar.index') }}">
              <i class="fa fa-calendar"></i> <span>Calendar</span>
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
          <!-- 
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