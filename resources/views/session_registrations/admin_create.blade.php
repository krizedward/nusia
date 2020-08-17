@extends('layouts.admin.default')

@section('title','Admin | Session Registrations')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Session Registrations</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('session_registrations.index') }}">Session Registrations</a></li>
        <li class="active">Create</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Form</h3>
                </div>
                <form role="form" method="post" action="{{ route('session_registrations.store',[1]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{--
                            <div class="form-group">
                                <label>Session</label>
                                <input name="text" type="text" class="form-control">
                            </div>--}}
                            <div class="form-group">
                                <label>Session</label>
                                <select name="session_id" class="form-control select2">
                                    <option selected="" disabled="">Choose Session</option>
                                    @foreach($session as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--
                            <div class="form-group">
                                <label for="#text">Course Register</label>
                                <input name="text" type="text" class="form-control">
                            </div>--}}
                            <div class="form-group">
                                <label>Course</label>
                                <select name="course_id" class="form-control select2">
                                    <option selected="" disabled="">Choose Course</option>
                                    @foreach($course_registration as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </form>
            </div>
        </div>
    </div>
@stop
