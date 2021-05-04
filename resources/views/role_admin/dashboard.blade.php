@extends('layouts.admin.default')

@section('title','Dashboard')

@include('layouts.css_and_js.all')

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Western Indonesian time: <span id="time_nusia">{{ $timeNusia->isoFormat('h:mm A') }}</span></h4>
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
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-book"></i> Update</h4>
                Private and group classes are in development!
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- col-8 -->
        <div class="col-md-8">
            <!-- TABLE: Student -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Student</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table no-margin">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registration Status</th>
                                <th>Proficiency</th>
                                <th>Attendance Count</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($student as $i => $dt)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                                    <td>{{ $dt->user->email }}</td>
                                    @if($dt->course_registrations->count() != 0)
                                      <td><label class="badge bg-green">Registered</label></td>
                                    @elseif($dt->age == 0)
                                      <td><label class="badge bg-red">Not registered</label></td>
                                    @else
                                      <td><label class="badge bg-yellow">Choosing a class</label></td>
                                    @endif
                                    <td>{{ $dt->indonesian_language_proficiency }}</td>
                                    @if($dt->course_registrations->count() != 0)
                                      <?php
                                        $i = 0;
                                        foreach($dt->course_registrations->first()->session_registrations as $sr) {
                                          if($sr->status == 'Present' || $sr->status == 'Should Submit Form') $i++;
                                        }
                                      ?>
                                      <td>{{ $i }}/{{ $dt->course_registrations->first()->course->course_package->count_session }}</td>
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
                <div class="box-footer text-center">
                  <a href="{{-- route('students.index') --}}" class="uppercase">View All Students</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

            <!-- TABLE: Instructor -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Instructor</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instructor as $i => $dt)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                                    <td>{{ $dt->user->email }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{-- route('instructors.index') --}}" class="uppercase">View All Instructors</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

            <!-- TABLE: Schedule -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Schedule</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table no-margin">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Proficiency</th>
                                <th>Slot</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($course as $i => $dt)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $dt->title }}</td>
                                    <td>{{ $dt->course_package->course_level->name }}</td>
                                    <td>{{ $dt->course_registrations->count() }}/{{ $dt->course_package->course_type->count_student_max }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{-- route('schedules.index') --}}" class="uppercase">View All Schedules</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <!-- col-4 -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Upcoming Session</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <?php $i = 0; ?>
                    @foreach($session as $dt)
                      @if($dt->schedule->schedule_time > now())
                      <li class="item">
                        <div class="product-img">
                          @if($dt->schedule->instructor->user->image_profile)
                            <img src="{{ url('uploads/instructor/'.$dt->schedule->instructor->user->image_profile) }}" alt="User profile picture">
                          @else
                            <img src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
                          @endif
                        </div>
                        <div class="product-info">
                          {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                          <div class="product-title">
                            @if($dt->title)
                              @if($dt->course->title)
                                {{ $dt->course->course_package->course_level->name }} - {{ $dt->course->title }} - {{ $dt->title }}
                              @else
                                {{ $dt->course->course_package->course_level->name }} - {{ $dt->course->course_package->title }} - {{ $dt->title }}
                              @endif
                            @else
                              @if($dt->course->title)
                                {{ $dt->course->course_package->course_level->name }} - {{ $dt->course->title }}
                              @else
                                {{ $dt->course->course_package->course_level->name }} - {{ $dt->course->course_package->title }}
                              @endif
                            @endif
                            @if($dt->schedule->schedule_time)
                              <?php
                                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                $schedule_time_begin = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_end->add($dt->course->course_package->material_type->duration_in_minute, 'minutes');
                              ?>
                              @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                <span class="label label-success pull-right">Today</span>
                              @else
                                <span class="label label-info pull-right">{{ $schedule_time_begin->isoFormat('MMM DD \'YY') }}</span>
                              @endif
                            @else 
                              <span class="label label-danger pull-right">N/A</span>
                            @endif
                          </div>
                          <span class="product-description">
                            <!--Note : don't forget to join class.-->
                            @if($dt->schedule->schedule_time < now())
                              Class has been started!
                              @if($dt->link_zoom)
                                Join <a href="{{ $dt->link_zoom }}" target="_blank">here</a>.
                              @endif
                            @else
                              {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                            @endif
                          </span>
                        </div>
                      </li>
                      <!-- /.item -->
                      <?php $i++; ?>
                      @endif
                    @endforeach
                    @if($i == 0)
                      <div style="color:#555555">
                        No courses available.
                      </div>
                    @endif
                  </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{-- route('sessions.index') --}}" class="uppercase">View All Sessions</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
