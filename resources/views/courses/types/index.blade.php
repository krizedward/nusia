@extends('layouts.admin.default')
@section('title','Course Types Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Course Types</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Course Types</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Types</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Minimum Attendee</th>
                <th>Maximum Attendee</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  <td>{{ $dt->code }}</td>
                  <td>{{ $dt->name }}</td>
                  @if($dt->description)
                    <td>{{ $dt->description }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->count_student_min)
                    <td>{{ $dt->count_student_min }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->count_student_max)
                    <td>{{ $dt->count_student_max }}</td>
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