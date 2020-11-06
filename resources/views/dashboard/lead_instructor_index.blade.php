@extends('layouts.admin.default')

@section('title','Nusantara Indonesia | Dashboard')

{{-- @include('layouts.css_and_js.dashboard') --}}

@include('layouts.css_and_js.table')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-warning" style="color: #000 !important;">
	        	<h4>Dashboard Lead Instructor</h4>
	        	<p>Apa Saja Yang Bisa Di Lakukan Lead Instructor</p>
	        	<ol>
	        		<li>Melihat daftar course yang diajar (dan daftar sesi untuk masing-masing course).</li>
	        		<li>Menentukan (dan mengubah, jika diperlukan) jadwal 15 sesi (secara langsung) untuk private course. Apabila dilakukan perubahan, maka notifikasi dikirim dalam bentuk email kepada Student yang menghadiri course ybs.</li>
	        		<li>Melihat daftar dan profil Student pada masing-masing course yang diajar.</li>
	        		<li>Melakukan absensi Student untuk setiap sesi pada course yang diajar. Tidak semua sesi memiliki formulir feedback untuk diisi oleh Student. Fitur rating diperlukan untuk masing-masing sesi (serta memberikan comment), tetapi hanya 2 pertanyaan: "Rating berapa?" dan "Sampaikan komentar kepada Instructor:".</li>
	        		<li>Melihat status pengisian formulir feedback oleh Student (setelah pelaksanaan mid-test dan final-test).</li>
	        		<li>Melihat status pengisian formulir feedback oleh Student (setelah pelaksanaan mid-test dan final-test).</li>
	        		<li>Mengunggah supplementary material pada masing-masing sesi, pada masing-masing course, sebagaimana dibutuhkan.</li>
	        		<li>Mengunggah judul, deskripsi (opsional), dan dokumen assignment Student (serta durasi pengerjaan), pada masing-masing sesi (opsional), pada masing-masing course (opsional), sebagaimana dibutuhkan.</li>
	        		<li>Mengunggah judul, deskripsi (opsional), dan dokumen mid-exam dan final-exam Student (serta durasi pengerjaan), pada masing-masing sesi (opsional), pada masing-masing course (opsional), sebagaimana dibutuhkan.</li>
	        		<li>Mengunggah link video conference pada masing-masing sesi, pada masing-masing course yang diajar.</li>
	        		<li>Melakukan reschedule jadwal untuk sesi yang harus diubah jadwalnya karena satu dan lain hal, harap memeriksa hasil meeting 26 September 2020 (ini berlaku hanya untuk kelas private).</li>
	        		<li>Melihat inbox (dan membalas email) dari CS Team yang ditujukan kepada Instructor.</li>
	        		<li>Menggunakan fitur chatbox untuk menghubungi Student yang diajar. Chatbox dihubungkan ke email (boleh disesuaikan kembali).</li>
	        		<li>(ditambahkan fitur untuk melihat Instructor schedule, dalam bentuk kalender dan grid/tabel). Untuk masing-masing jadwal sesi (untuk setiap course yang diajar),</li>
	        	</ol>
      		</div>
		</div>
	</div>
@stop
