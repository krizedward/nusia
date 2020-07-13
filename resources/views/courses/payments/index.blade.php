@extends('layouts.admin.default')

@section('title','Course Payment Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Course Payment </h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Course Payment </li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Course Payment </a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Course_Registration_id</th>
								<th>Method</th>
								<th>Payment Time</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Path</th>
								<th colspan="2" style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->course_registration_id }}</td>
								<td>{{ $dt->method }}</td>
								<td>{{ $dt->payment_time }}</td>
								<td>{{ $dt->amount }}</td>
								<td>{{ $dt->status }}</td>
								<td>{{ $dt->path }}</td>
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