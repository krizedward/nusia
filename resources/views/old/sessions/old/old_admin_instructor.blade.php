@extends('layouts.admin.default')

@section('title','Admin | Sessions')

@include('layouts.css_and_js.table')

@section('content-header')
    <h1>Sessions</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
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
                                    <a href="{{ route('sessions.admin_index',$dt->code) }}">Detail</a>
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
