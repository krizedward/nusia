@extends('layouts.admin.default')

@section('title','Admin | Schedule Instructor')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Schedule Instructor</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('instructors.index') }}">Schedule</a></li>
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
                <form role="form" method="post" action="{{ route('schedules.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{--
                            <div class="form-group">
                                <label>Instructor</label>
                                <input name="text" type="text" class="form-control">
                            </div>--}}
                            <div class="form-group">
                                <label>Instructor</label>
                                <select name="instructor" class="form-control select2">
                                    <option selected="" disabled="">Choose Instructor</option>
                                    @foreach($instructor as $dt)
                                        <option value="{{$dt->id}}">{{$dt->user->first_name}} {{$dt->user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="#text">Schedule Time</label>
                                <input name="date" type="date" class="form-control">
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
