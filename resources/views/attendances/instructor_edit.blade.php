@extends('layouts.admin.default')

@section('title','Student | Sessions')

{{-- @include('layouts.css_and_js.form_general') --}}

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Sessions</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Sessions</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <!--div class="box-header">
                    <h3 class="box-title">&nbsp;</h3>
                </div-->
                <form>
                    <div class="box-body">
                        <dl>
                            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                            <dd>
                              Click "link" button to join your session!<br>
                              <span style="color:#ff0000;">* Contact your instructors if you have a problem joining the sessions.</span>
                            </dd>
                            <hr>
                            <dt style="font-size:18px;"><i class="fa fa-book margin-r-5"></i> Note</dt>
                            <dd>If cannot attend a session, you cannot reschedule it.</dd>
                            <hr>
                            <dt style="font-size:18px;"><i class="fa fa-pencil margin-r-5"></i> Feedback</dt>
                            <dd>After participating in EACH session, please give us your feedback by clicking this
                                <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-info" href="https://docs.google.com/forms/d/e/1FAIpQLSeQcLORmDvpAuN-l0OmV5h5xRq0TkRpBbgCI-haYyl3cqCWrQ/viewform?usp=sf_link">Link</a>
                            </dd>
                        </dl>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Class Sessions</h3>
                </div>
                <form>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Class</th>
                                <th>Level</th>
                                <th>Session</th>
                                <th>Meeting Time</th>
                                <th>Status</th>
                                <th style="width: 40px">Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->session->course->title }}</td>
                                <td>{{ $dt->session->course->course_package->course_level->name }}</td>
                                <td>{{ $dt->session->title }}</td>
                                @if($dt->session->schedule->schedule_time)
                                  <?php
                                    $schedule_time = \Carbon\Carbon::parse($dt->session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                                  ?>
                                  <td>
                                    <span class="hidden">{{ $schedule_time->isoFormat('YYMMDDAhhmm') }}</span>
                                    {{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}
                                  </td>
                                @else
                                  <td><i>N/A</i></td>
                                @endif
                                @if($dt->status == 'Not Assigned')
                                  @if(now() < $schedule_time)
                                    <td><label class="badge bg-gray">Upcoming</label></td>
                                  @elseif(now() > $schedule_time->add(80, 'minutes'))
                                    <td><label class="badge bg-red">Not Present</label></td>
                                  @else
                                    <td><label class="badge bg-yellow">Ongoing</label></td>
                                  @endif
                                @elseif($dt->status == 'Not Present')
                                    <td><label class="badge bg-red">Not Present</label></td>
                                @elseif($dt->status == 'Should Submit Form')
                                  <td><label class="badge bg-purple">Should Submit Form</label></td>
                                @elseif($dt->status == 'Present')
                                  <td><label class="badge bg-green">Present</label></td>
                                @endif
                                @if(now() <= $schedule_time->add(80, 'minutes'))
                                  @if($dt->session->link_zoom)
                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->session->link_zoom }}">Link</a></td>
                                  @else
                                    <td><i>N/A</i></td>
                                  @endif
                                @else
                                  @if($dt->status == 'Should Submit Form')
                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('form_responses.create', [$dt->id]) }}">Form Link</a></td>
                                  @else
                                    <td><i>N/A</i></td>
                                  @endif
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
