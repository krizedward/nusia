@extends('layouts.admin.default')

@section('title', 'Chat')

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Chat</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Chat</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title"><b>Your Contacts</b></h3>
          {{--
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
          --}}
        </div>
        <div class="box-body">
          <div class="direct-chat-contacts-open">
            <ul class="contacts-list">
              <?php
                $arr = [];
              ?>
              @foreach($messages as $m)
                <?php
                  $user_id = ($m->user_id_sender != Auth::user()->id)? $m->user_id_sender : $m->user_id_recipient;
                  $dt = $users->where('id', $user_id)->first();
                  if(in_array($user_id, $arr)) continue;
                  array_push($arr, $user_id);
                  
                  if(Auth::user()->roles == 'Student') {
                    if($dt->roles == 'Admin') {
                      $route_name = 'non_admin.chat_admin.show';
                    } else if($dt->roles == 'Financial Team') {
                      $route_name = 'student.chat_financial_team.show';
                    } else if($dt->roles == 'Lead Instructor') {
                      $route_name = 'student.chat_lead_instructor.show';
                    } else if($dt->roles == 'Instructor') {
                      $route_name = 'student.chat_instructor.show';
                    } else if($dt->roles == 'Customer Service') {
                      $route_name = 'student.chat_customer_service.show';
                    }
                  } else if(Auth::user()->roles == 'Instructor') {
                    if($dt->roles == 'Admin') {
                      $route_name = 'non_admin.chat_admin.show';
                    } else if($dt->roles == 'Instructor') {
                      $route_name = 'instructor.chat_instructor.show';
                    } else if($dt->roles == 'Student') {
                      $route_name = 'instructor.chat_student.show';
                    }
                  } else if(Auth::user()->roles == 'Lead Instructor') {
                    if($dt->roles == 'Admin') {
                      $route_name = 'non_admin.chat_admin.show';
                    } else if($dt->roles == 'Instructor') {
                      $route_name = 'instructor.chat_instructor.show';
                    } else if($dt->roles == 'Student') {
                      $route_name = 'lead_instructor.chat_student.show';
                      //$route_name_2 = 'lead_instructor.chat_student_alternative_meeting.show';
                    }
                  } else if(Auth::user()->roles == 'Customer Service') {
                    if($dt->roles == 'Admin') {
                      $route_name = 'non_admin.chat_admin.show';
                    } else if($dt->roles == 'Student') {
                      $route_name = 'customer_service.chat_student.show';
                    }
                  } else if(Auth::user()->roles == 'Financial Team') {
                    if($dt->roles == 'Admin') {
                      $route_name = 'non_admin.chat_admin.show';
                    } else if($dt->roles == 'Student') {
                      $route_name = 'financial_team.chat_student.show';
                    }
                  }
                ?>
                <li>
                  <a href="{{ route($route_name, [$dt->id]) }}">
                    @if($dt->image_profile != 'user.jpg')
                      @if($dt->roles == 'Student')
                        <img class="contacts-list-img" src="{{ asset('uploads/student/profile/' . $dt->image_profile) }}" alt="User image.">
                      @elseif($dt->roles == 'Instructor' || $dt->roles == 'Lead Instructor')
                        <img class="contacts-list-img" src="{{ asset('uploads/instructor/' . $dt->image_profile) }}" alt="User image.">
                      @elseif($dt->roles == 'Customer Service')
                        <img class="contacts-list-img" src="{{ asset('uploads/cs-profile/' . $dt->image_profile) }}" alt="User image.">
                      @elseif($dt->roles == 'Financial Team')
                        <img class="contacts-list-img" src="{{ asset('uploads/finance-profile/' . $dt->image_profile) }}" alt="User image.">
                      @elseif($dt->roles == 'Admin')
                        <img class="contacts-list-img" src="{{ asset('uploads/user.jpg') }}" alt="User image.">
                      @endif
                    @else
                      <img class="contacts-list-img" src="{{ asset('uploads/user.jpg') }}" alt="User image.">
                    @endif
                    <div class="contacts-list-info">
                      <span class="contacts-list-name text-black">
                        {{ $dt->first_name }} {{ $dt->last_name }}
                        <small class="contacts-list-date pull-right">YYYY/MM/DD</small>
                      </span>
                      <span class="contacts-list-msg">
                        This is the message {{-- $dt->messages->last()->message --}}
                      </span>
                    </div>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Chat box -->
    <div class="col-md-9">
      <div class="box box-warning direct-chat direct-chat-warning">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Chat Box</b></h3>
          {{--
          <div class="box-tools pull-right">
            <span data-toggle="tooltip" title class="badge bg-blue" data-original-title="3 New Messages">3</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          --}}
        </div>
        <div class="box-body">
          <div class="direct-chat-messages">
            <div class="direct-chat-msg">
              <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left">How to use this feature</span>
              </div>
              <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
              <div class="direct-chat-text">
                Welcome to NUSIA chat box! To add new contacts, explore the members from each NUSIA course and have conversations using this feature. If you have any question regarding this feature, kindly chat "NUSIA Admin" or email us at nusia.helpdesk@gmail.com :)
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="input-group">
            <input type="text" name="message" placeholder="Sending messages are disabled for this contact." class="form-control" disabled>
            <span class="input-group-btn">
              <button type="button" class="btn btn-warning" disabled aria-label="Send message."><i class="fa fa-send-o"></i></button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
@stop
