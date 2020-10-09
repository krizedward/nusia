@extends('layouts.admin.default')

@section('title','Admin | Choose Instructor')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1><b>Choose Instructor For More Schedule</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('schedules.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Instructor Name</th>
                            <th>Detail</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                                <td>
                                    <a class="btn btn-flat btn-xs btn-success" href="{{ route('schedules.admin_index',$dt->code) }}">Detail</a>
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
