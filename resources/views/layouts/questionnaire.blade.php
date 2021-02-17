@extends('layouts.admin.default')

@section('title','Registration Form')

@include('layouts.css_and_js.form_advanced')

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><b>New Student Registration Form</b></h3>
    </div>
    <form role="form" method="post" action="{{ route('questionnaire.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            {{--Form Kiri--}}
            <div class="col-md-12">
              <div class="form-group @error('email') has-error @enderror">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="@error('email') is-invalid @enderror form-control" disabled value="{{ Auth::user()->email }}">
                @error('email')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('first_name') has-error @enderror">
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text" class="@error('first_name') is-invalid @enderror form-control" disabled value="{{ Auth::user()->first_name }}">
                @error('first_name')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('last_name') has-error @enderror">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text" class="@error('last_name') is-invalid @enderror form-control" disabled value="{{ Auth::user()->last_name }}">
                @error('last_name')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group @error('age') has-error @enderror">
                <label for="age">Age</label>
                <input id="age" name="age" type="text" class="@error('age') is-invalid @enderror form-control" placeholder="Enter Age" value="{{ old('age') }}">
                @error('age')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('status_job') has-error @enderror">
                <label for="status_job">Job Status</label>
                <select id="status_job" name="status_job" type="text" class="@error('status_job') is-invalid @enderror form-control" onChange="if(document.getElementById('status_job').value == 'Student') {document.getElementById('status_description_label').innerHTML = 'School / University Name'; document.getElementById('status_description_div').className = 'form-group';} else if(document.getElementById('status_job').value == 'Professional') {document.getElementById('status_description_label').innerHTML = 'Working Place'; document.getElementById('status_description_div').className = 'form-group';} else {document.getElementById('status_description_label').innerHTML = 'School / University / Working Place'; document.getElementById('status_description_div').className = 'form-group hidden';}">
                  <option selected="selected" value="">-- Enter Job Status --</option>
                  <option value="Student">Student</option>
                  <option value="Professional">Professional</option>
                </select>
                @error('status_job')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group hidden @error('status_description') has-error @enderror" id="status_description_div">
                <label for="status_description" id="status_description_label">School / University / Working Place</label>
                <input id="status_description" name="status_description" type="text" class="@error('status_description') is-invalid @enderror form-control" placeholder="Enter Value" value="{{ old('status_description') }}">
                @error('status_description')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
          {{--Form Kanan--}}
          <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-group @error('citizenship') has-error @enderror">
                <label for="citizenship">Nationality</label>
                {{--<select id="citizenship" name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control">
                  <option selected="selected" value="">-- Enter Nationality --</option>
                  @foreach($countries as $country)
                    @if(old('citizenship') == $country)
                      <option selected="selected" value="{{ $country }}">{{ $country }}</option>
                    @else
                      <option value="{{ $country }}">{{ $country }}</option>
                    @endif
                  @endforeach
                </select>--}}
                <input id="citizenship" name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control" placeholder="Enter Nationality" value="{{ old('citizenship') }}">
                @error('citizenship')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group @error('domicile') has-error @enderror">
                <label for="domicile">Where do you live now?</label>
                <input id="domicile" name="domicile" type="text" class="@error('domicile') is-invalid @enderror form-control" placeholder="Enter Domicile" value="{{ old('domicile') }}">
                @error('domicile')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group @error('timezone') has-error @enderror">
                <label for="timezone">What is your local time zone?</label>
                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*This information is needed to adjust Indonesian time to your local time<br>for scheduling your sessions</p>
                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Reference: <b><a target="_blank" rel="noopener noreferrer" href="https://www.timeanddate.com/">timeanddate.com</a></b></p>
                <select id="timezone" name="timezone" type="text" class="@error('timezone') is-invalid @enderror form-control">
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
            <div class="col-md-12">
              <div class="form-group @error('indonesian_language_proficiency') has-error @enderror">
                <label for="indonesian_language_proficiency">Indonesian Language Proficiency (Self-assessment)</label>
                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Check the radio box below</p>
                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*The descriptions in each level are based on ACTFL proficiency descriptions</p>
                <p class="hidden" id="descriptionNovice" style="color:#000000; padding-top:0px; margin-top:0px;"><b>Novice Proficiency</b><br>You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge.</p>
                <p class="hidden" id="descriptionIntermediate" style="color:#000000; padding-top:0px; margin-top:0px;"><b>Intermediate Proficiency</b><br>You are categorized as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language.</p>
                <p class="hidden" id="descriptionAdvanced" style="color:#000000; padding-top:0px; margin-top:0px;"><b>Advanced Proficiency</b><br>You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language.</p>
                @if(old('indonesian_language_proficiency') == 'Novice')
                  <input checked id="radioAnswer1" name="indonesian_language_proficiency" type="radio" value="Novice" onchange="if(document.getElementById('radioAnswer1').checked) { document.getElementById('descriptionNovice').className = ''; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                @else
                  <input id="radioAnswer1" name="indonesian_language_proficiency" type="radio" value="Novice" onchange="if(document.getElementById('radioAnswer1').checked) { document.getElementById('descriptionNovice').className = ''; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                @endif
                <label for="radioAnswer1" class="custom-control-label">Novice</label>
                <br>
                @if(old('indonesian_language_proficiency') == 'Intermediate')
                  <input checked id="radioAnswer2" name="indonesian_language_proficiency" type="radio" value="Intermediate" onchange="if(document.getElementById('radioAnswer2').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = ''; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                @else
                  <input id="radioAnswer2" name="indonesian_language_proficiency" type="radio" value="Intermediate" onchange="if(document.getElementById('radioAnswer2').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = ''; document.getElementById('descriptionAdvanced').className = 'hidden'; }">
                @endif
                <label for="radioAnswer2" class="custom-control-label">Intermediate</label>
                <br>
                @if(old('indonesian_language_proficiency') == 'Advanced')
                  <input checked id="radioAnswer3" name="indonesian_language_proficiency" type="radio" value="Advanced" onchange="if(document.getElementById('radioAnswer3').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = ''; }">
                @else
                  <input id="radioAnswer3" name="indonesian_language_proficiency" type="radio" value="Advanced" onchange="if(document.getElementById('radioAnswer3').checked) { document.getElementById('descriptionNovice').className = 'hidden'; document.getElementById('descriptionIntermediate').className = 'hidden'; document.getElementById('descriptionAdvanced').className = ''; }">
                @endif
                <label for="radioAnswer3" class="custom-control-label">Advanced</label>
                @error('indonesian_language_proficiency')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
          {{--Form Bawah--}}
          <div class="col-md-12">
            <br><br>
            <div class="col-md-2">
              <div class="form-group @error('interest_1') has-error @enderror" id="interest_1_div">
                <label for="interest_1">Interest (Max. 6)</label>
                <select name="interest_1" type="text" class="@error('interest_1') is-invalid @enderror form-control" id="interest_1" onChange="if(document.getElementById('interest_1').value != '') {document.getElementById('interest_2_div').className = 'form-group';} else {document.getElementById('interest_2_div').className = 'form-group hidden'; document.getElementById('interest_3_div').className = 'form-group hidden'; document.getElementById('interest_4_div').className = 'form-group hidden'; document.getElementById('interest_5_div').className = 'form-group hidden'; document.getElementById('interest_6_div').className = 'form-group hidden'; document.getElementById('interest_2').value = ''; document.getElementById('interest_3').value = ''; document.getElementById('interest_4').value = ''; document.getElementById('interest_5').value = ''; document.getElementById('interest_6').value = '';}">
                  <option selected="selected" value="">-- Enter Interest --</option>
                  @foreach($interests as $interest)
                    <option value="{{ $interest }}">{{ $interest }}</option>
                  @endforeach
                </select>
                @error('interest_1')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group hidden @error('interest_2') has-error @enderror" id="interest_2_div">
                <label for="interest_2">&nbsp;</label>
                <select name="interest_2" type="text" class="@error('interest_2') is-invalid @enderror form-control" id="interest_2" onChange="if(document.getElementById('interest_2').value != '') {document.getElementById('interest_3_div').className = 'form-group';} else {document.getElementById('interest_3_div').className = 'form-group hidden'; document.getElementById('interest_4_div').className = 'form-group hidden'; document.getElementById('interest_5_div').className = 'form-group hidden'; document.getElementById('interest_6_div').className = 'form-group hidden'; document.getElementById('interest_3').value = ''; document.getElementById('interest_4').value = ''; document.getElementById('interest_5').value = ''; document.getElementById('interest_6').value = '';}">
                  <option selected="selected" value="">-- Enter Interest --</option>
                  @foreach($interests as $interest)
                    <option value="{{ $interest }}">{{ $interest }}</option>
                  @endforeach
                </select>
                @error('interest_2')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group hidden @error('interest_3') has-error @enderror" id="interest_3_div">
                <label for="interest_3">&nbsp;</label>
                <select name="interest_3" type="text" class="@error('interest_3') is-invalid @enderror form-control" id="interest_3" onChange="if(document.getElementById('interest_3').value != '') {document.getElementById('interest_4_div').className = 'form-group';} else {document.getElementById('interest_4_div').className = 'form-group hidden'; document.getElementById('interest_5_div').className = 'form-group hidden'; document.getElementById('interest_6_div').className = 'form-group hidden'; document.getElementById('interest_4').value = ''; document.getElementById('interest_5').value = ''; document.getElementById('interest_6').value = '';}">
                  <option selected="selected" value="">-- Enter Interest --</option>
                  @foreach($interests as $interest)
                    <option value="{{ $interest }}">{{ $interest }}</option>
                  @endforeach
                </select>
                @error('interest_3')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group hidden @error('interest_4') has-error @enderror" id="interest_4_div">
                <label for="interest_4">&nbsp;</label>
                <select name="interest_4" type="text" class="@error('interest_4') is-invalid @enderror form-control" id="interest_4" onChange="if(document.getElementById('interest_4').value != '') {document.getElementById('interest_5_div').className = 'form-group';} else {document.getElementById('interest_5_div').className = 'form-group hidden'; document.getElementById('interest_6_div').className = 'form-group hidden'; document.getElementById('interest_5').value = ''; document.getElementById('interest_6').value = '';}">
                  <option selected="selected" value="">-- Enter Interest --</option>
                  @foreach($interests as $interest)
                    <option value="{{ $interest }}">{{ $interest }}</option>
                  @endforeach
                </select>
                @error('interest_4')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group hidden @error('interest_5') has-error @enderror" id="interest_5_div">
                <label for="interest_5">&nbsp;</label>
                <select name="interest_5" type="text" class="@error('interest_5') is-invalid @enderror form-control" id="interest_5" onChange="if(document.getElementById('interest_5').value != '') {document.getElementById('interest_6_div').className = 'form-group';} else {document.getElementById('interest_6_div').className = 'form-group hidden'; document.getElementById('interest_6').value = '';}">
                  <option selected="selected" value="">-- Enter Interest --</option>
                  @foreach($interests as $interest)
                    <option value="{{ $interest }}">{{ $interest }}</option>
                  @endforeach
                </select>
                @error('interest_5')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group hidden @error('interest_6') has-error @enderror" id="interest_6_div">
                <label for="interest_6">&nbsp;</label>
                <select name="interest_6" type="text" class="@error('interest_6') is-invalid @enderror form-control" id="interest_6">
                  <option selected="selected" value="">-- Enter Interest --</option>
                  @foreach($interests as $interest)
                    <option value="{{ $interest }}">{{ $interest }}</option>
                  @endforeach
                </select>
                @error('interest_6')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12"></div>
            {{--Form--}}
            <div class="col-md-6">
              <div class="form-group @error('target_language_experience') has-error @enderror">
                <label for="target_language_experience">Indonesian Language Experience</label>
                <select name="target_language_experience" type="text" class="@error('target_language_experience') is-invalid @enderror form-control" id="target_language_experience" onChange="if(document.getElementById('target_language_experience').value == 'Others') {document.getElementById('target_language_experience_value_div').className = 'form-group';} else {document.getElementById('target_language_experience_value_div').className = 'form-group hidden';} if(document.getElementById('target_language_experience').value != 'Never (no experience)' && document.getElementById('target_language_experience').value != '') {document.getElementById('description_of_course_taken_div').className = 'form-group';} else {document.getElementById('description_of_course_taken_div').className = 'form-group hidden';}">
                  <option selected="selected" value="">-- Enter Indonesian Language Experience --</option>
                  <option value="Never (no experience)">Never (no experience)</option>
                  <option value="< 6 months">< 6 months</option>
                  <option value="<= 1 year"><= 1 year</option>
                  <option value="Others">Others</option>
                </select>
                @error('target_language_experience')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group hidden @error('target_language_experience_value') has-error @enderror" id="target_language_experience_value_div">
                <label for="target_language_experience_value">I have learned Indonesian for .... years</label>
                @if(old('target_language_experience_value'))
                  <input id="target_language_experience_value" name="target_language_experience_value" type="text" class="@error('target_language_experience_value') is-invalid @enderror form-control" placeholder="Enter Value" value="{{ old('target_language_experience_value') }}">
                @else
                  <input id="target_language_experience_value" name="target_language_experience_value" type="text" class="@error('target_language_experience_value') is-invalid @enderror form-control" placeholder="Enter Value" value="0">
                @endif
                @error('target_language_experience_value')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group hidden @error('description_of_course_taken') has-error @enderror" id="description_of_course_taken_div">
                <label for="description_of_course_taken">
                  Your Learning Experiences<br />
                  <i>
                    If you have studied the Indonesian language, briefly describe any courses you have taken! (write in the Indonesian language—if possible)
                  </i>
                </label>
                <textarea id="description_of_course_taken" name="description_of_course_taken" class="@error('description_of_course_taken') is-invalid @enderror form-control" rows="5" placeholder="Enter Your Learning Experiences">{{ old('description_of_course_taken') }}</textarea>
                @error('description_of_course_taken')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group @error('learning_objective') has-error @enderror" id="learning_objective_div">
                <label for="learning_objective">
                  Your Learning Objectives<br />
                  <i>
                    Why do you want to learn the Indonesian language? (Briefly describe your learning objectives in the Indonesian language—if possible!)
                  </i>
                </label>
                <textarea id="learning_objective" name="learning_objective" class="@error('learning_objective') is-invalid @enderror form-control" rows="5" placeholder="Enter Your Learning Objectives">{{ old('learning_objective') }}</textarea>
                @error('learning_objective')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group @error('image_profile') has-error @enderror">
                <label for="image_profile">Upload Profile Picture</label>
                <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                <input id="image_profile" name="image_profile" type="file" accept="image/*" class="@error('image_profile') is-invalid @enderror form-control">
                @error('image_profile')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
      </div>
    </form>
  </div>
  <!-- /.box -->
@stop
