@extends('layouts.admin.default')

@section('title', 'New Course Registration')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Choose the right course for your needs!</b></h1>
@stop

@section('content')
@if($current_course_registration)
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          @foreach($material_types as $i => $mt)
            @if($i + 1 == 1)
              <li class="active"><a href="#material{{ $i + 1 }}" data-toggle="tab"><b>{{ $mt->name }}</b></a></li>
            @else
              <li><a href="#material{{ $i + 1 }}" data-toggle="tab"><b>{{ $mt->name }}</b></a></li>
            @endif
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($material_types as $i => $mt)
            <div class="@if($i + 1 == 1) active @endif tab-pane" id="material{{ $i + 1 }}">
              <div class="row">
                <div class="col-md-3">
                  <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title"><b>{{ $mt->name }}</b></h3>
                      <p class="no-margin">
                        <b>{{ $mt->duration_in_minute }} minutes/session</b>
                      </p>
                      <?php
                        $flag_registered_early_classes = 1;
                        foreach($registered_early_classes as $registered_early_class)
                          if($registered_early_class->course->course_package->material_type_id == $mt->id) {
                            $flag_registered_early_classes = 0;
                            break;
                          }
                      ?>
                      @if($flag_registered_early_classes)
                        <p class="no-margin" style="color:#ff0000;">
                          <b>This material has a free class for one-time only!</b>
                        </p>
                      @endif
                    </div>
                    <!-- /.box-header -->
                    <form>
                      <div class="box-body">
                        <dl>
                          <dt>
                            <i class="fa fa-book margin-r-5"></i> Description
                          </dt>
                          <dd>
                            {{ $mt->description }}<br />
                            <ul>
                              @foreach($mt->material_type_values as $mtv)
                                <li>{{ $mtv->value }}</li>
                              @endforeach
                            </ul>
                            {{--
                            <span style="color:#ff0000;">More texts here.</span>
                            --}}
                          </dd>
                        </dl>
                        {{--
                        <hr>
                        --}}
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-9 no-padding">
                  <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title"><b>Overview</b></h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Material Type</strong>
                        <p>Text</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Course Type</strong>
                        <p>Text</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Course Proficiency Level</strong>
                        <p>Text</p>
                        <hr>
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Course Title</strong>
                        <p>Text</p>
                      </div>
                    </div>
                    <div class="box box-warning">
                      <div class="box-header">
                        <h3 class="box-title"><b>Text</b></h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <table class="table table-bordered">
                          <tr>
                            <th>Name</th>
                            <th style="width:25%;">Interest</th>
                            <th style="width:12%;">Picture</th>
                          </tr>
                          <tr>
                            <td>Text</td>
                            <td>Text</td>
                            <td>Text</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="box box-info">
                      <div class="box-header">
                        <h3 class="box-title"><b>Text</b></h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <table class="table table-bordered">
                          <tr>
                            <th>Name</th>
                            <th style="width:25%;">Interest</th>
                            <th style="width:12%;">Picture</th>
                          </tr>
                          <tr>
                            <td>Text</td>
                            <td>Text</td>
                            <td>Text</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
          @endforeach
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@else
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><b>Current Course Registrations</b></h3>
          <div>
            <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('student.choose_materials', [-1]) }}">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;
              Register in New Course
            </a>
          </div>
          {{--
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
          --}}
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th class="text-right" style="width:40px;">#</th>
              <th>Registered in</th>
              <th>Registration Time</th>
              <th style="width:40px;">Edit</th>
            </tr>
            @foreach($all_not_assigned_courses as $i => $dt)
              <tr>
                <td class="text-right">{{ $i + 1 }}</td>
                <td>{{ $dt->course->course_package->title }}</td>
                <td>{{ $dt->created_at }}</td>
                <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('student.choose_materials', [$dt->id]) }}">Link</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endif
@stop
