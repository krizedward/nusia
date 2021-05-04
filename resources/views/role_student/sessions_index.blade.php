@extends('layouts.admin.default')

@section('title','Schedules')

@include('layouts.css_and_js.all')

@section('content-header')
    <h1>Schedule</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Group</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Free Classes</h3>
                </div>
                <form>
                    <div class="box-body">
                        <dl>
                            <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                            <dd>According to the Terms and Conditions, you must attend all sessions since you cannot reschedule them.</dd>
                        </dl>
                        <hr>
                        <dl>
                            <dt><i class="fa fa-file-text-o margin-r-5"></i> Note</dt>
                            <dd>Before joining each session, you must download the main materials.</dd>
                        </dl>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Class Sessions</h3>
                </div>
                <form>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 120px">ID</th>
                                <th>Class</th>
                                <th style="width: 135px">Level</th>
                                <th>Session</th>
                                <th>Slot</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($session as $dt)
                            <tr>
                                <td>{{ $dt->id }}</td>
                                <td>{{ $dt->course->title }}</td>
                                <td>{{ $dt->course->course_package->course_level->name }} {{ $dt->course->course_package->course_level_detail->name }}</td>
                                <td>{{ $dt->course->course_package->count_session }}</td>
                                <td>{{ $dt->course->course_package->course_type->count_student_max }}</td>
                                <td>
                                    <form method="post" action="{{ route('session_registrations.store',[1]) }}">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $dt->course_id }}">
                                        <input type="hidden" name="student_id" value="{{ Auth::user()->student->id }}">
                                        <input type="hidden" name="session_id" value="{{ $dt->id }}">
                                        <button type="submit" class="btn btn-flat btn-xs btn-success">Choose</button>
                                    </form>
                                </td>
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

@section('content-old')
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
                                <th style="width: 100px">Session ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Session</th>
                                <th style="width: 40px">Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ __('none') }}</td>
                                <td>{{ __('none') }}</td>
                                <td>{{ __('none') }}</td>
                                <td>{{ __('none') }}</td>
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Link</a></td>
                            </tr>
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
