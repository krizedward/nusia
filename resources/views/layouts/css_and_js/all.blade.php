@push('style')

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/all.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
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

    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@push('script')
    <!-- jQuery 3 -->
    <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
    <!-- fullCalendar -->
    <script src="{{ url('adminlte/bower_components/moment/moment.js')}}"></script>
    <script src="{{ url('adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminlte/dist/js/pages/dashboard2.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
            $('.datepicker').datepicker({
                autoclose: true
            })

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })



	    /* initialize the calendar
	     -----------------------------------------------------------------*/
	    //Date for the calendar events (dummy data)
	    var date = new Date()
	    var d    = date.getDate(),
	        m    = date.getMonth(),
	        y    = date.getFullYear()
	    $('#calendar').fullCalendar({
	      header    : {
	        left  : 'prev,next today',
	        center: 'title',
	        right : 'month,agendaWeek'
	      },
	      buttonText: {
	        today: 'today',
	        month: 'month',
	        week : 'week',
	      },
	      //Random default events
	      events    : [
	      //mengambil data dari model
              {{--@foreach($data as $dt)
            @if($dt->instructor_id == $instructor->id)
                   {
                    title 	: '{{ $dt->instructor->user->name }}',
                    start 	: '{{ $dt->date_meet }} {{ $dt->time_meet }}',
                    url 	: '{{ route('schedule.summary', [$class->id,$instructor->id,$dt->id,]) }}'
                },
            @endif
            @endforeach--}}
	      ],
	      editable  : false,
	      droppable : false, // this allows things to be dropped onto the calendar !!!

	    })






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
          $('.example2').DataTable({
            'deferRender'    : true,  // optimisasi untuk load data dalam jumlah besar
            'processing'     : true,  // menunjukkan indikator pada waktu tabel masih proses load data
            'scrollX'        : true,  // show tabel pada viewport yang dapat di-scroll secara horizontal pada waktu tampilan tidak mencukupi (baik. Perlu disesuaikan secara manual mengenai width masing-masing kolom). Saat ini, fungsi ini di-disable, karena (sebagai pertimbangan), apakah user akan melakukan scrolling secara horizontal? Maka sebaiknya menunjukkan dulu bahwa ada fitur tersebut. Jika tidak/belum ditunjukkan, perkecil ukuran tabel khususnya untuk disesuaikan pada tampilan mobile dan tablet
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
