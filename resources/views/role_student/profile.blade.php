@extends('layouts.admin.default')

@section('title', 'Profile')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Profile - Student</b></h1>
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
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/' . Auth::user()->image_profile) }}" alt="User profile picture">
          @else
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
          @endif
          <h3 class="profile-username text-center">
            <b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b><br />
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
          <p class="text-muted">@if(Auth::user()->domicile) {{ Auth::user()->domicile }} @else Not Available @endif</p>
          <hr>
          <strong><i class="fa fa-clock-o margin-r-5"></i>&nbsp;&nbsp;Timezone</strong>
          @if(Auth::user()->timezone)
            <?php $tzname = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone)->getOffsetString(); ?>
            <p class="text-muted">GMT{{ $tzname }}</p>
          @else
            <p class="text-muted">Not Available</p>
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
            <strong><i class="fa fa-user-circle-o margin-r-5"></i>&nbsp;Age</strong>
            <p>{{ Auth::user()->student->age }} years old</p>
            <hr>
            <?php $student_interests = explode(', ', Auth::user()->student->interest); ?>
            <strong><i class="fa fa-cube margin-r-5"></i>
              @if(count($student_interests) == 1)
                Interest
              @else
                Interests
              @endif
            </strong>
            @if(Auth::user()->student->interest)
              <p>
                @foreach($student_interests as $dt)
                  <span class="label label-success">{{ $dt }}</span>
                @endforeach
              </p>
            @else
              <p class="text-muted">Not Available</p>
            @endif
            <hr>
            <strong>
              @if(Auth::user()->student->status_job == 'Student')
                <i class="fa fa-graduation-cap"></i>&nbsp;Job Status
              @elseif(Auth::user()->student->status_job == 'Professional')
                <i class="fa fa-briefcase"></i>&nbsp;&nbsp;Job Status
              @endif
            </strong>
            <p>{{ Auth::user()->student->status_job }} - {{ Auth::user()->student->status_description }}</p>
            <hr>
            <strong><i class="fa fa-trophy margin-r-5"></i> Indonesia Language Proficiency</strong>
            <p>{{ Auth::user()->student->indonesian_language_proficiency }}</p>
            <hr>
            <strong><i class="fa fa-history margin-r-5"></i> Target Language Experience</strong>
            <p>
              @if(Auth::user()->student->target_language_experience != 'Others')
                {{ Auth::user()->student->target_language_experience }}
              @else
                {{ Auth::user()->student->target_language_experience_value }}
                @if(Auth::user()->student->target_language_experience_value == 1)
                  year
                @else
                  years
                @endif
              @endif
            </p>
            <hr>
            <strong><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Description of Course Taken</strong>
            <p>
              @if(Auth::user()->student->description_of_course_taken)
                {{ Auth::user()->student->description_of_course_taken }}
              @else
                <span class="text-muted">Not Available</span>
              @endif
            </p>
            <hr>
            <strong><i class="fa fa-language margin-r-5"></i> Learning Objective</strong>
            <p>
              @if(Auth::user()->student->learning_objective)
                {{ Auth::user()->student->learning_objective }}
              @else
                <span class="text-muted">Not Available</span>
              @endif
            </p>
            {{-- <hr> --}}
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="form">
            <form class="form-horizontal" role="form" method="post" action="{{ route('registered.profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              {{--
              <div class="form-group col-md-12">
                <div class="col-md-12">
                  <label for="age" class="control-label">Age (numbers only, in years)</label><br />
                  <input name="age" type="text" class="@error('age') is-invalid @enderror form-control" placeholder="Enter your age (numbers only, in years)" value="@if(Auth::user()->student->age != 0){{ Auth::user()->student->age }}@else{{ old('age') }}@endif">
                </div>
              </div>
              --}}
              <div class="form-group col-md-12">
                <div class="col-md-12 @error('domicile') has-error @enderror">
                  <label for="domicile" class="control-label">Where do you live now?</label>
                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter your domicile" value="@if(Auth::user()->domicile){{ Auth::user()->domicile }}@else{{ old('domicile') }}@endif">
                  @error('domicile')
                    <p style="color:red">This field is required.</p>
                  @enderror
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-12">
                  <label class="control-label">Interest (max. 6)</label>
                </div>
                <div class="col-md-2 @error('interest_1') has-error @enderror">
                  <label for="interest_1" class="control-label hidden">First Interest</label>
                  <select name="interest_1" type="text" class="@error('interest_1') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">None</option>
                    @foreach($interests as $interest)
                      @if(old('interest_1') && old('interest_1') == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @elseif(count($student_interests) >= 1 && $student_interests[0] == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @else
                        <option value="{{ $interest }}">{{ $interest }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="interest_2" class="control-label hidden">Second Interest</label>
                  <select name="interest_2" type="text" class="@error('interest_2') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">None</option>
                    @foreach($interests as $interest)
                      @if(old('interest_2') && old('interest_2') == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @elseif(count($student_interests) >= 2 && $student_interests[1] == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @else
                        <option value="{{ $interest }}">{{ $interest }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="interest_3" class="control-label hidden">Third Interest</label>
                  <select name="interest_3" type="text" class="@error('interest_3') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">None</option>
                    @foreach($interests as $interest)
                      @if(old('interest_3') && old('interest_3') == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @elseif(count($student_interests) >= 3 && $student_interests[2] == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @else
                        <option value="{{ $interest }}">{{ $interest }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="interest_4" class="control-label hidden">Fourth Interest</label>
                  <select name="interest_4" type="text" class="@error('interest_4') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">None</option>
                    @foreach($interests as $interest)
                      @if(old('interest_4') && old('interest_4') == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @elseif(count($student_interests) >= 4 && $student_interests[3] == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @else
                        <option value="{{ $interest }}">{{ $interest }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="interest_5" class="control-label hidden">Fifth Interest</label>
                  <select name="interest_5" type="text" class="@error('interest_5') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">None</option>
                    @foreach($interests as $interest)
                      @if(old('interest_5') && old('interest_5') == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @elseif(count($student_interests) >= 5 && $student_interests[4] == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @else
                        <option value="{{ $interest }}">{{ $interest }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="interest_6" class="control-label hidden">Sixth Interest</label>
                  <select name="interest_6" type="text" class="@error('interest_6') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">None</option>
                    @foreach($interests as $interest)
                      @if(old('interest_6') && old('interest_6') == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @elseif(count($student_interests) == 6 && $student_interests[5] == $interest)
                        <option selected="selected" value="{{ $interest }}">{{ $interest }}</option>
                      @else
                        <option value="{{ $interest }}">{{ $interest }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-12">
                  @error('interest_1')
                    <p style="color:red">This field is required.</p>
                  @enderror
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-12 @error('image_profile_flag') has-error @enderror">
                  <label for="image_profile_flag" class="control-label">Do you want to change your profile picture?</label>
                  <select name="image_profile_flag" id="image_profile_flag" type="text" class="@error('image_profile_flag') is-invalid @enderror form-control select2" onchange="if(document.getElementById('image_profile_flag').value == 1) document.getElementById('image_profile_div').className = 'col-md-12'; else document.getElementById('image_profile_div').className = 'col-md-12 hidden';">
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
                  <label for="image_profile" class="control-label">Upload profile picture</label>
                  <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                  <input name="image_profile" type="file" accept="image/*" class="@error('image_profile') is-invalid @enderror form-control">
                  @error('image_profile')
                    <p style="color:red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-12 @error('timezone') has-error @enderror">
                  <label for="timezone" class="control-label">What is your local time zone?</label>
                  <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Reference: <b><a target="_blank" rel="noopener noreferrer" href="https://www.timeanddate.com/">timeanddate.com</a></b></p>
                  <select name="timezone" type="text" class="@error('timezone') is-invalid @enderror form-control select2">
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
              <div class="form-group">
                <hr>
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-flat" style="width:100%;">Submit</button>
                </div>
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
