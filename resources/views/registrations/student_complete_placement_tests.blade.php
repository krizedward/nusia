@extends('layouts.admin.default')

@section('title','Placement Test')

@include('layouts.css_and_js.form_advanced')

@section('content-header')
  <h1><b>Indonesian Proficiency Placement Test</b></h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Placement Test Information</b></h3>
        </div>
        <div class="box-body">
          <dl>
            <dt><i class="fa fa-pencil margin-r-5"></i> Reading the Requirements</dt>
            <dd>
              Click this
              <a href="#" target="_blank">blue-colored link</a>
              to download the test requirements.
            </dd>
          </dl>
          <hr>
          <dl>
            <dt><i class="fa fa-file-video-o margin-r-5"></i> Preparing the Video</dt>
            <dd>
              Record a video that fulfills all test requirements.<br />
              After recording the video, upload to <b>Google Drive</b> and prepare a shareable link to the video.
            </dd>
          </dl>
          <hr>
          <dl>
            <dt><i class="fa fa-check margin-r-5"></i> Completing the Test</dt>
            <dd>
              After preparing the link, fill out the submission form and click "submit" button!<br />
              Please check whether the link has been attached successfully.<br />
            </dd>
          </dl>
          <hr>
          <dl>
            <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
            <dd>
              The result will be announced by email <b>7 days after submission</b>.<br />
              Proceeding to the course scheduling is required to finish the registration.<br />
              <span style="color:#ff0000;">* Contact us if you encounter a problem.</span>
            </dd>
          </dl>
          {{--
          <hr>
          --}}
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Submit Your Result</b></h3>
        </div>
        <form role="form" method="post" action="@if($has_uploaded_for_placement_test) # @else {{ route('student.store_placement_tests', [$course_registration->id]) }} @endif" enctype="multipart/form-data">
          @if($has_uploaded_for_placement_test == 0)
            @csrf
            @method('PUT')
          @endif
          <div class="box-body">
            <div class="row">
              {{--Form Kiri--}}
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group @error('indonesian_language_proficiency') has-error @enderror">
                    <label for="indonesian_language_proficiency">Indonesian Language Proficiency (Self-assessment)</label>
                    <input id="indonesian_language_proficiency" name="indonesian_language_proficiency" type="text" class="@error('indonesian_language_proficiency') is-invalid @enderror form-control" disabled value="{{ Auth::user()->student->indonesian_language_proficiency }}">
                    @error('indonesian_language_proficiency')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
              {{--Form Kanan--}}
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group @error('video_link') has-error @enderror">
                    <label for="video_link">Video Link (https)</label>
                    @if($has_uploaded_for_placement_test)
                      <input id="video_link" name="video_link" type="text" class="@error('video_link') is-invalid @enderror form-control" placeholder="Enter Video Link (https link only)" disabled value="{{ $course_registration->placement_test->path }}">
                    @else
                      <input id="video_link" name="video_link" type="text" class="@error('video_link') is-invalid @enderror form-control" placeholder="Enter Video Link (https link only)" value="{{ old('video_link') }}">
                    @endif
                    @error('video_link')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            @if($has_uploaded_for_placement_test)
              <?php
                $submitted_at = \Carbon\Carbon::parse($course_registration->placement_test->submitted_at)->setTimezone(Auth::user()->timezone);
              ?>
              <p class="text-center">
                <b style="color:#cc0000;">
                  Submitted on {{ $submitted_at->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}.<br />
                  The result will be announced by email in 7 days after this time.
                </b>
              </p>
            @else
              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;" onclick="if(document.getElementById('video_link').value == '') { alert('The video link cannot be empty.'); return false; } if( confirm('Are you sure to submit this link: ' + document.getElementById('video_link').value + '?') ) return true; else return false;">
                Submit
              </button>
            @endif
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
@stop
