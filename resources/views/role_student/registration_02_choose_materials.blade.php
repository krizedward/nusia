@extends('layouts.admin.default')

@section('title', 'Choosing Course Registrations')

@include('layouts.css_and_js.all')

@section('content-header')
  @if($current_course_registration)
    <h1><b>Choose the right course for your needs!</b></h1>
  @else
    <h1><b>Choose the right courses for your needs!</b></h1>
  @endif
@stop

@section('content')
@if($current_course_registration)
  <form role="form" method="post" action="{{ route('student.choose_course.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="choice" name="choice" value="">
    <input type="hidden" id="choice_mt" name="choice_mt" value="">
    <input type="hidden" id="older_choice" name="older_choice" value="{{ $current_course_registration }}">
    <div class="row">
      @if(session('error_message'))
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-book"></i> Please choose another material type.</h4>
            {{ session('error_message') }}
            {{ session(['error_message' => null]) }}
          </div>
        </div>
      @endif
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
                            <b>This course has one free class so you will gain 16 sessions in total!</b>
                          </p>
                        @endif
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <dl>
                          <dt>
                            <i class="fa fa-book margin-r-5"></i> Description
                          </dt>
                          <dd>
                            {{ $mt->description }}<br />
                            {{--
                            @if($mt->name == 'Language Partners')
                              <ul>
                                @foreach($mt->material_type_values as $mtv)
                                  <li>{{ $mtv->value }}</li>
                                @endforeach
                              </ul>
                            @endif
                            --}}
                          </dd>
                        </dl>
                        <hr>
                        <dl>
                          <dt>
                            <i class="fa fa-file-text-o margin-r-5"></i> More Information
                          </dt>
                          <dd>
                            Click on each
                            <a href="#" data-toggle="modal" data-target="#popuptutorial{{ $i }}" {{-- class="btn btn-s btn-primary" --}}>
                              blue-colored text
                            </a>
                            to display a pop-up describing more information about the course discounts!<br />
                            <span style="color:#ff0000;">Contact us if you encounter a problem.</span>
                          </dd>
                        </dl>
                        {{--
                        <hr>
                        --}}
                      </div>
                    </div>
                    <div class="modal fade" id="popuptutorial{{ $i }}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="box box-primary">
                            <div class="box-body box-profile">
                              <h3 class="profile-username text-center"><b>Sample Title</b></h3>
                              <p class="text-muted text-center">This is the sample subtitle.</p>
                              <ul class="list-group list-group-unbordered">
                                <li class="list-group-item text-center">
                                  This is the sample text for this pop-up.<br />
                                  Click on each blue-colored text to display a pop-up describing more information about the course discounts!
                                </li>
                              </ul>
                              <button onclick="document.getElementById('popuptutorial{{ $i }}').className = 'modal fade'; document.getElementById('popuptutorial{{ $i }}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </div>
                  <div class="col-md-9 no-padding">
                    <div class="col-md-12">
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
                          <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">
                                <i class="fa fa-graduation-cap">&nbsp;&nbsp;</i>
                                <b>{{ ucwords(strtolower($ct->name)) }}</b>
                              </h3>
                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              </div>
                            </div>
                            <div class="box-body">
                              @if($mt->name != 'Language Partners')
                                <strong><i class="fa fa-circle-o margin-r-5"></i> Features</strong>
                                <ul>
                                  @if($mt->name == 'General Indonesian Language')
                                    <li><b>{{ $ct->brief_description_1 }} ({{ $ct->brief_description_2 }})</b></li>
                                  @endif
                                  @foreach($ct->course_type_values as $ctv)
                                    <li>{{ $ctv->value }}</li>
                                  @endforeach
                                </ul>
                              @else
                                <strong><i class="fa fa-circle-o margin-r-5"></i> Features</strong>
                                <ul>
                                  @foreach($mt->material_type_values as $mtv)
                                    <li>{{ $mtv->value }}</li>
                                  @endforeach
                                </ul>
                              @endif
                              {{-- <hr> --}}
                              @if($mt->name == 'Cultural Classes')
                                <table class="table table-bordered">
                                  <tr>
                                    <th>Name</th>
                                    <th>Price (per level)</th>
                                    <th style="width:5%;">Choose</th>
                                  </tr>
                                  @foreach($ct->course_packages as $j => $cp)
                                    @if($j % 2 == 0)
                                      <tr>
                                        <td class="text-center" colspan="3">{{ $cp->description }}</td>
                                      </tr>
                                    @endif
                                    <tr>
                                      <td>
                                        <a href="#" data-toggle="modal" data-target="#CourseChoice{{$cp->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                          {{ $cp->title }}
                                        </a>
                                      </td>
                                      <td>
                                        <strike>${{ $cp->price }}</strike>
                                        <b style="font-size:115%; color:#007700;">${{ $cp->course_package_discounts->last()->price }}</b><br />
                                      </td>
                                      <td class="text-center">
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
                                          <button class="btn btn-xs btn-flat btn-primary" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                            <b>BOOK NOW!</b>
                                          </button>
                                        @else
                                          <button disabled class="btn btn-xs btn-flat btn-default btn-disabled" type="reset" onclick="alert('Unavailable, you are currently registered in the similar material. You can only register in one course per material, at a time.'); return false;">
                                            <b>N/A</b>
                                          </button>
                                        @endif
                                      </td>
                                    </tr>
                                    <div class="modal fade" id="CourseChoice{{$cp->id}}">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="box box-primary">
                                            <div class="box-body box-profile">
                                              <h3 class="profile-username text-center"><b>{{ $cp->title }}</b></h3>
                                              <p class="text-muted text-center">
                                                <!--span style="font-size:153%;">$ {{ $cp->price - $cp->course_package_discounts->last()->price }} savings</span-->
                                                <!--label class="label label-success">$ {{ $cp->price - $cp->course_package_discounts->last()->price }} savings</label-->
                                                <label class="label label-success" style="font-size:153%;">$ {{ $cp->price - $cp->course_package_discounts->last()->price }} savings</label>
                                              </p>
                                              <ul class="list-group list-group-unbordered">
                                                <li class="list-group-item text-center">
                                                  <b style="font-size:153%;"><strike>${{ $cp->price }}</strike></b><br />
                                                  {{ $cp->course_package_discounts->last()->description }}<br />
                                                  <b style="font-size:135%;">Now is only ${{ $cp->course_package_discounts->last()->price }}/level</b><br />
                                                  <span style="color:#ff0000;">{{ $cp->refund_description }}</span>
                                                </li>
                                              </ul>
                                              @if($is_allowed_to_register)
                                                <button style="width:100%;" class="btn btn-s btn-primary" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                                  <b>BOOK NOW!</b>
                                                </button>
                                              @else
                                                <button disabled style="width:100%;" class="btn btn-s btn-default btn-disabled" type="reset" onclick="alert('Unavailable, you are currently registered in the similar material. You can only register in one course per material, at a time.'); return false;">
                                                  <b>N/A</b>
                                                </button>
                                              @endif
                                              <br /><br />
                                              <button onclick="document.getElementById('CourseChoice{{$cp->id}}').className = 'modal fade'; document.getElementById('CourseChoice{{$cp->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                            </div>
                                            <!-- /.box-body -->
                                          </div>
                                          <!-- /.box -->
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                    </div>
                                    <tr>
                                      <td>
                                        <a href="#" data-toggle="modal" data-target="#CourseChoiceFree{{$cp->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                          {{ $cp->title }} (Free Classes)
                                        </a>
                                      </td>
                                      <td>
                                        <strike>${{ $cp->price }}</strike>
                                        <b style="font-size:115%; color:#007700;">$0</b><br />
                                      </td>
                                      <td class="text-center">
                                        <?php
                                          $is_allowed_to_register = 1;
                                          foreach($all_current_running_course_registrations as $acrcr) {
                                            if($acrcr->course->course_package->material_type == $mt->id) {
                                              $is_allowed_to_register = 0;
                                              break;
                                            }
                                          }
                                        ?>
                                        {{-- 1 baris kode di bawah ini hanya untuk sementara --}}
                                        <?php $is_allowed_to_register = 0; ?>
                                        @if($is_allowed_to_register)
                                          <button class="btn btn-xs btn-flat btn-primary" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                            <b>BOOK NOW!</b>
                                          </button>
                                        @else
                                          <button disabled class="btn btn-xs btn-flat btn-default btn-disabled" type="reset" onclick="alert('Sorry, this class is currently unavailable.'); return false;">
                                            <b>N/A</b>
                                          </button>
                                        @endif
                                      </td>
                                    </tr>
                                    <div class="modal fade" id="CourseChoiceFree{{$cp->id}}">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="box box-primary">
                                            <div class="box-body box-profile">
                                              <h3 class="profile-username text-center"><b>{{ $cp->title }} (Free Classes)</b></h3>
                                              <ul class="list-group list-group-unbordered">
                                                <li class="list-group-item text-center">
                                                  <b style="font-size:153%;">$0</b><br />
                                                  Book our free classes to experience fun bahasa Indonesia learning!<br />
                                                </li>
                                              </ul>
                                              @if($is_allowed_to_register)
                                                <button style="width:100%;" class="btn btn-s btn-primary" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                                  <b>BOOK NOW!</b>
                                                </button>
                                              @else
                                                <button disabled style="width:100%;" class="btn btn-s btn-default btn-disabled" type="reset" onclick="alert('Sorry, this class is currently unavailable.'); return false;">
                                                  <b>N/A</b>
                                                </button>
                                              @endif
                                              <br /><br />
                                              <button onclick="document.getElementById('CourseChoiceFree{{$cp->id}}').className = 'modal fade'; document.getElementById('CourseChoiceFree{{$cp->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                            </div>
                                            <!-- /.box-body -->
                                          </div>
                                          <!-- /.box -->
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                    </div>
                                  @endforeach
                                </table>
                              @else
                                <table class="table table-bordered">
                                  <tr>
                                    <th>Name</th>
                                    <th>Price (per level)</th>
                                    <th style="width:5%;">Choose</th>
                                  </tr>
                                  <tr>
                                    <td>
                                      <a href="#" data-toggle="modal" data-target="#CourseChoice{{$ct->course_packages->last()->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                        {{ $ct->name }}
                                      </a>
                                    </td>
                                    <td>
                                      <strike>${{ $ct->course_packages->last()->price }}</strike>
                                      <b style="font-size:115%; color:#007700;">${{ $ct->course_packages->last()->course_package_discounts->last()->price }}</b><br />
                                    </td>
                                    <td class="text-center">
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
                                        <button class="btn btn-xs btn-flat btn-primary" onclick="document.getElementById('choice').value = '{{ $ct->course_packages->first()->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                          <b>BOOK NOW!</b>
                                        </button>
                                      @else
                                        <button disabled class="btn btn-xs btn-flat btn-default btn-disabled" type="reset" onclick="alert('Unavailable, you are currently registered in the similar material. You can only register in one course per material, at a time.'); return false;">
                                          <b>N/A</b>
                                        </button>
                                      @endif
                                    </td>
                                  </tr>
                                  <div class="modal fade" id="CourseChoice{{$ct->course_packages->last()->id}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="box box-primary">
                                          <div class="box-body box-profile">
                                            <h3 class="profile-username text-center" style="font-size:235%;"><b>{{ $ct->name }}</b></h3>
                                            {{--<p class="text-muted text-center">&nbsp;</p>--}}
                                            <ul class="list-group list-group-unbordered">
                                              <li class="list-group-item text-center">
                                                <label class="label label-success" style="font-size:120%;">$ {{ $ct->course_packages->last()->price - $ct->course_packages->last()->course_package_discounts->last()->price }} savings</label><br />
                                                <b style="font-size:153%;"><strike>${{ $ct->course_packages->last()->price }}</strike></b><br />
                                                {{ $ct->course_packages->last()->course_package_discounts->last()->description }}<br />
                                                <b style="font-size:135%;">Now is only ${{ $ct->course_packages->last()->course_package_discounts->last()->price }}/level</b><br />
                                                <span style="color:#ff0000;">{{ $ct->course_packages->last()->refund_description }}</span>
                                              </li>
                                            </ul>
                                            @if($is_allowed_to_register)
                                              <button style="width:100%;" class="btn btn-s btn-primary" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                                <b>BOOK NOW!</b>
                                              </button>
                                            @else
                                              <button disabled style="width:100%;" class="btn btn-s btn-default btn-disabled" type="reset" onclick="alert('Unavailable, you are currently registered in the similar material. You can only register in one course per material, at a time.'); return false;">
                                                <b>N/A</b>
                                              </button>
                                            @endif
                                            <br /><br />
                                            <button onclick="document.getElementById('CourseChoice{{$ct->course_packages->last()->id}}').className = 'modal fade'; document.getElementById('CourseChoice{{$ct->course_packages->last()->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                          </div>
                                          <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                  <tr>
                                    <td>
                                      <a href="#" data-toggle="modal" data-target="#CourseChoiceFree{{$ct->course_packages->last()->id}}" {{-- class="btn btn-s btn-primary" --}}>
                                        {{ $ct->name }} (Free Classes)
                                      </a>
                                    </td>
                                    <td>
                                      <strike>${{ $ct->course_packages->last()->price }}</strike>
                                      <b style="font-size:115%; color:#007700;">$0</b><br />
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        $is_allowed_to_register = 1;
                                        foreach($all_current_running_course_registrations as $acrcr) {
                                          if($acrcr->course->course_package->material_type == $mt->id) {
                                            $is_allowed_to_register = 0;
                                            break;
                                          }
                                        }
                                      ?>
                                      {{-- 1 baris kode di bawah ini hanya untuk sementara --}}
                                      <?php $is_allowed_to_register = 0; ?>
                                      @if($is_allowed_to_register)
                                        <button class="btn btn-xs btn-flat btn-primary" onclick="document.getElementById('choice').value = '{{ $ct->course_packages->first()->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                          <b>BOOK NOW!</b>
                                        </button>
                                      @else
                                        <button disabled class="btn btn-xs btn-flat btn-default btn-disabled" type="reset" onclick="alert('Sorry, this class is currently unavailable.'); return false;">
                                          <b>N/A</b>
                                        </button>
                                      @endif
                                    </td>
                                  </tr>
                                  <div class="modal fade" id="CourseChoiceFree{{$ct->course_packages->last()->id}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="box box-primary">
                                          <div class="box-body box-profile">
                                            <h3 class="profile-username text-center" style="font-size:235%;"><b>{{ $ct->name }} (Free Classes)</b></h3>
                                            {{--<p class="text-muted text-center">&nbsp;</p>--}}
                                            <ul class="list-group list-group-unbordered">
                                              <li class="list-group-item text-center">
                                                <b style="font-size:153%;">$0</b><br />
                                                Book our free classes to experience fun bahasa Indonesia learning!<br />
                                              </li>
                                            </ul>
                                            @if($is_allowed_to_register)
                                              <button style="width:100%;" class="btn btn-s btn-primary" onclick="document.getElementById('choice').value = '{{ $cp->id }}'; document.getElementById('choice_mt').value = '{{ $mt->id }}'; if( confirm('Are you sure to book this course: {{ $mt->name }} - {{ $ct->name }}?') ) return true; else return false;">
                                                <b>BOOK NOW!</b>
                                              </button>
                                            @else
                                              <button disabled style="width:100%;" class="btn btn-s btn-default btn-disabled" type="reset" onclick="alert('Sorry, this class is currently unavailable.'); return false;">
                                                <b>N/A</b>
                                              </button>
                                            @endif
                                            <br /><br />
                                            <button onclick="document.getElementById('CourseChoiceFree{{$ct->course_packages->last()->id}}').className = 'modal fade'; document.getElementById('CourseChoiceFree{{$ct->course_packages->last()->id}}').style = ''; document.getElementsByClassName('modal-backdrop')[0].remove('modal-backdrop'); document.getElementsByClassName('modal-open')[0].style = 'height:auto; min-height:100%;'; document.getElementsByClassName('modal-open')[0].classList.remove('modal-open'); return false;" class="btn btn-s btn-default" style="width:100%;">Close</button>
                                          </div>
                                          <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                </table>
                              @endif
                            </div>
                          </div>
                        @endif
                      @endforeach
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
  </form>
@else
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><b>Current Course Registrations</b></h3>
          <div>
            <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('student.choose_course.index', [-1]) }}">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;
              Register in a New Course
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
              <th class="text-right" style="width:5%;">#</th>
              <th>Course</th>
              <th>Registered at</th>
              <th style="width:5%;">Continue</th>
            </tr>
            @foreach($all_not_completely_registered_courses as $i => $dt)
              <tr>
                <td class="text-right">{{ $i + 1 }}</td>
                <td>{{ $dt->course->course_package->title }}</td>
                <td>{{ $dt->created_at }}</td>
                <td class="text-center">
                  @if($dt->course_payments->toArray() == null)
                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-primary" href="{{ route('student.complete_payment_information.show', [$dt->id]) }}">
                      Link
                    </a>
                  @elseif($dt->placement_test == null || $dt->placement_test->status == 'Not Passed')
                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-primary" href="{{ route('student.upload_placement_test.show', [$dt->id]) }}">
                      Link
                    </a>
                  @elseif($dt->placement_test->status == 'Passed' && $dt->session_registrations->toArray() == null)
                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-primary" href="{{ route('student.choose_course_registration.show', [$dt->id]) }}">
                      Link
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endif
@stop
