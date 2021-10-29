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
                    <a href="#" class="btn btn-flat btn-sm btn-primary">+ Add</a>
                </div>
                <div class="box-body">
                        <table class="table table-bordered example1">
                          <thead>
                            <th>Student Name</th>
                            <th style="width:5%;">Confirm</th>
                          </thead>
                          <tbody>
                            @foreach($course_payments as $dt)
                                <tr>
                                  <td>{{ $dt->course_registration->student->user->first_name }} {{ $dt->course_registration->student->user->last_name }}</td>
                                  <td class="text-center">
                                    {{--<a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('lead_instructor.student_registration.show', [$dt->course_registration_id]) }}">Detail</a>--}}
<form role="form" method="post" action="{{ route('financial_team.student_payment.update', [$dt->id]) }}">
  @csrf
  @method('PUT')
                <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;">
                  Confirm
                </button>
</form>
                                  </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@stop
