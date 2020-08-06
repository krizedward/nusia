@extends('layouts.admin.default')
@section('title','Course Certificate Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Course Certificate</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Course Certificate</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Certificate</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Course Name</th>
                <th>Student Name</th>
                <th>Certificate Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  @if($dt->course_registration->course->title)
                    <td>{{ $dt->course_registration->course->title }}</td>
                  @else
                    <td>{{ $dt->course_registration->course->course_package->title }}</td>
                  @endif
                  <td>{{ $dt->course_registration->student->user->first_name }} {{ $dt->course_registration->student->user->last_name }}</td>
                  @if($dt->path)
                    <td><a target="_blank" rel="noopener noreferrer" href="{{ $dt->path }}">Link Certificates</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>
                    <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
                    <a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop