@extends('layouts.admin.default')

@section('title', 'Propose Schedules')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Propose Schedules</b></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
    <li class="active">Propose Schedules</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <?php
        $schedule_now = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
        /*$count = 0;
        foreach($instructor_schedules as $dt) {
          if($dt->schedule->session) {
            $schedule_time_end = \Carbon\Carbon::parse($dt->schedule->schedule_time)
              ->setTimezone(Auth::user()->timezone)
              ->add($dt->schedule->session->course->course_package->material_type->duration_in_minute, 'minutes');
            if($schedule_now <= $schedule_time_end) $count++;
          }
        }*/
      ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Add Teaching Availability</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ route('instructor.session_index.update', [1]) }}" method="post">
            @csrf
            @method('PUT')
            <div id="schedule_time_div" class="form-group @error('schedule_time_date') has-error @enderror @error('schedule_time_time') has-error @enderror">
              <label for="schedule_time_date">Schedule</label>
              <p class="text-red">The time schedule inputted is adjusted with your local time.</p>
              <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                @if(old('schedule_time_date'))
                  <input name="schedule_time_date" type="text" class="form-control pull-right datepicker" value="{{ old('schedule_time_date') }}">
                @else
                  <input name="schedule_time_date" type="text" class="form-control pull-right datepicker">
                @endif
              </div>
              <br />
              <div class="col-md-6 no-padding">
                <label for="schedule_time_time">From</label><br />
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                  @if(old('schedule_time_time'))
                    <input name="schedule_time_time" type="text" class="form-control pull-right timepicker" value="{{ old('schedule_time_time') }}">
                  @else
                    <input name="schedule_time_time" type="text" class="form-control pull-right timepicker">
                  @endif
                </div>
                {{--<br />--}}
              </div>
              <div class="col-md-1 no-padding">
                &nbsp;
              </div>
              <div class="col-md-5 no-padding">
                <label for="schedule_time_time_2">To</label><br />
                <div class="input-group">
                  {{--<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>--}}
                  @if(old('schedule_time_time_2'))
                    <input name="schedule_time_time_2" type="text" class="form-control pull-right timepicker" value="{{ old('schedule_time_time_2') }}">
                  @else
                    <input name="schedule_time_time_2" type="text" class="form-control pull-right timepicker">
                  @endif
                </div>
              </div>
              @error('schedule_time_date')
                <p style="color:red">{{ $message }}</p>
              @enderror
              @error('schedule_time_time')
                <p style="color:red">{{ $message }}</p>
              @enderror
              <br /><br /><br />
            </div>
            <hr />
            <div id="schedule_time_time_duration_1" class="form-group @error('schedule_time_time_duration_1') has-error @enderror @error('schedule_time_time_duration_1') has-error @enderror">
              <label for="schedule_time_time_duration_1">Indonesian Conversation (60 mins): ... session(s)</label>
              <select id="schedule_time_time_duration_1" name="schedule_time_time_duration_1" class="form-control select2">
                <option selected value="0">-- Choose duration --</option>
                @if(old('schedule_time_time_duration_1') == '0')
                  <option selected value="0">0 sessions</option>
                @else
                  <option value="0">0 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_1') == '1')
                  <option selected value="1">1 session</option>
                @else
                  <option value="1">1 session</option>
                @endif
                @if(old('schedule_time_time_duration_1') == '2')
                  <option selected value="2">2 sessions</option>
                @else
                  <option value="2">2 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_1') == '3')
                  <option selected value="3">3 sessions</option>
                @else
                  <option value="3">3 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_1') == '4')
                  <option selected value="4">4 sessions</option>
                @else
                  <option value="4">4 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_1') == '5')
                  <option selected value="5">5 sessions</option>
                @else
                  <option value="5">5 sessions</option>
                @endif
              </select>
            </div>
            <div id="schedule_time_time_duration_2" class="form-group @error('schedule_time_time_duration_2') has-error @enderror @error('schedule_time_time_duration_2') has-error @enderror">
              <label for="schedule_time_time_duration_2">Indonesian for Young and Teenage Learners (60 mins): ... session(s)</label>
              <select id="schedule_time_time_duration_2" name="schedule_time_time_duration_2" class="form-control select2">
                <option selected value="0">-- Choose duration --</option>
                @if(old('schedule_time_time_duration_2') == '0')
                  <option selected value="0">0 sessions</option>
                @else
                  <option value="0">0 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_2') == '1')
                  <option selected value="1">1 session</option>
                @else
                  <option value="1">1 session</option>
                @endif
                @if(old('schedule_time_time_duration_2') == '2')
                  <option selected value="2">2 sessions</option>
                @else
                  <option value="2">2 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_2') == '3')
                  <option selected value="3">3 sessions</option>
                @else
                  <option value="3">3 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_2') == '4')
                  <option selected value="4">4 sessions</option>
                @else
                  <option value="4">4 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_2') == '5')
                  <option selected value="5">5 sessions</option>
                @else
                  <option value="5">5 sessions</option>
                @endif
              </select>
            </div>
            <div id="schedule_time_time_duration_3" class="form-group @error('schedule_time_time_duration_3') has-error @enderror @error('schedule_time_time_duration_3') has-error @enderror">
              <label for="schedule_time_time_duration_3">Indonesian for Specific Purposes (60 mins): ... session(s)</label>
              <select id="schedule_time_time_duration_3" name="schedule_time_time_duration_3" class="form-control select2">
                <option selected value="0">-- Choose duration --</option>
                @if(old('schedule_time_time_duration_3') == '0')
                  <option selected value="0">0 sessions</option>
                @else
                  <option value="0">0 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_3') == '1')
                  <option selected value="1">1 session</option>
                @else
                  <option value="1">1 session</option>
                @endif
                @if(old('schedule_time_time_duration_3') == '2')
                  <option selected value="2">2 sessions</option>
                @else
                  <option value="2">2 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_3') == '3')
                  <option selected value="3">3 sessions</option>
                @else
                  <option value="3">3 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_3') == '4')
                  <option selected value="4">4 sessions</option>
                @else
                  <option value="4">4 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_3') == '5')
                  <option selected value="5">5 sessions</option>
                @else
                  <option value="5">5 sessions</option>
                @endif
              </select>
            </div>
            <div id="schedule_time_time_duration_4" class="form-group @error('schedule_time_time_duration_4') has-error @enderror @error('schedule_time_time_duration_4') has-error @enderror">
              <label for="schedule_time_time_duration_4">General Indonesian Language (90 mins): ... session(s)</label>
              <select id="schedule_time_time_duration_4" name="schedule_time_time_duration_4" class="form-control select2">
                <option selected value="0">-- Choose duration --</option>
                @if(old('schedule_time_time_duration_4') == '0')
                  <option selected value="0">0 sessions</option>
                @else
                  <option value="0">0 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_4') == '1')
                  <option selected value="1">1 session</option>
                @else
                  <option value="1">1 session</option>
                @endif
                @if(old('schedule_time_time_duration_4') == '2')
                  <option selected value="2">2 sessions</option>
                @else
                  <option value="2">2 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_4') == '3')
                  <option selected value="3">3 sessions</option>
                @else
                  <option value="3">3 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_4') == '4')
                  <option selected value="4">4 sessions</option>
                @else
                  <option value="4">4 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_4') == '5')
                  <option selected value="5">5 sessions</option>
                @else
                  <option value="5">5 sessions</option>
                @endif
              </select>
            </div>
            <div id="schedule_time_time_duration_5" class="form-group @error('schedule_time_time_duration_5') has-error @enderror @error('schedule_time_time_duration_5') has-error @enderror">
              <label for="schedule_time_time_duration_5">Sing with Us (90 mins): ... session(s)</label>
              <select id="schedule_time_time_duration_5" name="schedule_time_time_duration_5" class="form-control select2">
                <option selected value="0">-- Choose duration --</option>
                @if(old('schedule_time_time_duration_5') == '0')
                  <option selected value="0">0 sessions</option>
                @else
                  <option value="0">0 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_5') == '1')
                  <option selected value="1">1 session</option>
                @else
                  <option value="1">1 session</option>
                @endif
                @if(old('schedule_time_time_duration_5') == '2')
                  <option selected value="2">2 sessions</option>
                @else
                  <option value="2">2 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_5') == '3')
                  <option selected value="3">3 sessions</option>
                @else
                  <option value="3">3 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_5') == '4')
                  <option selected value="4">4 sessions</option>
                @else
                  <option value="4">4 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_5') == '5')
                  <option selected value="5">5 sessions</option>
                @else
                  <option value="5">5 sessions</option>
                @endif
              </select>
            </div>
            <div id="schedule_time_time_duration_6" class="form-group @error('schedule_time_time_duration_6') has-error @enderror @error('schedule_time_time_duration_6') has-error @enderror">
              <label for="schedule_time_time_duration_6">Dance with Us (90 mins): ... session(s)</label>
              <select id="schedule_time_time_duration_6" name="schedule_time_time_duration_6" class="form-control select2">
                <option selected value="0">-- Choose duration --</option>
                @if(old('schedule_time_time_duration_6') == '0')
                  <option selected value="0">0 sessions</option>
                @else
                  <option value="0">0 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_6') == '1')
                  <option selected value="1">1 session</option>
                @else
                  <option value="1">1 session</option>
                @endif
                @if(old('schedule_time_time_duration_6') == '2')
                  <option selected value="2">2 sessions</option>
                @else
                  <option value="2">2 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_6') == '3')
                  <option selected value="3">3 sessions</option>
                @else
                  <option value="3">3 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_6') == '4')
                  <option selected value="4">4 sessions</option>
                @else
                  <option value="4">4 sessions</option>
                @endif
                @if(old('schedule_time_time_duration_6') == '5')
                  <option selected value="5">5 sessions</option>
                @else
                  <option value="5">5 sessions</option>
                @endif
              </select>
            </div>
            <hr />
            <div id="multiplicity" class="form-group @error('multiplicity') has-error @enderror @error('multiplicity') has-error @enderror">
              <label for="multiplicity">Duration: ... month(s)</label>
              <select id="multiplicity" name="multiplicity" class="form-control select2">
                <option selected value="">-- Choose duration --</option>
                @if(old('multiplicity') == '1')
                  <option selected value="1">1 month</option>
                @else
                  <option value="1">1 month</option>
                @endif
                @if(old('multiplicity') == '2')
                  <option selected value="2">2 months</option>
                @else
                  <option value="2">2 months</option>
                @endif
                @if(old('multiplicity') == '3')
                  <option selected value="3">3 months</option>
                @else
                  <option value="3">3 months</option>
                @endif
                @if(old('multiplicity') == '4')
                  <option selected value="4">4 months</option>
                @else
                  <option value="4">4 months</option>
                @endif
                @if(old('multiplicity') == '5')
                  <option selected value="5">5 months</option>
                @else
                  <option value="5">5 months</option>
                @endif
                @if(old('multiplicity') == '6')
                  <option selected value="6">6 months</option>
                @else
                  <option value="6">6 months</option>
                @endif
                @if(old('multiplicity') == '7')
                  <option selected value="7">7 months</option>
                @else
                  <option value="7">7 months</option>
                @endif
                @if(old('multiplicity') == '8')
                  <option selected value="8">8 months</option>
                @else
                  <option value="8">8 months</option>
                @endif
                @if(old('multiplicity') == '9')
                  <option selected value="9">9 months</option>
                @else
                  <option value="9">9 months</option>
                @endif
                @if(old('multiplicity') == '10')
                  <option selected value="10">10 months</option>
                @else
                  <option value="10">10 months</option>
                @endif
                @if(old('multiplicity') == '11')
                  <option selected value="11">11 months</option>
                @else
                  <option value="11">11 months</option>
                @endif
                @if(old('multiplicity') == '12')
                  <option selected value="12">12 months</option>
                @else
                  <option value="12">12 months</option>
                @endif
              </select>
            </div>
            <button type="submit" class="btn btn-s btn-flat btn-primary" style="width:100%;">Submit</button>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#teaching_availability" data-toggle="tab"><b>Teaching Availability</b></a></li>
{{--
          <li><a href="#class_information" data-toggle="tab"><b>Class Information</b></a></li>
--}}
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="teaching_availability">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header">
                      <h3 class="box-title"><b>Proposed Schedules</b></h3>
                      {{--
                      <div>
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('registered.dashboard.index') }}">
                          <i class="fa fa-plus"></i>&nbsp;&nbsp;
                          Add User
                        </a>
                      </div>
                      --}}
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <strong><i class="fa fa-edit margin-r-5"></i> Types of Availability Status</strong>
                      <p>
                        <label data-toggle="tooltip" title class="label label-success" data-original-title="This schedule is available for another upcoming reservation.">Available</label>
                        <label data-toggle="tooltip" title class="label label-danger" data-original-title="This schedule is currently assigned to a session.">Busy</label>
                      </p>
                      <hr>
                      <table class="table table-bordered table-striped example1">
                        <thead>
                          <th>Meeting Time</th>
                          <th>IC 60</th>
                          <th>IYTL 60</th>
                          <th>ISP 60</th>
                          <th>GI 90</th>
                          <th>SING 90</th>
                          <th>DANCE 90</th>
                          <th>Status</th>
{{--
                          <th style="width:5%;">Delete</th>
--}}
                        </thead>
                        <tbody>
                          @if($instructor_schedules->toArray() != null)
                            @foreach($instructor_schedules as $dt)
                              <?php
                                $schedule_time_begin = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[0])->setTimezone(Auth::user()->timezone);
                                $schedule_time_begin_iso = $schedule_time_begin->isoFormat('dddd, MMMM Do YYYY, hh:mm A');
                                
                                $schedule_time_end = '';
                                $schedule_time_end_iso = '';
                                if(isset( explode('||', $dt->schedule->schedule_time)[1] )) {
                                    $schedule_time_end = \Carbon\Carbon::parse(explode('||', $dt->schedule->schedule_time)[1])->setTimezone(Auth::user()->timezone);
                                    $schedule_time_end_iso = $schedule_time_end->isoFormat('hh:mm A');
                                }

                              ?>
                              @if($schedule_now <= $schedule_time_begin)
                                <tr>
                                  <td>
                                    <span class="hidden">{{ $schedule_time_begin->isoFormat('YYMMDDHHmm') }}</span>
                                    @if($schedule_time_begin->isoFormat('dddd, MMMM Do YYYY') == $schedule_now->isoFormat('dddd, MMMM Do YYYY'))
                                      <b>(Today)</b>
                                    @endif
                                    {{ $schedule_time_begin_iso }} - {{ $schedule_time_end_iso }}
                                  </td>
                                  <td>
                                    @if(explode('||', $dt->schedule->schedule_time)[2] != 0)
                                      {{ explode('||', $dt->schedule->schedule_time)[2] }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td>
                                    @if(explode('||', $dt->schedule->schedule_time)[3] != 0)
                                      {{ explode('||', $dt->schedule->schedule_time)[3] }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td>
                                    @if(explode('||', $dt->schedule->schedule_time)[4] != 0)
                                      {{ explode('||', $dt->schedule->schedule_time)[4] }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td>
                                    @if(explode('||', $dt->schedule->schedule_time)[5] != 0)
                                      {{ explode('||', $dt->schedule->schedule_time)[5] }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td>
                                    @if(explode('||', $dt->schedule->schedule_time)[6] != 0)
                                      {{ explode('||', $dt->schedule->schedule_time)[6] }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td>
                                    @if(explode('||', $dt->schedule->schedule_time)[7] != 0)
                                      {{ explode('||', $dt->schedule->schedule_time)[7] }}
                                    @else
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if($dt->status == 'Available')
                                      @if($schedule_now <= $schedule_time_begin)
                                        <span class="hidden">1</span>
                                        <label data-toggle="tooltip" title class="label label-success" data-original-title="This schedule is available for another upcoming reservation.">Available</label>
                                      @endif
                                    @elseif($dt->status == 'Busy')
                                      @if($schedule_now <= $schedule_time_begin)
                                        <span class="hidden">3</span>
                                        <label data-toggle="tooltip" title class="label label-danger" data-original-title="This schedule is currently assigned to a session.">Busy</label>
                                      @endif
                                    @endif
                                  </td>
{{--
                                  <td class="text-center">
                                    @if($schedule_now <= $schedule_time_begin && $dt->status == 'Available')
                                      <span class="hidden">1</span>
                                      <form role="form" action="{{ route('instructor.schedule.destroy', [$dt->schedule_id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-flat btn-xs btn-danger" onclick="if(confirm('This schedule will be deleted: {{ $schedule_time_begin_iso }}.')) return true; else return false;"><i class="fa fa-trash"></i></button>
                                      </form>
                                    @else
                                      <span class="hidden">2</span>
                                      <a disabled class="btn btn-flat btn-xs btn-default btn-disabled" href="#"><i class="fa fa-trash"></i></a>
                                    @endif
                                  </td>
--}}
                                </tr>
                              @endif
                            @endforeach
                          @else
                            <p class="text-muted">No schedules available.</p>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          {{--
          <div class="tab-pane" id="teaching_availability">
            No info provided here
          </div>
          <!-- /.tab-pane -->
          --}}
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
