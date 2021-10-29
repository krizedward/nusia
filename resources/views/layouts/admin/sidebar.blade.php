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
        <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
      @elseif(Auth::user()->roles == 'Financial Team')
        <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
      @elseif(Auth::user()->roles == 'Admin')
        <p>Admin</p>
      @endif

      <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
      @if(Auth::user()->roles == 'Student' && (Auth::user()->citizenship == 'Not Available' || Auth::user()->student->course_registrations->count() == 0))
        <a href="{{ route('registered.dashboard.index') }}"><i class="fa fa-circle text-info"></i> Registering</a>
      @else
        <a href="{{ route('registered.chat.index') }}"><i class="fa fa-circle text-success"></i> Online</a>
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
      <li class="{{ set_active(['registered.dashboard.index', 'registered.contact.index', 'registered.chat.index', 'registered.profile.index', 'non_admin.chat_admin.show', 'student.chat_financial_team.show', 'student.chat_lead_instructor.show', 'student.chat_instructor.show', 'student.chat_customer_service.show', 'instructor.chat_instructor.show', 'instructor.chat_student.show', 'lead_instructor.chat_student.show', 'lead_instructor.chat_student_alternative_meeting.show', 'customer_service.chat_student.show', 'financial_team.chat_student.show']) }}">
        <a href="{{ route('registered.dashboard.index')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
    @elseif(Auth::user()->citizenship != 'Not Available')
      @if(Auth::user()->student->course_registrations->toArray() == null)
        <li class="{{ set_active(['student.choose_course.index']) }}">
          <a href="{{ route('student.choose_course.index')}}">
            <i class="fa fa-book"></i> <span>Choose a Course</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null)
        <li class="{{ set_active(['student.choose_course.index']) }}">
          <a href="{{ route('student.choose_course.index', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Choose a Course</span>
          </a>
        </li>
        <li class="{{ set_active(['student.complete_payment_information.show']) }}">
          <a href="{{ route('student.complete_payment_information.show', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Complete Payment Info</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->course_payments->first()->status != 'Confirmed')
        <li class="{{ set_active(['student.upload_payment_evidence.show']) }}">
          <a href="{{ route('student.upload_payment_evidence.show', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Upload Payment Evidence</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed')
        <li class="{{ set_active(['student.upload_placement_test.show']) }}">
          <a href="{{ route('student.upload_placement_test.show', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Complete Placement Test</span>
          </a>
        </li>
      @elseif(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && Auth::user()->student->course_registrations->first()->session_registrations->toArray() == null)
        <li class="{{ set_active(['student.choose_course_registration.show', 'student.confirm_course_registration.show']) }}">
          <a href="{{ route('student.choose_course_registration.show', [Auth::user()->student->course_registrations->first()->id])}}">
            <i class="fa fa-book"></i> <span>Complete Course Registration</span>
          </a>
        </li>
      @else
        <li class="{{ set_active(['registered.dashboard.index', 'registered.contact.index', 'registered.chat.index', 'registered.profile.index', 'non_admin.chat_admin.show', 'student.chat_financial_team.show', 'student.chat_lead_instructor.show', 'student.chat_instructor.show', 'student.chat_customer_service.show', 'instructor.chat_instructor.show', 'instructor.chat_student.show', 'lead_instructor.chat_student.show', 'lead_instructor.chat_student_alternative_meeting.show', 'customer_service.chat_student.show', 'financial_team.chat_student.show']) }}">
          <a href="{{ route('registered.dashboard.index')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      @endif
    @else
      <li class="{{ set_active(['student.student_registration_form.index']) }}">
        <a href="{{ route('student.student_registration_form.index')}}">
          <i class="fa fa-book"></i> <span>Registrations</span>
        </a>
      </li>
    @endif

    @if(Auth::user()->roles == 'Student' && Auth::user()->citizenship != 'Not Available' && Auth::user()->student->course_registrations->toArray() != null && Auth::user()->student->course_registrations->first()->session_registrations->toArray() != null)
      <!-- Head_Navigasi -->
      <li class="header">COURSES</li>
      <li class="{{ set_active(['student.schedule.index', 'student.schedule.show']) }}">
        <a href="{{ route('student.schedule.index') }}"><i class="fa fa-book"> </i><span> Schedules</span></a>
      </li>

      <li class="header">OTHERS</li>
      <li class="{{ set_active(['student.choose_course.index', 'student.complete_payment_information.show', 'student.upload_payment_evidence.show', 'student.upload_placement_test.show', 'student.choose_course_registration.show', 'student.confirm_course_registration.show']) }}">
        <a href="{{ route('student.choose_course.index') }}"><i class="fa fa-book"> </i><span> Choose New Courses</span></a>
      </li>
    @endif
    {{-- End Student Navigation --}}





    @if(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
      <!-- Head_Navigasi -->
      <li class="header">COURSES</li>
      <li class="{{ set_active(['instructor.schedule.index', 'instructor.course.show', 'instructor.student_attendance.index', 'instructor.session_feedback.index', 'instructor.instructor_profile.show', 'instructor.student_profile.show']) }}">
        <a href="{{ route('instructor.schedule.index') }}">
          <i class="fa fa-calendar"></i> <span>Schedules</span>
        </a>
      </li>

      {{-- Menu Tambahan untuk Lead Instructor --}}
      @if(Auth::user()->roles == 'Lead Instructor')
        <li class="header">LEAD INSTRUCTOR</li>
        <li class="{{ set_active(['lead_instructor.instructor_session.index',]) }}">
          <a href="{{ route('lead_instructor.instructor_session.index') }}">
            <i class="fa fa-edit"></i> <span>Assign Sessions</span>
          </a>
        </li>
        <li class="{{ set_active(['lead_instructor.student_registration.index', 'lead_instructor.student_registration.show', 'lead_instructor.placement_test_by_meeting.index', 'lead_instructor.placement_test_by_meeting_student_profile.show']) }}">
          <a href="{{ route('lead_instructor.student_registration.index') }}">
            <i class="fa fa-file-text-o"></i> <span>Placement Tests</span>
          </a>
        </li>
      @endif
    @endif
    {{-- End Instructor Navigation --}}





    @if(Auth::user()->roles == 'Customer Service')
      <!-- Head_Navigasi -->
      <li class="header">DATA</li>
      <li class="{{ set_active(['customer_service.student.index', 'customer_service.student.show', 'customer_service.student_course_registration.index', 'customer_service.student_course_registration.show']) }}">
        <a href="{{ route('customer_service.student.index') }}">
          <i class="fa fa-users"> </i><span> Students</span>
        </a>
      </li>
    @endif
    {{-- End Customer Service Navigation --}}





    @if(Auth::user()->roles == 'Financial Team')
      <!-- Head_Navigasi -->
      <li class="header">FINANCE</li>
      <li class="{{ set_active(['financial_team.student_payment.index', 'financial_team.student_payment.show']) }}">
        <a href="{{ route('financial_team.student_payment.index') }}">
          <i class="fa fa-book"> </i><span> Payments</span>
        </a>
      </li>
    @endif
    {{-- End Financial Team Navigation --}}





    @if(Auth::user()->roles == 'Admin')
      {{--
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
      --}}
    @endif
    {{-- End Admin Navigation --}}
  </ul>
</section>
<!-- /.sidebar -->
