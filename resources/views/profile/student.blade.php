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
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">

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
                    <strong><i class="fa  fa-phone margin-r-5"></i> Phone</strong>
                    <p class="text-muted">{{ Auth::user()->phone }}</p>
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
                    <li class="active"><a href="#student" data-toggle="tab">Detail</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="student">


                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>age</th>
                                <th>status_job</th>
                                <th>status_description</th>
                                <th>status_value</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $dt)
                            <tr>
                                <td>{{ $dt->age }}</td>
                                <td>{{ $dt->status_job }}</td>
                                <td>{{ $dt->status_description }}</td>
                                <td>{{ $dt->status_value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
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
