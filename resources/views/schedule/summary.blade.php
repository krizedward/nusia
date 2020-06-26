@extends('layouts.admin.default')

@section('title','Summary')

@push('style')

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('adminlte/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endpush

@push('script')
	<!-- jQuery 3 -->
	<script src="{{ url('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ url('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ url('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- Slimscroll -->
	<script src="{{ url('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<!-- FastClick -->
	<script src="{{ url('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{ url('adminlte/dist/js/adminlte.min.js')}}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ url('adminlte/dist/js/demo.js')}}"></script>
	<!-- fullCalendar -->
	<script src="{{ url('adminlte/bower_components/moment/moment.js')}}"></script>
	<script src="{{ url('adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
	<!-- Page specific script -->
@endpush

@section('content')
	
      <div class="row">

        <div class="col-md-4">

          <div class="callout callout-danger">
            <h4>Class - {{ $class->name }} ( {{ $class->level }} )</h4>
            <form action="{{ url('/classroom') }}">  
              <button type="submit" class="btn btn-danger btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="callout callout-info">
            <h4>Instructor - {{ $instructor->user->name }}</h4>
            <form action="{{ route('classroom.choose',$class->id) }}">  
              <button type="submit" class="btn btn-info btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="callout callout-warning">
            <h4>Time - {{date('H:i s', strtotime($time->time_meet)) }} ( {{ date('d M yy', strtotime($time->date_meet)) }} )</a></h4>
            <form action="{{ route('instructors.choose',[$class->id,$instructor->id]) }}">  
                <button type="submit" class="btn btn-warning btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

      </div>

      <div class="row">
        
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-book"></i> Summary Book Nusia.
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Class</th>
              <th>Level</th>
              <th>Session</th>
              <th>Date</th>
              <th>Time</th>
              <th>Instructor</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>{{ $class->name }}</td>
              <td>{{ $class->level }}</td>
              <td>{{ $class->session }}</td>
              <td>{{date('H:i s', strtotime($time->time_meet)) }}</td>
              <td>{{date('d M yy', strtotime($time->date_meet)) }}</td>
              <td>{{ $instructor->user->name }}</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          
          <form action="{{ route('schedule.savesummary',[$class->id,$instructor->id,$time->time_meet,$time->date_meet,Auth::user()->id]) }}">  
            <button type="submit" class="btn btn-success pull-right">Submit</button>
          </form>
          <form action="{{ route('instructors.choose',[$class->id,$instructor->id]) }}">  
            <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">Back</button>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    </div>

@endsection
