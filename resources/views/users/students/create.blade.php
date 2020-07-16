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
                @if ($errors->get('phone'))
                  <div class="form-group has-error">
                @else
                  <div class="form-group">
                @endif
                    <label for="phone">Phone Number</label>
                    <input name="phone" type="text" class="@error('phone') is-invalid @enderror form-control" placeholder="Enter Phone Number">
                    @error('phone')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
              </div>
              <div class="col-md-6">
                @if ($errors->get('gender'))
                  <div class="form-group has-error">
                @else
                  <div class="form-group">
                @endif
                    <label for="gender">Gender</label>
                    <select name="gender" type="text" class="@error('gender') is-invalid @enderror form-control">
                      <option selected="selected" value="">-- Enter Gender --</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    @error('gender')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
                @if ($errors->get('birthdate'))
                  <div class="form-group has-error">
                @else
                  <div class="form-group">
                @endif
                    <label for="birthdate">Birth Date</label>
                    <input name="birthdate" type="date" class="@error('birthdate') is-invalid @enderror form-control" placeholder="Enter Birth Date">
                    @error('birthdate')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
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
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
