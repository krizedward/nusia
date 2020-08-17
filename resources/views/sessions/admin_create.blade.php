@extends('layouts.admin.default')

@section('title','Admin | Session Registrations')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Sessions</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('sessions.index') }}">Sessions</a></li>
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
                <form role="form" method="post" action="{{ route('sessions.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{--
                            <div class="form-group">
                                <label>Course</label>
                                <input name="text" type="text" class="form-control">
                            </div>--}}
                            <div class="form-group">
                                <label>Course</label>
                                <select name="course" class="form-control select2">
                                    <option selected="" disabled="">Choose Course</option>
                                    @foreach($course as $dt)
                                        <option value="{{$dt->id}}">{{$dt->course_package->course_level->name }}-{{$dt->course_package->course_level_detail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input name="title" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--
                            <div class="form-group">
                                <label>Schedule</label>
                                <input name="text" type="text" class="form-control">
                            </div>
                            --}}
                            <div class="form-group">
                                <label>Schedule</label>
                                <select name="schedule" class="form-control select2">
                                    <option selected="" disabled="">Choose Schedule</option>
                                    @foreach($schedule as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->schedule_time }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descriptions</label>
                                <input name="description" type="text" class="form-control">
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
