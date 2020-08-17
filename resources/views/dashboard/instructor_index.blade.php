@extends('layouts.admin.default')

@section('title','Dashboard')

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-book"></i> Notification!</h4>
                Pengajar Instructor harus mengisi link zoom untuk mengajar.
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
            <!-- TABLE: Sessions Instructor -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Courses</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table no-margin">
                            <thead>
                            <tr>
                                <th style="width:65px;">Session ID</th>
                                <th>Level</th>
                                <th>Session Name</th>
                                <th>Schedule</th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($session_reg as $dt)
                                <tr>
                                    <td>{{ $dt->code }}</td>
                                    <td>{{ $dt->session->course->course_package->course_level->name }} {{ $dt->session->course->course_package->course_level_detail->name }}</td>
                                    {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                                    @if($dt->session->title)
                                      <td>{{ $dt->session->title }}</td>
                                    @elseif($dt->session->course->title)
                                      <td>{{ $dt->session->course->title }}</td>
                                    @else
                                      <td>{{ $dt->session->course->course_package->title }}</td>
                                    @endif
                                    <td>{{ date('d M Y', strtotime($dt->session->schedule->schedule_time)) }}</td>
                                    @if($dt->session->link_zoom)
                                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Link</a></td>
                                    @else
                                      <td><i>N/A</i></td>
                                    @endif
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
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Reminder for course sessions</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                              @if($session_reg_order_by_schedule_time)
                                @foreach($session_reg_order_by_schedule_time as $dt)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <div class="product-title">{{ $dt->session->course->course_package->title }} - {{ $dt->session->name }}
                                                <span class="label label-info pull-right">{{ date('d M Y', strtotime($dt->session->schedule->schedule_time)) }}</span></div>
                                            <span class="product-description">
                                                Note : Don't forget to get in touch soon!
                                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                @endforeach
                              @else
                                <div style="color:#555555">
                                  No courses available. You may join one first!
                                </div>
                              @endif
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
                <div class="col-md-6">
                    <!-- STUDENT LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Course</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @foreach($session_reg as $dt)
                                    <li>
                                        <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                        <span class="users-list-name" href="#">{{ $dt->course_registration->student->user->first_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="#" class="uppercase">View All Student</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-star"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Rating</span>
                    <span class="info-box-number">5.0</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Total 100% in Perfect
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Session Done</span>
                    <span class="info-box-number">0</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
