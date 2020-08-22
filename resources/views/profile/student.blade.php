@extends('layouts.admin.default')

@section('title','Student | Profile')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Profile</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Profile</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.Auth::user()->image_profile) }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->roles }} Nusia</p>

                </div>
                <!-- About Me Box -->
                <!-- /.box-body -->
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p>{{ Auth::user()->email }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Citizenship</strong>
                    <p class="text-muted">{{ Auth::user()->citizenship }}</p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Interest</strong>

                                @if(Auth::user()->student->interest)
                                    <?php
                                    $interest = explode(', ', Auth::user()->student->interest);
                                    ?>
                                    <p>
                                      @for($i = 0; $i < count($interest); $i = $i + 1)
                                        <span class="label label-success">{{ $interest[$i] }}</span>
                                      @endfor
                                    </p>
                                @else
                                    <p><i>Not Available</i></p>
                                @endif

                    <!--p>
                        <span class="label label-success">{{ Auth::user()->student->interest }}</span>
                    </p-->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Detail</a></li>
                    <li><a href="#form" data-toggle="tab">Form</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        {{--None--}}
                        @foreach($student as $dt)
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Email</strong>
                            <p>{{ $dt->user->email }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Citizenship</strong>
                            <p>{{ $dt->user->citizenship }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Interest</strong>

                                @if(Auth::user()->student->interest)
                                    <?php
                                    $interest = explode(', ', Auth::user()->student->interest);
                                    ?>
                                    <p>
                                      @for($i = 0; $i < count($interest); $i = $i + 1)
                                        {{ $i + 1 }}. {{ $interest[$i] }}
                                        @if($i + 1 != count($interest))
                                          <br>
                                        @endif
                                      @endfor
                                    </p>
                                @else
                                    <p><i>Not Available</i></p>
                                @endif

                            <!--p>{{ $dt->interest }}</p-->
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Age</strong>
                            <p>{{ $dt->age }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Job Status</strong>
                            <p>{{ $dt->status_job }} - {{ $dt->status_description }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Indonesia Language Proficiency</strong>
                            <p>{{ $dt->indonesian_language_proficiency }}</p>
                            <hr>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="form">
                        <form class="form-horizontal" role="form" method="post" action="{{ route('students.update',$dt->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{--none
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" value="{{ $dt->user->email }}" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Image Profile</label>

                                <div class="col-sm-10">
                                    <input name="image_profile" type="file" class="@error('image_profile') is-invalid @enderror form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Time Zone</label>

                                <div class="col-sm-10">
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
                                <div class="col-sm-offset-2 col-sm-10">
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
