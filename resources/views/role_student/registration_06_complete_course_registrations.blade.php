@extends('layouts.admin.default')

@section('title', 'Completing Course Registrations')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Complete your NUSIA course registration!</b></h1>
@stop

@section('content')
  <form role="form" method="post" action="#" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            @if($course_registration_is_private)
              <li class="active"><a href="#choose_instructors" data-toggle="tab"><b>1. Instructors</b></a></li>
              <li><a href="#choose_courses" data-toggle="tab"><b>2. Schedule</b></a></li>
            @else
              <li class="active"><a href="#choose_courses" data-toggle="tab"><b>1. Choose Available Schedule</b></a></li>
            @endif
          </ul>
          <div class="tab-content">
            @if($course_registration_is_private)
              <div class="active tab-pane" id="choose_instructors">
                <div class="row">
                  <div class="col-md-3">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title hidden"><b>NUSIA Instructors</b></h3>
                        <p class="no-margin">
                          <b>Available for {{ $course_registration->course->course_package->title }}</b>
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
                            before choosing the schedule, or vice versa.<br />
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

                      <div class="col-md-4">
                        <!-- Box Comment -->
                        <div class="box box-widget">
                          <div class="box-body">
                            <a href="#" data-toggle="modal" data-target="#{{$dt->id}}">
                              @if($dt->user && $dt->user->image_profile)
                                <img class="img-responsive pad" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                              @else
                                <img class="img-responsive pad" src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
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
                                @if($dt->user->image_profile)
                                  <img class="profile-user-img img-responsive img-circle" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                                @else
                                  <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
                                @endif
                                
                                <h3 class="profile-username text-center">{{$dt->user->first_name}} {{$dt->user->last_name}}</h3>
                                
                                <p class="text-muted text-center">
                                  "I love to challenge myself and learn new different things.<br />
                                  Life without challenges is a body losing its soul.<br />
                                  Challenge yourself so you can live a life that is worth living and worth remembering."
                                </p>
                                
                                <ul class="list-group list-group-unbordered">
                                  <li class="list-group-item">
                                    <b>Professional Experiences</b>
                                    @foreach(explode('|| ', $dt->working_experience) as $we)
                                      <p class="no-margin no-padding">
                                        {{$we}}
                                      </p>
                                    @endforeach
                                  </li>
                                  <li class="list-group-item">
                                    <b>Interest</b><br />
                                    @foreach(explode(', ', $dt->interest) as $in)
                                      <label class="label label-success">
                                        {{$in}}
                                      </label>&nbsp;
                                    @endforeach
                                  </li>
                                </ul>
                                
                                @if(Auth::user()->citizenship == 'Not Available')
                                  <div class="text-center"><b>To continue, please complete the account confirmation.</b></div>
                                @else
                                  <a href="#" class="btn btn-primary btn-block"><b>Choose</b></a>
                                @endif
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
            @endif
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
  </form>
@stop
