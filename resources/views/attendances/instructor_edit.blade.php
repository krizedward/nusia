@extends('layouts.admin.default')

@section('title','Attendance')

{{-- @include('layouts.css_and_js.form_general') --}}

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Attendance</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Sessions</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <!--div class="box-header">
                    <h3 class="box-title">&nbsp;</h3>
                </div-->
                <form>
                    <div class="box-body">
                        <dl>
                            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Attendance</dt>
                            <dd>
                              You may check the students attendances here.
                            </dd>
                            <!--hr>
                            <dt style="font-size:18px;"><i class="fa fa-book margin-r-5"></i> Note</dt>
                            <dd>If cannot attend a session, you cannot reschedule it.</dd-->
                        </dl>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">List of Students</h3>
                </div>
                <form method="POST" action="{{ route('attendances.update', $session->id) }}">
                  @csrf
                  @method('PUT')
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Student Name</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($session->course->course_registrations as $cr)
                            <tr>
                                <td>{{ $cr->student->user->first_name }} {{ $cr->student->user->last_name }}</td>
                                <td><input type="checkbox" value="1"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                      <input type="submit" class="btn btn-submit btn-xs btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
