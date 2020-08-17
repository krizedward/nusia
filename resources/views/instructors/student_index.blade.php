@extends('layouts.admin.default')

@section('title','Student | Nusia Instructor')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Nusia Instructor</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Instructor</li>
    </ol>
@stop

@section('content')
    <div class="row">
      @foreach($instructors as $dt)
        <div class="col-md-4">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-body">
                    <a href="#" data-toggle="modal" data-target="#{{$dt->id}}">
                      @if($dt->user->image_profile)
                        <img class="img-responsive pad" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                      @else
                        <img class="img-responsive pad" src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
                      @endif
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
                          @if($dt->user->image_profile)
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('uploads/instructor/'.$dt->user->image_profile) }}" alt="User profile picture">
                          @else
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/avatar5.png') }}" alt="User profile picture">
                          @endif

                            <h3 class="profile-username text-center">{{$dt->user->first_name}} {{$dt->user->last_name}}</h3>

                            <p class="text-muted text-center">This box describes the professional experience(s) and interest(s) of {{$dt->user->first_name}} {{$dt->user->last_name}}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Professional Experiences</b>
                                    @foreach(explode('|| ', $dt->working_experience) as $we)
                                      <p>
                                        {{$we}}
                                      </p>
                                    @endforeach
                                </li>
                                <li class="list-group-item">
                                    <b>Interest</b>
                                    @foreach(explode(', ', $dt->interest) as $in)
                                      <p>
                                        {{$in}}
                                      </p>
                                    @endforeach
                                </li>
                            </ul>

                            @if(Auth::user()->citizenship == 'Not Available')
                              <div class="text-center"><b>To continue, please complete the account confirmation.</b></div>
                            @else
                              <a href="#" class="btn btn-primary btn-block"><b>Choose</b></a>
                            @endif
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
@stop
