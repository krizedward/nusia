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
      @elseif(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
        <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
      @elseif(Auth::user()->roles == 'Customer Service')
        <p>CS Team: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
      @elseif(Auth::user()->roles == 'Financial Team')
        <p>Financial Team: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
      @elseif(Auth::user()->roles == 'Admin')
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
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
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
      @if(Auth::user()->student->course_registrations->toArray() == null)
        <li class="{{ set_active(['student.choose_materials']) }}">
          <a href="{{ route('student.choose_materials')}}">
            <i class="fa fa-book"></i> <span>Choose a Course</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null)
        <li class="{{ set_active(['student.choose_materials']) }}">
          <a href="{{ route('student.choose_materials', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Choose a Course</span>
          </a>
        </li>
        <li class="{{ set_active(['student.complete_payment_information']) }}">
          <a href="{{ route('student.complete_payment_information', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Complete Payment Info</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed')
        <li class="{{ set_active(['student.complete_placement_tests']) }}">
          <a href="{{ route('student.complete_placement_tests', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Complete Placement Test</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && strpos(Auth::user()->student->course_registrations->first()->course->course_package->title, 'Early Registration') === false)
        <li class="{{ set_active(['student.complete_course_registrations']) }}">
          <a href="{{ route('student.complete_course_registrations', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Complete Course Registration</span>
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
          <i class="fa fa-book"></i> <span>Registrations</span>
        </a>
      </li>
    @endif

    @if(Auth::user()->roles == 'Student' && Auth::user()->citizenship != 'Not Available' && Auth::user()->student->course_registrations->toArray() != null && strpos(Auth::user()->student->course_registrations->first()->course->course_package->title, 'Early Registration') !== false)
      <!-- Head_Navigasi -->
      <li class="header">COURSES</li>
      <li class="{{ set_active(['session_registrations.index', 'course_registrations.show_by_student', 'form_responses.create']) }}">
        <a href="{{ route('session_registrations.index') }}"><i class="fa fa-book"> </i><span> Schedules</span></a>
      </li>
      {{--
      <li class="{{ set_active('materials.index') }}">
        <a href="{{ route('materials.index') }}"><i class="fa fa-book"> </i><span> Materials</span></a>
      </li>
      --}}

      {{--
      <li class="header">TASKS</li>
      <li class="#">
        <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Assignments</span></a>
      </li>
      <li class="#">
        <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Exams</span></a>
      </li>
      --}}

      {{--
      <li class="header">RESULTS</li>
      <li class="#">
        <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Grades</span></a>
      </li>
      <li class="#">
        <a href="{{ route('course_certificates.index') }}"><i class="fa fa-book"> </i><span> Certificates</span></a>
      </li>
      --}}

      <li class="header">OTHERS</li>
      <li class="{{ set_active(['student.choose_materials', 'student.complete_payment_information', 'student.complete_placement_tests', 'student.complete_course_registrations']) }}">
        <a href="{{ route('student.choose_materials') }}"><i class="fa fa-book"> </i><span> Choose a Course</span></a>
      </li>
      {{--
      <li class="{{ set_active('course_payments.index') }}">
        <a href="{{ route('course_payments.index',1) }}"><i class="fa fa-book"> </i><span> Payments</span></a>
      </li>
      --}}
    @endif
    {{-- End Student Navigation --}}





    @if(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
      <!-- Head_Navigasi -->
      <li class="header">COURSES</li>
      <li class="{{ set_active(['sessions.index', 'course_registrations.index_by_course_id', 'profiles.show']) }}">
        <a href="{{ route('sessions.index') }}">
          <i class="fa fa-calendar"></i> <span>Schedules</span>
        </a>
      </li>
      <li class="{{ set_active('material_types.index') }}">
        <a href="{{ route('material_types.index') }}">
          <i class="fa fa-book"> </i><span> Materials</span>
        </a>
      </li>
      <li class="#">
        <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Assignments</span></a>
      </li>
      <li class="#">
        <a href="{{ route('home') }}"><i class="fa fa-book"> </i><span> Exams</span></a>
      </li>

      {{-- Menu Tambahan untuk Lead Instructor --}}
      @if(Auth::user()->roles == 'Lead Instructor')
        <li class="header">STUDENTS</li>
        <li class="#">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Placement Tests</span>
          </a>
        </li>
      @endif

      <li class="header">RATINGS</li>
      <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
        <a href="{{ route('form_responses.index')}}">
          <i class="fa fa-file-text-o"></i> <span>Form Responses</span>
        </a>
      </li>
    @endif
    {{-- End Instructor Navigation --}}





    @if(Auth::user()->roles == 'Customer Service')
      <!-- Head_Navigasi -->
      <li class="header">DATA</li>
      <li class="#">
        <a href="{{ route('sessions.index') }}">
          <i class="fa fa-book"> </i><span> Course Schedules</span>
        </a>
      </li>
      <li class="#">
        <a href="{{ route('students.index') }}">
          <i class="fa fa-book"> </i><span> Students</span>
        </a>
      </li>

      <li class="header">RATINGS</li>
      <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
        <a href="{{ route('form_responses.index')}}">
          <i class="fa fa-file-text-o"></i> <span>Form Responses</span>
        </a>
      </li>
    @endif
    {{-- End Customer Service Navigation --}}





    @if(Auth::user()->roles == 'Financial Team')
      <!-- Head_Navigasi -->
      <li class="header">FINANCE</li>
      <li class="#">
        <a href="{{ route('course_payments.index',[1]) }}">
          <i class="fa fa-book"> </i><span> Course Payments</span>
        </a>
      </li>

      <li class="header">RATINGS</li>
      <li class="{{ set_active(['form_responses.index', 'form_responses.index_form', 'form_responses.index_session', 'form_responses.show']) }}">
        <a href="{{ route('form_responses.index')}}">
          <i class="fa fa-file-text-o"></i> <span>Form Responses</span>
        </a>
      </li>
    @endif
    {{-- End Financial Team Navigation --}}





    @if(Auth::user()->roles == 'Admin')
      <!-- Head_Navigasi -->
      <li class="header">DATA</li>
      <li class="{{ set_active(['courses.index']) }}">
        <a href="{{ route('courses.index') }}">
          <i class="fa fa-book"> </i><span> Courses</span>
        </a>
      </li>
      <li class="{{ set_active(['users.index']) }}">
        <a href="{{ route('users.index') }}">
          <i class="fa fa-book"> </i><span> Users</span>
        </a>
      </li>

      <li class="header">RATINGS</li>
      <li class="{{ set_active(['forms.index', 'forms.create', 'forms.show', 'forms.edit']) }}">
        <a href="{{ route('forms.index')}}">
          <i class="fa fa-edit"></i> <span>Forms</span>
        </a>
      </li>
      <li class="{{ set_active(['form_responses.index_admin', 'form_responses.index_form_admin', 'form_responses.index_session_admin', 'form_responses.show_admin']) }}">
        <a href="{{ route('form_responses.index_admin')}}">
          <i class="fa fa-file-text-o"></i><span> Website Ratings</span>
        </a>
      </li>
    @endif
    {{-- End Admin Navigation --}}
  </ul>
</section>
<!-- /.sidebar -->
