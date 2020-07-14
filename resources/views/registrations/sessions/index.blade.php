@extends('layouts.admin.default')

@section('title','Session Registration Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Session Registration</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Session Registration</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Session Registration</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Session_id</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->session->title }}</td>
								<td>{{ $dt->session->course_id }}</td>
								<td>{{ $dt->session->schedule_id }}</td>
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