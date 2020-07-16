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


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
