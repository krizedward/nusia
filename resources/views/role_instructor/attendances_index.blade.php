@extends('layouts.admin.default')

@section('title', $session->course->title . ' | Attendance')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Attendance for [{{ $session->course->course_package->course_level->name }}] {{ $session->course->title }} - {{ $session->title }}</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Attendance Information</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-warning">
        {{--
        <div class="box-header">
          <h3 class="box-title">&nbsp;</h3>
        </div>
        --}}
        <div class="box-body">
          <dl>
            <dt style="font-size:18px;"><i class="fa fa-file-text-o margin-r-5"></i> Attendance</dt>
            <dd>Student attendance information can be updated here.</dd>
          </dl>
          <hr>
          <dl>
            <dt class="text-red" style="font-size:18px;"><i class="fa fa-exclamation-circle margin-r-5"></i> Please Note</dt>
            <dd class="text-red">If you have submitted the form once,<br>you cannot edit it anymore.</dd>
          </dl>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title"><b>List of Students</b></h3>
        </div>
        @if($session_registrations->first()->status == 'Not Assigned')
          <form method="POST" action="{{ route('instructor.student_attendance.update', [$session->course->id, $session->id]) }}">
            @csrf
            @method('PUT')
        @endif
            <div class="box-body">
              <table class="table table-bordered example1">
                <thead>
                  <tr>
                    <th>Student Name</th>
                    <th style="width:12%;">Picture</th>
                    <th style="width: 150px">Present/Not Present</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($session_registrations as $sr)
                    <tr>
                      <td>{{ $sr->course_registration->student->user->first_name }} {{ $sr->course_registration->student->user->last_name }}</td>
                      <td>
                        @if($sr->course_registration->student->user->image_profile != 'user.jpg')
                          <img src="{{ asset('uploads/student/profile/'.$sr->course_registration->student->user->image_profile) }}" style="width:100%">
                        @else
                          <img src="{{ asset('uploads/user.jpg') }}" style="width:100%">
                        @endif
                      </td>
                      <td class="text-center">
                        @if($sr->status == 'Not Assigned')
                          <input type="checkbox" class="minimal" value="false" onclick="checkboxClick{{ $sr->course_registration->student->id }}(this);" id="flag{{ $sr->course_registration->student->id }}" name="flag{{ $sr->course_registration->student->id }}">
                        @else
                          @if($sr->status == 'Not Present') {{-- Status present ada beberapa, sehingga tidak direkomendasikan untuk mengganti seleksi ini. --}}
                            <label class="label label-danger">Not Present</label>
                          @elseif($sr->status == 'Should Submit Form')
                            <label class="label bg-purple">Should Submit Form</label>
                          @elseif($sr->status == 'Present')
                            <label class="label label-success">Present</label>
                          @endif
                        @endif
                      </td>
                      <script>
                        function checkboxClick{{ $sr->course_registration->student->id }}(cb) {
                          document.getElementById("flag{{ $sr->course_registration->student->id }}").value = cb.checked;
                        }
                      </script>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              @if($session_registrations->first()->status == 'Not Assigned')
                <!--input type="submit" class="btn btn-submit btn-xs btn-primary" value="Submit"-->
                <button type="submit" class="btn btn-submit btn-xs btn-primary" onclick="if(confirm('Are you sure to submit this attendance form? After submitting this, you cannot edit it anymore.')) return true; else return false;">Submit</button>
              @else
                <input disabled type="submit" class="btn btn-submit btn-xs btn-default btn-disabled" value="Submit">
              @endif
            </div>
        @if($session_registrations->first()->status == 'Not Assigned')
          </form>
        @endif
      </div>
    </div>
  </div>
@stop
