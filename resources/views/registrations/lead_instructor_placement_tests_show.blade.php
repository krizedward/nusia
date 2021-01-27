@extends('layouts.admin.default')

@section('title', 'Placement Tests | Detail')

{{-- @include('layouts.css_and_js.table') --}}

@include('layouts.css_and_js.form_advanced')

@section('content-header')
  <h1><b>Placement Tests Detail</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('placement_tests.index') }}">Placement Tests</a></li>
    <li class="active">Detail</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#placement_test" data-toggle="tab"><b>Placement Test</b></a></li>
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
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($schedule_time)
                              {{ $schedule_time->isoFormat('dddd') }}
                            @else
                              <i class="text-muted">Not Available</i>
                            @endif
                          </td>
                        </tr>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Date</b></td>
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
                        <tr style="vertical-align:baseline;">
                          <td width="50"><b>Price</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>${{ $course_registration->course->course_package->price }}</td>
                        </tr>
                        <tr style="vertical-align:baseline;">
                          <td width="50"><b>Status</b></td>
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
                        <tr style="vertical-align:baseline;">
                          <td width="50"><b>Paid at</b></td>
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
                        <tr style="vertical-align:baseline;">
                          <td width="75"><b>Link</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
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
                        <tr style="vertical-align:baseline;">
                          <td width="75"><b>Result</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
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
                        <tr style="vertical-align:baseline;">
                          <td width="75"><b>Final Level</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
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
                        <tr style="vertical-align:baseline;">
                          <td width="75"><b>Updated at</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
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
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="placement_test">
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
                            <i class="fa fa-user-circle-o margin-r-5"></i> Joining Sessions
                          @else
                            <i class="fa fa-users margin-r-5"></i> Joining Sessions
                          @endif
                        </dt>
                        <dd>
                          Click "link" button to join your sessions!
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt>
                          <i class="fa fa-edit margin-r-5"></i> Giving Feedbacks
                        </dt>
                        <dd>
                          After each session, click on "form" button to give feedbacks per session!<br />
                          Please consider that three days after each session ends, the "form" button will eventually disappear.
                        </dd>
                      </dl>
                      <hr>
                      <dl>
                        <dt>
                          <i class="fa fa-file-text-o margin-r-5"></i> More Information
                        </dt>
                        <dd>
                          You are <b>required</b> to give feedbacks (for each session) in order to complete your attendance information.<br />
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
                        <?php
                          $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                        ?>
                        @foreach($course_registration->session_registrations as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>
                              <a href="#" data-toggle="modal" data-target="#Session{{$dt->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                {{ $dt->session->title }}
                              </a>
                            </td>
                            <td>
                              <?php
                                $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_end_form = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                $schedule_time_end_form->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes')->add(3, 'days');
                              ?>
                              @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                Today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                              @else
                                {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                              @endif
                            </td>
                            <td class="text-center">
                              @if($schedule_now <= $schedule_time_end)
                                @if($dt->session->link_zoom)
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Link</a>
                                @else
                                  <a class="btn btn-flat btn-xs btn-default disabled" href="#">Link</a>
                                @endif
                              @else
                                @if($dt->status == 'Should Submit Form' && $schedule_now <= $schedule_time_end_form)
                                  {{-- Tambahkan routing di sini untuk mengisi formulir rating setelah selesai per satu sesi. --}}
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-purple" href="{{ route('form_responses.create', [$dt->id]) }}">Form</a>
                                @else
                                  <i class="text-muted">-</i>
                                @endif
                              @endif
                            </td>
                          </tr>
                          <div class="modal fade" id="Session{{$dt->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="box box-primary">
                                  <div class="box-body box-profile">
                                    <h3 class="profile-username text-center"><b>{{ $dt->session->title }}</b></h3>
                                    <p class="text-muted text-center">
                                      Scheduled
                                      @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                        today, {{ $schedule_time_begin->isoFormat('hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                      @else
                                        on {{ $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time_end->isoFormat('[-] hh:mm A') }}
                                      @endif
                                    </p>
                                    <ul class="list-group list-group-unbordered">
                                      <li class="list-group-item">
                                        {{ $dt->session->description }}
                                      </li>
                                    </ul>
                                    <button onclick="document.getElementById('Session{{$dt->id}}').className = 'modal fade'; document.getElementById('Session{{$dt->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open');" class="btn btn-s btn-primary" style="width:100%;">Close</button>
                                  </div>
                                  <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
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
                                  $schedule_time_begin = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end->add($dt->session->course->course_package->material_type->duration_in_minute, 'minutes');
                                ?>
                                @if(now() < $schedule_time_begin)
                                  <label class="label bg-gray">Upcoming</label>
                                @elseif(now() < $schedule_time_end)
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
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
