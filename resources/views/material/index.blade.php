@extends('layouts.admin.default')

@section('title', 'Share Material')

@push('style')
<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
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

@section('content-header')
  <h1>
    Share Material
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="active">Detail</li>
  </ol>
@endsection

@section('content')

      @if(Auth::user()->level == 'instructor')
      <div class="row">
        <div class="col-md-4">
          <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Material</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" action="{{ url('/material/store') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{Auth::user()->id}}">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Title File</label>
                    <input type="text" name="title" class="form-control">
                  </div>
                  <!-- /.form-group -->
                  
                  <div class="form-group">
                    <label>Class</label>
                      <select class="form-control select2" name="class">
                          <option selected="" disabled="">Choose Class</option>
                          @foreach($class as $dt)
                          <option value="{{$dt->id}}">{{$dt->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <!-- /.form-group -->

                  <div class="form-group">
                    <label>Session</label>
                    <input type="text" name="session" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Upload File</label>
                    <input type="file" name="data">
                  </div>
                  <!-- /.form-group -->

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

        <div class="col-md-8">
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Class</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($class as $e=>$dt)
                <tr>
                  <td>{{ $e+1 }}</td>
                  <td>{{ $dt->name}}-{{ $dt->level}}</td>
                  <td>
                    <p>
                      <a href="{{ route('material.detail', $dt->id) }}" class="btn btn-flat btn-xs btn-info">Detail</a>
                    </p>
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
      @endif

      @if(Auth::user()->level == 'student')
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Class</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($class as $e=>$dt)
                <tr>
                  <td>{{ $e+1 }}</td>
                  <td>{{ $dt->name }}</td>
                  <td>
                    <p>
                      <a href="{{ url('/material/student/'.$dt->id) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-list"></i></a>
                    </p>
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
      @endif

@endsection

@push('script')
<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush