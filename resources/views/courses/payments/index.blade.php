@extends('layouts.admin.default')
@section('title','Course Payment Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Course Payment </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Course Payment </li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Payment </a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Course Title</th>
                <th>Student Name</th>
                <th>Payment Method</th>
                <th>Payment Amount</th>
                <th>Payment Time</th>
                <th>Payment Status</th>
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
                  <td>{{ $dt->method }}</td>
                  @if($dt->amount)
                    <td>{{ $dt->amount }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>{{ $dt->payment_time }}</td>
                  <td>{{ $dt->status }}</td>
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