@extends('layouts.admin.default')

@section('title','Instructor | Session')

@include('layouts.css_and_js.all')

{{-- @include('layouts.css_and_js.table') --}}

{{-- @include('layouts.css_and_js.form_advanced') --}}

@section('content-header')
  <h1><b>Session</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Schedule</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <?php
        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
        /*$count = 0;
        foreach($instructor_schedules as $dt) {
          if($dt->schedule->session) {
            $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)
              ->setTimezone(Auth::user()->timezone)
              ->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
            if($schedule_now <= $schedule_time_end) $count++;
          }
        }*/
      ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Edit Session Information</b></h3>
          {{--
          <p class="no-margin">There are <b>{{ $count }} sessions</b> available.</p>
          --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ route('instructor.session.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="session_id">Session</label>
              <select id="session_id" name="session_id" class="form-control select2">
                <option selected value="0">-- Choose a session --</option>
                @foreach($instructor_schedules as $dt)
                  @if($dt->schedule->session)
                    <?php
                      $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)
                        ->setTimezone(Auth::user()->timezone)
                        ->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
                    ?>
                    @if($schedule_now <= $schedule_time_end)
                      <option value="{{ $dt->schedule->session->id }}">
                        [ {{ $dt->schedule->session->course->course_package->course_level->name }} ] {{ $dt->schedule->session->course->title }} - {{ $dt->schedule->session->title }}
                      </option>
                    @endif
                  @endif
                @endforeach
              </select>
            </div>
            <div id="link_zoom_div" class="form-group @error('link_zoom') has-error @enderror hidden">
              <label for="link_zoom">Meeting Link</label>
              <input name="link_zoom" type="text" class="form-control" placeholder="insert a meeting link" value="{{ old('name') }}">
              @error('link_zoom')
                <p style="color:red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label class="hidden" for="link_zoom_flag_btn">Meeting Link</label>
              <input type="hidden" id="link_zoom_flag" name="link_zoom_flag" value="0">
              <input type="button" id="link_zoom_flag_btn" class="btn btn-flat btn-xs btn-default" style="width:100%;" value="Click to enable changing the meeting link" onclick="if(document.getElementById('link_zoom_flag').value == 0) { document.getElementById('link_zoom_flag').value = 1; document.getElementById('link_zoom_div').className = 'form-group'; document.getElementById('link_zoom_flag_btn').value = 'Click to disable changing the meeting link'; } else { document.getElementById('link_zoom_flag').value = 0; document.getElementById('link_zoom_div').className = 'form-group hidden'; document.getElementById('link_zoom_flag_btn').value = 'Click to enable changing the meeting link'; }">
            </div>
            <div id="schedule_time_div" class="form-group @error('schedule_time_date') has-error @enderror @error('schedule_time_time') has-error @enderror hidden">
              <label for="schedule_time_date">Schedule</label>
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
            <div class="form-group">
              <label class="hidden" for="schedule_time_btn">Schedule</label>
              <input type="hidden" id="schedule_time_flag" name="schedule_time_flag" value="0">
              <input type="button" id="schedule_time_flag_btn" class="btn btn-flat btn-xs btn-default" style="width:100%;" value="Click to enable changing the schedule" onclick="if(document.getElementById('schedule_time_flag').value == 0) { document.getElementById('schedule_time_flag').value = 1; document.getElementById('schedule_time_div').className = 'form-group'; document.getElementById('schedule_time_flag_btn').value = 'Click to disable changing the schedule'; } else { document.getElementById('schedule_time_flag').value = 0; document.getElementById('schedule_time_div').className = 'form-group hidden'; document.getElementById('schedule_time_flag_btn').value = 'Click to enable changing the schedule'; }">
            </div>
            <button type="submit" class="btn btn-s btn-flat btn-primary" style="width:100%;">Submit</button>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#ready" data-toggle="tab"><b>Ready</b></a></li>
          <li><a href="#all" data-toggle="tab"><b>All Schedules</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="ready">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Ready Sessions</b></h3>
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
                      <strong><i class="fa fa-edit margin-r-5"></i> Types of Meeting Status</strong>
                      <p>
                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This session has not started yet.">Upcoming</label>
                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This session is in progress.">Ongoing</label>
                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="You are required to complete this session attendance information.">Attendance Check</label>
                        <label data-toggle="tooltip" title class="label bg-green" data-original-title="This session has passed its scheduled time and the attendance infomation for this session has been completed.">Done</label>
                      </p>
                      <hr>
                      <table class="table table-bordered table-striped example2">
                        <thead>
                          <th>Class</th>
                          <th>Session</th>
                          <th>Course</th>
                          <th>Level</th>
                          <th>Meeting Time</th>
                          <th>Meeting Status</th>
                          <th style="width:16%;">Meeting Link</th>
                          <th style="width:10%;">Attendance</th>
                        </thead>
                        <tbody>
                          @if($instructor_schedules->toArray() != null)
                            @foreach($instructor_schedules as $dt)
                              @if($dt->schedule->session)
                                <tr>
                                  <td>{{ $dt->schedule->session->course->title }}</td>
                                  <td>{{ $dt->schedule->session->title }}</td>
                                  <td>{{ $dt->schedule->session->course->course_package->material_type->name }} - {{ $dt->schedule->session->course->course_package->course_type->name }}</td>
                                  <td>{{ $dt->schedule->session->course->course_package->course_level->name }}</td>
                                  @if($dt->schedule->schedule_time)
                                    <?php
                                      $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                      $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                      $schedule_time_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                    ?>
                                    <td>
                                      <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDAhhmm') }}</span>
                                      {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    </td>
                                  @else
                                    <td><i>N/A</i></td>
                                  @endif
                                  @if($dt->schedule->schedule_time)
                                    <?php
                                      $attendance_is_checked = 0;
                                      if($dt->schedule->session->session_registrations->toArray() != null) {
                                        $attendance_is_checked = 1;
                                        foreach($dt->schedule->session->session_registrations as $sr) {
                                          if($sr->status == 'Not Assigned') {
                                            $attendance_is_checked = 0;
                                            break;
                                          }
                                        }
                                      }
                                    ?>
                                    <td class="text-center">
                                      @if($schedule_now < $schedule_time_begin)
                                        <span class="hidden">1</span>
                                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This session has not started yet.">Upcoming</label>
                                      @elseif($schedule_now >= $schedule_time_begin && $schedule_now <= $schedule_time_end)
                                        <span class="hidden">2</span>
                                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This session is in progress.">Ongoing</label>
                                      @elseif($attendance_is_checked == 0)
                                        <span class="hidden">3</span>
                                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="You are required to complete this session attendance information.">Attendance Check</label>
                                      @else
                                        <span class="hidden">4</span>
                                        <label data-toggle="tooltip" title class="label bg-green" data-original-title="This session has passed its scheduled time and the attendance infomation for this session has been completed.">Done</label>
                                      @endif
                                    </td>
                                  @else
                                    <td><i>N/A</i></td>
                                  @endif
                                  @if($dt->schedule->session->link_zoom)
                                    <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->schedule->session->link_zoom }}">Link</a></td>
                                  @else
                                    <td class="text-center"><a class="btn btn-flat btn-xs btn-default disabled" href="#">Link</a></td>
                                  @endif
                                  @if($schedule_now > $schedule_time_end)
                                    <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.student_attendance.index', [$dt->schedule->session->course_id, $dt->schedule->session->id]) }}">Link</a></td>
                                  @else
                                    <td class="text-center"><a class="btn btn-flat btn-xs btn-default disabled" href="#">Link</a></td>
                                  @endif
                                </tr>
                              @endif
                            @endforeach
                          @else
                            <p class="text-muted">No schedules available.</p>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="all">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Assigned Meeting Times</b></h3>
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
                      <strong><i class="fa fa-edit margin-r-5"></i> Types of Availability Status</strong>
                      <p>
                        <label data-toggle="tooltip" title class="label label-success" data-original-title="This schedule is available for another upcoming reservation.">Available</label>
                        <label data-toggle="tooltip" title class="label label-danger" data-original-title="This schedule is currently assigned to a session.">Busy</label>
                        <label data-toggle="tooltip" title class="label label-default" data-original-title="This schedule was available for another upcoming reservation (but already passed the current time).">Available</label>
                        <label data-toggle="tooltip" title class="label label-default" data-original-title="This schedule was assigned to a session (but already passed the current time).">Busy</label>
                      </p>
                      <hr>
                      <table class="table table-bordered table-striped example1">
                        <thead>
                          <th>Meeting Time</th>
                          <th>Availability Status</th>
                          <th style="width:5%;">Delete</th>
                        </thead>
                        <tbody>
                          @if($instructor_schedules->toArray() != null)
                            @foreach($instructor_schedules as $dt)
                              <tr>
                                @if($dt->schedule->schedule_time)
                                  <?php
                                    $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_begin_iso = $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A');
                                  ?>
                                  <td>
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDAhhmm') }}</span>
                                    {{ $schedule_time_begin_iso }}
                                  </td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                <td class="text-center">
                                  @if($dt->status == 'Available')
                                    @if($schedule_now <= $schedule_time_begin)
                                      <label data-toggle="tooltip" title class="label label-success" data-original-title="This schedule is available for another upcoming reservation.">Available</label>
                                    @else
                                      <label data-toggle="tooltip" title class="label label-default" data-original-title="This schedule was available for another upcoming reservation (but already passed the current time).">Available</label>
                                    @endif
                                  @elseif($dt->status == 'Busy')
                                    @if($schedule_now <= $schedule_time_begin)
                                      <label data-toggle="tooltip" title class="label label-danger" data-original-title="This schedule is currently assigned to a session.">Busy</label>
                                    @else
                                      <label data-toggle="tooltip" title class="label label-default" data-original-title="This schedule was assigned to a session (but already passed the current time).">Busy</label>
                                    @endif
                                  @endif
                                </td>
                                @if($schedule_now <= $schedule_time_begin && $dt->status == 'Available')
                                  <td class="text-center">
                                    <form role="form" action="{{ route('instructor.schedule.destroy', [$dt->schedule_id]) }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('This schedule will be deleted: {{ $schedule_time_begin_iso }}.')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                    </form>
                                  </td>
                                @else
                                  <td class="text-center"><a class="btn btn-flat btn-xs btn-default disabled" href="#"><i class="fa fa-trash"></i></a></td>
                                @endif
                              </tr>
                            @endforeach
                          @else
                            <p class="text-muted">No schedules available.</p>
                          @endif
                        </tbody>
                      </table>
                    </div>
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
