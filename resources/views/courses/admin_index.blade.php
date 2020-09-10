@extends('layouts.admin.default')

@section('title','Admin | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Courses</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        {{--head table content--}}
                        </thead>
                        <tbody>
                        @foreach($course as $dt)
                        <tr>
                            <td>{{ $dt->code }}</td>
                            <td>{{ $dt->title }}</td>
                            <td>
                                <a href="#">Detail</a>
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
              <h3 class="box-title">Course Package</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_package as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
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
                <li><a href="#">View</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Course Level</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_level as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
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
                <li><a href="#">View</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Material Public</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($material_public as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
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
                <li><a href="#">View</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Course Level Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_level_detail as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
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
                <li><a href="#">View</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Course Type</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course_type as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
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
                <li><a href="#">View</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Material Type</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($material_type as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
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
                <li><a href="#">View</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
