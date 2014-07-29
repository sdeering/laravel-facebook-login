  <header>
      @include('partials.nav')
  </header>

  <!-- will be used to show any messages -->
@if (Session::has('message'))
  <div class="row-responsive">
    <div class="col-lg-12 col-offset-1">
      <div class="alert alert-info">{{ Session::get('message') }} <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
    </div>
  </div>
@endif
