@extends('layouts.auth.default')

@section('title', 'Reset Password')

@section('content-old')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>Nusantara</b> Indonesia</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="post">
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

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Send Password Reset Link') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
        <p class="login-box-msg"><a href="{{ route('login') }}">Back</a></p>
    </div>
    <!-- /.login-box -->
@stop
