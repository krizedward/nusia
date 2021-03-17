  <div class="row">
    <div class="col-md-12">
      @if(session('caption-success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>
            <strong><i class="fa fa-check"></i>&nbsp;&nbsp;{{ session('caption-success') }}</strong>
            {{ session(['caption-success' => null]) }}
          </p>
        </div>
      @endif
      @if(session('caption-warning'))
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>
            <strong><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;{{ session('caption-warning') }}</strong>
            {{ session(['caption-warning' => null]) }}
          </p>
        </div>
      @endif
      @if(session('caption-danger'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>
            <strong><i class="fa fa-times"></i>&nbsp;&nbsp;{{ session('caption-danger') }}</strong>
            {{ session(['caption-danger' => null]) }}
          </p>
        </div>
      @endif
      @if(session('caption-info'))
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>
            <strong><i class="fa fa-info-circle"></i>&nbsp;&nbsp;{{ session('caption-info') }}</strong>
            {{ session(['caption-info' => null]) }}
          </p>
        </div>
      @endif
    </div>
  </div>

{{--
      <div class="row">
        <div class="col-md-12">
        @if(Session::has('store_student'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> {{ __('Success!')}}</h4>
              {{ Session::get('Schedule-Student')}}
          </div>
        @endif

        @if(Session::has('admin_store_instructor'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> {{ __('Success!')}}</h4>
              {{ Session::get('admin_store_instructor')}}
          </div>
        @endif

        @if(Session::has('admin_store_instructor_schedule'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> {{ __('Success!')}}</h4>
              {{ Session::get('admin_store_instructor_schedule')}}
          </div>
        @endif


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
--}}