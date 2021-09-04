<!DOCTYPE html>
<html>
<head>
  @include('layouts.admin._head')
</head>
<body class="hold-transition @if(session('skin')) {{ session('skin') }} @else skin-blue-light @endif sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    @include('layouts.admin.header')
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    @include('layouts.admin.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      @yield('content-header')
    </section>

    
    
    <section class="content">
      @include('layouts.admin.flash_message')
      @yield('content')
    </section>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    {{--
    <strong>Made with <i class="fa fa-heart-o"></i> by <a href="https://hehe.co.id">Hehe Corp</a>.</strong>
    --}}
    <strong>Made with <i class="fa fa-heart-o"></i> by <a href="https://nusia.id">Nusantara Indonesia</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include('sweetalert::alert')

@include('layouts.admin._script')
</body>
</html>

