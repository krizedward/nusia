@extends('layouts.admin.default')

@section('title','Student | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Choose Your Course!</h1>
    <!--ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Choose Your Course!</li>
    </ol-->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissable">
            <h4>
              <i class="icon fa fa-comments"></i>
              Choose a course that matches your need!
            </h4>
            Join one of NUSIA's courses consisting of <b>more than 3 sessions per class</b>! Per session lasts <b>80 minutes</b>.
          </div>
        </div>
        @foreach($material_types as $i => $mt)
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ $mt->name }}</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12" style="height:186px;">
                      <b>Description</b>
                      <p>{{ $mt->description }}</p>
                    </div>
                    <div class="col-md-12">
                      <a href="{{ route('course_packages.index_material_type', $mt->id) }}" class="btn btn-s btn-flat btn-primary" style="width:100%;">
                        Choose This Course
                      </a>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
        @endforeach
    </div>
@stop