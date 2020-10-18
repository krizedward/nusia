@extends('layouts.admin.default')

@section('title','Student | Courses')

@include('layouts.css_and_js.table')

@section('content-header')
	<h1><b>Choose Your Course</b></h1>
@stop

@section('content')
	<div class="row">
            @foreach($material_types as $mt)
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title"><b>{{ $mt->name }}</b></h3>
		                </div>
		                <div class="box-body">
		                	<p>{{ $mt->description }}</p>
		                	<!--ul>
                				<li>Lorem ipsum dolor sit amet</li>
				                <li>Consectetur adipiscing elit</li>
				                <li>Integer molestie lorem at massa</li>
		                		<li>Facilisis in pretium nisl aliquet</li>
				                <li>Nulla volutpat aliquam velit</li>
				                <li>Faucibus porta lacus fringilla vel</li>
		                		<li>Aenean sit amet erat nunc</li>
				                <li>Eget porttitor lorem</li>
					</ul-->
		                </div>
		                <div class="box-footer">
                			<a href="{{ route('student.choose_course_types', $mt->id) }}" class="btn btn-primary btn-block"><b>Choose This Course</b></a>	
		                </div>
			</div>
		</div>
            @endforeach
	</div>
@stop