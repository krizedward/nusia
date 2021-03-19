@extends('layouts.admin.default')

@section('title', 'Chat - ' . $partner->roles)

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Chat - {{ $partner->roles }}</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li><a href="{{ route('registered.chat.index') }}">Chat</a></li>
    <li class="active">{{ $partner->roles }}</li>
  </ol>
  <div>
    <span class="hidden-md hidden-lg hidden-xl"><br /></span>
    <a rel="noopener noreferrer" class="btn btn-flat btn-xs btn-link" href="{{ route('registered.chat.index') }}">
      <i class="fa fa-angle-double-left"></i>&nbsp;&nbsp;
      Click here to go back to chat index
    </a>
  </div>
@stop

@section('content')
    <!-- Main row -->
    <div class="row">
      <!-- Helpdesk column -->
      <div class="col-md-6">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Text</b></h3>
            <p class="no-margin">Text</p>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <dl>
              <dt style="font-size:18px;"><i class="fa fa-user margin-r-5"></i> Tab Information</dt>
              <dd>This tab covers all people you have previously contacted.</dd>
            </dl>
            <hr>
            <dl>
              <dt style="font-size:18px;"><i class="fa fa-comments margin-r-5"></i> Starting Conversations</dt>
              <dd>
                Click "chat" button to start a conversation using NUSIA chat box!<br />
                <span style="color:#ff0000;">Contact us at nusia.helpdesk@gmail.com if you encounter a problem.</span>
              </dd>
            </dl>
            <!--hr-->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <!-- Chat column -->
      <div class="col-md-6">
        <div class="box box-warning direct-chat direct-chat-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Direct Chat</b></h3>
            <div class="box-tools pull-right">
              {{-- <span data-toggle="tooltip" title class="badge bg-yellow" data-original-title="3 New Messages">3</span> --}}
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
            </div>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
              @foreach($messages as $m)
                <?php
                  $get_time = \Carbon\Carbon::parse($m->created_at)->setTimezone(Auth::user()->timezone);
                ?>
                @if($m->user_id_sender == $partner->id)
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-left">{{ $partner->first_name }} {{ $partner->last_name }}</span>
                      <span class="direct-chat-timestamp pull-right">{{ $get_time->isoFormat('dddd, MMMM Do YYYY hh:mm A') }}</span>
                    </div>
                    @if($partner->image_profile != 'user.jpg')
                      @if($partner->roles == 'Instructor')
                        <img class="direct-chat-img" src="{{ asset('uploads/instructor/' . $partner->image_profile) }}">
                      @endif
                    @else
                      <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
                    @endif
                    <div class="direct-chat-text">
                      {{ $m->message }}
                    </div>
                  </div>
                @elseif($m->user_id_sender == Auth::user()->id)
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-right">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                      <span class="direct-chat-timestamp pull-left">{{ $get_time->isoFormat('dddd, MMMM Do YYYY hh:mm A') }}</span>
                    </div>
                    @if(Auth::user()->image_profile != 'user.jpg')
                      @if(Auth::user()->roles == 'Student')
                        <img class="direct-chat-img" src="{{ asset('uploads/student/profile/' . Auth::user()->image_profile) }}">
                      @endif
                    @else
                      <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
                    @endif
                    <div class="direct-chat-text">
                      {{ $m->message }}
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
          <div class="box-footer">
            <form role="form" method="post" action="#">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type message..." class="form-control">
                <span class="input-group-btn">
                  {{--<button type="button" class="btn btn-warning">Send</button>--}}
                  <button type="button" class="btn btn-warning" aria-label="Send message."><i class="fa fa-send-o"></i></button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
