<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::user()->roles == 'Student' && Auth::user()->image_profile != 'user.jpg')
                    <img src="{{ asset('uploads/student/profile/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                @elseif((Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor') && Auth::user()->image_profile != 'user.jpg')
                    <img src="{{ asset('uploads/instructor/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                @elseif(Auth::user()->roles == 'Customer Service' && Auth::user()->image_profile != 'user.jpg')
                    <img src="{{ asset('uploads/team-cs/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                @elseif(Auth::user()->roles == 'Financial Team' && Auth::user()->image_profile != 'user.jpg')
                    <img src="{{ asset('uploads/team-financial/'. Auth::user()->image_profile) }}" class="img-circle" alt="User Image">
                @else
                    <img src="{{ asset('adminlte/dist/img/user.jpg')}}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                @if(Auth::user()->roles == 'Student')
                    <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                @endif
                @if(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
                    <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                @endif
                @if(Auth::user()->roles == 'Customer Service')
                    <p>CS Team: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                @endif
                @if(Auth::user()->roles == 'Financial Team')
                    <p>Financial Team: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                @endif
                @if(Auth::user()->roles == 'Admin')
                    <p>Admin</p>
                @endif
                <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
                @if(Auth::user()->roles == 'Student' && (Auth::user()->citizenship == 'Not Available' || Auth::user()->student->course_registrations->count() == 0))
                  <a href="{{ route('home') }}"><i class="fa fa-circle text-info"></i> Registering</a>
                @else
                  <a href="{{ route('profile') }}"><i class="fa fa-circle text-success"></i> Online</a>
                @endif
            </div>
        </div>
        <!-- search form -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">GENERAL</li>

            @if(Auth::user()->roles != 'Student')
            <li class="{{ set_active('home') }}">
                <a href="{{ route('home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @elseif(Auth::user()->citizenship != 'Not Available')
              @if(Auth::user()->student->course_registrations->count() == 0)
                <li class="{{ set_active(['material_types.index']) }}">
                  <a href="{{ route('material_types.index')}}">
                    <i class="fa fa-book"></i> <span>Registration</span>
                  </a>
                </li>
              @else
                <li class="{{ set_active('home') }}">
                  <a href="{{ route('home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                  </a>
                </li>
              @endif
            @else
            <li class="{{ set_active(['layouts.questionnaire']) }}">
                <a href="{{ route('layouts.questionnaire')}}">
                    <i class="fa fa-book"></i> <span>Registration</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->roles == 'Student' && Auth::user()->citizenship != 'Not Available' && Auth::user()->student->course_registrations->count() > 0)
            <!-- Head_Navigasi -->
            <li class="header">COURSES</li>
                {{--
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Schedules</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Free Trial</a>
                        </li>
                        {{--
                        <li class="#">
                            <a href="{{ route('schedules.index', ['Free Trial']) }}"><i class="fa fa-circle-o"></i> Free Trial</a>
                        </li>
                        <!--li class="#">
                            <a href="{{ route('schedules.index', ['Private']) }}"><i class="fa fa-circle-o"></i> Private</a>
                        </li-->
                        <!--li class="#">
                            <a href="{{ route('schedules.index', ['Group']) }}"><i class="fa fa-circle-o"></i> Group</a>
                        </li-->
                    </ul>
                </li>--}}

                <li class="{{ set_active(['session_registrations.index', 'form_responses.create']) }}">
                    <a href="{{ route('session_registrations.index') }}"><i class="fa fa-book"> </i><span> Schedule</span></a>
                </li>

                <li class="{{ set_active('materials.index') }}">
                    <a href="{{ route('materials.index') }}"><i class="fa fa-book"> </i><span> Material</span></a>
                </li>

                {{-- <li class="#">
                    <a href="{{ route('courses.private') }}"><i class="fa fa-book"> </i><span> Private Courses</span></a>
                </li> --}}

                <li class="header">TASKS</li>

                <li class="#">
                    <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Assignment</span></a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Exam</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('home') }}"><i class="fa fa-circle-o"></i> Mid-Exam</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('home') }}"><i class="fa fa-circle-o"></i> Final-Exam</a>
                        </li>
                    </ul>
                </li>

                <li class="header">RESULTS</li>

                <li class="#">
                    <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Grade</span></a>
                </li>

                <li class="#">
                    <a href="{{ route('course_certificates.index') }}"><i class="fa fa-book"> </i><span> Certificate</span></a>
                </li>

                <li class="header">OTHERS</li>

                <li class="{{ set_active('material_types.index') }}">
                    <a href="{{ route('material_types.index') }}"><i class="fa fa-book"> </i><span> Choose a Course</span></a>
                </li>

                <li class="{{ set_active('course_payments.index') }}">
                    <a href="{{ route('course_payments.index',1) }}"><i class="fa fa-book"> </i><span> Payment</span></a>
                </li>
                <!-- Other_Navigasi -->
                {{--
                <li class="header">OTHER</li>

                <li class="#">
                    <a href="{{ route('courses.index') }}"><i class="fa fa-book"> </i><span> Nusia Courses</span></a>
                </li>

                <li class="#">
                    <a href="{{ route('instructors.index') }}"><i class="fa fa-users"> </i><span> Nusia Instructors</span></a>
                </li>
                --}}
            @endif
            {{-- End Student Navigation --}}
            @if(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
                <!-- Head_Navigasi -->
                    <li class="header">COURSES</li>
                    {{--
                    <li class="{{ set_active('course.instructor') }}">
                        <a href="{{ route('course.instructor') }}">
                            <i class="fa fa-book"> </i><span>Course</span>
                        </a>
                    </li>
                    --}}
                    <!--li class="treeview"-->
                    <li class="{{ set_active(['sessions.index', 'course_registrations.index_by_course_id', 'profiles.show']) }}">
                        <a href="{{ route('sessions.index') }}">
                            <i class="fa fa-calendar"></i> <span>Schedule</span>
                            <!--span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span-->
                        </a>
                        <!--ul class="treeview-menu"-->
                            <!--li class="#"><a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Free Trial</a></li-->
                            <!--li class="#"><a href="{{ route('schedules.index') }}"><i class="fa fa-circle-o"></i> Private</a></li-->
                            <!--li class="#"><a href="{{ route('schedules.index') }}"><i class="fa fa-circle-o"></i> Group</a></li-->
                            {{--
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Group</a></li>--}}
                        <!--/ul-->
                    </li>

                    <!--li class="treeview"-->
                    {{--<li class="{{ set_active(['session_registrations.index', 'attendances.edit']) }}">
                        <a href="{{ route('session_registrations.index') }}">
                            <i class="fa fa-calendar-check-o"></i> <span>Session</span>
                            <!--span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span-->
                        </a>
                        <!--ul class="treeview-menu"-->
                            <!--li class="#">
                                <a href="{{ route('session_registrations.index') }}"><i class="fa fa-circle-o"></i> Free Trial</a>
                            </li-->
                            <!--li class="#">
                                <a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Private</a>
                            </li-->
                            <!--li class="#">
                                <a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Group</a>
                            </li-->
                            <!--li class="#"><a href="{{ route('sessions.index') }}"><i class="fa fa-circle-o"></i> Free Trial</a></li>
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Private</a></li>
                            <li class="#"><a href="#"><i class="fa fa-circle-o"></i> Group</a></li-->
                        <!--/ul-->
                    </li>--}}

                    <li class="{{ set_active('materials.index') }}">
                        <a href="{{ route('materials.index') }}">
                            <i class="fa fa-book"> </i><span> Material</span>
                        </a>
                    </li>

                    <li class="#">
                        <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Assignment</span></a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Exam</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="#">
                                <a href="{{ route('home') }}"><i class="fa fa-circle-o"></i> Mid-Exam</a>
                            </li>
                            <li class="#">
                                <a href="{{ route('home') }}"><i class="fa fa-circle-o"></i> Final-Exam</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Additional Navigation Menu for Lead Instructor --}}
                    @if(Auth::user()->roles == 'Lead Instructor')
                        <li class="header">STUDENTS</li>

                        <li class="#">
                            <a href="{{ route('home')}}">
                                <i class="fa fa-file-text-o"></i> <span>Placement Test</span>
                            </a>
                        </li>
                    @endif

                    <li class="header">RATINGS</li>

                    <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
                        <a href="{{ route('form_responses.index')}}">
                            <i class="fa fa-file-text-o"></i> <span>Form Response</span>
                        </a>
                    </li>

                    <!-- Other_Navigasi -->
                    {{--
                    <li class="header">OTHER</li>

                    <li class="#">
                        <a href="{{ route('courses.index') }}"><i class="fa fa-book"> </i><span> Nusia Courses</span></a>
                    </li>

                    <li class="#">
                        <a href="{{ route('instructors.index') }}"><i class="fa fa-users"> </i><span> Nusia Student</span></a>
                    </li>
                    --}}
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
                            <!--li class="{{ set_active('material.public.student') }}"><a href="{{ route('material.public.student') }}"><i class="fa fa-circle-o"></i> Private</a></li-->
                            <!--li class="#"><a href="#"><i class="fa fa-circle-o"></i> Group</a></li-->
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
            {{-- End Instructor Navigation --}}




            @if(Auth::user()->roles == 'Customer Service')
                <!-- Head_Navigasi -->
                    <li class="header">DATA</li>

                    <li class="#">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-book"> </i><span> Course Schedule</span>
                        </a>
                    </li>

                    <li class="#">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-book"> </i><span> Student</span>
                        </a>
                    </li>

                    <li class="header">RATINGS</li>

                    <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
                        <a href="{{ route('form_responses.index')}}">
                            <i class="fa fa-file-text-o"></i> <span>Form Response</span>
                        </a>
                    </li>
            @endif
            {{-- End Customer Service Navigation --}}





            @if(Auth::user()->roles == 'Financial Team')
                <!-- Head_Navigasi -->
                    <li class="header">FINANCE</li>

                    <li class="#">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-book"> </i><span> Course Payment</span>
                        </a>
                    </li>

                    <li class="header">RATINGS</li>

                    <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
                        <a href="{{ route('form_responses.index')}}">
                            <i class="fa fa-file-text-o"></i> <span>Form Response</span>
                        </a>
                    </li>
            @endif
            {{-- End Customer Service Navigation --}}





            @if(Auth::user()->roles == 'Admin')
                <!-- Head_Navigasi -->
                <li class="header">DATA</li>

                <li class="#">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-book"> </i><span> Course</span>
                    </a>
                </li>

                <li class="#">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-book"> </i><span> User</span>
                    </a>
                </li>

                <li class="header">RATINGS</li>

                <li class="{{ set_active(['forms.index', 'forms.create', 'forms.show', 'forms.edit']) }}">
                    <a href="{{ route('forms.index')}}">
                        <i class="fa fa-edit"></i> <span>Form</span>
                    </a>
                </li>

                <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
                    <a href="{{ route('form_responses.index')}}">
                        <i class="fa fa-file-text-o"></i><span> Website Rating</span>
                    </a>
                </li>

                {{--<li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Student</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('students.index') }}"><i class="fa fa-circle-o"></i> Personal Data</a>
                        </li>
                    </ul>
                </li>--}}
                {{-- End Tree --}}
                {{--<li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Instructor</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('instructors.index') }}"><i class="fa fa-circle-o"></i> Personal Data</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('schedules.admin_instructor') }}"><i class="fa fa-circle-o"></i> Schedule</a>
                        </li>
                    </ul>
                </li>--}}
                {{-- End Tree --}}
                {{--<li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Materials</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="#">
                            <a href="{{ route('material_publics.index') }}"><i class="fa fa-circle-o"></i> Public Data</a>
                        </li>
                        <li class="#">
                            <a href="{{ route('material_sessions.index') }}"><i class="fa fa-circle-o"></i> Session Data</a>
                        </li>
                    </ul>
                </li>
                <li class="#">
                    <a href="{{ route('courses.index') }}"><i class="fa fa-book"> </i><span> Courses</span></a>
                </li>--}}
                {{--
                <li class="#">
                    <a href="{{ route('materials.index') }}"><i class="fa fa-book"> </i><span> Materials</span></a>
                </li> --}}

                <!-- Head_Schedule -->
                {{--<li class="header">COURSES SCHEDULE</li>

                <li class="#">
                    <a href="{{ route('session_registrations.index') }}"><i class="fa fa-book"> </i><span> Schedule</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('sessions.admin_instrucstor') }}"><i class="fa fa-book"> </i><span> Session</span></a>
                </li>--}}
                {{--
                <!-- Head_Navigasi -->

                <li class="header">COURSES NAVIGATION</li>
                <li class="#">
                    <a href="{{ route('course_certificates.index') }}"><i class="fa fa-book"> </i><span> course_certificates</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('course_level_details.index') }}"><i class="fa fa-book"> </i><span> course_level_details</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('course_levels.index') }}"><i class="fa fa-book"> </i><span> course_levels</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('course_packages.index') }}"><i class="fa fa-book"> </i><span> course_packages</span></a>
                </li>
                <li class="#">
                    <a href="#"><i class="fa fa-book"> </i><span> course_payments</span></a>
                </li>
                <li class="#">
                    <a href="#"><i class="fa fa-book"> </i><span> course_registrations</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('course_types.index') }}"><i class="fa fa-book"> </i><span> course_types</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('courses.index') }}"><i class="fa fa-book"> </i><span> courses</span></a>
                </li>
                <!-- Head_Navigasi -->
                <li class="header">SESSIONS NAVIGATION</li>
                <li class="#">
                    <a href="{{ route('sessions.index') }}"><i class="fa fa-book"> </i><span> sessions</span></a>
                </li>
                <li class="#">
                    <a href="#"><i class="fa fa-book"> </i><span> session_registrations</span></a>
                </li>
                <li class="header">MATERIALS NAVIGATION</li>
                <li class="#">
                    <a href="{{ route('material_publics.index') }}"><i class="fa fa-book"> </i><span> material_publics</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('material_sessions.index') }}"><i class="fa fa-book"> </i><span> material_sessions</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('material_types.index') }}"><i class="fa fa-book"> </i><span> material_types</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('materials.index') }}"><i class="fa fa-book"> </i><span> materials</span></a>
                </li>
                <li class="header">OTHER</li>
                <li class="#">
                    <a href="{{ route('ratings.index') }}"><i class="fa fa-book"> </i><span> ratings</span></a>
                </li>
                <li class="#">
                    <a href="{{ route('schedules.index') }}"><i class="fa fa-book"> </i><span> schedules</span></a>
                </li>
                --}}
                <!--Navigasi_Menu_OLD
                <li class="header">OLD NAVIGATION</li>

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
            End_Navigasi_Menu -->
            @endif
            {{-- End Admin Navigation --}}

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
