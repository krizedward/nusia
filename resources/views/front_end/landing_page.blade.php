@extends('front_end.layouts')

@section('content')
<!-- row-01-banner -->
<div class="container" style="margin-top:30px">
  <div class="row mb-5 p-5">
    <div class="col-6">
      <h1>Speak Like A Native!</h1>
      <p>Don't think you can speak the Indonesia language fluently?</p>
      <p>Join Nusia's online courses and see how easy it can be!</p>
    </div>
    <!-- End_Colmn -->
    <div class="col-6">
      <img src="https://placeholder.pics/svg/500x250" class="rounded float-right" >
    </div>
    <!-- End_Colmn -->
  </div>
</div>
<!-- row-02-information -->
<div class="bg-warning mb-5 p-5">
  <div class="container">
    <h2>About Me</h2>
      <h5>Photo of me:</h5>
      <div class="fakeimg">Fake Image</div>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
      <h3>Some Links</h3>
      <p>Lorem ipsum dolor sit ame.</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
      <hr class="d-sm-none">
  </div>
</div>
<!-- row-03-best-photo -->
<div class="container">
  <p>none</p>
</div>
<!-- row-04-why-us -->
<div class="container p-5">
  <div class="row p-5">
    <div class="col-12 mb-5">
      <h3 class="float-right">Why Nusia ?</h3>
    </div>
    <!-- End_Colmn -->
    <div class="col-6">
      <ul>
        <li>Enganging Learning Activities</li>
        <li>Communicative Approach</li>
      </ul>
    </div>
    <!-- End_Colmn -->
    <div class="col-6">
      <ul>
        <li>Flipped Learning Method</li>
        <li>Flexible Scheduling</li>
      </ul>
    </div>
  </div>
</div>
<!-- row-04-our-english-program -->
<!-- row-05-step-register -->
<!-- row-06-testimoni -->
<!-- row-07-footer -->
@endsection