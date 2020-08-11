@extends('layouts.admin.default')

@section('title','Instructor | Material Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Material Course</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Free Trial</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Free Trial</a></li>
                    <!--li><a href="#private" data-toggle="tab">Private</a></li-->
                    <!--li><a href="#group" data-toggle="tab">Group</a></li-->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-header">
                                        <h4 class="box-title">Supplementary Materials</h4>
                                    </div>
                                    <form>
                                        <div class="box-body">
                                            <form action="#" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Session In</label>
                                                    <select class="form-control select2" name="user">
                                                        <option selected="" disabled="">Session In</option>
                                                        <option>[kode] - Free Trial Course</option>
                                                        <option>[kode] - Novice-Low Private</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>File Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="File Name.." value="{{ old('name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">File Upload</label>
                                                    <input type="file" name="image" id="exampleInputFile">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
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
                                                    foreach($material_publics as $material_public) {
                                                        if($mp->id == $material_public->id) { $flag = 1; break; }
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
                                                        foreach($material_sessions as $material_session) {
                                                            if($ms->id == $material_session->id) { $flag = 1; break; }
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
