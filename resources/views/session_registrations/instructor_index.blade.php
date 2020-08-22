@extends('layouts.admin.default')

@section('title','Instructor | Schedule')

@include('layouts.css_and_js.table')

{{-- @include('layouts.css_and_js.form_advanced') --}}

{{--Session di Sidebar--}}
@section('content-header')
    <h1><b>Session</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Free Trial</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Link Zoom Session</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('sessions.update',1) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Session In</label>
                            {{--
                            <select class="form-control select2" name="user">
                                <option selected="" disabled="">Session In</option>
                                <option>[kode] - Free Trial Course</option>
                                <option>[kode] - Novice-Low Private</option>
                            </select>
                            --}}
                            <select name="session_registration" class="form-control select2">
                                <option selected="" disabled="">Choose Schedule</option>
                                @foreach($data as $dt)
                                    <option value="{{ $dt->id }}">
                                      [ {{ $dt->course->course_package->course_level->name }} ] {{ $dt->course->title }} - {{ $dt->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Link Zoom</label>
                            <input name="link_zoom" type="text" class="form-control" placeholder="Link Zoom.." value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <!-- Session-Course Reminder -->
            <div class="box box-warning">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Class</th>
                            <th>Level</th>
                            <th>Session</th>
                            <th>Meeting Time</th>
                            <th style="width: 40px">Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--Menampilkan dara dari SessionRegistrattionController--}}
                        @foreach($data as $dt)
                        <tr>
                            <td>{{ $dt->course->title }}</td>
                            <td>{{ $dt->course->course_package->course_level->name }}</td>
                            <td>{{ $dt->title }}</td>
                            @if($dt->schedule->schedule_time)
                              <?php
                                $schedule_time = \Carbon\Carbon::parse($dt->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                              ?>
                              <td>
                                <span class="hidden">{{ $schedule_time->isoFormat('YYMMDD') }}</span>
                                {{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
                              </td>
                            @else
                              <td><i>N/A</i></td>
                            @endif
                            @if($dt->link_zoom)
                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Link</a></td>
                            @else
                                <td><i>N/A</i></td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop
