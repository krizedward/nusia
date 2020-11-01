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
            <br>
            <?php
              $arr = [];
              foreach($course_packages as $cp) {
                if($cp->material_type->id == $mt->id) {
                  foreach($course_types as $ct) {
                    if($cp->course_type->id == $ct->id && !in_array($ct->id, $arr)) {
                      array_push($arr, $ct->id);
                      break;
                    }
                  }
                }
              }
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
                      <div class="box-body" style="height:225px;">
                        @foreach($course_packages as $cp)
                          @if($cp->course_type->id == $ct->id)
                            <hr>
                            @foreach($course_package_discounts as $cpd)
                              @if($cpd->course_package_id == $cp->id)
                                <label class="label label-success">$ {{ $cp->price - $cpd->price }} savings</label>
                                <div class="text-center">
                                  <p><b><span style="font-size:20px;"><strike>${{ $cp->price }}</strike></span></b></p>
                                  <p>Get a {{ $cpd->description }}</p>
                                  <p><b>Now is only <span style="font-size:20px;">${{ $cpd->price }}/level</span></b></p>
                                  <p style="color:#ff0000;">{{ $cp->refund_description }}</p>
                                </div>
                              @endif
                            @endforeach
                            @break
                          @endif
                        @endforeach
                      </div>
                      <div class="box-footer">
                        <a href="{{ route('student.complete_payment_information', $cp->id) }}" class="btn btn-primary btn-block"><b>BOOK NOW!</b></a>
                      </div>
                    @else
                      <div class="box-body" style="height:225px;">
                        @foreach($course_packages as $cp)
                          @if($cp->course_type->id == $ct->id)
                            @if($mt->name == 'General Indonesian Language')
                              <hr>
                            @endif
                            @foreach($course_package_discounts as $cpd)
                              @if($cpd->course_package_id == $cp->id)
                                <label class="label label-success">$ {{ $cp->price - $cpd->price }} savings</label>
                                <div class="text-center">
                                  <p><b><span style="font-size:20px;"><strike>${{ $cp->price }}</strike></span></b></p>
                                  <p>Get a {{ $cpd->description }}</p>
                                  <p><b>Now is only <span style="font-size:20px;">${{ $cpd->price }}/level</span></b></p>
                                  <p style="color:#ff0000;">{{ $cp->refund_description }}</p>
                                </div>
                              @endif
                            @endforeach
                            @break
                          @endif
                        @endforeach
                      </div>
                      <div class="box-footer">
                        <a href="{{ route('student.complete_payment_information', $cp->id) }}" class="btn btn-primary btn-block"><b>BOOK NOW!</b></a>
                      </div>
                    @endif
                  </div>
                </div>
              @endif
            @endforeach
          </div>
          {{--
          <div class="box-footer">
            <a href="{{ route('student.complete_payment_information', $cp->id) }}" class="btn btn-primary btn-block"><b>BOOK NOW!</b></a>
          </div>
          --}}
        </div>
      </div>
    @endforeach
  </div>
@stop