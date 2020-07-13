@extends('layouts.admin.default')

@section('title','Course Packages Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Course Packages</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Course Packages</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Packages</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>material_type_id</th>
								<th>course_type_id</th>
								<th>course_level_id</th>
								<th>course_level_detail_id</th>
								<th>status</th>
								<th>title</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->material_type_id }}</td>
								<td>{{ $dt->course_type_id }}</td>
								<td>{{ $dt->course_level_id }}</td>
								<td>{{ $dt->course_level_detail_id }}</td>
								<td>{{ $dt->status }}</td>
								<td>{{ $dt->title }}</td>
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