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
                                    </div>
                                    <form>
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
                                                        <td>1</td>
                                                        <td>{{ __('none') }}</td>
                                                        <td>{{ __('none') }}</td>
                                                        <td>{{ __('none') }}</td>
                                                        <td>{{ __('none') }}</td>
                                                        <td>
                                                            <a class="btn btn-flat btn-xs btn-success" href="#"><i class="fa fa-download"></i> Download</a>
                                                        </td>
                                                    </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Session 1</td>
                                                    <td>High</td>
                                                    <td>PDF</td>
                                                    <td>Introduce</td>
                                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Supplementary Materials</h3>
                                    </div>
                                    <form>
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
                                                    <td>High</td>
                                                    <td>PDF</td>
                                                    <td>Introduce</td>
                                                    <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Download</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </form>
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
