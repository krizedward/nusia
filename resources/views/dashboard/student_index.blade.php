@extends('layouts.admin.default')

@section('title','Dashboard')

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content')
  @if(Auth::user()->citizenship == 'Not Available')
    <!-- Notification row -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <h4><i class="icon fa fa-book"></i> Free Class Available!</h4>
          Nusia akan memberikan kesempatan 3 kelas gratis dengan memilih kelas bebas.
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Notification row -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible">
          <h4><i class="icon fa fa-book"></i> Account Confirmation Required</h4>
          Sebelum melakukan pendaftaran kelas, Anda diwajibkan untuk mengisi formulir pada bagian "Account Confirmation".
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Nusia Instructors</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach($instructors as $dt)
                <li>
                  @if($dt->user->image_profile)
                    <img src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                  @else
                    <img src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
                  @endif
                  <span class="users-list-name" href="#">{{ $dt->user->first_name }} {{ $dt->user->last_name }}</span>
                </li>
              @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{ route('instructors.index') }}" class="uppercase">View All Instructors</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!--/.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  @else

    <!--div class="row">
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4><i class="icon fa fa-clock-o"></i> Our time: {{ $timeNusia->isoFormat('h:mm a') }} {{ $timeNusia->tzName }}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4><i class="icon fa fa-clock-o"></i> Your time: {{ $timeStudent->isoFormat('h:mm a') }} {{ $timeStudent->tzName }}</h4>
            </div>
        </div>
    </div-->
    <!-- /.row -->

    <!-- Notification row -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <h4><i class="icon fa fa-book"></i> Free Classes Available!</h4>
          <!--Nusia akan memberikan kesempatan 3 kelas gratis dengan memilih kelas bebas.-->
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- TABLE: LATEST ORDERS -->
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
                    <th>Class</th>
                    <th>Level</th>
                    <th>Session</th>
                    <th>Meeting Time</th>
                    <th>Zoom Link</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($session as $dt)
                    <tr>
                      @if($dt->course->title)
                        <td>{{ $dt->course->title }}</td>
                      @else
                        <td>{{ $dt->course->course_package->title }}</td>
                      @endif
                      <td>{{ $dt->course->course_package->course_level->name }}</td>
                      <td>{{ $dt->title }}</td>
                      {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                      <!--td>{{ date('l, M d Y', strtotime($dt->schedule->schedule_time)) }}</td-->
                      @if($dt->schedule->schedule_time)
                        <?php
                          $schedule_time = \Carbon\Carbon::parse(strtotime($dt->schedule->schedule_time));
                        ?>
                        <td>{{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}</td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      @if($dt->link_zoom)
                        <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Join</a></td>
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
          <!--div class="box-footer clearfix">
            <a href="{{ route('session_registrations.index') }}" class="btn btn-sm btn-info btn-flat pull-left">View All Sessions</a>
          </div-->
          <!--div class="box-footer text-center">
            <a href="{{ route('session_registrations.index') }}" class="uppercase">View All Sessions</a>
          </div-->
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
        <div class="row">
          <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Nusia Instructors</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <ul class="users-list clearfix">
                  @foreach($instructors as $dt)
                    <li>
                      @if($dt->user->image_profile)
                        <img src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                      @else
                        <img src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
                      @endif
                      <span class="users-list-name" href="#">{{ $dt->user->first_name }} {{-- $dt->user->last_name --}}</span>
                    </li>
                  @endforeach
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="{{ route('instructors.index') }}" class="uppercase">View All Instructors</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!--/.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <!-- Download Materials -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Download Materials</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion">
                  @foreach($course_registrations as $cr)
                    <div class="panel box box-default">
                      <div class="box-header with-border">
                        <p class="box-title" style="display:inline;">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $cr->code }}{{ $cr->id }}" aria-expanded="false" class="collapsed" style="color:#555555;">
                            @if($cr->course->title)
                              <p>{{ $cr->course->title }}</p>
                            @else
                              <p>{{ $cr->course->course_package->title }}</p>
                            @endif
                          </a>
                        </p>
                      </div>
                      <?php $i = 0; ?>
                      <div id="collapse{{ $cr->code }}{{ $cr->id }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <ul class="products-list product-list-in-box">
                            @foreach($cr->course->course_package->material_publics as $dt)
                              @if($dt->path)
                                <?php $i++ ?>
                                <li class="item">
                                  <div class="product-img">
                                    <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                                  </div>
                                  <div class="product-info">
                                    @if($cr->course->title)
                                      <div class="product-title">{{ $cr->course->title }} - {{ $dt->name }}</div>
                                    @else
                                      <div class="product-title">{{ $cr->course->course_package->title }} - {{ $dt->name }}</div>
                                    @endif
                                    <span class="product-description">
                                      <a target="_blank" rel="noopener noreferrer" href="{{ route('materials.download', ['Public', $dt->id]) }}">Download</a>
                                    </span>
                                  </div>
                                </li>
                                <!-- /.item -->
                              @endif
                            @endforeach
                            @foreach($cr->course->sessions as $s)
                              @foreach($s->material_sessions as $dt)
                                @if($dt->path)
                                  <?php $i++ ?>
                                  <li class="item">
                                    <div class="product-img">
                                      <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                      @if($s->title)
                                        <div class="product-title">{{ $s->title }} - {{ $dt->name }}</div>
                                      @elseif($s->course->title)
                                        <div class="product-title">{{ $s->course->title }} - {{ $dt->name }}</div>
                                      @else
                                        <div class="product-title">{{ $s->course->course_package->title }} - {{ $dt->name }}</div>
                                      @endif
                                      <span class="product-description">
                                        <a target="_blank" rel="noopener noreferrer" href="{{ route('materials.download', ['Session', $dt->id]) }}">Download</a>
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
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="{{ route('materials.index') }}" class="uppercase">View All Materials</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <!-- Session-Course Reminder -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upcoming Sessions</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              @foreach($session_order_by_schedule_time as $dt)
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
                          {{ $dt->course->title }} - {{ $dt->title }}
                        @else
                          {{ $dt->course->course_package->title }} - {{ $dt->title }}
                        @endif
                      @else
                        @if($dt->course->title)
                          {{ $dt->course->title }}
                        @else
                          {{ $dt->course->course_package->title }}
                        @endif
                      @endif
                      @if($dt->schedule->schedule_time)
                        <?php
                          $schedule_time = \Carbon\Carbon::parse(strtotime($dt->schedule->schedule_time));
                        ?>
                        <span class="label label-info pull-right">{{ $schedule_time->isoFormat('MMMM Do YYYY') }}</span>
                      @else
                        <span class="label label-danger pull-right">Not Available</span>
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
                        Meeting time: {{ $schedule_time->isoFormat('hh:mm') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
                      @endif
                    </span>
                  </div>
                </li>
                <!-- /.item -->
                @endif
              @endforeach
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
    </div>
    <!-- /.row -->
  @endif
@stop
