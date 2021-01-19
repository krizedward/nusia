@extends('layouts.admin.default')

@section('title', 'New Course Registration')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Choose the right course for your needs!</b></h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#overview" data-toggle="tab"><b>Overview</b></a></li>
          <li><a href="#sessions" data-toggle="tab"><b>Sessions</b></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="overview">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at </h3>
                    <p class="no-margin">
                      Includes
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Registration Time</strong>
                    <p>
                      <table>
                        <tr>
                          <td><b>Day</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                        <tr>
                          <td><b>Date</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-credit-card margin-r-5"></i> Course Payment</strong>
                    <p>
                      <table>
                        <tr>
                          <td><b>Price</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                        <tr>
                          <td><b>Status</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                        <tr>
                          <td><b>Paid at</b></td>
                          <td>&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                      </table>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-video-o margin-r-5"></i> Student Placement Test</strong>
                    <p>
                      <table>
                        <tr>
                          <td><b>Link</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                        <tr>
                          <td><b>Result</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                        <tr>
                          <td><b>Final Level</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                        <tr>
                          <td><b>Updated at</b></td>
                          <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                          <td>Text</td>
                        </tr>
                      </table>
                    </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
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
                      <h3 class="box-title">Text</h3>
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
                      <h3 class="box-title">Text</h3>
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
          <div class="tab-pane" id="sessions">
            <div class="row">
              <div class="col-md-3">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Registered at</h3>
                    <p class="no-margin">
                      Includes
                    </p>
                  </div>
                  <!-- /.box-header -->
                  <form>
                    <div class="box-body">
                      <dl>
                        <dt>
                          <i class="fa fa-user-circle-o margin-r-5"></i> Note
                        </dt>
                        <dd>
                          Click "link" button to join your session!<br />
                          After each session, click on "form" button to give feedbacks per session!<br />
                          Please consider that three days after each session ends, the "form" button will eventually disappear.<br />
                          <span style="color:#ff0000;">* Contact your instructor if you encounter a problem.</span>
                        </dd>
                      </dl>
                      {{--
                      <hr>
                      --}}
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-9">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Calendar</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Tampilkan kalender pada bagian ini.</p>
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Schedules</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr>
                        <th style="width:2%;" class="text-right">#</th>
                        <th>Title</th>
                        <th>Time</th>
                        <th style="width:5%;">Link</th>
                      </tr>
                      <tr>
                        <td class="text-right">Text</td>
                        <td>Text</td>
                        <td>Text</td>
                        <td class="text-center">Text</td>
                      </tr>
                    </table>
                    <div class="text-center">No data available.</div>
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b>Attendance Information</b></h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr>
                        <th style="width:2%;" class="text-right">#</th>
                        <th>Title</th>
                        <th style="width:20%;">Attendance</th>
                      </tr>
                      <tr>
                        <td class="text-right">Text</td>
                        <td>Text</td>
                        <td>Text</td>
                      </tr>
                    </table>
                    <div class="text-center">No data available.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@stop
