@extends('layouts.admin.default')

@section('title','Admin | Class Detail')

@include('layouts.css_and_js.table')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">{{ $data->title }}</h3>
                    <p class="text-muted text-center">Code : {{ $data->code }}</p>
                </div>
                <div class="box-body">
                    <a href="#" class="btn btn-danger btn-block"><b>Delete This Class</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Overview</a></li>
                    <li><a href="#form" data-toggle="tab">Form</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Course Name</strong>
                        <p>{{ $data->title }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Description</strong>
                        <p>{{ $data->description }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Student Min</strong>
                        <p>
                          {{ $data->course_package->course_type->count_student_min }}
                          @if($data->course_package->course_type->count_student_min == 1)
                            Student
                          @else
                            Students
                          @endif
                        </p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Student Max</strong>
                        <p>
                          {{ $data->course_package->course_type->count_student_max }}
                          @if($data->course_package->course_type->count_student_max == 1)
                            Student
                          @else
                            Students
                          @endif
                        </p>
                        <hr>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="form">
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