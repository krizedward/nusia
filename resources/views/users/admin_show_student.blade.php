@extends('layouts.admin.default')

@section('title', 'Admin | Show | Student')

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
          <li><a href="#placement_tests" data-toggle="tab"><b>Placement Tests</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-default">
                  <div class="box-body box-profile">
                    @if($user->image_profile != 'user.jpg')
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.$user->image_profile) }}" alt="User profile picture">
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
              <div class="col-md-3">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>
                      @if($user->student->course_registrations->toArray())
                        {{ $user->student->course_registrations->count() }}
                      @else
                        0
                      @endif
                    </h3>
                    <p>
                      @if($user->student->course_registrations->count() != 1)
                        Registered Courses
                      @else
                        Registered Course
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
              <div class="col-md-3">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>
                      <?php
                        $arr_present = [];
                        $arr = [];
                        foreach($user->student->course_registrations as $cr)
                          foreach($cr->session_registrations as $sr) {
                            // Menghitung jumlah sesi yang dihadiri.
                            if($sr->status == 'Present')
                              if(!in_array($sr->id, $arr_present))
                                array_push($arr_present, $sr->id);
                            // Menghitung jumlah sesi secara keseluruhan.
                            if(!in_array($sr->id, $arr))
                              array_push($arr, $sr->id);
                          }
                      ?>
                      {{ count($arr_present) }} / {{ count($arr) }}
                    </h3>
                    <p>
                      @if(count($arr) != 1)
                        Attendances
                      @else
                        Attendance
                      @endif
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check-circle-o"></i>
                  </div>
                  <!--a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a-->
                </div>
              </div>
              <!-- /.col FOR WIDGET 2 -->
              <div class="col-md-3">
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>
                      <?php
                        $arr = [];
                        foreach($user->student->course_registrations as $cr)
                          foreach($cr->session_registrations as $sr)
                            foreach($sr->session_registration_forms as $srf)
                              if(!in_array($srf->form_response->form_question->form->id, $arr))
                                array_push($arr, $srf->form_response->form_question->form->id);
                      ?>
                      {{ count($arr) }}
                    </h3>
                    <p>
                      @if(count($arr) != 1)
                        Forms Filled
                      @else
                        Form Filled
                      @endif
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-pencil"></i>
                  </div>
                  <!--a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a-->
                </div>
              </div>
              <!-- /.col FOR WIDGET 3 -->
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
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Age</strong>
                    @if($user->student->age != 0)
                      <p>
                        {{ $user->student->age }}
                        @if($user->student->age != 1)
                          years old
                        @else
                          year old
                        @endif
                      </p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Job Status</strong>
                    @if($user->student->status_description)
                      <p>{{ $user->student->status_job }} at {{ $user->student->status_description }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Indonesia Language Proficiency</strong>
                    @if($user->student->age != 0)
                      <p>{{ $user->student->indonesian_language_proficiency }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Target Language Experience</strong>
                    @if($user->student->age != 0)
                      @if($user->student->target_language_experience != 'Others')
                        <p>{{ $user->student->target_language_experience }}</p>
                      @else
                        <p>
                          {{ $user->student->target_language_experience_value }}
                          @if($user->student->target_language_experience_value != 1)
                            years
                          @else
                            year
                          @endif
                        </p>
                      @endif
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Description of Course Taken</strong>
                    @if($user->student->description_of_course_taken)
                      <p>{{ $user->student->description_of_course_taken }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Learning Objective</strong>
                    @if($user->student->learning_objective)
                      <p>{{ $user->student->learning_objective }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Interest</strong>
                    @if($user->student->interest)
                      <?php
                        $interest = explode(', ', $user->student->interest);
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
                            <div class="col-md-6">
                              <div class="form-group @error('status_job') has-error @enderror">
                                <label for="status_job">Job Status</label>
                                <select name="status_job" type="text" class="@error('status_job') is-invalid @enderror form-control" id="status_job" onChange="if(document.getElementById('status_job').value == 'Student') {document.getElementById('status_description_label').innerHTML = 'Education Place'; document.getElementById('status_description').className = 'form-group';} else if(document.getElementById('status_job').value == 'Professional') {document.getElementById('status_description_label').innerHTML = 'Working Place'; document.getElementById('status_description').className = 'form-group';} else {document.getElementById('status_description_label').innerHTML = 'Education / Working Place'; document.getElementById('status_description').className = 'form-group hidden';}">
                                  <option selected="selected" value="">-- Job Status --</option>
                                  <option value="Student">Student</option>
                                  <option value="Professional">Professional</option>
                                </select>
                                @error('status_job')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group hidden @error('status_description') has-error @enderror" id="status_description">
                                <label for="status_description" id="status_description_label">Education / Working Place</label>
                                <input name="status_description" type="text" class="@error('status_description') is-invalid @enderror form-control" placeholder="Place" id="status_description_input" value="{{ old('status_description') }}">
                                @error('status_description')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('indonesian_language_proficiency') has-error @enderror">
                                <label for="indonesian_language_proficiency">Indonesian Language Proficiency (Self-assessment)</label>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Check the radio box below</p>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*The descriptions in each level are based on ACTFL proficiency descriptions</p>
                                <p class="hidden" id="descriptionNovice" style="color:#000000; padding-top:0px; margin-top:0px;"><b>Novice Proficiency</b><br>You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge.</p>
                                <p class="hidden" id="descriptionIntermediate" style="color:#000000; padding-top:0px; margin-top:0px;"><b>Intermediate Proficiency</b><br>You are categorized as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language.</p>
                                <p class="hidden" id="descriptionAdvanced" style="color:#000000; padding-top:0px; margin-top:0px;"><b>Advanced Proficiency</b><br>You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language.</p>
                                @if(old('indonesian_language_proficiency') == 'Novice')
                                  <input checked id="radioAnswer1" name="indonesian_language_proficiency" type="radio" value="Novice" onchange="if(document.getElementById('radioAnswer1').checked) { document.getElementById('descriptionNovice').className = ''; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                                @else
                                  <input id="radioAnswer1" name="indonesian_language_proficiency" type="radio" value="Novice" onchange="if(document.getElementById('radioAnswer1').checked) { document.getElementById('descriptionNovice').className = ''; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                                @endif
                                <label for="radioAnswer1" class="custom-control-label">Novice</label>
                                <br>
                                @if(old('indonesian_language_proficiency') == 'Intermediate')
                                  <input checked id="radioAnswer2" name="indonesian_language_proficiency" type="radio" value="Intermediate" onchange="if(document.getElementById('radioAnswer2').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = ''; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                                @else
                                  <input id="radioAnswer2" name="indonesian_language_proficiency" type="radio" value="Intermediate" onchange="if(document.getElementById('radioAnswer2').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = ''; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                                @endif
                                <label for="radioAnswer2" class="custom-control-label">Intermediate</label>
                                <br>
                                @if(old('indonesian_language_proficiency') == 'Advanced')
                                  <input checked id="radioAnswer3" name="indonesian_language_proficiency" type="radio" value="Advanced" onchange="if(document.getElementById('radioAnswer3').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = ''; }">
                                @else
                                  <input id="radioAnswer3" name="indonesian_language_proficiency" type="radio" value="Advanced" onchange="if(document.getElementById('radioAnswer3').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = ''; }">
                                @endif
                                <label for="radioAnswer3" class="custom-control-label">Advanced</label>
                                @error('indonesian_language_proficiency')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
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
                            <div class="col-md-6">
                              <div class="form-group @error('target_language_experience') has-error @enderror">
                                <label for="target_language_experience">Indonesian Language Experience</label>
                                <select name="target_language_experience" type="text" class="@error('target_language_experience') is-invalid @enderror form-control" id="target_language_experience" onChange="if(document.getElementById('target_language_experience').value == 'Others') {document.getElementById('target_language_experience_value').className = 'form-group';} else {document.getElementById('target_language_experience_value').className = 'form-group hidden';} if(document.getElementById('target_language_experience').value != 'Never (no experience)' && document.getElementById('target_language_experience').value != '') {document.getElementById('description_of_course_taken').className = 'form-group';} else {document.getElementById('description_of_course_taken').className = 'form-group hidden';}">
                                  <option selected="selected" value="">-- Indonesian Language Experience --</option>
                                  <option value="Never (no experience)">Never (no experience)</option>
                                  <option value="< 6 months">< 6 months</option>
                                  <option value="<= 1 year"><= 1 year</option>
                                  <option value="Others">Others</option>
                                </select>
                                @error('target_language_experience')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group hidden @error('target_language_experience_value') has-error @enderror" id="target_language_experience_value">
                                <label for="target_language_experience_value">I have learned Indonesian for .... years</label>
                                @if(old('target_language_experience_value'))
                                  <input name="target_language_experience_value" type="text" class="@error('target_language_experience_value') is-invalid @enderror form-control" placeholder="Value" value="{{ old('target_language_experience_value') }}">
                                @else
                                  <input name="target_language_experience_value" type="text" class="@error('target_language_experience_value') is-invalid @enderror form-control" placeholder="Value" value="0">
                                @endif
                                @error('target_language_experience_value')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group hidden @error('description_of_course_taken') has-error @enderror" id="description_of_course_taken">
                                <label for="description_of_course_taken">Your Learning Experiences</label>
                                <textarea name="description_of_course_taken" class="@error('description_of_course_taken') is-invalid @enderror form-control" rows="5" placeholder="If you have studied the Indonesian language, briefly describe any courses you have taken! (write in the Indonesian language—if possible)">{{ old('description_of_course_taken') }}</textarea>
                                @error('description_of_course_taken')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('learning_objective') has-error @enderror" id="learning_objective">
                                <label for="learning_objective">Your Learning Objectives</label>
                                <textarea name="learning_objective" class="@error('learning_objective') is-invalid @enderror form-control" rows="5" placeholder="Why do you want to learn the Indonesian language? (Briefly describe your learning objectives in the Indonesian language—if possible!)">{{ old('learning_objective') }}</textarea>
                                @error('learning_objective')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
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
                      @if($user->student->course_registrations->toArray())
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:40px;" class="text-right">#</th>
                            <th>Proficiency Level</th>
                            <th>Course</th>
                            <th style="width:40px;">Detail</th>
                          </tr>
                          @foreach($user->student->course_registrations as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->course->course_package->course_level->name }}</td>
                              <td>{{ $dt->course->title }}</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-green" href="{{ route('course_registrations.show', [Str::slug($user->password.$user->first_name.'-'.$user->last_name), Str::slug($dt->created_at.'-'.$dt->course->title)]) }}">Link</a></td>
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
          <div class="tab-pane" id="placement_tests">
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
                    <h3 class="box-title"><b>List of Placement Test(s)</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New "Something"
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($placement_tests->count() != 0)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Submission Time</th>
                          <th>Material</th>
                          <th>Course</th>
                          <th>Level</th>
                          <th>Result</th>
                          <th>Submission</th>
                        </tr>
                        @foreach($placement_tests as $i => $dt)
                          <?php
                            $submitted_at = \Carbon\Carbon::parse($dt->submitted_at)->setTimezone(Auth::user()->timezone);
                            //$result_updated_at = \Carbon\Carbon::parse($dt->result_updated_at)->setTimezone(Auth::user()->timezone);
                          ?>
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $submitted_at->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}</td>
                            <td>{{ $dt->course_registration->course->course_package->material_type->name }}</td>
                            <td>{{ $dt->course_registration->course->course_package->course_type->name }}</td>
                            <td>{{ $dt->course_registration->course->course_package->course_level->name }}</td>
                            <td>{{ $dt->status }}</td>
                            <td class="text-center">
                              @if($dt->path)
                                <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-green" href="{{ $dt->path }}">Link</a>
                              @else
                                <i class="text-muted">Not Available</i>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </table>
                      <hr>
                      <h3 class="box-title"><b>Confirm Placement Test Information</b></h3>
                      {{--
                      <div class="box-header">
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add New "Something"
                        </a>
                      </div>
                      --}}
                      <div class="box-body">
                        <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('id') has-error @enderror">
                                    <label for="id">Placement Test Number</label>
                                    <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Placement Test Number --</option>
                                      @foreach($placement_tests as $i => $pt)
                                        @if(old('id') == Str::slug($pt->created_at.$pt->path.$pt->submitted_at.$pt->status.$pt->result_updated_at))
                                          <option selected="selected" value="{{ Str::slug($pt->created_at.$pt->path.$pt->submitted_at.$pt->status.$pt->result_updated_at) }}">#{{ $i }}</option>
                                        @else
                                          <option value="{{ Str::slug($pt->created_at.$pt->path.$pt->submitted_at.$pt->status.$pt->result_updated_at) }}">#{{ $i }}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                    @error('id')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <div class="form-group @error('status') has-error @enderror">
                                    <label for="status">Placement Test Result</label>
                                    <select name="status" type="text" class="@error('status') is-invalid @enderror form-control">
                                      <option selected="selected" value="">-- Enter Placement Test Result --</option>
                                      <option value="Not Passed">Not Passed</option>
                                      <option value="Passed">Passed</option>
                                    </select>
                                    @error('status')
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
