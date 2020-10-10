@extends('layouts.admin.default')

@section('title', 'Admin | Show | Admin')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>User Detail</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('users.index') }}">User</a></li>
    <li class="active">Detail</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#form" data-toggle="tab"><b>Form</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-default">
                  <div class="box-body box-profile">
                    @if($user->image_profile != 'user.jpg')
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.$user->image_profile) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.$user->image_profile) }}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p class="text-muted text-center">Role: {{ $user->roles }}</p>
                  </div>
                  <!-- /.box-body -->
                  <!-- About Me Box -->
                  <div class="box-header with-border">
                    <h3 class="box-title">User Information</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p>{{ $user->email }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Nationality</strong>
                    <p>{{ $user->citizenship }}</p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Where do you live now</strong>
                    @if($user->domicile)
                      <p>{{ $user->domicile }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Current website language</strong>
                    @if($user->website_language)
                      <p>{{ $user->website_language }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Overview</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New User
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Email</strong>
                    <p>{{ $user->email }}</p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Nationality</strong>
                    <p>{{ $user->citizenship }}</p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Where do you live now</strong>
                    @if($user->domicile)
                      <p>{{ $user->domicile }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Current website language</strong>
                    @if($user->website_language)
                      <p>{{ $user->website_language }}</p>
                    @else
                      <p class="text-muted"><i>Not Available</i></p>
                    @endif
                    <hr>
                    <h3 class="box-title"><b>Table Data</b></h3>
                    <table class="table table-bordered">
                      <tr>
                        <th>Role</th>
                        <th>Name</th>
                        <th style="width:40px;">Profile</th>
                      </tr>
                      <tr>
                        <td>{{ $user->roles }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($user->password.$user->first_name.'-'.$user->last_name)]) }}">Link</a></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="form">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Form</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email</label>
                                <input name="email" value="{{ $user->email }}" type="email" class="@error('email') is-invalid @enderror form-control" placeholder="Enter Email">
                                @error('email')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('first_name') has-error @enderror">
                                <label for="first_name">First Name</label>
                                <input name="first_name" value="{{ $user->first_name }}" type="text" class="@error('first_name') is-invalid @enderror form-control" placeholder="Enter First Name">
                                @error('first_name')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('last_name') has-error @enderror">
                                <label for="last_name">Last Name</label>
                                <input name="last_name" value="{{ $user->last_name }}" type="text" class="@error('last_name') is-invalid @enderror form-control" placeholder="Enter Last Name">
                                @error('last_name')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('old_password') has-error @enderror">
                                <label for="old_password">Old Password</label>
                                <input name="old_password" type="password" class="@error('old_password') is-invalid @enderror form-control" placeholder="Enter Old Password">
                                @error('old_password')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @if(session('error_old_password'))
                                  <p style="color:red">{{ session('error_old_password') }}</p>
                                  <?php session(['error_old_password' => null]); ?>
                                @endif
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('password') has-error @enderror">
                                <label for="password">New Password</label>
                                <input name="password" type="password" class="@error('password') is-invalid @enderror form-control" placeholder="Enter New Password">
                                @error('password')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @if(session('error_password'))
                                  <p style="color:red">{{ session('error_password') }}</p>
                                  <?php session(['error_password' => null]); ?>
                                @endif
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @error('password_confirm') has-error @enderror">
                                <label for="password_confirm">Confirm New Password</label>
                                <input name="password_confirm" type="password" class="@error('password_confirm') is-invalid @enderror form-control" placeholder="Enter New Password">
                                @error('password_confirm')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                                @if(session('error_password_confirm'))
                                  <p style="color:red">{{ session('error_password_confirm') }}</p>
                                  <?php session(['error_password_confirm' => null]); ?>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('citizenship') has-error @enderror">
                                <label for="citizenship">Nationality</label>
                                @if($user->citizenship)
                                  <input name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Enter Nationality" value="{{ $user->citizenship }}">
                                @else
                                  <input name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Enter Nationality" value="{{ old('citizenship') }}">
                                @endif
                                @error('citizenship')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('domicile') has-error @enderror">
                                <label for="domicile">Where do you live now?</label>
                                @if($user->domicile)
                                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter Domicile" value="{{ $user->domicile }}">
                                @else
                                  <input name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter Domicile" value="{{ old('domicile') }}">
                                @endif
                                @error('domicile')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('timezone') has-error @enderror">
                                <label for="timezone">What is your local time zone?</label>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*This information is needed to adjust Indonesian time<br>to your local time for scheduling your sessions</p>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Reference: <b><a target="_blank" rel="noopener noreferrer" href="https://www.timeanddate.com/">timeanddate.com</a></b></p>
                                <select name="timezone" type="text" class="@error('timezone') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Current Time Zone --</option>
                                  @foreach($timezones as $timezone)
                                    @if(old('timezone') == $timezone)
                                      <option selected="selected" value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                                    @else
                                      <option value="{{ $timezone }}">UTC/GMT{{ $timezone }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('timezone')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <div class="form-group @error('image_profile') has-error @enderror">
                                <label for="image_profile">Upload Profile Picture</label>
                                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                                <input name="image_profile" type="file" accept="image/*" class="@error('image_profile') is-invalid @enderror form-control">
                                @error('image_profile')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                      </div>
                    </form>
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
