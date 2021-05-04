@extends('layouts.admin.default')

@section('title', 'Form Response')

@include('layouts.css_and_js.all')

@section('content-header')
    <h1><b>Form Response</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Form Response</li>
    </ol>
@stop

@section('content')
  @if($widget_1 != 0)
  <div class="row">
    <div class="col-md-6">
      <div class="small-box bg-aqua-active">
        <div class="inner">
          <h3>{{ $widget_1 }}</h3>
          <p>
            @if($widget_1 == 1)
              Total Feedback Received
            @else
              Total Feedbacks Received
            @endif
          </p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#?" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-6">
      @if($widget_2 * 100 / $widget_2_total >= 50)
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ $widget_2 * 100 / $widget_2_total }}%</h3>
            <p>
              @if($widget_2 == 1)
                Instructors' Performance
              @else
                Instructors' Performance
              @endif
            </p>
          </div>
          <div class="icon">
            <i class="fa fa-battery-full"></i>
          </div>
          <a href="#?" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      @elseif($widget_2 * 100 / $widget_2_total >= 25)
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $widget_2 * 100 / $widget_2_total }}%</h3>
            <p>
              @if($widget_2 == 1)
                Instructors' Performance
              @else
                Instructors' Performance
              @endif
            </p>
          </div>
          <div class="icon">
            <i class="fa fa-battery-half"></i>
          </div>
          <a href="#?" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      @elseif($widget_2 * 100 / $widget_2_total >= 0)
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ $widget_2 * 100 / $widget_2_total }}%</h3>
            <p>
              @if($widget_2 == 1)
                Instructors' Performance
              @else
                Instructors' Performance
              @endif
            </p>
          </div>
          <div class="icon">
            <i class="fa fa-battery-quarter"></i>
          </div>
          <a href="#?" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      @endif
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
  @else
  <div class="row">
    <div class="col-md-12">
      <div class="small-box bg-aqua-active">
        <div class="inner">
          <h3>{{ $widget_1 }}</h3>
          <p>
            @if($widget_1 == 1)
              Total Feedback Received
            @else
              Total Feedbacks Received
            @endif
          </p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#?" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>List of Available Form(s)</b></h3>
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
                    {{-- <a disabled class="btn btn-xs btn-default btn-disabled" href="#?">In Development</a> --}}
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
