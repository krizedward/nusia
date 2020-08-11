@extends('layouts.admin.default')

@section('title','Admin | Sessions')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Sessions</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Sessions</li>
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
                        {{-- head table content
                        <tr>
                            <th></th>
                        </tr>
                        --}}
                        </thead>
                        <tbody>
                        {{-- body content
                            <tr>
                                <td></td>
                            </tr>
                        --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
