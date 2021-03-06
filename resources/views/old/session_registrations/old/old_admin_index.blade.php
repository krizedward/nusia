@extends('layouts.admin.default')

@section('title','Admin | Session Registration')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Session Registration</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Session Registration</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('session_registrations.create',[1]) }}" class="btn btn-flat btn-sm btn-primary">+ Add</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Slot</th>
                            <th>Session</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>#</td>
                                <td>{{ $dt->course_registration->student->user->first_name }}</td>
                                <td>{{ $dt->course_registration->course->course_package->course_level->name }} {{ $dt->course_registration->course->course_package->course_level_detail->name }}</td>
                                <td>{{ __('3 Student') }}</td>
                                <td>{{ $dt->session->title }}</td>
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
