@extends('layouts.admin.default')

@section('title', 'Chat')

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Chat</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Chat</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <a href="{{ route('student.chat_instructor.show', [65]) }}">Chat with an instructor (demo)</a>
    </div>
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab"><b>All</b></a></li>
          <li><a href="#instructors" data-toggle="tab"><b>Instructors</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="all">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Text</b></h3>
                    <p class="no-margin">
                      Text
                      <b>Text</b>
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <dl>
                      <dt>
                        <i class="fa fa-file-text-o margin-r-5"></i> More Information
                      </dt>
                      <dd>
                        Three days after each session ends, the "Form" button will eventually disappear.<br />
                        Please consider that a minimum of <b>80% completed attendances (of all sessions)</b> is required to get the course certificate.<br />
                        <span style="color:#ff0000;">Contact your instructor if you encounter a problem.</span>
                      </dd>
                    </dl>
                    {{--<hr>--}}
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-9">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title"><b>Text</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <strong><i class="fa fa-circle-o margin-r-5"></i> Text</strong>
                      <p>
                        Text
                      </p>
                      {{--<hr>--}}
                    </div>
                  </div>
                  <div class="box box-warning">
                    <div class="box-header">
                      <h3 class="box-title">
                        Text
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <table class="table table-bordered">
                        <thead>
                          <th>Name</th>
                          <th style="width:25%;">Interest</th>
                          <th style="width:12%;">Picture</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Text</td>
                            <td>Text</td>
                            <td>Text</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">
                        Text
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <table class="table table-bordered">
                        <thead>
                          <th>Name</th>
                          <th style="width:25%;">Interest</th>
                          <th style="width:12%;">Picture</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Text</td>
                            <td>Text</td>
                            <td>Text</td>
                          </tr>
                        </tbody>
                      </table>
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
