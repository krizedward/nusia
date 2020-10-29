@extends('layouts.admin.default')

@section('title','New Course Registration')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Choose the right course for your needs!</b></h1>
@stop

@section('content')
  <div class="row">
    @foreach($material_types as $mt)
      <div class="col-md-12">
        <div class="box box-warning">
          <div class="box-header with-border text-center">
            <h3 class="box-title"><b>{{ $mt->name }}</b></h3>
            <p class="no-margin"><b>{{ $mt->duration_in_minute }} minutes/session</b></p>
          </div>
          <div class="box-body">
            <p>{{ $mt->description }}</p>
            <ul>
              @foreach($mt->material_type_values as $mtv)
                <li>{{ $mtv->value }}</li>
              @endforeach
            </ul>
            <?php
              $i = 0;
              foreach($course_packages as $cp) if($cp->material_type->id == $mt->id) $i++;
            ?>
            <div class="col-md-{{ 12 / $i }}">
              <div class="box box-default">
                <div class="box-header with-border text-center">
                  <h3 class="box-title"><b>{{ $mt->name }}</b></h3>
                  <p class="no-margin"><b>{{ $mt->duration_in_minute }} minutes/session</b></p>
                </div>
                <div class="box-body">
                  <p>{{ $mt->description }}</p>
                  <ul>
                    @foreach($mt->material_type_values as $mtv)
                      <li>{{ $mtv->value }}</li>
                    @endforeach
                  </ul>
                </div>
                <div class="box-footer">
                  <a href="{{ route('student.choose_course_types', $mt->id) }}" class="btn btn-primary btn-block"><b>Choose This Course</b></a>	
                </div>
              </div>
            </div>


          </div>
          <div class="box-footer">
            <a href="{{ route('student.choose_course_types', $mt->id) }}" class="btn btn-primary btn-block"><b>Choose This Course</b></a>	
          </div>
        </div>
      </div>
    @endforeach
  </div>
@stop