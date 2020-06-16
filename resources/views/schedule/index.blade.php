@extends('layouts.admin.default')

@section('title','Schedule')

@if(Auth::user()->level == 'instructor')

@section('content-header')
  <h1>
    Schedule
    <small>learning</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="active">Schedule</li>
  </ol>
@endsection

@section('content')
  <div class="row">

    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Schedule Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Student Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Class</th>
              <th>Action</th>
            </tr>
            </thead>
                  
            <tbody>
            @foreach($data as $e=>$dt)
              @if($dt->schedule->instructor_id == $role->id && $dt->status == 'Request')
              <tr>
                <td>{{ $dt->schedule->student->user->name}}</td>
                <td>{{ date('h:i A', strtotime($dt->schedule->time_meet)) }}</td>
                <td>{{ date('d-M-Y', strtotime($dt->schedule->date_meet)) }}</td>
                <td>{{ $dt->schedule->class->name }}</td>
                <td>
                  <a class="btn btn-flat btn-xs btn-success" href="{{url('verfication-schedule/'.Auth::user()->id.'/'.$dt->id)}}">Accept</a>
                  <a class="btn btn-flat btn-xs btn-danger" href="{{url('verfication-schedule/'.Auth::user()->id.'/'.$dt->id)}}">Decline</a>
                </td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.row -->
@endsection

@endif

<!-- student -->
@if(Auth::user()->level == 'student')

@section('content-header')
  <h1>
    Schedule
    <small>learning</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="active">Schedule</li>
  </ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Select Schedule</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="post" action="{{ url('/schedule/store') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{Auth::user()->id}}">
          <div class="row">
            <div class="col-md-6">

              @if($errors->has('instructor_id'))
              <div class="form-group has-error">
                <label>Instructor</label>
                <select class="form-control select2" style="width: 100%;" name="instructor_id">
                  <option selected="" disabled="">Choose Instructor..</option>
                  @foreach($instructor as $dt)
                  <option value="{{$dt->id}}">{{$dt->user->name}}</option>
                  @endforeach
                </select>
                <span class="help-block">{{ $errors->first('instructor_id')}}</span>
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Instructor</label>
                <select class="form-control select2" style="width: 100%;" name="instructor_id">
                  <option selected="" disabled="">Choose Instructor..</option>
                  @if(!empty($choose))
                    @foreach($instructor as $dt)
                      <option value="{{$dt->id}}"{{ ($choose->id == $dt->id) ? 'selected' : '' }}>{{$dt->user->name}}</option>
                    @endforeach
                  @else
                    @foreach($instructor as $dt)
                      <option value="{{$dt->id}}">{{$dt->user->name}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <!-- /.form-group -->
              @endif

              @if($errors->has('class_id'))
              <div class="form-group has-error">
                <label>Class</label>
                <select class="form-control select2" style="width: 100%;" name="class_id">
                  <option selected="" disabled="">Choose Class..</option>
                  @foreach($class as $dt)
                  <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                  @endforeach
                </select>
                <span class="help-block">{{ $errors->first('class_id')}}</span>
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Class</label>
                <select class="form-control select2" style="width: 100%;" name="class_id">
                  <option selected="" disabled="">Choose Class..</option>
                  @foreach($class as $dt)
                  <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->
              @endif

              @if($errors->has('date_meet'))
              <div class="form-group has-error">
                <label>Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="date_meet">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="date_meet">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @endif
            </div>
            <!-- /.col -->

            <div class="col-md-6">
             
              @if($errors->has('time_meet'))
              <div class="form-group">
                <label>Time</label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="time_meet">

                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <span class="help-block">{{ $errors->first('time_meet')}}</span>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Time</label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="time_meet">

                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @endif
              
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>

    <!-- /.col -->
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
        	<h3 class="box-title">Schedule Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Instructor Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Class</th>
              <th>Status</th>
            </tr>
            </thead>
                  
            <tbody>
            @foreach($data as $e=>$dt)
              @if($dt->schedule->student_id == $role->id)
              <tr>
                <td>{{ $dt->schedule->instructor->user->name}}</td>
                <td>{{ date('h:i A', strtotime($dt->schedule->time_meet)) }}</td>
                <td>{{ date('d-M-Y', strtotime($dt->schedule->date_meet)) }}</td>
                <td>{{ $dt->schedule->class->name }}</td>
                <td>{{ $dt->status }}</td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.row -->
@endsection

@endif
<!-- admin -->
@if(Auth::user()->level == 'admin')
<p>Hello Admin</p>
@endif

@push('style')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endpush

@push('script')
<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@endpush
