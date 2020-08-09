<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @if(Auth::user()->roles == 'Student')
                    <p>Student Account</p>
                @endif
                @if(Auth::user()->roles == 'Instructor')
                    <p>Instructor Account</p>
                @endif
                @if(Auth::user()->roles == 'Admin')
                    <p>Admin Account</p>
                @endif
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
                        <i class="fa fa-book"></i> <span>Schedules</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('schedules.index') }}"><i class="fa fa-circle-o"></i> Private</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('schedules.index') }}"><i class="fa fa-circle-o"></i> Group</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Sessions</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Private</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Group</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i> <span>Materials</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('materials.index') }}"><i class="fa fa-circle-o"></i> Private</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('materials.index') }}"><i class="fa fa-circle-o"></i> Group</a>
                        </li>
                        {{--
                        <li class="#">
                            <a href="{{ route('materials.free_trial_index') }}"><i class="fa fa-circle-o"></i> Free Trial</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('materials.private_index') }}"><i class="fa fa-circle-o"></i> Private</a>
                        </li> --}}
                        {{--<li class="#"><a href="{{ route('materials.group_index') }}"><i class="fa fa-circle-o"></i> Group</a></li>--}}
                    </ul>
                </li>

                <!-- Other_Navigasi -->
                <li class="header">OTHER</li>

                <li class="#">
                    <a href="{{ route('instructors.index') }}"><i class="fa fa-users"> </i><span> Nusia Instructors</span></a>
                </li>
            @endif
            {{-- End Student --}}

            @if(Auth::user()->roles == 'Instructor')
                <!-- Head_Navigasi -->
                    <li class="header">INSTRUCTOR NAVIGATION</li>
                    {{--
                    <li class="{{ set_active('course.instructor') }}">
                        <a href="{{ route('course.instructor') }}">
                            <i class="fa fa-book"> </i><span>Course</span>
                        </a>
                    </li>
                    --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-calendar"></i> <span>Schedule</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="#"><a href="{{ route('schedules.index') }}"><i class="fa fa-circle-o"></i> Private</a></li>
                            <li class="#"><a href="{{ route('schedules.index') }}"><i class="fa fa-circle-o"></i> Group</a></li>
                            {{--
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Group</a></li>--}}
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
                            <li class="#"><a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Free Trial</a></li>
                            {{--
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Group</a></li>--}}
                        </ul>
                    </li>

                    <li class="#">
                        <a href="#">
                            <i class="fa fa-archive"> </i><span>Material Instructor</span>
                        </a>
                    </li>

                    {{--
                    <li class="{{ set_active(['material.student','material.public.student']) }} treeview">
                        <a href="#">
                            <i class="fa fa-archive"></i> <span>Material</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li class="{{ set_active('material.student') }}"><a href="{{ route('material.student') }}"><i class="fa fa-circle-o"></i> Free Trial</a></li>
                            <li class="{{ set_active('material.public.student') }}"><a href="{{ route('material.public.student') }}"><i class="fa fa-circle-o"></i> Private</a></li>
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Group</a></li>
                        </ul>
                    </li>--}}

                <!-- Head_Navigasi -->
                    {{--
                    <li class="header">OTHER</li>

                    <li class="#">
                        <a href="#">
                            <i class="fa fa-archive"> </i><span>Student</span>
                        </a>
                    </li>

                    <li class="#">
                        <a href="#">
                            <i class="fa fa-archive"> </i><span>Rating</span>
                        </a>
                    </li>

                    <li class="#">
                        <a href="#">
                            <i class="fa fa-archive"> </i><span>Report</span>
                        </a>
                    </li>--}}
            @endif
            {{-- End Instructor --}}
            @if(Auth::user()->roles == 'Admin')
            <!-- Head_Navigasi -->
                <li class="header">ADMIN NAVIGATION</li>
                <!-- Navigasi_Menu -->
                <li class="{{ set_active(['students.index','students.create','students.edit','instructors.index','instructors.create','instructors.edit',]) }} treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>User</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active(['students.index','students.create','students.edit']) }}">
                            <a href="{{ route('students.index') }}"><i class="fa fa-circle-o"></i> Student</a>
                        </li>
                        <li class="{{ set_active(['instructors.index','instructors.create','instructors.edit']) }}">
                            <a href="{{ route('instructors.index') }}"><i class="fa fa-circle-o"></i> Instructor</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ set_active(['course_registrations.index','course_registrations.create','session_registrations.index','session_registrations.create','session_registrations.update',]) }} treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Registration</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active(['course_registrations.index','course_registrations.create']) }}">
                            <a href="{{ route('course_registrations.index',['1']) }}"><i class="fa fa-circle-o"></i> Course</a>
                        </li>
                        <li class="{{ set_active(['session_registrations.index']) }}">
                            <a href="{{ route('session_registrations.index',['1']) }}"><i class="fa fa-circle-o"></i> Session</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ set_active(['course_payments.index','course_payments.create','course_payments.edit','course_packages.index','course_packages.create','course_packages.edit','course_types.index','course_types.create','course_types.edit','course_levels.index','course_levels.create','course_levels.edit','course_level_details.index','course_level_details.create','course_level_details.edit','course_certificates.index','course_certificates.create','course_level_details.edit']) }} treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Course</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active(['course_payments.index','course_payments.create','course_payments.edit']) }}">
                            <a href="{{ route('course_payments.index',['1']) }}">
                                <i class="fa fa-circle-o"></i> Payment</a>
                        </li>
                        <li class="{{ set_active(['course_packages.index','course_packages.create','course_packages.edit']) }}">
                            <a href="{{ route('course_packages.index') }}"><i class="fa fa-circle-o"></i> Package</a>
                        </li>
                        <li class="{{ set_active(['course_types.index','course_types.create','course_types.edit']) }}">
                            <a href="{{ route('course_types.index',['1']) }}"><i class="fa fa-circle-o"></i> Type</a>
                        </li>
                        <li class="{{ set_active(['course_levels.index','course_levels.create','course_levels.edit']) }}">
                            <a href="{{ route('course_levels.index',['1']) }}"><i class="fa fa-circle-o"></i> Level</a>
                        </li>
                        <li class="{{ set_active(['course_level_details.index','course_level_details.create','course_level_details.edit']) }}">
                            <a href="{{ route('course_level_details.index',['1']) }}"><i class="fa fa-circle-o"></i> Level Detail</a>
                        </li>
                        <li class="{{ set_active(['course_certificates.index','course_certificates.create','course_level_details.edit']) }}">
                            <a href="{{ route('course_certificates.index',['1']) }}"><i class="fa fa-circle-o"></i> Certificate</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ set_active(['material_publics.index','material_publics.create','material_publics.edit','material_sessions.index','material_sessions.create','material_sessions.edit','material_types.index','material_types.create','material_types.edit']) }} treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Material</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active(['material_publics.index','material_publics.create','material_publics.edit']) }}">
                            <a href="{{ route('material_publics.index') }}"><i class="fa fa-circle-o"></i> Public</a>
                        </li>
                        <li class="{{ set_active(['material_sessions.index','material_sessions.create','material_sessions.edit']) }}">
                            <a href="{{ route('material_sessions.index') }}"><i class="fa fa-circle-o"></i> Session</a>
                        </li>
                        <li class="{{ set_active(['material_types.index','material_types.create','material_types.edit']) }}">
                            <a href="{{ route('material_types.index') }}"><i class="fa fa-circle-o"></i> Type</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ set_active(['ratings.index','ratings.create','ratings.edit']) }}">
                    <a href="{{ route('ratings.index') }}">
                        <i class="fa fa-star"> </i><span> Rating</span>
                    </a>
                </li>

                <li class="{{ set_active(['schedules.index','schedules.create','schedules.edit']) }}">
                    <a href="{{ route('schedules.index') }}">
                        <i class="fa fa-calendar"></i> <span>Schedule</span>
                    </a>
                </li>

                <li class="{{ set_active(['sessions.index','sessions.create','sessions.edit']) }}">
                    <a href="{{ route('sessions.index') }}">
                        <i class="fa fa-calendar-check-o"></i> <span>Session</span>
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
