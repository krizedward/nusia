@extends('layouts.admin.default')

@section('title','Student | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Choose Your Class!</h1>
    <!--ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Choose Your Class!</li>
    </ol-->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissable">
            <h4>
              <i class="icon fa fa-comments"></i>
              Choose the schedule at your convenience!
            </h4>
            Join one of NUSIA's free classes consisting of <b>3 sessions per class</b>! Per session lasts <b>80 minutes</b>.
          </div>
        </div>
        <div class="col-md-12" style="margin:0;">
          <div class="alert alert-primary alert-dismissable">
            <h4>
              <i class="icon fa fa-book"></i>
              What to learn in free online classes?
            </h4>
            @if(Auth::user()->student->indonesian_language_proficiency == 'Novice')
              You are going to learn about <b>greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.</b>
            @elseif(Auth::user()->student->indonesian_language_proficiency == 'Intermediate')
              You are going to learn about <b>introduction, diseases and its symptoms, as well as Indonesian traditional culinary.</b>
            @else
              You are going to learn about <b>introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.</b>
            @endif
          </div>
        </div>
        @foreach($data as $dt)
          @if($dt->course_registrations->count() < $dt->course_package->course_type->count_student_max)
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ $dt->code }} - {{ $dt->title }}</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <!--div class="col-md-12">
                      <b>Description</b>
                      <p>{{ $dt->description }}</p>
                    </div-->
                    <!--div class="col-md-12">
                      <b>Requirement</b>
                      <p>{{ $dt->requirement }}</p>
                    </div-->
                    <?php $i = $dt->course_package->count_session; ?>
                    @foreach($dt->sessions as $j => $s)
                      <?php
                        $schedule_time = \Carbon\Carbon::parse($s->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
                      ?>
                      <div class="col-md-12">
                        <b>Session {{ $j + 1 }}</b>
                        @if($is_local_access)
                          <p>{{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}</p>
                        @else
                          <p>{{ $schedule_time->addHour()->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }} {{ $schedule_time->add(80, 'minutes')->isoFormat('[-] hh:mm A') }}</p>
                        @endif
                      </div>
                      <?php $i--; ?>
                    @endforeach
                    @while($i--)
                      <div class="col-md-12">
                        <b>&nbsp;</b>
                        <p>&nbsp;</p>
                      </div>
                    @endwhile
                    <div class="col-md-12">
                      <a href="#" data-toggle="modal" data-target="#{{$dt->id}}" class="btn btn-s btn-primary" style="width:100%;">
                        Choose This Class
                      </a>
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
                            <h3 class="profile-username text-center">Terms and Conditions</h3>

                            <!--p class="text-muted text-center">More description here...</p-->

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <!--b>Text</b-->
                                    <p>1. Learners must attend all sessions. If learners cannot attend some of them, they cannot reschedule the sessions.</p>
                                    <p>2. Learners must read the learning materials on the dashboard before joining each session.</p>
                                    <p>3. Learners must give feedback on the link provided in the dashboard after finishing each session.</p>
                                    <p>4. All session are recorded. Learners allow NUSIA to employ the video recordings for research and marketing purposes (If you disagree, please contact us via email and click the “agree” button below)</p>
                                </li>
                            </ul>

                            <form action="{{ route('course_registrations.store') }}" method="POST">
                              @csrf
                              <input type="hidden" value="{{ $dt->id }}" name="course_id">
                              <input type="hidden" value="{{ Auth::user()->student->id }}" name="student_id">
                              <input type="checkbox" value="false" onclick="checkboxClick(this);" id="flag" name="flag" class="minimal">&nbsp;&nbsp;I have read and agree to the Terms and Conditions
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

          @endif
        @endforeach
    </div>
    <script>
      function checkboxClick(cb) {
          document.getElementById("flag").value = cb.checked;
      }
    </script>
@stop

{{--contoh-lain-dari-material -> bisa diganti --}}
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php $i = 1; ?>
                  @foreach($data as $dt)
                    @if($i++ == 1)
                      @if($dt->code)
                        <li class="active"><a href="#activity{{$dt->id}}" data-toggle="tab">{{$dt->code}}</a></li>
                      @elseif($dt->title)
                        <li class="active"><a href="#activity{{$dt->id}}" data-toggle="tab">{{$dt->title}}</a></li>
                      @else
                        <li class="active"><a href="#activity{{$dt->id}}" data-toggle="tab">{{$dt->course_package->title}}</a></li>
                      @endif
                    @else
                      @if($dt->code)
                        <li><a href="#activity{{$dt->id}}" data-toggle="tab">{{$dt->code}}</a></li>
                      @elseif($dt->title)
                        <li><a href="#activity{{$dt->id}}" data-toggle="tab">{{$dt->title}}</a></li>
                      @else
                        <li><a href="#activity{{$dt->id}}" data-toggle="tab">{{$dt->course_package->title}}</a></li>
                      @endif
                    @endif
                  @endforeach
                </ul>
                <div class="tab-content">
                  <?php $i = 1; $arr = []; ?>
                  @foreach($data as $dt)
                    @if($i++ == 1)
                    <div class="active tab-pane" id="activity{{$dt->id}}">
                    @else
                    <div class="tab-pane" id="activity{{$dt->id}}">
                    @endif
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-header">
                                        @if($dt->title)
                                          <h3 class="box-title">{{$dt->title}}</h3>
                                        @else
                                          <h3 class="box-title">{{$dt->course_package->title}}</h3>
                                        @endif
                                    </div>
                                    <form action="{{ route('course_registrations.store') }}" method="POST">
                                      @csrf
                                        <input type="hidden" value="{{ $dt->id }}" name="course_id">
                                        <input type="hidden" value="{{ Auth::user()->student->id }}" name="student_id">
                                        <div class="box-body">
                                            <dl>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                                                <dd>{{$dt->description}}</dd>
                                            </dl>
                                            <hr>
                                            <dl>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Requirement</dt>
                                                <dd>{{$dt->requirement}}</dd>
                                            </dl>
                                        </div>
                                        <button type="submit" class="btn btn-s btn-primary">Choose This Class</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Schedules</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Session ID</th>
                                                <th>Session Name</th>
                                                <th>Meeting Time</th>
                                            </tr>
                                            <?php $j = 1; ?>
                                            @foreach($dt->sessions as $s)
                                                <tr>
                                                  <td>{{ $j }}</td>
                                                  @if($s->code)
                                                    <td>{{ $s->code }}</td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                  @endif
                                                  @if($s->title)
                                                    <td>{{ $s->title }}</td>
                                                  @else
                                                    <td>Session {{ $s->j }}</td>
                                                  @endif
                                                  @if($s->schedule->schedule_time)
                                                    <td>{{ $s->schedule->schedule_time }}</td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                  @endif
                                                </tr>
                                              <?php $j++; ?>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                  @endforeach
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Novice</a></li>
                    <li><a href="#private" data-toggle="tab">Intermediate</a></li>
                    <li><a href="#group" data-toggle="tab">Advanced</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Free Trial Course</h3>
                                    </div>
                                    <form>
                                        <div class="box-body">
                                            <dl>
                                                <dt><i class="fa fa-map-marker margin-r-5"></i> Description</dt>
                                                <dd>Anda Mendapatkan 3 kali kesempatan gratis mencoba course online nusia</dd>
                                                <hr>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Notes</dt>
                                                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</dd>
                                            </dl>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Main Materials</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Session</th>
                                                <th>Level</th>
                                                <th>Type Data</th>
                                                <th>File Name</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <tr>
                                                <td>1.</td>
                                                <td>Session 1</td>
                                                <td>Trial</td>
                                                <td>PDF</td>
                                                <td>Introduce</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Session 2</td>
                                                <td>High</td>
                                                <td>PDF</td>
                                                <td>Introduce</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Supplementary Materials</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Session</th>
                                                <th>Level</th>
                                                <th>Type Data</th>
                                                <th>File Name</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <tr>
                                                <td>1.</td>
                                                <td>Session 1</td>
                                                <td>Trial</td>
                                                <td>PDF</td>
                                                <td>Introduce</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Session 2</td>
                                                <td>High</td>
                                                <td>PDF</td>
                                                <td>Introduce</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="private">
                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            {{ __('Sebelum mendownload materi ini, tolong mendaftar course online nusia dulu.') }}
                        </div>
                    </div>
                    <!-- /.tab-private -->
                    <div class="tab-pane" id="group">
                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            {{ __('Sebelum mendownload materi ini, tolong mendaftar course online nusia dulu.') }}
                        </div>
                    </div>
                    <!-- /.tab-group -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@stop
