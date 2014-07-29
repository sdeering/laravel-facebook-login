@include('partials.page_open')

  <div id="main" class="container-fluid">

    <div class="row">
      <div class="col-lg-12">
        <a href="users" class="btn btn-default pull-left btn-sm"><i class="fa fa-arrow-left"></i> Back to users</a>
      </div>
    </div>

    <div class='col-lg-12'>

      <h2><i class="fa fa-user"></i> Create User</h2>

      {{ HTML::ul($errors->all()) }}

      {{ Form::open(array('url' => 'users', 'method' => 'POST')) }}

      <div class='form-group'>
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) }}
      </div>

      <div class='form-group'>
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) }}
      </div>

      <div class='form-group'>
          {{ Form::label('username', 'Username') }}
          {{ Form::text('username', null, ['placeholder' => 'Username', 'class' => 'form-control']) }}
      </div>

      <div class='form-group'>
          {{ Form::label('email', 'Email') }}
          {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
      </div>

      <div class='form-group'>
          {{ Form::label('password', 'Password') }}
          {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
      </div>

      <div class='form-group'>
          {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
      </div>

      {{ Form::close() }}
    </div>


    </div>
  </div>

</div>

@include('partials.page_close')
