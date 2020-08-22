@extends('layouts.admin.default')

@section('title','Dashboard')

@include('layouts.css_and_js.dashboard')

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Our time: <span id="time_nusia">{{ $timeNusia->isoFormat('h:mm A') }}</span></h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-dismissible">
                <h4 class="text-center"><i class="icon fa fa-clock-o"></i> Your time: <span id="time_student">{{ $timeStudent->isoFormat('h:mm A') }}</span></h4>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-book"></i> Notification!</h4>
                Student Yang Mendaftar Akan Mendapatkan Kesempatan Untuk Free 3 Session Sesuai Dengan Quisioner.
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- col-6 -->
        <div class="col-md-6">
            <!-- TABLE: Sessions Instructor -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Student</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Language Experience</th>
                                <th>Language Proficiency</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($student as $dt)
                                <tr>
                                    <td>{{ $dt->code }}</td>
                                    <td>{{ $dt->user->first_name }}</td>
                                    <td>{{ $dt->user->last_name }}</td>
                                    <td>{{ $dt->target_language_experience }}</td>
                                    <td>{{ $dt->indonesian_language_proficiency }}</td>
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

        <!-- col-6 -->
        <div class="col-md-6">
            <!-- TABLE: Sessions Instructor -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Instructor</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Instructor ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instructor as $dt)
                                <tr>
                                    <td>{{ $dt->code }}</td>
                                    <td>{{ $dt->user->first_name }}</td>
                                    <td>{{ $dt->user->last_name }}</td>
                                    <td>{{ $dt->user->email }}</td>
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
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- col-6 -->
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Session</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Meeting Time</th>
                                <th>Course</th>
                                <th>Session Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($session as $dt)
                                <tr>
                                    <td>{{ $dt->code }}</td>
                                    <td>{{ $dt->schedule->schedule_time }}</td>
                                    <td>{{ $dt->course->course_package->course_level->name }}-{{ $dt->course->course_package->course_level_detail->name }}</td>
                                    <td>{{ $dt->title }}</td>
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

        <!-- col-6 -->
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Schedule</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Course</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($session_reg as $dt)
                                <tr>
                                    <td>#</td>
                                    <td>{{ $dt->course_registration->student->user->first_name }}</td>
                                    <td>{{ $dt->course_registration->course->course_package->course_level->name }} {{ $dt->course_registration->course->course_package->course_level_detail->name }}</td>
                                    <td>{{ __('3 Student') }}</td>
                                    <td>{{ $dt->session->title }}</td>
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
    </div>
    <!-- /.row -->
@stop
