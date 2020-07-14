@extends('layouts.admin.default')

@section('title','Course Registration Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Course Registration</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Course Registration</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Registration</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Id</th>
								<th>Course Title</th>
								<th>Course Level</th>
								<th>Course Type</th>
								<th>Student Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->id }}</td>
								<td>{{ $dt->course->title }}</td>
								<td>{{ $dt->course->course_package->course_level->name }}</td>
								<td>{{ $dt->course->course_package->course_type->name }}</td>
								<td>{{ $dt->student->user->first_name }}</td>
								<td>
			                     <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
			                     <a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a>
			                   	</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
@stop