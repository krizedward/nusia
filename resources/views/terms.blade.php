<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nusantara Indonesia</title>
    <!--css_custom-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <!--font-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
</head>
<body>
    <!--  First_Test
    <h1 class="title">Montserrat</h1>
    <h1>Montserrat</h1>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
    <p>123456790</p>
    <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
    <p>abcdefghijklmnopqrstuvwxyz</p>
    <div>
        <img src="assets/img/logo.png">
    </div>-->
    <!--
    <header class="section-header py-4 bg-light">
        <div class="container">
            <img src="assets/img/logo.png">
            <p>Content Head</p>
        </div>
    </header>  --> <!-- section-header.// -->
    <!-- ========================= SECTION CONTENT ========================= -->

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: #ffffff;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" style="width: 50%">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">
                <!--ul class="navbar-nav">
                    <li class="nav-item active"> <a class="nav-link" href="#">Home </a> </li>
                    <li class="nav-item"><a class="nav-link" href="#"> About </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> Services </a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  More items  </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
                            <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
                            <li><a class="dropdown-item" href="#"> Submenu item 3 </a></li>
                        </ul>
                    </li>
                </ul>-->
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item"><a class="nav-link" style="color: #000;" href="{{ url('/') }}"> HOME </a></li>
                  @if(Auth::check())
                    <li class="nav-item"><a class="nav-link" style="color: #000;" href="{{ route('registered.dashboard.index') }}"> DASHBOARD </a></li>
                  @else
                    <li class="nav-item"><a class="nav-link" style="color: #000;" href="{{ route('login') }}"> LOGIN </a></li>
                  @endif
                </ul>
            </div> <!-- navbar-collapse.// -->
        </div><!-- container //  -->
    </nav>

    <section class="section-content py-5">
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Terms of Service</h1>
                <br>
                <!--p><b style="font-size: 20px;">Terms of Service</b></p-->
                <ol style="text-align:justify;">
                    <li>Learners must attend all sessions in NUSIA's free classes.<br>If learners cannot attend some of them,<br>they cannot reschedule the sessions.</p>
                    <li>Learners must read the learning materials on the dashboard before joining each session.</p>
                    <li>Learners must give feedback on the link<br>provided in the dashboard after finishing each session.</p>
                    <li>All sessions in the free classes are recorded.<br>Learners allow NUSIA to employ the video recordings<br>for research and marketing purposes<br>(If you disagree with this term, please contact us<br>via email on <a href="mailto:nusia.helpdesk@gmail.com">nusia.helpdesk@gmail.com</a>.)</p>
                </ol>
                @if(Auth::check())
                  <a href="{{ route('registered.dashboard.index') }}" class="btn btn-primary btn-md col-md-12"> Go To Dashboard</a>
                @else
                  <a href="{{ route('login') }}" class="btn btn-primary btn-md col-md-12"> Start My Class</a>
                @endif
            </div>
            <!--end_col-md-6-->
            <div class="col-md-6">
                <img src="{{ asset('img/latptop-full.png') }}">
            </div>
        </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4" style="background: #333333">
        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 mt-md-0 mt-3" style="color: #ffffff">
                    <!-- Content -->
                    <h5 class="text-uppercase"><a href="#" style="text-decoration:none; color:#ffffff;">Terms of Service</a></h5>
                </div>
                <!-- Grid column -->
                <div class="col-md-6 mb-md-0 mb-3"  style="color: #ffffff">
                    <!-- Links -->
                    <h5 class="text-uppercase">Contact Us </h5>
                    <p>
                      Have a question? Please feel free to send us an email on <a href="mailto:nusia.helpdesk@gmail.com">nusia.helpdesk@gmail.com</a>
                    </p>
                    <!--
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>
                    -->
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">
                    <!-- Links -->
                    <img src="{{ asset('img/logo-white.png') }}" style="width: 50%">
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        <!-- Footer Links -->
    </footer>
    <!-- Footer -->
</body>
</html>