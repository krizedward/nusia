@extends('layouts.admin.default')

@section('title','Lead Instructor | Schedule')

@include('layouts.css_and_js.table')

@section('content-header')
<h1><b>Schedule</b></h1>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="callout callout-warning" style="color: #000 !important;">
			<h4>Info</h4>
			<ol>
				<li>Melihat daftar course yang diajar (dan daftar sesi untuk masing-masing course).</li>
				<li>Melihat daftar dan profil Student pada masing-masing course yang diajar.</li>
			</ol>
		</div>
		
	</div>
	<div class="col-md-12">
        <div class="box with-border">
            <div class="box-header">
                <div class="box-title">Schedule Student</div>
            </div>

            <div class="box-body">
                <p>This Body Back</p>
            </div>

            <div class="box-footer">
                <p>This is Footer</p>
            </div>
        </div> 
    </div>
</div>
@stop