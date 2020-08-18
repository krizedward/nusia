@section('old')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nusia | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition">
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>Nusantara</b> Indonesia</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Please enter your email and password.</p>

    <form action="{{ route('login') }}" method="post">
      @csrf

      @if($errors->has('email'))
      <div class="form-group has-error">
        <label>Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
        <span class="help-block">{{ $errors->first('email')}}</span>
      </div>
      @else
      <div class="form-group">
        <label>Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
      </div>
      @endif

      @if($errors->has('password'))
      <div class="form-group has-error">
        <label>Password</label>
        <input id="password" type="password" class="form-control" name="password">
        <span class="help-block">{{ $errors->first('password')}}</span>
      </div>
      @else
      <div class="form-group">
        <label>Password</label>
        <input id="password" type="password" class="form-control" name="password">
      </div>
      @endif
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
@stop

@extends('layouts.auth.default')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>Nusantara</b> Indonesia</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <form action="{{ route('login') }}" method="post">
                @csrf
                @if($errors->has('email'))
                  <div class="form-group has-error has-feedback">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <p style="color:#ff0000;">{{ $errors->first('email') }}</p>
                  </div>
                @else
                  <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                @endif

                @if($errors->has('password'))
                  <div class="form-group has-error has-feedback">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <p style="color:#ff0000;">{{ $errors->first('password') }}</p>
                  </div>
                @else
                  <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password"  placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->

        <p class="login-box-msg"><a href="{{ route('password.request') }}">Forget your password</a></p>

        <p class="login-box-msg">Doesn't have an account? <a href="{{ route('register') }}">Register</a> here</p>
    </div>
    <!-- /.login-box -->
@stop

