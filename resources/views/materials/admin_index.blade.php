@extends('layouts.admin.default')

@section('title','Admin | Material')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Material</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Material</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('material_publics.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add Material Public</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Path</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($public as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>{{ $dt->description }}</td>
                                <td>{{ $dt->path }}</td>
                            </tr>
                            {{-- body content --}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--End Material Public--}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('material_publics.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add Material Sessions</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Path</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($session as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>{{ $dt->description }}</td>
                                <td>{{ $dt->path }}</td>
                            </tr>
                            {{-- body content --}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--End Material Session--}}
@stop
