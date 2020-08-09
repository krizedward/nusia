@extends('layouts.admin.default')

@section('title','Dashboard')

@include('layouts.css_and_js.dashboard')

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-book"></i> Notification!</h4>
                Nusia akan memberikan kesempatan 3 kelas gratis dengan memilih kelas bebas.
            </div>
        </div>
        <!-- Left col -->
        <div class="col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Courses</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Session ID</th>
                                <th>Course</th>
                                <th>Level</th>
                                <th>Session</th>
                                <th>Schedule</th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($session as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->course->course_level }}</td>
                                <td>{{ $dt->course->course_level_detail }}</td>
                                <td>{{ $dt->session_meet }}</td>
                                <td>{{ date('d M Y', strtotime($dt->schedule->schedule_time)) }}</td>
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Link</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="#" class="btn btn-sm btn-info btn-flat pull-left">View All Data</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <!-- Session-Course Reminder -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Reminder for course sessions</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($session as $dt)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <div class="product-title">{{ $dt->course->course_level }} - {{ $dt->session_meet }}
                                    <span class="label label-info pull-right">{{ date('d M Y', strtotime($dt->schedule->schedule_time)) }}</span></div>
                                <span class="product-description">
                                    Note : don't forget to join class.
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#" class="uppercase">View All Data</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <div class="col-md-4">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Nusia Instructor</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        @foreach($session as $dt)
                        <li>
                            <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Image">
                            <span class="users-list-name" href="#">{{ $dt->schedule->instructor->user->first_name }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#  " class="uppercase">View All Instructor</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <!-- Session-Course Reminder -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Download Course Materials</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($material as $dt)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <div class="product-title">{{ $dt->session->course->course_level }} - {{ $dt->session->session_meet }}</div>
                                <span class="product-description">
                                    <a target="_blank" rel="noopener noreferrer" href="{{ route('material.download',$dt->id) }}">Download</a>
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#" class="uppercase">View All Data</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
