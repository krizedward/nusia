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
        <form role="form" method="post" action="{{ route('instructors.store') }}" enctype="multipart/form-data">
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
                      <label for="working_experience_begin_year_1">Working Experience #1<br>From</label>
                      <select name="working_experience_begin_year_1" type="text" class="@error('working_experience_begin_year_1') is-invalid @enderror form-control" id="working_experience_begin_year_1_input" onChange="if(document.getElementById('working_experience_begin_year_1_input').value != '') {document.getElementById('working_experience_end_year_1').className = 'form-group'; document.getElementById('working_experience_1').className = 'form-group'; document.getElementById('working_experience_begin_year_2').className = 'form-group';} else {document.getElementById('working_experience_end_year_1').className = 'form-group hidden'; document.getElementById('working_experience_1').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_2').className = 'form-group hidden'; document.getElementById('working_experience_end_year_2').className = 'form-group hidden'; document.getElementById('working_experience_2').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_2_input').value = ''; document.getElementById('working_experience_end_year_2_input').value = ''; document.getElementById('working_experience_2_input').value = ''; document.getElementById('working_experience_begin_year_3').className = 'form-group hidden'; document.getElementById('working_experience_end_year_3').className = 'form-group hidden'; document.getElementById('working_experience_3').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_3_input').value = ''; document.getElementById('working_experience_end_year_3_input').value = ''; document.getElementById('working_experience_3_input').value = ''; document.getElementById('working_experience_begin_year_4').className = 'form-group hidden'; document.getElementById('working_experience_end_year_4').className = 'form-group hidden'; document.getElementById('working_experience_4').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_4_input').value = ''; document.getElementById('working_experience_end_year_4_input').value = ''; document.getElementById('working_experience_4_input').value = ''; document.getElementById('working_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('working_experience_end_year_5').className = 'form-group hidden'; document.getElementById('working_experience_5').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_5_input').value = ''; document.getElementById('working_experience_end_year_5_input').value = ''; document.getElementById('working_experience_5_input').value = ''; document.getElementById('working_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('working_experience_end_year_6').className = 'form-group hidden'; document.getElementById('working_experience_6').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_6_input').value = ''; document.getElementById('working_experience_end_year_6_input').value = ''; document.getElementById('working_experience_6_input').value = ''; document.getElementById('working_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7_input').value = ''; document.getElementById('working_experience_end_year_7_input').value = ''; document.getElementById('working_experience_7_input').value = ''; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
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
                      <label for="working_experience_end_year_1">&nbsp;<br>To (optional)</label>
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
                <div class="col-md-8">
                  @if ($errors->get('working_experience_1'))
                    <div class="form-group hidden has-error" id="working_experience_1">
                  @else
                    <div class="form-group hidden" id="working_experience_1">
                  @endif
                      <label for="working_experience_1">&nbsp;<br>Description</label>
                      <input name="working_experience_1" type="text" class="@error('working_experience_1') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_1_input">
                      @error('working_experience_1')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_2'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_2">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_2">
                  @endif
                      <label for="working_experience_begin_year_2">Working Experience #2<br>From</label>
                      <select name="working_experience_begin_year_2" type="text" class="@error('working_experience_begin_year_2') is-invalid @enderror form-control" id="working_experience_begin_year_2_input" onChange="if(document.getElementById('working_experience_begin_year_2_input').value != '') {document.getElementById('working_experience_end_year_2').className = 'form-group'; document.getElementById('working_experience_2').className = 'form-group'; document.getElementById('working_experience_begin_year_3').className = 'form-group';} else {document.getElementById('working_experience_end_year_2').className = 'form-group hidden'; document.getElementById('working_experience_2').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_3').className = 'form-group hidden'; document.getElementById('working_experience_end_year_3').className = 'form-group hidden'; document.getElementById('working_experience_3').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_3_input').value = ''; document.getElementById('working_experience_end_year_3_input').value = ''; document.getElementById('working_experience_3_input').value = ''; document.getElementById('working_experience_begin_year_4').className = 'form-group hidden'; document.getElementById('working_experience_end_year_4').className = 'form-group hidden'; document.getElementById('working_experience_4').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_4_input').value = ''; document.getElementById('working_experience_end_year_4_input').value = ''; document.getElementById('working_experience_4_input').value = ''; document.getElementById('working_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('working_experience_end_year_5').className = 'form-group hidden'; document.getElementById('working_experience_5').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_5_input').value = ''; document.getElementById('working_experience_end_year_5_input').value = ''; document.getElementById('working_experience_5_input').value = ''; document.getElementById('working_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('working_experience_end_year_6').className = 'form-group hidden'; document.getElementById('working_experience_6').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_6_input').value = ''; document.getElementById('working_experience_end_year_6_input').value = ''; document.getElementById('working_experience_6_input').value = ''; document.getElementById('working_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7_input').value = ''; document.getElementById('working_experience_end_year_7_input').value = ''; document.getElementById('working_experience_7_input').value = ''; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_2')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_2'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_2">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_2">
                  @endif
                      <label for="working_experience_end_year_2">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_2" type="text" class="@error('working_experience_end_year_2') is-invalid @enderror form-control" id="working_experience_end_year_2_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_2')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_2'))
                    <div class="form-group hidden has-error" id="working_experience_2">
                  @else
                    <div class="form-group hidden" id="working_experience_2">
                  @endif
                      <label for="working_experience_2">&nbsp;<br>Description</label>
                      <input name="working_experience_2" type="text" class="@error('working_experience_2') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_2_input">
                      @error('working_experience_2')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_3'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_3">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_3">
                  @endif
                      <label for="working_experience_begin_year_3">Working Experience #3<br>From</label>
                      <select name="working_experience_begin_year_3" type="text" class="@error('working_experience_begin_year_3') is-invalid @enderror form-control" id="working_experience_begin_year_3_input" onChange="if(document.getElementById('working_experience_begin_year_3_input').value != '') {document.getElementById('working_experience_end_year_3').className = 'form-group'; document.getElementById('working_experience_3').className = 'form-group'; document.getElementById('working_experience_begin_year_4').className = 'form-group';} else {document.getElementById('working_experience_end_year_3').className = 'form-group hidden'; document.getElementById('working_experience_3').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_4').className = 'form-group hidden'; document.getElementById('working_experience_end_year_4').className = 'form-group hidden'; document.getElementById('working_experience_4').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_4_input').value = ''; document.getElementById('working_experience_end_year_4_input').value = ''; document.getElementById('working_experience_4_input').value = ''; document.getElementById('working_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('working_experience_end_year_5').className = 'form-group hidden'; document.getElementById('working_experience_5').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_5_input').value = ''; document.getElementById('working_experience_end_year_5_input').value = ''; document.getElementById('working_experience_5_input').value = ''; document.getElementById('working_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('working_experience_end_year_6').className = 'form-group hidden'; document.getElementById('working_experience_6').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_6_input').value = ''; document.getElementById('working_experience_end_year_6_input').value = ''; document.getElementById('working_experience_6_input').value = ''; document.getElementById('working_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7_input').value = ''; document.getElementById('working_experience_end_year_7_input').value = ''; document.getElementById('working_experience_7_input').value = ''; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_3')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_3'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_3">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_3">
                  @endif
                      <label for="working_experience_end_year_3">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_3" type="text" class="@error('working_experience_end_year_3') is-invalid @enderror form-control" id="working_experience_end_year_3_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_3')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_3'))
                    <div class="form-group hidden has-error" id="working_experience_3">
                  @else
                    <div class="form-group hidden" id="working_experience_3">
                  @endif
                      <label for="working_experience_3">&nbsp;<br>Description</label>
                      <input name="working_experience_3" type="text" class="@error('working_experience_3') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_3_input">
                      @error('working_experience_3')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_4'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_4">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_4">
                  @endif
                      <label for="working_experience_begin_year_4">Working Experience #4<br>From</label>
                      <select name="working_experience_begin_year_4" type="text" class="@error('working_experience_begin_year_4') is-invalid @enderror form-control" id="working_experience_begin_year_4_input" onChange="if(document.getElementById('working_experience_begin_year_4_input').value != '') {document.getElementById('working_experience_end_year_4').className = 'form-group'; document.getElementById('working_experience_4').className = 'form-group'; document.getElementById('working_experience_begin_year_5').className = 'form-group';} else {document.getElementById('working_experience_end_year_4').className = 'form-group hidden'; document.getElementById('working_experience_4').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('working_experience_end_year_5').className = 'form-group hidden'; document.getElementById('working_experience_5').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_5_input').value = ''; document.getElementById('working_experience_end_year_5_input').value = ''; document.getElementById('working_experience_5_input').value = ''; document.getElementById('working_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('working_experience_end_year_6').className = 'form-group hidden'; document.getElementById('working_experience_6').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_6_input').value = ''; document.getElementById('working_experience_end_year_6_input').value = ''; document.getElementById('working_experience_6_input').value = ''; document.getElementById('working_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7_input').value = ''; document.getElementById('working_experience_end_year_7_input').value = ''; document.getElementById('working_experience_7_input').value = ''; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_4')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_4'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_4">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_4">
                  @endif
                      <label for="working_experience_end_year_4">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_4" type="text" class="@error('working_experience_end_year_4') is-invalid @enderror form-control" id="working_experience_end_year_4_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_4')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_4'))
                    <div class="form-group hidden has-error" id="working_experience_4">
                  @else
                    <div class="form-group hidden" id="working_experience_4">
                  @endif
                      <label for="working_experience_4">&nbsp;<br>Description</label>
                      <input name="working_experience_4" type="text" class="@error('working_experience_4') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_4_input">
                      @error('working_experience_4')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_5'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_5">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_5">
                  @endif
                      <label for="working_experience_begin_year_5">Working Experience #5<br>From</label>
                      <select name="working_experience_begin_year_5" type="text" class="@error('working_experience_begin_year_5') is-invalid @enderror form-control" id="working_experience_begin_year_5_input" onChange="if(document.getElementById('working_experience_begin_year_5_input').value != '') {document.getElementById('working_experience_end_year_5').className = 'form-group'; document.getElementById('working_experience_5').className = 'form-group'; document.getElementById('working_experience_begin_year_6').className = 'form-group';} else {document.getElementById('working_experience_end_year_5').className = 'form-group hidden'; document.getElementById('working_experience_5').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('working_experience_end_year_6').className = 'form-group hidden'; document.getElementById('working_experience_6').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_6_input').value = ''; document.getElementById('working_experience_end_year_6_input').value = ''; document.getElementById('working_experience_6_input').value = ''; document.getElementById('working_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7_input').value = ''; document.getElementById('working_experience_end_year_7_input').value = ''; document.getElementById('working_experience_7_input').value = ''; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_5')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_5'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_5">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_5">
                  @endif
                      <label for="working_experience_end_year_5">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_5" type="text" class="@error('working_experience_end_year_5') is-invalid @enderror form-control" id="working_experience_end_year_5_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_5')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_5'))
                    <div class="form-group hidden has-error" id="working_experience_5">
                  @else
                    <div class="form-group hidden" id="working_experience_5">
                  @endif
                      <label for="working_experience_5">&nbsp;<br>Description</label>
                      <input name="working_experience_5" type="text" class="@error('working_experience_5') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_5_input">
                      @error('working_experience_5')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_6'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_6">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_6">
                  @endif
                      <label for="working_experience_begin_year_6">Working Experience #6<br>From</label>
                      <select name="working_experience_begin_year_6" type="text" class="@error('working_experience_begin_year_6') is-invalid @enderror form-control" id="working_experience_begin_year_6_input" onChange="if(document.getElementById('working_experience_begin_year_6_input').value != '') {document.getElementById('working_experience_end_year_6').className = 'form-group'; document.getElementById('working_experience_6').className = 'form-group'; document.getElementById('working_experience_begin_year_7').className = 'form-group';} else {document.getElementById('working_experience_end_year_6').className = 'form-group hidden'; document.getElementById('working_experience_6').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_7_input').value = ''; document.getElementById('working_experience_end_year_7_input').value = ''; document.getElementById('working_experience_7_input').value = ''; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_6')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_6'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_6">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_6">
                  @endif
                      <label for="working_experience_end_year_6">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_6" type="text" class="@error('working_experience_end_year_6') is-invalid @enderror form-control" id="working_experience_end_year_6_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_6')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_6'))
                    <div class="form-group hidden has-error" id="working_experience_6">
                  @else
                    <div class="form-group hidden" id="working_experience_6">
                  @endif
                      <label for="working_experience_6">&nbsp;<br>Description</label>
                      <input name="working_experience_6" type="text" class="@error('working_experience_6') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_6_input">
                      @error('working_experience_6')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_7'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_7">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_7">
                  @endif
                      <label for="working_experience_begin_year_7">Working Experience #7<br>From</label>
                      <select name="working_experience_begin_year_7" type="text" class="@error('working_experience_begin_year_7') is-invalid @enderror form-control" id="working_experience_begin_year_7_input" onChange="if(document.getElementById('working_experience_begin_year_7_input').value != '') {document.getElementById('working_experience_end_year_7').className = 'form-group'; document.getElementById('working_experience_7').className = 'form-group'; document.getElementById('working_experience_begin_year_8').className = 'form-group';} else {document.getElementById('working_experience_end_year_7').className = 'form-group hidden'; document.getElementById('working_experience_7').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_8_input').value = ''; document.getElementById('working_experience_end_year_8_input').value = ''; document.getElementById('working_experience_8_input').value = ''; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_7')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_7'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_7">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_7">
                  @endif
                      <label for="working_experience_end_year_7">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_7" type="text" class="@error('working_experience_end_year_7') is-invalid @enderror form-control" id="working_experience_end_year_7_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_7')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_7'))
                    <div class="form-group hidden has-error" id="working_experience_7">
                  @else
                    <div class="form-group hidden" id="working_experience_7">
                  @endif
                      <label for="working_experience_7">&nbsp;<br>Description</label>
                      <input name="working_experience_7" type="text" class="@error('working_experience_7') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_7_input">
                      @error('working_experience_7')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_8'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_8">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_8">
                  @endif
                      <label for="working_experience_begin_year_8">Working Experience #8<br>From</label>
                      <select name="working_experience_begin_year_8" type="text" class="@error('working_experience_begin_year_8') is-invalid @enderror form-control" id="working_experience_begin_year_8_input" onChange="if(document.getElementById('working_experience_begin_year_8_input').value != '') {document.getElementById('working_experience_end_year_8').className = 'form-group'; document.getElementById('working_experience_8').className = 'form-group'; document.getElementById('working_experience_begin_year_9').className = 'form-group';} else {document.getElementById('working_experience_end_year_8').className = 'form-group hidden'; document.getElementById('working_experience_8').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_9_input').value = ''; document.getElementById('working_experience_end_year_9_input').value = ''; document.getElementById('working_experience_9_input').value = ''; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_8')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_8'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_8">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_8">
                  @endif
                      <label for="working_experience_end_year_8">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_8" type="text" class="@error('working_experience_end_year_8') is-invalid @enderror form-control" id="working_experience_end_year_8_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_8')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_8'))
                    <div class="form-group hidden has-error" id="working_experience_8">
                  @else
                    <div class="form-group hidden" id="working_experience_8">
                  @endif
                      <label for="working_experience_8">&nbsp;<br>Description</label>
                      <input name="working_experience_8" type="text" class="@error('working_experience_8') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_8_input">
                      @error('working_experience_8')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_9'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_9">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_9">
                  @endif
                      <label for="working_experience_begin_year_9">Working Experience #9<br>From</label>
                      <select name="working_experience_begin_year_9" type="text" class="@error('working_experience_begin_year_9') is-invalid @enderror form-control" id="working_experience_begin_year_9_input" onChange="if(document.getElementById('working_experience_begin_year_9_input').value != '') {document.getElementById('working_experience_end_year_9').className = 'form-group'; document.getElementById('working_experience_9').className = 'form-group'; document.getElementById('working_experience_begin_year_10').className = 'form-group';} else {document.getElementById('working_experience_end_year_9').className = 'form-group hidden'; document.getElementById('working_experience_9').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden'; document.getElementById('working_experience_begin_year_10_input').value = ''; document.getElementById('working_experience_end_year_10_input').value = ''; document.getElementById('working_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_9')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_9'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_9">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_9">
                  @endif
                      <label for="working_experience_end_year_9">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_9" type="text" class="@error('working_experience_end_year_9') is-invalid @enderror form-control" id="working_experience_end_year_9_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_9')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_9'))
                    <div class="form-group hidden has-error" id="working_experience_9">
                  @else
                    <div class="form-group hidden" id="working_experience_9">
                  @endif
                      <label for="working_experience_9">&nbsp;<br>Description</label>
                      <input name="working_experience_9" type="text" class="@error('working_experience_9') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_9_input">
                      @error('working_experience_9')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_begin_year_10'))
                    <div class="form-group hidden has-error" id="working_experience_begin_year_10">
                  @else
                    <div class="form-group hidden" id="working_experience_begin_year_10">
                  @endif
                      <label for="working_experience_begin_year_10">Working Experience #10<br>From</label>
                      <select name="working_experience_begin_year_10" type="text" class="@error('working_experience_begin_year_10') is-invalid @enderror form-control" id="working_experience_begin_year_10_input" onChange="if(document.getElementById('working_experience_begin_year_10_input').value != '') {document.getElementById('working_experience_end_year_10').className = 'form-group'; document.getElementById('working_experience_10').className = 'form-group';} else {document.getElementById('working_experience_end_year_10').className = 'form-group hidden'; document.getElementById('working_experience_10').className = 'form-group hidden';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_begin_year_10')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('working_experience_end_year_10'))
                    <div class="form-group hidden has-error" id="working_experience_end_year_10">
                  @else
                    <div class="form-group hidden" id="working_experience_end_year_10">
                  @endif
                      <label for="working_experience_end_year_10">&nbsp;<br>To (optional)</label>
                      <select name="working_experience_end_year_10" type="text" class="@error('working_experience_end_year_10') is-invalid @enderror form-control" id="working_experience_end_year_10_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('working_experience_end_year_10')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('working_experience_10'))
                    <div class="form-group hidden has-error" id="working_experience_10">
                  @else
                    <div class="form-group hidden" id="working_experience_10">
                  @endif
                      <label for="working_experience_10">&nbsp;<br>Description</label>
                      <input name="working_experience_10" type="text" class="@error('working_experience_10') is-invalid @enderror form-control" placeholder="Enter Working Experience" id="working_experience_10_input">
                      @error('working_experience_10')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_1'))
                    <div class="form-group has-error" id="educational_experience_begin_year_1">
                  @else
                    <div class="form-group" id="educational_experience_begin_year_1">
                  @endif
                      <label for="educational_experience_begin_year_1">Educational Record #1<br>From</label>
                      <select name="educational_experience_begin_year_1" type="text" class="@error('educational_experience_begin_year_1') is-invalid @enderror form-control" id="educational_experience_begin_year_1_input" onChange="if(document.getElementById('educational_experience_begin_year_1_input').value != '') {document.getElementById('educational_experience_end_year_1').className = 'form-group'; document.getElementById('educational_experience_1').className = 'form-group'; document.getElementById('educational_experience_begin_year_2').className = 'form-group';} else {document.getElementById('educational_experience_end_year_1').className = 'form-group hidden'; document.getElementById('educational_experience_1').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_2').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_2').className = 'form-group hidden'; document.getElementById('educational_experience_2').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_2_input').value = ''; document.getElementById('educational_experience_end_year_2_input').value = ''; document.getElementById('educational_experience_2_input').value = ''; document.getElementById('educational_experience_begin_year_3').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_3').className = 'form-group hidden'; document.getElementById('educational_experience_3').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_3_input').value = ''; document.getElementById('educational_experience_end_year_3_input').value = ''; document.getElementById('educational_experience_3_input').value = ''; document.getElementById('educational_experience_begin_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_4').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_4_input').value = ''; document.getElementById('educational_experience_end_year_4_input').value = ''; document.getElementById('educational_experience_4_input').value = ''; document.getElementById('educational_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_5').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_5_input').value = ''; document.getElementById('educational_experience_end_year_5_input').value = ''; document.getElementById('educational_experience_5_input').value = ''; document.getElementById('educational_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_6').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_6_input').value = ''; document.getElementById('educational_experience_end_year_6_input').value = ''; document.getElementById('educational_experience_6_input').value = ''; document.getElementById('educational_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7_input').value = ''; document.getElementById('educational_experience_end_year_7_input').value = ''; document.getElementById('educational_experience_7_input').value = ''; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_1')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_1'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_1">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_1">
                  @endif
                      <label for="educational_experience_end_year_1">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_1" type="text" class="@error('educational_experience_end_year_1') is-invalid @enderror form-control" id="educational_experience_end_year_1_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_1')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_1'))
                    <div class="form-group hidden has-error" id="educational_experience_1">
                  @else
                    <div class="form-group hidden" id="educational_experience_1">
                  @endif
                      <label for="educational_experience_1">&nbsp;<br>Description</label>
                      <input name="educational_experience_1" type="text" class="@error('educational_experience_1') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_1_input">
                      @error('educational_experience_1')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_2'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_2">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_2">
                  @endif
                      <label for="educational_experience_begin_year_2">Educational Record #2<br>From</label>
                      <select name="educational_experience_begin_year_2" type="text" class="@error('educational_experience_begin_year_2') is-invalid @enderror form-control" id="educational_experience_begin_year_2_input" onChange="if(document.getElementById('educational_experience_begin_year_2_input').value != '') {document.getElementById('educational_experience_end_year_2').className = 'form-group'; document.getElementById('educational_experience_2').className = 'form-group'; document.getElementById('educational_experience_begin_year_3').className = 'form-group';} else {document.getElementById('educational_experience_end_year_2').className = 'form-group hidden'; document.getElementById('educational_experience_2').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_3').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_3').className = 'form-group hidden'; document.getElementById('educational_experience_3').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_3_input').value = ''; document.getElementById('educational_experience_end_year_3_input').value = ''; document.getElementById('educational_experience_3_input').value = ''; document.getElementById('educational_experience_begin_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_4').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_4_input').value = ''; document.getElementById('educational_experience_end_year_4_input').value = ''; document.getElementById('educational_experience_4_input').value = ''; document.getElementById('educational_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_5').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_5_input').value = ''; document.getElementById('educational_experience_end_year_5_input').value = ''; document.getElementById('educational_experience_5_input').value = ''; document.getElementById('educational_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_6').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_6_input').value = ''; document.getElementById('educational_experience_end_year_6_input').value = ''; document.getElementById('educational_experience_6_input').value = ''; document.getElementById('educational_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7_input').value = ''; document.getElementById('educational_experience_end_year_7_input').value = ''; document.getElementById('educational_experience_7_input').value = ''; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_2')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_2'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_2">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_2">
                  @endif
                      <label for="educational_experience_end_year_2">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_2" type="text" class="@error('educational_experience_end_year_2') is-invalid @enderror form-control" id="educational_experience_end_year_2_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_2')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_2'))
                    <div class="form-group hidden has-error" id="educational_experience_2">
                  @else
                    <div class="form-group hidden" id="educational_experience_2">
                  @endif
                      <label for="educational_experience_2">&nbsp;<br>Description</label>
                      <input name="educational_experience_2" type="text" class="@error('educational_experience_2') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_2_input">
                      @error('educational_experience_2')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_3'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_3">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_3">
                  @endif
                      <label for="educational_experience_begin_year_3">Educational Record #3<br>From</label>
                      <select name="educational_experience_begin_year_3" type="text" class="@error('educational_experience_begin_year_3') is-invalid @enderror form-control" id="educational_experience_begin_year_3_input" onChange="if(document.getElementById('educational_experience_begin_year_3_input').value != '') {document.getElementById('educational_experience_end_year_3').className = 'form-group'; document.getElementById('educational_experience_3').className = 'form-group'; document.getElementById('educational_experience_begin_year_4').className = 'form-group';} else {document.getElementById('educational_experience_end_year_3').className = 'form-group hidden'; document.getElementById('educational_experience_3').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_4').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_4_input').value = ''; document.getElementById('educational_experience_end_year_4_input').value = ''; document.getElementById('educational_experience_4_input').value = ''; document.getElementById('educational_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_5').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_5_input').value = ''; document.getElementById('educational_experience_end_year_5_input').value = ''; document.getElementById('educational_experience_5_input').value = ''; document.getElementById('educational_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_6').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_6_input').value = ''; document.getElementById('educational_experience_end_year_6_input').value = ''; document.getElementById('educational_experience_6_input').value = ''; document.getElementById('educational_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7_input').value = ''; document.getElementById('educational_experience_end_year_7_input').value = ''; document.getElementById('educational_experience_7_input').value = ''; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_3')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_3'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_3">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_3">
                  @endif
                      <label for="educational_experience_end_year_3">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_3" type="text" class="@error('educational_experience_end_year_3') is-invalid @enderror form-control" id="educational_experience_end_year_3_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_3')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_3'))
                    <div class="form-group hidden has-error" id="educational_experience_3">
                  @else
                    <div class="form-group hidden" id="educational_experience_3">
                  @endif
                      <label for="educational_experience_3">&nbsp;<br>Description</label>
                      <input name="educational_experience_3" type="text" class="@error('educational_experience_3') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_3_input">
                      @error('educational_experience_3')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_4'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_4">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_4">
                  @endif
                      <label for="educational_experience_begin_year_4">Educational Record #4<br>From</label>
                      <select name="educational_experience_begin_year_4" type="text" class="@error('educational_experience_begin_year_4') is-invalid @enderror form-control" id="educational_experience_begin_year_4_input" onChange="if(document.getElementById('educational_experience_begin_year_4_input').value != '') {document.getElementById('educational_experience_end_year_4').className = 'form-group'; document.getElementById('educational_experience_4').className = 'form-group'; document.getElementById('educational_experience_begin_year_5').className = 'form-group';} else {document.getElementById('educational_experience_end_year_4').className = 'form-group hidden'; document.getElementById('educational_experience_4').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_5').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_5_input').value = ''; document.getElementById('educational_experience_end_year_5_input').value = ''; document.getElementById('educational_experience_5_input').value = ''; document.getElementById('educational_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_6').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_6_input').value = ''; document.getElementById('educational_experience_end_year_6_input').value = ''; document.getElementById('educational_experience_6_input').value = ''; document.getElementById('educational_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7_input').value = ''; document.getElementById('educational_experience_end_year_7_input').value = ''; document.getElementById('educational_experience_7_input').value = ''; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_4')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_4'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_4">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_4">
                  @endif
                      <label for="educational_experience_end_year_4">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_4" type="text" class="@error('educational_experience_end_year_4') is-invalid @enderror form-control" id="educational_experience_end_year_4_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_4')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_4'))
                    <div class="form-group hidden has-error" id="educational_experience_4">
                  @else
                    <div class="form-group hidden" id="educational_experience_4">
                  @endif
                      <label for="educational_experience_4">&nbsp;<br>Description</label>
                      <input name="educational_experience_4" type="text" class="@error('educational_experience_4') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_4_input">
                      @error('educational_experience_4')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_5'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_5">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_5">
                  @endif
                      <label for="educational_experience_begin_year_5">Educational Record #5<br>From</label>
                      <select name="educational_experience_begin_year_5" type="text" class="@error('educational_experience_begin_year_5') is-invalid @enderror form-control" id="educational_experience_begin_year_5_input" onChange="if(document.getElementById('educational_experience_begin_year_5_input').value != '') {document.getElementById('educational_experience_end_year_5').className = 'form-group'; document.getElementById('educational_experience_5').className = 'form-group'; document.getElementById('educational_experience_begin_year_6').className = 'form-group';} else {document.getElementById('educational_experience_end_year_5').className = 'form-group hidden'; document.getElementById('educational_experience_5').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_6').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_6_input').value = ''; document.getElementById('educational_experience_end_year_6_input').value = ''; document.getElementById('educational_experience_6_input').value = ''; document.getElementById('educational_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7_input').value = ''; document.getElementById('educational_experience_end_year_7_input').value = ''; document.getElementById('educational_experience_7_input').value = ''; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_5')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_5'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_5">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_5">
                  @endif
                      <label for="educational_experience_end_year_5">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_5" type="text" class="@error('educational_experience_end_year_5') is-invalid @enderror form-control" id="educational_experience_end_year_5_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_5')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_5'))
                    <div class="form-group hidden has-error" id="educational_experience_5">
                  @else
                    <div class="form-group hidden" id="educational_experience_5">
                  @endif
                      <label for="educational_experience_5">&nbsp;<br>Description</label>
                      <input name="educational_experience_5" type="text" class="@error('educational_experience_5') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_5_input">
                      @error('educational_experience_5')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_6'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_6">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_6">
                  @endif
                      <label for="educational_experience_begin_year_6">Educational Record #6<br>From</label>
                      <select name="educational_experience_begin_year_6" type="text" class="@error('educational_experience_begin_year_6') is-invalid @enderror form-control" id="educational_experience_begin_year_6_input" onChange="if(document.getElementById('educational_experience_begin_year_6_input').value != '') {document.getElementById('educational_experience_end_year_6').className = 'form-group'; document.getElementById('educational_experience_6').className = 'form-group'; document.getElementById('educational_experience_begin_year_7').className = 'form-group';} else {document.getElementById('educational_experience_end_year_6').className = 'form-group hidden'; document.getElementById('educational_experience_6').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_7_input').value = ''; document.getElementById('educational_experience_end_year_7_input').value = ''; document.getElementById('educational_experience_7_input').value = ''; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_6')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_6'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_6">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_6">
                  @endif
                      <label for="educational_experience_end_year_6">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_6" type="text" class="@error('educational_experience_end_year_6') is-invalid @enderror form-control" id="educational_experience_end_year_6_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_6')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_6'))
                    <div class="form-group hidden has-error" id="educational_experience_6">
                  @else
                    <div class="form-group hidden" id="educational_experience_6">
                  @endif
                      <label for="educational_experience_6">&nbsp;<br>Description</label>
                      <input name="educational_experience_6" type="text" class="@error('educational_experience_6') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_6_input">
                      @error('educational_experience_6')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_7'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_7">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_7">
                  @endif
                      <label for="educational_experience_begin_year_7">Educational Record #7<br>From</label>
                      <select name="educational_experience_begin_year_7" type="text" class="@error('educational_experience_begin_year_7') is-invalid @enderror form-control" id="educational_experience_begin_year_7_input" onChange="if(document.getElementById('educational_experience_begin_year_7_input').value != '') {document.getElementById('educational_experience_end_year_7').className = 'form-group'; document.getElementById('educational_experience_7').className = 'form-group'; document.getElementById('educational_experience_begin_year_8').className = 'form-group';} else {document.getElementById('educational_experience_end_year_7').className = 'form-group hidden'; document.getElementById('educational_experience_7').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_8_input').value = ''; document.getElementById('educational_experience_end_year_8_input').value = ''; document.getElementById('educational_experience_8_input').value = ''; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_7')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_7'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_7">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_7">
                  @endif
                      <label for="educational_experience_end_year_7">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_7" type="text" class="@error('educational_experience_end_year_7') is-invalid @enderror form-control" id="educational_experience_end_year_7_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_7')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_7'))
                    <div class="form-group hidden has-error" id="educational_experience_7">
                  @else
                    <div class="form-group hidden" id="educational_experience_7">
                  @endif
                      <label for="educational_experience_7">&nbsp;<br>Description</label>
                      <input name="educational_experience_7" type="text" class="@error('educational_experience_7') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_7_input">
                      @error('educational_experience_7')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_8'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_8">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_8">
                  @endif
                      <label for="educational_experience_begin_year_8">Educational Record #8<br>From</label>
                      <select name="educational_experience_begin_year_8" type="text" class="@error('educational_experience_begin_year_8') is-invalid @enderror form-control" id="educational_experience_begin_year_8_input" onChange="if(document.getElementById('educational_experience_begin_year_8_input').value != '') {document.getElementById('educational_experience_end_year_8').className = 'form-group'; document.getElementById('educational_experience_8').className = 'form-group'; document.getElementById('educational_experience_begin_year_9').className = 'form-group';} else {document.getElementById('educational_experience_end_year_8').className = 'form-group hidden'; document.getElementById('educational_experience_8').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_9_input').value = ''; document.getElementById('educational_experience_end_year_9_input').value = ''; document.getElementById('educational_experience_9_input').value = ''; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_8')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_8'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_8">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_8">
                  @endif
                      <label for="educational_experience_end_year_8">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_8" type="text" class="@error('educational_experience_end_year_8') is-invalid @enderror form-control" id="educational_experience_end_year_8_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_8')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_8'))
                    <div class="form-group hidden has-error" id="educational_experience_8">
                  @else
                    <div class="form-group hidden" id="educational_experience_8">
                  @endif
                      <label for="educational_experience_8">&nbsp;<br>Description</label>
                      <input name="educational_experience_8" type="text" class="@error('educational_experience_8') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_8_input">
                      @error('educational_experience_8')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_9'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_9">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_9">
                  @endif
                      <label for="educational_experience_begin_year_9">Educational Record #9<br>From</label>
                      <select name="educational_experience_begin_year_9" type="text" class="@error('educational_experience_begin_year_9') is-invalid @enderror form-control" id="educational_experience_begin_year_9_input" onChange="if(document.getElementById('educational_experience_begin_year_9_input').value != '') {document.getElementById('educational_experience_end_year_9').className = 'form-group'; document.getElementById('educational_experience_9').className = 'form-group'; document.getElementById('educational_experience_begin_year_10').className = 'form-group';} else {document.getElementById('educational_experience_end_year_9').className = 'form-group hidden'; document.getElementById('educational_experience_9').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden'; document.getElementById('educational_experience_begin_year_10_input').value = ''; document.getElementById('educational_experience_end_year_10_input').value = ''; document.getElementById('educational_experience_10_input').value = '';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_9')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_9'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_9">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_9">
                  @endif
                      <label for="educational_experience_end_year_9">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_9" type="text" class="@error('educational_experience_end_year_9') is-invalid @enderror form-control" id="educational_experience_end_year_9_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_9')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_9'))
                    <div class="form-group hidden has-error" id="educational_experience_9">
                  @else
                    <div class="form-group hidden" id="educational_experience_9">
                  @endif
                      <label for="educational_experience_9">&nbsp;<br>Description</label>
                      <input name="educational_experience_9" type="text" class="@error('educational_experience_9') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_9_input">
                      @error('educational_experience_9')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_begin_year_10'))
                    <div class="form-group hidden has-error" id="educational_experience_begin_year_10">
                  @else
                    <div class="form-group hidden" id="educational_experience_begin_year_10">
                  @endif
                      <label for="educational_experience_begin_year_10">Educational Record #10<br>From</label>
                      <select name="educational_experience_begin_year_10" type="text" class="@error('educational_experience_begin_year_10') is-invalid @enderror form-control" id="educational_experience_begin_year_10_input" onChange="if(document.getElementById('educational_experience_begin_year_10_input').value != '') {document.getElementById('educational_experience_end_year_10').className = 'form-group'; document.getElementById('educational_experience_10').className = 'form-group';} else {document.getElementById('educational_experience_end_year_10').className = 'form-group hidden'; document.getElementById('educational_experience_10').className = 'form-group hidden';}">
                        <option selected="selected" value="">-- From --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_begin_year_10')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-2">
                  @if ($errors->get('educational_experience_end_year_10'))
                    <div class="form-group hidden has-error" id="educational_experience_end_year_10">
                  @else
                    <div class="form-group hidden" id="educational_experience_end_year_10">
                  @endif
                      <label for="educational_experience_end_year_10">&nbsp;<br>To (optional)</label>
                      <select name="educational_experience_end_year_10" type="text" class="@error('educational_experience_end_year_10') is-invalid @enderror form-control" id="educational_experience_end_year_10_input">
                        <option selected="selected" value="">-- To --</option>
                        @for($i = date('Y'), $j = 0; $j < 80; $i = $i - 1, $j = $j + 1 )
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      @error('educational_experience_end_year_10')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-8">
                  @if ($errors->get('educational_experience_10'))
                    <div class="form-group hidden has-error" id="educational_experience_10">
                  @else
                    <div class="form-group hidden" id="educational_experience_10">
                  @endif
                      <label for="educational_experience_10">&nbsp;<br>Description</label>
                      <input name="educational_experience_10" type="text" class="@error('educational_experience_10') is-invalid @enderror form-control" placeholder="Enter Educational Record" id="educational_experience_10_input">
                      @error('educational_experience_10')
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
