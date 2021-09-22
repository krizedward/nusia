@extends('layouts.admin.default')

@section('title','Confirm Your Course Registration')

@include('layouts.css_and_js.all')

@section('content-header')
  {{--<h1><b>Proceed to Your Course Payment!</b></h1>--}}
  <h1><b>Confirm Your Course Registration!</b></h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Payment Note</b></h3>
        </div>
        <div class="box-body">
            <dl>
              <dt><i class="fa fa-credit-card margin-r-5"></i> Bank Transfer</dt>
              <dd>
                NUSIA Education accepts a payment method through
                <b>Bank Transfer, either e-banking, m-banking, or ATM</b>,
                covering local and international transfer.
                <b>The payment details are given upon confirmation.</b>
              </dd>
            </dl>
            <hr>
            <dl>
              <dt><i class="fa fa-file-text-o margin-r-5"></i> More Information</dt>
              <dd>
                <span style="color:#ff0000;">Contact NUSIA Finance if you encounter a problem.</span>
              </dd>
            </dl>
            <hr>
            <a href="{{ route('student.chat_financial_team.show', [89]) }}" target="_blank" class="btn btn-sm btn-flat btn-primary bg-blue" style="width:100%;" rel="noopener noreferrer">
              <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Chat NUSIA Finance
            </a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Receipt</b></h3>
          <small class="text-muted hidden-md hidden-lg hidden-xl"><br />
            (scroll the table horizontally to view price information)
          </small>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-hover">
            <tr style="vertical-align:baseline;">
              <td width="450">
                <b>{{ $course_registration->course->title }}</b>&nbsp;&nbsp;
                <a href="{{ route('student.choose_course.index', [$course_registration->id]) }}" class="btn btn-xs btn-primary bg-blue">
                  <i class="fa fa-edit"></i>&nbsp;&nbsp;Change Course
                </a>
              </td>
              <td width="250">
                <?php
                  $last_course_package_discount = null;
                  if($course_registration->course->course_package->course_package_discounts->toArray() != null) {
                    foreach(array_reverse($course_registration->course->course_package->course_package_discounts->toArray()) as $cpd) {
                      if($cpd['due_date'] == null) { $last_course_package_discount = $cpd; break; }
                      else if($cpd['due_date'] > now()) { $last_course_package_discount = $cpd; break; }
                    }
                  }
                ?>
                @if($last_course_package_discount)
                  <strike>${{ $course_registration->course->course_package->price }}</strike>
                  <b style="font-size:115%; color:#007700;">${{ $last_course_package_discount['price'] }}</b>
                  <b>
                    x {{ $course_registration->course->course_package->count_session }}
                    @if($course_registration->course->course_package->count_session == 1) session
                    @else sessions
                    @endif
                  </b>
                @else
                  <b>${{ $course_registration->course->course_package->price }}</b>
                  <b>
                    x {{ $course_registration->course->course_package->count_session }}
                    @if($course_registration->course->course_package->count_session == 1) session
                    @else sessions
                    @endif
                  </b>
                @endif
              </td>
              <td class="text-right">
                @if($last_course_package_discount)
                  <strike>${{ $course_registration->course->course_package->price * $course_registration->course->course_package->count_session }}</strike>
                  <b style="font-size:115%; color:#007700;">${{ $last_course_package_discount['price'] * $course_registration->course->course_package->count_session }}</b>
                @else
                  <b>${{ $course_registration->course->course_package->price * $course_registration->course->course_package->count_session }}</b>
                @endif
              </td>
            </tr>
            <tr style="vertical-align:baseline;">
              <td width="700" colspan="2"><b>Tax (no tax fee charged in this payment)</b></td>
              <td class="text-right"><b>$0</b></td>
            </tr>
            <tr style="vertical-align:baseline;" class="bg-gray">
              <td width="700" colspan="2"><b>TOTAL PAYMENT</b></td>
              <td class="text-right">
                @if($last_course_package_discount)
                  <b style="font-size:115%; color:#007700;">${{ $last_course_package_discount['price'] * $course_registration->course->course_package->count_session }}</b>
                @else
                  <b>${{ $course_registration->course->course_package->price * $course_registration->course->course_package->count_session }}</b>
                @endif
              </td>
            </tr>
          </table>
          <hr />
          <p style="color:#ff0000;">Upon confirmation, the course information can no longer be changed.</p>
          <a href="{{ route('student.upload_payment_evidence.show', $course_registration->id) }}" class="btn btn-flat btn-md bg-blue" style="width:100%;">
            Confirm Course Registration
          </a>
        </div>
      </div>
    </div>
  </div>
@stop
