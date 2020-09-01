@extends('layouts.admin.default')

@section('title','Student | Profile')

@include('layouts.css_and_js.table')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(Auth::user()->image_profile != 'user.jpg')
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.Auth::user()->image_profile) }}" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.Auth::user()->image_profile) }}" alt="User profile picture">
                    @endif

                    <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->roles }} Nusia</p>

                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="active tab-pane">
                        {{--None--}}
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Email</strong>
                        <p>asd</p>
                        <hr>
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
