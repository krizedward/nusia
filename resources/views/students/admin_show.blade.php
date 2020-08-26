@extends('layouts.admin.default')

@section('title','Admin | Student | Show')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Student</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('students.index',1) }}">Student</a></li>
        <li class="active">Detail</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body">
                    <img class="img-responsive pad" src="{{ asset('uploads/user.jpg') }}" alt="Photo">
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Data</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        @foreach($student as $dt)
                        <strong><i class="fa fa-circle-o margin-r-5"></i> Name :
                            {{ $dt->id }}
                        </strong><hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Age :
                            {{ $dt->age }}
                        </strong><hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Interest :
                            @if($dt->interest)
                                <?php
                                $interest = explode(', ', $dt->interest);
                                ?>
                                @for($i = 0; $i < count($interest); $i = $i + 1)
                                  {{ $i + 1 }}. {{ $interest[$i] }}
                                    @if($i + 1 != count($interest))
                                         <br>
                                    @endif
                                @endfor
                            @else
                                <td><i>Not Available</i></td>
                            @endif
                        </strong><hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Job Status :
                            {{ $dt->status_job }}
                        </strong><hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Target Language Experience :
                            {{ $dt->target_language_experience }}
                        </strong><hr>

                        <strong><i class="fa fa-circle-o margin-r-5"></i> Indonesian Language Proficiency :
                            {{ $dt->target_language_experience }}
                        </strong><hr>
                        @endforeach
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

