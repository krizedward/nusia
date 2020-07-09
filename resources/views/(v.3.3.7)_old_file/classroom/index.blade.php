@extends('layouts.admin.default')

@section('title', 'Class Nusia')

@push('style')
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
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
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
@endpush

@push('script')
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="{{ url('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{ url('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('adminlte/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('adminlte/dist/js/demo.js')}}"></script>
@endpush

@section('content')
      <div class="row">
        <div class="col-md-4">

          <div class="callout callout-danger">
            <h4>Class</h4>
            <form action="{{ url('/classroom') }}">  
              <button type="submit" class="btn btn-danger btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="callout callout-default">
            <h4>Instructor</h4>
            <form action="#">  
              <button type="submit" class="btn btn-block btn-default disabled">Select</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="callout callout-default">
            <h4>Time</a></h4>
            <form action="#">  
              <button type="submit" class="btn btn-block btn-default disabled">Select</button>
            </form>
          </div>
        </div>

      </div>

      <div class="row">

        @foreach($data as $dt)
        <div class="col-md-4">
          <!-- Box Comment -->
          
          <div class="box box-widget">
          	<div class="box-header with-border">
	        	<h3 class="box-title">{{ $dt->name }} - {{ $dt->level}}</h3>
	        </div>
	        <!-- /.box-header-->
            <div class="box-body">
              <a href="{{ route('classroom.choose',$dt->id) }}">
                  <img class="img-responsive pad" src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="Photo">
                </a>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            	<div class="pull-left">
            		<p>Description :</p>
            		<p>{{ $dt->detail }}</p>
            	</div>
            	<div class="pull-right">
            		<p>Session : {{ $dt->session }}</p>
            	</div>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        @endforeach
      </div>
@endsection