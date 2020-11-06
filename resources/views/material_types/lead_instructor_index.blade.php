@extends('layouts.admin.default')

@section('title','Lead Instructor | Material')

@include('layouts.css_and_js.form_general')

@section('content-header')
<h1><b>Material</b></h1>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="callout callout-warning" style="color: #000 !important;">
			<h4>Material</h4>
			<ol>
				<li>Mengunggah judul, deskripsi (opsional), dan dokumen assignment Student (serta durasi pengerjaan), pada masing-masing sesi (opsional), pada masing-masing course (opsional), sebagaimana dibutuhkan.</li>
				<li>Mengunggah supplementary material pada masing-masing sesi, pada masing-masing course, sebagaimana dibutuhkan.</li>
			</ol>
		</div>
	</div>
</div>
@stop