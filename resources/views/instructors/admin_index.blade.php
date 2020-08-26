@extends('layouts.admin.default')

@section('title','Admin | Instructor')

@include('layouts.css_and_js.form_general')

@section('content-header')
    <h1>Instructor</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Instructor</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <a href="{{ route('instructors.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Profile Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        {{-- head table content --}}
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                                @if($dt->user->image_profile)
                                    <td><img src="{{ asset('uploads/user.jpg') }}" style="width: 50px"></td>
                                @else
                                    <td><i>Not Available</i></td>
                                @endif
                                {{--end if--}}
                                <td>{{ $dt->user->email }}</td>
                                @if($dt->user->phone)
                                    <td>{{ $dt->user->phone }}</td>
                                @else
                                    <td><i>Not Available</i></td>
                                @endif
                                {{--end if--}}
                                <td>
                                    <a class="btn btn-flat btn-xs btn-success" href="{{ route('instructors.show', $dt->id) }}">Detail</a>
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
