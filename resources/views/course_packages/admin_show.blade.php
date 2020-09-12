@extends('layouts.admin.default')

@section('title','Admin | Course Packages | Detail')

@include('layouts.css_and_js.table')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">Courses Package</h3>
                    <p class="text-muted text-center">Code : {{ $data->code }}</p>
                </div>
                <div class="box-body">
                    <a href="#" class="btn btn-danger btn-block"><b>Delete</b></a>
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
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Course Type</strong>
                        <p>{{ $data->course_type->name }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Course Level</strong>
                        <p>{{ $data->course_level->name }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Course Level Detail</strong>
                        <p>{{ $data->course_level_detail->name }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Count Session</strong>
                        <p>{{ $data->count_session }} Session</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Course Price</strong>
                        <p>${{ $data->price }}</p>
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