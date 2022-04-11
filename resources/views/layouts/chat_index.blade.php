@extends('layouts.admin.default')

@section('title', 'Chat')

@include('layouts.css_and_js.all')

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
      <div class="box @if(session('chat-color')) {{ 'box-' . session('chat-color') }} @else box-warning @endif">
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
              @if($messages->toArray() != null)
                <?php
                  $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                  $schedule_yesterday = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                  $schedule_yesterday->sub('1', 'day');
                ?>
                @foreach($messages as $m)
                  <?php
                    $user_id = ($m->user_id_sender != Auth::user()->id)? $m->user_id_sender : $m->user_id_recipient;
                    $dt = $users->where('id', $user_id)->first();
                    if(!$dt) continue;
                    
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
                      } else if($dt->roles == 'Student') {
                        $route_name = 'student.chat_student.show';
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
                          <?php
                            $name = $dt->first_name . ' ' . $dt->last_name;
                            $get_time = \Carbon\Carbon::parse($m->created_at)->setTimezone(Auth::user()->timezone);
                          ?>
                          @if(Str::length($name) > 14)
                            <span data-toggle="tooltip" title data-original-title="{{ $name }}">
                              {{ Str::limit($name, 14) }}
                            </span>
                          @else
                            {{ $name }}
                          @endif
                          @if($schedule_now->isoFormat('YYYY/MM/DD') == $get_time->isoFormat('YYYY/MM/DD'))
                            <small class="contacts-list-date pull-right">Today</small>
                          @elseif($schedule_yesterday->isoFormat('YYYY/MM/DD') == $get_time->isoFormat('YYYY/MM/DD'))
                            <small class="contacts-list-date pull-right">Yesterday</small>
                          @else
                            <small class="contacts-list-date pull-right">{{ $get_time->isoFormat('YYYY/MM/DD') }}</small>
                          @endif
                        </span>
                        <span class="contacts-list-msg">
                          @if($m->user_id_sender == Auth::user()->id)
                            <i class="fa fa-check"></i>
                          @endif
                          @if(Str::length($m->message) > 50)
                            <span data-toggle="tooltip" title data-original-title="{{ $m->message }}">
                              {{ Str::limit($m->message, 50) }}
                            </span>
                          @else
                            {{ $m->message }}
                          @endif
                        </span>
                      </div>
                    </a>
                  </li>
                @endforeach
              @else
                <p class="text-muted">No contacts available.</p>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Chat box -->
    <div class="col-md-9">
      <div class="box @if(session('chat-color')) {{ 'box-' . session('chat-color') }} direct-chat {{ 'direct-chat-' . session('chat-color') }} @else box-warning direct-chat direct-chat-warning @endif">
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
          <div class="direct-chat-messages" {{-- style="height:100%;" --}}>
            <div class="direct-chat-msg">
              <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left">How to use this feature</span>
              </div>
              <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}" alt="An image.">
              <div class="direct-chat-text">
                Welcome to NUSIA chat box!
                Add new contacts by exploring each NUSIA course members.
                If you have any question regarding this feature,
                kindly chat <b>"NUSIA Admin"</b> <a class="btn btn-xs btn-success" href="{{ route('non_admin.chat_admin.show', [1]) }}">here</a>
                or email us on <b>nusia.helpdesk@gmail.com</b> <a class="btn btn-xs btn-primary" href="mailto:nusia.helpdesk@gmail.com">here</a>
                Have a great day :)
              </div>
            </div>
            <div class="direct-chat-msg right">
              <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-right">You might like this</span>
              </div>
              @if(Auth::user()->image_profile != 'user.jpg')
                @if(Auth::user()->roles == 'Student')
                  <img class="direct-chat-img" src="{{ asset('uploads/student/profile/' . Auth::user()->image_profile) }}" alt="User image.">
                @elseif(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
                  <img class="direct-chat-img" src="{{ asset('uploads/instructor/' . Auth::user()->image_profile) }}" alt="User image.">
                @elseif(Auth::user()->roles == 'Customer Service')
                  <img class="direct-chat-img" src="{{ asset('uploads/cs-profile/' . Auth::user()->image_profile) }}" alt="User image.">
                @elseif(Auth::user()->roles == 'Financial Team')
                  <img class="direct-chat-img" src="{{ asset('uploads/finance-profile/' . Auth::user()->image_profile) }}" alt="User image.">
                @elseif(Auth::user()->roles == 'Admin')
                  <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}" alt="User image.">
                @endif
              @else
                <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}" alt="User image.">
              @endif
              <div class="direct-chat-text">
                Want to try these buttons? But don't forget the schedules :)<br />
                <a class="btn btn-xs btn-default" href="{{ route('registered.chat.index', [0, 1]) }}">More than @if(session('chat-color-alias')) {{ session('chat-color-alias') }}? @else yellow? @endif</a>
                <a class="btn btn-xs btn-default" href="{{ route('registered.chat.index', [1]) }}">@if(session('skin')) Feel free to decorate your dashboard @else Feeling lucky @endif :)</a>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="input-group">
            <input type="text" name="message" placeholder="Chat is disabled for this contact." class="form-control" disabled>
            <span class="input-group-btn" data-toggle="tooltip" title data-original-title="Send message">
              <button type="button" class="btn @if(session('chat-color')) {{ 'btn-' . session('chat-color') }} @else btn-warning @endif" disabled aria-label="Chat is disabled for this contact."><i class="fa fa-send-o"></i></button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
@stop
