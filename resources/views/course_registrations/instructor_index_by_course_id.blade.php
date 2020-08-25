@extends('layouts.admin.default')

@section('title','Instructor | Class Students')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>
        Class Students
    </b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('sessions.index') }}">Schedule</a></li>
        <li class="active">Class Students</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Information</h4>
                </div>
                <form>
                    <div class="box-body">
                        <dl>
                            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                            <dd>
                              This is a list of students<br>that have registered in the class.
                            </dd>
                        </dl>
                        <!--hr>
                        <dl>
                            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Note</dt>
                            <dd>Before starting each session, you must download the main materials.</dd>
                        </dl-->
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Students</h3>
                </div>
                <form>
                    <div class="box-body">
                        <table id="example1" class="table no-margin">
                            <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data->course_registrations as $dt)
                            <tr>
                                <td>{{ $dt->student->user->first_name }} {{ $dt->student->user->last_name }}</td>
                                <td><i>N/A</i></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
