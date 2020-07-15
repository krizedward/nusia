@extends('layouts.admin.default')
@section('title','Course Packages Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Course Packages</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Course Packages</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Packages</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Material Type</th>
                <th>Course Type</th>
                <th>Course Level</th>
                <th>Description</th>
                <th>Number of Session</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  <td>{{ $dt->material_type->name }}</td>
                  <td>{{ $dt->course_type->name }}</td>
                  <td>{{ $dt->course_level->name }}-{{ $dt->course_level_detail->name }}</td>
                  @if($dt->description)
                    <td>{{ $dt->description }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->count_session)
                    <td>{{ $dt->count_session }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->price)
                    <td>{{ $dt->price }}</td>
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