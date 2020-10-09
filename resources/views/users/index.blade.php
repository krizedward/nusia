@extends('layouts.admin.default')

@section('title', 'Admin | User')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>User</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">User</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab"><b>All Users</b></a></li>
          <li><a href="#lead_instructors" data-toggle="tab"><b>Lead Instructors</b></a></li>
          <li><a href="#instructors" data-toggle="tab"><b>Instructors</b></a></li>
          <li><a href="#students" data-toggle="tab"><b>Students</b></a></li>
          <li><a href="#other_users" data-toggle="tab"><b>Other Users</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="all">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Users</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($users->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Role</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($users as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->roles }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                          </tr>
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="lead_instructors">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Lead Instructors</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($lead_instructors->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($lead_instructors as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                          </tr>
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="instructors">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Instructors</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($instructors->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($instructors as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                          </tr>
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="students">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($students->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($students as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                          </tr>
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="other_users">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Other Users</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($other_users->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($other_users as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                          </tr>
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
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
