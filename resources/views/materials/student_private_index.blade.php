@extends('layouts.admin.default')
@section('title','Material - Private Course')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Material for <b>Private Course</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Material</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Material</a>
        </div>
        <div class="box-body no-padding">
          <table class="table">
            <!--thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead-->
            <tbody>
              <?php $i = 1; ?>
              @foreach($material_publics as $dt)
                <?php if($i == 5) { $i = 1; } ?>
                @if($i == 1)
                  <tr>
                    <td class="text-center">
                      <button type="button" class="btn btn-box-tool box-title" data-widget="collapse">
                      <div class="box box-default box-solid">
                        <div class="box-header">
                          <div class="box-title">
                              <h3><i class="fa fa-book"></i> {{ $dt->code }}</h3>
                              <p>{{ $dt->course_package_title }}</p>
                          </div>
                        </div>
                @else
                    <td class="text-center">
                      <div class="box box-default box-solid">
                        <div class="box-header">
                          <!--div class="box-title">
                          </div-->
                          <button type="button" class="btn btn-box-tool box-title" data-widget="collapse">
                            <h3><i class="fa fa-book"></i> {{ $dt->code }}</h3>
                            <p>{{ $dt->course_package_title }}</p>
                          </button>
                        </div>
                @endif
                @if($i == 5)
                        </div>
                      </div>
                      </button>
                    </td>
                  </tr>
                @else
                      </div>
                    </div>
                    </button>
                  </td>
                @endif
                <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Main Materials</h3>
          <div class="box-tools pull-right">
            <span class="label label-primary">Label</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Code</th>
                <th>Course Name</th>
                <th>Material Name</th>
                <th>Download</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($material_publics as $dt)
                <tr>
                  @if($dt->code)
                    <td>{{ $dt->code }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>{{ $dt->course_package_title }}</td>
                  <td>{{ $dt->name }}</td>
                  @if($dt->path)
                    <td><a href="{{ $dt->path }}" target="_blank" class="btn btn-flat btn-xs btn-info"><i class="fa fa-download"></i></a></td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>
                    <a class="btn btn-rounded btn-xs btn-primary" href="#"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-rounded btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div -->
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Supplementary Materials</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Code</th>
                <th>Course Name</th>
                <th>Material Name</th>
                <th>Download</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($material_sessions as $dt)
                @foreach(Auth::user()->student->course_registrations as $cr)
                  @if($cr->course_id == $dt->course_id)
                    <tr>
                      @if($dt->code)
                        <td>{{ $dt->code }}</td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      @if($dt->session_title)
                        <td>{{ $dt->session_title }}</td>
                      @elseif($dt->course_title)
                        <td>{{ $dt->course_title }}</td>
                      @else
                        <td>{{ $dt->course_package_title }}</td>
                      @endif
                      <td>{{ $dt->name }}</td>
                      @if($dt->path)
                        <td><a href="{{ $dt->path }}" target="_blank" class="btn btn-flat btn-xs btn-info"><i class="fa fa-download"></i></a></td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      <td>
                        <a class="btn btn-rounded btn-xs btn-primary" href="#"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-rounded btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div -->
      </div>
    </div>
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Material</a>
        </div>
        <div class="box-body no-padding">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Code</th>
                <th>Course / Session</th>
                <th>Material Usage</th>
                <th>Material Name</th>
                <th>Learning Objectives</th>
                <th>Download</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($material_publics as $dt)
                <tr>
                  @if($dt->code)
                    <td>{{ $dt->code }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>{{ $dt->course_package_title }}</td>
                  <td>Public</td>
                  <td>{{ $dt->name }}</td>
                  @if($dt->description)
                    <td>{{ $dt->description }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->path)
                    <td><a href="{{ $dt->path }}" target="_blank" class="btn btn-flat btn-xs btn-info"><i class="fa fa-download"></i></a></td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>
                    <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
                    <a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a>
                  </td>
                </tr>
              @endforeach
              @foreach($material_sessions as $dt)
                @foreach(Auth::user()->student->course_registrations as $cr)
                  @if($cr->course_id == $dt->course_id)
                    <tr>
                      @if($dt->code)
                        <td>{{ $dt->code }}</td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      @if($dt->session_title)
                        <td>{{ $dt->session_title }}</td>
                      @elseif($dt->course_title)
                        <td>{{ $dt->course_title }}</td>
                      @else
                        <td>{{ $dt->course_package_title }}</td>
                      @endif
                      <td>Session</td>
                      <td>{{ $dt->name }}</td>
                      @if($dt->description)
                        <td>{{ $dt->description }}</td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      @if($dt->path)
                        <td><a href="{{ $dt->path }}" target="_blank" class="btn btn-flat btn-xs btn-info"><i class="fa fa-download"></i></a></td>
                      @else
                        <td><i>Not Available</i></td>
                      @endif
                      <td>
                        <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
                        <a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a>
                      </td>
                    </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
