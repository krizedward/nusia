@extends('layouts.admin.default')

@section('title','Admin | Material Sessions')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Material Sessions</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Material Sessions</li>
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
                            <th>ID</th>
                            <th>Session</th>
                            <th>File Name</th>
                            <th>Data Type</th>
                            <th>Action</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($material_session as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->session->title }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>PDF</td>
                                <td>
                                    <a class="btn btn-flat btn-xs btn-success" href="#">Details</a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- body content --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
