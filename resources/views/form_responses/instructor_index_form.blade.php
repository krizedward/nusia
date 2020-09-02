@extends('layouts.admin.default')

@section('title', 'Form Response')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Form Response, Filtered by Form Title</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('form_responses.index') }}">Form Response</a></li>
        <li class="active">Filter by Form Title</li>
    </ol>
@stop

@section('content')
  <div class="row">
    @if($form_widget_1)
      <div class="col-md-4">
        <!-- Widget -->
        <div class="box box-widget widget-user">
          <div class="box-header bg-yellow" style="margin:0px; padding:0px;">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" style="color:#ffffff;" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-yellow">
            <h3 class="widget-user-username">Rating 1</h3>
            <h5 class="widget-user-desc">The instructors help me to improve my bahasa Indonesia proficiency.</h5>
          </div>
          <div class="box-footer no-padding">
            <?php
              $arr = [];
              foreach($form_widget_1 as $fw) {
                foreach($fw->form_question->form_question_choices as $fqc) {
                  // Suitable for text-like and radiobox answer. This is not suitable for checkbox choice(s).
                  if($fw->form_response_details->first()->answer == $fqc->answer) {
                    array_push($arr, $fqc->answer);
                    break;
                  }
                }
              }
              if($form_widget_1->first()) {
                foreach($form_widget_1->first()->form_question->form_question_choices as $fqc) {
                  array_push($arr, $fqc->answer); // menambahkan index pada array untuk menghindari undefined index pada waktu menampilkan hasil count array element.
                }
              }
            ?>
            <ul class="nav nav-stacked">
              @if($form_widget_1->first())
                @foreach($form_widget_1->first()->form_question->form_question_choices as $fqc)
                  {{-- Reserved keyword(s) --}}
                  @if($fqc->answer == 'Poor')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-red">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Good')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-yellow">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Great')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-green">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @endif
                  @if($fqc->answer == 'Strongly Disagree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-red">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Disagree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-orange">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Partly Agree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-yellow">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Agree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-green">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Strongly Agree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-blue">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @endif
                @endforeach
              @else
                <li><a href="#?">No results.</a></li>
              @endif
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->
    @endif
    @if($form_widget_2)
      <div class="col-md-4">
        <!-- Widget -->
        <div class="box box-widget widget-user">
          <div class="box-header bg-maroon" style="margin:0px; padding:0px;">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" style="color:#ffffff;" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-maroon">
            <h3 class="widget-user-username">Rating 2</h3>
            <h5 class="widget-user-desc">How would you rate the instructors’ overall performance?</h5>
          </div>
          <div class="box-footer no-padding">
            <?php
              $arr = [];
              foreach($form_widget_2 as $fw) {
                foreach($fw->form_question->form_question_choices as $fqc) {
                  // Suitable for text-like and radiobox answer. This is not suitable for checkbox choice(s).
                  if($fw->form_response_details->first()->answer == $fqc->answer) {
                    array_push($arr, $fqc->answer);
                    break;
                  }
                }
              }
              if($form_widget_2->first()) {
                foreach($form_widget_2->first()->form_question->form_question_choices as $fqc) {
                  array_push($arr, $fqc->answer); // menambahkan index pada array untuk menghindari undefined index pada waktu menampilkan hasil count array element.
                }
              }
            ?>
            <ul class="nav nav-stacked">
              @if($form_widget_2->first())
                @foreach($form_widget_2->first()->form_question->form_question_choices as $fqc)
                  {{-- Reserved keyword(s) --}}
                  @if($fqc->answer == 'Poor')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-red">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Good')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-yellow">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Great')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-green">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @endif
                  @if($fqc->answer == 'Strongly Disagree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-red">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Disagree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-orange">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Partly Agree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-yellow">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Agree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-green">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @elseif($fqc->answer == 'Strongly Agree')
                    <li><a href="#?">{{ $fqc->answer }} <span class="pull-right badge bg-blue">{{ array_count_values($arr)[$fqc->answer] - 1 }}</span></a></li>
                  @endif
                @endforeach
              @else
                <li><a href="#?">No results.</a></li>
              @endif
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->
    @endif
    @if($form_widget_3)
      <div class="col-md-4">
        <!-- Widget -->
        <div class="box box-widget widget-user">
          <div class="box-header bg-purple" style="margin:0px; padding:0px;">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" style="color:#ffffff;" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-purple">
            <h3 class="widget-user-username">Rating 3</h3>
            <h5 class="widget-user-desc">Give comments what to improve for our instructors (time management, teaching delivery, etc)</h5>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
              @foreach($form_widget_3 as $fw)
                <li><a href="#?">{{ $fw->form_response_details->first()->answer }}</a></li>
                {{-- <li><a href="#">Nama <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> --}}
              @endforeach
              @if($form_widget_3->first() == null)
                <li><a href="#?">No results.</a></li>
              @endif
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->
    @endif
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#summary" data-toggle="tab"><b>Summary</b></a></li>
          <li><a href="#individual" data-toggle="tab"><b>Individual</b></a></li>
        </ul>
      </div>
    </div>
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
                    <a class="btn btn-xs btn-success" href="{{ route('form_responses.index_form', $dt->id) }}" target="_blank">View Details</a>
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
