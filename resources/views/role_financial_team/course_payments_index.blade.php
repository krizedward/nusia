@extends('layouts.admin.default')

@section('title','Financial Team | Course Payment')

@include('layouts.css_and_js.all')

@section('content-header')
<h1><b>Course Payment</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('registered.dashboard.index') }}">Home</a></li>
        <li class="active">Course Payments</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
{{--
                    <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add</a>
--}}
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                        <table class="table table-bordered example1">
                          <thead>
                            <th>Payment Time</th>
                            <th>Student Name</th>
                            <th>Course Type</th>
                            <th>Price</th>
                            <th style="width:5%;">View</th>
                            <th style="width:5%;">Confirm</th>
                          </thead>
                          <tbody>
                            @foreach($course_payments as $dt)
                                <?php
                                  $today = \Carbon\Carbon::now()->setTimezone(Auth::user()->timezone);
                                  if($dt->course_registration->course_payments->first()->payment_time)
                                    $payment_time = \Carbon\Carbon::parse($dt->course_registration->course_payments->first()->payment_time)->setTimezone(Auth::user()->timezone);
                                  else $payment_time = null;
                                ?>
                                <tr>
                                  <td>
                                    @if($payment_time)
                                      <span class="hidden">{{ $payment_time->isoFormat('YYMMDDHHmm') }}</span>
                                      @if($payment_time->isoFormat('dddd, MMMM Do YYYY') == $today->isoFormat('dddd, MMMM Do YYYY'))
                                        Today, {{ $payment_time->isoFormat('hh:mm A') }}
                                      @else
                                        {{ $payment_time->isoFormat('dddd, MMMM Do YYYY, hh:mm A') }}
                                      @endif
                                    @else
                                      <span class="hidden">Z</span>
                                      <i class="text-muted">N/A</i>
                                    @endif
                                  </td>
                                  <td>{{ $dt->course_registration->student->user->first_name }} {{ $dt->course_registration->student->user->last_name }}</td>
                                  <td>{{ $dt->course_registration->course->course_package->title }}</td>
                                  <td>${{ $dt->course_registration->course_payments->first()->amount * $dt->course_registration->course->course_package->count_session }}</td>
                                  <td>
                                    <a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-warning btn-xs" href="{{ asset('uploads/student/payment/' . $dt->course_registration->course_payments->first()->path) }}">View</a>
                                  </td>
                                  <td class="text-center">
                                    {{--<a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('lead_instructor.student_registration.show', [$dt->course_registration_id]) }}">Detail</a>--}}
                                    @if($dt->course_registration->course_payments->first()->status != 'Confirmed')
                                      <form role="form" method="post" action="{{ route('financial_team.student_payment.update', [$dt->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" onclick="if(confirm('Are you sure to confirm the payment for this Student: {{ $dt->course_registration->student->user->first_name }} {{ $dt->course_registration->student->user->last_name }}, in {{ $dt->course_registration->course->course_package->title }}? This action cannot be undone.')) return true; else return false;" class="btn btn-flat btn-xs btn-primary">
                                          Confirm
                                        </button>
                                      </form>
                                    @else
                                      <button type="button" class="btn btn-flat btn-xs btn-default" disabled>
                                        Confirm
                                      </button>
                                    @endif
                                  </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
@stop
