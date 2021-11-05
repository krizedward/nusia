@extends('layouts.admin.default')

@section('title', 'Completing Placement Test')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1>
    <b>
      Indonesian Proficiency Placement Test
      @if($has_uploaded_for_placement_test == 2)
        (Interview)
      @endif
    </b>
  </h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Placement Test Information</b></h3>
        </div>
        <div class="box-body">
          @if($has_uploaded_for_placement_test != 2)
{{--
            <dl>
              <dt><i class="fa fa-pencil margin-r-5"></i> Reading the Requirements</dt>
              <dd>
                Click this
                <a href="#" target="_blank">blue-colored link</a>
                to download the test requirements.
              </dd>
            </dl>
            <hr>
--}}
            <dl>
              <dt><i class="fa fa-file-video-o margin-r-5"></i> Preparing the Video</dt>
              <dd>
                Record a video that fulfills all test requirements.
                Before recording the video, <b>you must ensure that your face is well-recognized in the camera while preserving good lightning and clear audio</b>.
                After recording the video, upload to <b>Google Drive</b> or other file storages.
                Then, prepare a shareable link to the video.
              </dd>
            </dl>
            <hr>
            <dl>
              <dt><i class="fa fa-check margin-r-5"></i> Completing the Test</dt>
              <dd>
                After preparing the link, fill out the submission form and click "submit" button.
                {{--<br />Please check whether the link has been attached successfully.<br />--}}
              </dd>
            </dl>
            <hr>
            <dl>
              <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
              <dd>
                The result will be announced by email <b>no later than 7 days after submission</b>.<br />
                Proceeding to the course scheduling is required to finish the registration.<br />
                <span style="color:#ff0000;">Contact NUSIA Academic if you encounter a problem.</span>
              </dd>
            </dl>
            <hr>
            <a href="{{ route('student.chat_lead_instructor.show', [91]) }}" target="_blank" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noopener noreferrer">
              <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Chat NUSIA Academic
            </a>
          @else
            <dl>
              <dt><i class="fa fa-user-circle-o margin-r-5"></i> Attending an Interview</dt>
              <dd>
                You are required to attend an interview to complete your placement test procedure.
              </dd>
            </dl>
            <?php
              $schedule_time = \Carbon\Carbon::parse($course_registration->placement_test->result_updated_at)->setTimezone(Auth::user()->timezone);
            ?>
            <p>
              <table>
                <tr style="vertical-align:baseline;">
                  <td width="35"><b>Day</b></td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ $schedule_time->isoFormat('dddd') }}</td>
                </tr>
                <tr style="vertical-align:baseline;">
                  <td width="35"><b>Date</b></td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ $schedule_time->isoFormat('MMMM Do YYYY, hh:mm A') }}</td>
                </tr>
                <tr style="vertical-align:baseline;">
                  <td width="35"><b>Link</b></td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td>
                    Click the button below to join the interview session
                  </td>
                </tr>
              </table>
            </p>
            <a href="{{ $course_registration->course->requirement }}" target="_blank" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noreferrer nofollow">Join Interview</a>
            <hr>
            <dl>
              <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
              <dd>
                The interview result will be announced by email <b>no later than 7 days after the session ends</b>.<br />
                Proceeding to the course scheduling is required to finish the registration.<br />
                <span style="color:#ff0000;">Contact NUSIA Academic if you encounter a problem.</span>
              </dd>
            </dl>
            <hr>
            <a href="{{ route('student.chat_lead_instructor.show', [91]) }}" target="_blank" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noopener noreferrer">
              <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Chat NUSIA Academic
            </a>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Submit Your Placement Test Video</b></h3>
        </div>
        <form role="form" method="post" action="@if($has_uploaded_for_placement_test) # @else {{ route('student.upload_placement_test.update', [$course_registration->id]) }} @endif" enctype="multipart/form-data">
          @if($has_uploaded_for_placement_test == 0)
            @csrf
            @method('PUT')
          @endif
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="indonesian_language_proficiency">Registered for</label>
                    <input id="indonesian_language_proficiency" type="text" class="form-control" disabled value="{{ $course_registration->course->course_package->material_type->name }}">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="indonesian_language_proficiency">Indonesian Language Proficiency (Self-assessment)</label>
                    <input id="indonesian_language_proficiency" type="text" class="form-control" disabled value="{{ Auth::user()->student->indonesian_language_proficiency }}">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="target_language_experience">Indonesian Language Learning Experience</label>
                    <input id="target_language_experience" type="text" class="form-control" disabled value="@if(Auth::user()->student->target_language_experience != 'Others'){{ Auth::user()->student->target_language_experience }} @else{{ Auth::user()->student->target_language_experience_value }} years @endif">
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group @error('indonesian_language_proficiency') has-error @enderror">
{{--
                    <label for="indonesian_language_proficiency" style="padding-bottom:0px; margin-bottom:0px;">
                      You have categorized your Indonesian proficiency
                      in <b>{{ strtoupper(Auth::user()->student->indonesian_language_proficiency) }} level</b>.<br />
                    </label>
                    <p style="padding-top:0px; margin-top:0px;">
                      Then, record a video of yourself answering
                      the following questions in the required duration based on your chosen level.<br />
                      After that, upload it to Google Drive or other file storages
                      and prepare a sharable link to the video.<br />
                    </p>
--}}
                    @if(Auth::user()->student->indonesian_language_proficiency == 'Novice')
                      <p id="descriptionNovice" style="padding-top:0px; margin-top:0px;">
                        <b><span style="color:#ff0000;">
                        If you have never learnt bahasa Indonesia before or
                        only known limited Indonesian vocabulary,</span><br />
                        please answer these questions within 2-4 minutes,
                        either in Indonesian language or English:</b><br />
                        <b>1. Tell me about yourself!</b><br />
                        <b>2. What are your reason(s) and expectation(s) in joining NUSIA's class?</b><br />
                        <br />
                        <b><span style="color:#ff0000;">
                        If you have learnt bahasa Indonesia before,</span><br />
                        please choose these following questions to answer within 3-5 minutes
                        (number 1 is required to answer). You can answer them based
                        on the guided questions. Please answer in bahasa Indonesia (if you can).</b><br />
                        <b>1. Tolong ceritakan tentang diri (profil) Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Siapa nama Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Dari mana asal Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apakah Anda kuliah atau bekerja? Di mana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Di mana Anda tinggal?<br />
                        <b>2. Apa aktivitas Anda sehari-hari?</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; (mulai dari bangun tidur sampai tidur lagi)<br />
                        <b>3. Ceritakan tentang hobi Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apa hobi Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Melakukan hobi dengan siapa?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Di mana melakukan hobi itu?<br />
                        <b>4. Ceritakan tentang makanan favorit Anda?</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apa makanan favorit Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Membeli atau memasak makanan itu?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Jika membeli, di mana?<br />
                        <b>5. Ceritakan tentang liburan favorit Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apakah Anda suka berlibur? Ke mana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Mengapa Anda suka berlibur ke sana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Bagaimana liburan itu?<br />
                      </p>
                    @elseif(Auth::user()->student->indonesian_language_proficiency == 'Intermediate')
                      <p id="descriptionIntermediate" style="padding-top:0px; margin-top:0px;">
                        <b>INTERMEDIATE LEVEL (5-7 minutes)</b><br />
                        Choose these following questions to answer within 5-7 minutes
                        (number 1 is required to answer)! You can answer them based
                        on the guided questions! Please answer in bahasa Indonesia!<br />
                        <b>1. Tolong ceritakan tentang diri (profil) Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Siapa nama Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Dari mana asal Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apakah Anda kuliah atau bekerja? Di mana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Di mana Anda tinggal?<br />
                        <b>2. Apa aktivitas Anda sehari-hari?</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; (mulai dari bangun tidur sampai tidur lagi)<br />
                        <b>3. Ceritakan tentang hobi Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apa hobi Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Melakukan hobi dengan siapa?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Di mana melakukan hobi itu?<br />
                        <b>4. Ceritakan tentang makanan favorit Anda?</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apa makanan favorit Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Membeli atau memasak makanan itu?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Jika membeli, di mana?<br />
                        <b>5. Ceritakan tentang liburan favorit Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apakah Anda suka berlibur? Ke mana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Mengapa Anda suka berlibur ke sana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Bagaimana liburan itu?<br />
                      </p>
                    @elseif(Auth::user()->student->indonesian_language_proficiency == 'Advanced')
                      <p id="descriptionAdvanced" style="padding-top:0px; margin-top:0px;">
                        <b>ADVANCED LEVEL (7-10 minutes)</b><br />
                        Choose these following questions to answer within 5-7 minutes
                        (number 1 is required to answer)! You can answer them based
                        on the guided questions! Please answer in bahasa Indonesia!<br />
                        <b>1. Tolong ceritakan tentang diri (profil) Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Siapa nama Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Dari mana asal Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apakah Anda kuliah atau bekerja? Di mana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Di mana Anda tinggal?<br />
                        <b>2. Apa aktivitas Anda sehari-hari?</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; (mulai dari bangun tidur sampai tidur lagi)<br />
                        <b>3. Ceritakan tentang hobi Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apa hobi Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Melakukan hobi dengan siapa?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Di mana melakukan hobi itu?<br />
                        <b>4. Ceritakan tentang makanan favorit Anda?</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apa makanan favorit Anda?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Membeli atau memasak makanan itu?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Jika membeli, di mana?<br />
                        <b>5. Ceritakan tentang liburan favorit Anda!</b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Apakah Anda suka berlibur? Ke mana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Mengapa Anda suka berlibur ke sana?<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp; Bagaimana liburan itu?<br />
                      </p>
                    @endif
{{--
                    @if(old('indonesian_language_proficiency') == 'Novice')
                      <input checked id="radioAnswer1" name="indonesian_language_proficiency" type="radio" value="Novice" onchange="if(document.getElementById('radioAnswer1').checked) { document.getElementById('descriptionNoviceLow').className = ''; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                    @else
                      <input id="radioAnswer1" name="indonesian_language_proficiency" type="radio" value="Novice" onchange="if(document.getElementById('radioAnswer1').checked) { document.getElementById('descriptionNoviceLow').className = ''; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                    @endif
                    <label for="radioAnswer1" class="custom-control-label">Novice</label>
                    <br />
                    @if(old('indonesian_language_proficiency') == 'Intermediate')
                      <input checked id="radioAnswer2" name="indonesian_language_proficiency" type="radio" value="Intermediate" onchange="if(document.getElementById('radioAnswer2').checked) { document.getElementById('descriptionNoviceLow').className = 'hidden'; document.getElementById('descriptionIntermediate').className = ''; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                    @else
                      <input id="radioAnswer2" name="indonesian_language_proficiency" type="radio" value="Intermediate" onchange="if(document.getElementById('radioAnswer2').checked) { document.getElementById('descriptionNoviceLow').className = 'hidden'; document.getElementById('descriptionIntermediate').className = ''; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                    @endif
                    <label for="radioAnswer2" class="custom-control-label">Intermediate</label>
                    <br />
                    @if(old('indonesian_language_proficiency') == 'Advanced')
                      <input checked id="radioAnswer3" name="indonesian_language_proficiency" type="radio" value="Advanced" onchange="if(document.getElementById('radioAnswer3').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = ''; }">
                    @else
                      <input id="radioAnswer3" name="indonesian_language_proficiency" type="radio" value="Advanced" onchange="if(document.getElementById('radioAnswer3').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = ''; }">
                    @endif
                    <label for="radioAnswer3" class="custom-control-label">Advanced</label>
--}}
                  </div>
                </div>
              </div>
              <div class="col-md-12">
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
                  @if($has_uploaded_for_placement_test == 2)
                    You are required to attend an interview to proceed finishing the course registration.
                  @else
                    The result will be announced by email no later than 7 days after this time.
                  @endif
                </b>
              </p>
            @else
              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;" onclick="if(document.getElementById('video_link').value == '') { alert('The video link cannot be empty.'); return false; } if( confirm('Are you sure to submit this link: ' + document.getElementById('video_link').value + '? This action cannot be undone.') ) return true; else return false;">
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
