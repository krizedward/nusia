@extends('layouts.admin.default')

@section('title','Admin | Schedule')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Schedule Instructor</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Schedule</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('schedules.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Instructor Name</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}</td>
                                <td>{{ $dt->schedule_time }}</td>
                                <td>{{ $dt->status }}</td>
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
