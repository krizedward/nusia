      <div class="row">
        <div class="col-md-12">
        <!-- Student Alert -->
        @if(Session::has('store_student'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> {{ __('Success!')}}</h4>
              {{ Session::get('Schedule-Student')}}
          </div>
        @endif

        <!-- Admin Alert -->
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
