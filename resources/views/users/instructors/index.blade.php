@extends('layouts.admin.default')
@section('title','Instructor Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Instructor</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Instructor</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Instructor</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Profile Image</th>
                <th>Name</th>
                <th>Interest</th>
                <th>Working Experience</th>
                <th>Educational Experience</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  @if($dt->user->image_profile)
                    <td><img src="{{ asset('uploads/user.jpg') }}" style="width: 50px"></td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                  @if($dt->interest)
                    <td>{{ $dt->interest }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->working_experience)
                    <td>{{ $dt->working_experience }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->educational_experience)
                    <td>{{ $dt->educational_experience }}</td>
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
