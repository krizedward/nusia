@extends('layouts.auth.default')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>Nusantara</b> Indonesia</a>
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

        <p class="login-box-msg">Don't have an account? <a href="{{ route('register') }}">Register</a> here</p>
    </div>
    <!-- /.login-box -->
@stop

