@extends('layouts.admin.default')

@section('title','Student | Schedule')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Schedule Group</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Schedule Group</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Information</h4>
                </div>
                <form>
                    <div class="box-body">
                        <dl>
                            <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                            <dd>You can join 3 sessions of free trial courses with NUSIA.</dd>
                        </dl>
                        <hr>
                        <dl>
                            <dt><i class="fa fa-file-text-o margin-r-5"></i> Note</dt>
                            <dd>Before starting each session, you must download the main materials.</dd>
                        </dl>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Courses</h3>
                </div>
                <form>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 120px">Registration ID</th>
                                <th>Course Name</th>
                                <th style="width: 135px">Level</th>
                                <th>Slot</th>
                                <th>Session</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                            @foreach($course_registrations as $cr)
                              <tr>
                                @if($cr->code)
                                  <td>{{ $cr->code }}</td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                @if($cr->course->title)
                                  <td>{{ $cr->course->title }}</td>
                                @else
                                  <td>{{ $cr->course->course_package->title }}</td>
                                @endif
                                <td>{{ $cr->course->course_package->course_level->name.' '.$cr->course->course_package->course_level_detail->name }}</td>
                                @if($cr->course->course_package->course_type->count_student_max)
                                  <td>{{ $cr->course->course_package->course_type->count_student_max }}</td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                @if($cr->course->course_package->count_session)
                                  <td>{{ $cr->course->course_package->count_session }}</td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                              </tr>
                            @endforeach
                            <!--tr>
                                <td>SREG001</td>
                                <td>Novice</td>
                                <td>Low</td>
                                <td>2 Student</td>
                                <td>2 Session</td>
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                            </tr>
                            <tr>
                                <td>SREG002</td>
                                <td>Novice</td>
                                <td>Low</td>
                                <td>2 Student</td>
                                <td>3 Session</td>
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                            </tr-->
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
