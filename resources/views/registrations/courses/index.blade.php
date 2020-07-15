@extends('layouts.admin.default')
@section('title','Course Registration Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Course Registration</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Course Registration</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Registration</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Course Title</th>
                <th>Student Name</th>
                <th>Registration Time</th>
                <th>Payment Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  @if($dt->course->title)
                    <td>{{ $dt->course->title }}</td>
                  @else
                    <td>{{ $dt->course->course_package->title }}</td>
                  @endif
                  <td>{{ $dt->student->user->first_name }} {{ $dt->student->user->last_name }}</td>
                  @if($dt->created_at)
                    <td>{{ $dt->created_at }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->course_payment && $dt->course_payment->status)
                    <td>{{ $dt->course_payment->status }}</td>
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