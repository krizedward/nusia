@extends('layouts.admin.default')
@section('title','Schedule Index')
@include('layouts.css_and_js.table')
@section('content-header')
    <h1>Schedule Private Class</h1>
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
                    <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Schedule</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Instructor Name</th>
                            <th>Schedule Time</th>
                            <th>Schedule Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->instructor->user->first_name }} {{ $dt->instructor->user->last_name }}</td>
                                <td>{{ $dt->schedule_time }}</td>
                                <td>{{ $dt->status }}</td>
                                <td>
                                    <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
                                    <a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
