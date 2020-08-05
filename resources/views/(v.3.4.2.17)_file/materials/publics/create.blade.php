@extends('layouts.admin.default')
@section('title','Material Public Create Form')
@include('layouts.css_and_js.form_general')
@section('content-header')
  <h1>Material Public</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('material_publics.index') }}">Material Public</a></li>
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
        <form role="form" method="post" action="{{ route('material_publics.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12">
                  @if ($errors->get('material_types'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="material_types">Material Type</label>
                      <select name="material_types" type="text" class="@error('material_types') is-invalid @enderror form-control">
                        <option selected="selected" value="">-- Enter Material Type --</option>
                        @foreach($material_types as $material_type)
                          <option value="{{ $material_type->code }}">{{ $material_type->name }}</option>
                        @endforeach
                      </select>
                      @error('material_type')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12">
                  @if ($errors->get('course_types'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="course_types">Course Type</label>
                      <select name="course_types" type="text" class="@error('course_types') is-invalid @enderror form-control">
                        <option selected="selected" value="">-- Enter Course Type --</option>
                        @foreach($course_types as $course_type)
                          <option value="{{ $course_type->code }}">{{ $course_type->name }}</option>
                        @endforeach
                      </select>
                      @error('course_type')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12">
                  @if ($errors->get('course_levels'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="course_levels">Course Level</label>
                      <select name="course_levels" type="text" class="@error('course_levels') is-invalid @enderror form-control">
                        <option selected="selected" value="">-- Enter Course Level --</option>
                        @foreach($course_levels as $course_level)
                          <option value="{{ $course_level->code }}">{{ $course_level->name }}</option>
                        @endforeach
                      </select>
                      @error('course_level')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12">
                  @if ($errors->get('course_level_details'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="course_level_details">Course Level (Detailed)</label>
                      <select name="course_level_details" type="text" class="@error('course_level_details') is-invalid @enderror form-control">
                        <option selected="selected" value="">-- Enter Course Level (Detailed) --</option>
                        @foreach($course_level_details as $course_level_detail)
                          <option value="{{ $course_level_detail->code }}">{{ $course_level_detail->name }}</option>
                        @endforeach
                      </select>
                      @error('course_level_detail')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  @if ($errors->get('name'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="name">Material Name</label>
                      <input name="name" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Material Name">
                      @error('name')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12">
                  @if ($errors->get('description'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="description">Learning Objectives</label>
                      <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Describe Learning Objectives"></textarea>
                      @error('description')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12">
                  @if ($errors->get('path'))
                    <div class="form-group has-error">
                  @else
                    <div class="form-group">
                  @endif
                      <label for="path">Upload Material</label>
                      <input name="path" type="file" accept="*" class="@error('path') is-invalid @enderror form-control">
                      @error('path')
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
