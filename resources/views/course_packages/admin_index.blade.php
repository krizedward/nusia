@extends('layouts.admin.default')

@section('title','Admin | Class Package')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Class Packages</b></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Class Packages</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="#" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                      Add New Class Package
                    </a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Title</th>
                            <th style="width:50px;">Action</th>
                        </tr>
                        {{-- head table content--}}
                        </thead>
                        <tbody>
                        @foreach($course_package as $i => $dt)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $dt->title }}</td>
                            <td class="text-center">
                            	<a href="{{ route('course_packages.show',[$dt->id]) }}" class="btn btn-xs btn-flat btn-success">Detail</a>
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
