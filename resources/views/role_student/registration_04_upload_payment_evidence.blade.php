@extends('layouts.admin.default')

@section('title','Upload Your Payment Evidence')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Upload Your Payment Evidence!</b></h1>
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
                <b>Bank Transfer, either e-banking, m-banking, or ATM</b>.
                Below is information that might be needed
                for the local or international transfer:<br /><br />
                        <table>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Acc No.</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>8161238511</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Name</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>Nina Amalia Nurichsania</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Email</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>nusia.payment@gmail.com</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Bank</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>BANK CENTRAL ASIA (BCA)</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Branch</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>KCU Borobudur</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>City</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>Malang</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>Country</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>Indonesia</td>
                          </tr>
                          <tr style="vertical-align:baseline;">
                            <td width="45"><b>SWIFT</b></td>
                            <td>&nbsp;:&nbsp;&nbsp;</td>
                            <td>CENAIDJA</td>
                          </tr>
                        </table>
                <br />
                We suggest a provider, such as <b>TransferWise</b> to avoid international money transfer fees.
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
{{--
                <a href="{{ route('student.choose_course.index', [$course_registration->id]) }}" class="btn btn-xs btn-info">
                  <i class="fa fa-edit"></i>&nbsp;&nbsp;Change Course
                </a>
--}}
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
          <hr>
          <form role="form" method="post" action="{{ route('student.upload_payment_evidence.update', [$course_registration->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="row">
                {{--Form Kiri--}}
                <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-group @error('account_number') has-error @enderror">
                      <label for="account_number">Your Account Number</label>
                      <input name="account_number" type="text" class="@error('account_number') is-invalid @enderror form-control" placeholder="Enter Your Account Number" value="{{ old('account_number') }}">
                      @error('indonesian_language_proficiency')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                {{--Form Kanan--}}
                <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-group @error('account_name') has-error @enderror">
                      <label for="account_name">Your Account Name</label>
                      <input name="account_name" type="text" class="@error('account_name') is-invalid @enderror form-control" placeholder="Enter Your Account Name" value="{{ old('account_name') }}">
                      @error('account_name')
                        <p style="color:red">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                {{--Form Tengah--}}
                <div class="col-md-12">
                  <div class="col-md-12">
                    <label for="payment_evidence" class="control-label">Upload Payment Evidence (image only)</label>
                    <p style="color:#ff0000; padding-top:0px; margin-top:0px;">*Maximum file size allowed is 8 MB</p>
                    <input id="payment_evidence" name="payment_evidence" type="file" accept="image/*" class="@error('payment_evidence') is-invalid @enderror form-control">
                    @error('payment_evidence')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;" onclick="if(document.getElementById('payment_evidence').value == '') { alert('The payment evidence cannot be empty.'); return false; } if( confirm('Are you sure to upload this payment evidence? This action cannot be undone.') ) return true; else return false;">
                Upload Payment Evidence
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
