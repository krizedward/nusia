@extends('layouts.admin.default')

@section('title','Dashboard')

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Our time: <span id="time_nusia">{{ $timeNusia->isoFormat('h:mm A') }}</span></h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Your time: <span id="time_student">{{ $timeStudent->isoFormat('h:mm A') }}</span></h4>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible">
                <h4 style="color: #000;"><i class="icon fa fa-link"></i> Please Consider :)</h4>
                <span style="color: #000;">Before teaching, don't forget to attach a Zoom link for each session, so the students may join the session.</span>
            </div>
            <div class="alert alert-warning alert-dismissible">
                <h4 style="color: #000;"><i class="icon fa fa-clock-o"></i> Please check whether your local time zone shown in the dashboard is correct.</h4>
                <span style="color: #000">If not, you can change your local time zone in the profile.</span>
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
                    <h3 class="box-title">Sessions</h3>
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
                                @foreach($sessions as $s)
                                <tr>
                                    <td>{{ $s->course->course_package->course_level->name }}</td>
                                    <td>{{ $s->course->title }}</td>
                                    {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                                    <td>{{ $s->title }}</td>
                                    <?php
                                      $schedule_time = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                      $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                    ?>
                                    <td>
                                      <span class="hidden">{{ $schedule_time->isoFormat('YYMMDDAhhmm') }}</span>
                                      @if($schedule_time->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                        Today, {{ $schedule_time->isoFormat('hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
                                      @else
                                        {{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
                                      @endif
                                    </td>
                                    @if($s->link_zoom)
                                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $s->link_zoom }}">Link</a></td>
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
                {{--
                @if($sessions->count() > 0)
                  <div class="box-footer text-center">
                    <a href="{{ route('session_registrations.index') }}" class="uppercase">View All Sessions</a>
                  </div>
                @endif
                --}}
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
                                @foreach($sessions as $s)
                                  @foreach($s->course->course_registrations as $cr)
                                    <li>
                                        <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                        <span class="users-list-name" href="#">{{ $cr->student->user->first_name }}</span>
                                    </li>
                                  @endforeach
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
                              @foreach($sessions_order_by_schedule_time as $s)
                               @if($s->schedule->schedule_time >= now())
                                <li class="item">
                                  <div class="product-img">
                                    @if($s->schedule->instructor_id == Auth::user()->instructor->id)
                                      @if($s->schedule->instructor_id_2)
                                        <img src="{{ asset('uploads/instructor/'.$s->image_profile) }}" alt="User Image">
                                      @else
                                        <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="User Image">
                                      @endif
                                    @elseif($s->schedule->instructor_id_2 == Auth::user()->instructor->id)
                                      <img src="{{ asset('uploads/instructor/'.$s->schedule->instructor->user->image_profile) }}" alt="User Image">
                                    @endif
                                  </div>
                                  <div class="product-info">
                                    <?php
                                      $schedule_time = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                      $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                    ?>
                                    <div class="product-title">
                                      {{ $s->course->course_package->course_level->name }} - {{ $s->course->title }} - {{ $s->title }}
                                      @if($schedule_time->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                        <span class="label label-success pull-right">Today</span>
                                      @else
                                        <span class="label label-info pull-right">{{ $schedule_time->isoFormat('MMM DD \'YY') }}</span>
                                      @endif
                                    </div>
                                    <span class="product-description">
                                      @if($s->schedule->schedule_time < now())
                                        Class has been started!
                                        @if($s->link_zoom)
                                          Join <a href="{{ $s->link_zoom }}" target="_blank">here</a>.
                                        @endif
                                      @else
                                        {{ $schedule_time->isoFormat('hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
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
                                  No courses available.
                                </div>
                              @endif
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        @if($sessions->count() > 0)
                          <div class="box-footer text-center">
                            <a href="{{ route('session_registrations.index') }}" class="uppercase">View All Sessions</a>
                          </div>
                        @endif
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
