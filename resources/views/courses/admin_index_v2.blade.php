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
                      <!--hr>
                      <dl>
                        <dt><i class="fa fa-file-text-o margin-r-5"></i> Description</dt>
                        <dd>This is the section description.</dd>
                      </dl-->
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-3">
                <!-- Material Types -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>{{ $material_type->count() }}</h3>
                    <p>Material Types</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-book"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <!-- Course Types -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>{{ $course_type->count() }}</h3>
                    <p>Course Types</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-book"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <!-- Proficiency Levels (Course Levels) -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>{{ $course_level->count() }}</h3>
                    <p>Course Levels</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-book"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                &nbsp;
              </div>
              <div class="col-md-9">
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title"><b>List of Material Type(s)</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New "Something"
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
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
                                    <label for="name">Change Material Type Name (optional)</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter New Material Type Name (optional)">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Change Material Type Description (optional)</label>
                                    <input name="description" value="{{ old('description') }}" type="text" class="@error('description') is-invalid @enderror form-control" placeholder="Enter New Material Type Description (optional)">
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
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title"><b>List of Course Type(s)</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New "Something"
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course_type->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th>Description</th>
                          <!--th style="width:40px;">Detail</th-->
                        </tr>
                        @foreach($course_type as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->description }}</td>
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
                                    <label for="name">Change Course Type Name (optional)</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter New Course Type Name (optional)">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Change Course Type Description (optional)</label>
                                    <input name="description" value="{{ old('description') }}" type="text" class="@error('description') is-invalid @enderror form-control" placeholder="Enter New Course Type Description (optional)">
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
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title"><b>List of Proficiency Level(s)</b></h3>
                    {{--
                    <div>
                      <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;
                        Add New "Something"
                      </a>
                    </div>
                    --}}
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course_level->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-right" style="width:40px;">#</th>
                          <th>Name</th>
                          <th>Description</th>
                          <!--th style="width:40px;">Detail</th-->
                        </tr>
                        @foreach($course_level as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->description }}</td>
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
                                    <label for="name">Change Proficiency Level Name (optional)</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter New Proficiency Level Name (optional)">
                                    @error('name')
                                      <p style="color:red">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Change Proficiency Level Description (optional)</label>
                                    <input name="description" value="{{ old('description') }}" type="text" class="@error('description') is-invalid @enderror form-control" placeholder="Enter New Proficiency Level Description (optional)">
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
                    <h3 class="box-title"><b>All Instructors</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($course as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>Data</td>
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
                    <h3 class="box-title"><b>All Students</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    @if($course->toArray())
                      <table class="table table-bordered">
                        <tr>
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Name</th>
                          <th>Registration Status</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($course as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>Data</td>
                            <td>Data</td>
                            <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('home') }}">Link</a></td>
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
                          <th style="width:40px;" class="text-right">#</th>
                          <th>Role</th>
                          <th>Name</th>
                          <th style="width:40px;">Profile</th>
                        </tr>
                        @foreach($course as $i => $dt)
                          <tr>
                            <td class="text-right">{{ $i + 1 }}</td>
                            <td>Data</td>
                            <td>Data</td>
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
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
