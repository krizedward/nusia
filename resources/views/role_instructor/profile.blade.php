@extends('layouts.admin.default')

@section('title', 'Profile')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Profile - Instructor</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Profile</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          @if(Auth::user()->image_profile != 'user.jpg')
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/instructor/'.Auth::user()->image_profile) }}" alt="User profile picture">
          @else
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
          @endif
          <h3 class="profile-username text-center">
            @if(Auth::user()->first_name == Auth::user()->last_name)
              <b>{{ Auth::user()->first_name }}</b><br />
            @else
              <b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b><br />
            @endif
            <?php
              $registered_at = \Carbon\Carbon::parse(Auth::user()->created_at)->setTimezone(Auth::user()->timezone);
            ?>
            <small>
              Joined {{ $registered_at->isoFormat('MMMM Do YYYY, hh:mm A') }}
              {{-- <br />(on {{ $registered_at->isoFormat('dddd') }}) --}}
            </small>
          </h3>
          <br />
          <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
          <p class="text-muted">{{ Auth::user()->email }}</p>
          <hr>
          <strong>&nbsp;<i class="fa fa-map-marker margin-r-5"></i>&nbsp;&nbsp;Nationality</strong>
          <p class="text-muted">{{ Auth::user()->citizenship }}</p>
          <hr>
          <strong>&nbsp;<i class="fa fa-map-marker margin-r-5"></i>&nbsp;&nbsp;Where do you live now</strong>
          <p class="text-muted">@if(Auth::user()->domicile) {{ Auth::user()->domicile }} @else N/A @endif</p>
          <hr>
          <strong><i class="fa fa-clock-o margin-r-5"></i>&nbsp;&nbsp;Timezone</strong>
          @if(Auth::user()->timezone)
            <?php $tzname = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone)->getOffsetString(); ?>
            <p class="text-muted">GMT{{ $tzname }}</p>
          @else
            <p class="text-muted">N/A</p>
          @endif
          {{--<hr>--}}
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#form" data-toggle="tab"><b>Edit Profile</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <?php $instructor_interests = explode(', ', Auth::user()->instructor->interest); ?>
            <strong><i class="fa fa-cube margin-r-5"></i>
              @if(count($instructor_interests) == 1)
                Interest
              @else
                Interests
              @endif
            </strong>
            @if(Auth::user()->instructor->interest)
              <p>
                @foreach($instructor_interests as $dt)
                  <span class="label label-success">{{ $dt }}</span>
                @endforeach
              </p>
            @else
              <p class="text-muted">N/A</p>
            @endif
            <hr>
            <strong><i class="fa fa-circle-o margin-r-5"></i> Working Experience</strong>
            @if(Auth::user()->instructor->working_experience)
              <?php
                $working_experience = explode('|| ', Auth::user()->instructor->working_experience);
              ?>
              <p>
                @for($i = 0; $i < count($working_experience); $i = $i + 1)
                  {{ $working_experience[$i] }}
                  @if($i + 1 != count($working_experience))
                    <br>
                  @endif
                @endfor
              </p>
            @else
              <p><i>N/A</i></p>
            @endif
            {{--<hr>--}}
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="form">
            <form role="form" method="post" action="{{ route('registered.profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-12">
                      @if ($errors->get('email'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="email">Email</label>
                          <input name="email" value="{{ Auth::user()->email }}" type="email" class="@error('email') is-invalid @enderror form-control" placeholder="Enter Email">
                          @error('email')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                      @if($errors->get('old_password'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="old_password">Old Password</label>
                          <input name="old_password" type="password" class="@error('old_password') is-invalid @enderror form-control" placeholder="Enter Old Password">
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
                      @if($errors->get('password'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="password">New Password</label>
                          <input name="password" type="password" class="@error('password') is-invalid @enderror form-control" placeholder="Enter New Password">
                            @error('password')
                              <p style="color:red">{{ $message }}</p>
                            @enderror
                            @if(session('error_password'))
                              <p style="color:red">{{ session('error_password') }}</p>
                              <?php session(['error_password' => null]); ?>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                      @if($errors->get('full_name'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="full_name">Full Name</label>
                          @if(Auth::user()->first_name == Auth::user()->last_name)
                            <input name="full_name" value="{{ Auth::user()->first_name }}" type="text" class="@error('full_name') is-invalid @enderror form-control" placeholder="Enter Full Name">
                          @else
                            <input name="full_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" type="text" class="@error('full_name') is-invalid @enderror form-control" placeholder="Enter Full Name">
                          @endif
                          @error('full_name')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    {{--
                    <div class="col-md-6">
                      @if($errors->get('first_name'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="first_name">First Name</label>
                          <input name="first_name" value="{{ Auth::user()->first_name }}" type="text" class="@error('first_name') is-invalid @enderror form-control" placeholder="Enter First Name">
                          @error('first_name')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                      @if($errors->get('last_name'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="last_name">Last Name</label>
                          <input name="last_name" value="{{ Auth::user()->last_name }}" type="text" class="@error('last_name') is-invalid @enderror form-control" placeholder="Enter Last Name">
                          @error('last_name')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    --}}
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-12">
                      @if($errors->get('citizenship'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="citizenship">Nationality</label>
                          @if(Auth::user()->citizenship)
                            <input name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Enter Nationality" value="{{ Auth::user()->citizenship }}">
                          @else
                            <input name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Enter Nationality" value="{{ old('citizenship') }}">
                          @endif
                          @error('citizenship')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                      @if($errors->get('domicile'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="domicile">Where do you live now?</label>
                          @if(Auth::user()->domicile)
                            <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter Domicile" value="{{ Auth::user()->domicile }}">
                          @else
                            <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter Domicile" value="{{ old('domicile') }}">
                          @endif
                          @error('domicile')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                      @if($errors->get('timezone'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="timezone">What is your local time zone?</label>
                          <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Reference: <b><a target="_blank" rel="noopener noreferrer" href="https://www.timeanddate.com/">timeanddate.com</a></b></p>
                          <select name="timezone" type="text" class="@error('timezone') is-invalid @enderror form-control select2" style="width:100%;">
                            <option selected="selected" value="">-- Enter your current time zone --</option>
                            @foreach($timezones as $timezone)
                              @if(old('timezone') == $timezone)
                                <option selected="selected" value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                              @elseif($tz_old == $timezone)
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
                  <div class="form-group col-md-12">
                    <div class="col-md-12 @error('image_profile_flag') has-error @enderror">
                      <br />
                      <label for="image_profile_flag" class="control-label">Do you want to change your profile picture?</label><br />
                      <select name="image_profile_flag" id="image_profile_flag" type="text" class="@error('image_profile_flag') is-invalid @enderror form-control select2" style="width:100%;" onchange="if(document.getElementById('image_profile_flag').value == 1) document.getElementById('image_profile_div').className = 'col-md-12'; else document.getElementById('image_profile_div').className = 'col-md-12 hidden';">
                        <option selected="selected" value="0">-- Enter your choice --</option>
                        <option value="1">Yes</option>
                        @if(Auth::user()->image_profile != 'user.jpg')
                          <option value="-1">Yes (delete the current profile picture)</option>
                        @endif
                        <option value="0">No</option>
                      </select>
                      @error('image_profile_flag')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="col-md-12 hidden" id="image_profile_div">
                      <br />
                      <label for="image_profile" class="control-label">Upload profile picture</label>
                      <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                      <input name="image_profile" type="file" accept="image/*" class="@error('image_profile') is-invalid @enderror form-control">
                      @error('image_profile')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-12">
                      @if($errors->get('bio_description'))
                        <div class="form-group has-error">
                      @else
                        <div class="form-group">
                      @endif
                          <label for="bio_description">Tell me about yourself!</label>
                          @if(Auth::user()->instructor->bio_description)
                            <textarea id="bio_description" name="bio_description" class="@error('bio_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Bio Description">{{ Auth::user()->instructor->bio_description }}</textarea>
                          @else
                            <textarea id="bio_description" name="bio_description" class="@error('bio_description') is-invalid @enderror form-control" rows="5" placeholder="Enter Bio Description">{{ old('bio_description') }}</textarea>
                          @endif
                          @error('bio_description')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-12">&nbsp;</div>
                    <?php
                      $interest_values = explode(', ', Auth::user()->instructor->interest);
                    ?>
                    <div class="col-md-2">
                      @if($errors->get('interest_1'))
                        <div class="form-group has-error" id="interest_1">
                      @else
                        <div class="form-group" id="interest_1">
                      @endif
                          <label for="interest_1">Interest #1</label>
                          <select name="interest_1" type="text" class="@error('interest_1') is-invalid @enderror form-control select2" style="width:100%;" id="interest_1_input">
                            <option selected="selected" value="">-- Interest --</option>
                            @foreach($interests as $interest)
                              @if(count($interest_values) > 0 && $interest == $interest_values[0])
                                <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                              @else
                                <option value="{{ $interest }}">{{ $interest }}</option>
                              @endif
                            @endforeach
                          </select>
                          @error('interest_1')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('interest_2'))
                        <div class="form-group has-error" id="interest_2">
                      @else
                        <div class="form-group" id="interest_2">
                      @endif
                          <label for="interest_2">Interest #2</label>
                          <select name="interest_2" type="text" class="@error('interest_2') is-invalid @enderror form-control select2" style="width:100%;" id="interest_2_input">
                            <option selected="selected" value="">-- Interest --</option>
                            @foreach($interests as $interest)
                              @if(count($interest_values) > 1 && $interest == $interest_values[1])
                                <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                              @else
                                <option value="{{ $interest }}">{{ $interest }}</option>
                              @endif
                            @endforeach
                          </select>
                          @error('interest_2')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('interest_3'))
                        <div class="form-group has-error" id="interest_3">
                      @else
                        <div class="form-group" id="interest_3">
                      @endif
                          <label for="interest_3">Interest #3</label>
                          <select name="interest_3" type="text" class="@error('interest_3') is-invalid @enderror form-control select2" style="width:100%;" id="interest_3_input">
                            <option selected="selected" value="">-- Interest --</option>
                            @foreach($interests as $interest)
                              @if(count($interest_values) > 2 && $interest == $interest_values[2])
                                <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                              @else
                                <option value="{{ $interest }}">{{ $interest }}</option>
                              @endif
                            @endforeach
                          </select>
                          @error('interest_3')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('interest_4'))
                        <div class="form-group has-error" id="interest_4">
                      @else
                        <div class="form-group" id="interest_4">
                      @endif
                          <label for="interest_4">Interest #4</label>
                          <select name="interest_4" type="text" class="@error('interest_4') is-invalid @enderror form-control select2" style="width:100%;" id="interest_4_input">
                            <option selected="selected" value="">-- Interest --</option>
                            @foreach($interests as $interest)
                              @if(count($interest_values) > 3 && $interest == $interest_values[3])
                                <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                              @else
                                <option value="{{ $interest }}">{{ $interest }}</option>
                              @endif
                            @endforeach
                          </select>
                          @error('interest_4')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('interest_5'))
                        <div class="form-group has-error" id="interest_5">
                      @else
                        <div class="form-group" id="interest_5">
                      @endif
                          <label for="interest_5">Interest #5</label>
                          <select name="interest_5" type="text" class="@error('interest_5') is-invalid @enderror form-control select2" style="width:100%;" id="interest_5_input">
                            <option selected="selected" value="">-- Interest --</option>
                            @foreach($interests as $interest)
                              @if(count($interest_values) > 4 && $interest == $interest_values[4])
                                <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                              @else
                                <option value="{{ $interest }}">{{ $interest }}</option>
                              @endif
                            @endforeach
                          </select>
                          @error('interest_5')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('interest_6'))
                        <div class="form-group has-error" id="interest_6">
                      @else
                        <div class="form-group" id="interest_6">
                      @endif
                          <label for="interest_6">Interest #6</label>
                          <select name="interest_6" type="text" class="@error('interest_6') is-invalid @enderror form-control select2" style="width:100%;" id="interest_6_input">
                            <option selected="selected" value="">-- Interest --</option>
                            @foreach($interests as $interest)
                              @if(count($interest_values) > 5 && $interest == $interest_values[5])
                                <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                              @else
                                <option value="{{ $interest }}">{{ $interest }}</option>
                              @endif
                            @endforeach
                          </select>
                          @error('interest_6')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <?php
                      $working_experience_values = explode('|| ', Auth::user()->instructor->working_experience);
                    ?>
                    <div class="col-md-12">
                      <label>Working Experience(s)</label>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_1'))
                        <div class="form-group has-error" id="working_experience_begin_year_1">
                      @else
                        <div class="form-group" id="working_experience_begin_year_1">
                      @endif
                          <label for="working_experience_begin_year_1">(1) From</label>
                          <select name="working_experience_begin_year_1" type="text" class="@error('working_experience_begin_year_1') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_1_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 0 && substr($working_experience_values[0], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_1')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_1'))
                        <div class="form-group has-error" id="working_experience_end_year_1">
                      @else
                        <div class="form-group" id="working_experience_end_year_1">
                      @endif
                          <label for="working_experience_end_year_1">To (optional)</label>
                          <select name="working_experience_end_year_1" type="text" class="@error('working_experience_end_year_1') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_1_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 0 && substr($working_experience_values[0], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_1')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_1'))
                        <div class="form-group has-error" id="working_experience_1">
                      @else
                        <div class="form-group" id="working_experience_1">
                      @endif
                          <label for="working_experience_1">Description</label>
                          @if(count($working_experience_values) > 0)
                            <input name="working_experience_1" type="text" class="@error('working_experience_1') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_1_input" value="{{ substr($working_experience_values[0], strpos($working_experience_values[0], ':') + 2) }}">
                          @else
                            <input name="working_experience_1" type="text" class="@error('working_experience_1') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_1_input">
                          @endif
                          @error('working_experience_1')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_2'))
                        <div class="form-group has-error" id="working_experience_begin_year_2">
                      @else
                        <div class="form-group" id="working_experience_begin_year_2">
                      @endif
                          <label for="working_experience_begin_year_2">(2) From</label>
                          <select name="working_experience_begin_year_2" type="text" class="@error('working_experience_begin_year_2') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_2_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 1 && substr($working_experience_values[1], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_2')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_2'))
                        <div class="form-group has-error" id="working_experience_end_year_2">
                      @else
                        <div class="form-group" id="working_experience_end_year_2">
                      @endif
                          <label for="working_experience_end_year_2">To (optional)</label>
                          <select name="working_experience_end_year_2" type="text" class="@error('working_experience_end_year_2') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_2_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 1 && substr($working_experience_values[1], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_2')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_2'))
                        <div class="form-group has-error" id="working_experience_2">
                      @else
                        <div class="form-group" id="working_experience_2">
                      @endif
                          <label for="working_experience_2">Description</label>
                          @if(count($working_experience_values) > 1)
                            <input name="working_experience_2" type="text" class="@error('working_experience_2') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_2_input" value="{{ substr($working_experience_values[1], strpos($working_experience_values[1], ':') + 2) }}">
                          @else
                            <input name="working_experience_2" type="text" class="@error('working_experience_2') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_2_input">
                          @endif
                          @error('working_experience_2')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_3'))
                        <div class="form-group has-error" id="working_experience_begin_year_3">
                      @else
                        <div class="form-group" id="working_experience_begin_year_3">
                      @endif
                          <label for="working_experience_begin_year_3">(3) From</label>
                          <select name="working_experience_begin_year_3" type="text" class="@error('working_experience_begin_year_3') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_3_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 2 && substr($working_experience_values[2], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_3')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_3'))
                        <div class="form-group has-error" id="working_experience_end_year_3">
                      @else
                        <div class="form-group" id="working_experience_end_year_3">
                      @endif
                          <label for="working_experience_end_year_3">To (optional)</label>
                          <select name="working_experience_end_year_3" type="text" class="@error('working_experience_end_year_3') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_3_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 2 && substr($working_experience_values[2], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_3')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_3'))
                        <div class="form-group has-error" id="working_experience_3">
                      @else
                        <div class="form-group" id="working_experience_3">
                      @endif
                          <label for="working_experience_3">Description</label>
                          @if(count($working_experience_values) > 2)
                            <input name="working_experience_3" type="text" class="@error('working_experience_3') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_3_input" value="{{ substr($working_experience_values[2], strpos($working_experience_values[2], ':') + 2) }}">
                          @else
                            <input name="working_experience_3" type="text" class="@error('working_experience_3') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_3_input">
                          @endif
                          @error('working_experience_3')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_4'))
                        <div class="form-group has-error" id="working_experience_begin_year_4">
                      @else
                        <div class="form-group" id="working_experience_begin_year_4">
                      @endif
                          <label for="working_experience_begin_year_4">(4) From</label>
                          <select name="working_experience_begin_year_4" type="text" class="@error('working_experience_begin_year_4') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_4_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 3 && substr($working_experience_values[3], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_4')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_4'))
                        <div class="form-group has-error" id="working_experience_end_year_4">
                      @else
                        <div class="form-group" id="working_experience_end_year_4">
                      @endif
                          <label for="working_experience_end_year_4">To (optional)</label>
                          <select name="working_experience_end_year_4" type="text" class="@error('working_experience_end_year_4') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_4_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 3 && substr($working_experience_values[3], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_4')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_4'))
                        <div class="form-group has-error" id="working_experience_4">
                      @else
                        <div class="form-group" id="working_experience_4">
                      @endif
                          <label for="working_experience_4">Description</label>
                          @if(count($working_experience_values) > 3)
                            <input name="working_experience_4" type="text" class="@error('working_experience_4') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_4_input" value="{{ substr($working_experience_values[3], strpos($working_experience_values[3], ':') + 2) }}">
                          @else
                            <input name="working_experience_4" type="text" class="@error('working_experience_4') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_4_input">
                          @endif
                          @error('working_experience_4')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_5'))
                        <div class="form-group has-error" id="working_experience_begin_year_5">
                      @else
                        <div class="form-group" id="working_experience_begin_year_5">
                      @endif
                          <label for="working_experience_begin_year_5">(5) From</label>
                          <select name="working_experience_begin_year_5" type="text" class="@error('working_experience_begin_year_5') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_5_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 4 && substr($working_experience_values[4], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_5')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_5'))
                        <div class="form-group has-error" id="working_experience_end_year_5">
                      @else
                        <div class="form-group" id="working_experience_end_year_5">
                      @endif
                          <label for="working_experience_end_year_5">To (optional)</label>
                          <select name="working_experience_end_year_5" type="text" class="@error('working_experience_end_year_5') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_5_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 4 && substr($working_experience_values[4], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_5')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_5'))
                        <div class="form-group has-error" id="working_experience_5">
                      @else
                        <div class="form-group" id="working_experience_5">
                      @endif
                          <label for="working_experience_5">Description</label>
                          @if(count($working_experience_values) > 4)
                            <input name="working_experience_5" type="text" class="@error('working_experience_5') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_5_input" value="{{ substr($working_experience_values[4], strpos($working_experience_values[4], ':') + 2) }}">
                          @else
                            <input name="working_experience_5" type="text" class="@error('working_experience_5') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_5_input">
                          @endif
                          @error('working_experience_5')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_6'))
                        <div class="form-group has-error" id="working_experience_begin_year_6">
                      @else
                        <div class="form-group" id="working_experience_begin_year_6">
                      @endif
                          <label for="working_experience_begin_year_6">(6) From</label>
                          <select name="working_experience_begin_year_6" type="text" class="@error('working_experience_begin_year_6') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_6_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 5 && substr($working_experience_values[5], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_6')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_6'))
                        <div class="form-group has-error" id="working_experience_end_year_6">
                      @else
                        <div class="form-group" id="working_experience_end_year_6">
                      @endif
                          <label for="working_experience_end_year_6">To (optional)</label>
                          <select name="working_experience_end_year_6" type="text" class="@error('working_experience_end_year_6') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_6_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 5 && substr($working_experience_values[5], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_6')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_6'))
                        <div class="form-group has-error" id="working_experience_6">
                      @else
                        <div class="form-group" id="working_experience_6">
                      @endif
                          <label for="working_experience_6">Description</label>
                          @if(count($working_experience_values) > 5)
                            <input name="working_experience_6" type="text" class="@error('working_experience_6') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_6_input" value="{{ substr($working_experience_values[5], strpos($working_experience_values[5], ':') + 2) }}">
                          @else
                            <input name="working_experience_6" type="text" class="@error('working_experience_6') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_6_input">
                          @endif
                          @error('working_experience_6')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_7'))
                        <div class="form-group has-error" id="working_experience_begin_year_7">
                      @else
                        <div class="form-group" id="working_experience_begin_year_7">
                      @endif
                          <label for="working_experience_begin_year_7">(7) From</label>
                          <select name="working_experience_begin_year_7" type="text" class="@error('working_experience_begin_year_7') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_7_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 6 && substr($working_experience_values[6], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_7')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_7'))
                        <div class="form-group has-error" id="working_experience_end_year_7">
                      @else
                        <div class="form-group" id="working_experience_end_year_7">
                      @endif
                          <label for="working_experience_end_year_7">To (optional)</label>
                          <select name="working_experience_end_year_7" type="text" class="@error('working_experience_end_year_7') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_7_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 6 && substr($working_experience_values[6], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_7')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_7'))
                        <div class="form-group has-error" id="working_experience_7">
                      @else
                        <div class="form-group" id="working_experience_7">
                      @endif
                          <label for="working_experience_7">Description</label>
                          @if(count($working_experience_values) > 6)
                            <input name="working_experience_7" type="text" class="@error('working_experience_7') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_7_input" value="{{ substr($working_experience_values[6], strpos($working_experience_values[6], ':') + 2) }}">
                          @else
                            <input name="working_experience_7" type="text" class="@error('working_experience_7') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_7_input">
                          @endif
                          @error('working_experience_7')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_8'))
                        <div class="form-group has-error" id="working_experience_begin_year_8">
                      @else
                        <div class="form-group" id="working_experience_begin_year_8">
                      @endif
                          <label for="working_experience_begin_year_8">(8) From</label>
                          <select name="working_experience_begin_year_8" type="text" class="@error('working_experience_begin_year_8') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_8_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 7 && substr($working_experience_values[7], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_8')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_8'))
                        <div class="form-group has-error" id="working_experience_end_year_8">
                      @else
                        <div class="form-group" id="working_experience_end_year_8">
                      @endif
                          <label for="working_experience_end_year_8">To (optional)</label>
                          <select name="working_experience_end_year_8" type="text" class="@error('working_experience_end_year_8') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_8_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 7 && substr($working_experience_values[7], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_8')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_8'))
                        <div class="form-group has-error" id="working_experience_8">
                      @else
                        <div class="form-group" id="working_experience_8">
                      @endif
                          <label for="working_experience_8">Description</label>
                          @if(count($working_experience_values) > 7)
                            <input name="working_experience_8" type="text" class="@error('working_experience_8') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_8_input" value="{{ substr($working_experience_values[7], strpos($working_experience_values[7], ':') + 2) }}">
                          @else
                            <input name="working_experience_8" type="text" class="@error('working_experience_8') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_8_input">
                          @endif
                          @error('working_experience_8')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_9'))
                        <div class="form-group has-error" id="working_experience_begin_year_9">
                      @else
                        <div class="form-group" id="working_experience_begin_year_9">
                      @endif
                          <label for="working_experience_begin_year_9">(9) From</label>
                          <select name="working_experience_begin_year_9" type="text" class="@error('working_experience_begin_year_9') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_9_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 8 && substr($working_experience_values[8], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_9')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_9'))
                        <div class="form-group has-error" id="working_experience_end_year_9">
                      @else
                        <div class="form-group" id="working_experience_end_year_9">
                      @endif
                          <label for="working_experience_end_year_9">To (optional)</label>
                          <select name="working_experience_end_year_9" type="text" class="@error('working_experience_end_year_9') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_9_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 8 && substr($working_experience_values[8], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_9')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_9'))
                        <div class="form-group has-error" id="working_experience_9">
                      @else
                        <div class="form-group" id="working_experience_9">
                      @endif
                          <label for="working_experience_9">Description</label>
                          @if(count($working_experience_values) > 8)
                            <input name="working_experience_9" type="text" class="@error('working_experience_9') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_9_input" value="{{ substr($working_experience_values[8], strpos($working_experience_values[8], ':') + 2) }}">
                          @else
                            <input name="working_experience_9" type="text" class="@error('working_experience_9') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_9_input">
                          @endif
                          @error('working_experience_9')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_10'))
                        <div class="form-group has-error" id="working_experience_begin_year_10">
                      @else
                        <div class="form-group" id="working_experience_begin_year_10">
                      @endif
                          <label for="working_experience_begin_year_10">(10) From</label>
                          <select name="working_experience_begin_year_10" type="text" class="@error('working_experience_begin_year_10') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_10_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 9 && substr($working_experience_values[9], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_10')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_10'))
                        <div class="form-group has-error" id="working_experience_end_year_10">
                      @else
                        <div class="form-group" id="working_experience_end_year_10">
                      @endif
                          <label for="working_experience_end_year_10">To (optional)</label>
                          <select name="working_experience_end_year_10" type="text" class="@error('working_experience_end_year_10') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_10_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 9 && substr($working_experience_values[9], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_10')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_10'))
                        <div class="form-group has-error" id="working_experience_10">
                      @else
                        <div class="form-group" id="working_experience_10">
                      @endif
                          <label for="working_experience_10">Description</label>
                          @if(count($working_experience_values) > 9)
                            <input name="working_experience_10" type="text" class="@error('working_experience_10') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_10_input" value="{{ substr($working_experience_values[9], strpos($working_experience_values[9], ':') + 2) }}">
                          @else
                            <input name="working_experience_10" type="text" class="@error('working_experience_10') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_10_input">
                          @endif
                          @error('working_experience_10')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_11'))
                        <div class="form-group has-error" id="working_experience_begin_year_11">
                      @else
                        <div class="form-group" id="working_experience_begin_year_11">
                      @endif
                          <label for="working_experience_begin_year_11">(11) From</label>
                          <select name="working_experience_begin_year_11" type="text" class="@error('working_experience_begin_year_11') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_11_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 10 && substr($working_experience_values[10], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_11')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_11'))
                        <div class="form-group has-error" id="working_experience_end_year_11">
                      @else
                        <div class="form-group" id="working_experience_end_year_11">
                      @endif
                          <label for="working_experience_end_year_11">To (optional)</label>
                          <select name="working_experience_end_year_11" type="text" class="@error('working_experience_end_year_11') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_11_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 10 && substr($working_experience_values[10], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_11')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_11'))
                        <div class="form-group has-error" id="working_experience_11">
                      @else
                        <div class="form-group" id="working_experience_11">
                      @endif
                          <label for="working_experience_11">Description</label>
                          @if(count($working_experience_values) > 10)
                            <input name="working_experience_11" type="text" class="@error('working_experience_11') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_11_input" value="{{ substr($working_experience_values[10], strpos($working_experience_values[10], ':') + 2) }}">
                          @else
                            <input name="working_experience_11" type="text" class="@error('working_experience_11') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_11_input">
                          @endif
                          @error('working_experience_11')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_12'))
                        <div class="form-group has-error" id="working_experience_begin_year_12">
                      @else
                        <div class="form-group" id="working_experience_begin_year_12">
                      @endif
                          <label for="working_experience_begin_year_12">(12) From</label>
                          <select name="working_experience_begin_year_12" type="text" class="@error('working_experience_begin_year_12') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_12_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 11 && substr($working_experience_values[11], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_12')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_12'))
                        <div class="form-group has-error" id="working_experience_end_year_12">
                      @else
                        <div class="form-group" id="working_experience_end_year_12">
                      @endif
                          <label for="working_experience_end_year_12">To (optional)</label>
                          <select name="working_experience_end_year_12" type="text" class="@error('working_experience_end_year_12') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_12_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 11 && substr($working_experience_values[11], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_12')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_12'))
                        <div class="form-group has-error" id="working_experience_12">
                      @else
                        <div class="form-group" id="working_experience_12">
                      @endif
                          <label for="working_experience_12">Description</label>
                          @if(count($working_experience_values) > 11)
                            <input name="working_experience_12" type="text" class="@error('working_experience_12') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_12_input" value="{{ substr($working_experience_values[11], strpos($working_experience_values[11], ':') + 2) }}">
                          @else
                            <input name="working_experience_12" type="text" class="@error('working_experience_12') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_12_input">
                          @endif
                          @error('working_experience_12')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_13'))
                        <div class="form-group has-error" id="working_experience_begin_year_13">
                      @else
                        <div class="form-group" id="working_experience_begin_year_13">
                      @endif
                          <label for="working_experience_begin_year_13">(13) From</label>
                          <select name="working_experience_begin_year_13" type="text" class="@error('working_experience_begin_year_13') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_13_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 12 && substr($working_experience_values[12], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_13')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_13'))
                        <div class="form-group has-error" id="working_experience_end_year_13">
                      @else
                        <div class="form-group" id="working_experience_end_year_13">
                      @endif
                          <label for="working_experience_end_year_13">To (optional)</label>
                          <select name="working_experience_end_year_13" type="text" class="@error('working_experience_end_year_13') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_13_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 12 && substr($working_experience_values[12], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_13')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_13'))
                        <div class="form-group has-error" id="working_experience_13">
                      @else
                        <div class="form-group" id="working_experience_13">
                      @endif
                          <label for="working_experience_13">Description</label>
                          @if(count($working_experience_values) > 12)
                            <input name="working_experience_13" type="text" class="@error('working_experience_13') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_13_input" value="{{ substr($working_experience_values[12], strpos($working_experience_values[12], ':') + 2) }}">
                          @else
                            <input name="working_experience_13" type="text" class="@error('working_experience_13') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_13_input">
                          @endif
                          @error('working_experience_13')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_14'))
                        <div class="form-group has-error" id="working_experience_begin_year_14">
                      @else
                        <div class="form-group" id="working_experience_begin_year_14">
                      @endif
                          <label for="working_experience_begin_year_14">(14) From</label>
                          <select name="working_experience_begin_year_14" type="text" class="@error('working_experience_begin_year_14') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_14_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 13 && substr($working_experience_values[13], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_14')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_14'))
                        <div class="form-group has-error" id="working_experience_end_year_14">
                      @else
                        <div class="form-group" id="working_experience_end_year_14">
                      @endif
                          <label for="working_experience_end_year_14">To (optional)</label>
                          <select name="working_experience_end_year_14" type="text" class="@error('working_experience_end_year_14') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_14_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 13 && substr($working_experience_values[13], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_14')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_14'))
                        <div class="form-group has-error" id="working_experience_14">
                      @else
                        <div class="form-group" id="working_experience_14">
                      @endif
                          <label for="working_experience_14">Description</label>
                          @if(count($working_experience_values) > 13)
                            <input name="working_experience_14" type="text" class="@error('working_experience_14') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_14_input" value="{{ substr($working_experience_values[13], strpos($working_experience_values[13], ':')) }}">
                          @else
                            <input name="working_experience_14" type="text" class="@error('working_experience_14') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_14_input">
                          @endif
                          @error('working_experience_14')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_begin_year_15'))
                        <div class="form-group has-error" id="working_experience_begin_year_15">
                      @else
                        <div class="form-group" id="working_experience_begin_year_15">
                      @endif
                          <label for="working_experience_begin_year_15">(15) From</label>
                          <select name="working_experience_begin_year_15" type="text" class="@error('working_experience_begin_year_15') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_begin_year_15_input">
                            <option selected="selected" value="">-- From --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 14 && substr($working_experience_values[14], 0, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_begin_year_15')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                      @if($errors->get('working_experience_end_year_15'))
                        <div class="form-group has-error" id="working_experience_end_year_15">
                      @else
                        <div class="form-group" id="working_experience_end_year_15">
                      @endif
                          <label for="working_experience_end_year_15">To (optional)</label>
                          <select name="working_experience_end_year_15" type="text" class="@error('working_experience_end_year_15') is-invalid @enderror form-control select2" style="width:100%;" id="working_experience_end_year_15_input">
                            <option selected="selected" value="">-- To --</option>
                            @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                              @if(count($working_experience_values) > 14 && substr($working_experience_values[14], 5, 4) == $i)
                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option value="{{ $i }}">{{ $i }}</option>
                              @endif
                            @endfor
                          </select>
                          @error('working_experience_end_year_15')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                      @if($errors->get('working_experience_15'))
                        <div class="form-group has-error" id="working_experience_15">
                      @else
                        <div class="form-group" id="working_experience_15">
                      @endif
                          <label for="working_experience_15">Description</label>
                          @if(count($working_experience_values) > 14)
                            <input name="working_experience_15" type="text" class="@error('working_experience_15') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_15_input" value="{{ substr($working_experience_values[14], strpos($working_experience_values[14], ':')) }}">
                          @else
                            <input name="working_experience_15" type="text" class="@error('working_experience_15') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_15_input">
                          @endif
                          @error('working_experience_15')
                            <p style="color:red">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary bg-blue" style="width:100%;">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@stop
