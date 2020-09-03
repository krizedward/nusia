@extends('layouts.admin.default')

@section('title','Student | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Choose Your Private Class!</h1>
    <!--ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Choose Your Class!</li>
    </ol-->
@stop

@section('content')
    <div class="row">
        @foreach($course as $dt)
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ $dt->code }} - {{ $dt->title }}</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Number of Students Registered</b>
                            <p>{{ $dt->course_registrations->count() }}/{{ $dt->course_package->course_type->count_student_max }}</p>
                        </div>
                        <div class="col-md-12">
                            <a href="#" data-toggle="modal" data-target="#{{$dt->id}}" class="btn btn-s btn-default disabled" style="width:100%;">
                                Choose This Class
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop
