@extends('layouts.admin.default')

@section('title', 'Schedules')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Schedules</li>
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
          <h3 class="box-title"><b>Add Teaching Availability</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ route('instructor.session_index.update', [1]) }}" method="post">
            @csrf
            @method('PUT')
            <div id="schedule_time_div" class="form-group @error('schedule_time_date') has-error @enderror @error('schedule_time_time') has-error @enderror">
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
            <button type="submit" class="btn btn-s btn-flat btn-primary" style="width:100%;">Submit</button>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Edit Meeting Link</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ route('instructor.session_index.update', [2]) }}" method="post">
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
            <div id="link_zoom_div" class="form-group @error('link_zoom') has-error @enderror">
              <label for="link_zoom">Meeting Link</label>
              <input name="link_zoom" type="text" class="form-control" placeholder="insert a meeting link" value="{{ old('link_zoom') }}">
              @error('link_zoom')
                <p style="color:red">{{ $message }}</p>
              @enderror
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
          <li class="active"><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
          <li><a href="#teaching_availability" data-toggle="tab"><b>Teaching Availability</b></a></li>
          <li><a href="#class_information" data-toggle="tab"><b>Class Information</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="sessions">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header">
                      <h3 class="box-title"><b>Current Sessions</b></h3>
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
                      </p>
                      <hr>
                      <table class="table table-bordered table-striped example2">
                        <thead>
                          <th>Course</th>
                          <th>Class</th>
                          <th>Session</th>
                          {{--<th>Level</th>--}}
                          <th>Meeting Time</th>
                          <th>Meeting Status</th>
                          <th style="width:16%;">Meeting Link</th>
                          <th style="width:10%;">Attendance</th>
                        </thead>
                        <tbody>
                          @if($instructor_schedules->toArray() != null)
                            @foreach($instructor_schedules as $dt)
                              @if($dt->schedule->session)
                                <?php
                                  $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_30_mins_after_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->sub(10, 'minutes');
                                  $schedule_time_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                  $schedule_time_30_mins_after_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
                                ?>
                                @if($schedule_time_30_mins_after_end < $schedule_now)
                                  @continue
                                @endif
                                <tr>
                                  <td>
                                    {{ $dt->schedule->session->course->course_package->material_type->name }} - {{ $dt->schedule->session->course->course_package->course_type->name }} - {{ $dt->schedule->session->course->course_package->course_level->name }}
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                  </td>
                                  <td>{{ $dt->schedule->session->course->title }}</td>
                                  <td>{{ $dt->schedule->session->title }}</td>
                                  {{--<td>{{ $dt->schedule->session->course->course_package->course_level->name }}</td>--}}
                                  <td>
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @else
                                      {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @endif
                                  </td>
                                  <td class="text-center">
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
                                    @if($schedule_now < $schedule_time_begin)
                                      <span class="hidden">1{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                      <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This session has not started yet.">Upcoming</label>
                                    @elseif($schedule_now >= $schedule_time_begin && $schedule_now <= $schedule_time_end)
                                      <span class="hidden">2{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                      <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This session is in progress.">Ongoing</label>
                                    @elseif($attendance_is_checked == 0)
                                      <span class="hidden">3{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                      <label data-toggle="tooltip" title class="label bg-blue" data-original-title="You are required to complete this session attendance information.">Attendance Check</label>
                                    @endif
                                  </td>
                                  @if($dt->schedule->session->link_zoom)
                                    <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->schedule->session->link_zoom }}">Link</a></td>
                                  @else
                                    <td class="text-center"><a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#">Link</a></td>
                                  @endif
                                  @if($schedule_now >= $schedule_time_10_mins_before_end && $schedule_now <= $schedule_time_30_mins_after_end)
                                    <td class="text-center"><a rel="noopener noreferrer" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.student_attendance.index', [$dt->schedule->session->course_id, $dt->schedule->session->id]) }}">Link</a></td>
                                  @else
                                    <td class="text-center"><a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#">Link</a></td>
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
                  <div class="box box-default collapsed-box">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Sessions</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body" style="display:none;">
                      <table class="table table-bordered table-striped example1">
                        <thead>
                          <th>Course</th>
                          <th>Class (Session)</th>
                          {{--<th>Level</th>--}}
                          <th>Meeting Time</th>
                        </thead>
                        <tbody>
                          @if($instructor_schedules->toArray() != null)
                            @foreach($instructor_schedules as $dt)
                              @if($dt->schedule->session)
                                <?php
                                  $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_30_mins_after_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_10_mins_before_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->sub(10, 'minutes');
                                  $schedule_time_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                  $schedule_time_30_mins_after_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
                                ?>
                                <tr>
                                  <td>
                                    {{ $dt->schedule->session->course->course_package->material_type->name }} - {{ $dt->schedule->session->course->course_package->course_type->name }} - {{ $dt->schedule->session->course->course_package->course_level->name }}
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                  </td>
                                  <td>{{ $dt->schedule->session->course->title }} ({{ $dt->schedule->session->title }})</td>
                                  {{--<td>{{ $dt->schedule->session->course->course_package->course_level->name }}</td>--}}
                                  <td>
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @else
                                      {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @endif
                                  </td>
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
          <div class="tab-pane" id="teaching_availability">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header">
                      <h3 class="box-title"><b>Current Teaching Availability</b></h3>
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
                              <?php
                                $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_begin_iso = $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A');
                              ?>
                              @if($schedule_now <= $schedule_time_begin)
                                <tr>
                                  <td>
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      <b>(Today)</b>
                                    @endif
                                    {{ $schedule_time_begin_iso }}
                                  </td>
                                  <td class="text-center">
                                    @if($dt->status == 'Available')
                                      @if($schedule_now <= $schedule_time_begin)
                                        <span class="hidden">1</span>
                                        <label data-toggle="tooltip" title class="label label-success" data-original-title="This schedule is available for another upcoming reservation.">Available</label>
                                      @endif
                                    @elseif($dt->status == 'Busy')
                                      @if($schedule_now <= $schedule_time_begin)
                                        <span class="hidden">3</span>
                                        <label data-toggle="tooltip" title class="label label-danger" data-original-title="This schedule is currently assigned to a session.">Busy</label>
                                      @endif
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($schedule_now <= $schedule_time_begin && $dt->status == 'Available')
                                      <span class="hidden">1</span>
                                      <form role="form" action="{{ route('instructor.schedule.destroy', [$dt->schedule_id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('This schedule will be deleted: {{ $schedule_time_begin_iso }}.')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                      </form>
                                    @else
                                      <span class="hidden">2</span>
                                      <a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#"><i class="fa fa-trash"></i></a>
                                    @endif
                                  </td>
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
                  <div class="box box-default collapsed-box">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Teaching Availability</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body" style="display:none;">
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
                              <?php
                                $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_begin_iso = $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A');
                              ?>
                              <tr>
                                <td>
                                  <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                  @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                    <b>(Today)</b>
                                  @endif
                                  {{ $schedule_time_begin_iso }}
                                </td>
                                <td class="text-center">
                                  @if($dt->status == 'Available')
                                    @if($schedule_now <= $schedule_time_begin)
                                      <span class="hidden">1</span>
                                      <label data-toggle="tooltip" title class="label label-success" data-original-title="This schedule is available for another upcoming reservation.">Available</label>
                                    @else
                                      <span class="hidden">2</span>
                                      <label data-toggle="tooltip" title class="label label-default" data-original-title="This schedule was available for another upcoming reservation (but already passed the current time).">Available</label>
                                    @endif
                                  @elseif($dt->status == 'Busy')
                                    @if($schedule_now <= $schedule_time_begin)
                                      <span class="hidden">3</span>
                                      <label data-toggle="tooltip" title class="label label-danger" data-original-title="This schedule is currently assigned to a session.">Busy</label>
                                    @else
                                      <span class="hidden">4</span>
                                      <label data-toggle="tooltip" title class="label label-default" data-original-title="This schedule was assigned to a session (but already passed the current time).">Busy</label>
                                    @endif
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($schedule_now <= $schedule_time_begin && $dt->status == 'Available')
                                    <span class="hidden">1</span>
                                    <form role="form" action="{{ route('instructor.schedule.destroy', [$dt->schedule_id]) }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('This schedule will be deleted: {{ $schedule_time_begin_iso }}.')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                    </form>
                                  @else
                                    <span class="hidden">2</span>
                                    <a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#"><i class="fa fa-trash"></i></a>
                                  @endif
                                </td>
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
          <div class="tab-pane" id="class_information">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header">
                      <h3 class="box-title"><b>Currently Assigned Courses</b></h3>
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
                      <strong><i class="fa fa-edit margin-r-5"></i> Types of Class Status</strong>
                      <p>
                        <label data-toggle="tooltip" title class="label bg-red" data-original-title="This class sessions are not ready to be published yet. Please check whether all schedules for this class have been assigned.">Not Ready</label>
                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This class has not started yet.">Upcoming</label>
                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This class is in progress.">Ongoing</label>
                      </p>
                      <hr>
                      <table class="table table-bordered table-striped example1">
                        <thead>
                          <th>Next Meeting Time</th>
                          <th>Class Status</th>
                          {{--
                          <th>First Meet in Class</th>
                          <th>Last Meet in Class</th>
                          --}}
                          <th>Class Name</th>
                          <th style="width:5%;">View</th>
                        </thead>
                        <tbody>
                          @if($courses->toArray() != null)
                            @foreach($courses as $dt)
                              <?php
                                // UNTUK KOLOM "Next Meeting Time" dan "Class Status"
                                $next_meeting_time = null;
                                $next_meeting_link = null;
                                $course_time_begin = null;
                                $course_time_end = null;
                                $class_status = null;
                                if($dt->sessions) {
                                  foreach($dt->sessions as $s) {
                                    $schedule_time_begin = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                                    // UNTUK KOLOM "Next Meeting Time"
                                    if($schedule_time_end >= $schedule_now) {
                                      if($next_meeting_time == null) {
                                        $next_meeting_time = $schedule_time_begin;
                                        $next_meeting_link = $s->link_zoom;
                                      }
                                      if($schedule_time_end < $next_meeting_time) {
                                        $next_meeting_time = $schedule_time_begin;
                                        $next_meeting_link = $s->link_zoom;
                                      }
                                    }
                                    // UNTUK KOLOM "Class Status"
                                    if($course_time_begin == null) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end == null) $course_time_end = $schedule_time_begin;
                                    if($course_time_begin > $schedule_time_begin) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end < $schedule_time_begin) $course_time_end = $schedule_time_begin;
                                  }
                                  // SIMPAN NILAI VARIABEL UNTUK SELEKSI KOLOM "Class Status"
                                  if($dt->sessions->count() < $dt->course_package->count_session) $class_status = 1; // Not Ready
                                  if($schedule_now < $course_time_begin) $class_status = 2; // Upcoming
                                  else if($schedule_now <= $course_time_end) $class_status = 3; // Ongoing
                                  else if($schedule_now > $course_time_end) $class_status = 4; // Done
                                } else {
                                  $class_status = 1; // Not Ready
                                }
                              ?>
                              @if($class_status == 4)
                                @continue
                              @endif
                              <tr>
                                {{--
                                @if($course_time_begin)
                                  <td>
                                    <span class="hidden">{{ $course_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    {{ $course_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  </td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                @if($course_time_end)
                                  <td>
                                    <span class="hidden">{{ $course_time_end->isoFormat('YYMMDDHHmm') }}</span>
                                    {{ $course_time_end->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  </td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                --}}
                                <td>
                                  @if($next_meeting_time)
                                    <span class="hidden">{{ $next_meeting_time->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($next_meeting_time->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $next_meeting_time->isoFormat('hh:mm A') }}
                                    @else
                                      {{ $next_meeting_time->isoFormat('ddd, MMM Do YYYY, hh:mm A') }}
                                    @endif
                                    <div class="pull-right">
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $next_meeting_link }}">Link</a>
                                      &nbsp;&nbsp;
                                    </div>
                                  @else
                                    <span class="hidden">N/A</span>
                                    <i>N/A</i>
                                    <div class="pull-right">
                                      <button disabled class="btn btn-flat btn-xs btn-default btn-disabled">Link</button>
                                      &nbsp;&nbsp;
                                    </div>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($class_status == 1)
                                    <span class="hidden">1</span>
                                    <label data-toggle="tooltip" title class="label bg-red" data-original-title="This class sessions are not ready to be published yet. Please check whether all schedules for this class have been assigned.">Not Ready</label>
                                  @elseif($class_status == 2)
                                    <span class="hidden">2</span>
                                    <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This class has not started yet.">Upcoming</label>
                                  @elseif($class_status == 3)
                                    <span class="hidden">3</span>
                                    <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This class is in progress.">Ongoing</label>
                                  @elseif($class_status == 4)
                                    <span class="hidden">4</span>
                                    <label data-toggle="tooltip" title class="label bg-green" data-original-title="This class has been completed. Please make sure that all session attendances for this class have been checked.">Done</label>
                                  @endif
                                </td>
                                <td>{{ $dt->course_package->material_type->name }} - {{ $dt->course_package->course_type->name }} - {{ $dt->title }}</td>
                                <td class="text-center"><a target="_blank" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.course.show', [$dt->id]) }}">Info</a></td>
                              </tr>
                            @endforeach
                          @else
                            <p class="text-muted">No schedules available.</p>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="box box-default collapsed-box">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Assigned Courses</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body" style="display:none;">
                      <strong><i class="fa fa-edit margin-r-5"></i> Types of Class Status</strong>
                      <p>
                        <label data-toggle="tooltip" title class="label bg-red" data-original-title="This class sessions are not ready to be published yet. Please check whether all schedules for this class have been assigned.">Not Ready</label>
                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This class has not started yet.">Upcoming</label>
                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This class is in progress.">Ongoing</label>
                        <label data-toggle="tooltip" title class="label bg-green" data-original-title="This class has been completed. Please make sure that all session attendances for this class have been checked.">Done</label>
                      </p>
                      <hr>
                      <table class="table table-bordered table-striped example1">
                        <thead>
                          <th>Next Meeting Time</th>
                          <th>Class Status</th>
                          {{--
                          <th>First Meet in Class</th>
                          <th>Last Meet in Class</th>
                          --}}
                          <th>Class Name</th>
                          <th style="width:5%;">View</th>
                        </thead>
                        <tbody>
                          @if($courses->toArray() != null)
                            @foreach($courses as $dt)
                              <?php
                                // UNTUK KOLOM "Next Meeting Time" dan "Class Status"
                                $next_meeting_time = null;
                                $next_meeting_link = null;
                                $course_time_begin = null;
                                $course_time_end = null;
                                $class_status = null;
                                if($dt->sessions) {
                                  foreach($dt->sessions as $s) {
                                    $schedule_time_begin = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                                    // UNTUK KOLOM "Next Meeting Time"
                                    if($schedule_time_end >= $schedule_now) {
                                      if($next_meeting_time == null) {
                                        $next_meeting_time = $schedule_time_begin;
                                        $next_meeting_link = $s->link_zoom;
                                      }
                                      if($schedule_time_end < $next_meeting_time) {
                                        $next_meeting_time = $schedule_time_begin;
                                        $next_meeting_link = $s->link_zoom;
                                      }
                                    }
                                    // UNTUK KOLOM "Class Status"
                                    if($course_time_begin == null) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end == null) $course_time_end = $schedule_time_begin;
                                    if($course_time_begin > $schedule_time_begin) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end < $schedule_time_begin) $course_time_end = $schedule_time_begin;
                                  }
                                  // SIMPAN NILAI VARIABEL UNTUK SELEKSI KOLOM "Class Status"
                                  if($dt->sessions->count() < $dt->course_package->count_session) $class_status = 1; // Not Ready
                                  if($schedule_now < $course_time_begin) $class_status = 2; // Upcoming
                                  else if($schedule_now <= $course_time_end) $class_status = 3; // Ongoing
                                  else if($schedule_now > $course_time_end) $class_status = 4; // Done
                                } else {
                                  $class_status = 1; // Not Ready
                                }
                              ?>
                              <tr>
                                {{--
                                @if($course_time_begin)
                                  <td>
                                    <span class="hidden">{{ $course_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    {{ $course_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  </td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                @if($course_time_end)
                                  <td>
                                    <span class="hidden">{{ $course_time_end->isoFormat('YYMMDDHHmm') }}</span>
                                    {{ $course_time_end->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  </td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                --}}
                                <td>
                                  @if($next_meeting_time)
                                    <span class="hidden">{{ $next_meeting_time->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($next_meeting_time->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $next_meeting_time->isoFormat('hh:mm A') }}
                                    @else
                                      {{ $next_meeting_time->isoFormat('ddd, MMM Do YYYY, hh:mm A') }}
                                    @endif
                                    <div class="pull-right">
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $next_meeting_link }}">Link</a>
                                      &nbsp;&nbsp;
                                    </div>
                                  @else
                                    <span class="hidden">N/A</span>
                                    <i>N/A</i>
                                    <div class="pull-right">
                                      <button disabled class="btn btn-flat btn-xs btn-default btn-disabled">Link</button>
                                      &nbsp;&nbsp;
                                    </div>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($class_status == 1)
                                    <span class="hidden">1</span>
                                    <label data-toggle="tooltip" title class="label bg-red" data-original-title="This class sessions are not ready to be published yet. Please check whether all schedules for this class have been assigned.">Not Ready</label>
                                  @elseif($class_status == 2)
                                    <span class="hidden">2</span>
                                    <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This class has not started yet.">Upcoming</label>
                                  @elseif($class_status == 3)
                                    <span class="hidden">3</span>
                                    <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This class is in progress.">Ongoing</label>
                                  @elseif($class_status == 4)
                                    <span class="hidden">4</span>
                                    <label data-toggle="tooltip" title class="label bg-green" data-original-title="This class has been completed. Please make sure that all session attendances for this class have been checked.">Done</label>
                                  @endif
                                </td>
                                <td>{{ $dt->course_package->material_type->name }} - {{ $dt->course_package->course_type->name }} - {{ $dt->title }}</td>
                                <td class="text-center"><a target="_blank" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.course.show', [$dt->id]) }}">Info</a></td>
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
