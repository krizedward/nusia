@extends('layouts.admin.default')

@section('title','Calendar')

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

	<script>
	  $(function () {

	    /* initialize the calendar
	     -----------------------------------------------------------------*/
	    //Date for the calendar events (dummy data)
	    var date = new Date()
	    var d    = date.getDate(),
	        m    = date.getMonth(),
	        y    = date.getFullYear()
	    $('#calendar').fullCalendar({
	      header    : {
	        left  : 'prev,next today',
	        center: 'title',
	        right : 'month,agendaWeek'
	      },
	      buttonText: {
	        today: 'today',
	        month: 'month',
	        week : 'week',
	      },
	      //Random default events
	      events    : [
	      //mengambil data dari model
	      	@foreach($data as $dt)
            @if($dt->instructor_id == $instructor->id)
    	       	{
    	        	title 	: '{{ $dt->instructor->user->name }}',
    	            start 	: '{{ $dt->date_meet }} {{ $dt->time_meet }}',
    	            url 	: '{{ route('schedule.summary', [$class->id,$instructor->id,$dt->id,]) }}'
    	        },
            @endif
	        @endforeach
	      ],
	      editable  : false,
	      droppable : false, // this allows things to be dropped onto the calendar !!!
	      
	    })

	  })//end
	</script>
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
            <h4>Time</a></h4>
            <form action="#">  
                <button type="submit" class="btn btn-warning btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Date Available</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Date</th>
                  </tr>
                  @foreach($data as $dt)
                    @if($dt->instructor_id == $instructor->id)
                      <tr>
                        <td>1</td>
                        <td>{{ date('d M yy', strtotime($dt->date_meet))}}</td>
                      </tr>
                    @endif
                  @endforeach
                </table>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection