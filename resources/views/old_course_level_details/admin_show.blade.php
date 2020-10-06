@extends('layouts.admin.default')

@section('title','Admin | Course Level Details | Detail')

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
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Course Name</strong>
                        <p>{{ $data->name }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Description</strong>
                        <p>{{ $data->description }}</p>
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