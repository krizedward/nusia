@extends('layouts.admin.default')

@section('title','Admin | Sessions')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Sessions</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Sessions</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('sessions.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Instructor</th>
                            <th>Meeting Time</th>
                            <th>Course</th>
                            <th>Session Name</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>

                        @foreach($data as $dt)
                            <tr>
                                <td>#</td>
                                <td>{{ $dt->schedule->instructor->user->first_name }} {{ $dt->schedule->instructor->user->last_name }}</td>
                                <td>{{ $dt->schedule->schedule_time }}</td>
                                <td>{{ $dt->course->course_package->course_level->name }}-{{ $dt->course->course_package->course_level_detail->name }}</td>
                                <td>{{ $dt->title }}</td>
                            </tr>
                        @endforeach
                        {{-- body content --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
