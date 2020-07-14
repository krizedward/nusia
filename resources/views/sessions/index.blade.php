@extends('layouts.admin.default')

@section('title','Session Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Session</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Session</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Session</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>course_id</th>
								<th>schedule_id</th>
								<th>title</th>
								<th>description</th>
								<th>requirement</th>
								<th>link_zoom</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->course_id }}</td>
								<td>{{ $dt->schedule_id }}</td>
								<td>{{ $dt->title }}</td>
								<td>{{ $dt->description }}</td>
								<td>{{ $dt->requirement }}</td>
								<td>{{ $dt->link_zoom }}</td>
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