@extends('layouts.admin.default')

@section('title', 'Assign Sessions')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Assign Sessions</li>
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
          <h3 class="box-title"><b>Add New Class</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="#" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="course_package_id">Course Type</label>
              <select id="course_package_id" name="course_package_id" class="form-control select2">
                <option selected value="0">-- Choose a course --</option>
                @foreach($course_packages as $i => $dt)
                  <option value="{{ $dt->id }}">
                    [{{ $i + 1 }}] {{ $dt->title }}
                  </option>
                @endforeach
              </select>
            </div>
            <div id="class_title_div" class="form-group @error('class_title') has-error @enderror">
              <label for="class_title">Class Title</label>
              <input name="class_title" type="text" class="form-control" placeholder="add class title" value="{{ old('class_title') }}">
              @error('class_title')
                <p style="color:red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="instructor_id">Instructor</label>
              <select id="instructor_id" name="instructor_id" class="form-control select2" style="width:100%;">
                <option selected value="0">-- Choose an instructor --</option>
                @foreach($instructors as $dt)
                  <option value="{{ $dt->id }}">
                    [{{ $dt->id }}] {{ $dt->user->first_name }} {{ $dt->user->last_name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div id="schedule_time_div" class="form-group @error('schedule_time_date') has-error @enderror @error('schedule_time_time') has-error @enderror">
              <label for="schedule_time_date">First Session Schedule</label>
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
    </div>
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#teaching_availability" data-toggle="tab"><b>Teaching Availability</b></a></li>
          <li><a href="#all_classes" data-toggle="tab"><b>All Classes</b></a></li>
          @foreach($instructors as $i => $dt)
            <li><a href="#i{{ $dt->id }}" data-toggle="tab"><b>[{{ $i + 1 }}] {{ $dt->user->first_name }} {{ $dt->user->last_name }}</b></a></li>
          @endforeach
        </ul>
        <div class="tab-content">
          
          <div class="active tab-pane" id="teaching_availability">
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
                          <th>Instructor</th>
                          <th>Availability Status</th>
                          <th>Assigned to</th>
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
                                  <td>{{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}</td>
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
                                  @if($dt->schedule->session)
                                    <td>{{ $dt->schedule->session->course->title }}</td>
                                  @else
                                    <td>N/A</td>
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
                          <th>Instructor</th>
                          <th>Availability Status</th>
                          <th>Assigned to</th>
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
                                <td>{{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}</td>
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
                                @if($dt->schedule->session)
                                  <td>{{ $dt->schedule->session->course->title }}</td>
                                @else
                                  <td>N/A</td>
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

          <div class="tab-pane" id="all_classes">
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
                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This class is waiting for a last attendance check.">Last Attd</label>
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
                                $course_time_end_form = null;
                                $class_status = null;
                                if($dt->sessions) {
                                  foreach($dt->sessions as $s) {
                                    $schedule_time_begin = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                                    $schedule_time_end_form = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end_form->add($s->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
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
                                    if($course_time_end == null) $course_time_end = $schedule_time_end;
                                    if($course_time_end_form == null) $course_time_end_form = $schedule_time_end_form;
                                    if($course_time_begin > $schedule_time_begin) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end < $schedule_time_end) $course_time_end = $schedule_time_end;
                                    if($course_time_end_form < $schedule_time_end_form) $course_time_end_form = $schedule_time_end_form;
                                  }
                                  // SIMPAN NILAI VARIABEL UNTUK SELEKSI KOLOM "Class Status"
                                  if($dt->sessions->count() < $dt->course_package->count_session) $class_status = 1; // Not Ready
                                  else if($schedule_now < $course_time_begin) $class_status = 2; // Upcoming
                                  else if($schedule_now <= $course_time_end) $class_status = 3; // Ongoing
                                  else if($schedule_now <= $course_time_end_form) $class_status = 4; // Last Attd
                                  else if($schedule_now > $course_time_end_form) $class_status = 5; // Done
                                } else {
                                  $class_status = 1; // Not Ready
                                }
                              ?>
                              @if($class_status == 5)
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
                                    <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This class is waiting for a last attendance check.">Last Attd</label>
                                  @endif
                                </td>
                                <td>{{ $dt->course_package->material_type->name }} - {{ $dt->course_package->course_type->name }} - {{ $dt->title }}</td>
                                <td class="text-center"><a target="_blank" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.course.show', [$dt->id]) }}">Info</a></td>
                              </tr>
                            @endforeach
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
                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This class is waiting for a last attendance check.">Last Attd</label>
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
                                $course_time_end_form = null;
                                $class_status = null;
                                if($dt->sessions) {
                                  foreach($dt->sessions as $s) {
                                    $schedule_time_begin = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                                    $schedule_time_end_form = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end_form->add($s->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
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
                                    if($course_time_end == null) $course_time_end = $schedule_time_end;
                                    if($course_time_end_form == null) $course_time_end_form = $schedule_time_end_form;
                                    if($course_time_begin > $schedule_time_begin) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end < $schedule_time_end) $course_time_end = $schedule_time_end;
                                    if($course_time_end_form < $schedule_time_end_form) $course_time_end_form = $schedule_time_end_form;
                                  }
                                  // SIMPAN NILAI VARIABEL UNTUK SELEKSI KOLOM "Class Status"
                                  if($dt->sessions->count() < $dt->course_package->count_session) $class_status = 1; // Not Ready
                                  else if($schedule_now < $course_time_begin) $class_status = 2; // Upcoming
                                  else if($schedule_now <= $course_time_end) $class_status = 3; // Ongoing
                                  else if($schedule_now <= $course_time_end_form) $class_status = 4; // Last Attd
                                  else if($schedule_now > $course_time_end_form) $class_status = 5; // Done
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
                                    <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This class is waiting for a last attendance check.">Last Attd</label>
                                  @elseif($class_status == 5)
                                    <span class="hidden">5</span>
                                    <label data-toggle="tooltip" title class="label bg-green" data-original-title="This class has been completed. Please make sure that all session attendances for this class have been checked.">Done</label>
                                  @endif
                                </td>
                                <td>{{ $dt->course_package->material_type->name }} - {{ $dt->course_package->course_type->name }} - {{ $dt->title }}</td>
                                <td class="text-center"><a target="_blank" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.course.show', [$dt->id]) }}">Info</a></td>
                              </tr>
                            @endforeach
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


          @foreach($instructors as $i => $instructor)
          <div class="tab-pane" id="i{{ $i + 1 }}">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  @foreach($material_types as $j => $mt)
                  <div class="box box-default @if($j != 0) collapsed-box @endif">
                    <div class="box-header">
                      <h3 class="box-title"><b>{{ $mt->name }}</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa @if($j != 0) fa-plus @else fa-minus @endif"></i></button>
                      </div>
                    </div>
                    <div class="box-body" @if($j != 0) style="display:none;" @endif>
                      <strong><i class="fa fa-edit margin-r-5"></i> Types of Class Status</strong>
                      <p>
                        <label data-toggle="tooltip" title class="label bg-red" data-original-title="This class sessions are not ready to be published yet. Please check whether all schedules for this class have been assigned.">Not Ready</label>
                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This class has not started yet.">Upcoming</label>
                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This class is in progress.">Ongoing</label>
                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This class is waiting for a last attendance check.">Last Attd</label>
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
                              @if($dt->sessions->first() && $dt->sessions->first()->schedule->instructor_schedules->first()->instructor_id == $instructor->id)
                              <?php
                                // UNTUK KOLOM "Next Meeting Time" dan "Class Status"
                                $next_meeting_time = null;
                                $next_meeting_link = null;
                                $course_time_begin = null;
                                $course_time_end = null;
                                $course_time_end_form = null;
                                $class_status = null;
                                if($dt->sessions) {
                                  foreach($dt->sessions as $s) {
                                    $schedule_time_begin = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                                    $schedule_time_end_form = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end_form->add($s->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
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
                                    if($course_time_end == null) $course_time_end = $schedule_time_end;
                                    if($course_time_end_form == null) $course_time_end_form = $schedule_time_end_form;
                                    if($course_time_begin > $schedule_time_begin) $course_time_begin = $schedule_time_begin;
                                    if($course_time_end < $schedule_time_end) $course_time_end = $schedule_time_end;
                                    if($course_time_end_form < $schedule_time_end_form) $course_time_end_form = $schedule_time_end_form;
                                  }
                                  // SIMPAN NILAI VARIABEL UNTUK SELEKSI KOLOM "Class Status"
                                  if($dt->sessions->count() < $dt->course_package->count_session) $class_status = 1; // Not Ready
                                  else if($schedule_now < $course_time_begin) $class_status = 2; // Upcoming
                                  else if($schedule_now <= $course_time_end) $class_status = 3; // Ongoing
                                  else if($schedule_now <= $course_time_end_form) $class_status = 4; // Last Attd
                                  else if($schedule_now > $course_time_end_form) $class_status = 5; // Done
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
                                    <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This class is waiting for a last attendance check.">Last Attd</label>
                                  @elseif($class_status == 5)
                                    <span class="hidden">5</span>
                                    <label data-toggle="tooltip" title class="label bg-green" data-original-title="This class has been completed. Please make sure that all session attendances for this class have been checked.">Done</label>
                                  @endif
                                </td>
                                <td>{{ $dt->course_package->material_type->name }} - {{ $dt->course_package->course_type->name }} - {{ $dt->title }}</td>
                                <td class="text-center"><a target="_blank" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.course.show', [$dt->id]) }}">Info</a></td>
                              </tr>
                              @endif
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          @endforeach






        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
