  <meta charset="utf-8">
  <meta {{-- http-equiv="X-UA-Compatible" --}} content="IE=edge"> {{-- Apabila tidak digunakan maka tidak perlu ditambahkan. http-equiv="X-UA-Compatible" membuat browser melakukan rendering menggunakan versi yang paling baru untuk meningkatkan user experience. Hasil evaluasi "Inspect Elements" menunjukkan bahwa fitur ini, untuk saat ini, tidak diperlukan. --}}
  <title>@yield('title') | NUSIA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  @stack('style')