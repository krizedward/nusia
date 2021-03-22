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
            <?php $interest = explode(', ', Auth::user()->student->interest); sort($interest); ?>
            <strong><i class="fa fa-cube margin-r-5"></i>
              @if(count($interest) == 1)
                Interest
              @else
                Interests
              @endif
            </strong>
            @if(Auth::user()->student->interest)
              <p>
                @foreach($interest as $dt)
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
              <div class="form-group col-md-12">
                <div class="col-md-4">
                  <label for="age" class="control-label">Age (numbers only, in years)</label>
                </div>
                <div class="col-md-8">
                  <input name="age" type="text" class="@error('age') is-invalid @enderror form-control" placeholder="Enter your age (numbers only, in years)" value="@if(Auth::user()->student->age != 0){{ Auth::user()->student->age }}@else{{ old('age') }}@endif">
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-4">
                  <label for="domicile" class="control-label">Where do you live now?</label>
                </div>
                <div class="col-md-8">
                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter your domicile" value="@if(Auth::user()->domicile){{ Auth::user()->domicile }}@else{{ old('domicile') }}@endif">
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-4">
                  <label for="domicile" class="control-label">Where do you live now?</label>
                </div>
                <div class="col-md-8">
                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter your domicile" value="@if(Auth::user()->domicile){{ Auth::user()->domicile }}@else{{ old('domicile') }}@endif">
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-4">
                  <label for="image_profile" class="control-label">Image Profile</label>
                </div>
                <div class="col-md-8">
                  <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                  <input name="image_profile" type="file" class="@error('image_profile') is-invalid @enderror form-control">
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="col-md-4">
                  <label for="timezone" class="control-label">Time Zone</label>
                </div>
                <div class="col-md-8">
                  <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Reference: <b><a target="_blank" rel="noopener noreferrer" href="https://www.timeanddate.com/">timeanddate.com</a></b></p>
                  <select name="timezone" type="text" class="@error('timezone') is-invalid @enderror form-control select2">
                    <option selected="selected" value="">-- Enter Current Time Zone --</option>
                    @foreach($timezones as $timezone)
                      @if(old('timezone') == $timezone)
                        <option selected="selected" value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                      @else
                        <option value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-danger">Submit</button>
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
