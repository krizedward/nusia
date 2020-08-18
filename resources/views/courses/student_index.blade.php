@extends('layouts.admin.default')

@section('title','Student | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Nusia Course</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Course</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissable">
            <h4>
              <i class="icon fa fa-book"></i>
              Note 1
            </h4>
            You can join 3 sessions of free trial courses with NUSIA.
          </div>
        </div>
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissable">
            <h4>
              <i class="icon fa fa-book"></i>
              Note 2
            </h4>
            Before starting each session, you must download the main materials.
          </div>
        </div>
        @foreach($data as $dt)
          @if($dt->course_registrations->count() < $dt->course_package->course_type->count_student_max)
            <div class="col-md-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $dt->code }}</h3>
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
                    <?php $i = $dt->course_package->count_session; ?>
                    @foreach($dt->sessions as $j => $s)
                      <div class="col-md-12">
                        <b>Session {{ $j + 1 }}</b>
                        <p>{{ $s->schedule->schedule_time }}</p>
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
                      <form action="{{ route('course_registrations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $dt->id }}" name="course_id">
                        <input type="hidden" value="{{ Auth::user()->student->id }}" name="student_id">
                        <button type="submit" class="btn btn-s btn-primary" style="width:100%;">Choose This Class</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          @endif
        @endforeach
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
@stop

{{--contoh-lain-dari-material -> bisa diganti --}}
@section('contents')
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
