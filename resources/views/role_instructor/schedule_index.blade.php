@extends('layouts.admin.default')

@section('title','Instructor | Session')

@include('layouts.css_and_js.table')

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
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Add Zoom Meeting Link</b></h3>
        </div>
        <div class="box-body">
          <form action="{{-- route('instructor.session.update',1) --}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Session</label>
              <select name="session_registration" class="form-control select2">
                <option selected="" disabled="">-- Choose Session --</option>
                @foreach($instructor_schedules as $dt)
                  <option value="{{ $dt->schedule->session->id }}">
                    [ {{ $dt->schedule->session->course->course_package->course_level->name }} ] {{ $dt->schedule->session->course->title }} - {{ $dt->schedule->session->title }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Meeting Link</label>
              <input name="link_zoom" type="text" class="form-control" placeholder="insert a meeting link" value="{{ old('name') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-warning">
        <div class="box-body">
          <table class="table table-bordered table-striped example1">
            <thead>
              <th>Class</th>
              <th>Level</th>
              <th>Session</th>
              <th>Meeting Time</th>
              <th style="width: 90px">Meeting Link</th>
              <th style="width: 40px">Attendance</th>
            </thead>
            <tbody>
              @if($instructor_schedules->toArray() != null)
                @foreach($instructor_schedules as $dt)
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
                    <?php
                      $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                      $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                      $schedule_time_end->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
                    ?>
                    @if(now() > $schedule_time_end)
                      <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-purple" href="{{ route('instructor.student_attendance.index', [$dt->schedule->session->course_id, $dt->schedule->session->id]) }}">Link</a></td>
                    @else
                      <td class="text-center"><a class="btn btn-flat btn-xs btn-default disabled" href="#">Link</a></td>
                    @endif
                  </tr>
                @endforeach
              @else
                <p class="text-muted">No schedules available.</p>
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  
  
  
  
  
  
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Text</b></h3>
                    <p class="no-margin">There are <b>X sessions</b></p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    Test
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
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Text</strong>
                      <p>
                        Text
                      </p>
                      {{-- <hr> --}}
                    </div>
                  </div>
                  <div class="box box-warning">
                    <div class="box-header">
                      <h3 class="box-title">Title</h3>
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
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Text</h3>
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
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="sessions">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Text</b></h3>
                    <p class="no-margin">There are <b>X sessions</b></p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <dl>
                      <dt>
                        <i class="fa fa-user-circle-o margin-r-5"></i> Joining Sessions
                      </dt>
                      <dd>
                        Click "link" button to join your sessions!
                      </dd>
                    </dl>
                    <hr>
                    <dl>
                      <dt>
                        <i class="fa fa-edit margin-r-5"></i> Giving Feedbacks
                      </dt>
                      <dd>
                        After each session ends, a "Form" button will appear replacing the meeting link.
                        Click the "Form" button to give feedbacks per session.<br />
                        You are <b>required</b> to give feedbacks in order to complete your attendance information, for each session.
                        Otherwise, your attendance (for that session) will not be counted.
                      </dd>
                    </dl>
                    <hr>
                    <dl>
                      <dt>
                        <i class="fa fa-file-text-o margin-r-5"></i> More Information
                      </dt>
                      <dd>
                        Three days after each session ends, the "Form" button will eventually disappear.<br />
                        Please consider that a minimum of <b>80% completed attendances (of all sessions)</b> is required to get the course certificate.<br />
                        <span style="color:#ff0000;">Contact your instructor if you encounter a problem.</span>
                      </dd>
                    </dl>
                    {{--
                    <hr>
                    --}}
                  </div>
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
