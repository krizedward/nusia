@extends('layouts.admin.default')

@section('title', 'Instructor')

@section('content-header')
  <h1>
    Instructor
    <small>learning</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="active">Instructor</li>
  </ol>
@endsection

@section('content')

      <div class="row">

        @foreach($data as $dt)
        <div class="col-md-4">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-body">
              <a href="#" data-toggle="modal" data-target="#{{$dt->id}}">
                  <img class="img-responsive pad" src="{{ url('upload/nusia-ins/'.$dt->image) }}" alt="Photo">
                </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="modal fade" id="{{$dt->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ url('upload/nusia-ins/'.$dt->image) }}" alt="User profile picture">

                <h3 class="profile-username text-center">{{$dt->user->name}}</h3>

                <p class="text-muted text-center">I am Your Instructor</p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Professional Experiences</b> 
                    <p>
                      {{ $dt->pro_experiences }}
                    </p>
                  </li>
                  <li class="list-group-item">
                    <b>Interest</b>
                    <p>{{ $dt->interest }}</p>
                  </li>
                </ul>

                <a href="{{ url('/schedule/'.Auth::user()->id).'/'.$dt->id }}" class="btn btn-primary btn-block"><b>Choose</b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        @endforeach
      </div>

@endsection


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