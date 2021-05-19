@extends('layouts.admin.default')

@section('title', 'Placement Tests | Detail')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Placement Test Detail</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li><a href="{{ route('lead_instructor.student_registration.index') }}">Placement Tests</a></li>
    <li class="active">Detail</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#decision_form" data-toggle="tab"><b>Decision Form</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>{{ $course_registration->course->course_package->material_type->name }}</b></h3>
                    <p class="no-margin">
                      {{ $course_registration->course->course_package->course_type->name }}<br />
                      Proficiency: <b>{{ $course_registration->student->indonesian_language_proficiency }}</b>
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
                              <i class="text-muted">N/A</i>
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
                              <i class="text-muted">N/A</i>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-video-o margin-r-5"></i> Placement Test Submission</strong>
                    <p>
                      <?php
                        if($course_registration->placement_test->submitted_at != null)
                          $submitted_at = \Carbon\Carbon::parse($course_registration->placement_test->submitted_at)->setTimezone(Auth::user()->timezone);
                        else
                          $submitted_at = null;
                      ?>
                      <table>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($submitted_at)
                              {{ $submitted_at->isoFormat('dddd') }}
                            @else
                              <i class="text-muted">N/A</i>
                            @endif
                          </td>
                        </tr>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Date</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($submitted_at)
                              {{ $submitted_at->isoFormat('MMMM Do YYYY, hh:mm A') }}
                            @else
                              <i class="text-muted">N/A</i>
                            @endif
                          </td>
                        </tr>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Link</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->placement_test->path)
                              <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $course_registration->placement_test->path }}">Link</a>
                            @else
                              <i class="text-muted">N/A</i>
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
                      <h3 class="box-title"><b>Student Registration</b></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-label="Minimize"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <strong><i class="fa fa-book margin-r-5"></i>&nbsp; Chosen Material Type</strong>
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
                      <strong><i class="fa fa-pencil margin-r-5"></i>&nbsp; Student Name</strong>
                      <p>{{ $course_registration->student->user->first_name }} {{ $course_registration->student->user->last_name }}</p>
                      <hr>
                      <strong><i class="fa fa-user-circle-o margin-r-5"></i> Age</strong>
                      <p>
                        @if($course_registration->student->age != 0)
                          {{ $course_registration->student->age }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong>&nbsp;<i class="fa fa-map-marker margin-r-5"></i>&nbsp; Nationality</strong>
                      <p>
                        @if($course_registration->student->user->citizenship != 'Not Available')
                          {{ $course_registration->student->user->citizenship }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong>&nbsp;<i class="fa fa-map-marker margin-r-5"></i>&nbsp; Where do you live now</strong>
                      <p>
                        @if($course_registration->student->user->domicile)
                          {{ $course_registration->student->user->domicile }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-cube margin-r-5"></i>&nbsp;Interest</strong>
                      <p>
                        @if($course_registration->student->interest)
                          <?php $interest = explode(', ', $course_registration->student->interest); ?>
                          @for($i = 0; $i < count($interest); $i = $i + 1)
                            <span class="label label-success">{{ $interest[$i] }}</span>
                            {{--
                            {{ $i + 1 }}. {{ $interest[$i] }}
                            @if($i + 1 != count($interest))
                              <br>
                            @endif
                            --}}
                          @endfor
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong>
                        @if($course_registration->student->status_job == 'Student')
                          <i class="fa fa-graduation-cap"></i>&nbsp;Job Status
                        @elseif($course_registration->student->status_job == 'Professional')
                          <i class="fa fa-briefcase"></i>&nbsp;&nbsp;Job Status
                        @endif
                      </strong>
                      <p>
                        @if($course_registration->student->status_description)
                          {{ $course_registration->student->status_job }} at {{ $course_registration->student->status_description }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-trophy margin-r-5"></i>&nbsp;Indonesia Language Proficiency</strong>
                      <p>
                        @if($course_registration->student->age != 0)
                          {{ $course_registration->student->indonesian_language_proficiency }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-history margin-r-5"></i>&nbsp;Target Language Experience</strong>
                      <p>
                        @if($course_registration->student->age != 0)
                          @if($course_registration->student->target_language_experience != 'Others')
                            {{ $course_registration->student->target_language_experience }}
                          @else
                            {{ $course_registration->student->target_language_experience_value }}
                            @if($course_registration->student->target_language_experience_value == 1)
                              year
                            @else
                              years
                            @endif
                          @endif
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-pencil-square-o margin-r-5"></i> Description of Course Taken</strong>
                      <p>
                        @if($course_registration->student->description_of_course_taken)
                          {{ $course_registration->student->description_of_course_taken }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                      <hr>
                      <strong><i class="fa fa-language margin-r-5"></i>&nbsp;&nbsp;Learning Objective</strong>
                      <p>
                        @if($course_registration->student->learning_objective)
                          {{ $course_registration->student->learning_objective }}
                        @else
                          <i>N/A</i>
                        @endif
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="decision_form">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>{{ $course_registration->course->course_package->material_type->name }}</b></h3>
                    <p class="no-margin">
                      {{ $course_registration->course->course_package->course_type->name }}<br />
                      Proficiency: <b>{{ $course_registration->student->indonesian_language_proficiency }}</b>
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
                              <i class="text-muted">N/A</i>
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
                              <i class="text-muted">N/A</i>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-video-o margin-r-5"></i> Placement Test Submission</strong>
                    <p>
                      <?php
                        if($course_registration->placement_test->submitted_at != null)
                          $submitted_at = \Carbon\Carbon::parse($course_registration->placement_test->submitted_at)->setTimezone(Auth::user()->timezone);
                        else
                          $submitted_at = null;
                      ?>
                      <table>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($submitted_at)
                              {{ $submitted_at->isoFormat('dddd') }}
                            @else
                              <i class="text-muted">N/A</i>
                            @endif
                          </td>
                        </tr>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Date</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($submitted_at)
                              {{ $submitted_at->isoFormat('MMMM Do YYYY, hh:mm A') }}
                            @else
                              <i class="text-muted">N/A</i>
                            @endif
                          </td>
                        </tr>
                        <tr style="vertical-align:baseline;">
                          <td width="35"><b>Link</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->placement_test->path)
                              <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $course_registration->placement_test->path }}">Link</a>
                            @else
                              <i class="text-muted">N/A</i>
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
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Decide</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-label="Minimize"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" method="post" action="{{ route('lead_instructor.confirmation_by_video.update', [$course_registration->id]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      {{ session(['crid' => $course_registration->id]) }}
                      <input type="hidden" id="crid" name="crid" value="{{ $course_registration->id }}">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <div class="form-group @error('status') has-error @enderror">
                                <label for="status">Test Result</label>
                                <select id="status" name="status" type="text" class="@error('status') is-invalid @enderror form-control" onChange="if(document.getElementById('status').value == 'Passed') {document.getElementById('old_proficiency_div').className = 'form-group'; document.getElementById('indonesian_language_proficiency_div').className = 'form-group'; document.getElementById('schedule_time_div').className = 'form-group hidden';} else if(document.getElementById('status').value == 'Not Passed') {document.getElementById('old_proficiency_div').className = 'form-group hidden'; document.getElementById('indonesian_language_proficiency_div').className = 'form-group hidden'; document.getElementById('schedule_time_div').className = 'form-group';} else {document.getElementById('old_proficiency_div').className = 'form-group hidden'; document.getElementById('indonesian_language_proficiency_div').className = 'form-group hidden'; document.getElementById('schedule_time_div').className = 'form-group hidden';}">
                                  <option selected="selected" value="">-- Enter Test Result --</option>
                                  <option value="Passed">PASSED (Assign Proficiency Level)</option>
                                  <option value="Not Passed">NOT PASSED (Schedule an Interview)</option>
                                </select>
                                @error('status')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div id="old_proficiency_div" class="form-group hidden @error('old_proficiency') has-error @enderror">
                                <label for="old_proficiency">Old Proficiency Level (Student self-assessment)</label>
                                <input id="old_proficiency" name="old_proficiency" type="text" class="@error('old_proficiency') is-invalid @enderror form-control" disabled value="{{ $course_registration->student->indonesian_language_proficiency }}">
                                @error('old_proficiency')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div id="indonesian_language_proficiency_div" class="form-group hidden @error('indonesian_language_proficiency') has-error @enderror">
                                <label for="indonesian_language_proficiency">New Proficiency Level</label>
                                <select id="indonesian_language_proficiency" name="indonesian_language_proficiency" type="text" class="@error('indonesian_language_proficiency') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter New Proficiency Level --</option>
                                  @foreach($course_levels as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                                  @endforeach
                                </select>
                                @error('indonesian_language_proficiency')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <div id="schedule_time_div" class="form-group hidden @error('schedule_time_date') has-error @enderror @error('schedule_time_time') has-error @enderror">
                                <label for="schedule_time_date">Set Interview Schedule</label>
                                <p class="text-red">The time schedule inputted is adjusted with your local time.</p>
                                <div class="input-group date">
                                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                  <input name="schedule_time_date" type="text" class="form-control pull-right datepicker">
                                </div>
                                <label for="schedule_time_time" class="hidden">Schedule (set the time)</label><br />
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                  <input name="schedule_time_time" type="text" class="form-control pull-right timepicker">
                                </div>
                                @error('schedule_time_date')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @error('schedule_time_time')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;" onclick="if(document.getElementById('video_link').value == '') { alert('The video link cannot be empty.'); return false; } if( confirm('Are you sure to submit this link: ' + document.getElementById('video_link').value + '?') ) return true; else return false;">
                          Submit
                        </button>
                      </div>
                    </form>
                  </div>
                  <!-- /.box-body -->
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
