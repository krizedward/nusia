@extends('layouts.admin.default')

@section('title','Schedule')

@if(Auth::user()->level == 'instructor')

@section('content-header')
  <h1>
    Schedule
    <small>learning</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="active">Schedule</li>
  </ol>
@endsection

@section('content')
  <div class="row">

    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Schedule Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Student Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Class</th>
              <th>Link Zoom</th>
            </tr>
            </thead>
                  
            <tbody>
            @foreach($data as $e=>$dt)
              @if($dt->instructor_id == $role->id)
              <tr>
                <td>{{ $dt->student->user->name}}</td>
                <td>{{ date('h:i A', strtotime($dt->time_meet)) }}</td>
                <td>{{ date('d-M-Y', strtotime($dt->date_meet)) }}</td>
                <td>{{ $dt->class->name }}</td>
                <td>
                  <a href="{{ $dt->link }}">Click Here</a>
                </td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.row -->
@endsection

@endif

@if(Auth::user()->level == 'student')

@section('content-header')
  <h1>
    Schedule
    <small>learning</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="active">Schedule</li>
  </ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Select Schedule</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="post" action="{{ url('/schedule/store') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{Auth::user()->id}}">
          <div class="row">
            <div class="col-md-6">

              @if($errors->has('instructor_id'))
              <div class="form-group has-error">
                <label>Instructor</label>
                <select class="form-control select2" style="width: 100%;" name="instructor_id">
                  <option selected="" disabled="">Choose Instructor..</option>
                  @foreach($instructor as $dt)
                  <option value="{{$dt->id}}">{{$dt->user->name}}</option>
                  @endforeach
                </select>
                <span class="help-block">{{ $errors->first('instructor_id')}}</span>
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Instructor</label>
                <select class="form-control select2" style="width: 100%;" name="instructor_id">
                  <option selected="" disabled="">Choose Instructor..</option>
                  @if(!empty($choose))
                    @foreach($instructor as $dt)
                      <option value="{{$dt->id}}"{{ ($choose->id == $dt->id) ? 'selected' : '' }}>{{$dt->user->name}}</option>
                    @endforeach
                  @else
                    @foreach($instructor as $dt)
                      <option value="{{$dt->id}}">{{$dt->user->name}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <!-- /.form-group -->
              @endif

              @if($errors->has('class_id'))
              <div class="form-group has-error">
                <label>Class</label>
                <select class="form-control select2" style="width: 100%;" name="class_id">
                  <option selected="" disabled="">Choose Class..</option>
                  @foreach($class as $dt)
                  <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                  @endforeach
                </select>
                <span class="help-block">{{ $errors->first('class_id')}}</span>
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Class</label>
                <select class="form-control select2" style="width: 100%;" name="class_id">
                  <option selected="" disabled="">Choose Class..</option>
                  @foreach($class as $dt)
                  <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->
              @endif

              @if($errors->has('date_meet'))
              <div class="form-group has-error">
                <label>Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="date_meet">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="date_meet">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @endif
            </div>
            <!-- /.col -->

            <div class="col-md-6">
             
              @if($errors->has('time_meet'))
              <div class="form-group">
                <label>Time</label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="time_meet">

                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <span class="help-block">{{ $errors->first('time_meet')}}</span>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @else
              <div class="form-group">
                <label>Time</label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="time_meet">

                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              @endif
              
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>

    <!-- /.col -->
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
        	<h3 class="box-title">Schedule Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Instructor Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Class</th>
              <th>Link Zoom</th>
            </tr>
            </thead>
                  
            <tbody>
            @foreach($data as $e=>$dt)
              @if($dt->student_id == $role->id)
              <tr>
                <td>{{ $dt->instructor->user->name}}</td>
                <td>{{ date('h:i A', strtotime($dt->time_meet)) }}</td>
                <td>{{ date('d-M-Y', strtotime($dt->date_meet)) }}</td>
                <td>{{ $dt->class->name }}</td>
                <td>
                	<a href="{{ $dt->link }}">Click Here</a>
                </td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.row -->
@endsection

@endif

@if(Auth::user()->level == 'admin')
<p>Hello Admin</p>
@endif
