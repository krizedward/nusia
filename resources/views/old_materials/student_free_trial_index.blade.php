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
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Material</a>
        </div>
        <div class="box-body">
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
