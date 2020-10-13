@extends('layouts.admin.default')

@section('title', 'Admin | User | Version 1')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>User</b></h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-4">
			<!-- Student -->
          	<div class="small-box bg-blue">
	        	<div class="inner">
	        		<h3>{{ $students->count() }}</h3>
	              	<p>Student</p>
	            </div>
	            <div class="icon">
	              	<i class="ion ion-person-add"></i>
	            </div>
	        </div>
	        <!-- Instructor -->
	        <div class="small-box bg-green">
	        	<div class="inner">
	        		<h3>{{ $instructors->count() }}</h3>
	              	<p>Instructor</p>
	            </div>
	            <div class="icon">
	              	<i class="ion ion-person-add"></i>
	            </div>
	        </div>
	        <!-- Lead Instructors -->
	        <div class="small-box bg-blue">
	        	<div class="inner">
	        		<h3>{{ $lead_instructors->count() }}</h3>
	              	<p>Lead Instructors</p>
	            </div>
	            <div class="icon">
	              	<i class="ion ion-person-add"></i>
	            </div>
	        </div>
	        <!-- Other Users -->
	        <div class="small-box bg-green">
	        	<div class="inner">
	        		<h3>{{ $other_users->count() }}</h3>
	              	<p>Other Users</p>
	            </div>
	            <div class="icon">
	              	<i class="ion ion-person-add"></i>
	            </div>
	        </div>
		</div>
		<div class="col-md-8">
			<div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab"><b>All Users</b></a></li>
          <li><a href="#lead_instructors" data-toggle="tab"><b>Lead Instructors</b></a></li>
          <li><a href="#instructors" data-toggle="tab"><b>Instructors</b></a></li>
          <li><a href="#students" data-toggle="tab"><b>Students</b></a></li>
          <li><a href="#other_users" data-toggle="tab"><b>Other Users</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="all">
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
                    <h3 class="box-title"><b>All Users</b></h3>
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
                    @if($users->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Role</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($users as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->roles }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="lead_instructors">
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
                    <h3 class="box-title"><b>All Lead Instructors</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($lead_instructors->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($lead_instructors as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>
                              @if($dt->image_profile != 'user.jpg')
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/instructor/' . $dt->image_profile) }}">
                              @else
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                              @endif
                            </td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="instructors">
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
                    <h3 class="box-title"><b>All Instructors</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($instructors->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($instructors as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>
                              @if($dt->image_profile != 'user.jpg')
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/instructor/' . $dt->image_profile) }}">
                              @else
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                              @endif
                            </td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="students">
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
                    <h3 class="box-title"><b>All Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($students->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Name</th>
                          <th>Registration Status</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($students as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>
                              @if($dt->image_profile != 'user.jpg')
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/student/profile/' . $dt->image_profile) }}">
                              @else
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                              @endif
                            </td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td>
                              @if($dt->student->course_registrations->count() != 0)
                                <label class="label bg-green">Registered</label>
                              @elseif($dt->student->age == 0)
                                <label class="label bg-red">Not registered</label>
                              @else
                                <label class="label bg-yellow">Choosing a class</label>
                              @endif
                            </td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-success collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Registered Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <?php
                      $flag = 0;
                      foreach($students as $dt) {
                        if($dt->student->course_registrations->count() != 0) {
                          $flag = 1;
                          break;
                        }
                      }
                      $i = 0;
                    ?>
                    @if($flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($students as $dt)
                          @if($dt->student->course_registrations->count() != 0)
                            <tr>
                              <td class="text-right">{{ ++$i }}</td>
                              <td>
                                @if($dt->image_profile != 'user.jpg')
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/student/profile/' . $dt->image_profile) }}">
                                @else
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                                @endif
                              </td>
                              <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-warning collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Students Registering for a Course</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <?php
                      $flag = 0;
                      foreach($students as $dt) {
                        if($dt->student->age != 0 && $dt->student->course_registrations->count() == 0) {
                          $flag = 1;
                          break;
                        }
                      }
                      $i = 0;
                    ?>
                    @if($flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($students as $dt)
                          @if($dt->student->age != 0 && $dt->student->course_registrations->count() == 0)
                            <tr>
                              <td class="text-right">{{ ++$i }}</td>
                              <td>
                                @if($dt->image_profile != 'user.jpg')
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/student/profile/' . $dt->image_profile) }}">
                                @else
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                                @endif
                              </td>
                              <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-danger collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Non-Registered Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <?php
                      $flag = 0;
                      foreach($students as $dt) {
                        if($dt->student->age == 0) {
                          $flag = 1;
                          break;
                        }
                      }
                      $i = 0;
                    ?>
                    @if($flag)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($students as $dt)
                          @if($dt->student->age == 0)
                            <tr>
                              <td class="text-right">{{ ++$i }}</td>
                              <td>
                                @if($dt->image_profile != 'user.jpg')
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/student/profile/' . $dt->image_profile) }}">
                                @else
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                                @endif
                              </td>
                              <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="other_users">
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
                    <h3 class="box-title"><b>All Other Users</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($other_users->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th style="width:150px;">Profile Picture</th>
                          <th>Role</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($other_users as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>
                              @if($dt->image_profile != 'user.jpg')
                                @if($dt->roles == 'Customer Service')
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/team-cs/' . $dt->image_profile) }}">
                                @elseif($dt->roles == 'Financial Team')
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/team-financial/' . $dt->image_profile) }}">
                                @else {{-- for admin --}}
                                  <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                                @endif
                              @else
                                <img style="width:75px;" alt="User Image" src="{{ asset('uploads/' . $dt->image_profile) }}">
                              @endif
                            </td>
                            <td>{{ $dt->roles }}</td>
                            <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Link</a></td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
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
	</div>
@stop