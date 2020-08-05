@extends('layouts.admin.default')
@section('title','Session Index')
@include('layouts.css_and_js.table')
@section('content-header')
    <h1>Session Group</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Session</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Session</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Instructor Name</th>
                            <th>Course Title</th>
                            <th>Session Title</th>
                            <th>Schedule Time</th>
                            <th>Description</th>
                            <th>Zoom Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->schedule->instructor->user->first_name }} {{ $dt->schedule->instructor->user->last_name }}</td>
                                @if($dt->course->title)
                                    <td>{{ $dt->course->title }}</td>
                                @else
                                    <td>{{ $dt->course->course_package->title }}</td>
                                @endif
                                @if($dt->title)
                                    <td>{{ $dt->title }}</td>
                                @else
                                    <?php
                                    $number = 1;
                                    foreach($dt->course->sessions as $d) {
                                        if($d->slug == $dt->slug) break;
                                        $number = $number + 1;
                                    }
                                    ?>
                                    <td>Session {{ $number }}</td>
                                @endif
                                <td>{{ $dt->schedule->schedule_time }}</td>
                                @if($dt->description)
                                    <td>{{ $dt->description }}</td>
                                @else
                                    <td><i>Not Available</i></td>
                                @endif
                                @if($dt->link_zoom)
                                    <td>{{ $dt->link_zoom }}</td>
                                @else
                                    <td><i>Not Available</i></td>
                                @endif
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
