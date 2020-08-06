@extends('layouts.admin.default')

@section('title','Dashboard')

@include('layouts.css_and_js.dashboard')

@section('content')
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
        <div class="col-md-12">
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
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
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
    </div>
    <!-- /.row -->
@stop
