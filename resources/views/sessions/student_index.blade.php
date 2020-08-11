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