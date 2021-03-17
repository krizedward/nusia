@extends('layouts.auth.default')

@section('content')
  <div class="register-box">
    <div class="register-logo">
      <a href="{{ url('/') }}"><b>Nusantara</b> Indonesia</a>
    </div>
    <div class="register-box-body">
      <p class="login-box-msg">Registration Form</p>
      <form action="{{ route('register') }}" method="post">
        @csrf

        @if($errors->has('first_name'))
          <div class="form-group has-error has-feedback">
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus placeholder="First Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <p style="color:#ff0000;">{{ $errors->first('first_name') }}</p>
          </div>
        @else
          <div class="form-group has-feedback">
            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus placeholder="First Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
        @endif

        @if($errors->has('last_name'))
          <div class="form-group has-error has-feedback">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <p style="color:#ff0000;">{{ $errors->first('last_name') }}</p>
          </div>
        @else
          <div class="form-group has-feedback">
            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
        @endif

        @if($errors->has('email'))
        <div class="form-group has-error has-feedback">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <p style="color:#ff0000;">{{ $errors->first('email') }}</p>
        </div>
        @else
        <div class="form-group has-feedback">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
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

        @if($errors->has('password_confirmation'))
        <div class="form-group has-error has-feedback">
          <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <p style="color:#ff0000;">{{ $errors->first('password_confirmation') }}</p>
        </div>
        @else
        <div class="form-group has-feedback">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        @endif

        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
    <p class="login-box-msg">Already have an account? <a href="{{ route('login') }}">Login</a> here</p>
  </div>
  <!-- /.register-box -->
@stop
