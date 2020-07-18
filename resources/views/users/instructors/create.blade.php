@extends('layouts.admin.default')
@section('title','Instructor Create Form')
@include('layouts.css_and_js.form_general')
@section('content-header')
  <h1>Instructor</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('instructors.index') }}">Instructor</a></li>
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
        <form role="form" method="post" action="{{ route('instructors.store') }}">
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
              </div>
              <div class="col-md-6">
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
              <div class="col-md-12">
                <br><br>
                <div class="col-md-2">
                  @if ($errors->get('interest_1'))
                    <div class="form-group has-error" id="interest_1">
                  @else
                    <div class="form-group" id="interest_1">
                  @endif
                      <label for="interest_1">Interest #1</label>
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
                      <label for="interest_2">Interest #2</label>
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
                      <label for="interest_3">Interest #3</label>
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
                      <label for="interest_4">Interest #4</label>
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
                      <label for="interest_5">Interest #5</label>
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
                      <label for="interest_6">Interest #6</label>
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
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_1'))
                    <div class="form-group has-error" id="working_experience_begin_year_1">
                  @else
                    <div class="form-group" id="working_experience_begin_year_1">
                  @endif
                      <label for="working_experience_begin_year_1">Working Experience #1</label>
                      <select name="working_experience_begin_year_1" type="text" class="@error('working_experience_begin_year_1') is-invalid @enderror form-control" id="working_experience_begin_year_1_input" onChange="if(document.getElementById('working_experience_begin_year_1_input').value != '') {document.getElementById('working_experience_end_year_1').className = 'form-group'; document.getElementById('working_experience_1').className = 'form-group';} else {document.getElementById('working_experience_end_year_1').className = 'form-group hidden'; document.getElementById('working_experience_1').className = 'form-group hidden';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_1')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_1'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_1">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_1">
                  @endif
                      <label for="working_experience_end_year_1">&nbsp;</label>
                      <select name="working_experience_end_year_1" type="text" class="@error('working_experience_end_year_1') is-invalid @enderror form-control" id="working_experience_end_year_1_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_1')
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
