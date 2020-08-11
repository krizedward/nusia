@extends('layouts.admin.default')

@section('title','Instructor | Session')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Schedule Group</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('session_registrations.index',[1]) }}">Free Trial</a></li>
        <li class="active">Detail</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Courses</h3>
                </div>
                <form>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">Code</th>
                                <th>Course</th>
                                <th>Level</th>
                                <th>Slot</th>
                                <th>Session</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>SREG002</td>
                                <td>Novice</td>
                                <td>Low</td>
                                <td>2 Student</td>
                                <td>3 Session</td>
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
