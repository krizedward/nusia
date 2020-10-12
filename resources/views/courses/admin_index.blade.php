@extends('layouts.admin.default')

@section('title','Admin | Class')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Class</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><b>List of Classes</b></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-right" style="width:20px;">#</th>
                            <th>Title</th>
                            <th style="width:50px;">Action</th>
                        </tr>
                        {{--head table content--}}
                        </thead>
                        <tbody>
                        @foreach($course as $i => $dt)
                        <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->title }}</td>
                            <td class="text-center">
                                <a href="{{ route('courses.show',[$dt->id]) }}" class="btn btn-xs btn-flat btn-success">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                        {{-- body content--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Class Package</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="text-right" style="width:20px;">#</th>
                  <th>Title</th>
                  <th>Number of Sessions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_package as $i => $dt)
                <tr>
                  <td class="text-right">{{ $i + 1 }}</td>
                  <td>{{ $dt->title }}</td>
                  <td>{{ $dt->count_session }}</td>
                </tr>
                @endforeach
                </tbody>              
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="{{ route('course_packages.index') }}">View Details</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Class Type</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="text-right" style="width:20px;">#</th>
                  <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_type as $i => $dt)
                <tr>
                  <td class="text-right">{{ $i + 1 }}</td>
                  <td>{{ $dt->name }}</td>
                </tr>
                @endforeach
                </tbody>              
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="{{ route('course_types.index') }}">View Details</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Class Level</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="text-right" style="width:20px;">#</th>
                  <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_level as $i => $dt)
                <tr>
                  <td class="text-right">{{ $i + 1 }}</td>
                  <td>{{ $dt->name }}</td>
                </tr>
                @endforeach
                </tbody>              
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="{{ route('course_levels.index') }}">View Details</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
