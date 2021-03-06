@extends('layouts.admin.default')

@section('title','Nusantara Indonesia | Dashboard')

@include('layouts.css_and_js.all')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="callout callout-warning" style="color: #000 !important;">
			<h4>Dashboard</h4>
			<ol>
				<li>Melihat daftar transaksi (dan bukti pembayaran) yang di lakukan oleh Student pada course tertentu.</li>
				<ul>
					<li>Melihat daftar transaksi (dan informasi mengenai pendaftaran Student pada jenis course tertentu, setidaknya disampaikan daftar harga pada course yang diikuti tersebut).</li>
					<li>Melihat bukti pembayaran.</li>
					<li>Mengunduh bukti pembayaran.</li>	
				</ul>
				<li>Mengonfirmasi bahwa bukti pembayaran yang dikirim Student pada course tertentu, adalah sah (atau tidak)</li>
				<ul>
					<li>Mengonfirmasi sebagai "sah", sehingga Student dapat melanjutkan pada proses pendaftaran selanjutnya.</li>
					<li>Mengonfirmasi sebagai "tidak sah", sehingga Student dapat mengulangi proses unggah bukti pembayaran, atau menghubungi Financial Team (atau CS Team) untuk memperoleh informasi lebih lanjut.</li>
				</ul>
				<li>Tidak bisa mengedit ataupun menghapus transaksi.</li>
				<ul>
					<li>Mengonfirmasi bahwa Financial Team tidak dapat mengedit (memanipulasi) informasi transaksi dalam bentuk apapun.</li>
					<li>Mengonfirmasi bahwa Financial Team tidak dapat menghapus transaksi yang sudah dilakukan, dalam bentuk apapun.</li>
				</ul>
				<li>Memberikan refund kepada Student yang sudah termasuk level superior atau yang ingin melakukan pindah course (dilakukan sebelum sesi dimulai, dan konfirmasi 1 minggu sebelum sesi dimulai). Misalnya, pindah course dari "General Indonesian Language" ke "Language Partner".</li>
			</ol>
		</div>
	</div>
</div>
@stop