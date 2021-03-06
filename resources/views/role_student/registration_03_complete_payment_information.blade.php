@extends('layouts.admin.default')

@section('title','Filling Payment Information')

@include('layouts.css_and_js.all')

@section('content-header')
  <h1><b>Proceed to Your Course Payment!</b></h1>
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
          <h3 class="box-title"><b>Billing Information</b></h3>
        </div>
        <form role="form" method="post" action="{{ route('student.upload_placement_test.update', [$course_registration->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="box-body">
            <div class="row">
              {{--Form Kiri--}}
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group @error('indonesian_language_proficiency') has-error @enderror">
                    <label for="indonesian_language_proficiency">Indonesian Language Proficiency (Self-assessment)</label>
                    <input id="indonesian_language_proficiency" name="indonesian_language_proficiency" type="text" class="@error('indonesian_language_proficiency') is-invalid @enderror form-control" disabled value="{{ Auth::user()->student->indonesian_language_proficiency }}">
                    @error('indonesian_language_proficiency')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
              {{--Form Kanan--}}
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group @error('video_link') has-error @enderror">
                    <label for="video_link">Video Link (https)</label>
                    <input id="video_link" name="video_link" type="text" class="@error('video_link') is-invalid @enderror form-control" placeholder="Enter Video Link (https link only)" value="{{ old('video_link') }}">
                    @error('video_link')
                      <p style="color:red">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-flat btn-md bg-blue" style="width:100%;" onclick="if(document.getElementById('video_link').value == '') { alert('The video link cannot be empty.'); return false; } if( confirm('Are you sure to submit this link: ' + document.getElementById('video_link').value + '?') ) return true; else return false;">
              Submit
            </button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
@stop
