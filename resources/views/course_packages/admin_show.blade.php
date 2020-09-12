@extends('layouts.admin.default')

@section('title','Admin | Class Package Detail')

@include('layouts.css_and_js.table')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center"><b>{{ $data->title }}</b></h3>
                    <p class="text-muted text-center">Code : {{ $data->code }}</p>
                </div>
                <div class="box-body">
                    <a href="#" class="btn btn-danger btn-block"><b>Delete This Class Package</b></a>
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
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Class Type</strong>
                        <p>{{ $data->course_type->name }}</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Class Level</strong>
                        <p>
                          @if($data->course_level_detail->name != 'General')
                            {{ $data->course_level->name }}{{ $data->course_level_detail->name }}
                          @else
                            {{ $data->course_level->name }}
                          @endif
                        </p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Total Available Session(s)</strong>
                        <p>{{ $data->count_session }} @if($data->count_session == 1) Session @else Sessions @endif</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i>Class Price</strong>
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