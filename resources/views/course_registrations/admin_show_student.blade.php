@extends('layouts.admin.default')

@section('title', 'Admin | Show | Student')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>User Course Registration</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('users.index') }}">User</a></li>
    <li><a href="{{ route('users.show', [Str::slug($course_registration->student->user->password.$course_registration->student->user->first_name.'-'.$course_registration->student->user->last_name)]) }}">Detail</a></li>
    <li class="active">Course Registration</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#course_information" data-toggle="tab"><b>Registration Information</b></a></li>
          <li><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
          <li><a href="#instructor_information" data-toggle="tab"><b>Instructor Information</b></a></li>
          <li><a href="#registered_students" data-toggle="tab"><b>All Registered Students</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-default">
                  <div class="box-body box-profile">
                    @if($course_registration->student->user->image_profile != 'user.jpg')
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.$course_registration->student->user->image_profile) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.$course_registration->student->user->image_profile) }}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ $course_registration->student->user->first_name }} {{ $course_registration->student->user->last_name }}</h3>
                    <p class="text-muted text-center">Role: {{ $course_registration->student->user->roles }}</p>
                  </div>
                  <!-- /.box-body -->
                  <!-- About Me Box -->
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Registration Time</strong>
                    <p>
                      <?php
                        $schedule_time = \Carbon\Carbon::parse($course_registration->created_at)->setTimezone(Auth::user()->timezone);
                      ?>
                      <table>
                        <tr>
                          <td><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>{{ $schedule_time->isoFormat('dddd') }}</td>
                        </tr>
                        <tr>
                          <td><b>Date</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>{{ $schedule_time->isoFormat('MMMM Do YYYY, hh:mm A') }}</td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Nationality</strong>
                    <p>Data</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Where do you live now</strong>
                    @if($course_registration->student->user->domicile)
                      <p>{{ $course_registration->student->user->domicile }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-3">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>
                      @if($course_registration->course->course_registrations->toArray())
                        {{ $course_registration->course->course_registrations->count() }}
                      @else
                        0
                      @endif
                    </h3>
                    <p>
                      @if($course_registration->student->course_registrations->count() != 1)
                        Registered Students
                      @else
                        Registered Student
                      @endif
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- /.col FOR WIDGET 1 -->
              <div class="col-md-3">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>
                      result
                    </h3>
                    <p>
                      caption
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check-circle-o"></i>
                  </div>
                  <a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- /.col FOR WIDGET 2 -->
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Overview</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New User
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Email</strong>
                    <p>Data</p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Nationality</strong>
                    <p>Data</p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Where do you live now</strong>
                    @if($course_registration->student->user->domicile)
                      <p>{{ $course_registration->student->user->domicile }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <h3 class="box-title"><b>Table Data</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New "Something"
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      <table class="table table-bordered">
                        <tr>
                          <th>Role</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        <tr>
                          <td>{{ $course_registration->student->user->roles }}</td>
                          <td>{{ $course_registration->student->user->first_name }} {{ $course_registration->student->user->last_name }}</td>
                          <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="course_information">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Course Information</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    Form Data (?)
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
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
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
                        Add New Session
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Tampilkan kalender pada bagian ini.</p>
                    <hr>
                    <h3 class="box-title"><b>List of Sessions</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New Session
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      @if($course_registration->course->sessions->toArray())
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:40px;" class="text-right">#</th>
                            <th>Title</th>
                            <th>Meeting Link</th>
                            <th style="width:40px;">Detail</th>
                          </tr>
                          @foreach($course_registration->course->sessions as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->title }}</td>
                              <td>{{ $dt->link_zoom }}</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-green" href="{{ route('home') }}">Link</a></td>
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
