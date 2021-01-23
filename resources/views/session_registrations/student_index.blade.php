@extends('layouts.admin.default')

@section('title', 'Student | Schedules')

{{-- @include('layouts.css_and_js.form_general') --}}

{{-- @include('layouts.css_and_js.calendar') --}}

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Schedules</li>
  </ol>
@stop

@section('content')
  @if(session('form_complete'))
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <h4><i class="icon fa fa-check"></i> {{ session('form_complete') }}</h4> {{ session(['form_complete' => null]) }}
        </div>
      </div>
    </div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#current_sessions" data-toggle="tab"><b>Current Sessions</b></a></li>
          <li><a href="#all_courses" data-toggle="tab"><b>All Courses</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="current_sessions">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  {{--
                  <div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div>
                  --}}
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt style="font-size:18px;"><i class="fa fa-users margin-r-5"></i> Note</dt>
                        <dd>
                          Click "link" button to join your session!<br />
                          <span style="color:#ff0000;">* Contact us if you encounter a problem.</span>
                        </dd>
                        {{--
                        <hr>
                        <dt style="font-size:18px;"><i class="fa fa-pencil margin-r-5"></i> Feedback</dt>
                        <dd>
                          After participating in EACH session,<br />you may give us your feedback.<br />
                          <span style="color:#ff0000;">** Giving feedbacks for improvement is greatly appreciated.</span>
                        </dd>
                        --}}
                      </dl>
                      {{-- <!--hr--> --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9 no-padding">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Current Sessions</b></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <?php
                        $has_a_schedule = 0;
                        $schedule_times_begin = [];
                        $schedule_times_end = [];
                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                        foreach($session_registrations as $dt) {
                          $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                          if($schedule_now <= $schedule_time_end) {
                            $has_a_schedule = 1;
                            array_push($schedule_times_begin, $schedule_time_begin);
                            array_push($schedule_times_end, $schedule_time_end);
                          }
                        }
                      ?>
                      @if($has_a_schedule)
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:2%;" class="text-right">#</th>
                            <th>Course / Session</th>
                            <th>Time</th>
                            <th style="width:5%;">Link</th>
                          </tr>
                          @foreach($session_registrations as $i => $dt)
                            @if($schedule_now <= $schedule_times_end[$i])
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>{{ $dt->session->course->title }} / {{ $dt->session->title }}</td>
                                <td>
                                  @if($schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                    Today, {{ $schedule_times_begin[$i]->isoFormat('hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                  @else
                                    {{ $schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($dt->session->link_zoom)
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Link</a>
                                  @else
                                    <a class="btn btn-flat btn-xs btn-default disabled" href="#">Link</a>
                                  @endif
                                </td>
                              </tr>
                            @endif
                          @endforeach
                        </table>
                      @else
                        <div class="text-center">No data available.</div>
                      @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="all_courses">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  {{--
                  <div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div>
                  --}}
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt style="font-size:18px;"><i class="fa fa-book margin-r-5"></i> Note</dt>
                        <dd>
                          Click "link" button view more information about each course!<br />
                          <span style="color:#ff0000;">* Contact us if you encounter a problem.</span>
                        </dd>
                        {{--
                        <hr>
                        <dt style="font-size:18px;"><i class="fa fa-pencil margin-r-5"></i> Feedback</dt>
                        <dd>
                          After participating in EACH session,<br />you may give us your feedback.<br />
                          <span style="color:#ff0000;">** Giving feedbacks for improvement is greatly appreciated.</span>
                        </dd>
                        --}}
                      </dl>
                      {{-- <!--hr--> --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Courses</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if(Auth::user()->student->course_registrations->toArray() != 0)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Course</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th-->
                        </tr>
                        @foreach(Auth::user()->student->course_registrations as $i => $dt)
                          @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->course->title }}</td>
                              <td>{{ $dt->course->course_package->material_type->name }}/{{ $dt->course->course_package->course_type->name }}</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="box box-success">
                  <?php
                    $type = 'General Indonesian Language';
                    $count = 0;
                    foreach(Auth::user()->student->course_registrations as $dt) {
                      if($dt->course->course_package->material_type->name == $type) {
                        if(strpos($dt->course->course_package->title, 'Not Assigned') === false) {
                          $count++;
                        }
                      }
                    }
                  ?>
                  <div class="box-header">
                    <h3 class="box-title"><b>{{ $type }}</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($count > 0)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Course</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th-->
                        </tr>
                        @foreach(Auth::user()->student->course_registrations as $i => $dt)
                          @if($dt->course->course_package->material_type->name == $type)
                            @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>{{ $dt->course->title }}</td>
                                <td>{{ $dt->course->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endif
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="box box-primary">
                  <?php
                    $type = 'Language Partners';
                    $count = 0;
                    foreach(Auth::user()->student->course_registrations as $dt) {
                      if($dt->course->course_package->material_type->name == $type) {
                        if(strpos($dt->course->course_package->title, 'Not Assigned') === false) {
                          $count++;
                        }
                      }
                    }
                  ?>
                  <div class="box-header">
                    <h3 class="box-title"><b>{{ $type }}</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($count > 0)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Course</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th-->
                        </tr>
                        @foreach(Auth::user()->student->course_registrations as $i => $dt)
                          @if($dt->course->course_package->material_type->name == $type)
                            @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>{{ $dt->course->title }}</td>
                                <td>{{ $dt->course->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endif
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="box box-info">
                  <?php
                    $type = 'Cultural Classes';
                    $count = 0;
                    foreach(Auth::user()->student->course_registrations as $dt) {
                      if($dt->course->course_package->material_type->name == $type) {
                        if(strpos($dt->course->course_package->title, 'Not Assigned') === false) {
                          $count++;
                        }
                      }
                    }
                  ?>
                  <div class="box-header">
                    <h3 class="box-title"><b>{{ $type }}</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($count > 0)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Course</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th-->
                        </tr>
                        @foreach(Auth::user()->student->course_registrations as $i => $dt)
                          @if($dt->course->course_package->material_type->name == $type)
                            @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>{{ $dt->course->title }}</td>
                                <td>{{ $dt->course->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endif
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
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
