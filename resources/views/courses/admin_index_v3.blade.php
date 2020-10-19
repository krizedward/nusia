@extends('layouts.admin.default')

@section('title', 'Admin | Course')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Course</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Course</li>
  </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#metadata" data-toggle="tab"><b>Metadata</b></a></li>
          <li><a href="#all_courses" data-toggle="tab"><b>All Courses</b></a></li>
          <li><a href="#filter_material_type" data-toggle="tab"><b>Filter: Material Type</b></a></li>
          <li><a href="#filter_course_type" data-toggle="tab"><b>Filter: Course Type</b></a></li>
          <li><a href="#filter_proficiency_level" data-toggle="tab"><b>Filter: Proficiency Level</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="metadata">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr-->
                    </div>
                  </form>
                </div>
                <div class="box box-primary collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Add Material Type</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <dl>
                      <dt><i class="fa fa-pencil-square-o margin-r-5"></i> Form</dt>
                      <dd>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('material_types.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12 no-padding">
                                  <div class="form-group @error('name') has-error @enderror">
                                    <label for="name">Name</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="box box-primary collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Add Course Type</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <dl>
                      <dt><i class="fa fa-pencil-square-o margin-r-5"></i> Form</dt>
                      <dd>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('course_types.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12 no-padding">
                                  <div class="form-group @error('name') has-error @enderror">
                                    <label for="name">Name</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('count_student_min') has-error @enderror">
                                    <label for="count_student_min">Student Minimum Quota</label>
                                    <input name="count_student_min" value="{{ old('count_student_min') }}" type="number" min="1" max="100" class="@error('count_student_min') is-invalid @enderror form-control" placeholder="Enter Student Minimum Quota">
                                    @error('count_student_min')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('count_student_max') has-error @enderror">
                                    <label for="count_student_max">Student Maximum Quota</label>
                                    <input name="count_student_max" value="{{ old('count_student_max') }}" type="number" min="1" max="100" class="@error('count_student_max') is-invalid @enderror form-control" placeholder="Enter Student Maximum Quota">
                                    @error('count_student_max')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="box box-primary collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Add Proficiency Level</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <dl>
                      <dt><i class="fa fa-pencil-square-o margin-r-5"></i> Form</dt>
                      <dd>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('course_levels.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12 no-padding">
                                  <div class="form-group @error('name') has-error @enderror">
                                    <label for="name">Name</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('assignment_score_min') has-error @enderror">
                                    <label for="assignment_score_min">Assignment Passing Score</label>
                                    <input name="assignment_score_min" value="{{ old('assignment_score_min') }}" type="text" class="@error('assignment_score_min') is-invalid @enderror form-control" placeholder="Enter Assignment Passing Score">
                                    @error('assignment_score_min')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('mid_exam_score_min') has-error @enderror">
                                    <label for="mid_exam_score_min">Mid-Exam Passing Score</label>
                                    <input name="mid_exam_score_min" value="{{ old('mid_exam_score_min') }}" type="text" class="@error('mid_exam_score_min') is-invalid @enderror form-control" placeholder="Enter Mid-Exam Passing Score">
                                    @error('mid_exam_score_min')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('final_exam_score_min') has-error @enderror">
                                    <label for="final_exam_score_min">Final-Exam Passing Score</label>
                                    <input name="final_exam_score_min" value="{{ old('final_exam_score_min') }}" type="text" class="@error('final_exam_score_min') is-invalid @enderror form-control" placeholder="Enter Final-Exam Passing Score">
                                    @error('final_exam_score_min')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="box box-primary collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>Add Course Package</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <dl>
                      <dt><i class="fa fa-pencil-square-o margin-r-5"></i> Form</dt>
                      <dd>
                        <div class="box-body">
                          <form role="form" method="post" action="{{ route('course_packages.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-12 no-padding">
                                  <div class="form-group @error('name') has-error @enderror">
                                    <label for="name">Name</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('count_session') has-error @enderror">
                                    <label for="count_session">Number of Session(s)</label>
                                    <input name="count_session" value="{{ old('count_session') }}" type="text" class="@error('count_session') is-invalid @enderror form-control" placeholder="Enter Number of Session(s)">
                                    @error('count_session')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                  <div class="form-group @error('price') has-error @enderror">
                                    <label for="price">Price in USD$</label>
                                    <input name="price" value="{{ old('price') }}" type="text" class="@error('price') is-invalid @enderror form-control" placeholder="Enter Price in USD$">
                                    @error('price')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                            </div>
                          </form>
                        </div>
                      </dd>
                    </dl>
                  </div>
                </div>
              </div>
              <div class="col-md-9 no-padding">
                <div class="col-md-4">
                  <!-- Material Types -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>{{ $material_type->count() }}</h3>
                      <p>
                        @if($material_type->count() != 1)
                          Material Types
                        @else
                          Material Type
                        @endif
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Course Types -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>{{ $course_type->count() }}</h3>
                      <p>
                        @if($course_type->count() != 1)
                          Course Types
                        @else
                          Course Type
                        @endif
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Proficiency Levels (Course Levels) -->
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>{{ $course_level->count() }}</h3>
                      <p>
                        @if($course_level->count() != 1)
                          Proficiency Levels
                        @else
                          Proficiency Level
                        @endif
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="box box-solid">
                    <div class="box-body">
                      <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-warning">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                List of Material Type(s)
                              </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                              @if($material_type->toArray())
                                <table class="table table-bordered">
                                  <tr>
                                    <th class="text-right" style="width:40px;">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <!--th style="width:40px;">Detail</th-->
                                  </tr>
                                  @foreach($material_type as $i => $dt)
                                    <tr>
                                      <td class="text-right">{{ $i + 1 }}</td>
                                      <td>{{ $dt->name }}</td>
                                      <td>{{ $dt->description }}</td>
                                      <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                                    </tr>
                                  @endforeach
                                </table>
                                <div class="box-header">
                                  <h4>Edit Material Type Information</h4>
                                </div>
                                <div class="box-body">
                                  <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('id') has-error @enderror">
                                              <label for="id">Material Type Number</label>
                                              <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Material Type Number --</option>
                                                @foreach($material_type as $i => $mt)
                                                  @if(old('id') == Str::slug($mt->created_at.$mt->name.$mt->updated_at))
                                                    <option selected="selected" value="{{ Str::slug($mt->created_at.$mt->name.$mt->updated_at) }}">#{{ $i + 1 }} - {{ $mt->name }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($mt->created_at.$mt->name.$mt->updated_at) }}">#{{ $i + 1 }} - {{ $mt->name }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('name') has-error @enderror">
                                              <label for="name">Change Name (optional)</label>
                                              <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name (optional)">
                                              @error('name')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('description') has-error @enderror">
                                              <label for="description">Change Description (optional)</label>
                                              <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description (optional)">{{ old('description') }}</textarea>
                                              @error('description')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                                    </div>
                                  </form>
                                </div>
                              @else
                                <div class="text-center">No data available.</div>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="panel box box-danger">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                List of Course Type(s)
                              </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                              @if($course_type->toArray())
                                <table class="table table-bordered">
                                  <tr>
                                    <th class="text-right" style="width:40px;">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Student Quota</th>
                                    <!--th style="width:40px;">Detail</th-->
                                  </tr>
                                  @foreach($course_type as $i => $dt)
                                    <tr>
                                      <td class="text-right">{{ $i + 1 }}</td>
                                      <td>{{ $dt->name }}</td>
                                      <td>{{ $dt->description }}</td>
                                      <td class="text-right">
                                        @if($dt->count_student_min != $dt->count_student_max)
                                          {{ $dt->count_student_min }}-{{ $dt->count_student_max }}
                                        @else
                                          {{ $dt->count_student_min }}
                                        @endif
                                      </td>
                                      <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                                    </tr>
                                  @endforeach
                                </table>
                                <div class="box-header">
                                  <h4>Edit Course Type Information</h4>
                                </div>
                                <div class="box-body">
                                  <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('id') has-error @enderror">
                                              <label for="id">Course Type Number</label>
                                              <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Course Type Number --</option>
                                                @foreach($course_type as $i => $ct)
                                                  @if(old('id') == Str::slug($ct->created_at.$ct->name.$ct->updated_at))
                                                    <option selected="selected" value="{{ Str::slug($ct->created_at.$ct->name.$ct->updated_at) }}">#{{ $i + 1 }} - {{ $ct->name }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($ct->created_at.$ct->name.$ct->updated_at) }}">#{{ $i + 1 }} - {{ $ct->name }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('name') has-error @enderror">
                                              <label for="name">Change Name (optional)</label>
                                              <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name (optional)">
                                              @error('name')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('description') has-error @enderror">
                                              <label for="description">Change Description (optional)</label>
                                              <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description (optional)">{{ old('description') }}</textarea>
                                              @error('description')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('count_student_min') has-error @enderror">
                                              <label for="count_student_min">Change Student Minimum Quota (optional)</label>
                                              <input name="count_student_min" value="{{ old('count_student_min') }}" type="text" class="@error('count_student_min') is-invalid @enderror form-control" placeholder="Enter Student Minimum Quota (optional)">
                                              @error('count_student_min')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('count_student_max') has-error @enderror">
                                              <label for="count_student_max">Change Student Maximum Quota (optional)</label>
                                              <input name="count_student_max" value="{{ old('count_student_max') }}" type="text" class="@error('count_student_max') is-invalid @enderror form-control" placeholder="Enter Student Maximum Quota (optional)">
                                              @error('count_student_max')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                                    </div>
                                  </form>
                                </div>
                              @else
                                <div class="text-center">No data available.</div>
                              @endif
                            </div>
                            <!-- End -->
                          </div>
                        </div>
                        <div class="panel box box-success">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                List of Proficiency Level(s)
                              </a>
                            </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse">
                            <div class="box-body">
                              @if($course_level->toArray())
                                <table class="table table-bordered">
                                  <tr>
                                    <th class="text-right" style="width:40px;">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="width:90px;">Assignment Passing Score</th>
                                    <th style="width:90px;">Mid-Exam Passing Score</th>
                                    <th style="width:90px;">Final-Exam Passing Score</th>
                                    <!--th style="width:40px;">Detail</th-->
                                  </tr>
                                  @foreach($course_level as $i => $dt)
                                    <tr>
                                      <td class="text-right">{{ $i + 1 }}</td>
                                      <td>{{ $dt->name }}</td>
                                      <td>{{ $dt->description }}</td>
                                      <td>{{ $dt->assignment_score_min }}</td>
                                      <td>{{ $dt->mid_exam_score_min }}</td>
                                      <td>{{ $dt->final_exam_score_min }}</td>
                                      <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                                    </tr>
                                  @endforeach
                                </table>
                                <div class="box-header">
                                  <h4>Edit Proficiency Level Information</h4>
                                </div>
                                <div class="box-body">
                                  <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('id') has-error @enderror">
                                              <label for="id">Proficiency Level Number</label>
                                              <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Proficiency Level Number --</option>
                                                @foreach($course_level as $i => $cl)
                                                  @if(old('id') == Str::slug($cl->updated_at.$cl->name.$cl->created_at))
                                                    <option selected="selected" value="{{ Str::slug($cl->updated_at.$cl->name.$cl->created_at) }}">#{{ $i + 1 }} - {{ $cl->name }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($cl->updated_at.$cl->name.$cl->created_at) }}">#{{ $i + 1 }} - {{ $cl->name }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('name') has-error @enderror">
                                              <label for="name">Change Name (optional)</label>
                                              <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name (optional)">
                                              @error('name')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('description') has-error @enderror">
                                              <label for="description">Change Description (optional)</label>
                                              <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description (optional)">{{ old('description') }}</textarea>
                                              @error('description')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('assignment_score_min') has-error @enderror">
                                              <label for="assignment_score_min">Change Assignment Passing Score (optional)</label>
                                              <input name="assignment_score_min" value="{{ old('assignment_score_min') }}" type="text" class="@error('assignment_score_min') is-invalid @enderror form-control" placeholder="Enter Assignment Passing Score (optional)">
                                              @error('assignment_score_min')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('mid_exam_score_min') has-error @enderror">
                                              <label for="mid_exam_score_min">Change Mid-Exam Passing Score (optional)</label>
                                              <input name="mid_exam_score_min" value="{{ old('mid_exam_score_min') }}" type="text" class="@error('mid_exam_score_min') is-invalid @enderror form-control" placeholder="Enter Mid-Exam Passing Score (optional)">
                                              @error('mid_exam_score_min')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('final_exam_score_min') has-error @enderror">
                                              <label for="final_exam_score_min">Change Final-Exam Passing Score (optional)</label>
                                              <input name="final_exam_score_min" value="{{ old('final_exam_score_min') }}" type="text" class="@error('final_exam_score_min') is-invalid @enderror form-control" placeholder="Enter Final-Exam Passing Score (optional)">
                                              @error('final_exam_score_min')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                                    </div>
                                  </form>
                                </div>
                              @else
                                <div class="text-center">No data available.</div>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="panel box box-info">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                List of Course Package(s))
                              </a>
                            </h4>
                          </div>
                          <div id="collapseFour" class="panel-collapse collapse">
                            <div class="box-body">
                              @if($course_package->toArray())
                                <table class="table table-bordered">
                                  <tr>
                                    <th class="text-right" style="width:40px;">#</th>
                                    <th>Title</th>
                                    <th>Material Type</th>
                                    <th>Course Type</th>
                                    <th>Proficiency Level</th>
                                    <!--th style="width:40px;">Detail</th-->
                                  </tr>
                                  @foreach($course_package as $i => $dt)
                                    <tr>
                                      <td class="text-right">{{ $i + 1 }}</td>
                                      <td>{{ $dt->title }}</td>
                                      <td>{{ $dt->material_type->name }}</td>
                                      <td>{{ $dt->course_type->name }}</td>
                                      <td>{{ $dt->course_level->name }}</td>
                                      <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                                    </tr>
                                  @endforeach
                                </table>
                                <div class="col-md-12">
                                  &nbsp;
                                </div>
                                <table class="table table-bordered">
                                  <tr>
                                    <th class="text-right" style="width:40px;">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Requirement</th>
                                    <!--th style="width:40px;">Detail</th-->
                                  </tr>
                                  @foreach($course_package as $i => $dt)
                                    <tr>
                                      <td class="text-right">{{ $i + 1 }}</td>
                                      <td>{{ $dt->title }}</td>
                                      <td>{{ $dt->description }}</td>
                                      <td>{{ $dt->requirement }}</td>
                                      <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                                    </tr>
                                  @endforeach
                                </table>
                                <div class="col-md-12">
                                  &nbsp;
                                </div>
                                <table class="table table-bordered">
                                  <tr>
                                    <th class="text-right" style="width:40px;">#</th>
                                    <th>Title</th>
                                    <th>Number of Session(s)</th>
                                    <th>Course Price (USD$)</th>
                                    <!--th style="width:40px;">Detail</th-->
                                  </tr>
                                  @foreach($course_package as $i => $dt)
                                    <tr>
                                      <td class="text-right">{{ $i + 1 }}</td>
                                      <td>{{ $dt->title }}</td>
                                      <td class="text-right">{{ $dt->count_session }}</td>
                                      <td class="text-right">{{ $dt->price }}</td>
                                      <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                                    </tr>
                                  @endforeach
                                </table>
                                <div class="box-header">
                                  <h4>Edit Course Package Information</h4>
                                </div>
                                <div class="box-body">
                                  <form role="form" method="post" action="{{ route('home') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('id') has-error @enderror">
                                              <label for="id">Course Package Number</label>
                                              <select name="id" type="text" class="@error('id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Course Package Number --</option>
                                                @foreach($course_package as $i => $cp)
                                                  @if(old('id') == Str::slug($cp->updated_at.$cp->title.$cp->created_at))
                                                    <option selected="selected" value="{{ Str::slug($cp->updated_at.$cp->title.$cp->created_at) }}">#{{ $i + 1 }} - {{ $cp->title }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($cp->updated_at.$cp->title.$cp->created_at) }}">#{{ $i + 1 }} - {{ $cp->title }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                            <div class="form-group @error('material_type_id') has-error @enderror">
                                              <label for="material_type_id">Change Material Type (optional)</label>
                                              <select name="material_type_id" type="text" class="@error('material_type_id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Material Type (optional) --</option>
                                                @foreach($material_type as $i => $mt)
                                                  @if(old('material_type_id') == Str::slug($mt->updated_at.$mt->name.$mt->created_at))
                                                    <option selected="selected" value="{{ Str::slug($mt->updated_at.$mt->name.$mt->created_at) }}">#{{ $i + 1 }} - {{ $mt->name }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($mt->updated_at.$mt->name.$mt->created_at) }}">#{{ $i + 1 }} - {{ $mt->name }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('material_type_id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                            <div class="form-group @error('course_type_id') has-error @enderror">
                                              <label for="course_type_id">Change Course Type (optional)</label>
                                              <select name="course_type_id" type="text" class="@error('course_type_id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Course Type (optional) --</option>
                                                @foreach($course_type as $i => $ct)
                                                  @if(old('course_type_id') == Str::slug($ct->updated_at.$ct->name.$ct->created_at))
                                                    <option selected="selected" value="{{ Str::slug($ct->updated_at.$ct->name.$ct->created_at) }}">#{{ $i + 1 }} - {{ $ct->name }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($ct->updated_at.$ct->name.$ct->created_at) }}">#{{ $i + 1 }} - {{ $ct->name }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('course_type_id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                            <div class="form-group @error('course_level_id') has-error @enderror">
                                              <label for="course_level_id">Change Proficiency Level (optional)</label>
                                              <select name="course_level_id" type="text" class="@error('course_level_id') is-invalid @enderror form-control">
                                                <option selected="selected" value="">-- Enter Proficiency Level (optional) --</option>
                                                @foreach($course_level as $i => $cl)
                                                  @if(old('course_level_id') == Str::slug($cl->created_at.$cl->name.$cl->updated_at))
                                                    <option selected="selected" value="{{ Str::slug($cl->created_at.$cl->name.$cl->updated_at) }}">#{{ $i + 1 }} - {{ $cl->name }}</option>
                                                  @else
                                                    <option value="{{ Str::slug($cl->created_at.$cl->name.$cl->updated_at) }}">#{{ $i + 1 }} - {{ $cl->name }}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                              @error('course_level_id')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="col-md-12">
                                            <div class="form-group @error('title') has-error @enderror">
                                              <label for="title">Change Title (optional)</label>
                                              <input name="title" value="{{ old('title') }}" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="Enter Title (optional)">
                                              @error('title')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('description') has-error @enderror">
                                              <label for="description">Change Description (optional)</label>
                                              <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Enter Description (optional)">{{ old('description') }}</textarea>
                                              @error('description')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('requirement') has-error @enderror">
                                              <label for="requirement">Change Requirement (optional)</label>
                                              <textarea name="requirement" class="@error('requirement') is-invalid @enderror form-control" rows="5" placeholder="Enter Requirement (optional)">{{ old('requirement') }}</textarea>
                                              @error('requirement')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('count_session') has-error @enderror">
                                              <label for="count_session">Change Number of Session(s) (optional)</label>
                                              <input name="count_session" value="{{ old('count_session') }}" type="text" class="@error('count_session') is-invalid @enderror form-control" placeholder="Enter Number of Session(s) (optional)">
                                              @error('count_session')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group @error('price') has-error @enderror">
                                              <label for="price">Change Price in USD$ (optional)</label>
                                              <input name="price" value="{{ old('price') }}" type="text" class="@error('price') is-invalid @enderror form-control" placeholder="Enter Price in USD$ (optional)">
                                              @error('price')
                                                <p style="color:red">{{ $message }}</p>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">Submit</button>
                                    </div>
                                  </form>
                                </div>
                              @else
                                <div class="text-center">No data available.</div>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="all_courses">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Courses</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Material Type</th>
                          <th>Course Type</th>
                          <th>Proficiency Level</th>
                          <th>Title</th>
                          <th style="width:40px;">Detail</th>
                        </tr>
                        @foreach($course as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->course_package->material_type->name }}</td>
                            <td>{{ $dt->course_package->course_type->name }}</td>
                            <td>{{ $dt->course_package->course_level->name }}</td>
                            <td>{{ $dt->title }}</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                          </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="filter_material_type">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Material Type</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th>Description</th>
                          <!--th style="width:40px;">Detail</th-->
                        </tr>
                        @foreach($material_type as $i => $dt)
                        <tr>
                          <td class="text-right">{{ $i + 1 }}</td>
                          <td>{{ $dt->name }}</td>
                          <td>{{ $dt->description }}</td>
                          <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                        </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="filter_course_type">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Course Type</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Student Quota</th>
                          <!--th style="width:40px;">Detail</th-->
                        </tr>
                          @foreach($course_type as $i => $dt)
                        <tr>
                          <td class="text-right">{{ $i + 1 }}</td>
                          <td>{{ $dt->name }}</td>
                          <td>{{ $dt->description }}</td>
                          <td class="text-right">
                            @if($dt->count_student_min != $dt->count_student_max)
                              {{ $dt->count_student_min }}-{{ $dt->count_student_max }}
                            @else
                              {{ $dt->count_student_min }}
                            @endif
                          </td>
                          <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                        </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-success collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Registered Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($course as $dt)
                          @if($course->count() != 0)
                            <tr>
                              <td class="text-right">Data</td>
                              <td>Data</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-warning collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Students Registering for a Course</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($course as $dt)
                          @if($course->count() != 0)
                            <tr>
                              <td class="text-right">Data</td>
                              <td>Data</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
                <div class="box box-danger collapsed-box">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Non-Registered Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course)
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($course as $dt)
                          @if($course->count() != 0)
                            <tr>
                              <td class="text-right">Data</td>
                              <td>Data</td>
                              <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="filter_proficiency_level">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <!--div class="box-header">
                    <h3 class="box-title">Section Title</h3>
                  </div-->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl>
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>All Other Users</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->toArray())
                      <table class="table table-bordered">
                        <tr>
                            <th class="text-right" style="width:40px;">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width:90px;">Assignment Passing Score</th>
                            <th style="width:90px;">Mid-Exam Passing Score</th>
                            <th style="width:90px;">Final-Exam Passing Score</th>
                            <!--th style="width:40px;">Detail</th-->
                        </tr>
                        @foreach($course_level as $i => $dt)
                        <tr>
                          <td class="text-right">{{ $i + 1 }}</td>
                          <td>{{ $dt->name }}</td>
                          <td>{{ $dt->description }}</td>
                          <td>{{ $dt->assignment_score_min }}</td>
                          <td>{{ $dt->mid_exam_score_min }}</td>
                          <td>{{ $dt->final_exam_score_min }}</td>
                          <!--td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td-->
                        </tr>
                        @endforeach
                      </table>
                    @else
                      <div class="text-center">No data available.</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
