@extends('layouts.admin.default')

@section('title','Admin | Student Profile')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1><b>Student Profile</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('students.index') }}">Student</a></li>
        <li class="active">Detail</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body">
                  @if($data->user->image_profile != 'user.jpg')
                    <img class="img-responsive pad" src="{{ asset('uploads/student/profile/'.$data->user->image_profile) }}" alt="Photo">
                  @else
                    <img class="img-responsive pad" src="{{ asset('uploads/user.jpg') }}" alt="Photo">
                  @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Data</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Name:</strong>
                        <p>
                            {{ $data->user->first_name }} {{ $data->user->last_name }}
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Citizenship:</strong>
                        <p>
                            @if($data->citizenship != 'Not Available')
                              {{ $data->user->citizenship }}
                            @else
                              <i>Not Available</i>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Age:</strong>
                        <p>
                            @if($data->age != 0)
                              {{ $data->age }}
                            @else
                              <i>Not Available</i>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Interest:</strong>
                        <br>
                        <p>
                            @if($data->interest)
                                <?php
                                $interest = explode(', ', $data->interest);
                                ?>
                                @for($i = 0; $i < count($interest); $i = $i + 1)
                                  {{ $i + 1 }}. {{ $interest[$i] }}
                                    @if($i + 1 != count($interest))
                                         <br>
                                    @endif
                                @endfor
                            @else
                                <i>Not Available</i>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Job Status:</strong>
                        <p>
                            @if($data->status_description)
                              {{ $data->status_job }} at {{ $data->status_description }}
                            @else
                              <i>Not Available</i>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Indonesian Language Proficiency:</strong>
                        <p>
                            @if($data->age != 0)
                              {{ $data->indonesian_language_proficiency }}
                            @else
                              <i>Not Available</i>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Target Language Experience:</strong>
                        <p>
                          @if($data->age != 0)
                            @if($data->target_language_experience != 'Others')
                              {{ $data->target_language_experience }}
                            @else
                              {{ $data->target_language_experience_value }}
                              @if($data->target_language_experience_value == 1)
                                year
                              @else
                                years
                              @endif
                            @endif
                          @else
                            <i>Not Available</i>
                          @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Description of Course Taken:</strong>
                        <p>
                            @if($data->description_of_course_taken)
                              {{ $data->description_of_course_taken }}
                            @else
                              <i>Not Available</i>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Learning Objective:</strong>
                        <p>
                            @if($data->learning_objective)
                              {{ $data->learning_objective }}
                            @else
                              <i>Not Available</i>
                            @endif
                        </p>
                        <!--hr-->
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

