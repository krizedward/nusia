@extends('layouts.admin.default')
@section('title','Registration Class')
@include('layouts.css_and_js.table')
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
            <div class="callout callout-warning">
                <h4>Class</h4>
                <form action="{{ route('registration.private-instructor') }}">
                    <button type="submit" class="btn btn-warning btn-block btn-flat">Select</button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="callout callout-default">
                <h4>Instructor</h4>
                <form action="{{ route('registration.private') }}">
                    <button type="submit" class="btn btn-block btn-default disabled">Select</button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="callout callout-default">
                <h4>Time</h4>
                <form action="#">
                    <button type="submit" class="btn btn-block btn-default disabled">Select</button>
                </form>
            </div>
        </div>

    </div>

    <div class="row">
        @foreach($data as $dt)
        <div class="col-md-4">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Free Trial - Class</h3>
                </div>
                <!-- /.box-header-->
                <div class="box-body">
                    <a href="{{ route('registration.private-instructor') }}">
                        <img class="img-responsive pad" src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="Photo">
                    </a>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-left">
                        <p>Description :</p>
                        <p>sad</p>
                    </div>
                    <div class="pull-right">
                        <p>Session : 00</p>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        @endforeach
    </div>
@stop
