@extends('layouts.admin.default')
@section('title','Student Show')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Student</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('students.index') }}">Student</a></li>
    <li class="active">Show</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="{{ route('students.edit', $data->id) }}" class="btn btn-flat btn-sm btn-primary">Edit Information</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <!--thead>
              <th>Profile Image</th>
              <th>Information</th>
            </thead-->
            <tbody>
              <tr>
                <td align="center">
                  @if($data->user->image_profile)
                    <img src="{{ asset('uploads/user.jpg') }}" style="width: 200px">
                  @else
                    <i>No Profile Picture</i>
                  @endif
                </td>
                <td>
                  <table>
                    <tbody valign="top">
                      <tr>
                        <td><b>Name</b></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          {{ $data->user->first_name }} {{ $data->user->last_name }}
                        </td>
                      </tr>
                      <tr>
                        <td><b>Age</b></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          @if($data->age)
                            {{ $data->age }}
                          @else
                            <i>Not Available</i>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td><b>Job Status</b></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          {{ $data->status_job }}
                        </td>
                      </tr>
                      <tr>
                        @if($data->status_job == 'Student')
                          <td><b>School / University Name</b></td>
                        @elseif($data->status_job == 'Professional')
                          <td><b>Working Place</b></td>
                        @endif
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        @if($data->status_description)
                          <td>
                            {{ $data->status_description }}
                          </td>
                        @else
                          <td><i>Not Available</i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>
                          <b>Interest</b><br>
                          @if($data->interest)
                            <?php
                              $interest = explode(', ', $data->interest);
                            ?>
                            @for($i = 0; $i < count($interest); $i = $i + 1)
                              {{ $i + 1 }}. {{ $interest[$i] }}
                              @if($i + 1 != count($interest))
                                <br>
                              @endif
                            @endfor
                          @endif
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          @if($data->interest == null)
                            <i>Not Available</i>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td><b>Indonesian Language Experience</b></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          @if($data->target_language_experience != 'Others')
                            {{ $data->target_language_experience }}
                          @else
                            {{ $data->target_language_experience_value }}
                            @if($data->target_language_experience_value == 1)
                              year
                            @else
                              years
                            @endif
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <b>Indonesian Language Experience (Text)</b><br>
                          @if($data->target_language_experience != 'Never (no experience)')
                            {{ $data->description_of_course_taken }}
                          @endif
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          @if($data->target_language_experience == 'Never (no experience)')
                            <i>Not Available</i>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td><b>Indonesian Language Proficiency</b></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          {{ $data->indonesian_language_proficiency }}
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <b>Learning Objective (Text)</b><br>
                          @if($data->learning_objective)
                            {{ $data->learning_objective }}
                          @endif
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          @if($data->learning_objective == null)
                            <i>Not Available</i>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td><b>Registration Time</b></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          @if($data->created_at)
                            {{ $data->created_at }} GMT+0
                          @else
                            <i>Not Available</i>
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>	
      </div>
    </div>
  </div>
@stop