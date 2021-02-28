@extends('layouts.admin.default')

@section('title','Admin | Schedule')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Schedule</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Instructor Name</th>
                            <th>Date</th>
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
                                <td>{{ date("d F Y", strtotime($dt->schedule_time)) }}</td>
                                <td>{{ date("h:i A", strtotime($dt->schedule_time)) }}</td>
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
