@extends('layouts.admin.default')

@section('title','Dashboard')

@include('layouts.css_and_js.dashboard')

@section('content')
  @if(Auth::user()->citizenship == 'Not Available')
    <!-- Notification row -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <h4><i class="icon fa fa-book"></i> Trial Class Available!</h4>
          Nusia akan memberikan kesempatan 3 kelas gratis dengan memilih kelas bebas.
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Notification row -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible">
          <h4><i class="icon fa fa-book"></i> Account Confirmation Required</h4>
          Sebelum melakukan pendaftaran kelas, Anda diwajibkan untuk mengisi formulir pada bagian "Account Confirmation".
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Nusia Instructor</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach($session as $dt)
                <li>
                  <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Image">
                  <span class="users-list-name" href="#">{{ $dt->schedule->instructor->user->first_name }}</span>
                </li>
              @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{ route('instructors.index') }}" class="uppercase">View All Instructor</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!--/.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  @else
    <!-- Notification row -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
          <h4><i class="icon fa fa-book"></i> Trial Class Available!</h4>
          Nusia akan memberikan kesempatan 3 kelas gratis dengan memilih kelas bebas.
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Courses</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Session ID</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Session</th>
                    <th>Schedule</th>
                    <th>Link</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($session as $dt)
                    <tr>
                      <td>{{ $dt->code }}</td>
                      <td>{{ $dt->course->course_package->course_level->name }}</td>
                      <td>{{ $dt->course->course_package->course_level_detail->name }}</td>
                      {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                      <td>{{ $dt->title }}</td>
                      <td>{{ date('d M Y', strtotime($dt->schedule->schedule_time)) }}</td>
                      <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="{{ $dt->link_zoom }}">Link</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <a href="{{ route('session_registrations.index') }}" class="btn btn-sm btn-info btn-flat pull-left">View All Data</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
        <div class="row">
          <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Nusia Instructor</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <ul class="users-list clearfix">
                  @foreach($session as $dt)
                    <li>
                      <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Image">
                      <span class="users-list-name" href="#">{{ $dt->schedule->instructor->user->first_name }}</span>
                    </li>
                  @endforeach
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="{{ route('instructors.index') }}" class="uppercase">View All Instructor</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!--/.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <!-- Session-Course Reminder -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Download Course Materials</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion">
                  @foreach($course_registrations as $cr)
                    <div class="panel box box-default">
                      <div class="box-header with-border">
                        <p class="box-title" style="display:inline;">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $cr->code }}{{ $cr->id }}" aria-expanded="false" class="collapsed" style="color:#555555;">
                            @if($cr->course->title)
                              <p>{{ $cr->course->title }}</p>
                            @else
                              <p>{{ $cr->course->course_package->title }}</p>
                            @endif
                          </a>
                        </p>
                      </div>
                      <?php $i = 0; ?>
                      <div id="collapse{{ $cr->code }}{{ $cr->id }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <ul class="products-list product-list-in-box">
                            @foreach($cr->course->course_package->material_publics as $dt)
                              @if($dt->path)
                                <?php $i++ ?>
                                <li class="item">
                                  <div class="product-img">
                                    <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                                  </div>
                                  <div class="product-info">
                                    @if($cr->course->title)
                                      <div class="product-title">{{ $cr->course->title }} - {{ $dt->name }}</div>
                                    @else
                                      <div class="product-title">{{ $cr->course->course_package->title }} - {{ $dt->name }}</div>
                                    @endif
                                    <span class="product-description">
                                      <a target="_blank" rel="noopener noreferrer" href="{{ route('materials.download', ['Public', $dt->id]) }}">Download</a>
                                    </span>
                                  </div>
                                </li>
                                <!-- /.item -->
                              @endif
                            @endforeach
                            @foreach($cr->course->sessions as $s)
                              @foreach($s->material_sessions as $dt)
                                @if($dt->path)
                                  <?php $i++ ?>
                                  <li class="item">
                                    <div class="product-img">
                                      <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                      @if($s->title)
                                        <div class="product-title">{{ $s->title }} - {{ $dt->name }}</div>
                                      @elseif($s->course->title)
                                        <div class="product-title">{{ $s->course->title }} - {{ $dt->name }}</div>
                                      @else
                                        <div class="product-title">{{ $s->course->course_package->title }} - {{ $dt->name }}</div>
                                      @endif
                                      <span class="product-description">
                                        <a target="_blank" rel="noopener noreferrer" href="{{ route('materials.download', ['Session', $dt->id]) }}">Download</a>
                                      </span>
                                    </div>
                                  </li>
                                  <!-- /.item -->
                                @endif
                              @endforeach
                            @endforeach
                            @if($i == 0)
                              <div style="color:#555555">
                                No materials for this course.
                              </div>
                            @endif
                          </ul>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="{{ route('materials.index') }}" class="uppercase">View All Data</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <!-- Session-Course Reminder -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Reminder for course sessions</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              @foreach($session as $dt)
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('adminlte/dist/img/default-50x50.gif') }}" alt="Product Image">
                  </div>
                  <div class="product-info">
                    {{--session pakai attribut title untuk penamaan persession di halaman dashboard--}}
                    <div class="product-title">{{ $dt->course->course_package->course_level->name }} - {{ $dt->title }}
                      <span class="label label-info pull-right">{{ date('d M Y', strtotime($dt->schedule->schedule_time)) }}</span>
                    </div>
                    <span class="product-description">
                      Note : don't forget to join class.
                    </span>
                  </div>
                </li>
                <!-- /.item -->
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{ route('session_registrations.index') }}" class="uppercase">View All Data</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  @endif
@stop
