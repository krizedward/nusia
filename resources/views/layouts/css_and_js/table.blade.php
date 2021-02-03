@push('style')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Sweetalert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

  <!-- Intro.js -->
  <link {{-- rel="stylesheet" --}} type="text/css" href="https://unpkg.com/intro.js/minified/introjs.min.css">
  <script type="text/javascript" src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
 

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endpush

@push('script')
  <!-- jQuery 3 -->
  <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
  <!-- page script -->
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
      $('.example1').DataTable({
        'deferRender'    : true,  // optimisasi untuk load data dalam jumlah besar
        'processing'     : true,  // menunjukkan indikator pada waktu tabel masih proses load data
        //'scrollX'        : true,  // show tabel pada viewport yang dapat di-scroll secara horizontal pada waktu tampilan tidak mencukupi (baik. Perlu disesuaikan secara manual mengenai width masing-masing kolom). Saat ini, fungsi ini di-disable, karena (sebagai pertimbangan), apakah user akan melakukan scrolling secara horizontal? Maka sebaiknya menunjukkan dulu bahwa ada fitur tersebut. Jika tidak/belum ditunjukkan, perkecil ukuran tabel khususnya untuk disesuaikan pada tampilan mobile dan tablet
        'scrollY'        : '',    // default value adalah '', diisi unit CSS, untuk membatasi ukuran <tbody> pada height tertentu apabila diperlukan untuk dibatasi
        'scrollCollapse' : false, // default value adalah false. Jika true, maka waktu menggunakan scrollY dan data berjumlah lebih sedikit, maka ukuran tabel akan menyesuaikan dengan ukuran yang disebutkan dalam parameter scrollY
        'stateSave'      : false, // default: false. jika true, maka pada waktu tabel di-refresh, akan kembali ke state sebelum di-refresh, tidak kembali ke kondisi page 1 dan kondisi awal, kecuali jika ID tabel berubah, atau URL berubah (mohon diperhatikan, record waktu search juga tetap disimpan, mungkin inconvenience untuk beberapa user apabila memang tidak sedang diperlukan)
        //'stateDuration'  : 7200,  // default: 7200. jika -1 maka sessionStorage digunakan, jika 0 atau lebih besar maka localStorage digunakan. Value diberikan dalam satuan seconds (s). Angka 0 berarti state dapat disimpan tanpa batas waktu. Gunakan opsi ini apabila fitur 'stateSave' bernilai true, bukan false
        'lengthMenu'     : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ], // digunakan untuk menentukan angka-angka pagination (10, 25, 50, 100, "All", dsb), untuk penulisan "All", dibuat 2 array: array ke-1 untuk simpan angka yang diperlukan, array ke-2 untuk simpan string yang ditampilkan sebagai front-end filter ke user
        'pagingType'     : 'simple_numbers',  // jenis tampilan pagination. Default adalah 'simple_numbers' (tombol previous dan next, serta page number), untuk 'full_numbers', tombol first, previous, next, dan last, serta page number, sementara untuk 'first_last_numbers', tombol first dan last, serta page number (dan ada beberapa value lain). Untuk mengubah jumlah page number yang di-display pada pagination bar, jalankan kode ini ($.fn.DataTable.ext.pager.numbers_length = 9;) setelah library DataTables di-load (ya, dapat diterapkan pada file ini). untuk angka 9 dapat diganti bilangan ganjil, hanya boleh bilangan ganjil
        'search'         : {
          'caseInsensitive'  : true, // default value adalah true. jika false, maka fitur search dilakukan secara case-sensitive. jika true, maka huruf kapital dan kecil dianggap sama saja
          'regex'            : true, // default value adalah false. jika true, maka fitur search dapat menggunakan query dalam bentuk regular expression (misal menggunakan tanda [A, B, C] untuk mencari row yang memiliki huruf A, B, ATAU C, tidak harus A, B, dan C). jika false, maka pencarian regex di-disable
          'smart'            : true, // default value adalah true. jika false, maka fitur search hanya melakukan perbandingan string biasa, entah case-sensitive atau tidak (kecuali, jika diaktifkan opsi 'regex' menggantikan opsi ini, karena opsi smart filtering ini juga menggunakan complex regex)
        },
        'searchDelay'    : null,  // default value adalah null, dapat diganti integer (angka saja, bukan string) dengan satuan miliseconds (ms), misal 350 maka dianggap 350 ms. opsi ini digunakan untuk memberi delay pada waktu user menekan tombol keyboard di fitur search, per keypress. untuk value null, DataTable memproses sesuai dengan processing mode (jika client-side processing, instant atau 0 ms; jika server-side processing, 400 ms, sehingga lebih lambat, tetapi server-side dapat digunakan untuk mengoperasikan search pada row dalam jumlah besar, karena pencarian juga dibantu oleh mesin database dari sisi server). Boleh disesuaikan dengan kebutuhan
      })
    })
  </script>
@endpush