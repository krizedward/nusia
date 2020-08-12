@extends('layouts.admin.default')

@section('title','Email Verify')

@include('layouts.css_and_js.table')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Verify Your Email Address') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('content-old')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
