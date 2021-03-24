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
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#ready" data-toggle="tab"><b>Ready</b></a></li>
          <li><a href="#all" data-toggle="tab"><b>All Schedules</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="ready">
            <div class="row">
              <div class="col-md-3">
                <?php
                  $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                  $count = 0;
                  foreach($instructor_schedules as $dt) {
                    $schedule_time = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                    if($dt->schedule->session && $schedule_now <= $schedule_time) $count++;
                  }
                ?>
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Edit Session Information</b></h3>
                    <p class="no-margin">There are <b>{{ $count }} sessions</b> available.</p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form action="{{ route('instructor.session.update') }}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="session_id">Session</label>
                        <select id="session_id" name="session_id" class="form-control select2">
                          <option selected="" disabled="">-- Choose a session --</option>
                          @foreach($instructor_schedules as $dt)
                            <?php $schedule_time = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone); ?>
                            @if($dt->schedule->session && $schedule_now <= $schedule_time)
                              <option value="{{ $dt->schedule->session->id }}">
                                [ {{ $dt->schedule->session->course->course_package->course_level->name }} ] {{ $dt->schedule->session->course->title }} - {{ $dt->schedule->session->title }}
                              </option>
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
              <div class="col-md-9 no-padding">
                <div class="col-md-12">
                  <div class="box box-primary">
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
                      <table class="table table-bordered table-striped example2">
                        <thead>
                          <th>Class</th>
                          <th>Level</th>
                          <th>Session</th>
                          <th>Meeting Time</th>
                          <th style="width:16%;">Meeting Link</th>
                          <th style="width:10%;">Attendance</th>
                        </thead>
                        <tbody>
                          @if($instructor_schedules->toArray() != null)
                            @foreach($instructor_schedules as $dt)
                              @if($dt->schedule->session)
                                <tr>
                                  <td>{{ $dt->schedule->session->course->title }}</td>
                                  <td>{{ $dt->schedule->session->course->course_package->course_level->name }}</td>
                                  <td>{{ $dt->schedule->session->title }}</td>
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
                  <div class="box box-default collapsed-box">
                    <div class="box-header">
                      <h3 class="box-title"><b>General Indonesian Language</b></h3>
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
                    <div class="box-body">
                      <table class="table table-bordered table-striped example2">
                        <thead>
                          <th>Class</th>
                          <th>Level</th>
                          <th>Session</th>
                          <th>Meeting Time</th>
                          <th style="width:16%;">Meeting Link</th>
                          <th style="width:10%;">Attendance</th>
                        </thead>
                        <tbody>
                          <?php
                            $flag = 0;
                            foreach($instructor_schedules as $dt) {
                              if($dt->schedule->session && strpos($dt->schedule->session->course->course_package->material_type->name, 'General Indonesian Language') !== false) {
                                $flag = 1;
                                break;
                              }
                            }
                          ?>
                          @if($flag)
                            @foreach($instructor_schedules as $dt)
                              @if($dt->schedule->session)
                                <tr>
                                  <td>{{ $dt->schedule->session->course->title }}</td>
                                  <td>{{ $dt->schedule->session->course->course_package->course_level->name }}</td>
                                  <td>{{ $dt->schedule->session->title }}</td>
                                  @if($dt->schedule->schedule_time)
                                    <?php
                                      $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
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
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Add/Edit Meeting Link</b></h3>
                    <p class="no-margin">There are <b>{{ $instructor_schedules->count() }} sessions</b> available.</p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form action="{{ route('instructor.session.update') }}" method="post">
                      {{-- ADD FORM HERE IF NEEDED --}}
                    </form>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
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
                    <table class="table table-bordered table-striped example2">
                      <thead>
                        <th>Meeting Time</th>
                        <th>Availability Status</th>
                        <th>Integrate</th>
                        <th>Delete</th>
                      </thead>
                      <tbody>
                        @foreach($instructor_schedules as $dt)
                          <tr>
                            <td>Test</td>
                            <td>Test</td>
                            <td>
                              <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Link</a>
                            </td>
                            <td>
                              <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Link</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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
                    <table class="table table-bordered">
                      <thead>
                        <th>Name</th>
                        <th style="width:25%;">Interest</th>
                        <th style="width:12%;">Picture</th>
                        <th style="width:5%;">Chat</th>
                      </thead>
                      <tbody>
                        {{-- @foreach($data as $dt) --}}
                          <tr>
                            <td>Test</td>
                            <td>Test</td>
                            <td>Test</td>
                            <td>
                              <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Link</a>
                            </td>
                          </tr>
                        {{-- @endforeach --}}
                      </tbody>
                    </table>
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
