@extends('layouts.admin.default')

@section('title','Detailed Form Response')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>
      Form Response from {{ $session_registration->course_registration->student->user->first_name }} {{ $session_registration->course_registration->student->user->last_name }}<br>
      for {{ $session_registration->session_registration_forms->first()->form_response->form_question->form->title }}
    </b></h1>
    <ol class="breadcrumb"><br><br>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('form_responses.index') }}">Form Response</a></li>
        <li><a href="{{ route('form_responses.index_form', $session_registration->session_registration_forms->first()->form_response->form_question->form->id) }}">Filter by Form Title</a></li>
        <li class="active">{{ $session_registration->course_registration->student->user->first_name }} {{ $session_registration->course_registration->student->user->last_name }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if($session_registration->course_registration->student->user->image_profile != 'user.jpg')
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.$session_registration->course_registration->student->user->image_profile) }}" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.$session_registration->course_registration->student->user->image_profile) }}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ $session_registration->course_registration->student->user->first_name }} {{ $session_registration->course_registration->student->user->last_name }}</h3>
                    <p class="text-muted text-center">{{ $session_registration->course_registration->student->user->roles }} Nusia</p>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="active tab-pane">
                        {{--None--}}
                        @foreach($session_registration->session_registration_forms as $srf)
                          <strong>{{ $srf->form_response->form_question->question }}</strong>
                          <p>{{ $srf->form_response->form_response_details->first()->answer }}</p>
                          <hr>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
