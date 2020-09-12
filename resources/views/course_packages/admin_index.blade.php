@extends('layouts.admin.default')

@section('title','Admin | Course Packages')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Course Packages</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Course Packages</li>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        {{-- head table content--}}
                        </thead>
                        <tbody>
                        @foreach($course_package as $dt)
                        <tr>
                            <td>{{ $dt->code }}</td>
                            <td>{{ $dt->title }}</td>
                            <td>
                            	<a href="{{ route('course_packages.show',[$dt->id]) }}">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                        {{-- body content--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
