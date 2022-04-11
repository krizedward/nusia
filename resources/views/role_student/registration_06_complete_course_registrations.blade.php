@extends('layouts.admin.default')

@section('title', 'Completing Course Registrations')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Complete your NUSIA course registration!</b></h1>
@stop

@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            @if($course_registration_is_private)
              @if($has_chosen_instructor_for_private_course == 0)
                <li class="active"><a href="#choose_instructors" data-toggle="tab"><b>1. Instructors</b></a></li>
              @else
                <li><a href="#choose_instructors" data-toggle="tab"><b>1. Instructors</b></a></li>
                <li class="active"><a href="#choose_courses" data-toggle="tab"><b>2. Schedule</b></a></li>
              @endif
            @else
              <li class="active"><a href="#choose_courses" data-toggle="tab"><b>1. Choose Available Schedule</b></a></li>
            @endif
          </ul>
          <div class="tab-content">
            @if($course_registration_is_private)
              <div class="@if($has_chosen_instructor_for_private_course == 0) active @endif tab-pane" id="choose_instructors">
                <div class="row">
                  <div class="col-md-3">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title hidden"><b>NUSIA Instructors</b></h3>
                        <p class="no-margin">
                          <b>
                            {{ $course_registration->course->course_package->title }}
                          </b><br />
                          Total Sessions: <b>{{ $course_registration->course->course_package->count_session }}</b>
                        </p>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <dl>
                          <dt class="hidden">
                            <i class="fa fa-pencil margin-r-5"></i> Choosing Your Preferences
                          </dt>
                          <dd>
                            Please choose your preffered instructor
                            before choosing the schedule.<br />
                            <p>
                              <span style="color:#ff0000;">Contact NUSIA Admin if you encounter a problem.</span><br /><br />
                              <a href="{{ route('non_admin.chat_admin.show', [1]) }}" target="_blank" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noopener noreferrer">
                                <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Chat NUSIA Admin
                              </a>
                            </p>
                          </dd>
                        </dl>
                        {{--
                        <hr>
                        --}}
                      </div>
                    </div>
                    <div class="modal fade" id="popuptutorial0">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="box box-primary">
                            <div class="box-body box-profile">
                              <h3 class="profile-username text-center"><b>Sample Title</b></h3>
                              <p class="text-muted text-center">This is the sample subtitle.</p>
                              <ul class="list-group list-group-unbordered">
                                <li class="list-group-item text-center">
                                  This is the sample text for this pop-up.<br />
                                  Click on each blue-colored text to display a pop-up describing more information about the instructors!
                                </li>
                              </ul>
                              <button onclick="document.getElementById('popuptutorial0').className = 'modal fade'; document.getElementById('popuptutorial0').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </div>
                  <div class="col-md-9 no-padding">
                    @foreach($instructors as $i => $dt)
{{-- Uncomment the codes below for published web --}}
{{--
                      @if( ($dt->user->first_name . ' ' . $dt->user->last_name) == 'NUSIA Academic' )
                        @continue
                      @endif
--}}
                      <div class="col-md-4">
                        <!-- Box Comment -->
                        <div class="box box-widget">
                          <div class="box-body">
                            <a href="#" data-toggle="modal" data-target="#{{$dt->id}}">
                              @if($dt->user->image_profile != 'user.jpg')
                                <img style="display:block; height:215px; margin: 0 auto;" class="img-responsive pad" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                              @else
                                <img style="display:block; height:215px; margin: 0 auto;" class="img-responsive pad" src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
                              @endif
                              <p class="text-center text-black text-decoration-none">
                                <b>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</b>
                              </p>
                            </a>
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
                                @if($dt->user->image_profile != 'user.jpg')
                                  <img class="profile-user-img img-responsive img-circle" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                                @else
                                  <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
                                @endif
                                
                                <h3 class="profile-username text-center">{{$dt->user->first_name}} {{$dt->user->last_name}}</h3>
                                
                                <p class="text-muted text-center">
                                  @if($dt->bio_description)
                                    <?php $bio_descriptions = explode('. ', $dt->bio_description); ?>
                                    @foreach($bio_descriptions as $i => $bd)
                                      @if($i == 0)
                                        {{ '"' . $bd . '.' }}<br />
                                      @elseif($i + 1 != count($bio_descriptions))
                                        {{ $bd . '.' }}<br />
                                      @else
                                        {{ $bd . '"' }}
                                      @endif
                                    @endforeach
                                  @endif
                                </p>
                                
                                <ul class="list-group list-group-unbordered">
                                  <li class="list-group-item">
                                    <b>Working Experiences</b><br />
                                    <?php $we_arr = []; ?>
                                    @if($dt->working_experience)
                                      @foreach(explode('|| ', $dt->working_experience) as $we)
                                        <?php
                                          array_push($we_arr, $we);
                                        ?>
                                      @endforeach
                                      @foreach(array_reverse($we_arr) as $we)
                                        <p class="no-margin no-padding">
                                          <b>{{ substr($we, 0, strpos($we, ':')) }}</b>{{ substr($we, strpos($we, ':')) }}
                                        </p>
                                      @endforeach
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </li>
                                  <li class="list-group-item">
                                    <b>Interest</b><br />
                                    @if($dt->interest)
                                      @foreach(explode(', ', $dt->interest) as $in)
                                        <label class="label label-success">
                                          {{$in}}
                                        </label>&nbsp;
                                      @endforeach
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </li>
                                </ul>
                                
                                <a href="{{ route('student.choose_course_registration.show', [$course_registration->id, $dt->id]) }}" class="btn btn-primary btn-block"><b>Choose</b></a>
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
                </div>
              </div>
              <!-- /.tab-pane -->
              
              
              <div class="@if($has_chosen_instructor_for_private_course != 0) active @endif tab-pane" id="choose_courses">
                <div class="row">
                  <div class="col-md-3">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title hidden"><b>NUSIA Schedules</b></h3>
                        <p class="no-margin">
                          <b>
                            {{ $course_registration->course->course_package->title }}
                          </b><br />
                          Total Sessions: <b>{{ $course_registration->course->course_package->count_session }}</b>
                        </p>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        @foreach($instructors as $dt)
                          @if($dt->id == $has_chosen_instructor_for_private_course)
                              <p class="text-center text-black text-decoration-none">
                                Choosing this instructor:
                              </p>
                              @if($dt->user->image_profile != 'user.jpg')
                                <img style="display:block; height:215px; margin: 0 auto;" class="img-responsive pad" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                              @else
                                <img style="display:block; height:215px; margin: 0 auto;" class="img-responsive pad" src="{{ asset('uploads/user.jpg') }}" alt="User profile picture">
                              @endif
                              <p class="text-center text-black text-decoration-none">
                                <b>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</b>
                              </p>
                              <a href="{{ route('student.choose_course_registration.show', [$course_registration->id]) }}" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noopener noreferrer">
                                Change Instructor
                              </a>
                          @endif
                        @endforeach
                        <hr>
                        <dl>
                          <dt class="hidden">
                            <i class="fa fa-pencil margin-r-5"></i> Choosing Your Preferences
                          </dt>
                          <dd>
                            After choosing your instructor, please choose one of
                            the available schedules.<br />
                            <p>
                              <span style="color:#ff0000;">Contact NUSIA Admin if you encounter a problem.</span><br /><br />
                              <a href="{{ route('non_admin.chat_admin.show', [1]) }}" target="_blank" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noopener noreferrer">
                                <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Chat NUSIA Admin
                              </a>
                            </p>
                          </dd>
                        </dl>
                        {{--
                        <hr>
                        --}}
                      </div>
                    </div>
                    <div class="modal fade" id="popuptutorial0">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="box box-primary">
                            <div class="box-body box-profile">
                              <h3 class="profile-username text-center"><b>Sample Title</b></h3>
                              <p class="text-muted text-center">This is the sample subtitle.</p>
                              <ul class="list-group list-group-unbordered">
                                <li class="list-group-item text-center">
                                  This is the sample text for this pop-up.<br />
                                  Click on each blue-colored text to display a pop-up describing more information about the instructors!
                                </li>
                              </ul>
                              <button onclick="document.getElementById('popuptutorial0').className = 'modal fade'; document.getElementById('popuptutorial0').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </div>
                  <div class="col-md-9 no-padding">

@foreach($courses as $dt)
                    <div class="col-md-4">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ $dt->title }}</h3>
                        </div>
                        <div class="box-body">
                          <div class="row">
                            {{--
                            <div class="col-md-12">
                              <b>Description</b>
                              <p>{{ $dt->description }}</p>
                            </div>
                            <div class="col-md-12">
                              <b>Requirement</b>
                              <p>{{ $dt->requirement }}</p>
                            </div>
                            --}}
                            <div class="col-md-12 text-center">
                              <?php
                                $sessions = $dt->sessions;
                                
                                $session_begin = explode('||', $sessions->first()->schedule->schedule_time)[0];
                                $session_end = explode('||', $sessions->last()->schedule->schedule_time)[1];
                                $session_begin = \Carbon\Carbon::parse($session_begin)->setTimezone(Auth::user()->timezone);
                                $session_end = \Carbon\Carbon::parse($session_end)->setTimezone(Auth::user()->timezone);
                                
                                $arr = [];
                                foreach($sessions as $i => $s) {
                                  $schedule_time_begin = explode('||', $s->schedule->schedule_time)[0];
                                  $schedule_time_end = explode('||', $s->schedule->schedule_time)[1];
                                  $schedule_time_begin = \Carbon\Carbon::parse($schedule_time_begin)->setTimezone(Auth::user()->timezone);
                                  $schedule_time_end = \Carbon\Carbon::parse($schedule_time_end)->setTimezone(Auth::user()->timezone);
                                  $str = $schedule_time_begin->isoFormat('dddd') . ': ' . $schedule_time_begin->isoFormat('hh:mm A') . ' - ' . $schedule_time_end->isoFormat('hh:mm A');
                                  if(!in_array($str, $arr)) array_push($arr, $str);
                                }
                              ?>
                              <p>
                                <b>
                                  @foreach($arr as $i => $a)
                                    {{ $a }}
                                    @if($i + 1 != count($arr)) <br /> @endif
                                  @endforeach
                                </b>
                              </p>
                              <p>
                                from<br />
                                <b style="color:#ff0000;">{{ $session_begin->isoFormat('dddd, MMMM Do YYYY') }}</b><br />
                                until<br />
                                <b style="color:#ff0000;">{{ $session_end->isoFormat('dddd, MMMM Do YYYY') }}</b>
                              </p>
                            </div>
                            <div class="col-md-12 text-center">
                              <p>
                                Number of Students Registered: {{ count( $dt->course_registrations->toArray() ) }}/{{ $dt->course_package->course_type->count_student_max }}
                              </p>
                            </div>
                            <div class="col-md-12">
                              @if( count( $dt->course_registrations->toArray() ) != $dt->course_package->course_type->count_student_max )
                                <a href="#" data-toggle="modal" data-target="#id{{ $dt->id }}" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;">
                                  Choose This Class
                                </a>
                              @else
                                <button onclick="alert('This class is full. Please choose another.'); return false;" class="btn btn-sm btn-flat btn-default disabled" style="width:100%;">
                                  Choose This Class
                                </button>
                              @endif
                            </div>
                          </div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->

        <div class="modal fade" id="id{{ $dt->id }}">
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
                                      <li>Once you have completed the registration process in a NUSIA’s class, you cannot cancel or change the class unless the minimum quota per class (for group only) is not met.</li>
                                      <li>All teaching and learning sessions are recorded. You allow NUSIA to employ the video recordings for research and marketing purposes.</li>
                                      <li>All content of this site is copyright protected. All rights are owned by NUSIA Education. Any use or reproduction of the content of any kind without our explicit consent is punishable and inadmissible.</li>
                                    </ol>
                                    <p class="no-margin no-padding" style="font-size:3px;">&nbsp;</p>
                                    <span class="no-margin no-padding" style="color:#ff0000;">
                                      <span class="hidden-xs hidden-sm">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        If you disagree with this term,
                                        please contact NUSIA Admin <a href="{{ route('non_admin.chat_admin.show', [1]) }}" class="btn btn-xs btn-primary bg-blue">Here</a>
                                      </span>
                                      <span class="hidden-md hidden-lg">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        If you disagree with this term,<br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        please contact NUSIA Admin <a href="{{ route('non_admin.chat_admin.show', [1]) }}" class="btn btn-xs btn-primary bg-blue">Here</a>
                                      </span>
                                    </span>
                                </li>
                            </ul>

                            <form action="{{ route('student.confirm_course_registration.update', [$course_registration->id, $dt->id]) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="checkbox" value="false" onclick="checkboxClick(this);" id="flag" name="flag" class="minimal">&nbsp;&nbsp;I have read and agree to the Terms of Service
                              <br><br>
                              <button type="submit" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;">Agree and Continue</button>
                              <br><br>
                              <button onclick="document.getElementById('id{{ $dt->id }}').className = 'modal fade'; document.getElementById('id{{ $dt->id }}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-sm btn-flat btn-default" style="width:100%;">Close</button>
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
        <script>
          function checkboxClick(cb) {
              document.getElementById("flag").value = cb.checked;
          }
        </script>
@endforeach








                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            @endif
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>

@stop
