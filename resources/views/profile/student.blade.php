@extends('layouts.admin.default')

@section('title','Student | Profile')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Profile</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Profile</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->roles }} Nusia</p>

                </div>
                <!-- About Me Box -->
                <!-- /.box-body -->
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p>{{ Auth::user()->email }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Citizenship</strong>
                    <p class="text-muted">{{ Auth::user()->citizenship }}</p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Interest</strong>
                    <p>
                        <span class="label label-success">Reading</span>
                        <span class="label label-success">Swimming</span>
                    </p>
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
                        {{--None--}}
                        @foreach($student as $dt)
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Email</strong>
                            <p>{{ $dt->user->email }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Citizenship</strong>
                            <p>{{ $dt->user->citizenship }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Interest</strong>
                            <p>{{ $dt->interest }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Age</strong>
                            <p>{{ $dt->age }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Job Status</strong>
                            <p>{{ $dt->status_job }} - {{ $dt->status_description }}</p>
                            <hr>
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Indonesia Language Proficiency</strong>
                            <p>{{ $dt->indonesian_language_proficiency }}</p>
                            <hr>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="form">
                        <form role="form" method="post" action="{{ route('instructors.update',$dt->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{--none--}}
                            <p>On Progress</p>
                        </form>
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
