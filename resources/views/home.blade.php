@extends('layouts.admin.default')

@section('title','Dashboard')

@section('content')
@if(Auth::user()->level == 'instructor')
<p>Hello Instructor</p>
@endif

@if(Auth::user()->level == 'student')
<p>Hello Students</p>
@endif

@if(Auth::user()->level == 'admin')
<p>Hello Admin</p>
@endif
@endsection