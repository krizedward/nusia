@extends('layouts.admin.default')
@section('title','Registration Time')
@include('layouts.css_and_js.calendar')
@section('content-header')
    <h1>Registration Private Class</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Registration</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="callout callout-info">
                <h4>Class</h4>
                <form action="{{ route('registration.private') }}">
                    <button type="submit" class="btn btn-info btn-block btn-flat">Select</button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="callout callout-info">
                <h4>Instructor</h4>
                <form action="{{ route('registration.private-instructor') }}">
                    <button type="submit" class="btn btn-block btn-info">Select</button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="callout callout-warning">
                <h4>Time</h4>
                <form action="#">
                    <button type="submit" class="btn btn-block btn-warning">Select</button>
                </form>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
