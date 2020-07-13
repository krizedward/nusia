@extends('layouts.admin.default')

@section('title','Rating Index')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1>Rating</h1>
	<ol class="breadcrumb">
	  <li><a href="{{ route('home') }}">Home</a></li>
	  <li class="active">Rating</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
					<a href="#" class="btn btn-flat btn-sm btn-primary">+ Add Rating</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>session_id</th>
								<th>rating</th>
								<th>comment</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dt)
							<tr>
								<td>{{ $dt->session_id }}</td>
								<td>{{ $dt->rating }}</td>
								<td>{{ $dt->comment }}</td>
								<td style="text-align: center;">
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