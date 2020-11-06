@extends('layouts.admin.default')

@section('title','Nusantara Indonesia | Dashboard')

{{-- @include('layouts.css_and_js.dashboard') --}}

@include('layouts.css_and_js.table')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="callout callout-warning" style="color: #000 !important;">
			<h4>Dashboard</h4>
			<ol>
				<li>Melihat daftar Student (termasuk email) dan status registrasi Student.</li>
				<ul>
					<li>Melihat daftar Student (termasuk email).</li>
					<li>Melihat status registrasi Student (apakah sudah terdaftar, atau masih dalam proses pembuatan akun pada tahap tertentu).</li>	
				</ul>
				<li>Melihat informasi profil Student.</li>
				<ul>
					<li>Melihat informasi profil Student.</li>
				</ul>
				<li>Melihat pendaftaran satu Student pada course tertentu.</li>
				<ul>
					<li>Melihat daftar course yang diikuti oleh satu Student.</li>
					<li>Melihat informasi detail dari masing-masing course yang diikuti oleh Student tersebut.</li>
				</ul>
				<li>Melihat daftar course dan pendaftaran satu atau beberapa Student pada masing-masing course.</li>
				<ul>
					<li>Melihat daftar course secara keseluruhan, dalam bentuk tabel (atau serupa itu).</li>
					<li>Menata klasifikasi course agar lebih spesifik dan tidak tercampur pada satu tabel yang sama.</li>
					<li>Melihat daftar Student yang mengikuti satu course tertentu.</li>
					<li>Setelah melihat daftar Student yang mengikuti satu course tertentu, kemudian melihat profil Student yang bersangkutan.</li>
				</ul>
				<li>Menggunakan fitur chatbox untuk membuat template email untuk disampaikan kepada setiap Lead Instructor, Instructor, atau Student pada waktu diperlukan. Penyampaian email dilakukan oleh sistem secara otomatis dalam durasi tertentu sebelum/setelah peristiwa tertentu (misal, sebelum kelas dimulai, atau setelah sertifikat selesai diunggah).</li>
				<ul>
					<li>Mengedit fitur chatbox.</li>
					<li>Menyusun mekanisme penataan durasi pengiriman email secara otomatis pada waktu tertentu.</li>
					<li>Melakukan tes pengiriman email.</li>
				</ul>
				<li>Menggunakan fitur chatbox untuk menulis email kepada perorangan (Lead Instructor, Instructor, atau Student), atau kepada grup (dikelompokkan untuk setiap course, proficiency level, tipe kelas private/group, atau jenis pembelajaran course General Indonesian Language, Language Partner, dsb), secara manual.</li>
				<ul>
					<li>Mengedit fitur chatbox.</li>
					<li>Menyusun mekanisme pengiriman email dalam bentuk one-on-one.</li>
					<li>Menyusun mekanisme pengiriman email dalam bentuk grup.</li>
					<li>Melakukan tes pengiriman email.</li>
				</ul>
				<li>Mengunggah dokumen sertifikat untuk setiap Student yang telah menyelesaikan course (dan sesuai kriteria ketuntasan minimal yang disepakati dalam kebijakan perolehan sertifikat).</li>
				<ul>
					<li>Pada tampilan untuk "melihat daftar Student yang mengikuti satu course tertentu", tampilkan status sertifikat (apakah sudah diunggah atau belum).</li>
					<li>Menambahkan opsi bagi CS Team untuk mengunggah dokumen sertifikat.</li>
					<li>Menambahkan opsi bagi CS Team untuk melakukan replace dokumen sertifikat (apabila diganti, atau salah unggah dokumen).</li>
				</ul>
				<li>Tidak bisa mengedit informasi profil student dan informasi course.</li>
				<ul>
					<li>Mengonfirmasi bahwa CS Team tidak dapat mengedit informasi profil Student.</li>
					<li>Mengonfirmasi bahwa CS Team tidak dapat mengedit informasi course.</li>
				</ul>
			</ol>
		</div>
	</div>
</div>
@stop