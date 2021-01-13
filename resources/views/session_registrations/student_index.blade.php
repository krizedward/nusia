@extends('layouts.admin.default')

@section('title', 'Student | Schedules')

{{-- @include('layouts.css_and_js.form_general') --}}

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Schedules</li>
  </ol>
@stop

@section('content')
  @if(session('form_complete'))
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <h4><i class="icon fa fa-check"></i> {{ session('form_complete') }}</h4> {{ session(['form_complete' => null]) }}
        </div>
      </div>
    </div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#upcoming_sessions" data-toggle="tab"><b>Upcoming Sessions</b></a></li>
          <li><a href="#all_courses" data-toggle="tab"><b>All Courses</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="upcoming_sessions">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  {{--
                  <div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div>
                  --}}
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Note</dt>
                        <dd>
                          Click "link" button to join your session!<br />
                          <span style="color:#ff0000;">* Contact us if you encounter a problem.</span><br />
                        </dd>
                        {{--
                        <hr>
                        <dt style="font-size:18px;"><i class="fa fa-pencil margin-r-5"></i> Feedback</dt>
                        <dd>
                          After participating in EACH session,<br />you may give us your feedback.<br />
                          <span style="color:#ff0000;">** Giving feedbacks for improvement is greatly appreciated.</span>
                        </dd>
                        --}}
                      </dl>
                      {{-- <!--hr--> --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9 no-padding">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title"><b>All Upcoming Sessions</b></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      @if(Auth::user()->student->course_registrations->toArray() != 0)
                        <table id="example1" class="table table-bordered">
                          <tr>
                            <th style="width:2%;" class="text-right">#</th>
                            <th>Course/Session</th>
                            <th>Time</th>
                            <th style="width:5%;">Link</th>
                          </tr>
                          @foreach(Auth::user()->student->course_registrations as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->course->title }}</td>
                              <td>#</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('home') }}">Link</a></td>
                            </tr>
                          @endforeach
                        </table>
                      @else
                        <div class="text-center">No data available.</div>
                      @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="all_courses">
            <div class="row">
              <div class="col-md-12">
                <div class="box-group" id="accordion">
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                  <div class="panel box box-warning">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color:#000000;">
                          <b>All Courses</b>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="box-body">
                        @if(Auth::user()->student->course_registrations->toArray() != 0)
                          <table class="table table-bordered">
                            <tr>
                              <th style="width:2%;" class="text-right">#</th>
                              <th>Course</th>
                              <th>Type</th>
                              <th style="width:5%;">Detail</th-->
                            </tr>
                            @foreach(Auth::user()->student->course_registrations as $i => $dt)
                              <tr>
                                <td class="text-right">{{ $i + 1 }}</td>
                                <td>{{ $dt->course->title }}</td>
                                <td>{{ $dt->course->course_package->material_type->name }}/{{ $dt->course->course_package->course_type->name }}</td>
                                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                              </tr>
                            @endforeach
                          </table>
                        @else
                          <div class="text-center">No data available.</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color:#000000;">
                          <b>General Indonesian Language</b>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="box-body">
                        <?php
                          $type = 'General Indonesian Language';
                          $count = 0;
                          foreach(Auth::user()->student->course_registrations as $dt) {
                            if($dt->course->course_package->material_type->name == $type) {
                              $count++;
                            }
                          }
                        ?>
                        @if(Auth::user()->student->course_registrations->toArray() != 0 && $count > 0)
                          <table class="table table-bordered">
                            <tr>
                              <th style="width:2%;" class="text-right">#</th>
                              <th>Course</th>
                              <th>Type</th>
                              <th style="width:5%;">Detail</th-->
                            </tr>
                            @foreach(Auth::user()->student->course_registrations as $i => $dt)
                              @if($dt->course->course_package->material_type->name == $type)
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>{{ $dt->course->title }}</td>
                                  <td>{{ $dt->course->course_package->course_type->name }}</td>
                                  <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                                </tr>
                              @endif
                            @endforeach
                          </table>
                        @else
                          <div class="text-center">No data available.</div>
                        @endif
                      </div>
                      <!-- End -->
                    </div>
                  </div>
                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="color:#000000;">
                          <b>Language Partners</b>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="box-body">
                        <?php
                          $type = 'Language Partners';
                          $count = 0;
                          foreach(Auth::user()->student->course_registrations as $dt) {
                            if($dt->course->course_package->material_type->name == $type) {
                              $count++;
                            }
                          }
                        ?>
                        @if(Auth::user()->student->course_registrations->toArray() != 0 && $count > 0)
                          <table class="table table-bordered">
                            <tr>
                              <th style="width:2%;" class="text-right">#</th>
                              <th>Course</th>
                              <th>Type</th>
                              <th style="width:5%;">Detail</th-->
                            </tr>
                            @foreach(Auth::user()->student->course_registrations as $i => $dt)
                              @if($dt->course->course_package->material_type->name == $type)
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>{{ $dt->course->title }}</td>
                                  <td>{{ $dt->course->course_package->course_type->name }}</td>
                                  <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                                </tr>
                              @endif
                            @endforeach
                          </table>
                        @else
                          <div class="text-center">No data available.</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-info">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" style="color:#000000;">
                          <b>Cultural Classes</b>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                      <div class="box-body">
                        <?php
                          $type = 'Cultural Classes';
                          $count = 0;
                          foreach(Auth::user()->student->course_registrations as $dt) {
                            if($dt->course->course_package->material_type->name == $type) {
                              $count++;
                            }
                          }
                        ?>
                        @if(Auth::user()->student->course_registrations->toArray() != 0 && $count > 0)
                          <table class="table table-bordered">
                            <tr>
                              <th style="width:2%;" class="text-right">#</th>
                              <th>Course</th>
                              <th>Type</th>
                              <th style="width:5%;">Detail</th-->
                            </tr>
                            @foreach(Auth::user()->student->course_registrations as $i => $dt)
                              @if($dt->course->course_package->material_type->name == $type)
                                <tr>
                                  <td class="text-right">{{ $i + 1 }}</td>
                                  <td>{{ $dt->course->title }}</td>
                                  <td>{{ $dt->course->course_package->course_type->name }}</td>
                                  <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('course_registrations.show_by_student', [$dt->id]) }}">Link</a></td>
                                </tr>
                              @endif
                            @endforeach
                          </table>
                        @else
                          <div class="text-center">No data available.</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
