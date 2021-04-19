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
                        {{ $course->sessions->count() }}
                        @if($course->sessions->count() != 1)
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
                        if($course->sessions) {
                          foreach($course->sessions as $s) {
                            $schedule_time = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                            if($schedule_time >= $schedule_now) {
                              if($next_meeting_time == null) {
                                $next_meeting_time = $schedule_time;
                                $next_meeting_link = $s->link_zoom;
                                $session_title = strtoupper($s->title);
                              }
                              if($next_meeting_time > $schedule_time) {
                                $next_meeting_time = $schedule_time;
                                $next_meeting_link = $s->link_zoom;
                                $session_title = strtoupper($s->title);
                              }
                            }
                          }
                        }
                      ?>
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
                            @else
                              <i class="text-muted">Not Available</i>
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
                              <i class="text-muted">Not Available</i>
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
                              <i class="text-muted">Not Available</i>
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
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                      </table>
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
                          $data = $course->sessions->first()->schedule->instructor_schedules;
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
                            <th style="width:5%;">Chat</th>
                          </thead>
                          <tbody>
                            @foreach($data as $dt)
                              <tr>
                                <td>{{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}</td>
                                <td>
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
                                    <span class="text-muted"><i>Not Available</i></span>
                                  @endif
                                </td>
                                <td>
                                  @if($dt->instructor->user->image_profile != 'user.jpg')
                                    <img src="{{ asset('uploads/instructor/'.$dt->instructor->user->image_profile) }}" style="width:100%">
                                  @else
                                    <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                                  @endif
                                </td>
                                <td>
                                  @if($dt->instructor_id != Auth::user()->instructor->id)
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_instructor.show', $dt->instructor->user_id) }}">Link</a>
                                  @else
                                    <i>N/A</i>
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
                            <th style="width:5%;">Chat</th>
                          </thead>
                          <tbody>
                            @foreach($data as $dt)
                              <tr>
                                <td>{{ $dt->student->user->first_name }} {{ $dt->student->user->last_name }}</td>
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
                                    <span class="text-muted"><i>Not Available</i></span>
                                  @endif
                                </td>
                                <td>
                                  @if($dt->student->user->image_profile != 'user.jpg')
                                    <img src="{{ asset('uploads/student/profile/'.$dt->student->user->image_profile) }}" style="width:100%">
                                  @else
                                    <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                                  @endif
                                </td>
                                <td>
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
                        {{ $course->sessions->count() }}
                        @if($course->sessions->count() != 1)
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
                          <i class="fa fa-file-text-o margin-r-5"></i> More Information
                        </dt>
                        <dd>
                          Please consider that a minimum of <b>80% completed attendances (of all sessions)</b> is required for a student to get the course certificate.<br />
                          Reminding the students about what should they do, is subject to <b>NUSIA terms for Instructors.</b><br />
                          <span style="color:#ff0000;">Contact NUSIA Admin or Lead Instructor if you encounter a problem.</span>
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
                    @if($course->sessions->toArray() != null)
                      <table class="table table-bordered example1">
                        <thead>
                          {{--<th style="width:2%;" class="text-right">#</th>--}}
                          <th>Title</th>
                          <th>Time</th>
                          <th style="width:5%;">Link</th>
                          <th style="width:10%;">Attendance</th>
                        </thead>
                        <tbody>
                          @foreach($course->sessions as $i => $dt)
                            <tr>
                              {{--<td class="text-right">{{ $i + 1 }}</td>--}}
                              <td>
                                <a href="#" data-toggle="modal" data-target="#Session{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                  {{ $dt->title }}
                                </a>
                              </td>
                              <td>
                                <?php
                                  $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_30_mins_after_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end_form = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->sub(10, 'minutes');
                                  $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                                  $schedule_time_30_mins_after_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
                                  $schedule_time_end_form->add($dt->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                                ?>
                                <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDAhhmm') }}</span>
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
                                    <a class="btn btn-flat btn-xs btn-default disabled" href="#">Join</a>
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
                        <h4><b>Reschedule a Session</b></h4>
                        <p class="no-padding" style="color:#ff0000;">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="#" enctype="multipart/form-data">
                          @csrf
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-12">
                                  <div class="form-group @error('session_id') has-error @enderror">
                                    <label for="session_id">
                                      Session ID
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select name="session_id" type="text" class="@error('session_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Session ID --</option>
                                      <?php
                                        $i = 0;
                                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                      ?>
                                      @foreach($course->sessions as $i => $dt)
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
                      </div>
                      <hr>
                      <div class="box-header">
                        <h4><b>Approve a Reschedule Request(s)</b></h4>
                      </div>
                      <div class="box-body">
                        <table class="table table-bordered example1">
                          <thead>
                            {{--<th style="width:2%;" class="text-right">#</th>--}}
                            <th>Title</th>
                            <th>Current Time</th>
                            <th>Requested Time</th>
                            <th style="width:5%;">Link</th>
                          </thead>
                          <tbody>
                            @foreach($course->sessions as $i => $dt)
                              <tr>
                                {{--<td class="text-right">{{ $i + 1 }}</td>--}}
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#Session{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                    {{ $dt->title }}
                                  </a>
                                </td>
                                <td>
                                  <?php
                                    $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end_form = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                                    $schedule_time_end_form->add($dt->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                                  ?>
                                  <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDAhhmm') }}</span>
                                  {{ $schedule_time_begin->isoFormat('MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                  {{--
                                  @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                    Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                  @else
                                    {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                  @endif
                                  --}}
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
                                    <span class="hidden">{{ $reschedule_time_begin->isoFormat('YYMMDDAhhmm') }}</span>
                                    {{ $reschedule_time_begin->isoFormat('MMMM Do YYYY, hh:mm A') }} {{ $reschedule_time_end->isoFormat('[-] hh:mm A') }}
                                    {{--
                                    @if($reschedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $reschedule_time_begin->isoFormat('hh:mm A') }} {{ $reschedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @else
                                      {{ $reschedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $reschedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @endif
                                    --}}
                                  @else
                                    <i class="text-muted">Not Available</i>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($dt->requirement)
                                    <a href="#" data-toggle="modal" data-target="#Approval{{$dt->id}}" class="btn btn-flat btn-xs bg-purple">Action</a>
                                  @else
                                    <a href="#" class="btn btn-flat btn-xs btn-default disabled" disabled>Action</a>
                                  @endif
                                </td>
                              </tr>
                              @if($dt->requirement)
                                <div class="modal fade" id="Approval{{$dt->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="box box-primary">
                                        <div class="box-body box-profile">
                                          <form role="form" method="post" action="#" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
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
                                            <input type="hidden" name="approval_status" value="-1" id="approval_status">
                                            <div class="col-md-6">
                                              <button type="submit" class="btn btn-s btn-primary" style="width:100%;" onclick="document.getElementById('approval_status').value = 1;">Accept</button>
                                            </div>
                                            <div class="col-md-6">
                                              <button type="submit" class="btn btn-s btn-danger" style="width:100%;" onclick="document.getElementById('approval_status').value = 0;">Decline</button>
                                            </div>
                                            <br /><br />
                                          </form>
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
                    @if($course->sessions->toArray() != null)
                      @foreach($course->sessions as $j => $s)
                        @if($j != 0)
                          <hr>
                        @endif
                        <h4><b>{{ $s->title }}</b></h4>
                        @if($s->session_registrations->toArray() != null)
                          <table class="table table-bordered example1">
                            <thead>
                              <th style="width:2%;" class="text-right">#</th>
                              <th>Name</th>
                              <th style="width:20%;">Attendance</th>
                            </thead>
                            <tbody>
                              <?php
                                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                              ?>
                              @foreach($s->session_registrations as $i => $dt)
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>{{ $dt->course_registration->student->user->first_name }} {{ $dt->course_registration->student->user->last_name }}</td>
                                  <td>
                                    @if($dt->status == 'Not Assigned')
                                      <?php
                                        $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                        $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
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
                        {{ $course->sessions->count() }}
                        @if($course->sessions->count() != 1)
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
                          <span style="color:#ff0000;">Contact your instructor if you encounter a problem.</span>
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
                          <th style="width:2%;" class="text-right">#</th>
                          <th>File Name</th>
                          <th style="width:25%;">File Type</th>
                          <th style="width:5%;">Link</th>
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
                                  @if(strpos($dt->path, '://') !== false)
                                    Link
                                  @else
                                    {{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }}
                                  @endif
                                @else
                                  <i class="text-muted">Not Available</i>
                                @endif
                              </td>
                              <td class="text-center">
                                @if($dt->path)
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.material.download', [1, $dt->id]) }}">Link</a>
                                @else
                                  <i class="text-muted">-</i>
                                @endif
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
                      <hr>
                      <div class="box-header">
                        <h4><b>Add or Modify a Main Material</b></h4>
                        <p class="no-padding" style="color:#ff0000;">* This field is required</p>
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
                                      <span style="color:#ff0000;">*</span>
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
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select name="material_public_session_name" type="text" class="@error('material_public_session_name') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Session Name --</option>
                                      @foreach($course->sessions as $i => $dt)
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
                                      <span style="color:#ff0000;">*</span>
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
                                  <div class="form-group @error('material_public_path') has-error @enderror">
                                    <label for="material_public_path">Upload File (any type)</label>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <input name="material_public_path" type="file" accept="*" class="@error('material_public_path') is-invalid @enderror form-control">
                                    @error('material_public_path')
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
                @foreach($course->sessions as $i => $s)
                  <div class="box box-warning">
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
                                    @if(strpos($dt->path, '://') !== false)
                                      Link
                                    @else
                                      {{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }}
                                    @endif
                                  @else
                                    <i class="text-muted">Not Available</i>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($dt->path)
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.material.download', [2, $dt->id]) }}">Link</a>
                                  @else
                                    <i class="text-muted">-</i>
                                  @endif
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
                          <p class="no-padding" style="color:#ff0000;">* This field is required</p>
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
                                        <span style="color:#ff0000;">*</span>
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
                                        <span style="color:#ff0000;">*</span>
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
                                    <div class="form-group @error('material_session_path') has-error @enderror">
                                      <label for="material_session_path">Upload File (any type)</label>
                                      <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                      <p style="color:#ff0000; padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                      <input name="material_session_path" type="file" accept="*" class="@error('material_session_path') is-invalid @enderror form-control">
                                      @error('material_session_path')
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
                        {{ $course->sessions->count() }}
                        @if($course->sessions->count() != 1)
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
                          <span style="color:#ff0000;">Contact your instructor if you encounter a problem.</span>
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
                  foreach($course->sessions as $s) {
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
                      <table class="table table-bordered">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Task</th>
                          <th>Due Time</th>
                          <th style="width:5%;">Link</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($course->sessions as $s)
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
                                    @if($dt->path_1 == null)
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.assignment.download', [$course_registration->id, $dt->id]) }}">Link</a>
                                    @else
                                      <i class="text-muted">Not Available</i>
                                    @endif
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
                                              {{ $dt->description }}
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
                      <div class="box-header">
                        <h4><b>Submit an Assignment</b></h4>
                        <p class="no-padding" style="color:#ff0000;">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="#{{-- route('student.assignment_submission.store', [$course_registration->id]) --}}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="type" value="Assignment">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_id') has-error @enderror">
                                    <label for="assignment_id">
                                      Assignment ID
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select name="assignment_id" type="text" class="@error('assignment_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Assignment ID --</option>
                                      <?php
                                        $i = 0;
                                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                      ?>
                                      @foreach($course->sessions as $s)
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
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_title') has-error @enderror">
                                    <label for="assignment_title">
                                      Subject
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <input name="assignment_title" value="{{ old('assignment_title') }}" type="text" class="@error('assignment_title') is-invalid @enderror form-control" placeholder="Enter Subject">
                                    @error('assignment_title')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_description') has-error @enderror">
                                    <label for="assignment_description">
                                      Description
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <textarea name="assignment_description" class="@error('assignment_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('assignment_description') }}</textarea>
                                    @error('assignment_description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_path_1') has-error @enderror">
                                    <label for="assignment_path_1">Upload File (any type)</label>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Up to 10 submissions are allowed for each assignment</p>
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
                    @else
                      <div class="text-center">
                        There is no assignments here... :(<br />
                        Kindly check periodically.
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
                      <table class="table table-bordered">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Task</th>
                          <th>Due Date</th>
                          <th style="width:5%;">Link</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($course->sessions as $s)
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
                                    @if($dt->path_1 == null)
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.exam.download', [$course_registration->id, $dt->id]) }}">Link</a>
                                    @else
                                      <i class="text-muted">Not Available</i>
                                    @endif
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
                                              {{ $dt->description }}
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
                      <div class="box-header">
                        <h4><b>Submit an Exam</b></h4>
                        <p class="no-padding" style="color:#ff0000;">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="#{{-- route('student.exam_submission.store', [$course_registration->id]) --}}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="type" value="Exam">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_id') has-error @enderror">
                                    <label for="exam_id">
                                      Exam ID
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select name="exam_id" type="text" class="@error('exam_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Exam ID --</option>
                                      <?php
                                        $i = 0;
                                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                      ?>
                                      @foreach($course->sessions as $s)
                                        @foreach($s->tasks as $dt)
                                          @if($dt->type == 'Exam')
                                            <?php $due_date = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone); ?>
                                            @if($schedule_now <= $due_date)
                                              @if(old('exam_id') == $dt->id))
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
                                    @error('exam_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_title') has-error @enderror">
                                    <label for="exam_title">
                                      Subject
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <input name="exam_title" value="{{ old('exam_title') }}" type="text" class="@error('exam_title') is-invalid @enderror form-control" placeholder="Enter Subject">
                                    @error('exam_title')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_description') has-error @enderror">
                                    <label for="exam_description">
                                      Description
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <textarea name="exam_description" class="@error('exam_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('exam_description') }}</textarea>
                                    @error('exam_description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_path_1') has-error @enderror">
                                    <label for="exam_path_1">Upload File (any type)</label>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Up to 3 submissions are allowed for each exam</p>
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
                    @else
                      <div class="text-center">
                        There is no exam here... :(<br />
                        Kindly check periodically.
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
                        {{ $course->sessions->count() }}
                        @if($course->sessions->count() != 1)
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
                          <span style="color:#ff0000;">Contact your instructor if you encounter a problem.</span>
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
                      <table class="table table-bordered">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th style="width:25%;">Task</th>
                          <th>Last Done on</th>
                          <th style="width:5%;">Score</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($course->sessions as $s)
                            @foreach($s->tasks as $dt)
                              @if($dt->type == 'Assignment')
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#AssignmentGrading{{$dt->id}}">
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td>
                                    @if($dt->task_submissions->last())
                                      <?php
                                        $last_submitted_at = \Carbon\Carbon::parse($dt->task_submissions->last()->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                      ?>
                                      {{ $last_submitted_at->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                    @else
                                      <i class="text-muted">Not Available</i>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    @if($dt->task_submissions->last() && $dt->task_submissions->last()->score)
                                      {{ $dt->task_submissions->last()->score }}
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
                                            @if($course == null)
                                            @foreach($course_registration->session_registrations as $sr)
                                              @foreach($sr->task_submissions as $ts)
                                                @if($ts->task_id == $dt->id)
                                                  <?php $flag = 1; ?>
                                                  <li class="list-group-item">
                                                    @if($ts->path_1)
                                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.assignment_submission.download', [$course_registration->id, $ts->id]) }}">Download</a>
                                                        <br />
                                                    @endif
                                                    <b>Submission #{{ $j + 1 }}</b> (
                                                      <?php
                                                        $submission_time = \Carbon\Carbon::parse($ts->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                                      ?>
                                                      {{ $submission_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                                      )<br />
                                                    <b>Title:</b> {{ $ts->title }}<br />
                                                    <b>Description:</b>
                                                      {{ $ts->description }}<br />
                                                    <b>Submission status:</b>
                                                      @if($ts->status == 'Accepted')
                                                        <b style="color:#007700;">Checked</b><br />
                                                      @else
                                                        <i class="text-muted">Not Available</i><br />
                                                      @endif
                                                    @if($ts->status == 'Accepted')
                                                      <b>Score:</b>
                                                        {{ $ts->score }}<br />
                                                      <b>Instructor reply:</b><br />
                                                        {{ $ts->instructor_reply }}<br />
                                                    @endif
                                                  </li>
                                                  <?php $j++; ?>
                                                @endif
                                              @endforeach
                                            @endforeach
                                            @endif
                                            @if($flag == 0)
                                              <div class="text-muted">You haven't submitted your working for this assignment.</div>
                                            @endif
                                          </ul>
                                          <button onclick="document.getElementById('AssignmentGrading{{$dt->id}}').className = 'modal fade'; document.getElementById('AssignmentGrading{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
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
                      <table class="table table-bordered">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th style="width:25%;">Task</th>
                          <th>Last Done on</th>
                          <th style="width:5%;">Score</th>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          @foreach($course->sessions as $s)
                            @foreach($s->tasks as $dt)
                              @if($dt->type == 'Exam')
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#ExamGrading{{$dt->id}}">
                                      {{ $dt->title }}
                                    </a>
                                  </td>
                                  <td>
                                    @if($dt->task_submissions->last())
                                      <?php
                                        $last_submitted_at = \Carbon\Carbon::parse($dt->task_submissions->last()->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                      ?>
                                      {{ $last_submitted_at->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                    @else
                                      <i class="text-muted">Not Available</i>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    @if($dt->task_submissions->last() && $dt->task_submissions->last()->score)
                                      {{ $dt->task_submissions->last()->score }}
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
                                            @if($course == null)
                                            @foreach($course_registration->session_registrations as $sr)
                                              @foreach($sr->task_submissions as $ts)
                                                @if($ts->task_id == $dt->id)
                                                  <?php $flag = 1; ?>
                                                  <li class="list-group-item">
                                                    @if($ts->path_1)
                                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.exam_submission.download', [$course_registration->id, $ts->id]) }}">Download</a>
                                                        <br />
                                                    @endif
                                                    <b>Submission #{{ $j + 1 }}</b> (
                                                      <?php
                                                        $submission_time = \Carbon\Carbon::parse($ts->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                                      ?>
                                                      {{ $submission_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                                      )<br />
                                                    <b>Title:</b> {{ $ts->title }}<br />
                                                    <b>Description:</b>
                                                      {{ $ts->description }}<br />
                                                    <b>Submission status:</b>
                                                      @if($ts->status == 'Accepted')
                                                        <b style="color:#007700;">Checked</b><br />
                                                      @else
                                                        <i class="text-muted">Not Available</i><br />
                                                      @endif
                                                    @if($ts->status == 'Accepted')
                                                      <b>Score:</b>
                                                        {{ $ts->score }}<br />
                                                      <b>Instructor reply:</b><br />
                                                        {{ $ts->instructor_reply }}<br />
                                                    @endif
                                                  </li>
                                                  <?php $j++; ?>
                                                @endif
                                              @endforeach
                                            @endforeach
                                            @endif
                                            @if($flag == 0)
                                              <div class="text-muted">You haven't submitted your working for this exam.</div>
                                            @endif
                                          </ul>
                                          <button onclick="document.getElementById('ExamGrading{{$dt->id}}').className = 'modal fade'; document.getElementById('ExamGrading{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
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
                        {{ $course->sessions->count() }}
                        @if($course->sessions->count() != 1)
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
                          <span style="color:#ff0000;">Contact your instructor if you encounter a problem.</span>
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
                    @if($task_submission_flag)
                      <table class="table table-bordered">
                        <thead>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Total Attendances</th>
                          <th style="width:5%;">Link</th>
                        </thead>
                        <tbody>
                          <?php
                            /*$i = 0;
                            foreach($course_registration->session_registrations as $dt) {
                              if($dt->status == 'Present') {
                                $i++;
                              }
                            }
                            $total_sessions = $course_registration->course->course_package->count_session;
                            */
                          ?>
                          <tr>
                            <td class="text-right">1</td>
                            <td>
                              {{-- $i --}}/{{-- $total_sessions --}}
                            </td>
                            <td class="text-center">
                              {{--
                              @if($i >= 80 * $total_sessions / 100)
                                @if($course_registration->course_certificate->path)
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.certificate.download') }}">Link</a>
                                @else
                                  <a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-warning disabled" href="#">Pending</a>
                                @endif
                              @else
                                <a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Ineligible</a>
                              @endif
                              --}}
                            </td>
                          </tr>
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
