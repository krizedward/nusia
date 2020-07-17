@extends('layouts.admin.default')
@section('title','Student Create Form')
@include('layouts.css_and_js.form_general')
@section('content-header')
  <h1>Student</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('students.index') }}">Student</a></li>
    <li class="active">Add</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Create Form</h3>
        </div>
        <form role="form" method="post" action="{{ route('students.store') }}">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-6">
                  @if ($errors->get('email'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="email">Email</label>
                      <input name="email" type="email" class="@error('email') is-invalid @enderror form-control" placeholder="Enter Email">
                      @error('email')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-6">
                  @if ($errors->get('password'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="password">Password</label>
                      <input name="password" type="password" class="@error('password') is-invalid @enderror form-control" placeholder="Enter Password">
                      @error('password')
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
                      <input name="first_name" type="text" class="@error('first_name') is-invalid @enderror form-control" placeholder="Enter First Name">
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
                      <input name="last_name" type="text" class="@error('last_name') is-invalid @enderror form-control" placeholder="Enter Last Name">
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
                      <input name="status_description" type="text" class="@error('status_description') is-invalid @enderror form-control" placeholder="Enter Value" id="status_description_input">
                      @error('status_description')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  @if ($errors->get('age'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="age">Age</label>
                      <input name="age" type="text" class="@error('age') is-invalid @enderror form-control" placeholder="Enter Age">
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
                      <select name="citizenship" type="text" class="@error('citizenship') is-invalid @enderror form-control">
                        <option selected="selected" value="">-- Enter Citizenship --</option>
                        @foreach($countries as $country)
                          <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                      </select>
                      @error('citizenship')
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
                      <label for="indonesian_language_proficiency">Indonesian Language Proficiency</label>
                      <select name="indonesian_language_proficiency" type="text" class="@error('indonesian_language_proficiency') is-invalid @enderror form-control">
                        <option selected="selected" value="">-- Enter Indonesian Language Proficiency --</option>
                        <option value="Novice">Novice</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                      </select>
                      @error('indonesian_language_proficiency')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <br><br>
                <div class="col-md-2">
                  @if ($errors->get('interest_1'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="interest_1">Interest #1</label>
                      <select name="interest_1" type="text" class="@error('interest_1') is-invalid @enderror form-control">
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
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="interest_2">Interest #2</label>
                      <select name="interest_2" type="text" class="@error('interest_2') is-invalid @enderror form-control">
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
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="interest_3">Interest #3</label>
                      <select name="interest_3" type="text" class="@error('interest_3') is-invalid @enderror form-control">
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
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="interest_4">Interest #4</label>
                      <select name="interest_4" type="text" class="@error('interest_4') is-invalid @enderror form-control">
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
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="interest_5">Interest #5</label>
                      <select name="interest_5" type="text" class="@error('interest_5') is-invalid @enderror form-control">
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
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="interest_6">Interest #6</label>
                      <select name="interest_6" type="text" class="@error('interest_6') is-invalid @enderror form-control">
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
                <div class="col-md-6">
                  @if ($errors->get('target_language_experience'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="target_language_experience">Indonesian Language Experience</label>
                      <select name="target_language_experience" type="text" class="@error('target_language_experience') is-invalid @enderror form-control" id="target_language_experience" onChange="if(document.getElementById('target_language_experience').value == 'Others') {document.getElementById('target_language_experience_value').className = 'form-group';} else {document.getElementById('target_language_experience_value').className = 'form-group hidden';} if(document.getElementById('target_language_experience').value != 'Never (no experience)') {document.getElementById('description_of_course_taken').className = 'form-group';} else {document.getElementById('description_of_course_taken').className = 'form-group hidden';}">
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
                      <input name="target_language_experience_value" type="text" class="@error('target_language_experience_value') is-invalid @enderror form-control" placeholder="Enter Value">
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
                      <label for="description_of_course_taken">Description of Courses Taken (in Indonesian Language)</label>
                      <textarea name="description_of_course_taken" class="@error('description_of_course_taken') is-invalid @enderror form-control" rows="5" placeholder="Describe any courses you have taken (in Indonesian language)"></textarea>
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
                      <label for="learning_objective">Your Learning Objectives (in Indonesian Language)</label>
                      <textarea name="learning_objective" class="@error('learning_objective') is-invalid @enderror form-control" rows="5" placeholder="Describe your learning objectives (in Indonesian language)"></textarea>
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
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
