@extends('layouts.admin.default')

@section('title','Student | Language Programs')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Choose Your Language Program!</h1>
    <!--ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Choose Your Language Program!</li>
    </ol-->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissable">
            <h4>
              <i class="icon fa fa-comments"></i>
              Choose a language program at your convenience!
            </h4>
            Join one of NUSIA's language programs consisting of <b>more than 3 sessions per class</b>! Per session lasts <b>80 minutes</b>.
          </div>
        </div>
        <div class="col-md-12" style="margin:0;">
          <div class="alert alert-primary bg-purple alert-dismissable">
            <h4>
              <i class="icon fa fa-book"></i>
              What to learn in these programs?
            </h4>
            @foreach($material_types as $i => $mt)
              <b>{{ $mt->name }}</b><br>
              {{ $mt->description }}<br>
            @endforeach
          </div>
        </div>
        @foreach($material_types as $mt)
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ $mt->name }}</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    {{-- More pictures? Mungkin menambah beberapa gambar di sini, seperti di satu saran feedback Student? --}}
                    <!--div class="col-md-12">
                      <b>Description</b>
                      <p>{{ $mt->description }}</p>
                    </div-->
                    <div class="col-md-12">
                      <a href="#" data-toggle="modal" data-target="#{{$mt->id}}" class="btn btn-s btn-primary" style="width:100%;">
                        View More
                      </a>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->

        <div class="modal fade" id="{{$mt->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <h3 class="profile-username text-center">{{ $mt->name }}</h3>

                            <p class="text-muted text-center">Program description follows.</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    {{ $mt->description }}
                                </li>
                            </ul>
                            <a href="{{ route('course_packages.index_material_type', $mt->id) }}" class="btn btn-s btn-primary" style="width:100%;">Choose This Program</a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        @endforeach
    </div>
@stop