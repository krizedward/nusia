      
      <div class="row">
        <div class="col-md-4">

          <div class="callout callout-danger">
            <h4>Class</h4>
            <form action="{{ url('/classroom') }}">  
              <button type="submit" class="btn btn-danger btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="callout callout-info">
            <h4>Instructor</h4>
            <form action="{{ route('instructors.index') }}">  
              <button type="submit" class="btn btn-info btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="callout callout-warning">
            <h4>Time</a></h4>
            <form action="{{ route('calendar.index') }}">  
                <button type="submit" class="btn btn-warning btn-block btn-flat">Select</button>
            </form>
          </div>
        </div>

      </div>