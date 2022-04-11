@extends('layouts.admin.default')

@section('title','Dashboard')

@include('layouts.css_and_js.all')

@section('content')
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
  <div class="row">
    <!-- Left col -->
    <div class="col-md-4 hidden-md hidden-lg hidden-xl">
      <div class="box box-primary hidden-md hidden-lg hidden-xl">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Upcoming Sessions</b></h3>
          <p class="text-muted" style="margin-bottom:0px;">
            These sessions has been ordered by each starting time.
          </p>
          <div class="box-tools pull-right hidden-md hidden-lg hidden-xl">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            <?php $i = 0; ?>
            @foreach($sessions_order_by_schedule_time as $s)
              <?php
                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                $schedule_time_end = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
              ?>
              @if($schedule_time_end >= now())
                <li class="item">
                  <div class="product-img">
                    @if($s->schedule->instructor_schedules->first()->instructor_id == Auth::user()->instructor->id)
                      @if($s->schedule->instructor_schedules->last()->instructor_id != Auth::user()->instructor->id)
                        <img src="{{ asset('uploads/instructor/'.$s->schedule->instructor_schedules->last()->instructor->user->image_profile) }}" alt="User Image">
                      @else
                        @if(Auth::user()->image_profile != 'user.jpg')
                          <img src="{{ asset('uploads/instructor/'.Auth::user()->image_profile) }}" alt="User Image">
                        {{-- <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="User Image"> --}}
                        @else
                          <img src="{{ asset('uploads/user.jpg') }}" alt="User Image">
                        @endif
                      @endif
                    @else
                      <img src="{{ asset('uploads/instructor/'.$s->schedule->instructor_schedules->first()->instructor->user->image_profile) }}" alt="User Image">
                    @endif
                  </div>
                  <div class="product-info">
                    <div class="product-title">
                      {{ $s->course->course_package->course_level->name }} - {{ $s->course->title }} - {{ $s->title }}
                      @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                        <span class="label label-success pull-right">Today</span>
                      @else
                        <span class="label label-info pull-right">{{ $schedule_time_begin->isoFormat('MMM DD \'YY') }}</span>
                      @endif
                    </div>
                    <span class="product-description">
                      @if($s->schedule->schedule_time < now())
                        {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}<br />
                        Class has started!
                        @if($s->link_zoom)
                          <a href="{{ $s->link_zoom }}" target="_blank" class="btn btn-xs btn-flat btn-success">Click here to join</a>
                        @else
                          <form role="form" method="post" action="{{ route('instructor.session_show.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="session_id" value="{{ $s->id }}">
                            <input type="hidden" name="session_description" value="{{ $s->description }}">
                            <div class="form-group @error('link_zoom') has-error @enderror">
                              <label for="link_zoom">Please add a new meeting link:</label>
                              <input name="link_zoom" type="text" class="form-control" placeholder="Enter a meeting link" value="{{ old('link_zoom') }}">
                              @error('link_zoom')
                                <p style="color:red">{{ $message }}</p>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-flat btn-sm bg-blue" style="width:100%;">Submit</button>
                          </form>
                        @endif
                      @else
                        {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
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
            <a href="{{ route('instructor.schedule.index') }}" class="uppercase">View All Sessions</a>
          </div>
          <!-- /.box-footer -->
        @endif
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <!-- TABLE: Sessions Instructor -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Sessions</b></h3>
          <p class="text-muted" style="margin-bottom:0px;">
            Click on "Join" button to join each session.
          </p>
          <div class="box-tools pull-right hidden-md hidden-lg hidden-xl">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
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
                      $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                      $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                      $schedule_time_end = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                      $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
                    ?>
                    <td>
                      <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                      @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                        Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                      @else
                        {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
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
            <a href="{{ route('instructor.schedule.index') }}" class="uppercase">View All Sessions</a>
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
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
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
      <div class="box box-primary hidden-xs hidden-sm">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Upcoming Sessions</b></h3>
          <p class="text-muted" style="margin-bottom:0px;">
            These sessions has been ordered by each starting time.
          </p>
          <div class="box-tools pull-right hidden-md hidden-lg hidden-xl">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            <?php $i = 0; ?>
            @foreach($sessions_order_by_schedule_time as $s)
              <?php
                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                $schedule_time_end = \Carbon\Carbon::parse(explode('||', $s->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                $schedule_time_end->add($s->course->course_package->material_type->duration_in_minute, 'minutes');
              ?>
              @if($schedule_time_end >= now())
                <li class="item">
                  <div class="product-img">
                    @if($s->schedule->instructor_schedules->first()->instructor_id == Auth::user()->instructor->id)
                      @if($s->schedule->instructor_schedules->last()->instructor_id != Auth::user()->instructor->id)
                        <img src="{{ asset('uploads/instructor/'.$s->schedule->instructor_schedules->last()->instructor->user->image_profile) }}" alt="User Image">
                      @else
                        @if(Auth::user()->image_profile != 'user.jpg')
                          <img src="{{ asset('uploads/instructor/'.Auth::user()->image_profile) }}" alt="User Image">
                        {{-- <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="User Image"> --}}
                        @else
                          <img src="{{ asset('uploads/user.jpg') }}" alt="User Image">
                        @endif
                      @endif
                    @else
                      <img src="{{ asset('uploads/instructor/'.$s->schedule->instructor_schedules->first()->instructor->user->image_profile) }}" alt="User Image">
                    @endif
                  </div>
                  <div class="product-info">
                    <div class="product-title">
                      {{ $s->course->course_package->course_level->name }} - {{ $s->course->title }} - {{ $s->title }}
                      @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                        <span class="label label-success pull-right">Today</span>
                      @else
                        <span class="label label-info pull-right">{{ $schedule_time_begin->isoFormat('MMM DD \'YY') }}</span>
                      @endif
                    </div>
                    <span class="product-description">
                      @if($s->schedule->schedule_time < now())
                        {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}<br />
                        Class has started!
                        @if($s->link_zoom)
                          <a href="{{ $s->link_zoom }}" target="_blank" class="btn btn-xs btn-flat btn-success">Click here to join</a>
                        @else
                          <form role="form" method="post" action="{{ route('instructor.session_show.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="session_id" value="{{ $s->id }}">
                            <input type="hidden" name="session_description" value="{{ $s->description }}">
                            <div class="form-group @error('link_zoom') has-error @enderror">
                              <label for="link_zoom">Please add a new meeting link:</label>
                              <input name="link_zoom" type="text" class="form-control" placeholder="Enter a meeting link" value="{{ old('link_zoom') }}">
                              @error('link_zoom')
                                <p style="color:red">{{ $message }}</p>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-flat btn-sm bg-blue" style="width:100%;">Submit</button>
                          </form>
                        @endif
                      @else
                        {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
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
            <a href="{{ route('instructor.schedule.index') }}" class="uppercase">View All Sessions</a>
          </div>
          <!-- /.box-footer -->
        @endif
      </div>
      <!-- /.box -->
      <!-- Materials -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Materials</b></h3>
          <p class="text-muted" style="margin-bottom:0px;">Click on a class name to view the class materials.</p>
          <div class="box-tools pull-right hidden-md hidden-lg hidden-xl">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="box-group" id="accordion">
            <?php $arr = []; ?>
            @foreach($sessions as $s)
              <?php
                if(!in_array($s->course->id, $arr)) {
                  array_push($arr, $s->course->id);
                } else continue;
              ?>
              <div class="panel box box-default">
                <div class="box-header with-border">
                  <p class="box-title" style="display:inline;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $s->course->code }}{{ $s->course->id }}" aria-expanded="false" class="collapsed" style="color:#555555;">
                      @if($s->course->title)
                        <p><b>{{ $s->course->title }}</b></p>
                      @else
                        <p><b>{{ $s->course->course_package->title }}</b></p>
                      @endif
                    </a>
                  </p>
                </div>
                <?php $i = 0; ?>
                <div id="collapse{{ $s->course->code }}{{ $s->course->id }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="box-body">
                    <ul class="products-list product-list-in-box">
                      @foreach($s->course->course_package->material_publics as $dt)
                        @if($dt->path)
                          <?php $i++ ?>
                          <li class="item">
                            <div class="product-img">
                              <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                            </div>
                            <div class="product-info">
                              <div class="product-title">
                                @if($s->course->title)
                                  {{ $s->course->title }} - {{ $dt->name }}
                                @else
                                  {{ $s->course->course_package->title }} - {{ $dt->name }}
                                @endif
                                @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                  (Link)
                                @else
                                  ({{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }})
                                @endif
                              </div>
                              <span class="product-description">
                                @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                  <a target="_blank" rel="noopener noreferrer nofollow" href="{{ $dt->path }}">Click here to download</a>
                                @else
                                  <a target="_blank" rel="noopener noreferrer" href="{{ route('instructor.material.download', [1, $dt->id]) }}">Click here to download</a>
                                @endif
                              </span>
                            </div>
                          </li>
                          <!-- /.item -->
                        @endif
                      @endforeach
                      @foreach($s->course->sessions as $ss)
                        @foreach($ss->material_sessions as $dt)
                          @if($dt->path)
                            <?php $i++ ?>
                            <li class="item">
                              <div class="product-img">
                                <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                              </div>
                              <div class="product-info">
                                <div class="product-title">
                                  @if($ss->title)
                                    {{ $ss->title }} - {{ $dt->name }}
                                  @elseif($ss->course->title)
                                    {{ $ss->course->title }} - {{ $dt->name }}
                                  @else
                                    {{ $ss->course->course_package->title }} - {{ $dt->name }}
                                  @endif
                                  @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                    (Link)
                                  @else
                                    ({{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }})
                                  @endif
                                </div>
                                <span class="product-description">
                                  @if(strpos($dt->path, '://') !== false || strpos($dt->path, 'www.') !== false)
                                    <a target="_blank" rel="noopener noreferrer nofollow" href="{{ $dt->path }}">Click here to download</a>
                                  @else
                                    <a target="_blank" rel="noopener noreferrer" href="{{ route('instructor.material.download', [2, $dt->id]) }}">Click here to download</a>
                                  @endif
                                </span>
                              </div>
                            </li>
                            <!-- /.item -->
                          @endif
                        @endforeach
                      @endforeach
                      @if($i == 0)
                        <div style="color:#555555">
                          No materials for this course.
                        </div>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            @endforeach
            @if($sessions->toArray() == null)
              <div style="color:#555555">
                No materials for this course.
              </div>
            @endif
          </div>
        </div>
        <!-- /.box-body -->
        {{--
        <div class="box-footer text-center">
          <a href="{{ route('materials.index') }}" class="uppercase">View All Materials</a>
        </div>
        <!-- /.box-footer -->
        --}}
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4" hidden>
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-star"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">
              Rating
            </span>
            <span class="info-box-number">
              5.0
            </span>
            <div class="progress">
              <div class="progress-bar" style="width:100%">
              </div>
            </div>
            <span class="progress-description">
              Total 100% in Perfect
            </span>
          </div>
          <!-- /.box-content -->
        </div>
        <!-- /.box -->
        <div class="info-box bg-green">
          <span class="info-box-icon">
            <i class="fa fa-check-square-o"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">
              Session Done
            </span>
            <span class="info-box-number">
              0
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 100%">
              </div>
            </div>
          </span>
        </div>
        <!-- /.box-content -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@stop
