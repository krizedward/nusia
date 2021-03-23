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
          <h4><i class="icon fa fa-comments"></i> You have successfully registered!</h4>
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

    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <?php $timeNusia = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta'); ?>
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> {{ __('custom_dashboard.panel_time.wib_text') }} <span id="time_nusia">{{ $timeNusia->isoFormat('h:mm A') }}</span></h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <?php $timeStudent = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone); ?>
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> {{ __('custom_dashboard.panel_time.other_tz_text') }} <span id="time_student">{{ $timeStudent->isoFormat('h:mm A') }}</span></h4>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Notification row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-comments"></i> {{ __('custom_dashboard.registered_successfully') }}</h4>
                {{ __('custom_dashboard.free_classes.sentence_1') }}<br>
                {{ __('custom_dashboard.free_classes.rules_intro') }}<br>
                {{ __('custom_dashboard.free_classes.rules_1_part_1') }}<b>{{ __('custom_dashboard.free_classes.rules_1_part_2') }}</b>{{ __('custom_dashboard.free_classes.rules_1_part_3') }}<br>
                {{ __('custom_dashboard.free_classes.rules_2') }}<br>
                {{ __('custom_dashboard.free_classes.rules_3_part_1') }}<b>{{ __('custom_dashboard.free_classes.rules_3_part_2') }}</b>{{ __('custom_dashboard.free_classes.rules_3_part_3') }}<br>
                {{ __('custom_dashboard.free_classes.rules_4') }}
            </div>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-clock-o"></i> Announcement</h4>
                The time schedule for your sessions is already adjusted with your local time.<br />
                Please check whether your local time zone shown in the dashboard is correct.<br />
                If not, you can change your local time zone in the profile.
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- Upcoming Sessions (for smaller screen resolution) -->
        <div class="box box-primary hidden-md hidden-lg hidden-xl">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Upcoming Sessions</b></h3>
            <p class="text-muted" style="margin-bottom:0px;">
              These sessions has been ordered by each starting time.
            </p>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <?php
                $i = 0;
                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
              ?>
              @foreach($session_order_by_schedule_time as $dt)
                @if($dt->schedule->schedule_time >= $schedule_now)
                  <li class="item">
                    <div class="product-img">
                      @if($dt->schedule->instructor_schedules->first()->instructor->user->image_profile != 'user.jpg')
                        <img src="{{ asset('uploads/instructor/'.$dt->schedule->instructor_schedules->first()->instructor->user->image_profile) }}" alt="User profile picture">
                      @else
                        <img src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
                      @endif
                    </div>
                    <div class="product-info">
                      {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                      <div class="product-title">
                        @if($dt->title)
                          @if($dt->course->title)
                            {{ $dt->course->title }} - {{ $dt->title }}
                          @else
                            {{ $dt->course->course_package->course_type->name }} - {{ $dt->title }}
                          @endif
                        @else
                          @if($dt->course->title)
                            {{ $dt->course->title }}
                          @else
                            {{ $dt->course->course_package->course_type->name }} - Session
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
                        <!-- Note: Don't forget to join the session(s).-->
                        @if($schedule_now >= $schedule_time_begin && $schedule_now <= $schedule_time_end)
                          {{--Class has been started.--}}
                          @if($dt->link_zoom)
                            <a href="{{ $dt->link_zoom }}" target="_blank" class="btn btn-xs btn-flat btn-success">Join this session until {{ $schedule_time_end->isoFormat('hh:mm A') }}</a>
                          @else
                            <a href="{{ $dt->link_zoom }}" target="_blank" class="btn btn-xs btn-flat btn-primary">Chat here to request the meeting link</a>
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
                  No upcoming sessions available.
                </div>
              @endif
            </ul>
          </div>
          <!-- /.box-body -->
          {{--
          <div class="box-footer text-center">
            <a href="{{ route('student.schedule.index') }}" class="uppercase">View All Sessions</a>
          </div>
          <!-- /.box-footer -->
          --}}
        </div>
        <!-- /.box -->
        <!-- Sessions -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Sessions</b></h3>
            <p class="text-muted" style="margin-bottom:0px;">
              Click on "Join" or "Form" button to join each session or give feedbacks (required to complete attendance information).
            </p>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table no-margin">
                <thead>
                  <tr>
                    <th style="width:30%;">Class (Session)</th>
                    <th>Meeting Time</th>
                    <th style="width:5%;">Meeting / Form</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($session_registration as $dt)
                    <tr>
                      <td>
                        @if($dt->session->course->title)
                          {{ $dt->session->course->title }}
                        @else
                          {{ $dt->session->course->course_package->title }}
                        @endif
                        for {{ $dt->session->course->course_package->course_level->name }}
                        ({{ $dt->session->title }})
                      </td>
                      @if($dt->session->schedule->schedule_time)
                        <?php
                          $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                          $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end_form = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                          $schedule_time_end_form->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                        ?>
                        <td>
                          <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDAhhmm') }}</span>
                          @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                            Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                          @else
                            {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                          @endif
                        </td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      <td>
                        @if($schedule_now <= $schedule_time_end)
                          @if($dt->session->link_zoom)
                            <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Join</a>
                          @else
                            <a class="btn btn-flat btn-xs btn-default disabled" href="#">Join</a>
                          @endif
                        @else
                          @if($dt->status == 'Should Submit Form' && $schedule_now <= $schedule_time_end_form)
                            <a href="#" data-toggle="modal" data-target="#FillForm{{$dt->id}}" class="btn btn-xs btn-flat bg-purple">Form</a>
                          @else
                            <a class="btn btn-flat btn-xs btn-default disabled" href="#">Form</a>
                          @endif
                        @endif
                      </td>
                    </tr>
                    @if($dt->status == 'Should Submit Form' && $schedule_now <= $schedule_time_end_form)
                      <div class="modal fade" id="FillForm{{$dt->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="box box-primary">
                              <div class="box-body box-profile">
                                <form role="form" method="post" action="@if($schedule_now > $schedule_time_end && $dt->status == 'Should Submit Form' && $schedule_now <= $schedule_time_end_form) {{ route('student.feedback.store', [$dt->course_registration_id, $dt->id]) }} @else {{ route('logout') }} @endif" enctype="multipart/form-data">
                                  @csrf
                                  <h3 class="profile-username text-center"><b>Feedback for {{ $dt->session->title }}</b></h3>
                                  <p class="text-muted text-center">
                                    Scheduled
                                    @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @else
                                      on {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                    @endif
                                  </p>
                                  @if($schedule_now > $schedule_time_end && $dt->status == 'Should Submit Form' && $schedule_now <= $schedule_time_end_form)
                                    <ul class="list-group list-group-unbordered">
                                      <li class="list-group-item text-red">
                                        Fill out this form to complete your attendance information!
                                      </li>
                                      <li class="list-group-item">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group @error('rating{{ $dt->id }}') has-error @enderror">
                                              <label for="rating{{ $dt->id }}">
                                                Overall, are you satisfied with this session? <span class="text-red">*</span><br />
                                                <i>Check the radio box below.</i>
                                              </label>
                                              <br />
                                              <input id="radioAnswer1For{{ $dt->id }}" name="rating{{ $dt->id }}" type="radio" value="5">
                                              <label for="radioAnswer1For{{ $dt->id }}" class="custom-control-label">Very Satisfied</label>
                                              <br />
                                              <input id="radioAnswer2For{{ $dt->id }}" name="rating{{ $dt->id }}" type="radio" value="4">
                                              <label for="radioAnswer2For{{ $dt->id }}" class="custom-control-label">Satisfied</label>
                                              <br />
                                              <input id="radioAnswer3For{{ $dt->id }}" name="rating{{ $dt->id }}" type="radio" value="3">
                                              <label for="radioAnswer3For{{ $dt->id }}" class="custom-control-label">Neutral</label>
                                              <br />
                                              <input id="radioAnswer4For{{ $dt->id }}" name="rating{{ $dt->id }}" type="radio" value="2">
                                              <label for="radioAnswer4For{{ $dt->id }}" class="custom-control-label">Dissatisfied</label>
                                              <br />
                                              <input id="radioAnswer5For{{ $dt->id }}" name="rating{{ $dt->id }}" type="radio" value="1">
                                              <label for="radioAnswer5For{{ $dt->id }}" class="custom-control-label">Very Dissatisfied</label>
                                              @error('rating{{ $dt->id }}')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                            <div class="form-group @error('comment') has-error @enderror">
                                              <label for="comment">
                                                Explain your reason:<br />
                                                <i>Feel free to tell your suggestion(s) here.</i>
                                              </label>
                                              <textarea id="comment" name="comment" class="@error('comment') is-invalid @enderror form-control" rows="3" placeholder="Explain your reason">{{ old('comment') }}</textarea>
                                              @error('comment')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                            <div class="text-red">* This field is required</div>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                    <button type="submit" class="btn btn-s btn-primary" style="width:100%;">Submit</button>
                                    <br /><br />
                                  @else
                                    <ul class="list-group list-group-unbordered">
                                      <li class="list-group-item">
                                        Sorry, you are ineligible to fill out this form.
                                      </li>
                                    </ul>
                                  @endif
                                </form>
                                <button onclick="document.getElementById('FillForm{{$dt->id}}').className = 'modal fade'; document.getElementById('FillForm{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-default" style="width:100%;">Close</button>
                              </div>
                              <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          {{--
          <div class="box-footer text-center">
            <a href="{{ route('student.schedule.index') }}" class="uppercase">View All Sessions</a>
          </div>
          <!-- /.box-footer -->
          --}}
        </div>
        <!-- /.box -->
        {{--
        <div class="row">
          <div class="col-md-6 hidden">
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
                      <span class="users-list-name" href="#">{{ $dt->user->first_name }} <!-- $dt->user->last_name --></span>
                    </li>
                  @endforeach
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="{{ route('registered.dashboard.index') }}" class="uppercase">View All Instructors</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!--/.box -->
          </div>
          <!-- /.col -->
        </div>
        --}}
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <!-- Upcoming Sessions (for larger screen resolution) -->
        <div class="box box-primary hidden-xs hidden-sm">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Upcoming Sessions</b></h3>
            <p class="text-muted" style="margin-bottom:0px;">
              These sessions has been ordered by each starting time.
            </p>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <?php
                $i = 0;
                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
              ?>
              @foreach($session_order_by_schedule_time as $dt)
                @if($dt->schedule->schedule_time >= $schedule_now)
                  <li class="item">
                    <div class="product-img">
                      @if($dt->schedule->instructor_schedules->first()->instructor->user->image_profile != 'user.jpg')
                        <img src="{{ asset('uploads/instructor/'.$dt->schedule->instructor_schedules->first()->instructor->user->image_profile) }}" alt="User profile picture">
                      @else
                        <img src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
                      @endif
                    </div>
                    <div class="product-info">
                      {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                      <div class="product-title">
                        @if($dt->title)
                          @if($dt->course->title)
                            {{ $dt->course->title }} - {{ $dt->title }}
                          @else
                            {{ $dt->course->course_package->course_type->name }} - {{ $dt->title }}
                          @endif
                        @else
                          @if($dt->course->title)
                            {{ $dt->course->title }}
                          @else
                            {{ $dt->course->course_package->course_type->name }} - Session
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
                        <!-- Note: Don't forget to join the session(s).-->
                        @if($schedule_now >= $schedule_time_begin && $schedule_now <= $schedule_time_end)
                          {{--Class has been started.--}}
                          @if($dt->link_zoom)
                            <a href="{{ $dt->link_zoom }}" target="_blank" class="btn btn-xs btn-flat btn-success">Join this session until {{ $schedule_time_end->isoFormat('hh:mm A') }}</a>
                          @else
                            <a href="{{ $dt->link_zoom }}" target="_blank" class="btn btn-xs btn-flat btn-primary">Chat here to request the meeting link</a>
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
                  No upcoming sessions available.
                </div>
              @endif
            </ul>
          </div>
          <!-- /.box-body -->
          {{--
          <div class="box-footer text-center">
            <a href="{{ route('student.schedule.index') }}" class="uppercase">View All Sessions</a>
          </div>
          <!-- /.box-footer -->
          --}}
        </div>
        <!-- /.box -->
            <!-- Materials -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Materials</b></h3>
                <p class="text-muted" style="margin-bottom:0px;">Click on a course name to view the course materials.</p>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion">
                  @if($course_registrations->toArray() != null)
                    @foreach($course_registrations as $cr)
                      <div class="panel box box-default">
                        <div class="box-header with-border">
                          <p class="box-title" style="display:inline;">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $cr->code }}{{ $cr->id }}" aria-expanded="false" class="collapsed" style="color:#555555;">
                              @if($cr->course->title)
                                <p><b>{{ $cr->course->title }}</b></p>
                              @else
                                <p><b>{{ $cr->course->course_package->title }}</b></p>
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
                                        <a target="_blank" rel="noopener noreferrer" href="{{ route('student.material.download', [$cr->id, 1, $dt->id]) }}">Download</a>
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
                                          <a target="_blank" rel="noopener noreferrer" href="{{ route('student.material.download', [$cr->id, 2, $dt->id]) }}">Download</a>
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
                                  <br /><br />
                                </div>
                              @endif
                              <div class="box-footer text-center">
                                <a href="{{ route('student.schedule.show', [$cr->id]) }}" class="uppercase">View This Course Information</a>
                              </div>
                            </ul>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @else
                    <div style="color:#555555">
                      No courses available.
                    </div>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              {{--
              <div class="box-footer text-center">
                <a href="{{ route('registered.dashboard.index') }}" class="uppercase">View All Materials</a>
              </div>
              --}}
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  @endif
@stop
