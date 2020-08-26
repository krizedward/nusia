@extends('layouts.admin.default')

@section('title','Registration Form')

@include('layouts.css_and_js.form_advanced')

@section('content')
                <div class="box box-primary" id="guidelines">
                    <div class="box-header with-border">
                        <h3 class="box-title">Indonesian Language Proficiency Guidelines</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <b>Novice</b>
                                <p>You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.</p>
                            </div>
                            <div class="col-md-12">
                                <b>Intermediate</b>
                                <p>You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.</p>
                            </div>
                            <div class="col-md-12">
                                <b>Advanced</b>
                                <p>You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-default">
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
                                    @if ($errors->get('email'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="email">Email</label>
                                            <input name="email" type="email" class="@error('email') is-invalid @enderror form-control" disabled value="{{ Auth::user()->email }}">
                                            @error('email')
                                            <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    @if ($errors->get('first_name'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="first_name">First Name</label>
                                            <input name="first_name" type="text" class="@error('first_name') is-invalid @enderror form-control" disabled value="{{ Auth::user()->first_name }}">
                                            @error('first_name')
                                            <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        </div>
                                <div class="col-md-6">
                                    @if ($errors->get('last_name'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="last_name">Last Name</label>
                                            <input name="last_name" type="text" class="@error('last_name') is-invalid @enderror form-control" disabled value="{{ Auth::user()->last_name }}">
                                            @error('last_name')
                                            <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    @if ($errors->get('status_job'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="status_job">Job Status</label>
                                            <select name="status_job" type="text" class="@error('status_job') is-invalid @enderror form-control" id="status_job" onChange="if(document.getElementById('status_job').value == 'Student') {document.getElementById('status_description_label').innerHTML = 'School / University Name'; document.getElementById('status_description').className = 'form-group';} else if(document.getElementById('status_job').value == 'Professional') {document.getElementById('status_description_label').innerHTML = 'Working Place'; document.getElementById('status_description').className = 'form-group';} else {document.getElementById('status_description_label').innerHTML = 'School / University / Working Place'; document.getElementById('status_description').className = 'form-group hidden';}">
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
                                    @if ($errors->get('status_description'))
                                        <div class="form-group hidden has-error" id="status_description">
                                    @else
                                        <div class="form-group hidden" id="status_description">
                                    @endif
                                        <label for="status_description" id="status_description_label">School / University / Working Place</label>
                                            <input name="status_description" type="text" class="@error('status_description') is-invalid @enderror form-control" placeholder="Enter Value" id="status_description_input" value="{{ old('status_description') }}">
                                            @error('status_description')
                                            <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                            </div>
                            {{--Form Kanan--}}
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    @if ($errors->get('age'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="age">Age</label>
                                            <input name="age" type="text" class="@error('age') is-invalid @enderror form-control" placeholder="Enter Age" value="{{ old('age') }}">
                                            @error('age')
                                            <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    @if ($errors->get('citizenship'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="citizenship">Citizenship</label>
                                            {{--<select name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Citizenship --</option>
                                                @foreach($countries as $country)
                                                    @if(old('citizenship') == $country)
                                                      <option selected="selected" value="{{ $country }}">{{ $country }}</option>
                                                    @else
                                                      <option value="{{ $country }}">{{ $country }}</option>
                                                    @endif
                                                @endforeach
                                            </select>--}}
                                            <input name="citizenship" type="text" class="@error('age') is-invalid @enderror form-control" placeholder="Enter Citizenship" value="{{ old('citizenship') }}">
                                            @error('citizenship')
                                            <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    @if ($errors->get('timezone'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                          <label for="timezone">What is your local time zone?</label>
                                          <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*This information is needed to adjust Indonesian time to your local time<br>for scheduling your sessions</p>
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
                                <div class="col-md-12">
                                    @if ($errors->get('indonesian_language_proficiency'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        <label for="indonesian_language_proficiency">Indonesian Language Proficiency (Self-assessment)</label>
                                        <p style="color:#ff0000; padding-top:0px; margin-top:0px;"><a href="#guidelines" style="color:#ff0000;">*Check the proficiency guidelines above</a></p>
                                            <select name="indonesian_language_proficiency" type="text" class="@error('indonesian_language_proficiency') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Indonesian Language Proficiency --</option>
                                                @if(old('indonesian_language_proficiency') == 'Novice')
                                                  <option selected="selected" value="Novice">Novice</option>
                                                @else
                                                  <option value="Novice">Novice</option>
                                                @endif
                                                @if(old('indonesian_language_proficiency') == 'Intermediate')
                                                  <option selected="selected" value="Intermediate">Intermediate</option>
                                                @else
                                                  <option value="Intermediate">Intermediate</option>
                                                @endif
                                                @if(old('indonesian_language_proficiency') == 'Advanced')
                                                  <option selected="selected" value="Advanced">Advanced</option>
                                                @else
                                                  <option value="Advanced">Advanced</option>
                                                @endif
                                            </select>
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
                                    @if ($errors->get('interest_1'))
                                        <div class="form-group has-error" id="interest_1">
                                    @else
                                        <div class="form-group" id="interest_1">
                                    @endif
                                        <label for="interest_1">Interest (Max. 6)</label>
                                            <select name="interest_1" type="text" class="@error('interest_1') is-invalid @enderror form-control" id="interest_1_input" onChange="if(document.getElementById('interest_1_input').value != '') {document.getElementById('interest_2').className = 'form-group';} else {document.getElementById('interest_2').className = 'form-group hidden'; document.getElementById('interest_3').className = 'form-group hidden'; document.getElementById('interest_4').className = 'form-group hidden'; document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_2_input').value = ''; document.getElementById('interest_3_input').value = ''; document.getElementById('interest_4_input').value = ''; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
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
                                    @if ($errors->get('interest_2'))
                                        <div class="form-group hidden has-error" id="interest_2">
                                    @else
                                        <div class="form-group hidden" id="interest_2">
                                    @endif
                                        <label for="interest_2">&nbsp;</label>
                                            <select name="interest_2" type="text" class="@error('interest_2') is-invalid @enderror form-control" id="interest_2_input" onChange="if(document.getElementById('interest_2_input').value != '') {document.getElementById('interest_3').className = 'form-group';} else {document.getElementById('interest_3').className = 'form-group hidden'; document.getElementById('interest_4').className = 'form-group hidden'; document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_3_input').value = ''; document.getElementById('interest_4_input').value = ''; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
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
                                    @if ($errors->get('interest_3'))
                                        <div class="form-group hidden has-error" id="interest_3">
                                    @else
                                        <div class="form-group hidden" id="interest_3">
                                    @endif
                                        <label for="interest_3">&nbsp;</label>
                                            <select name="interest_3" type="text" class="@error('interest_3') is-invalid @enderror form-control" id="interest_3_input" onChange="if(document.getElementById('interest_3_input').value != '') {document.getElementById('interest_4').className = 'form-group';} else {document.getElementById('interest_4').className = 'form-group hidden'; document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_4_input').value = ''; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
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
                                    @if ($errors->get('interest_4'))
                                        <div class="form-group hidden has-error" id="interest_4">
                                    @else
                                        <div class="form-group hidden" id="interest_4">
                                    @endif
                                        <label for="interest_4">&nbsp;</label>
                                            <select name="interest_4" type="text" class="@error('interest_4') is-invalid @enderror form-control" id="interest_4_input" onChange="if(document.getElementById('interest_4_input').value != '') {document.getElementById('interest_5').className = 'form-group';} else {document.getElementById('interest_5').className = 'form-group hidden'; document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_5_input').value = ''; document.getElementById('interest_6_input').value = '';}">
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
                                    @if ($errors->get('interest_5'))
                                        <div class="form-group hidden has-error" id="interest_5">
                                    @else
                                        <div class="form-group hidden" id="interest_5">
                                    @endif
                                        <label for="interest_5">&nbsp;</label>
                                            <select name="interest_5" type="text" class="@error('interest_5') is-invalid @enderror form-control" id="interest_5_input" onChange="if(document.getElementById('interest_5_input').value != '') {document.getElementById('interest_6').className = 'form-group';} else {document.getElementById('interest_6').className = 'form-group hidden'; document.getElementById('interest_6_input').value = '';}">
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
                                    @if ($errors->get('interest_6'))
                                        <div class="form-group hidden has-error" id="interest_6">
                                    @else
                                        <div class="form-group hidden" id="interest_6">
                                    @endif
                                        <label for="interest_6">&nbsp;</label>
                                            <select name="interest_6" type="text" class="@error('interest_6') is-invalid @enderror form-control" id="interest_6_input">
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
                                @if ($errors->get('target_language_experience'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    <label for="target_language_experience">Indonesian Language Experience</label>
                                        <select name="target_language_experience" type="text" class="@error('target_language_experience') is-invalid @enderror form-control" id="target_language_experience" onChange="if(document.getElementById('target_language_experience').value == 'Others') {document.getElementById('target_language_experience_value').className = 'form-group';} else {document.getElementById('target_language_experience_value').className = 'form-group hidden';} if(document.getElementById('target_language_experience').value != 'Never (no experience)' && document.getElementById('target_language_experience').value != '') {document.getElementById('description_of_course_taken').className = 'form-group';} else {document.getElementById('description_of_course_taken').className = 'form-group hidden';}">
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
                                @if ($errors->get('target_language_experience_value'))
                                    <div class="form-group hidden has-error" id="target_language_experience_value">
                                @else
                                    <div class="form-group hidden" id="target_language_experience_value">
                                @endif
                                    <label for="target_language_experience_value">I have learned Indonesian for .... years</label>
                                        <input name="target_language_experience_value" type="text" class="@error('target_language_experience_value') is-invalid @enderror form-control" placeholder="Enter Value" value="{{ old('target_language_experience_value') }}">
                                        @error('target_language_experience_value')
                                        <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-12">
                                @if ($errors->get('description_of_course_taken'))
                                    <div class="form-group hidden has-error" id="description_of_course_taken">
                                @else
                                    <div class="form-group hidden" id="description_of_course_taken">
                                @endif
                                    <label for="description_of_course_taken">Your Learning Experiences</label>
                                        <textarea name="description_of_course_taken" class="@error('description_of_course_taken') is-invalid @enderror form-control" rows="5" placeholder="If you have studied the Indonesian language, briefly describe any courses you have taken! (write in the Indonesian language—if possible)">{{ old('description_of_course_taken') }}</textarea>
                                        @error('description_of_course_taken')
                                        <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-12">
                                @if ($errors->get('learning_objective'))
                                    <div class="form-group has-error" id="learning_objective">
                                @else
                                    <div class="form-group" id="learning_objective">
                                @endif
                                    <label for="learning_objective">Your Learning Objectives</label>
                                        <textarea name="learning_objective" class="@error('learning_objective') is-invalid @enderror form-control" rows="5" placeholder="Why do you want to learn the Indonesian language? (Briefly describe your learning objectives in the Indonesian language—if possible!)">{{ old('learning_objective') }}</textarea>
                                        @error('learning_objective')
                                        <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-12">
                                @if ($errors->get('image_profile'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
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
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
@stop
