@extends('layouts.admin.default')

@section('title', 'Admin | Show | Lead Instructor')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>User Detail</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('users.index') }}">User</a></li>
    <li class="active">Detail</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#edit_profile" data-toggle="tab"><b>Edit Profile</b></a></li>
          <li><a href="#courses" data-toggle="tab"><b>Courses</b></a></li>
          <li><a href="#upcoming_sessions" data-toggle="tab"><b>Upcoming Sessions</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-default">
                  <div class="box-body box-profile">
                    @if($user->image_profile != 'user.jpg')
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/instructor/'.$user->image_profile) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.$user->image_profile) }}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p class="text-muted text-center">Role: {{ $user->roles }}</p>
                  </div>
                  <!-- /.box-body -->
                  <!-- About Me Box -->
                  <div class="box-header with-border">
                    <h3 class="box-title">User Information</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p>{{ $user->email }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Nationality</strong>
                    <p>{{ $user->citizenship }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Where do you live now</strong>
                    @if($user->domicile)
                      <p>{{ $user->domicile }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Current local time zone</strong>
                    @if($user->timezone)
                      <p>{{ $user->timezone }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Current website language</strong>
                    @if($user->website_language)
                      <p>{{ $user->website_language }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-9 no-padding">
                <div class="col-md-4">
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>
                        {{ $courses->count() }}
                      </h3>
                      <p>
                        @if($courses->count() != 1)
                          Registered
                          <br>Courses
                        @else
                          Registered
                          <br>Course
                        @endif
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <!--a href="#?" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a-->
                  </div>
                </div>
                <!-- /.col FOR WIDGET 1 -->
                <div class="col-md-4">
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>
                        <?php
                          $arr_student = [];
                          foreach($user->instructor->schedules as $schedule)
                            foreach($schedule->session->session_registrations as $session_registration)
                              if($session_registration->status == 'Present')
                                if(!in_array($session_registration->course_registration->student_id, $arr_student))
                                  array_push($arr_student, $session_registration->course_registration->student_id);
                        ?>
                        {{ count($arr_student) }}
                      </h3>
                      <p>
                        @if(count($arr_student) != 1)
                          Present
                          <br>Students
                        @else
                          Present
                          <br>Student
                        @endif
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-check-square-o"></i>
                    </div>
                    <!--a href="#?" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a-->
                  </div>
                </div>
                <!-- /.col FOR WIDGET 2 -->
                <div class="col-md-4">
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>
                        <?php
                          $arr_schedule = [];
                          foreach($user->instructor->schedules as $schedule)
                            if(now() < $schedule->schedule_time)
                              if($schedule->status == 'Busy')
                                if(!in_array($schedule->id, $arr_schedule))
                                  array_push($arr_schedule, $schedule->id);
                        ?>
                        {{ count($arr_schedule) }}
                      </h3>
                      <p>
                        @if(count($arr_schedule) != 1)
                          Upcoming
                          <br>Schedules
                        @else
                          Upcoming
                          <br>Schedule
                        @endif
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <!--a href="#?" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a-->
                  </div>
                </div>
                <!-- /.col FOR WIDGET 3 -->
                <div class="col-md-12">
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
                      <p>{{ $user->email }}</p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Nationality</strong>
                      <p>{{ $user->citizenship }}</p>
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Where do you live now</strong>
                      @if($user->domicile)
                        <p>{{ $user->domicile }}</p>
                      @else
                        <p class="text-muted"><i>Not Available</i></p>
                      @endif
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Current local time zone</strong>
                      @if($user->timezone)
                        <p>{{ $user->timezone }}</p>
                      @else
                        <p class="text-muted"><i>Not Available</i></p>
                      @endif
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Current website language</strong>
                      @if($user->website_language)
                        <p>{{ $user->website_language }}</p>
                      @else
                        <p class="text-muted"><i>Not Available</i></p>
                      @endif
                      <hr>
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Interest</strong>
                      @if($user->instructor->interest)
                        <?php
                          $interest = explode(', ', $user->instructor->interest);
                          sort($interest);
                        ?>
                        <p>
                          @for($i = 0; $i < count($interest); $i = $i + 1)
                            <span class="label label-success">{{ $interest[$i] }}</span>
                          @endfor
                        </p>
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
                            <td>{{ $user->roles }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($user->password.$user->first_name.'-'.$user->last_name)]) }}">Link</a></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="edit_profile">
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
                    <h3 class="box-title"><b>Edit Profile</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email</label>
                                <input name="email" value="{{ $user->email }}" type="email" class="@error('email') is-invalid @enderror form-control" placeholder="Email">
                                @error('email')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('first_name') has-error @enderror">
                                <label for="first_name">First Name</label>
                                <input name="first_name" value="{{ $user->first_name }}" type="text" class="@error('first_name') is-invalid @enderror form-control" placeholder="First Name">
                                @error('first_name')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('last_name') has-error @enderror">
                                <label for="last_name">Last Name</label>
                                <input name="last_name" value="{{ $user->last_name }}" type="text" class="@error('last_name') is-invalid @enderror form-control" placeholder="Last Name">
                                @error('last_name')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('old_password') has-error @enderror">
                                <label for="old_password">Old Password</label>
                                <input name="old_password" type="password" class="@error('old_password') is-invalid @enderror form-control" placeholder="Old Password">
                                @error('old_password')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @if(session('error_old_password'))
                                  <p style="color:red">{{ session('error_old_password') }}</p>
                                  <?php session(['error_old_password' => null]); ?>
                                @endif
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('password') has-error @enderror">
                                <label for="password">New Password</label>
                                <input name="password" type="password" class="@error('password') is-invalid @enderror form-control" placeholder="New Password">
                                @error('password')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @if(session('error_password'))
                                  <p style="color:red">{{ session('error_password') }}</p>
                                  <?php session(['error_password' => null]); ?>
                                @endif
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('password_confirm') has-error @enderror">
                                <label for="password_confirm">Confirm New Password</label>
                                <input name="password_confirm" type="password" class="@error('password_confirm') is-invalid @enderror form-control" placeholder="New Password">
                                @error('password_confirm')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @if(session('error_password_confirm'))
                                  <p style="color:red">{{ session('error_password_confirm') }}</p>
                                  <?php session(['error_password_confirm' => null]); ?>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('citizenship') has-error @enderror">
                                <label for="citizenship">Nationality</label>
                                @if($user->citizenship)
                                  <input name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Nationality" value="{{ $user->citizenship }}">
                                @else
                                  <input name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Nationality" value="{{ old('citizenship') }}">
                                @endif
                                @error('citizenship')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('domicile') has-error @enderror">
                                <label for="domicile">Where do you live now?</label>
                                @if($user->domicile)
                                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Domicile" value="{{ $user->domicile }}">
                                @else
                                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Domicile" value="{{ old('domicile') }}">
                                @endif
                                @error('domicile')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('timezone') has-error @enderror">
                                <label for="timezone">What is your local time zone?</label>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*This information is needed to adjust Indonesian time<br>to your local time for scheduling your sessions</p>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Reference: <b><a target="_blank" rel="noopener noreferrer" href="https://www.timeanddate.com/">timeanddate.com</a></b></p>
                                <select name="timezone" type="text" class="@error('timezone') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Current Time Zone --</option>
                                  @foreach($timezones as $timezone)
                                    @if(old('timezone') == $timezone)
                                      <option selected="selected" value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                                    @else
                                      <option value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('timezone')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            &nbsp;
                          </div>
                          <div class="col-md-6">
                            Another question(s) here.
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('interest_1') has-error @enderror" id="interest_1">
                                <label for="interest_1">Interest (Max. 6)</label>
                                <select name="interest_1" type="text" class="@error('interest_1') is-invalid @enderror form-control" id="interest_1_input" onChange="if(document.getElementById('interest_1_input').value != '') {document.getElementById('interest_2').className = 'form-group';} else {document.getElementById('interest_2').className = 'form-group hidden'; document.getElementById('interest_3').className = 'form-group hidden'; document.getElementById('interest_4').className = 'form-group hidden'; document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_2_input').value = ''; document.getElementById('interest_3_input').value = ''; document.getElementById('interest_4_input').value = ''; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
                                  <option selected="selected" value="">-- Interest 1 --</option>
                                  @foreach($interests as $interest)
                                    <option value="{{ $interest }}">{{ $interest }}</option>
                                  @endforeach
                                </select>
                                @error('interest_1')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group hidden @error('interest_2') has-error @enderror" id="interest_2">
                                <select name="interest_2" type="text" class="@error('interest_2') is-invalid @enderror form-control" id="interest_2_input" onChange="if(document.getElementById('interest_2_input').value != '') {document.getElementById('interest_3').className = 'form-group';} else {document.getElementById('interest_3').className = 'form-group hidden'; document.getElementById('interest_4').className = 'form-group hidden'; document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_3_input').value = ''; document.getElementById('interest_4_input').value = ''; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
                                  <option selected="selected" value="">-- Interest 2 --</option>
                                  @foreach($interests as $interest)
                                    <option value="{{ $interest }}">{{ $interest }}</option>
                                  @endforeach
                                </select>
                                @error('interest_2')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group hidden @error('interest_3') has-error @enderror" id="interest_3">
                                <select name="interest_3" type="text" class="@error('interest_3') is-invalid @enderror form-control" id="interest_3_input" onChange="if(document.getElementById('interest_3_input').value != '') {document.getElementById('interest_4').className = 'form-group';} else {document.getElementById('interest_4').className = 'form-group hidden'; document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_4_input').value = ''; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
                                  <option selected="selected" value="">-- Interest 3 --</option>
                                  @foreach($interests as $interest)
                                    <option value="{{ $interest }}">{{ $interest }}</option>
                                  @endforeach
                                </select>
                                @error('interest_3')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group hidden @error('interest_4') has-error @enderror" id="interest_4">
                                <select name="interest_4" type="text" class="@error('interest_4') is-invalid @enderror form-control" id="interest_4_input" onChange="if(document.getElementById('interest_4_input').value != '') {document.getElementById('interest_5').className = 'form-group';} else {document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
                                  <option selected="selected" value="">-- Interest 4 --</option>
                                  @foreach($interests as $interest)
                                    <option value="{{ $interest }}">{{ $interest }}</option>
                                  @endforeach
                                </select>
                                @error('interest_4')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group hidden @error('interest_5') has-error @enderror" id="interest_5">
                                <select name="interest_5" type="text" class="@error('interest_5') is-invalid @enderror form-control" id="interest_5_input" onChange="if(document.getElementById('interest_5_input').value != '') {document.getElementById('interest_6').className = 'form-group';} else {document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_6_input').value = '';}">
                                  <option selected="selected" value="">-- Interest 5 --</option>
                                  @foreach($interests as $interest)
                                    <option value="{{ $interest }}">{{ $interest }}</option>
                                  @endforeach
                                </select>
                                @error('interest_5')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group hidden @error('interest_6') has-error @enderror" id="interest_6">
                                <select name="interest_6" type="text" class="@error('interest_6') is-invalid @enderror form-control" id="interest_6_input">
                                  <option selected="selected" value="">-- Interest 6 --</option>
                                  @foreach($interests as $interest)
                                    <option value="{{ $interest }}">{{ $interest }}</option>
                                  @endforeach
                                </select>
                                @error('interest_6')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <div class="form-group @error('image_profile') has-error @enderror">
                                <label for="image_profile">Upload Profile Picture</label>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                                <input name="image_profile" type="file" accept="image/*" class="@error('image_profile') is-invalid @enderror form-control">
                                @error('image_profile')
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
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="courses">
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
                    <h3 class="box-title"><b>All Courses</b></h3>
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
                    <p>Tampilkan tabel daftar course(s) pada bagian ini.</p>
                    <hr>
                    <h3 class="box-title"><b>List of Registered Course(s)</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New Course Registration
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      @if($courses->toArray())
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:40px;" class="text-right">#</th>
                            <th>Proficiency Level</th>
                            <th>Course</th>
                            <th style="width:40px;">Detail</th>
                          </tr>
                          @foreach($courses as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->course_package->course_level->name }}</td>
                              <td>{{ $dt->title }}</td>
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
          <div class="tab-pane" id="upcoming_sessions">
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
                        Add New User
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
                    <h3 class="box-title"><b>List of Upcoming Session(s)</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New Course Registration
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      @if($courses->toArray())
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:40px;" class="text-right">#</th>
                            <th>Proficiency Level</th>
                            <th>Course</th>
                            <th style="width:40px;">Detail</th>
                          </tr>
                          @foreach($courses as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->course_package->course_level->name }}</td>
                              <td>{{ $dt->title }}</td>
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
