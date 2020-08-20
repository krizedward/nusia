@extends('layouts.admin.default')

@section('title','Dashboard')

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Our time: <span id="time_nusia">{{ $timeNusia->isoFormat('h:mm a') }}</span> {{ $timeNusia->tzName }}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Your time: <span id="time_student">{{ $timeStudent->isoFormat('h:mm a') }}</span> {{ $timeStudent->tzName }}</h4>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-book"></i> Please Consider :)</h4>
                Before teaching, don't forget to attach a Zoom link for each session, so the students may join the session.
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
            <!-- TABLE: Sessions Instructor -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Classes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table no-margin">
                            <thead>
                            <tr>
                                <th>Level</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Meeting Time</th>
                                <th>Zoom Link</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->instructor->schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->session->course->course_package->course_level->name }}</td>
                                    <td>{{ $schedule->session->course->title }}</td>
                                    {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                                    <td>{{ $schedule->session->title }}</td>
                                    <?php
                                      $schedule_time = \Carbon\Carbon::parse($schedule->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                    ?>
                                    <td>{{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}</td>
                                    @if($schedule->session->link_zoom)
                                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $schedule->session->link_zoom }}">Link</a></td>
                                    @else
                                      <td><i>N/A</i></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <!--div class="box-footer text-center">
                  <a href="{{ route('session_registrations.index') }}" class="uppercase">View All Sessions</a>
                </div-->
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
            <div class="row">
                <div class="col-md-6 hidden">
                    <!-- STUDENT LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Course</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @foreach($session_reg as $dt)
                                    <li>
                                        <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                        <span class="users-list-name" href="#">{{ $dt->course_registration->student->user->first_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="#" class="uppercase">View All Student</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col -->

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upcoming Sessions</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                              <?php $i = 0; ?>
                              @foreach($session_reg_order_by_schedule_time as $dt)
                               @if($dt->schedule_time >= now())
                                <li class="item">
                                  <div class="product-img">
                                    @if($dt->instructor_id == Auth::user()->instructor->id)
                                      @if($dt->instructor_id_2)
                                        <img src="{{ asset('uploads/instructor/'.$dt->image_profile) }}" alt="User Image">
                                      @else
                                        <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="User Image">
                                      @endif
                                    @elseif($dt->instructor_id_2 == Auth::user()->instructor->id)
                                      <img src="{{ asset('uploads/instructor/'.$dt->instructor->user->image_profile) }}" alt="User Image">
                                    @endif
                                  </div>
                                  <div class="product-info">
                                    <?php
                                      $schedule_time = \Carbon\Carbon::parse($dt->schedule_time)->setTimezone(Auth::user()->timezone);
                                    ?>
                                    <div class="product-title">{{ $dt->session->course->title }} - {{ $dt->session->title }}
                                      <span class="label label-info pull-right">{{ $schedule_time->isoFormat('MMMM Do YYYY') }}</span>
                                    </div>
                                    <span class="product-description">
                                      @if($dt->schedule_time < now())
                                        Class has been started!
                                        @if($dt->session->link_zoom)
                                          Join <a href="{{ $dt->session->link_zoom }}" target="_blank">here</a>.
                                        @endif
                                      @else
                                        Meeting time: {{ $schedule_time->isoFormat('hh:mm') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
                                      @endif
                                    </span>
                                  </div>
                                </li>
                                <!-- /.item -->
                               @endif
                               <?php $i++; ?>
                              @endforeach
                              @if($i == 0)
                                <div style="color:#555555">
                                  No courses available. You may join one first!
                                </div>
                              @endif
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                          <a href="{{ route('session_registrations.index') }}" class="uppercase">View All Sessions</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

        <div class="col-md-4" hidden>
            <!-- Info Boxes Style 2 -->
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-star"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Rating</span>
                    <span class="info-box-number">5.0</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Total 100% in Perfect
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Session Done</span>
                    <span class="info-box-number">0</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
