@extends('layouts.admin.default')

@section('title','Student | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Choose Your Private Class!</h1>
    <!--ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Choose Your Class!</li>
    </ol-->
@stop

@section('content')
    <div class="row">
        @foreach($data as $dt)
            <?php $flag = 1; ?>
            @foreach($dt->sessions as $s)
                <?php
                $schedule_time = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                if(now() >= $schedule_time) {
                    $flag = 0;
                    break;
                }
                ?>
            @endforeach
            <?php if($flag == 0) continue; ?>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ $dt->code }} - {{ $dt->title }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <b>Description</b>
                                <p>{{ $dt->description }}</p>
                            </div>
                            <div class="col-md-12">
                                <b>Requirement</b>
                                <p>{{ $dt->requirement }}</p>
                            </div>
                            <div class="col-md-12">
                                <b>Number of Students Registered</b>
                                <p>{{ $dt->course_registrations->count() }}/{{ $dt->course_package->course_type->count_student_max }}</p>
                            </div>
                            <div class="col-md-12">
                                @if($dt->course_registrations->count() < $dt->course_package->course_type->count_student_max)
                                    <a href="#" data-toggle="modal" data-target="#{{$dt->id}}" class="btn btn-s btn-primary" style="width:100%;">
                                        Choose This Class
                                    </a>
                                @else
                                    <a href="#" data-toggle="modal" data-target="#{{$dt->id}}" class="btn btn-s btn-default disabled" style="width:100%;">
                                        Choose This Class
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="modal fade" id="{{$dt->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <h3 class="profile-username text-center">Terms of Service</h3>

                                <!--p class="text-muted text-center">More description here...</p-->

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <ol>
                                            <li>&nbsp;&nbsp;&nbsp;Learners must attend all sessions in NUSIA's free classes.<br>&nbsp;&nbsp;&nbsp;If learners cannot attend some of them, they cannot reschedule the sessions.</li>
                                            <li>&nbsp;&nbsp;&nbsp;Learners must read the learning materials on the dashboard before joining each session.</li>
                                            <li>&nbsp;&nbsp;&nbsp;Learners must give feedback on the link provided in the dashboard<br>&nbsp;&nbsp;&nbsp;after finishing each session.</li>
                                            <li>&nbsp;&nbsp;&nbsp;All sessions in the free classes are recorded.<br>&nbsp;&nbsp;&nbsp;Learners allow NUSIA to employ the video recordings for research and marketing purposes<br>&nbsp;&nbsp;&nbsp;(If you disagree with this term, please contact us via email on <a href="mailto:nusia.helpdesk@gmail.com">nusia.helpdesk@gmail.com</a>.)</li>
                                        </ol>
                                    </li>
                                </ul>

                                <form action="{{ route('course_payments.store',Auth::user()->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $dt->id }}" name="course_id">
                                    <input type="hidden" value="{{ Auth::user()->student->id }}" name="student_id">
                                    <input type="checkbox" value="false" onclick="checkboxClick(this);" id="flag" name="flag" class="minimal">&nbsp;&nbsp;I have read and agree to the Terms of Service
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-s btn-primary" style="width:100%;">Agree and Continue</button>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        @endforeach
    </div>
    <script>
        function checkboxClick(cb) {
            document.getElementById("flag").value = cb.checked;
        }
    </script>
@stop
