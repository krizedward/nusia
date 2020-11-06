@extends('layouts.admin.default')

@section('title','New Course Registration')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Choose the right course for your needs!</b></h1>
@stop

@section('content')
  <form role="form" method="post" action="{{ route('student.store_materials') }}" enctype="multipart/form-data">
  @csrf
    <input type="hidden" id="choice" name="choice" value="">
    <input type="hidden" id="choice_mt" name="choice_mt" value="">
    <div class="row">
      @foreach($material_types as $mt)
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title"><b>{{ $mt->name }}</b></h3>
              <p class="no-margin"><b>{{ $mt->duration_in_minute }} minutes/session</b></p>
              <?php
                $flag_registered_early_classes = 1;
                foreach($registered_early_classes as $registered_early_class)
                  if($registered_early_class->course->course_package->material_type_id == $mt->id) {
                    $flag_registered_early_classes = 0;
                    break;
                  }
              ?>
              @if($flag_registered_early_classes)
                <p class="no-margin" style="color:#ff0000;"><b>This material has a free class for one-time only!</b></p>
              @endif
            </div>
            <div class="box-body">
              <p>{{ $mt->description }}</p>
              <ul>
                @foreach($mt->material_type_values as $mtv)
                  <li>{{ $mtv->value }}</li>
                @endforeach
              </ul>
              <br>
              <?php
                $arr = [];
                foreach($course_packages as $cp) {
                  // Melakukan pemeriksaan ID material type yang sama.
                  if($cp->material_type->id == $mt->id) {
                    foreach($course_types as $ct) {
                      // Menghindari duplikasi pada course type (apabila ada yang sama, dan terdapat duplikat karena perbedaan proficiency level).
                      if($cp->course_type->id == $ct->id && !in_array($ct->id, $arr)) {
                        array_push($arr, $ct->id);
                        break;
                      }
                    }
                  }
                }
                // in_array($ct->id, array_pluck($mt->course_packages->toArray(), 'id'))
              ?>
              @foreach($course_types as $ct)
                @if(in_array($ct->id, $arr))
                  <div class="@if(count($arr) > 3) col-md-4 @elseif(count($arr) > 0) col-md-{{ 12 / count($arr) }} @else col-md-12 @endif">
                    <div class="box box-primary">
                      <div class="box-header with-border text-center">
                        <h3 class="box-title"><b>{{ $ct->name }}</b></h3>
                      </div>
                      @if($mt->name != 'Language Partners')
                        <div class="box-body" style="height:300px;">
                          <ul>
                            @if($mt->name == 'General Indonesian Language')
                              <li><b><span style="font-size:1.5em;">{{ $ct->brief_description_1 }}</span> ({{ $ct->brief_description_2 }})</b></li>
                            @endif
                            @foreach($ct->course_type_values as $ctv)
                              <li>{{ $ctv->value }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                      @if($mt->name == 'Indonesian Culture')
                        @foreach($ct->course_packages as $i => $cp)
                          <div class="box-body" style="@if($i % 2 == 0) height:400px; @else height:275px; @endif">
                            @if($i % 2 == 0)
                              <hr>
                              <p class="text-center">{{ $cp->description }}</p>
                            @endif
                            <hr>
                            <p class="text-center" style="font-size:1.5em;"><b>{{ $cp->title }}</b></p>
                            <label class="label label-success">$ {{ $cp->price - $cp->course_package_discounts->last()->price }} savings</label>
                            <div class="text-center">
                              <p><b><span style="font-size:20px;"><strike>${{ $cp->price }}</strike></span></b></p>
                              <p>{{ $cp->course_package_discounts->last()->description }}</p>
                              <p><b>Now is only <span style="font-size:20px;">${{ $cp->course_package_discounts->last()->price }}/level</span></b></p>
                              <p style="color:#ff0000;">{{ $cp->refund_description }}</p>
                            </div>
                          </div>
                          <div class="box-footer">
                            <?php
                              $is_allowed_to_register = 1;
                              foreach($all_current_running_course_registrations as $acrcr) {
                                if($acrcr->course->course_package->material_type == $mt->id) {
                                  $is_allowed_to_register = 0;
                                  break;
                                }
                              }
                            ?>
                            @if($is_allowed_to_register)
                              <button class="btn btn-primary btn-block" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                <b>BOOK NOW!</b>
                              </button>
                            @else
                              <button class="btn btn-default btn-block disabled" type="reset" onclick="alert('You can only register in one course per material, at a time.');">
                                <b>Unavailable, you are currently registered in this material.</b>
                              </button>
                            @endif
                          </div>
                        @endforeach
                      @else
                        <div class="box-body" style="height:225px;">
                          @if($mt->name == 'General Indonesian Language')
                            <hr>
                          @endif
                          <label class="label label-success">$ {{ $ct->course_packages->last()->price - $ct->course_packages->last()->course_package_discounts->last()->price }} savings</label>
                          <div class="text-center">
                            <p><b><span style="font-size:20px;"><strike>${{ $ct->course_packages->last()->price }}</strike></span></b></p>
                            <p>{{ $ct->course_packages->last()->course_package_discounts->last()->description }}</p>
                            <p><b>Now is only <span style="font-size:20px;">${{ $ct->course_packages->last()->course_package_discounts->last()->price }}/level</span></b></p>
                            <p style="color:#ff0000;">{{ $ct->course_packages->last()->refund_description }}</p>
                          </div>
                        </div>
                        <div class="box-footer">
                          <?php
                            $is_allowed_to_register = 1;
                            foreach($all_current_running_course_registrations as $acrcr) {
                              if($acrcr->course->course_package->material_type == $mt->id) {
                                $is_allowed_to_register = 0;
                                break;
                              }
                            }
                          ?>
                          @if($is_allowed_to_register)
                            <button class="btn btn-primary btn-block" onclick="document.getElementById('choice').value = '{{ $ct->course_packages->first()->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                              <b>BOOK NOW!</b>
                            </button>
                          @else
                            <button class="btn btn-default btn-block disabled" type="reset" onclick="alert('You can only register in one course per material, at a time.');">
                              <b>Currently registered in this material.</b>
                            </button>
                          @endif
                        </div>
                      @endif
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
            {{--
            <div class="box-footer">
              <button class="btn btn-primary btn-block" onclick="document.getElementById('choice').value = '{{ $ct->course_packages->first()->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                <b>BOOK NOW!</b>
              </button>
            </div>
            --}}
          </div>
        </div>
      @endforeach
    </div>
  </form>
@stop