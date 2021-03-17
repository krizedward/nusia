@extends('layouts.admin.default')

@section('title', 'Completing Course Registrations')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Complete your NUSIA course registration!</b></h1>
@stop

@section('content')
  <form role="form" method="post" action="{{ route('student.update_course_registrations', [$course_registration->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            @if($course_registration_is_private)
              <li class="active"><a href="#choose_instructors" data-toggle="tab"><b>1. Choose Instructors</b></a></li>
              <li><a href="#choose_courses" data-toggle="tab"><b>2. Available Courses</b></a></li>
            @else
              <li class="active"><a href="#choose_courses" data-toggle="tab"><b>1. Choose Available Courses</b></a></li>
            @endif
          </ul>
          <div class="tab-content">
            @if($course_registration_is_private)
              <div class="active tab-pane" id="choose_instructors">
                <div class="row">
                  <div class="col-md-3">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title"><b>NUSIA Instructors</b></h3>
                        <p class="no-margin">
                          <b>Available for {{ $course_registration->course->course_package->title }}</b>
                        </p>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <dl>
                          <dt>
                            <i class="fa fa-check margin-r-5"></i> Choosing an Instructor
                          </dt>
                          <dd>
                            Click on each
                            <a href="#" data-toggle="modal" data-target="#popuptutorial0" {{-- class="btn btn-s btn-primary" --}}>
                              blue-colored text
                            </a>
                            to display a pop-up describing more information about the instructors!<br />
                            <span style="color:#ff0000;">Contact us if you encounter a problem.</span>
                          </dd>
                        </dl>
                        <hr>
                        <dl>
                          <dt>
                            <i class="fa fa-file-text-o margin-r-5"></i> Note
                          </dt>
                          <dd>
                            You are free to choose the available courses first before the instructors, and vice versa.<br />
                            <span style="color:#ff0000;">Contact us if you encounter a problem.</span>
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
                      <div class="col-md-3">
                        <div class="box box-default">
                          <div class="box-header">
                            <h3 class="box-title">
                              <i class="fa fa-graduation-cap">&nbsp;&nbsp;</i>
                              <b>Text</b>
                            </h3>
                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                          </div>
                          <div class="box-body">
                            <strong><i class="fa fa-circle-o margin-r-5"></i> Features</strong>
                            <ul>
                              <li><b>Text</b></li>
                              <li>Text</li>
                            </ul>
                            {{-- <hr> --}}
                            <table class="table table-bordered">
                              <tr>
                                <th>Name</th>
                                <th>Price (per level)</th>
                                <th style="width:5%;">Choose</th>
                              </tr>
                              <tr>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#InstructorChoice{{ $i }}" {{-- class="btn btn-s btn-primary" --}}>
                                    Text
                                  </a>
                                </td>
                                <td>
                                  <strike>Text</strike>
                                  <b style="font-size:115%; color:#007700;">Text</b><br />
                                </td>
                                <td class="text-center">
                                  <button class="btn btn-xs btn-flat btn-primary" onclick="if( confirm('Are you sure to choose this instructor: {{ $dt->user->first_name }} - {{ $dt->user->last_name }}?') ) return true; else return false;">
                                    <b>Choose</b>
                                  </button>
                                </td>
                              </tr>
                              <div class="modal fade" id="InstructorChoice{{ $i }}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                        <h3 class="profile-username text-center"><b>Text</b></h3>
                                        <p class="text-muted text-center">
                                          <label class="label label-success">Text</label>
                                        </p>
                                        <ul class="list-group list-group-unbordered">
                                          <li class="list-group-item text-center">
                                            <b style="font-size:153%;"><strike>Text</strike></b><br />
                                            This is the description<br />
                                            <b style="font-size:135%;">More texts here.</b><br />
                                            <span style="color:#ff0000;">Another text here.</span>
                                          </li>
                                        </ul>
                                        <button style="width:100%;" class="btn btn-s btn-primary" onclick="if( confirm('Are you sure to choose this instructor: {{ $dt->user->first_name }} - {{ $dt->user->last_name }}?') ) return true; else return false;">
                                          <b>BOOK NOW!</b>
                                        </button>
                                        <br /><br />
                                        <button onclick="document.getElementById('InstructorChoice{{ $i }}').className = 'modal fade'; document.getElementById('InstructorChoice{{ $i }}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                            </table>
                          </div>
                        </div>
                      </div>
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
