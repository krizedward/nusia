<!DOCTYPE html>
<html lang="en">
<head>
  <title>404 | Not Found</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>This page is currently away ._.</h1>
  <p>
    Still, we don't know when this page will eventually appear.<br />
    ...trying to recheck the keywords? Or clicking buttons below may help? :)
  </p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="/">Navigate? --></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('non_registered.terms.index') }}">Terms of Service</a>
        </li>
        @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link" href="{{ route('registered.dashboard.index') }}">Go To Dashboard</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="mailto:nusia.helpdesk@gmail.com">Email Us</a>
        </li>    
      </ul>
    </div>
  </div>  
</nav>
</body>
</html>