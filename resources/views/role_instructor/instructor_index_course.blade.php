@extends('layouts.admin.default')

@section('title','Instructor | Schedules')

@include('layouts.css_and_js.table')

{{-- Schedules di Sidebar --}}
@section('content-header')
  <h1><b>Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Schedules</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="box">
        <div class="box-header">
          <h4 class="box-title"><b>Information</b></h4>
        </div>
        <div class="box-body">
          <dl>
            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
            <dd>
              You are appointed to teach<br>in
              <?php
                $arr = [];
                foreach($courses as $dt) {
                 if(!in_array($dt->id, $arr)) array_push($arr, $dt->id);
                 if(count($arr) == 2) break;
                }
              ?>
              @if(count($arr) == 1)
                this NUSIA class.
              @else
                these NUSIA classes.
              @endif
            </dd>
          </dl>
          {{--
          <hr>
          <dl>
            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Note</dt>
            <dd>Before starting each session, you must download the main materials.</dd>
          </dl>
          --}}
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>Schedule</b></h3>
        </div>
        <form>
          <div class="box-body">
            <table class="table no-margin no-padding example1">
              <thead>
                <tr>
                  <th>Class</th>
                  <th>Level</th>
                  <th>Number of Students Registered</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($courses as $dt)
                  <tr>
                    <td>{{ $dt->title }}</td>
                    <td>{{ $dt->course_package->course_level->name }}</td>
                    <td>{{ $dt->course_registrations->count() }}/{{ $dt->course_package->course_type->count_student_max }}</td>
                    <td><a class="btn btn-flat btn-xs btn-success" href="{{ route('course_registrations.index_by_course_id', $dt->id) }}">View Students</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>



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
                          <span style="color:#ff0000;">Contact us if you encounter a problem.</span>
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
                        foreach($sessions as $dt) {
                          $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                          if($schedule_now <= $schedule_time_end) {
                            $has_a_schedule = 1;
                            array_push($schedule_times_begin, $schedule_time_begin);
                            array_push($schedule_times_end, $schedule_time_end);
                          }
                        }
                      ?>
                      @if($has_a_schedule)
                        <table class="table no-margin no-padding example1">
                          <thead>
                            <tr>
                              <th>Course / Session</th>
                              <th>Time</th>
                              <th style="width:5%;">Link</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($sessions as $i => $dt)
                              @if($schedule_now <= $schedule_times_end[$i])
                                <tr>
                                  <td>{{ $dt->course->title }} / {{ $dt->title }}</td>
                                  <td>
                                    @if($schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $schedule_times_begin[$i]->isoFormat('hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                    @else
                                      {{ $schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($dt->link_zoom)
                                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Link</a>
                                    @else
                                      <a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#">Link</a>
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
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
                          <span style="color:#ff0000;">Contact us if you encounter a problem.</span>
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
                    @if($courses->toArray() != 0)
                      <table class="table no-margin no-padding example1">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>Type</th>
                            <th style="width:5%;">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($courses as $i => $dt)
                            <tr>
                              <td>{{ $dt->title }}</td>
                              <td>{{ $dt->course_package->material_type->name }}/{{ $dt->course_package->course_type->name }}</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('instructors.show_course', [$dt->id]) }}">Link</a></td>
                            </tr>
                          @endforeach
                        </tbody>
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
                    foreach($courses as $dt) {
                      if($dt->course_package->material_type->name == $type) {
                        $count++;
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
                      <table class="table no-margin no-padding example1">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>Type</th>
                            <th style="width:5%;">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($courses as $i => $dt)
                            @if($dt->course_package->material_type->name == $type)
                              <tr>
                                <td>{{ $dt->title }}</td>
                                <td>{{ $dt->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('instructors.show_course', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
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
                    foreach($courses as $dt) {
                      if($dt->course_package->material_type->name == $type) {
                        $count++;
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
                      <table class="table no-margin no-padding example1">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>Type</th>
                            <th style="width:5%;">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($courses as $i => $dt)
                            @if($dt->course_package->material_type->name == $type)
                              <tr>
                                <td>{{ $dt->title }}</td>
                                <td>{{ $dt->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('instructors.show_course', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
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
                    foreach($courses as $dt) {
                      if($dt->course_package->material_type->name == $type) {
                        $count++;
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
                      <table class="table no-margin no-padding example1">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>Type</th>
                            <th style="width:5%;">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($courses as $i => $dt)
                            @if($dt->course_package->material_type->name == $type)
                              <tr>
                                <td>{{ $dt->title }}</td>
                                <td>{{ $dt->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('instructors.show_course', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
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


















{{--Old File--}}
@section('content-header-old')
    <h1>Session</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Free Trial</li>
    </ol>
@stop
{{--Old File--}}
@section('content-old')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Link Zoom Session</h3>
                </div>
                <div class="box-body">
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Session In</label>
                            <select class="form-control select2" name="user">
                                <option selected="" disabled="">Session In</option>
                                <option>[kode] - Free Trial Course</option>
                                <option>[kode] - Novice-Low Private</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Link Zoom</label>
                            <input type="text" name="name" class="form-control" placeholder="Link Zoom.." value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <!-- Session-Course Reminder -->
            <div class="box box-warning">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 100px">Session ID</th>
                            <th>Course Level</th>
                            <th>Course Type</th>
                            <th>Date Meet</th>
                            <th>Status</th>
                            <th style="width: 40px">Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>FR001</td>
                            <td>Free</td>
                            <td>Trial</td>
                            <td>20 August 2020</td>
                            <td>No Link</td>
                            <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                        </tr>
                        <tr>
                            <td>FR002</td>
                            <td>Free</td>
                            <td>Trial</td>
                            <td>20 August 2020</td>
                            <td>No Link</td>
                            <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop

