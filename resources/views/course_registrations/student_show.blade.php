@extends('layouts.admin.default')

@section('title', 'Student | View Course')

{{-- @include('layouts.css_and_js.table') --}}

@include('layouts.css_and_js.form_advanced')

@section('content-header')
  <h1><b>Course Information</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('session_registrations.index') }}">Schedules</a></li>
    <li class="active">Course Information</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
          <li><a href="#materials" data-toggle="tab"><b>Materials</b></a></li>
          <li><a href="#tasks" data-toggle="tab"><b>Tasks</b></a></li>
          <li><a href="#grades" data-toggle="tab"><b>Grades</b></a></li>
          <li><a href="#certificate" data-toggle="tab"><b>Certificate</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course_registration->course->course_package->count_session
                        --}}
                        {{ $course_registration->course->sessions->count() }}
                        @if($course_registration->course->sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Registration Time</strong>
                    <p>
                      <?php
                        if($course_registration->created_at != null)
                          $schedule_time = \Carbon\Carbon::parse($course_registration->created_at)->setTimezone(Auth::user()->timezone);
                        else
                          $schedule_time = null;
                      ?>
                      <table>
                        <tr>
                          <td><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($schedule_time)
                              {{ $schedule_time->isoFormat('dddd') }}
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><b>Date</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($schedule_time)
                              {{ $schedule_time->isoFormat('MMMM Do YYYY, hh:mm A') }}
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-credit-card margin-r-5"></i> Course Payment</strong>
                    <p>
                      <table>
                        <tr>
                          <td><b>Price</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>${{ $course_registration->course->course_package->price }}</td>
                        </tr>
                        <tr>
                          <td><b>Status</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            <?php
                              $sum = 0;
                              foreach($course_registration->course_payments as $dt) {
                                if($dt->status == 'Confirmed') {
                                  $sum += $dt->amount;
                                }
                              }
                            ?>
                            @if($course_registration->course->course_package->price != 0)
                              {{-- Kode untuk memeriksa status pembayaran untuk course berbayar. --}}
                              @if($sum > $course_registration->course->course_package->price)
                                <span style="color:red;">Possible bug, please report to us.</span>
                              @elseif($sum == $course_registration->course->course_package->price)
                                <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Paid</span>
                              @else
                                <span class="label label-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Not Fully Paid</span>
                              @endif
                            @else
                              <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Free of Charge</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><b>Paid at</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->course->course_package->price != 0)
                              @if($sum > $course_registration->course->course_package->price)
                                <span style="color:red;">Possible bug, please report to us.</span>
                              @elseif($sum == $course_registration->course->course_package->price)
                                <?php
                                  $payment_time = \Carbon\Carbon::parse($course_registration->course_payments->last()->payment_time)->setTimezone(Auth::user()->timezone);
                                ?>
                                {{ $payment_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                              @else
                                Not Fully Paid
                              @endif
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-video-o margin-r-5"></i> Student Placement Test</strong>
                    <p>
                      <table>
                        <tr>
                          <td><b>Link</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->placement_test)
                              @if($course_registration->placement_test->path)
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $course_registration->placement_test->path }}">Link</a></td>
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><b>Result</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->placement_test)
                              @if($course_registration->placement_test->status == 'Passed')
                                <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Passed</span>
                              @elseif($course_registration->placement_test->status == 'Not Passed')
                                <span class="label label-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Not Passed</span>
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><b>Final Level</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->placement_test)
                              @if($course_registration->placement_test->status == 'Passed')
                                {{ $course_registration->course->course_package->course_level->name }}
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><b>Updated at</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->placement_test)
                              @if($course_registration->placement_test->status)
                                <?php
                                  $update_time = \Carbon\Carbon::parse($course_registration->placement_test->result_updated_at)->setTimezone(Auth::user()->timezone);
                                ?>
                                {{ $update_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </p>
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
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
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
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Material Type</strong>
                      <p>
                        @if($course_registration->course->course_package->material_type->description)
                          @if($course_registration->course->course_package->material_type->name == 'General Indonesian Language')
                            <u>{{ $course_registration->course->course_package->material_type->name }}</u><br>
                            {{ Str::limit($course_registration->course->course_package->material_type->description, 359) }}
                          @else
                            <u>{{ $course_registration->course->course_package->material_type->name }}</u><br>
                            {{ $course_registration->course->course_package->material_type->description }}
                          @endif
                        @else
                          {{ $course_registration->course->course_package->material_type->name }}
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Course Type</strong>
                      <p>
                        @if($course_registration->course->course_package->course_type->description)
                          <u>{{ $course_registration->course->course_package->course_type->name }}</u><br>
                          {{ $course_registration->course->course_package->course_type->description }}
                        @else
                          {{ $course_registration->course->course_package->course_type->name }}
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Course Proficiency Level</strong>
                      <p>
                        @if($course_registration->course->course_package->course_level->description)
                          <u>{{ $course_registration->course->course_package->course_level->name }}</u><br>
                          {{ $course_registration->course->course_package->course_level->description }}
                        @else
                          {{ $course_registration->course->course_package->course_level->name }}
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Course Title</strong>
                      <p>{{ $course_registration->course->title }}</p>
                    </div>
                  </div>
                  <div class="box box-warning">
                    <div class="box-header">
                      <h3 class="box-title">
                        <?php
                          $data = $course_registration->course->sessions->first()->schedule->instructor_schedules;
                        ?>
                        @if($data->count() == 1)
                          <b>Instructor</b>
                        @else
                          <b>Instructors</b>
                        @endif
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
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
                        <tr>
                          <th>Name</th>
                          <th style="width:25%;">Interest</th>
                          <th style="width:12%;">Picture</th>
                        </tr>
                        @foreach($data as $dt)
                          <tr>
                            <td>{{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}</td>
                            <td>
                              <?php
                                if($dt->instructor->interest) {
                                  $interest = explode(', ', $dt->instructor->interest);
                                  sort($interest);
                                } else $interest = null;
                              ?>
                              @if($interest)
                                @for($i = 0; $i < count($interest); $i = $i + 1)
                                  <span class="label label-success">{{ $interest[$i] }}</span>
                                @endfor
                              @else
                                <span class="text-muted"><i>Not Available</i></span>
                              @endif
                            </td>
                            <td>
                              @if($dt->instructor->user->image_profile != 'user.jpg')
                                <img src="{{ asset('uploads/instructor/'.$dt->instructor->user->image_profile) }}" style="width:100%">
                              @else
                                <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">
                        <?php
                          $data = $course_registration->course->course_registrations;
                        ?>
                        @if($data->count() == 1)
                          <b>Student</b>
                        @else
                          <b>Students</b>
                        @endif
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
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
                        <tr>
                          <th>Name</th>
                          <th style="width:25%;">Interest</th>
                          <th style="width:12%;">Picture</th>
                        </tr>
                        @foreach($data as $dt)
                          <tr>
                            <td>{{ $dt->student->user->first_name }} {{ $dt->student->user->last_name }}</td>
                            <td>
                              <?php
                                if($dt->student->interest) {
                                  $interest = explode(', ', $dt->student->interest);
                                  sort($interest);
                                } else $interest = null;
                              ?>
                              @if($interest)
                                @for($i = 0; $i < count($interest); $i = $i + 1)
                                  <span class="label label-success">{{ $interest[$i] }}</span>
                                @endfor
                              @else
                                <span class="text-muted"><i>Not Available</i></span>
                              @endif
                            </td>
                            <td>
                              @if($dt->student->user->image_profile != 'user.jpg')
                                <img src="{{ asset('uploads/student/profile/'.$dt->student->user->image_profile) }}" style="width:100%">
                              @else
                                <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                              @endif
                            </td>
                          </tr>
                        @endforeach
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
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course_registration->course->course_package->count_session
                        --}}
                        {{ $course_registration->course->sessions->count() }}
                        @if($course_registration->course->sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt>
                          @if($course_registration->course->course_registrations->count() == 1)
                            <i class="fa fa-user-circle-o margin-r-5"></i> Note
                          @else
                            <i class="fa fa-users margin-r-5"></i> Note
                          @endif
                        </dt>
                        <dd>
                          Click "link" button to join your session!<br />
                          After each session, click on "form" button to give feedbacks per session!<br />
                          <span style="color:#ff0000;">* Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Calendar</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add Session
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Tampilkan kalender pada bagian ini.</p>
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Schedules</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course_registration->session_registrations)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Title</th>
                          <th>Time</th>
                          <th style="width:5%;">Link</th>
                        </tr>
                        @foreach($course_registration->session_registrations as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->session->title }}</td>
                            <td>
                              <?php
                                $schedule_time = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                              ?>
                              @if($schedule_time->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                Today, {{ $schedule_time->isoFormat('hh:mm A') }} {{ $schedule_time->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes')->isoFormat('[-] hh:mm A') }}
                              @else
                                {{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes')->isoFormat('[-] hh:mm A') }}
                              @endif
                            </td>
                            <td class="text-center">
                              @if($schedule_now <= $schedule_time->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes'))
                                @if($dt->session->link_zoom)
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Link</a>
                                @else
                                  <a class="btn btn-flat btn-xs btn-default disabled" href="#">Link</a>
                                @endif
                              @else
                                @if($dt->status == 'Should Submit Form')
                                  {{-- Tambahkan routing di sini untuk mengisi formulir rating setelah selesai per satu sesi. --}}
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-purple" href="{{ route('form_responses.create', [$dt->id]) }}">Form</a>
                                @else
                                  <i class="text-muted">-</i>
                                @endif
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
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
                    @if($course_registration->session_registrations)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Title</th>
                          <th style="width:20%;">Attendance</th>
                        </tr>
                        @foreach($course_registration->session_registrations as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->session->title }}</td>
                            <td>
                              @if($dt->status == 'Not Assigned')
                                <?php
                                  $schedule_time = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                ?>
                                @if(now() < $schedule_time)
                                  <label class="label bg-gray">Upcoming</label>
                                @elseif(now() < $schedule_time->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes'))
                                  <label class="label bg-yellow">Ongoing</label>
                                @else
                                  <label class="label bg-blue">Attendance Check</label>
                                @endif
                              @elseif($dt->status == 'Not Present')
                                <label class="label bg-red">Not Present</label>
                              @elseif($dt->status == 'Should Submit Form')
                                <label class="label bg-purple">Should Submit Form</label>
                              @elseif($dt->status == 'Present')
                                <label class="label bg-green">Present</label>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="materials">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course_registration->course->course_package->count_session
                        --}}
                        {{ $course_registration->course->sessions->count() }}
                        @if($course_registration->course->sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-files-o margin-r-5"></i> Note</dt>
                        <dd>
                          Click "link" button to download the materials!<br />
                          <span style="color:#ff0000;">* Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Main Materials</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course_registration->course->course_package->material_publics)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>File Name</th>
                          <th>File Type</th>
                          <th style="width:5%;">Link</th>
                        </tr>
                        @foreach($course_registration->course->course_package->material_publics as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>
                              @if($dt->path)
                                {{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }}
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            </td>
                            <td class="text-center">
                              @if($dt->path)
                                <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('home') }}">Link</a>
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </table>
                      <div class="box-header">
                        <h4>Edit Main Material Information</h4>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('id') has-error @enderror">
                                    <label for="id">Material Name</label>
                                    <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Material Name --</option>
                                      @foreach($course_registration->course->course_package->material_publics as $mp)
                                        @if(old('id') == Str::slug($mp->updated_at.$mp->name.$mp->created_at))
                                          <option selected="selected" value="{{ Str::slug($mp->updated_at.$mp->name.$mp->created_at) }}">{{ $mp->name }}</option>
                                        @else
                                          <option value="{{ Str::slug($mp->updated_at.$mp->name.$mp->created_at) }}">{{ $mp->name }}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                    @error('id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('name') has-error @enderror">
                                    <label for="name">Change Name (optional)</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name (optional)">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('path') has-error @enderror">
                                    <label for="name">Upload Material</label>
                                    <span style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</span>
                                    <input name="path" type="file" accept="image/*" class="@error('path') is-invalid @enderror form-control">
                                    @error('path')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                          </div>
                        </form>
                      </div>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                @foreach($course_registration->course->sessions as $i => $s)
                  <div class="box box-warning">
                    <div class="box-header">
                      <h3 class="box-title"><b>Supplementary Materials for #{{ $i + 1 }} - {{ $s->title }}</b></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      @if($s->material_sessions->toArray())
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:2%;" class="text-right">#</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th style="width:5%;">Link</th>
                          </tr>
                          @foreach($s->material_sessions as $j => $dt)
                            <tr>
                              <td class="text-right">{{ $j + 1 }}</td>
                              <td>{{ $dt->name }}</td>
                              <td>
                                @if($dt->path)
                                  {{ strtoupper( substr($dt->path, strrpos($dt->path, '.', 0) + 1) ) }}
                                @else
                                  <i class="text-muted">Not Available</i>
                                @endif
                              </td>
                              <td class="text-center">
                                @if($dt->path)
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('home') }}">Link</a>
                                @else
                                  <i class="text-muted">Not Available</i>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </table>
                        <div class="box-header">
                          <h4>Edit Supplementary Material Information</h4>
                        </div>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="col-md-12">
                                    <div class="form-group @error('id') has-error @enderror">
                                      <label for="id">Material Name</label>
                                      <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                        <option selected="selected" value="">-- Enter Material Name --</option>
                                        @foreach($s->material_sessions as $ms)
                                          @if(old('id') == Str::slug($ms->updated_at.$ms->name.$ms->created_at))
                                            <option selected="selected" value="{{ Str::slug($ms->updated_at.$ms->name.$ms->created_at) }}">{{ $ms->name }}</option>
                                          @else
                                            <option value="{{ Str::slug($ms->updated_at.$ms->name.$ms->created_at) }}">{{ $ms->name }}</option>
                                          @endif
                                        @endforeach
                                      </select>
                                      @error('id')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group @error('name') has-error @enderror">
                                      <label for="name">Change Name (optional)</label>
                                      <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name (optional)">
                                      @error('name')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="col-md-12">
                                    <div class="form-group @error('path') has-error @enderror">
                                      <label for="name">Upload Material</label>
                                      <span style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</span>
                                      <input name="path" type="file" accept="image/*" class="@error('path') is-invalid @enderror form-control">
                                      @error('path')
                                        <p style="color:red">{{ $message }}</p>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      @else
                        <div class="text-center">No data available.</div>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tasks">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course_registration->course->course_package->count_session
                        --}}
                        {{ $course_registration->course->sessions->count() }}
                        @if($course_registration->course->sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-download margin-r-5"></i> File Download</dt>
                        <dd>
                          Each course (not session) consists of at least one assignment, and exactly one (final) exam.<br />
                          Click "link" button to download each task given!
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-upload margin-r-5"></i> Task Submission</dt>
                        <dd>
                          After completing a task, fill out the submission form and click "submit" button!<br />
                          If you have uploaded a file, please check whether the file has been submitted successfully.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
                        <dd>
                          Please note the due time for each task.<br />
                          <span style="color:#ff0000;">* Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <?php
                  $task_submission_flag = 0;
                  $assignment_flag = 0;
                  $exam_flag = 0;
                  foreach($course_registration->course->sessions as $s) {
                    foreach($s->tasks as $dt) {
                      $task_submission_flag++;
                      if($dt->type == 'Assignment')
                        $assignment_flag++;
                      else if($dt->type == 'Exam')
                        $exam_flag++;
                      if($task_submission_flag > 1 && $assignment_flag > 1 && $exam_flag > 1)
                        break;
                    }
                    if($task_submission_flag > 1 && $assignment_flag > 1 && $exam_flag > 1)
                      break;
                  }
                ?>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Assignments</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($assignment_flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Task</th>
                          <th>Due Time</th>
                          <th style="width:5%;">Link</th>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach($course_registration->course->sessions as $s)
                          @foreach($s->tasks as $dt)
                            @if($dt->type == 'Assignment')
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#Assignment{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                    {{ $dt->title }}
                                  </a>
                                </td>
                                <td>
                                  <?php
                                    $time_due = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone);
                                  ?>
                                  @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                    Today, {{ $time_due->isoFormat('hh:mm A') }}
                                  @else
                                    {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($dt->path_1)
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->path_1 }}">Link</a>
                                  @else
                                    <i class="text-muted">Not Available</i>
                                  @endif
                                </td>
                              </tr>
                              <div class="modal fade" id="Assignment{{$dt->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                        <h3 class="profile-username text-center">Task: <b>{{ $dt->title }}</b></h3>
                                        <p class="text-muted text-center">
                                          Due time:
                                          @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                            Today, {{ $time_due->isoFormat('hh:mm A') }}
                                          @else
                                            {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                          @endif
                                        </p>
                                        <ul class="list-group list-group-unbordered">
                                          <li class="list-group-item">
                                            {{ $dt->description }}
                                          </li>
                                        </ul>
                                        <button onclick="document.getElementById('Assignment{{$dt->id}}').className = 'modal fade'; document.getElementById('Assignment{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <?php $i++; ?>
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                      <div class="box-header">
                        <h4>Submit an Assignment</h4>
                        <p class="no-padding" style="color:#ff0000;">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="type" value="Assignment">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('assignment_id') has-error @enderror">
                                    <label for="assignment_id">
                                      Assignment ID
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select name="assignment_id" type="text" class="@error('assignment_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Assignment ID --</option>
                                      <?php $i = 0; ?>
                                      @foreach($course_registration->course->sessions as $s)
                                        @foreach($s->tasks as $dt)
                                          @if($dt->type == 'Assignment')
                                            @if(old('assignment_id') == $dt->id))
                                              <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} {{ $dt->title }}</option>
                                            @else
                                              <option value="{{ $dt->id }}">#{{ $i + 1 }} {{ $dt->title }}</option>
                                            @endif
                                            <?php $i++; ?>
                                          @endif
                                        @endforeach
                                      @endforeach
                                    </select>
                                    @error('assignment_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">
                                      Subject
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <input name="title" value="{{ old('title') }}" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="Enter Subject">
                                    @error('title')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">
                                      Description
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('path_1') has-error @enderror">
                                    <label for="path_1">Upload File (any type)</label>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Up to 10 submissions are allowed for each assignment</p>
                                    <input name="path_1" type="file" accept="*" class="@error('path_1') is-invalid @enderror form-control">
                                    @error('path_1')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                          </div>
                        </form>
                      </div>
                    @else
                      <div class="text-center">
                        There is no assignments here... :(<br />
                        Kindly check periodically.
                      </div>
                    @endif
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Exam</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($exam_flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Task</th>
                          <th>Due Date</th>
                          <th style="width:5%;">Link</th>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach($course_registration->course->sessions as $s)
                          @foreach($s->tasks as $dt)
                            @if($dt->type == 'Exam')
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#Exam{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                    {{ $dt->title }}
                                  </a>
                                </td>
                                <td>
                                  <?php
                                    $time_due = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone);
                                  ?>
                                  @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                    Today, {{ $time_due->isoFormat('hh:mm A') }}
                                  @else
                                    {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($dt->path_1)
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->path_1 }}">Link</a>
                                  @else
                                    <i class="text-muted">Not Available</i>
                                  @endif
                                </td>
                              </tr>
                              <div class="modal fade" id="Exam{{$dt->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                        <h3 class="profile-username text-center">Task: <b>{{ $dt->title }}</b></h3>
                                        <p class="text-muted text-center">
                                          Due time:
                                          @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                            Today, {{ $time_due->isoFormat('hh:mm A') }}
                                          @else
                                            {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                          @endif
                                        </p>
                                        <ul class="list-group list-group-unbordered">
                                          <li class="list-group-item">
                                            {{ $dt->description }}
                                          </li>
                                        </ul>
                                        <button onclick="document.getElementById('Exam{{$dt->id}}').className = 'modal fade'; document.getElementById('Exam{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <?php $i++; ?>
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                      <div class="box-header">
                        <h4>Submit an Exam</h4>
                        <p class="no-padding" style="color:#ff0000;">* This field is required</p>
                      </div>
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="type" value="Exam">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('exam_id') has-error @enderror">
                                    <label for="exam_id">
                                      Exam ID
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select name="exam_id" type="text" class="@error('exam_id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Exam ID --</option>
                                      <?php $i = 0; ?>
                                      @foreach($course_registration->course->sessions as $s)
                                        @foreach($s->tasks as $dt)
                                          @if($dt->type == 'Exam')
                                            @if(old('exam_id') == $dt->id))
                                              <option selected="selected" value="{{ $dt->id }}">#{{ $i + 1 }} {{ $dt->title }}</option>
                                            @else
                                              <option value="{{ $dt->id }}">#{{ $i + 1 }} {{ $dt->title }}</option>
                                            @endif
                                            <?php $i++; ?>
                                          @endif
                                        @endforeach
                                      @endforeach
                                    </select>
                                    @error('exam_id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">
                                      Subject
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <input name="title" value="{{ old('title') }}" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="Enter Subject">
                                    @error('title')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">
                                      Description
                                      <span style="color:#ff0000;">*</span>
                                    </label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('path_1') has-error @enderror">
                                    <label for="path_1">Upload File (any type)</label>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Maximum file size allowed is 8 MB</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">If you need to upload more than one file, please convert the files to a ZIP file (or other similar file extensions: .rar, .7z, etc.)</p>
                                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">Up to 3 submissions are allowed for each exam</p>
                                    <input name="path_1" type="file" accept="*" class="@error('path_1') is-invalid @enderror form-control">
                                    @error('path_1')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                          </div>
                        </form>
                      </div>
                    @else
                      <div class="text-center">
                        There is no exam here... :(<br />
                        Kindly check periodically.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="grades">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course_registration->course->course_package->count_session
                        --}}
                        {{ $course_registration->course->sessions->count() }}
                        @if($course_registration->course->sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-commenting-o margin-r-5"></i> Note</dt>
                        <dd>
                          Each task submission and grading (including exam) can be found here.<br />
                          Click on each task's title to view your submission
                          @if($task_submission_flag != 1)
                            details
                          @else
                            detail
                          @endif
                          and your instructor's reply for your
                          @if($task_submission_flag != 1)
                            submissions
                          @else
                            submission
                          @endif
                          (after being checked)!<br />
                          <span style="color:#ff0000;">* Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">
                      <b>
                        @if($assignment_flag != 1)
                          Submissions
                        @else
                          Submission
                        @endif
                        for Assignments
                      </b>
                    </h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($assignment_flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th style="width:25%;">Task</th>
                          <th>Last Done on</th>
                          <th style="width:5%;">Score</th>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach($course_registration->course->sessions as $s)
                          @foreach($s->tasks as $dt)
                            @if($dt->type == 'Assignment')
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#AssignmentGrading{{$dt->id}}">
                                    {{ $dt->title }}
                                  </a>
                                </td>
                                <td>
                                  @if($dt->task_submissions->last())
                                    <?php
                                      $last_submitted_at = \Carbon\Carbon::parse($dt->task_submissions->last()->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                    ?>
                                    {{ $last_submitted_at->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  @else
                                    <i class="text-muted">Not Available</i>
                                  @endif
                                </td>
                                <td class="text-right">
                                  @if($dt->task_submissions->last() && $dt->task_submissions->last()->score)
                                    {{ $dt->task_submissions->last()->score }}
                                  @else
                                    <i class="text-muted">-</i>
                                  @endif
                                </td>
                              </tr>
                              <div class="modal fade" id="AssignmentGrading{{$dt->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                        <h3 class="profile-username text-center">Submission for: <b>{{ $dt->title }}</b></h3>
                                        <p class="text-muted text-center">Type: <b>Assignment</b></p>
                                        <ul class="list-group list-group-unbordered">
                                          <?php $j = 0; $flag = 0; ?>
                                          @foreach($course_registration->session_registrations as $sr)
                                            @foreach($sr->task_submissions as $ts)
                                              @if($ts->task_id == $dt->id)
                                                <?php $flag = 1; ?>
                                                <li class="list-group-item">
                                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $ts->path_1 }}">Download</a>
                                                    <br />
                                                  <b>Submission #{{ $j + 1 }}</b> (
                                                    <?php
                                                      $submission_time = \Carbon\Carbon::parse($ts->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                                    ?>
                                                    {{ $submission_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                                    )<br />
                                                  <b>Title:</b> {{ $ts->title }}<br />
                                                  <b>Description:</b>
                                                    {{ $ts->description }}<br />
                                                  <b>Submission status:</b>
                                                    @if($ts->status == 'Accepted')
                                                      <b style="color:#007700;">Checked</b><br />
                                                    @else
                                                      <i class="text-muted">Not Available</i><br />
                                                    @endif
                                                  @if($ts->status == 'Accepted')
                                                    <b>Score:</b>
                                                      {{ $ts->score }}<br />
                                                    <b>Instructor reply:</b><br />
                                                      {{ $ts->instructor_reply }}<br />
                                                  @endif
                                                </li>
                                                <?php $j++; ?>
                                              @endif
                                            @endforeach
                                          @endforeach
                                          @if($flag == 0)
                                            <div class="text-muted">You haven't submitted your working for this assignment.</div>
                                          @endif
                                        </ul>
                                        <button onclick="document.getElementById('AssignmentGrading{{$dt->id}}').className = 'modal fade'; document.getElementById('AssignmentGrading{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <?php $i++; ?>
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">
                      <b>
                        @if($exam_flag != 1)
                          Submissions
                        @else
                          Submission
                        @endif
                        for Exam
                      </b>
                    </h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($exam_flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th style="width:25%;">Task</th>
                          <th>Last Done on</th>
                          <th style="width:5%;">Score</th>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach($course_registration->course->sessions as $s)
                          @foreach($s->tasks as $dt)
                            @if($dt->type == 'Exam')
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#ExamGrading{{$dt->id}}">
                                    {{ $dt->title }}
                                  </a>
                                </td>
                                <td>
                                  <?php
                                    $time_due = \Carbon\Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone);
                                  ?>
                                  @if($time_due->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                    Today, {{ $time_due->isoFormat('hh:mm A') }}
                                  @else
                                    {{ $time_due->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                  @endif
                                </td>
                                <td class="text-right">
                                  @if($dt->task_submissions->last() && $dt->task_submissions->last()->score)
                                    {{ $dt->task_submissions->last()->score }}
                                  @else
                                    <i class="text-muted">-</i>
                                  @endif
                                </td>
                              </tr>
                              <div class="modal fade" id="ExamGrading{{$dt->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                        <h3 class="profile-username text-center">Submission for: <b>{{ $dt->title }}</b></h3>
                                        <p class="text-muted text-center">Type: <b>Exam</b></p>
                                        <ul class="list-group list-group-unbordered">
                                          <?php $j = 0; $flag = 0; ?>
                                          @foreach($course_registration->session_registrations as $sr)
                                            @foreach($sr->task_submissions as $ts)
                                              @if($ts->task_id == $dt->id)
                                                <?php $flag = 1; ?>
                                                <li class="list-group-item">
                                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $ts->path_1 }}">Download</a>
                                                    <br />
                                                  <b>Submission #{{ $j + 1 }}</b> (
                                                    <?php
                                                      $submission_time = \Carbon\Carbon::parse($ts->path_1_submitted_at)->setTimezone(Auth::user()->timezone);
                                                    ?>
                                                    {{ $submission_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                                    )<br />
                                                  <b>Title:</b> {{ $ts->title }}<br />
                                                  <b>Description:</b>
                                                    {{ $ts->description }}<br />
                                                  <b>Submission status:</b>
                                                    @if($ts->status == 'Accepted')
                                                      <b style="color:#007700;">Checked</b><br />
                                                    @else
                                                      <i class="text-muted">Not Available</i><br />
                                                    @endif
                                                  @if($ts->status == 'Accepted')
                                                    <b>Score:</b>
                                                      {{ $ts->score }}<br />
                                                    <b>Instructor reply:</b><br />
                                                      {{ $ts->instructor_reply }}<br />
                                                  @endif
                                                </li>
                                                <?php $j++; ?>
                                              @endif
                                            @endforeach
                                          @endforeach
                                          @if($flag == 0)
                                            <div class="text-muted">You haven't submitted your working for this exam.</div>
                                          @endif
                                        </ul>
                                        <button onclick="document.getElementById('ExamGrading{{$dt->id}}').className = 'modal fade'; document.getElementById('ExamGrading{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <?php $i++; ?>
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="certificate">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                    <p class="no-margin">
                      Includes
                      <b>
                        {{--
                          dapat juga menggunakan variabel
                          $course_registration->course->course_package->count_session
                        --}}
                        {{ $course_registration->course->sessions->count() }}
                        @if($course_registration->course->sessions->count() != 1)
                          sessions
                        @else
                          session
                        @endif
                      </b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-check margin-r-5"></i> Requirements</dt>
                        <dd>
                          After finishing the session, we will evaluate your attendances {{-- and gradings --}}for this course.<br />
                          A minimum of <b>80% attendances (of all sessions)</b> is required to get the course certificate.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-file-pdf-o margin-r-5"></i> Certificate Download</dt>
                        <dd>
                          If you are eligible, click "link" button to download your course certificate!
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
                        <dd>
                          Please consider attending all sessions so you may adapt with the materials given.<br />
                          On completing this course, you may choose another course for learning.<br />
                          <span style="color:#ff0000;">* Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Certificate Download</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($assignment_flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:2%;" class="text-right">#</th>
                          <th>Total Attendances</th>
                          <th style="width:5%;">Link</th>
                        </tr>
                        <?php
                          $i = 0;
                          foreach($course_registration->session_registrations as $dt) {
                            if($dt->status == 'Present' || $dt->status == 'Should Submit Form') {
                              $i++;
                            }
                          }
                          $total_sessions = $course_registration->course->course_package->count_session;
                        ?>
                        <tr>
                          <td class="text-right">1</td>
                          <td>
                            {{ $i }}/{{ $total_sessions }}
                          </td>
                          <td class="text-center">
                            @if($i >= 80 * $total_sessions / 100)
                              @if($course_registration->course_certificate->path)
                                <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $course_registration->course_certificate->path }}">Link</a>
                              @else
                                <i class="text-muted">N/A</i>
                              @endif
                            @else
                              <a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Ineligible</a>
                            @endif
                          </td>
                        </tr>
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
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
