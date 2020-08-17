@extends('layouts.admin.default')

@section('title','Student | Sessions')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Session</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Group</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Free Trial Course</h3>
                </div>
                <form>
                    <div class="box-body">
                        <dl>
                            <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                            <dd>You can join 3 sessions of free trial courses with NUSIA.</dd>
                            <hr>
                            <dt><i class="fa fa-book margin-r-5"></i> Note</dt>
                            <dd>If you miss one meeting session, you cannot reschedule the session.</dd>
                            <hr>
                            <dt><i class="fa fa-pencil margin-r-5"></i> Feedback</dt>
                            <dd>After participating in EACH course session, please give us your feedback by clicking this
                                <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-info" href="https://www.google.com/intl/id_id/forms/about/">Link</a>
                            </dd>
                        </dl>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Course Sessions</h3>
                </div>
                <form>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 120px">Registration ID</th>
                                <th>Meeting Time</th>
                                <th style="width: 135px">Level</th>
                                <th>Session Name</th>
                                <th>Status</th>
                                <th style="width: 40px">Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->session->schedule->schedule_time }}</td>
                                <td>{{ $dt->course_registration->course->course_package->course_level->name }} {{ $dt->course_registration->course->course_package->course_level_detail->name }}</td>
                                @if($dt->session->title)
                                  <td>{{ $dt->session->title }}</td>
                                @elseif($dt->session->course->title)
                                  <td>{{ $dt->session->course->title }}</td>
                                @else
                                  <td>{{ $dt->session->course->course_package->title }}</td>
                                @endif
                                @if(now() < $dt->session->schedule->schedule_time)
                                  <td><label class="label label-warning">Upcoming</label></td>
                                @elseif($dt->status == 'Present')
                                  <td><label class="label label-success">Present</label></td>
                                @elseif($dt->status == 'Not Present')
                                  <td><label class="label label-danger">Not Present</label></td>
                                @endif
                                @if($dt->session->link_zoom)
                                  <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Link</a></td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <p>&nbsp;</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
