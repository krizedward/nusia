@extends('layouts.admin.default')

@section('title', 'Chat - ' . $partner->roles)

{{--@include('layouts.css_and_js.dashboard')--}}

@include('layouts.css_and_js.table')

@section('content')
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-4">
        <div class="box box-warning direct-chat direct-chat-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Direct Chat</h3>
            <div class="box-tools pull-right">
              {{-- <span data-toggle="tooltip" title class="badge bg-yellow" data-original-title="3 New Messages">3</span> --}}
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
      <!-- Middle col -->
      <div class="col-md-4">
        <div class="box box-primary direct-chat direct-chat-success">
          <div class="box-header with-border">
            <h3 class="box-title">Direct Chat</h3>
            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title class="badge bg-blue" data-original-title="3 New Messages">3</span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
              <div class="direct-chat-msg">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left">Nama User</span>
                  <span class="direct-chat-timestamp pull-right">DD MMM hh:mm aa</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
                <div class="direct-chat-text">
                  Text
                </div>
              </div>
              <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right">Nama User</span>
                  <span class="direct-chat-timestamp pull-left">DD MMM hh:mm aa</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
                <div class="direct-chat-text">
                  Text
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <form role="form" method="post" action="#">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type message..." class="form-control">
                <span class="input-group-btn">
                  {{--<button type="button" class="btn btn-primary">Send</button>--}}
                  <button type="button" class="btn btn-primary" aria-label="Send message."><i class="fa fa-send-o"></i></button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <!-- Right col -->
      <div class="col-md-4">
        <div class="box box-default bg-navy direct-chat direct-chat-primary">
          <div class="box-header with-border bg-gray">
            <h3 class="box-title">Direct Chat</h3>
            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title class="badge bg-blue" data-original-title="3 New Messages">3</span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
              <div class="direct-chat-msg">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left">Nama User</span>
                  <span class="direct-chat-timestamp pull-right">DD MMM hh:mm aa</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
                <div class="direct-chat-text" {{-- style="background-color:#ffffff;" --}}>
                  Text
                </div>
              </div>
              <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right">Nama User</span>
                  <span class="direct-chat-timestamp pull-left">DD MMM hh:mm aa</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('uploads/user.jpg') }}">
                <div class="direct-chat-text bg-blue">
                  Text
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer bg-gray-active">
            <form role="form" method="post" action="#">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type message..." class="form-control bg-gray">
                <span class="input-group-btn">
                  {{--<button type="button" class="btn bg-blue">Send</button>--}}
                  <button type="button" class="btn bg-blue" aria-label="Send message."><i class="fa fa-send-o"></i></button>
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