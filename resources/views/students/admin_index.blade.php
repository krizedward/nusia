@extends('layouts.admin.default')

@section('title','Admin | Student')

{{-- @include('layouts.css_and_js.form_general') --}}

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Student</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">student</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header"></div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Profile Image</th>
                            <th>Job Status</th>
                            <th>Target Language Experience</th>
                            <th>Indonesian Language Proficiency</th>
                            <th>View Profile</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>

                                @if($dt->user->image_profile != 'user.jpg')
                                    <td><img src="{{ asset('uploads/student/profile/'.$dt->user->image_profile) }}" style="width: 50px"></td>
                                @else
                                    <td><img src="{{ asset('uploads/user.jpg') }}" style="width: 50px"></td>
                                @endif
                                {{--end if--}}
                                <td>{{ $dt->status_job }}</td>
                                @if($dt->target_language_experience == 'Never (no experience)')
                                    {{-- memperbaiki urutan sorting pada tabel. --}}
                                    <td><span class="hidden">.</span>{{ $dt->target_language_experience }}</td>
                                @elseif($dt->target_language_experience != 'Others')
                                    <td><span class="hidden">_</span>{{ $dt->target_language_experience }}</td>
                                @else
                                    <td>
                                        <span class="hidden">_</span>
                                        {{ $dt->target_language_experience_value }}
                                        @if($dt->target_language_experience_value == 1)
                                            year
                                        @else
                                            years
                                        @endif
                                    </td>
                                @endif
                                {{--end if--}}
                                <td>{{ $dt->indonesian_language_proficiency }}</td>
                                <td class="text-center">
                                    <a class="btn btn-flat btn-xs btn-success" href="{{ route('students.show', $dt->id) }}">Detail</a>
                                    <!--a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a-->
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
