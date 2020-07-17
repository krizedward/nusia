@extends('layouts.admin.default')
@section('title','Student Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Student</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Student</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="{{ route('students.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add Student</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Job Status</th>
                <th>Interest</th>
                <th>Target Language Experience</th>
                <th>Indonesian Language Proficiency</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                  @if($dt->age)
                    <td>{{ $dt->age }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>{{ $dt->status_job }}</td>
                  @if($dt->interest)
                    <td>{{ $dt->interest }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->target_language_experience != 'Others')
                    <td>{{ $dt->target_language_experience }}</td>
                  @else
                    <td>
                      {{ $dt->target_language_experience_value }}
                      @if($dt->target_language_experience_value == 1)
                        year
                      @else
                        years
                      @endif
                    </td>
                  @endif
                  <td>{{ $dt->indonesian_language_proficiency }}</td>
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