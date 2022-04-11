@extends('layouts.admin.default')

@section('title', $course->title)

{{-- @include('layouts.css_and_js.table') --}}

{{-- @include('layouts.css_and_js.form_advanced') --}}

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Class Information - {{ $course->title }}</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li><a href="{{ route('instructor.schedule.index') }}">Schedules</a></li>
    <li class="active">Class Information</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
          <li><a href="#materials" data-toggle="tab"><b>Materials</b></a></li>
          <li><a href="#tasks" data-toggle="tab"><b>Tasks & Exams</b></a></li>
          <li><a href="#grades" data-toggle="tab"><b>Grades</b></a></li>
          <li><a href="#certificate" data-toggle="tab"><b>Certificate</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assigned in <b>{{ $course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course->course_package->count_session
                        --}}
                        {{ $sessions->count() }}
                        @if($sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Next Meeting Time</strong>
                    <p>
                      <?php
                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                        $next_meeting_time = null;
                        $next_meeting_link = null;
                        $session_title = null;
                        if($sessions->toArray() != null) {
                          foreach($sessions as $s) {
                            $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                            $schedule_time_end = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                            $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                            if($schedule_time_end >= $schedule_now) {
                              if($next_meeting_time == null) {
                                $next_meeting_time = $schedule_time_begin;
                                $next_meeting_link = $s->link_zoom;
                                $session_title = strtoupper($s->title);
                              }
                              if($schedule_time_end < $next_meeting_time) {
                                $next_meeting_time = $schedule_time_begin;
                                $next_meeting_link = $s->link_zoom;
                                $session_title = strtoupper($s->title);
                              }
                            }
                          }
                        }
                      ?>
                      @if($session_title)
                        <table>
                          <tr style="vertical-align:baseline;">
                            <td colspan="3"><b><u>{{ $session_title }}</u></b></td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Day</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>
                              @if($next_meeting_time)
                                {{ $next_meeting_time->isoFormat('dddd') }}
                                @if($next_meeting_time->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                  <b>(Today)</b>
                                @endif
                              @else
                                <i class="text-muted">N/A</i>
                              @endif
                            </td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Date</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>
                              @if($next_meeting_time)
                                {{ $next_meeting_time->isoFormat('MMMM Do YYYY') }}
                              @else
                                <i class="text-muted">N/A</i>
                              @endif
                            </td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Time</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>
                              @if($next_meeting_time)
                                {{ $next_meeting_time->isoFormat('hh:mm A') }}
                              @else
                                <i class="text-muted">N/A</i>
                              @endif
                            </td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Link</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>
                              @if($next_meeting_link)
                                <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $next_meeting_link }}">Link</a>
                              @else
                                <i class="text-muted">N/A</i>
                              @endif
                            </td>
                          </tr>
                        </table>
                      @else
                        This class has ended.
                      @endif
                    </p>
                    {{-- <hr> --}}
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-9 no-padding">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title"><b>Overview</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Course Type</strong>
                      <p>
                        @if($course->course_package->material_type->description)
                          @if($course->course_package->material_type->name == 'General Indonesian Language')
                            <u>{{ $course->course_package->material_type->name }}</u><br>
                            {{ Str::limit($course->course_package->material_type->description, 359) }}
                          @else
                            <u>{{ $course->course_package->material_type->name }}</u><br>
                            {{ $course->course_package->material_type->description }}
                          @endif
                        @else
                          {{ $course->course_package->material_type->name }}
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Learning Type</strong>
                      <p>
                        @if($course->course_package->course_type->description)
                          <u>{{ $course->course_package->course_type->name }}</u><br>
                          {{ $course->course_package->course_type->description }}
                        @else
                          {{ $course->course_package->course_type->name }}
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Class Proficiency Level</strong>
                      <p>
                        @if($course->course_package->course_level->description)
                          <u>{{ $course->course_package->course_level->name }}</u><br>
                          {{ $course->course_package->course_level->description }}
                        @else
                          {{ $course->course_package->course_level->name }}
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Class Title</strong>
                      <p>{{ $course->title }}</p>
                    </div>
                  </div>
                  <div class="box box-warning">
                    <div class="box-header">
                      <h3 class="box-title">
                        <?php
                          $data = $sessions->first()->schedule->instructor_schedules;
                        ?>
                        @if($data->count() == 1)
                          <b>Instructor</b>
                        @else
                          <b>Instructors</b>
                        @endif
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      @if($data->toArray() != null)
                        <table class="table table-bordered example1">
                          <thead>
                            <th>Name</th>
                            <th style="width:25%;">Interest</th>
                            <th style="width:12%;">Picture</th>
                            <th class="hidden-xs hidden-sm" style="width:5%;">Chat</th>
                          </thead>
                          <tbody>
                            @foreach($data as $dt)
                              <tr>
                                <td>
                                  @if($sessions->first()->course->course_registrations->toArray() != null && $sessions->first()->course->course_registrations->count() >= $sessions->first()->course->course_package->course_type->count_student_min)
                                    {{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}
                                    <span class="hidden-md hidden-lg hidden-xl">
                                      @if($dt->instructor_id != Auth::user()->instructor->id)
                                        <br /><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_instructor.show', $dt->instructor->user_id) }}">Chat</a>
                                      @endif
                                    </span>
                                  @else
                                    <i class="text-muted">Pending</i>
                                  @endif
                                </td>
                                <td>
                                  @if($sessions->first()->course->course_registrations->toArray() != null && $sessions->first()->course->course_registrations->count() >= $sessions->first()->course->course_package->course_type->count_student_min)
                                    <?php
                                      if($dt->instructor->interest) {
                                        $interest = explode(', ', $dt->instructor->interest);
                                      } else $interest = null;
                                    ?>
                                    @if($interest)
                                      @for($i = 0; $i < count($interest); $i = $i + 1)
                                        <span class="label label-success">{{ $interest[$i] }}</span>
                                      @endfor
                                    @else
                                      <span class="text-muted"><i>N/A</i></span>
                                    @endif
                                  @else
                                    <i class="text-muted">Pending</i>
                                  @endif
                                </td>
                                <td>
                                  @if($sessions->first()->course->course_registrations->toArray() != null && $sessions->first()->course->course_registrations->count() >= $sessions->first()->course->course_package->course_type->count_student_min)
                                    @if($dt->instructor->user->image_profile != 'user.jpg')
                                      <img src="{{ asset('uploads/instructor/'.$dt->instructor->user->image_profile) }}" style="width:100%">
                                    @else
                                      <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                                    @endif
                                  @else
                                    <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                                  @endif
                                </td>
                                <td class="hidden-xs hidden-sm text-center">
                                  @if($sessions->first()->course->course_registrations->toArray() != null && $sessions->first()->course->course_registrations->count() >= $sessions->first()->course->course_package->course_type->count_student_min)
                                    @if($dt->instructor_id != Auth::user()->instructor->id)
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_instructor.show', $dt->instructor->user_id) }}">Link</a>
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  @else
                                    <i class="text-muted">N/A</i>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      @else
                        <p class="text-muted">No data available.</p>
                      @endif
                    </div>
                  </div>
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">
                        <?php
                          $data = $course->course_registrations;
                        ?>
                        @if($data->count() == 1)
                          <b>Student</b>
                        @else
                          <b>Students</b>
                        @endif
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      @if($data->toArray() != null)
                        <table class="table table-bordered example1">
                          <thead>
                            <th>Name</th>
                            <th style="width:25%;">Interest</th>
                            <th style="width:12%;">Picture</th>
                            <th class="hidden-xs hidden-sm" style="width:5%;">Chat</th>
                          </thead>
                          <tbody>
                            @foreach($data as $dt)
                              <tr>
                                <td>
                                  {{ $dt->student->user->first_name }} {{ $dt->student->user->last_name }}
                                  <span class="hidden-md hidden-lg hidden-xl">
                                    <br /><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_student.show', $dt->student->user_id) }}">Chat</a>
                                  </span>
                                </td>
                                <td>
                                  <?php
                                    if($dt->student->interest) {
                                      $interest = explode(', ', $dt->student->interest);
                                    } else $interest = null;
                                  ?>
                                  @if($interest)
                                    @for($i = 0; $i < count($interest); $i = $i + 1)
                                      <span class="label label-success">{{ $interest[$i] }}</span>
                                    @endfor
                                  @else
                                    <span class="text-muted"><i>N/A</i></span>
                                  @endif
                                </td>
                                <td>
                                  @if($dt->student->user->image_profile != 'user.jpg')
                                    <img src="{{ asset('uploads/student/profile/'.$dt->student->user->image_profile) }}" style="width:100%">
                                  @else
                                    <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                                  @endif
                                </td>
                                <td class="hidden-xs hidden-sm text-center">
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_student.show', $dt->student->user_id) }}">Link</a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      @else
                        <p class="text-muted">No data available.</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="sessions">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assigned in <b>{{ $course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course->course_package->count_session
                        --}}
                        {{ $sessions->count() }}
                        @if($sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt>
                          @if($course->course_registrations->count() == 1)
                            <i class="fa fa-user-circle-o margin-r-5"></i> Starting Sessions
                          @else
                            <i class="fa fa-users margin-r-5"></i> Starting Sessions
                          @endif
                        </dt>
                        <dd>
                          Click "join" button to start your sessions!
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt>
                          <i class="fa fa-edit margin-r-5"></i> Receiving Feedbacks
                        </dt>
                        <dd>
                          After each session ends, a "Form" button will appear replacing the meeting link.
                          Click the "Form" button to view feedbacks per session.<br />
                          Students are <b>required</b> to give feedbacks in order to complete their attendance information, for each session.
                          Their chances are limited to <b>three days</b> after the session ends.
                          You are permitted to remind the students to give feedbacks, respectively for each session.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt>
                          <i class="fa fa-file-text-o margin-r-5"></i> Attendance Form
                        </dt>
                        <dd>
                          For each session, attendance information can only be updated <b>10 minutes before the session ends until 30 minutes after the session ends.</b><br />
                          After submitting the form, you cannot update it anymore.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt>
                          <i class="fa fa-file-text-o margin-r-5"></i> More Information
                        </dt>
                        <dd>
                          Please consider that a minimum of <b>80% completed attendances (of all sessions)</b> is required for a student to get the course certificate.<br />
                          Reminding the students about what should they do, is subject to <b>NUSIA terms for Instructors.</b><br />
                          <span class="text-red">Contact NUSIA Admin or Lead Instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Schedules</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($sessions->toArray() != null)
                      <table class="table table-bordered example1">
                        <thead>
                          {{--<th style="width:2%;" class="text-right">#</th>--}}
                          <th>Title</th>
                          <th>Time</th>
                          <th style="width:5%;">Link</th>
                          <th style="width:10%;">Attendance</th>
                        </thead>
                        <tbody>
                          @foreach($sessions as $i => $dt)
                            <tr>
                              {{--<td class="text-right">{{ $i + 1 }}</td>--}}
                              <td>
                                <a href="#" data-toggle="modal" data-target="#Session{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                  {{ $dt->title }}
                                </a>
                              </td>
                              <td>
                                <?php
                                  $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                  $schedule_time_30_mins_after_end = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end_form = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->sub(10, 'minutes');
                                  $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                                  $schedule_time_30_mins_after_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
                                  $schedule_time_end_form->add($dt->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                                ?>
                                <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                  Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                @else
                                  {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                @endif
                              </td>
                              <td class="text-center">
                                @if($schedule_now <= $schedule_time_end)
                                  @if($dt->link_zoom)
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Join</a>
                                  @else
                                    <a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#">Join</a>
                                  @endif
                                @else
                                  <a href="#" data-toggle="modal" data-target="#Form{{$dt->id}}" class="btn btn-flat btn-xs btn-primary">Form</a>
                                @endif
                              </td>
                              <td class="text-center">
                                @if($schedule_now >= $schedule_time_10_mins_before_end && $schedule_now <= $schedule_time_30_mins_after_end)
                                  <a rel="noopener noreferrer" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.student_attendance.index', [$dt->course_id, $dt->id]) }}">Link</a>
                                @else
                                  <a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#">Link</a>
                                @endif
                              </td>
                            </tr>
                            <div class="modal fade" id="Session{{$dt->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="box box-primary">
                                    <div class="box-body box-profile">
                                      <h3 class="profile-username text-center"><b>{{ $dt->title }}</b></h3>
                                      <p class="text-muted text-center">
                                        Scheduled
                                        @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                          today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                        @else
                                          on {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                        @endif
                                      </p>
                                      <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                          {{ $dt->description }}
                                        </li>
                                      </ul>
                                      <button onclick="document.getElementById('Session{{$dt->id}}').className = 'modal fade'; document.getElementById('Session{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                    </div>
                                    <!-- /.box-body -->
                                  </div>
                                  <!-- /.box -->
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <div class="modal fade" id="Form{{$dt->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="box box-primary">
                                    <div class="box-body box-profile">
                                      <h3 class="profile-username text-center"><b>{{ $dt->title }}</b></h3>
                                      <p class="text-muted text-center">
                                        Received Feedbacks
                                      </p>
                                      <ul class="list-group list-group-unbordered">
                                        @foreach($dt->session_registrations as $sr)
                                          @if($sr->rating)
                                            <li class="list-group-item">
                                              {{ $sr->rating->rating }}: {{ $sr->rating->comment }}
                                            </li>
                                          @endif
                                        @endforeach
                                      </ul>
                                      <button onclick="document.getElementById('Form{{$dt->id}}').className = 'modal fade'; document.getElementById('Form{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                    </div>
                                    <!-- /.box-body -->
                                  </div>
                                  <!-- /.box -->
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          @endforeach
                        </tbody>
                      </table>
                      <hr>
                      <div class="box-header">
                        <h4><b>Modify Session Information</b></h4>
                        <p class="no-padding text-red">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('instructor.session_show.update') }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-12">
                                  <div class="form-group @error('session_id') has-error @enderror">
                                    <label for="session_id">
                                      Session ID
                                      <span class="text-red">*</span>
                                    </label>
                                    <select name="session_id" type="text" class="@error('session_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Session ID --</option>
                                      <?php
                                        $i = 0;
                                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                      ?>
                                      @foreach($sessions as $i => $dt)
                                        @if(old('session_id') == $dt->id))
                                          <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                        @else
                                          <option value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                        @endif
                                        <?php $i++; ?>
                                      @endforeach
                                    </select>
                                    @error('session_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <!--div class="form-group @error('to_session_id') has-error @enderror">
                                    <label for="to_session_id">
                                      To Session ID (optional, fill this to change multiple sessions at once)
                                    </label>
                                    <select name="to_session_id" type="text" class="@error('to_session_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Session ID --</option>
                                      <?php
                                        $i = 0;
                                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                      ?>
                                      @foreach($sessions as $i => $dt)
                                        @if(old('to_session_id') == $dt->id))
                                          <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                        @else
                                          <option value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                        @endif
                                        <?php $i++; ?>
                                      @endforeach
                                    </select>
                                    @error('to_session_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div-->
                                  <div class="form-group @error('session_description') has-error @enderror">
                                    <label for="session_description">Session Description</label>
                                    <textarea name="session_description" class="@error('session_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Session Description">{{ old('session_description') }}</textarea>
                                    @error('session_description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <div class="@error('link_zoom_flag') has-error @enderror">
                                      <label for="link_zoom_flag" class="control-label">Do you want to change the meeting link?</label><br />
                                      <select name="link_zoom_flag" id="link_zoom_flag" type="text" class="@error('link_zoom_flag') is-invalid @enderror form-control select2" style="width:100%;" onchange="if(document.getElementById('link_zoom_flag').value == 1) document.getElementById('link_zoom_div').className = ''; else document.getElementById('link_zoom_div').className = 'hidden';">
                                        <option selected="selected" value="0">-- Enter your choice --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                      </select>
                                      @error('link_zoom_flag')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="hidden" id="link_zoom_div">
                                      <br />
                                      <label for="link_zoom">Meeting Link (leave empty to remove the meeting link)</label>
                                      <input name="link_zoom" type="text" class="form-control" placeholder="Enter Meeting Link" value="{{ old('link_zoom') }}">
                                      @error('link_zoom')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;" onclick="if(confirm('Are you sure to submit this session information form?')) return true; else return false;">Submit</button>
                          </div>
                        </form>
                      </div>
                      <hr>
                      <div class="box-header">
                        <h4><b>Reschedule a Session</b></h4>
                        @if($course->course_package->course_type->count_student_max == 1)
                          <p class="no-padding text-red">* This field is required</p>
                        @endif
                      </div>
                      <div class="box-body">
                        @if($course->course_package->course_type->count_student_max == 1)
                          <form role="form" method="post" action="{{ route('instructor.session_reschedule.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group @error('session_id') has-error @enderror">
                                      <label for="session_id">
                                        Session ID
                                        <span class="text-red">*</span>
                                      </label>
                                      <select name="session_id" type="text" class="@error('session_id') is-invalid @enderror form-control">
                                        <option selected="selected" value="">-- Enter Session ID --</option>
                                        <?php
                                          $i = 0;
                                          $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                        ?>
                                        @foreach($sessions as $i => $dt)
                                          <?php
                                            $schedule_time_end = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                            $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                                          ?>
                                          @if(old('session_id') == $dt->id))
                                            <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                          @else
                                            <option value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                          @endif
                                        @endforeach
                                      </select>
                                      @error('session_id')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="form-group @error('schedule_time_date') has-error @enderror @error('schedule_time_time') has-error @enderror">
                                      <label for="schedule_time_date">Reschedule This Session to</label>
                                      <p class="text-red">The time schedule inputted is adjusted with your local time.</p>
                                      <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input name="schedule_time_date" type="text" class="form-control pull-right datepicker">
                                      </div>
                                      <label for="schedule_time_time" class="hidden">Schedule (set the time)</label><br />
                                      <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                        <input name="schedule_time_time" type="text" class="form-control pull-right timepicker">
                                      </div>
                                      @error('schedule_time_date')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                      @error('schedule_time_time')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        @else
                          <div class="text-muted text-center">
                            You cannot reschedule a group-based class.
                          </div>
                        @endif
                      </div>
                      <hr>
                      <div class="box-header">
                        <h4><b>Approve a Reschedule Request(s)</b></h4>
                      </div>
                      <div class="box-body">
                        @if($course->course_package->course_type->count_student_max == 1)
                          <table class="table table-bordered example1">
                            <thead>
                              {{--<th style="width:2%;" class="text-right">#</th>--}}
                              <th>Title</th>
                              <th>Current Time</th>
                              <th>Requested Time</th>
                              <th style="width:5%;">Link</th>
                            </thead>
                            <tbody>
                              @foreach($sessions as $i => $dt)
                                <tr>
                                  {{--<td class="text-right">{{ $i + 1 }}</td>--}}
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#Session{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td>
                                    <?php
                                      $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                      $schedule_time_end = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                      $schedule_time_end_form = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                      $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                                      $schedule_time_end_form->add($dt->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                                    ?>
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      <b>(Today)</b>
                                    @endif
                                    {{ $schedule_time_begin->isoFormat('MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                  </td>
                                  <td>
                                    @if($dt->requirement)
                                      <?php
                                        $reschedule_time_begin = \Carbon\Carbon::parse($dt->requirement)->setTimezone(Auth::user()->timezone);
                                        $reschedule_time_end = \Carbon\Carbon::parse($dt->requirement)->setTimezone(Auth::user()->timezone);
                                        $reschedule_time_end_form = \Carbon\Carbon::parse($dt->requirement)->setTimezone(Auth::user()->timezone);
                                        $reschedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                                        $reschedule_time_end_form->add($dt->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                                      ?>
                                      <span class="hidden">{{ $reschedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                      @if($reschedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                        <b>(Today)</b>
                                      @endif
                                      {{ $reschedule_time_begin->isoFormat('MMMM Do YYYY, hh:mm A') }} {{ $reschedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($dt->requirement)
                                      @if($dt->reschedule_technical_issue_student == '-1')
                                        <a href="#" data-toggle="modal" data-target="#Approval{{$dt->id}}" class="btn btn-flat btn-xs bg-purple">Action</a>
                                      @else
                                        {{--<a disabled href="#" class="btn btn-flat btn-xs btn-default btn-disabled" disabled>Pending</a>--}}
                                        <label class="label label-warning">Waiting</label>
                                      @endif
                                    @else
                                      -
                                    @endif
                                  </td>
                                </tr>
                                @if($dt->requirement)
                                  <div class="modal fade" id="Approval{{$dt->id}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="box box-primary">
                                          <div class="box-body box-profile">
                                              <h3 class="profile-username text-center"><b>Reschedule Confirmation for {{ $dt->title }}</b></h3>
                                              <p class="text-muted text-center">
                                                Rescheduled from
                                                @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                                  <b>today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}</b>
                                                @else
                                                  <b>{{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}</b>
                                                @endif
                                                <br />to
                                                @if($reschedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                                  <b>today, {{ $reschedule_time_begin->isoFormat('hh:mm A') }} {{ $reschedule_time_end->isoFormat('[-] hh:mm A') }}</b>
                                                @else
                                                  <b>{{ $reschedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $reschedule_time_end->isoFormat('[-] hh:mm A') }}</b>
                                                @endif
                                              </p>
                                              <div class="col-md-6">
                                                <form role="form" method="post" action="{{ route('instructor.session_reschedule_approval.update', [$dt->id]) }}" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="approval_status" value="1" id="approval_status">
                                                  <button type="submit" class="btn btn-s btn-primary" style="width:100%;" onclick="document.getElementById('approval_status').value = 1;">Accept</button>
                                                </form>
                                              </div>
                                              <div class="col-md-6">
                                                <form role="form" method="post" action="{{ route('instructor.session_reschedule_approval.update', [$dt->id]) }}" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="approval_status" value="0" id="approval_status">
                                                  <button type="submit" class="btn btn-s btn-danger" style="width:100%;" onclick="document.getElementById('approval_status').value = 0;">Decline</button>
                                                </form>
                                              </div>
                                              <br /><br />
                                            <div class="col-md-12">
                                              <button onclick="document.getElementById('Approval{{$dt->id}}').className = 'modal fade'; document.getElementById('Approval{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                            </div>
                                          </div>
                                          <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                @endif
                              @endforeach
                            </tbody>
                          </table>
                        @else
                          <div class="text-muted text-center">
                            You cannot reschedule a group-based class.
                          </div>
                        @endif
                      </div>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Attendance Information</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <strong><i class="fa fa-edit margin-r-5"></i> Types of Attendance Status</strong>
                    <p>
                      <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This session has not started yet.">Upcoming</label>
                      <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This session is in progress.">Ongoing</label>
                      <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This session attendance is being checked by your instructor.">Attendance Check</label>
                      <label data-toggle="tooltip" title class="label bg-red" data-original-title="You don't attend this session.">Not Present</label>
                      <label data-toggle="tooltip" title class="label bg-purple" data-original-title="You have attended this session, but are still required to complete the feedback form.">Should Submit Form</label>
                      <label data-toggle="tooltip" title class="label bg-green" data-original-title="You have attended this session and completed the feedback form for this session.">Present</label>
                    </p>
                    <hr>
                    @if($sessions->toArray() != null)
                      @foreach($sessions as $j => $s)
                        @if($j != 0)
                          <hr>
                        @endif
                        @if($s->session_registrations->toArray() != null)
                          <?php
                            $session_attendance_flag = 0; // 0 upcoming/ongoing/attendance check, 1 present/not present/should submit form
                            $count_present = 0;
                            $count_should_submit_form = 0;
                            $count_not_present = 0;
                            if($s->session_registrations->first()->status != 'Not Assigned') {
                              $session_attendance_flag = 1;
                              foreach($s->session_registrations as $sr) {
                                if($sr->status == 'Present') $count_present++;
                                else if($sr->status == 'Should Submit Form') $count_should_submit_form++;
                                else if($sr->status == 'Not Present') $count_not_present++;
                              }
                            }
                          ?>
                          <h4>
                            <b>{{ $s->title }}</b>
                            <div class="pull-right">
                              @if($session_attendance_flag)
                                <span data-toggle="tooltip" title class="badge bg-green" data-original-title="Present">{{ $count_present }}</span>
                                <span data-toggle="tooltip" title class="badge bg-purple" data-original-title="Should Submit Form">{{ $count_should_submit_form }}</span>
                                <span data-toggle="tooltip" title class="badge bg-red" data-original-title="Not Present">{{ $count_not_present }}</span>
                                <span data-toggle="tooltip" title class="badge bg-gray" data-original-title="Not Assigned">0</span>
                              @else
                                <span data-toggle="tooltip" title class="badge bg-green" data-original-title="Present">0</span>
                                <span data-toggle="tooltip" title class="badge bg-purple" data-original-title="Should Submit Form">0</span>
                                <span data-toggle="tooltip" title class="badge bg-red" data-original-title="Not Present">0</span>
                                <span data-toggle="tooltip" title class="badge bg-gray" data-original-title="Not Assigned">{{ $s->session_registrations->count() }}</span>
                              @endif
                            </div>
                          </h4>
                          <table class="table table-bordered example1">
                            <thead>
                              <th>Name</th>
                              <th style="width:20%;">Attendance</th>
                            </thead>
                            <tbody>
                              <?php
                                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                              ?>
                              @foreach($s->session_registrations as $dt)
                                <tr>
                                  <td>{{ $dt->course_registration->student->user->first_name }} {{ $dt->course_registration->student->user->last_name }}</td>
                                  <td>
                                    @if($dt->status == 'Not Assigned')
                                      <?php
                                        $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $dt->session->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                        $schedule_time_end = \Carbon\Carbon::parse(explode('||', $dt->session->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                        $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                      ?>
                                      @if($schedule_now < $schedule_time_begin)
                                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This session has not started yet.">Upcoming</label>
                                      @elseif($schedule_now < $schedule_time_end)
                                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This session is in progress.">Ongoing</label>
                                      @else
                                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This session attendance is being checked by your instructor.">Attendance Check</label>
                                      @endif
                                    @elseif($dt->status == 'Not Present')
                                      <label data-toggle="tooltip" title class="label bg-red" data-original-title="You don't attend this session.">Not Present</label>
                                    @elseif($dt->status == 'Should Submit Form')
                                      <label data-toggle="tooltip" title class="label bg-purple" data-original-title="You have attended this session, but are still required to complete the feedback form.">Should Submit Form</label>
                                    @elseif($dt->status == 'Present')
                                      <label data-toggle="tooltip" title class="label bg-green" data-original-title="You have attended this session and completed the feedback form for this session.">Present</label>
                                    @endif
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        @else
                          <h4><b>{{ $s->title }}</b></h4>
                          <div class="text-center">No data available.</div>
                        @endif
                      @endforeach
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="materials">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assigned in <b>{{ $course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course->course_package->count_session
                        --}}
                        {{ $sessions->count() }}
                        @if($sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-files-o margin-r-5"></i> Note</dt>
                        <dd>
                          Click "link" button to download the materials!<br />
                          <span class="text-red">Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Main Materials</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->course_package->material_publics)
                      <table class="table table-bordered example1">
                        <thead>
                          <th class="text-right">#</th>
                          <th>File Name</th>
                          <th style="width:25%;">File Type</th>
                          <th style="width:5%;">Link</th>
                          <th style="width:5%;">Delete</th>
                        </thead>
                        <tbody>
                          @foreach($course->course_package->material_publics as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>
                                <a href="#" data-toggle="modal" data-target="#MainMaterial{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                  {{ $dt->name }}
                                </a>
                              </td>
                              <td>
                                @if($dt->path)
                                  @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                    Link
                                  @else
                                    {{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }}
                                  @endif
                                @else
                                  <i class="text-muted">N/A</i>
                                @endif
                              </td>
                              <td class="text-center">
                                @if($dt->path)
                                  @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                    <a target="_blank" rel="noopener noreferrer nofollow" class="btn btn-flat btn-xs btn-success" href="{{ $dt->path }}">Link</a>
                                  @else
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.material.download', [1, $dt->id]) }}">Link</a>
                                  @endif
                                @else
                                  <i class="text-muted">-</i>
                                @endif
                              </td>
                              <td class="text-center">
                                <form role="form" method="post" action="{{ route('instructor.material.destroy', [$course->id, 1, $dt->id]) }}">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('Are you sure to delete this material: {{ $dt->name }} ?')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                            <div class="modal fade" id="MainMaterial{{$dt->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="box box-primary">
                                    <div class="box-body box-profile">
                                      <h3 class="profile-username text-center"><b>{{ $dt->name }}</b></h3>
                                      <p class="text-muted text-center">
                                        Main Material
                                      </p>
                                      <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                          @if($dt->description)
                                            {{ $dt->description }}
                                          @else
                                            <i class="text-muted">No information for this material.</i>
                                          @endif
                                        </li>
                                      </ul>
                                      <button onclick="document.getElementById('MainMaterial{{$dt->id}}').className = 'modal fade'; document.getElementById('MainMaterial{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                    </div>
                                    <!-- /.box-body -->
                                  </div>
                                  <!-- /.box -->
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          @endforeach
                        </tbody>
                      </table>
                      @if(Auth::user()->roles == 'Instructor')
                        <hr>
                        <div class="box-header">
                          <h4><b>Add or Modify a Main Material</b></h4>
                          <p class="no-padding text-red">* This field is required</p>
                        </div>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('instructor.material.update', [$course->id, 1]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                    <div class="form-group @error('material_public_id') has-error @enderror">
                                      <label for="material_public_id">
                                        Main Material ID
                                        <span class="text-red">*</span>
                                      </label>
                                      <select name="material_public_id" type="text" class="@error('material_public_id') is-invalid @enderror form-control">
                                        <option selected="selected" value="">-- Enter Main Material ID --</option>
                                        <option value="0">Add a New Material</option>
                                        @foreach($course->course_package->material_publics as $i => $mp)
                                          @if(old('material_public_id') == $mp->id))
                                            <option selected="selected" value="{{ $mp->id }}">#{{ $i + 1 }} - {{ $mp->name }}</option>
                                          @else
                                            <option value="{{ $mp->id }}">#{{ $i + 1 }} - {{ $mp->name }}</option>
                                          @endif
                                          <?php $i++; ?>
                                        @endforeach
                                      </select>
                                      @error('material_public_id')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group @error('material_public_session_name') has-error @enderror">
                                      <label for="material_public_session_name">
                                        For Session
                                        <span class="text-red">*</span>
                                      </label>
                                      <select name="material_public_session_name" type="text" class="@error('material_public_session_name') is-invalid @enderror form-control">
                                        <option selected="selected" value="">-- Enter Session Name --</option>
                                        @foreach($sessions as $i => $dt)
                                          @if(old('material_public_session_name') == $dt->id))
                                            <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                          @else
                                            <option value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                          @endif
                                          <?php $i++; ?>
                                        @endforeach
                                      </select>
                                      @error('material_public_session_name')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group @error('material_public_name') has-error @enderror">
                                      <label for="material_public_name">
                                        Material Name
                                        <span class="text-red">*</span>
                                      </label>
                                      <input name="material_public_name" value="{{ old('material_public_name') }}" type="text" class="@error('material_public_name') is-invalid @enderror form-control" placeholder="Enter Material Name">
                                      @error('material_public_name')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="form-group @error('material_public_description') has-error @enderror">
                                      <label for="material_public_description">
                                        Material Description
                                      </label>
                                      <textarea name="material_public_description" class="@error('material_public_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Material Description">{{ old('material_public_description') }}</textarea>
                                      @error('material_public_description')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="form-group @error('material_public_path_type') has-error @enderror">
                                      <label for="material_public_path_type">
                                        Insert a Link or Upload a File
                                        <span class="text-red">*</span>
                                      </label>
                                      <select id="material_public_path_type" name="material_public_path_type" type="text" class="@error('material_public_path_type') is-invalid @enderror form-control" onchange="if(document.getElementById('material_public_path_type').value == 'link') { document.getElementById('material_public_path_link_div').className = 'form-group'; document.getElementById('material_public_path_file_div').className = 'form-group hidden'; } else if(document.getElementById('material_public_path_type').value == 'file') { document.getElementById('material_public_path_link_div').className = 'form-group hidden'; document.getElementById('material_public_path_file_div').className = 'form-group'; } else { document.getElementById('material_public_path_link_div').className = 'form-group hidden'; document.getElementById('material_public_path_file_div').className = 'form-group hidden'; }">
                                        <option selected="selected" value="0">-- Enter Your Choice --</option>
                                        <option value="link">Insert a Link</option>
                                        <option value="file">Upload a File</option>
                                      </select>
                                      @error('material_public_path_type')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div id="material_public_path_link_div" class="form-group @error('material_public_path_link') has-error @enderror hidden">
                                      <label for="material_public_path_link">
                                        Insert a Link
                                        <span class="text-red">*</span>
                                      </label>
                                      <input name="material_public_path_link" value="{{ old('material_public_path_link') }}" type="text" class="@error('material_public_path_link') is-invalid @enderror form-control" placeholder="Enter a Link">
                                      @error('material_public_path_link')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div id="material_public_path_file_div" class="form-group @error('material_public_path_file') has-error @enderror hidden">
                                      <label for="material_public_path_file">
                                        Upload File (any type)
                                        <span class="text-red">*</span>
                                      </label>
                                      <p class="text-red" style="padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                      <p class="text-red" style="padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                      <input name="material_public_path_file" type="file" accept="*" class="@error('material_public_path_file') is-invalid @enderror form-control">
                                      @error('material_public_path_file')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      @endif
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                @foreach($sessions as $i => $s)
                  <div class="box box-warning" hidden>
                    <div class="box-header">
                      <h3 class="box-title"><b>Supplementary Materials for #{{ $i + 1 }} - {{ $s->title }}</b></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      @if($s->material_sessions->toArray())
                        <table class="table table-bordered example1">
                          <thead>
                            <th style="width:2%;" class="text-right">#</th>
                            <th>File Name</th>
                            <th style="width:25%;">File Type</th>
                            <th style="width:5%;">Link</th>
                            <th style="width:5%;">Delete</th>
                          </thead>
                          <tbody>
                            @foreach($s->material_sessions as $j => $dt)
                              <tr>
                                <td class="text-right">{{ $j + 1 }}</td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#SupplementaryMaterial{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                    {{ $dt->name }}
                                  </a>
                                </td>
                                <td>
                                  @if($dt->path)
                                    @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                      Link
                                    @else
                                      {{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }}
                                    @endif
                                  @else
                                    <i class="text-muted">N/A</i>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($dt->path)
                                    @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                      <a target="_blank" rel="noopener noreferrer nofollow" class="btn btn-flat btn-xs btn-success" href="{{ $dt->path }}">Link</a>
                                    @else
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.material.download', [2, $dt->id]) }}">Link</a>
                                    @endif
                                  @else
                                    <i class="text-muted">-</i>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <form role="form" method="post" action="{{ route('instructor.material.destroy', [$course->id, 2, $dt->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('Are you sure to delete this material: {{ $dt->name }} ?')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                              <div class="modal fade" id="SupplementaryMaterial{{$dt->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                        <h3 class="profile-username text-center"><b>{{ $dt->name }}</b></h3>
                                        <p class="text-muted text-center">
                                          Supplementary Material for #{{ $i + 1 }} - {{ $s->title }}
                                        </p>
                                        <ul class="list-group list-group-unbordered">
                                          <li class="list-group-item">
                                            @if($dt->description)
                                              {{ $dt->description }}
                                            @else
                                              <i class="text-muted">No information for this material.</i>
                                            @endif
                                          </li>
                                        </ul>
                                        <button onclick="document.getElementById('SupplementaryMaterial{{$dt->id}}').className = 'modal fade'; document.getElementById('SupplementaryMaterial{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                            @endforeach
                          </tbody>
                        </table>
                        <hr>
                        <div class="box-header">
                          <h4><b>Add or Modify a Supplementary Material for {{ $s->title }}</b></h4>
                          <p class="no-padding text-red">* This field is required</p>
                        </div>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('instructor.material.update', [$course->id, 2]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="material_session_updated_id" value="{{ $s->id }}">
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group @error('material_session_id') has-error @enderror">
                                      <label for="material_session_id">
                                        Supplementary Material ID
                                        <span class="text-red">*</span>
                                      </label>
                                      <select name="material_session_id" type="text" class="@error('material_session_id') is-invalid @enderror form-control">
                                        <option selected="selected" value="">-- Enter Supplementary Material ID --</option>
                                        <option value="0">Add a New Material</option>
                                        @foreach($s->material_sessions as $i => $ms)
                                          @if(old('material_session_id') == $ms->id))
                                            <option selected="selected" value="{{ $ms->id }}">#{{ $i + 1 }} - {{ $ms->name }}</option>
                                          @else
                                            <option value="{{ $ms->id }}">#{{ $i + 1 }} - {{ $ms->name }}</option>
                                          @endif
                                          <?php $i++; ?>
                                        @endforeach
                                      </select>
                                      @error('material_session_id')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="form-group @error('material_session_name') has-error @enderror">
                                      <label for="material_session_name">
                                        Material Name
                                        <span class="text-red">*</span>
                                      </label>
                                      <input name="material_session_name" value="{{ old('material_session_name') }}" type="text" class="@error('material_session_name') is-invalid @enderror form-control" placeholder="Enter Material Name">
                                      @error('material_session_name')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="form-group @error('material_session_description') has-error @enderror">
                                      <label for="material_session_description">
                                        Material Description
                                      </label>
                                      <textarea name="material_session_description" class="@error('material_session_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Material Description">{{ old('material_session_description') }}</textarea>
                                      @error('material_session_description')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div class="form-group @error('material_session_path_type') has-error @enderror">
                                      <label for="material_session_path_type">
                                        Insert a Link or Upload a File
                                        <span class="text-red">*</span>
                                      </label>
                                      <select id="material_session_path_type{{ $s->id }}" name="material_session_path_type" type="text" class="@error('material_session_path_type') is-invalid @enderror form-control" onchange="if(document.getElementById('material_session_path_type{{ $s->id }}').value == 'link') { document.getElementById('material_session_path_link_div{{ $s->id }}').className = 'form-group'; document.getElementById('material_session_path_file_div{{ $s->id }}').className = 'form-group hidden'; } else if(document.getElementById('material_session_path_type{{ $s->id }}').value == 'file') { document.getElementById('material_session_path_link_div{{ $s->id }}').className = 'form-group hidden'; document.getElementById('material_session_path_file_div{{ $s->id }}').className = 'form-group'; } else { document.getElementById('material_session_path_link_div{{ $s->id }}').className = 'form-group hidden'; document.getElementById('material_session_path_file_div{{ $s->id }}').className = 'form-group hidden'; }">
                                        <option selected="selected" value="0">-- Enter Your Choice --</option>
                                        <option value="link">Insert a Link</option>
                                        <option value="file">Upload a File</option>
                                      </select>
                                      @error('material_session_path_type')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div id="material_session_path_link_div{{ $s->id }}" class="form-group @error('material_session_path_link') has-error @enderror hidden">
                                      <label for="material_session_path_link">
                                        Insert a Link
                                        <span class="text-red">*</span>
                                      </label>
                                      <input name="material_session_path_link" value="{{ old('material_session_path_link') }}" type="text" class="@error('material_session_path_link') is-invalid @enderror form-control" placeholder="Enter a Link">
                                      @error('material_session_path_link')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                    <div id="material_session_path_file_div{{ $s->id }}" class="form-group @error('material_session_path_file') has-error @enderror hidden">
                                      <label for="material_session_path_file">
                                        Upload File (any type)
                                        <span class="text-red">*</span>
                                      </label>
                                      <p class="text-red" style="padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                      <p class="text-red" style="padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                      <input name="material_session_path_file" type="file" accept="*" class="@error('material_session_path_file') is-invalid @enderror form-control">
                                      @error('material_session_path_file')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      @else
                        <div class="text-center">No data available.</div>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tasks">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assigned in <b>{{ $course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course->course_package->count_session
                        --}}
                        {{ $sessions->count() }}
                        @if($sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-download margin-r-5"></i> File Download</dt>
                        <dd>
                          Click "link" button to download each task given!
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-upload margin-r-5"></i> Task Submission</dt>
                        <dd>
                          After completing a task, fill out the submission form and click "submit" button!<br />
                          If you have uploaded a file, please check whether the file has been submitted successfully.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
                        <dd>
                          Please note the due time for each task.<br />
                          <span class="text-red">Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <?php
                  $task_submission_flag = 0;
                  $assignment_flag = 0;
                  $exam_flag = 0;
                  foreach($sessions as $s) {
                    foreach($s->tasks as $dt) {
                      $task_submission_flag++;
                      if($dt->type == 'Assignment')
                        $assignment_flag++;
                      else if($dt->type == 'Exam')
                        $exam_flag++;
                      if($task_submission_flag > 1 && $assignment_flag > 1 && $exam_flag > 1)
                        break;
                    }
                    if($task_submission_flag > 1 && $assignment_flag > 1 && $exam_flag > 1)
                      break;
                  }
                ?>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Assignments</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($assignment_flag)
                      <table class="table table-bordered example1">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Task</th>
                          <th>Due Time</th>
                          <th style="width:5%;">Link</th>
                          <th style="width:5%;">Delete</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($sessions as $s)
                            @foreach($s->tasks as $dt)
                              @if($dt->type == 'Assignment')
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#Assignment{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td>
                                    <?php
                                      $time_due = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone);
                                    ?>
                                    @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $time_due->isoFormat('hh:mm A') }}
                                    @else
                                      {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($dt->path_1)
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.assignment.download', [$course->id, $dt->id]) }}">Link</a>
                                    @else
                                      <i class="text-muted">-</i>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    <form role="form" method="post" action="{{ route('instructor.assignment.destroy', [$course->id, $dt->id]) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('Are you sure to delete this assignment: {{ $dt->title }} ?')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                    </form>
                                  </td>
                                </tr>
                                <div class="modal fade" id="Assignment{{$dt->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="box box-primary">
                                        <div class="box-body box-profile">
                                          <h3 class="profile-username text-center">Task: <b>{{ $dt->title }}</b></h3>
                                          <p class="text-muted text-center">
                                            Due time:
                                            @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                              Today, {{ $time_due->isoFormat('hh:mm A') }}
                                            @else
                                              {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                            @endif
                                          </p>
                                          <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                              @if($dt->description)
                                                {{ $dt->description }}
                                              @else
                                                <i class="text-muted">No information for this assignment.</i>
                                              @endif
                                            </li>
                                          </ul>
                                          <button onclick="document.getElementById('Assignment{{$dt->id}}').className = 'modal fade'; document.getElementById('Assignment{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                                <?php $i++; ?>
                              @endif
                            @endforeach
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div class="text-center">
                        There is no assignments here... :(<br />
                        Kindly check periodically.
                      </div>
                    @endif
                    @if(1)
                      <div class="box-header">
                        <h4><b>Add or Modify an Assignment</b></h4>
                        <p class="no-padding text-red">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('instructor.assignment.update', [$course->id]) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="type" value="Assignment">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group @error('assignment_id') has-error @enderror">
                                    <label for="assignment_id">
                                      Assignment ID
                                      <span class="text-red">*</span>
                                    </label>
                                    <select name="assignment_id" type="text" class="@error('assignment_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Assignment ID --</option>
                                      <option value="0">Add a New Assignment</option>
                                      <?php
                                        $i = 0;
                                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                      ?>
                                      @foreach($sessions as $s)
                                        @foreach($s->tasks as $dt)
                                          @if($dt->type == 'Assignment')
                                            <?php $due_date = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone); ?>
                                            @if($schedule_now <= $due_date)
                                              @if(old('assignment_id') == $dt->id))
                                                <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} {{ $dt->title }}</option>
                                              @else
                                                <option value="{{ $dt->id }}">#{{ $i + 1 }} {{ $dt->title }}</option>
                                              @endif
                                              <?php $i++; ?>
                                            @endif
                                          @endif
                                        @endforeach
                                      @endforeach
                                    </select>
                                    @error('assignment_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group @error('assignment_session_id') has-error @enderror">
                                    <label for="assignment_session_id">
                                      For Session
                                      <span class="text-red">*</span>
                                    </label>
                                    <select name="assignment_session_id" type="text" class="@error('assignment_session_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Session Name --</option>
                                      @foreach($sessions as $i => $dt)
                                        <?php $schedule_time = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone); ?>
                                        @if($schedule_now <= $schedule_time->add(3, 'days'))
                                          @if(old('assignment_session_id') == $dt->id))
                                            <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                          @else
                                            <option value="{{ $dt->id }}">#{{ $i + 1 }} - {{ $dt->title }}</option>
                                          @endif
                                        @endif
                                        <?php $i++; ?>
                                      @endforeach
                                    </select>
                                    @error('assignment_session_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_title') has-error @enderror">
                                    <label for="assignment_title">
                                      Assignment Name
                                      <span class="text-red">*</span>
                                    </label>
                                    <input name="assignment_title" value="{{ old('assignment_title') }}" type="text" class="@error('assignment_title') is-invalid @enderror form-control" placeholder="Enter Assignment Name">
                                    @error('assignment_title')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_description') has-error @enderror">
                                    <label for="assignment_description">
                                      Assignment Description
                                    </label>
                                    <textarea name="assignment_description" class="@error('assignment_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Assignment Description">{{ old('assignment_description') }}</textarea>
                                    @error('assignment_description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_due_date_date') has-error @enderror @error('assignment_due_date_date') has-error @enderror">
                                    <label for="assignment_due_date_date">
                                      Assignment Due Time
                                      <span class="text-red">*</span>
                                    </label>
                                    <p class="text-red">The due time inputted is adjusted with your local time.</p>
                                    <div class="input-group date">
                                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                      <input name="assignment_due_date_date" type="text" class="form-control pull-right datepicker">
                                    </div>
                                    <label for="assignment_due_date_time" class="hidden">Assignment due time (set the time for the next input form)</label><br />
                                    <div class="input-group">
                                      <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                      <input name="assignment_due_date_time" type="text" class="form-control pull-right timepicker">
                                    </div>
                                    @error('assignment_due_date_date')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                    @error('assignment_due_date_time')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('assignment_path_1') has-error @enderror">
                                    <label for="assignment_path_1">Upload File (any type)</label>
                                    <p class="text-red" style="padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p class="text-red" style="padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <input name="assignment_path_1" type="file" accept="*" class="@error('assignment_path_1') is-invalid @enderror form-control">
                                    @error('assignment_path_1')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                          </div>
                        </form>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Exam</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($exam_flag)
                      <table class="table table-bordered example1">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Task</th>
                          <th>Due Date</th>
                          <th style="width:5%;">Link</th>
                          <th style="width:5%;">Delete</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($sessions as $s)
                            @foreach($s->tasks as $dt)
                              @if($dt->type == 'Exam')
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#Exam{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td>
                                    <?php
                                      $time_due = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone);
                                    ?>
                                    @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $time_due->isoFormat('hh:mm A') }}
                                    @else
                                      {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($dt->path_1)
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.exam.download', [$course->id, $dt->id]) }}">Link</a>
                                    @else
                                      <i class="text-muted">-</i>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    <form role="form" method="post" action="{{ route('instructor.exam.destroy', [$course->id, $dt->id]) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('Are you sure to delete this exam: {{ $dt->title }} ?')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                    </form>
                                  </td>
                                </tr>
                                <div class="modal fade" id="Exam{{$dt->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="box box-primary">
                                        <div class="box-body box-profile">
                                          <h3 class="profile-username text-center">Task: <b>{{ $dt->title }}</b></h3>
                                          <p class="text-muted text-center">
                                            Due time:
                                            @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                              Today, {{ $time_due->isoFormat('hh:mm A') }}
                                            @else
                                              {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                            @endif
                                          </p>
                                          <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                              @if($dt->description)
                                                {{ $dt->description }}
                                              @else
                                                <i class="text-muted">No information for this exam.</i>
                                              @endif
                                            </li>
                                          </ul>
                                          <button onclick="document.getElementById('Exam{{$dt->id}}').className = 'modal fade'; document.getElementById('Exam{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                                <?php $i++; ?>
                              @endif
                            @endforeach
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div class="text-center">
                        There is no exam here... :(<br />
                        Kindly check periodically.
                      </div>
                    @endif
                    @if(1)
                      <div class="box-header">
                        <h4><b>Add or Modify an Exam</b></h4>
                        <p class="no-padding text-red">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('instructor.exam.update', [$course->id]) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="type" value="Exam">
                          <?php
                            $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                            $session_mid_id = ceil($sessions->count() / 2);
                            $session_last_id = $sessions->count();
                            foreach($sessions as $i => $s) {
                              if($i + 1 == $session_mid_id) {
                                $session_mid_id = $s->id;
                              } else if($i + 1 == $session_last_id) {
                                $session_last_id = $s->id;
                              }
                            }
                            $already_has_mid_exam = 0;
                            $already_has_final_exam = 0;
                            $can_edit_mid_exam = 1;
                            $can_edit_final_exam = 1;
                            foreach($sessions as $s) foreach($s->tasks as $t) if($t->type == 'Exam') {
                              $due_date = \Carbon\Carbon::parse($t->due_date)->setTimezone(Auth::user()->timezone);
                              if($t->session_id == $session_mid_id) {
                                $already_has_mid_exam = 1;
                                if($schedule_now > $due_date) $can_edit_mid_exam = 0;
                              }
                              else if($t->session_id == $session_last_id) {
                                $already_has_final_exam = 1;
                                if($schedule_now > $due_date) $can_edit_final_exam = 0;
                              }
                              if($already_has_mid_exam && $already_has_final_exam) break;
                            }
                          ?>
                          {{-- GANTI PADA BARIS SETELAH INI UNTUK input hidden, untuk session_mid_id dsb --}}
                          <input type="hidden" name="session_mid_id" value="{{ $session_mid_id }}">
                          <input type="hidden" name="session_last_id" value="{{ $session_last_id }}">
                          <input type="hidden" name="already_has_mid_exam" value="{{ $already_has_mid_exam }}">
                          <input type="hidden" name="already_has_final_exam" value="{{ $already_has_final_exam }}">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_session_id') has-error @enderror">
                                    <label for="exam_session_id">
                                      Exam ID
                                      <span class="text-red">*</span>
                                    </label>
                                    <select name="exam_session_id" type="text" class="@error('exam_session_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Exam ID --</option>
                                      @if($can_edit_mid_exam)
                                        @if($already_has_mid_exam)
                                          <option value="{{ $session_mid_id }}">Mid Exam (Edit)</option>
                                        @else
                                          <option value="{{ $session_mid_id }}">Mid Exam</option>
                                        @endif
                                      @endif
                                      @if($can_edit_final_exam)
                                        @if($already_has_final_exam)
                                          <option value="{{ $session_last_id }}">Final Exam (Edit)</option>
                                        @else
                                          <option value="{{ $session_last_id }}">Final Exam</option>
                                        @endif
                                      @endif
                                    </select>
                                    @error('exam_session_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_title') has-error @enderror">
                                    <label for="exam_title">
                                      Exam Name
                                      <span class="text-red">*</span>
                                    </label>
                                    <input name="exam_title" value="{{ old('exam_title') }}" type="text" class="@error('exam_title') is-invalid @enderror form-control" placeholder="Enter Exam Name">
                                    @error('exam_title')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_description') has-error @enderror">
                                    <label for="exam_description">
                                      Exam Description
                                    </label>
                                    <textarea name="exam_description" class="@error('exam_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Exam Description">{{ old('exam_description') }}</textarea>
                                    @error('exam_description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_due_date_date') has-error @enderror @error('exam_due_date_date') has-error @enderror">
                                    <label for="exam_due_date_date">
                                      Exam Due Time
                                      <span class="text-red">*</span>
                                    </label>
                                    <p class="text-red">The due time inputted is adjusted with your local time.</p>
                                    <div class="input-group date">
                                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                      <input name="exam_due_date_date" type="text" class="form-control pull-right datepicker">
                                    </div>
                                    <label for="exam_due_date_time" class="hidden">Exam due time (set the time for the next input form)</label><br />
                                    <div class="input-group">
                                      <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                      <input name="exam_due_date_time" type="text" class="form-control pull-right timepicker">
                                    </div>
                                    @error('exam_due_date_date')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                    @error('exam_due_date_time')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('exam_path_1') has-error @enderror">
                                    <label for="exam_path_1">Upload File (any type)</label>
                                    <p class="text-red" style="padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p class="text-red" style="padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <input name="exam_path_1" type="file" accept="*" class="@error('exam_path_1') is-invalid @enderror form-control">
                                    @error('exam_path_1')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                          </div>
                        </form>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="grades">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assigned in <b>{{ $course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course->course_package->count_session
                        --}}
                        {{ $sessions->count() }}
                        @if($sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-commenting-o margin-r-5"></i> Note</dt>
                        <dd>
                          Each task submission and grading (including exam) can be found here.<br />
                          Click on each task's title to view your submission
                          @if($task_submission_flag != 1)
                            details
                          @else
                            detail
                          @endif
                          and your instructor's reply for your
                          @if($task_submission_flag != 1)
                            submissions
                          @else
                            submission
                          @endif
                          (after being checked)!<br />
                          <span class="text-red">Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">
                      <b>
                        @if($assignment_flag != 1)
                          Submissions
                        @else
                          Submission
                        @endif
                        for Assignments
                      </b>
                    </h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($assignment_flag)
                      <table class="table table-bordered example1">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th style="width:25%;">Task</th>
                          <th style="width:5%;">Average Score</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($sessions as $s)
                            @foreach($s->tasks as $dt)
                              @if($dt->type == 'Assignment')
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#AssignmentGrading{{$dt->id}}">
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td class="text-right">
                                    <?php
                                      $assignment_score = 0;
                                      $count = 0;
                                      foreach($dt->task_submissions as $ts) {
                                        if($ts->score) {
                                          $assignment_score += $ts->score;
                                          $count++;
                                        }
                                      }
                                    ?>
                                    @if($assignment_score)
                                      {{ $assignment_score / $count }}
                                    @else
                                      <i class="text-muted">-</i>
                                    @endif
                                  </td>
                                </tr>
                                <div class="modal fade" id="AssignmentGrading{{$dt->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="box box-primary">
                                        <div class="box-body box-profile">
                                          <h3 class="profile-username text-center">Submission for: <b>{{ $dt->title }}</b></h3>
                                          <p class="text-muted text-center">Type: <b>Assignment</b></p>
                                          <ul class="list-group list-group-unbordered">
                                            <?php $j = 0; $flag = 0; ?>
                                            @foreach($task_submissions as $ts)
                                              @if($ts->task_id == $dt->id)
                                                <?php $flag = 1; ?>
                                                <li class="list-group-item">
                                                  @if($ts->path_1)
                                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.assignment_submission.download', [$course->id, $ts->id]) }}"><i class="fa fa-download"></i>&nbsp;&nbsp;Download File</a>
                                                      <br />
                                                  @endif
                                                  <b><u>Submission #{{ $j + 1 }}</u></b> (
                                                    <?php
                                                      $submission_time = \Carbon\Carbon::parse($ts->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                                    ?>
                                                    {{ $submission_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                                    )<br />
                                                  <b>Student name:</b> {{ $ts->session_registration->course_registration->student->user->first_name }} {{ $ts->session_registration->course_registration->student->user->last_name }}<br />
                                                  <b>Title:</b> {{ $ts->title }}<br />
                                                  <b>Description:</b>
                                                    {{ $ts->description }}<br />
                                                  <b>Submission status:</b>
                                                    @if($ts->status == 'Accepted')
                                                      <b style="color:#007700;">Checked</b><br />
                                                    @else
                                                      <i class="text-muted">N/A</i><br />
                                                    @endif
                                                  @if($ts->status == 'Accepted')
                                                    <b>Score:</b>
                                                      {{ $ts->score }}<br />
                                                    <b>Instructor reply:</b><br />
                                                      {{ $ts->instructor_reply }}<br />
                                                  @else
                                                    <?php $has_more_recent_submission = 0; $has_more_than_one_submission = 0; ?>
                                                    @foreach($task_submissions as $ts1)
                                                      @if($ts->id != $ts1->id && $ts->task_id == $ts1->task_id && $ts->session_registration_id == $ts1->session_registration_id)
                                                        <?php $has_more_than_one_submission = 1; ?>
                                                        @if($ts->path_1_submitted_at < $ts1->path_1_submitted_at)
                                                          <?php $has_more_recent_submission = 1; ?>
                                                          @break
                                                        @endif
                                                      @endif
                                                    @endforeach
                                                    @if(($has_more_than_one_submission == 1 && $has_more_recent_submission == 0) || $has_more_than_one_submission == 0)
                                                      <form role="form" method="post" action="{{ route('instructor.assignment_submission.update', [$course->id, $ts->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group @error('assignment_submission_score') has-error @enderror">
                                                          <label for="assignment_submission_score">
                                                            Add score:
                                                            <span class="text-red">*</span>
                                                          </label>
                                                          <input name="assignment_submission_score" value="{{ old('assignment_submission_score') }}" type="text" class="@error('assignment_submission_score') is-invalid @enderror form-control" placeholder="Enter Score">
                                                          @error('assignment_submission_score')
                                                            <p style="color:red">{{ $message }}</p>
                                                          @enderror
                                                        </div>
                                                        <div class="form-group @error('assignment_submission_instructor_reply') has-error @enderror">
                                                          <label for="assignment_submission_instructor_reply">
                                                            Add instructor reply:
                                                            <span class="text-red">*</span>
                                                          </label>
                                                          <textarea name="assignment_submission_instructor_reply" class="@error('assignment_submission_instructor_reply') is-invalid @enderror form-control" rows="5" placeholder="Enter Instructor Reply">{{ old('assignment_submission_instructor_reply') }}</textarea>
                                                          @error('assignment_submission_instructor_reply')
                                                            <p style="color:red">{{ $message }}</p>
                                                          @enderror
                                                        </div>
                                                        <div class="form-group">
                                                          <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                                                        </div>
                                                      </form>
                                                    @endif
                                                  @endif
                                                </li>
                                                <?php $j++; ?>
                                              @endif
                                            @endforeach
                                            @if($flag == 0)
                                              <li class="list-group-item">
                                                There are no submissions for this assignment.
                                              </li>
                                            @endif
                                          </ul>
                                          <button onclick="document.getElementById('AssignmentGrading{{$dt->id}}').className = 'modal fade'; document.getElementById('AssignmentGrading{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                                <?php $i++; ?>
                              @endif
                            @endforeach
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">
                      <b>
                        @if($exam_flag != 1)
                          Submissions
                        @else
                          Submission
                        @endif
                        for Exam
                      </b>
                    </h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($exam_flag)
                      <table class="table table-bordered example1">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th style="width:25%;">Task</th>
                          <th style="width:5%;">Average Score</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($sessions as $s)
                            @foreach($s->tasks as $dt)
                              @if($dt->type == 'Exam')
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#ExamGrading{{$dt->id}}">
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td class="text-right">
                                    <?php
                                      $exam_score = 0;
                                      $count = 0;
                                      foreach($dt->task_submissions as $ts) {
                                        if($ts->score) {
                                          $exam_score += $ts->score;
                                          $count++;
                                        }
                                      }
                                    ?>
                                    @if($exam_score)
                                      {{ $exam_score / $count }}
                                    @else
                                      <i class="text-muted">-</i>
                                    @endif
                                  </td>
                                </tr>
                                <div class="modal fade" id="ExamGrading{{$dt->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="box box-primary">
                                        <div class="box-body box-profile">
                                          <h3 class="profile-username text-center">Submission for: <b>{{ $dt->title }}</b></h3>
                                          <p class="text-muted text-center">Type: <b>Exam</b></p>
                                          <ul class="list-group list-group-unbordered">
                                            <?php $j = 0; $flag = 0; ?>
                                            @foreach($task_submissions as $ts)
                                              @if($ts->task_id == $dt->id)
                                                <?php $flag = 1; ?>
                                                <li class="list-group-item">
                                                  @if($ts->path_1)
                                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.exam_submission.download', [$course->id, $ts->id]) }}"><i class="fa fa-download"></i>&nbsp;&nbsp;Download File</a>
                                                      <br />
                                                  @endif
                                                  <b><u>Submission #{{ $j + 1 }}</u></b> (
                                                    <?php
                                                      $submission_time = \Carbon\Carbon::parse($ts->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                                    ?>
                                                    {{ $submission_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                                    )<br />
                                                  <b>Student name:</b> {{ $ts->session_registration->course_registration->student->user->first_name }} {{ $ts->session_registration->course_registration->student->user->last_name }}<br />
                                                  <b>Title:</b> {{ $ts->title }}<br />
                                                  <b>Description:</b>
                                                    {{ $ts->description }}<br />
                                                  <b>Submission status:</b>
                                                    @if($ts->status == 'Accepted')
                                                      <b style="color:#007700;">Checked</b><br />
                                                    @else
                                                      <i class="text-muted">N/A</i><br />
                                                    @endif
                                                  @if($ts->status == 'Accepted')
                                                    <b>Score:</b>
                                                      {{ $ts->score }}<br />
                                                    <b>Instructor reply:</b><br />
                                                      {{ $ts->instructor_reply }}<br />
                                                  @else
                                                    <?php $has_more_recent_submission = 0; $has_more_than_one_submission = 0; ?>
                                                    @foreach($task_submissions as $ts1)
                                                      @if($ts->id != $ts1->id && $ts->task_id == $ts1->task_id && $ts->session_registration_id == $ts1->session_registration_id)
                                                        <?php $has_more_than_one_submission = 1; ?>
                                                        @if($ts->path_1_submitted_at < $ts1->path_1_submitted_at)
                                                          <?php $has_more_recent_submission = 1; ?>
                                                          @break
                                                        @endif
                                                      @endif
                                                    @endforeach
                                                    @if(($has_more_than_one_submission == 1 && $has_more_recent_submission == 0) || $has_more_than_one_submission == 0)
                                                      <form role="form" method="post" action="{{ route('instructor.exam_submission.update', [$course->id, $ts->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group @error('exam_submission_score') has-error @enderror">
                                                          <label for="exam_submission_score">
                                                            Add score:
                                                            <span class="text-red">*</span>
                                                          </label>
                                                          <input name="exam_submission_score" value="{{ old('exam_submission_score') }}" type="text" class="@error('exam_submission_score') is-invalid @enderror form-control" placeholder="Enter Score">
                                                          @error('exam_submission_score')
                                                            <p style="color:red">{{ $message }}</p>
                                                          @enderror
                                                        </div>
                                                        <div class="form-group @error('exam_submission_instructor_reply') has-error @enderror">
                                                          <label for="exam_submission_instructor_reply">
                                                            Add instructor reply:
                                                            <span class="text-red">*</span>
                                                          </label>
                                                          <textarea name="exam_submission_instructor_reply" class="@error('exam_submission_instructor_reply') is-invalid @enderror form-control" rows="5" placeholder="Enter Instructor Reply">{{ old('exam_submission_instructor_reply') }}</textarea>
                                                          @error('exam_submission_instructor_reply')
                                                            <p style="color:red">{{ $message }}</p>
                                                          @enderror
                                                        </div>
                                                        <div class="form-group">
                                                          <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                                                        </div>
                                                      </form>
                                                    @endif
                                                  @endif
                                                </li>
                                                <?php $j++; ?>
                                              @endif
                                            @endforeach
                                            @if($flag == 0)
                                              <li class="list-group-item">
                                                There are no submissions for this exam.
                                              </li>
                                            @endif
                                          </ul>
                                          <button onclick="document.getElementById('ExamGrading{{$dt->id}}').className = 'modal fade'; document.getElementById('ExamGrading{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                                <?php $i++; ?>
                              @endif
                            @endforeach
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="certificate">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assigned in <b>{{ $course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course->course_package->count_session
                        --}}
                        {{ $sessions->count() }}
                        @if($sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-check margin-r-5"></i> Requirements</dt>
                        <dd>
                          After completing this course, we will evaluate your attendances.<br />
                          A minimum of <b>80% completed attendances (of all sessions)</b> is required to get the course certificate.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-file-pdf-o margin-r-5"></i> Certificate Download</dt>
                        <dd>
                          If you are eligible, click "link" button to download your course certificate!
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
                        <dd>
                          Please consider attending all sessions so you may adapt with the materials given.<br />
                          On completing this course, you may choose another course for learning.<br />
                          <span class="text-red">Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Certificate Download</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <strong><i class="fa fa-edit margin-r-5"></i> Types of Certificate Status</strong>
                    <p>
                      <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This certificate has not been uploaded yet.">Not Ready</label>
                      <label data-toggle="tooltip" title class="label bg-red" data-original-title="This student is ineligible to get the course certificate.">Ineligible</label>
                      {{--<label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This course is still in progress.">Ongoing</label>--}}
                      <label data-toggle="tooltip" title class="label bg-green" data-original-title="This student is eligible to get the course certificate.">Eligible</label>
                    </p>
                    <hr>
                    @if($task_submission_flag)
                      <table class="table table-bordered example1">
                        <thead>
                          <th>Student Name</th>
                          <th>Total Attendances</th>
                          <th>Certificate Status</th>
                        </thead>
                        <tbody>
                          <?php $total_sessions = $course->course_package->count_session; ?>
                          @foreach($course->course_registrations as $i => $cr)
                            <?php
                              $count_present = 0;
                              foreach($cr->session_registrations as $sr)
                                if($sr->status == 'Present' || $sr->status == 'Should Submit Form')
                                  $count_present++;
                            ?>
                            <tr>
                              <td>
                                {{ $cr->student->user->first_name }} {{ $cr->student->user->last_name }}
                              </td>
                              <td>
                                {{ $count_present }}/{{ $total_sessions }}
                              </td>
                              <td class="text-center">
                                @if($cr->course_certificate && $cr->course_certificate->path)
                                  @if($count_present >= 80 * $total_sessions / 100)
                                    <label data-toggle="tooltip" title class="label bg-green" data-original-title="This student is eligible to get the course certificate.">Eligible</label>
                                  @else
                                    <label data-toggle="tooltip" title class="label bg-red" data-original-title="This student is ineligible to get the course certificate.">Ineligible</label>
                                  @endif
                                @else
                                  <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This certificate has not been uploaded yet.">Not Ready</label>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>



                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
