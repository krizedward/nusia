@extends('layouts.admin.default')

@section('title', 'Admin | Show | Student')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>User Course Registration</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('users.index') }}">User</a></li>
    <li><a href="{{ route('users.show', [Str::slug($course_registration->student->user->password.$course_registration->student->user->first_name.'-'.$course_registration->student->user->last_name)]) }}">Detail</a></li>
    <li class="active">Course Registration</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#registration" data-toggle="tab"><b>Registration</b></a></li>
          <li><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
          <li><a href="#instructor" data-toggle="tab"><b>Instructor</b></a></li>
          <li><a href="#all_registered_students" data-toggle="tab"><b>All Registered Students</b></a></li>
          <li><a href="#course_certificate" data-toggle="tab"><b>Course Certificate</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-default">
                  <div class="box-body box-profile">
                    @if($course_registration->student->user->image_profile != 'user.jpg')
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/student/profile/'.$course_registration->student->user->image_profile) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/'.$course_registration->student->user->image_profile) }}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ $course_registration->student->user->first_name }} {{ $course_registration->student->user->last_name }}</h3>
                    <p class="text-muted text-center">Role: {{ $course_registration->student->user->roles }}</p>
                  </div>
                  <!-- /.box-body -->
                  <!-- About Me Box -->
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at <b>{{ $course_registration->course->title }}</b></h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Registration Time</strong>
                    <p>
                      <?php
                        $schedule_time = \Carbon\Carbon::parse($course_registration->created_at)->setTimezone(Auth::user()->timezone);
                      ?>
                      <table>
                        <tr>
                          <td><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>{{ $schedule_time->isoFormat('dddd') }}</td>
                        </tr>
                        <tr>
                          <td><b>Date</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>{{ $schedule_time->isoFormat('MMMM Do YYYY, hh:mm A') }}</td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-credit-card margin-r-5"></i> Payment Status</strong>
                    <p>
                      <table>
                        <tr>
                          <td><b>Status</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            @if($course_registration->course->course_package->price != 0)
                              {{-- Kode untuk memeriksa status pembayaran untuk course berbayar. --}}
                              @if($course_registration->course_payments)
                                {{-- Bagian berikut perlu ditambahkan kembali untuk menyesuaikan total pembayaran yang sudah dilakukan saat ini dengan total biaya course. --}}
                                <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Paid</span>
                                <span class="label label-warning"><i class="fa fa-question"></i>&nbsp;&nbsp;Not Confirmed</span>
                                <span class="label label-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Not Paid</span>
                              @else
                                <span class="label label-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Not Paid</span>
                              @endif
                            @else
                              <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Free of Charge</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><b>Paid at</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>
                            {{-- Kode pada bagian ini perlu ditambahkan kembali. --}}
                            <i class="text-muted">Not Available</i>
                          </td>
                        </tr>
                      </table>
                    </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-md-3">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>
                      @if($course_registration->course->course_registrations->toArray())
                        {{ $course_registration->course->course_registrations->count() }} / {{ $course_registration->course->course_package->course_type->count_student_max }}
                      @else
                        0 / {{ $course_registration->course->course_package->course_type->count_student_max }}
                      @endif
                    </h3>
                    <p>
                      @if($course_registration->course->course_package->course_type->count_student_max != 1)
                        Registered Students
                      @else
                        Registered Student
                      @endif
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- /.col FOR WIDGET 1 -->
              <div class="col-md-3">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>
                      <?php
                        $present_attendances = 0;
                        foreach($course_registration->session_registrations as $sr)
                          if($sr->status == 'Present') $present_attendances++;
                      ?>
                      {{ $present_attendances }} / {{ $course_registration->session_registrations->count() }}
                    </h3>
                    <p>
                      @if($course_registration->session_registrations->count() != 1)
                        Attendances
                      @else
                        Attendance
                      @endif
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check-circle-o"></i>
                  </div>
                  <a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- /.col FOR WIDGET 2 -->
              <div class="col-md-3">
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>
                      <?php
                        $arr_student = [];
                        $arr = [];
                        foreach($course_registration->session_registrations as $sr)
                          foreach($sr->session_registration_forms as $srf)
                            if(!in_array($srf->form_response->form_question->form->id, $arr_student))
                              array_push($arr_student, $srf->form_response->form_question->form->id);
                        foreach($course_registration->course->sessions as $s)
                          if(!in_array($s->form->id, $arr))
                            array_push($arr, $s->form->id);
                      ?>
                      {{ count($arr_student) }} / {{ count($arr) }}
                    </h3>
                    <p>
                      @if(count($arr) != 1)
                        Forms Filled
                      @else
                        Form Filled
                      @endif
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-files-o"></i>
                  </div>
                  <a href="#?" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- /.col FOR WIDGET 3 -->
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
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Material Type</strong>
                    <p>
                      <u>{{ $course_registration->course->course_package->material_type->name }}</u><br>
                      {{ $course_registration->course->course_package->material_type->description }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Course Type</strong>
                    <p>
                      <u>{{ $course_registration->course->course_package->course_type->name }}</u><br>
                      {{ $course_registration->course->course_package->course_type->description }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Course Proficiency Level</strong>
                    <p>
                      <u>{{ $course_registration->course->course_package->course_level->name }}</u><br>
                      {{ $course_registration->course->course_package->course_level->description }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Course Title</strong>
                    <p>{{ $course_registration->course->title }}</p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Total Available Session(s)</strong>
                    <p>
                      {{ $course_registration->course->course_package->count_session }}
                      @if($course_registration->course->course_package->count_session != 1)
                        sessions
                      @else
                        session
                      @endif
                    </p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Registration Price</strong>
                    <p>${{ $course_registration->course->course_package->price }}</p>
                    <hr>
                    <h3 class="box-title"><b>Table Data</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New "Something"
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      <table class="table table-bordered">
                        <tr>
                          <th>Role</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        <tr>
                          <td>Record 1</td>
                          <td>Record 2</td>
                          <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title"><b>Edit Course Information</b></h3>
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
                    <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('title') has-error @enderror">
                                <label for="title">Course Title</label>
                                <input name="title" value="{{ $course_registration->course->title }}" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="Enter Course Title">
                                @error('title')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('material_type_id') has-error @enderror">
                                <label for="material_type_id">Material Type</label>
                                <select name="material_type" type="text" class="@error('material_type') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Material Type --</option>
                                  @foreach($material_types as $mt)
                                    @if(old('material_type_id') == $mt->name)
                                      <option selected="selected" value="{{ $mt->name }}">{{ $mt->name }}</option>
                                    @elseif($course_registration->course->course_package->material_type->name == $mt->name)
                                      <option selected="selected" value="{{ $mt->name }}">{{ $mt->name }}</option>
                                    @else
                                      <option value="{{ $mt->name }}">{{ $mt->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('material_type_id')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                              <div class="form-group @error('course_type_id') has-error @enderror">
                                <label for="course_type_id">Course Type</label>
                                <select name="course_type" type="text" class="@error('course_type') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Course Type --</option>
                                  @foreach($course_types as $ct)
                                    @if(old('course_type_id') == $ct->name)
                                      <option selected="selected" value="{{ $ct->name }}">
                                        @if($ct->count_student_min != $ct->count_student_max)
                                          {{ $ct->name }}: {{ $ct->count_student_min }} to {{ $ct->count_student_max }} @if($ct->count_student_max != 1) Students @else Student @endif
                                        @else
                                          {{ $ct->name }}: {{ $ct->count_student_min }} @if($ct->count_student_max != 1) Students @else Student @endif only
                                        @endif
                                      </option>
                                    @elseif($course_registration->course->course_package->course_type->name == $ct->name)
                                      <option selected="selected" value="{{ $ct->name }}">
                                        @if($ct->count_student_min != $ct->count_student_max)
                                          {{ $ct->name }}: {{ $ct->count_student_min }} to {{ $ct->count_student_max }} @if($ct->count_student_max != 1) Students @else Student @endif
                                        @else
                                          {{ $ct->name }}: {{ $ct->count_student_min }} @if($ct->count_student_max != 1) Students @else Student @endif only
                                        @endif
                                      </option>
                                    @else
                                      <option value="{{ $ct->name }}">
                                        @if($ct->count_student_min != $ct->count_student_max)
                                          {{ $ct->name }}: {{ $ct->count_student_min }} to {{ $ct->count_student_max }} @if($ct->count_student_max != 1) Students @else Student @endif
                                        @else
                                          {{ $ct->name }}: {{ $ct->count_student_min }} @if($ct->count_student_max != 1) Students @else Student @endif only
                                        @endif
                                      </option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('course_type_id')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                              <div class="form-group @error('course_level_id') has-error @enderror">
                                <label for="course_level_id">Course Proficiency Level</label>
                                <select name="course_level" type="text" class="@error('course_level') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Course Proficiency Level --</option>
                                  @foreach($course_levels as $cl)
                                    @if(old('course_level_id') == $cl->name)
                                      <option selected="selected" value="{{ $cl->name }}">{{ $cl->name }}</option>
                                    @elseif($course_registration->course->course_package->course_level->name == $cl->name)
                                      <option selected="selected" value="{{ $cl->name }}">{{ $cl->name }}</option>
                                    @else
                                      <option value="{{ $cl->name }}">{{ $cl->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('course_level_id')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('description') has-error @enderror" id="description">
                                <label for="description">Course Description</label>
                                @if($course_registration->course->description)
                                  <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Description">{{ $course_registration->course->description }}</textarea>
                                @else
                                  <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Description">{{ old('description') }}</textarea>
                                @endif
                                @error('description')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('requirement') has-error @enderror" id="requirement">
                                <label for="requirement">Course Requirement</label>
                                @if($course_registration->course->requirement)
                                  <textarea name="requirement" class="@error('requirement') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Requirement">{{ $course_registration->course->requirement }}</textarea>
                                @else
                                  <textarea name="requirement" class="@error('requirement') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Requirement">{{ old('requirement') }}</textarea>
                                @endif
                                @error('requirement')
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
          <div class="tab-pane" id="registration">
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
                    <h3 class="box-title"><b>Registration Status</b></h3>
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
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Registration Time</strong>
                    <p>
                      <?php
                        $schedule_time = \Carbon\Carbon::parse($course_registration->created_at)->setTimezone(Auth::user()->timezone);
                      ?>
                      {{ $schedule_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Registration Price</strong>
                    <p>${{ $course_registration->course->course_package->price }}</p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Payment Status</strong>
                    <p>
                      @if($course_registration->course->course_package->price != 0)
                        {{-- Kode untuk memeriksa status pembayaran untuk course berbayar. --}}
                        @if($course_registration->course_payments)
                          {{-- Bagian berikut perlu ditambahkan kembali untuk menyesuaikan total pembayaran yang sudah dilakukan saat ini dengan total biaya course. --}}
                          <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Paid</span>
                          <span class="label label-warning"><i class="fa fa-question"></i>&nbsp;&nbsp;Not Confirmed</span>
                          <span class="label label-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Not Paid</span>
                        @else
                          <span class="label label-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Not Paid</span>
                        @endif
                      @else
                        <span class="label label-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Free of Charge</span>
                      @endif
                    </p>
                    <hr>
                    <strong><i class="fa fa-circle-o margin-r-5"></i> Payment Time (fully paid)</strong>
                    <p>
                      {{-- Kode pada bagian ini perlu ditambahkan kembali. --}}
                      <i class="text-muted">Not Available</i>
                    </p>
                    <hr>
                    <h3 class="box-title"><b>List of Payment Installment(s)</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New Payment Installment
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      @if($course_registration->course_payments)
                        <table class="table table-bordered">
                          <tr>
                            <th>#</th>
                            <th>Time</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th style="width:100px;">Evidence</th>
                          </tr>
                          @foreach($course_payments as $i => $cp)
                            <tr>
                              <td>{{ $i + 1 }}</td>
                              <td>{{ $cp->payment_time }}</td>
                              <td>{{ $cp->payment_type->method }}</td>
                              <td>{{ $cp->amount }}</td>
                              <td>{{ $cp->status }}</td>
                              <td class="text-center">
                                @if($cp->path)
                                  <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a>
                                @else
                                  <span class="text-muted">Not Available</span>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </table>
                      @else
                        <div class="text-center">No data available.</div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title"><b>Edit Registration Information</b></h3>
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
                    <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('title') has-error @enderror">
                                <label for="title">Course Title</label>
                                <input name="title" value="{{ $course_registration->course->title }}" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="Enter Course Title">
                                @error('title')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('material_type_id') has-error @enderror">
                                <label for="material_type_id">Material Type</label>
                                <select name="material_type" type="text" class="@error('material_type') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Material Type --</option>
                                  @foreach($material_types as $mt)
                                    @if(old('material_type_id') == $mt->name)
                                      <option selected="selected" value="{{ $mt->name }}">{{ $mt->name }}</option>
                                    @elseif($course_registration->course->course_package->material_type->name == $mt->name)
                                      <option selected="selected" value="{{ $mt->name }}">{{ $mt->name }}</option>
                                    @else
                                      <option value="{{ $mt->name }}">{{ $mt->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('material_type_id')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                              <div class="form-group @error('course_type_id') has-error @enderror">
                                <label for="course_type_id">Course Type</label>
                                <select name="course_type" type="text" class="@error('course_type') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Course Type --</option>
                                  @foreach($course_types as $ct)
                                    @if(old('course_type_id') == $ct->name)
                                      <option selected="selected" value="{{ $ct->name }}">
                                        @if($ct->count_student_min != $ct->count_student_max)
                                          {{ $ct->name }}: {{ $ct->count_student_min }} to {{ $ct->count_student_max }} @if($ct->count_student_max != 1) Students @else Student @endif
                                        @else
                                          {{ $ct->name }}: {{ $ct->count_student_min }} @if($ct->count_student_max != 1) Students @else Student @endif only
                                        @endif
                                      </option>
                                    @elseif($course_registration->course->course_package->course_type->name == $ct->name)
                                      <option selected="selected" value="{{ $ct->name }}">
                                        @if($ct->count_student_min != $ct->count_student_max)
                                          {{ $ct->name }}: {{ $ct->count_student_min }} to {{ $ct->count_student_max }} @if($ct->count_student_max != 1) Students @else Student @endif
                                        @else
                                          {{ $ct->name }}: {{ $ct->count_student_min }} @if($ct->count_student_max != 1) Students @else Student @endif only
                                        @endif
                                      </option>
                                    @else
                                      <option value="{{ $ct->name }}">
                                        @if($ct->count_student_min != $ct->count_student_max)
                                          {{ $ct->name }}: {{ $ct->count_student_min }} to {{ $ct->count_student_max }} @if($ct->count_student_max != 1) Students @else Student @endif
                                        @else
                                          {{ $ct->name }}: {{ $ct->count_student_min }} @if($ct->count_student_max != 1) Students @else Student @endif only
                                        @endif
                                      </option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('course_type_id')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                              <div class="form-group @error('course_level_id') has-error @enderror">
                                <label for="course_level_id">Course Proficiency Level</label>
                                <select name="course_level" type="text" class="@error('course_level') is-invalid @enderror form-control">
                                  <option selected="selected" value="">-- Enter Course Proficiency Level --</option>
                                  @foreach($course_levels as $cl)
                                    @if(old('course_level_id') == $cl->name)
                                      <option selected="selected" value="{{ $cl->name }}">{{ $cl->name }}</option>
                                    @elseif($course_registration->course->course_package->course_level->name == $cl->name)
                                      <option selected="selected" value="{{ $cl->name }}">{{ $cl->name }}</option>
                                    @else
                                      <option value="{{ $cl->name }}">{{ $cl->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @error('course_level_id')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <div class="form-group @error('description') has-error @enderror" id="description">
                                <label for="description">Course Description</label>
                                @if($course_registration->course->description)
                                  <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Description">{{ $course_registration->course->description }}</textarea>
                                @else
                                  <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Description">{{ old('description') }}</textarea>
                                @endif
                                @error('description')
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group @error('requirement') has-error @enderror" id="requirement">
                                <label for="requirement">Course Requirement</label>
                                @if($course_registration->course->requirement)
                                  <textarea name="requirement" class="@error('requirement') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Requirement">{{ $course_registration->course->requirement }}</textarea>
                                @else
                                  <textarea name="requirement" class="@error('requirement') is-invalid @enderror form-control" rows="5" placeholder="Enter Course Requirement">{{ old('requirement') }}</textarea>
                                @endif
                                @error('requirement')
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
          <div class="tab-pane" id="sessions">
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
                    <h3 class="box-title"><b>Calendar</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New Session
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Tampilkan kalender pada bagian ini.</p>
                    <hr>
                    <h3 class="box-title"><b>List of Sessions</b></h3>
                    {{--
                    <div class="box-header">
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New Session
                      </a>
                    </div>
                    --}}
                    <div class="box-body">
                      @if($course_registration->course->sessions->toArray())
                        <table class="table table-bordered">
                          <tr>
                            <th style="width:40px;" class="text-right">#</th>
                            <th>Title</th>
                            <th>Meeting Link</th>
                            <th style="width:40px;">Detail</th>
                          </tr>
                          @foreach($course_registration->course->sessions as $i => $dt)
                            <tr>
                              <td class="text-right">{{ $i + 1 }}</td>
                              <td>{{ $dt->title }}</td>
                              <td>{{ $dt->link_zoom }}</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-green" href="{{ route('home') }}">Link</a></td>
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
