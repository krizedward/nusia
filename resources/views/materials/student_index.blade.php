@extends('layouts.admin.default')

@section('title','Student | Free Trial')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Course Materials</h1>
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
                                                <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                                                <dd>You can join 3 sessions of free trial courses with NUSIA.</dd>
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
                                                <th>Session</th>
                                                <th>Level</th>
                                                <th>Data Type</th>
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
                                                <th>Data Type</th>
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
