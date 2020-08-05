@extends('layouts.admin.default')
@section('title','Material Session Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Material Session</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Material Session</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Material Session</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Course Title</th>
                <th>Session Title</th>
                <th>Material Name</th>
                <th>Instructor Name</th>
                <th>Learning Objectives</th>
                <th>Download</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  @if($dt->session->course->title)
                    <td>{{ $dt->session->course->title }}</td>
                  @else
                    <td>{{ $dt->session->course->course_package->title }}</td>
                  @endif
                  @if($dt->session->title)
                    <td>{{ $dt->session->title }}</td>
                  @else
                    <?php
                      $number = 1;
                      foreach($dt->session->course->sessions as $d) {
                        if($d->slug == $dt->slug) break;
                        $number = $number + 1;
                      }
                    ?>
                    <td>Session {{ $number }}</td>
                  @endif
                  <td>{{ $dt->name }}</td>
                  <td>{{ $dt->session->schedule->instructor->user->first_name }} {{ $dt->session->schedule->instructor->user->last_name }}</td>
                  @if($dt->description)
                    <td>{{ $dt->description }}</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->path)
                    <td><a href="{{ $dt->path }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-download"></i></a></td>
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
