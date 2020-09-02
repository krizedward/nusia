@extends('layouts.admin.default')

@section('title', 'Form Response')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Form Response</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Form Response</li>
    </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $widget_1 }}</h3>
          <p>
            @if($widget_1 == 1)
              Feedback
            @else
              Feedbacks
            @endif
          </p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-4">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $widget_2 * 100 / $widget_1 }}%</h3>
          <p>
            Positive Performance of Instructors
          </p>
        </div>
        <div class="icon">
          <i class="fa fa-check-square-o"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-4">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $widget_3 * 100 / $widget_1 }}%</h3>
          <p>
            Negative Performance of Instructors
          </p>
        </div>
        <div class="icon">
          <i class="fa fa-times-circle-o"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- /.col -->
    {{-- <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
        <div class="info-box-content">
          @if($widget_1 == 1)
            <span class="info-box-text">There is</span>
            <span class="info-box-number">{{ $widget_1 }} Feedback Received</span>
          @else
            <span class="info-box-text">There are</span>
            <span class="info-box-number">{{ $widget_1 }} Feedbacks Received</span>
          @endif
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- /.col --> --}}
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">List of Available Form(s)</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th style="width:250px;">Form Title</th>
                <th>Form Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($forms as $i => $dt)
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $dt->title }}</td>
                  <td>
                    <?php
                      $description = explode('||', $dt->description);
                    ?>
                    @foreach($description as $d)
                      {{ $d }}<br>
                    @endforeach
                  </td>
                  <td>
                    <a class="btn btn-xs btn-success" href="{{ route('form_responses.index_form', $dt->id) }}">View Details</a>
                    {{-- <a class="btn btn-xs btn-default disabled" href="#?">In Development</a> --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@stop
