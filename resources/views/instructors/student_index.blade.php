@extends('layouts.admin.default')

@section('title','Student | Nusia Instructor')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Nusia Instructor</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Instructor</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-body">
                    <a href="#" data-toggle="modal" data-target="#1">
                        <img class="img-responsive pad" src="{{ url('uploads/instructor/pic1.png') }}" alt="Photo">
                    </a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="modal fade" id="1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('uploads/instructor/pic1.png') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">name</h3>

                            <p class="text-muted text-center">I am Your Instructor</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Professional Experiences</b>
                                    <p>
                                        Description
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <b>Interest</b>
                                    <p>
                                        Interest
                                    </p>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Choose</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
@stop
