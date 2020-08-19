@extends('layouts.admin.default')

@section('title','Student | Free Trial')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Materials</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Materials</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#free_trial" data-toggle="tab">Free Classes</a></li>
                    <!--li><a href="#private" data-toggle="tab">Private</a></li>
                    <li><a href="#group" data-toggle="tab">Group</a></li-->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="free_trial">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box">
                                    <!--div class="box-header">
                                        <h3 class="box-title">Free Classes</h3>
                                    </div-->
                                    <form>
                                        <div class="box-body">
                                            <dl>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                                                <dd>You must download the materials before each session starts.</dd>
                                            </dl>
                                            <hr>
                                            <dl>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Note</dt>
                                                <dd>You can access the materials<br>on <b style="color:#ff0000;">August 21, 2020</b>.</dd>
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
                                                <th>File Name</th>
                                                <th>Learning Outcome</th>
                                                <th>Data Type</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <?php $i = 1; $arr = []; ?>
                                            @foreach($course_registrations as $cr)
                                              @foreach($cr->course->course_package->material_publics as $mp)
                                                <?php
                                                  $flag = 0;
                                                  foreach($mps_free_trial as $mp_free_trial) {
                                                    if($mp->id == $mp_free_trial->id) { $flag = 1; break; }
                                                  }
                                                  if($flag == 0) continue;

                                                  $flag = 0;
                                                  for($j = 0; $j < count($arr); $j++) {
                                                    if($mp->id == $arr[$j]) { $flag = 1; break; }
                                                  }
                                                  if($flag) continue;
                                                  else array_push($arr, $mp->id);
                                                ?>
                                                <tr>
                                                  <td>{{ $i++ }}</td>
                                                  <td>{{ $mp->name }}</td>
                                                  @if($mp->description)
                                                    <td>{{ $mp->description }}</td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                  @endif
                                                  @if($mp->path)
                                                    <td>{{ strtoupper( substr($mp->path, strrpos($mp->path, '.', 0) + 1) ) }}</td>
                                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('materials.download', ['Public', $mp->id]) }}">Download</a></td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                    <td><a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Download</a></td>
                                                  @endif
                                                </tr>
                                              @endforeach
                                            @endforeach
                                            <!--tr>
                                                <td>1.</td>
                                                <td>Introduce</td>
                                                <td>Introduce</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Introduce</td>
                                                <td>Introduce</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr-->
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
                                                <th>File Name</th>
                                                <th>Learning Outcome</th>
                                                <th>Data Type</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <?php $i = 1; $arr = []; ?>
                                            @foreach($course_registrations as $cr)
                                              @foreach($cr->course->sessions as $s)
                                                @foreach($s->material_sessions as $ms)
                                                  <?php
                                                    $flag = 0;
                                                    foreach($mss_free_trial as $ms_free_trial) {
                                                      if($ms->id == $ms_free_trial->id) { $flag = 1; break; }
                                                    }
                                                    if($flag == 0) continue;

                                                    $flag = 0;
                                                    for($j = 0; $j < count($arr); $j++) {
                                                      if($ms->id == $arr[$j]) { $flag = 1; break; }
                                                    }
                                                    if($flag) continue;
                                                    else array_push($arr, $ms->id);
                                                  ?>
                                                  <tr>
                                                    <td>{{ $i++ }}</td>
                                                    @if($s->title)
                                                      <td>{{ $s->title }}</td>
                                                    @elseif($s->course->title)
                                                      <td>{{ $s->course->title }}</td>
                                                    @else
                                                      <td>{{ $s->course->course_package->title }}</td>
                                                    @endif
                                                    <td>{{ $ms->name }}</td>
                                                    @if($ms->description)
                                                      <td>{{ $ms->description }}</td>
                                                    @else
                                                      <td><i>Not Available</i></td>
                                                    @endif
                                                    @if($ms->path)
                                                      <td>{{ strtoupper( substr($ms->path, strrpos($ms->path, '.', 0) + 1) ) }}</td>
                                                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('materials.download', ['Session', $ms->id]) }}">Download</a></td>
                                                    @else
                                                      <td><i>Not Available</i></td>
                                                      <td><a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Download</a></td>
                                                    @endif
                                                  </tr>
                                                @endforeach
                                              @endforeach
                                            @endforeach
                                            <!--tr>
                                                <td>1.</td>
                                                <td>Session 1</td>
                                                <td>Introduce</td>
                                                <td>Learning Outcome</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Session 2</td>
                                                <td>Introduce</td>
                                                <td>Learning Outcome</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr-->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="private_UNAVAILABLE">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Private Course</h3>
                                    </div>
                                    <form>
                                        <div class="box-body">
                                            <dl>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                                                <dd>This is a description for NUSIA private courses.</dd>
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
                                                <th>File Name</th>
                                                <th>Learning Outcome</th>
                                                <th>Data Type</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <?php $i = 1; $arr = []; ?>
                                            @foreach($course_registrations as $cr)
                                              @foreach($cr->course->course_package->material_publics as $mp)
                                                <?php
                                                  $flag = 0;
                                                  foreach($mps_private as $mp_private) {
                                                    if($mp->id == $mp_private->id) { $flag = 1; break; }
                                                  }
                                                  if($flag == 0) continue;

                                                  $flag = 0;
                                                  for($j = 0; $j < count($arr); $j++) {
                                                    if($mp->id == $arr[$j]) { $flag = 1; break; }
                                                  }
                                                  if($flag) continue;
                                                  else array_push($arr, $mp->id);
                                                ?>
                                                <tr>
                                                  <td>{{ $i++ }}</td>
                                                  <td>{{ $mp->name }}</td>
                                                  @if($mp->description)
                                                    <td>{{ $mp->description }}</td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                  @endif
                                                  @if($mp->path)
                                                    <td>{{ strtoupper( substr($mp->path, strrpos($mp->path, '.', 0) + 1) ) }}</td>
                                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('materials.download', ['Public', $mp->id]) }}">Download</a></td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                    <td><a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Download</a></td>
                                                  @endif
                                                </tr>
                                              @endforeach
                                            @endforeach
                                            <!--tr>
                                                <td>1.</td>
                                                <td>Introduce</td>
                                                <td>Introduce</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Introduce</td>
                                                <td>Introduce</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr-->
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
                                                <th>File Name</th>
                                                <th>Learning Outcome</th>
                                                <th>Data Type</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <?php $i = 1; $arr = []; ?>
                                            @foreach($course_registrations as $cr)
                                              @foreach($cr->course->sessions as $s)
                                                @foreach($s->material_sessions as $ms)
                                                  <?php
                                                    $flag = 0;
                                                    foreach($mss_private as $ms_private) {
                                                      if($ms->id == $ms_private->id) { $flag = 1; break; }
                                                    }
                                                    if($flag == 0) continue;

                                                    $flag = 0;
                                                    for($j = 0; $j < count($arr); $j++) {
                                                      if($ms->id == $arr[$j]) { $flag = 1; break; }
                                                    }
                                                    if($flag) continue;
                                                    else array_push($arr, $ms->id);
                                                  ?>
                                                  <tr>
                                                    <td>{{ $i++ }}</td>
                                                    @if($s->title)
                                                      <td>{{ $s->title }}</td>
                                                    @elseif($s->course->title)
                                                      <td>{{ $s->course->title }}</td>
                                                    @else
                                                      <td>{{ $s->course->course_package->title }}</td>
                                                    @endif
                                                    <td>{{ $ms->name }}</td>
                                                    @if($ms->description)
                                                      <td>{{ $ms->description }}</td>
                                                    @else
                                                      <td><i>Not Available</i></td>
                                                    @endif
                                                    @if($ms->path)
                                                      <td>{{ strtoupper( substr($ms->path, strrpos($ms->path, '.', 0) + 1) ) }}</td>
                                                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('materials.download', ['Session', $ms->id]) }}">Download</a></td>
                                                    @else
                                                      <td><i>Not Available</i></td>
                                                      <td><a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Download</a></td>
                                                    @endif
                                                  </tr>
                                                @endforeach
                                              @endforeach
                                            @endforeach
                                            <!--tr>
                                                <td>1.</td>
                                                <td>Session 1</td>
                                                <td>Introduce</td>
                                                <td>Learning Outcome</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Session 2</td>
                                                <td>Introduce</td>
                                                <td>Learning Outcome</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr-->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="group_UNAVAILABLE">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Group Course</h3>
                                    </div>
                                    <form>
                                        <div class="box-body">
                                            <dl>
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                                                <dd>This is a description for NUSIA group courses.</dd>
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
                                                <th>File Name</th>
                                                <th>Learning Outcome</th>
                                                <th>Data Type</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <?php $i = 1; $arr = []; ?>
                                            @foreach($course_registrations as $cr)
                                              @foreach($cr->course->course_package->material_publics as $mp)
                                                <?php
                                                  $flag = 0;
                                                  foreach($mps_group as $mp_group) {
                                                    if($mp->id == $mp_group->id) { $flag = 1; break; }
                                                  }
                                                  if($flag == 0) continue;

                                                  $flag = 0;
                                                  for($j = 0; $j < count($arr); $j++) {
                                                    if($mp->id == $arr[$j]) { $flag = 1; break; }
                                                  }
                                                  if($flag) continue;
                                                  else array_push($arr, $mp->id);
                                                ?>
                                                <tr>
                                                  <td>{{ $i++ }}</td>
                                                  <td>{{ $mp->name }}</td>
                                                  @if($mp->description)
                                                    <td>{{ $mp->description }}</td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                  @endif
                                                  @if($mp->path)
                                                    <td>{{ strtoupper( substr($mp->path, strrpos($mp->path, '.', 0) + 1) ) }}</td>
                                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('materials.download', ['Public', $mp->id]) }}">Download</a></td>
                                                  @else
                                                    <td><i>Not Available</i></td>
                                                    <td><a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Download</a></td>
                                                  @endif
                                                </tr>
                                              @endforeach
                                            @endforeach
                                            <!--tr>
                                                <td>1.</td>
                                                <td>Introduce</td>
                                                <td>Introduce</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Introduce</td>
                                                <td>Introduce</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr-->
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
                                                <th>File Name</th>
                                                <th>Learning Outcome</th>
                                                <th>Data Type</th>
                                                <th style="width: 40px">Link</th>
                                            </tr>
                                            <?php $i = 1; $arr = []; ?>
                                            @foreach($course_registrations as $cr)
                                              @foreach($cr->course->sessions as $s)
                                                @foreach($s->material_sessions as $ms)
                                                  <?php
                                                    $flag = 0;
                                                    foreach($mss_group as $ms_group) {
                                                      if($ms->id == $ms_group->id) { $flag = 1; break; }
                                                    }
                                                    if($flag == 0) continue;

                                                    $flag = 0;
                                                    for($j = 0; $j < count($arr); $j++) {
                                                      if($ms->id == $arr[$j]) { $flag = 1; break; }
                                                    }
                                                    if($flag) continue;
                                                    else array_push($arr, $ms->id);
                                                  ?>
                                                  <tr>
                                                    <td>{{ $i++ }}</td>
                                                    @if($s->title)
                                                      <td>{{ $s->title }}</td>
                                                    @elseif($s->course->title)
                                                      <td>{{ $s->course->title }}</td>
                                                    @else
                                                      <td>{{ $s->course->course_package->title }}</td>
                                                    @endif
                                                    <td>{{ $ms->name }}</td>
                                                    @if($ms->description)
                                                      <td>{{ $ms->description }}</td>
                                                    @else
                                                      <td><i>Not Available</i></td>
                                                    @endif
                                                    @if($ms->path)
                                                      <td>{{ strtoupper( substr($ms->path, strrpos($ms->path, '.', 0) + 1) ) }}</td>
                                                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('materials.download', ['Session', $ms->id]) }}">Download</a></td>
                                                    @else
                                                      <td><i>Not Available</i></td>
                                                      <td><a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-default disabled" href="#">Download</a></td>
                                                    @endif
                                                  </tr>
                                                @endforeach
                                              @endforeach
                                            @endforeach
                                            <!--tr>
                                                <td>1.</td>
                                                <td>Session 1</td>
                                                <td>Introduce</td>
                                                <td>Learning Outcome</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Session 2</td>
                                                <td>Introduce</td>
                                                <td>Learning Outcome</td>
                                                <td>PDF</td>
                                                <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                            </tr-->
                                        </table>
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
