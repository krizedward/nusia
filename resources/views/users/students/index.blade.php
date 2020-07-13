@extends('layouts.admin.default')

@section('title','Student Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Student</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Student</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Student</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Gender</th>
								<th colspan="2" style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
								<td>{{ $dt->user->email }}</td>
								<td>{{ $dt->user->gender }}</td>
								<td style="text-align: center;">
			                     <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
			                   	</td>
			                   	<td style="text-align: center;">
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