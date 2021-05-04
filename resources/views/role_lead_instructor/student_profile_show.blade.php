@extends('layouts.admin.default')

@section('title','Student | Profile')

@include('layouts.css_and_js.all')

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
                  @if($student->user->image_profile != 'user.jpg')
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.$student->user->image_profile) }}" alt="User profile picture">
                  @else
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.$student->user->image_profile) }}" alt="User profile picture">
                  @endif

                    <h3 class="profile-username text-center">{{ $student->user->first_name }} {{ $student->user->last_name }}</h3>

                    <p class="text-muted text-center">{{ $student->user->roles }} Nusia</p>

                </div>
                <!-- About Me Box -->
                <!-- /.box-body -->
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p>{{ $student->user->email }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Nationality</strong>
                    <p class="text-muted">{{ $student->user->citizenship }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Where do you live now</strong>
                    <p class="text-muted">{{ $student->user->domicile }}</p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Interest</strong>

                                @if($student->interest)
                                    <?php
                                    $interest = explode(', ', $student->interest);
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
                        <span class="label label-success">{{ $student->interest }}</span>
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
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        {{--None--}}
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Email</strong>
                            <p>{{ $student->user->email }}</p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Nationality</strong>
                            <p>
                                @if($student->user->citizenship != 'Not Available')
                                  {{ $student->user->citizenship }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Where do you live now</strong>
                            <p>
                                @if($student->user->domicile)
                                  {{ $student->user->domicile }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Age</strong>
                            <p>
                                @if($student->age != 0)
                                  {{ $student->age }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Interest</strong>
                                @if($student->interest)
                                    <?php
                                    $interest = explode(', ', $student->interest);
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
                                    <p><i>N/A</i></p>
                                @endif
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Job Status</strong>
                            <p>
                                @if($student->status_description)
                                  {{ $student->status_job }} at {{ $student->status_description }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Indonesia Language Proficiency</strong>
                            <p>
                                @if($student->age != 0)
                                  {{ $student->indonesian_language_proficiency }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Target Language Experience</strong>
                            <p>
                              @if($student->age != 0)
                                @if($student->target_language_experience != 'Others')
                                  {{ $student->target_language_experience }}
                                @else
                                  {{ $student->target_language_experience_value }}
                                  @if($student->target_language_experience_value == 1)
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

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Description of Course Taken</strong>
                            <p>
                                @if($student->description_of_course_taken)
                                  {{ $student->description_of_course_taken }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <hr>

                            <strong><i class="fa fa-circle-o margin-r-5"></i> Learning Objective</strong>
                            <p>
                                @if($student->learning_objective)
                                  {{ $student->learning_objective }}
                                @else
                                  <i>N/A</i>
                                @endif
                            </p>
                            <!--hr-->
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
