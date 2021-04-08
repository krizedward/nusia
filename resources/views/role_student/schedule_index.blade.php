@extends('layouts.admin.default')

@section('title', 'Schedules')

{{-- @include('layouts.css_and_js.form_general') --}}

{{-- @include('layouts.css_and_js.calendar') --}}

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
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
          <li class="active"><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
          <li><a href="#class_information" data-toggle="tab"><b>Class Information</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="sessions">
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
                          Click <b>"join"</b> button to start your session!
                          Don't forget to give feedback for each session by clicking <b>"form"</b> button (to be counted as your attendance).<br />
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
                      <h3 class="box-title"><b>All Sessions</b></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <?php
                        $has_a_schedule = 0;
                        $schedule_times_begin = [];
                        $schedule_times_end = [];
                        $schedule_times_end_form = [];
                        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                        foreach($session_registrations as $dt) {
                          $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end_form = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                          $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                          $schedule_time_end_form->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                          if($schedule_now <= $schedule_time_end_form) {
                            $has_a_schedule = 1;
                            array_push($schedule_times_begin, $schedule_time_begin);
                            array_push($schedule_times_end, $schedule_time_end);
                            array_push($schedule_times_end_form, $schedule_time_end_form);
                          }
                        }
                      ?>
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
                      @if($has_a_schedule)
                        <table class="table table-bordered example2">
                          <thead>
                            <th>Class / Session</th>
                            <th>Time</th>
                            <th>Attendance</th>
                            <th style="width:5%;">Link</th>
                          </thead>
                          <tbody>
                            @foreach($session_registrations as $i => $dt)
                              @if($schedule_now <= $schedule_times_end_form[$i])
                                <tr>
                                  <td>{{ $dt->session->course->title }} / {{ $dt->session->title }}</td>
                                  <td>
                                    <span class="hidden">{{ $schedule_times_begin[$i]->isoFormat('YYMMDDAhhmm') }}</span>
                                    @if($schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      Today, {{ $schedule_times_begin[$i]->isoFormat('hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                    @else
                                      {{ $schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                    @endif
                                  </td>
                                  <td>
                                    @if($dt->status == 'Not Assigned')
                                      <?php
                                        $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                        $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                        $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                      ?>
                                      @if($schedule_now < $schedule_time_begin)
                                        <label data-toggle="tooltip" title class="label bg-gray" data-original-title="This session has not started yet.">Upcoming</label>
                                      @elseif($schedule_now < $schedule_time_end)
                                        <label data-toggle="tooltip" title class="label bg-yellow" data-original-title="This session is in progress.">Ongoing</label>
                                      @else
                                        <label data-toggle="tooltip" title class="label bg-blue" data-original-title="This session attendance is being checked by your instructor.">Attendance Check</label>
                                      @endif
                                    @elseif($dt->status == 'Not Present')
                                      <label data-toggle="tooltip" title class="label bg-red" data-original-title="You don't attend this session.">Not Present</label>
                                    @elseif($dt->status == 'Should Submit Form')
                                      <label data-toggle="tooltip" title class="label bg-purple" data-original-title="You have attended this session, but are still required to complete the feedback form.">Should Submit Form</label>
                                    @elseif($dt->status == 'Present')
                                      <label data-toggle="tooltip" title class="label bg-green" data-original-title="You have attended this session and completed the feedback form for this session.">Present</label>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($schedule_now <= $schedule_times_end[$i])
                                      @if($dt->session->link_zoom)
                                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Join</a>
                                      @else
                                        <a class="btn btn-flat btn-xs btn-default disabled" href="#">Join</a>
                                      @endif
                                    @else
                                      @if($dt->status == 'Should Submit Form' && $schedule_now <= $schedule_times_end_form[$i])
                                        <a href="#" data-toggle="modal" data-target="#FillForm{{$dt->id}}" class="btn btn-xs btn-flat bg-purple">Form</a>
                                      @else
                                        <i class="text-muted">-</i>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                                @if($dt->status == 'Should Submit Form' && $schedule_now <= $schedule_times_end_form[$i])
                                  <div class="modal fade" id="FillForm{{$dt->id}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="box box-primary">
                                          <div class="box-body box-profile">
                                            <form role="form" method="post" action="@if($schedule_now > $schedule_times_end[$i] && $dt->status == 'Should Submit Form' && $schedule_now <= $schedule_times_end_form[$i]) {{ route('student.feedback.store', [$dt->course_registration->id, $dt->id]) }} @else {{ route('logout') }} @endif" enctype="multipart/form-data">
                                              @csrf
                                              <h3 class="profile-username text-center"><b>Feedback for {{ $dt->session->title }}</b></h3>
                                              <p class="text-muted text-center">
                                                Scheduled
                                                @if($schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                                  today, {{ $schedule_times_begin[$i]->isoFormat('hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                                @else
                                                  on {{ $schedule_times_begin[$i]->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_times_end[$i]->isoFormat('[-] hh:mm A') }}
                                                @endif
                                              </p>
                                              @if($schedule_now > $schedule_times_end[$i] && $dt->status == 'Should Submit Form' && $schedule_now <= $schedule_times_end_form[$i])
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
          <div class="tab-pane" id="class_information">
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
                          Click "link" button view more information about each class!<br />
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
                    <h3 class="box-title"><b>All Classes</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course_registrations->toArray() != 0)
                      <table class="table table-bordered example1">
                        <thead>
                          <th>Class</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th>
                        </thead>
                        <tbody>
                          @foreach($course_registrations as $i => $dt)
                            @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                              <tr>
                                <td>{{ $dt->course->title }}</td>
                                <td>{{ $dt->course->course_package->material_type->name }}/{{ $dt->course->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('student.schedule.show', [$dt->id]) }}">Link</a></td>
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
                <div class="box box-success">
                  <?php
                    $type = 'General Indonesian Language';
                    $count = 0;
                    foreach($course_registrations as $dt) {
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
                      <table class="table table-bordered example1">
                        <thead>
                          <th>Class</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th>
                        </thead>
                        <tbody>
                          @foreach($course_registrations as $i => $dt)
                            @if($dt->course->course_package->material_type->name == $type)
                              @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                                <tr>
                                  <td>{{ $dt->course->title }}</td>
                                  <td>{{ $dt->course->course_package->course_type->name }}</td>
                                  <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                                </tr>
                              @endif
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
                    foreach($course_registrations as $dt) {
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
                      <table class="table table-bordered example1">
                        <thead>
                          <th>Class</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th>
                        </thead>
                        <tbody>
                          @foreach($course_registrations as $i => $dt)
                            @if($dt->course->course_package->material_type->name == $type)
                              @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                                <tr>
                                  <td>{{ $dt->course->title }}</td>
                                  <td>{{ $dt->course->course_package->course_type->name }}</td>
                                  <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                                </tr>
                              @endif
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
                    foreach($course_registrations as $dt) {
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
                      <table class="table table-bordered example1">
                        <thead>
                          <th>Class</th>
                          <th>Type</th>
                          <th style="width:5%;">Detail</th>
                        </thead>
                        <tbody>
                          @foreach($course_registrations as $i => $dt)
                            @if($dt->course->course_package->material_type->name == $type)
                              @if(strpos($dt->course->course_package->title, 'Not Assigned') === false)
                                <tr>
                                  <td>{{ $dt->course->title }}</td>
                                  <td>{{ $dt->course->course_package->course_type->name }}</td>
                                  <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                                </tr>
                              @endif
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
