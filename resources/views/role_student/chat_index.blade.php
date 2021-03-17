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
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab"><b>All</b></a></li>
          {{--<li><a href="#instructors" data-toggle="tab"><b>Instructors</b></a></li>--}}
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="all">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  {{--
                  <div class="box-header with-border">
                    <h3 class="box-title">Text</b></h3>
                    <p class="no-margin">Text</p>
                  </div>
                  --}}
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
                    {{-- <hr> --}}
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-9">
                <div class="col-md-12">
                  <div class="box box-warning">
                    <div class="box-header">
                      <h3 class="box-title">
                        <b>Your Contacts</b>
                      </h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <table class="table table-bordered example1">
                        <thead>
                          <th style="width:75px;">Picture</th>
                          <th>Name (Role)</th>
                          <th style="width:5%;">Action</th>
                        </thead>
                        <tbody>
                          @foreach($users as $dt)
                            <tr>
                              <td class="text-center">
                                @if($dt->image_profile != 'user.jpg')
                                  @if($dt->roles == 'Student')
                                    <img class="img-circle" style="width:75px;" src="{{ asset('uploads/student/profile/' . $dt->image_profile) }}" alt="User image.">
                                  @elseif($dt->roles == 'Instructor' || $dt->roles == 'Lead Instructor')
                                    <img class="img-circle" style="width:75px;" src="{{ asset('uploads/instructor/' . $dt->image_profile) }}" alt="User image.">
                                  @elseif($dt->roles == 'Customer Service')
                                    <img class="img-circle" style="width:75px;" src="{{ asset('uploads/cs-profile/' . $dt->image_profile) }}" alt="User image.">
                                  @elseif($dt->roles == 'Financial Team')
                                    <img class="img-circle" style="width:75px;" src="{{ asset('uploads/finance-profile/' . $dt->image_profile) }}" alt="User image.">
                                  @elseif($dt->roles == 'Admin')
                                    <img class="img-circle" style="width:75px;" src="{{ asset('uploads/user.jpg') }}" alt="User image.">
                                  @endif
                                @else
                                  <img class="img-circle" style="width:75px;" src="{{ asset('uploads/user.jpg') }}" alt="User image.">
                                @endif
                              </td>
                              <td>
                                <span class="hidden">{{ $dt->roles }}</span>
                                {{ $dt->first_name }} {{ $dt->last_name }} (as {{ $dt->roles }})
                              </td>
                              <td class="text-center">
                                @if(Auth::user()->roles == 'Student')
                                  @if($dt->roles == 'Admin')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('non_admin.chat_admin.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Financial Team')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.chat_financial_team.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Lead Instructor')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.chat_lead_instructor.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Instructor')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.chat_instructor.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Customer Service')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('student.chat_customer_service.show', [$dt->id]) }}">Chat</a>
                                  @endif
                                @elseif(Auth::user()->roles == 'Instructor' || Auth::user()->roles == 'Lead Instructor')
                                  @if($dt->roles == 'Admin')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('non_admin.chat_admin.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Instructor')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_instructor.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Student')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('instructor.chat_student.show', [$dt->id]) }}">As Instructor</a>
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('lead_instructor.chat_student.show', [$dt->id]) }}">Placement Test Video</a>
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('lead_instructor.chat_student_alternative_meeting.show', [$dt->id]) }}">Placement Test Meeting</a>
                                  @endif
                                @elseif(Auth::user()->roles == 'Customer Service')
                                  @if($dt->roles == 'Admin')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('non_admin.chat_admin.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Student')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('customer_service.chat_student.show', [$dt->id]) }}">Chat</a>
                                  @endif
                                @elseif(Auth::user()->roles == 'Financial Team')
                                  @if($dt->roles == 'Admin')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('non_admin.chat_admin.show', [$dt->id]) }}">Chat</a>
                                  @elseif($dt->roles == 'Student')
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ route('financial_team.chat_student.show', [$dt->id]) }}">Chat</a>
                                  @endif
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
