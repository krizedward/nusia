@extends('layouts.admin.default')
@section('title','Schedule Index')
@include('layouts.css_and_js.table')
@section('content-header')
    <h1>Registration Group Class</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Registration</li>
    </ol>
@stop
