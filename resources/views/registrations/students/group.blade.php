@extends('layouts.admin.default')
@section('title','Schedule Index')
@include('layouts.css_and_js.table')
@section('content-header')
    <h1>Registration Group Class</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Registration</li>
    </ol>
@stop

@section('content')
    <div class="row">
        @foreach($data as $dt)
        <div class="col-md-4">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Trial - Class</h3>
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
