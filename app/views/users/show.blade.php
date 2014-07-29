@include('partials.page_open')

  <div id="main" class="container-fluid">

    <div class="row">
      <div class="col-lg-12">
        <a href="/users" class="btn btn-default pull-left btn-sm"><i class="fa fa-arrow-left"></i> Back to users</a>
      </div>
    </div>

    <div class="row">
      <div class='col-lg-12'>

      @foreach ($data["user"]["info"] as $user)
        <h2><i class="fa fa-user"></i> User</h2>
          <p>
            <a href="/users/{{ $user->id }}/edit" class="btn btn-info pull-left btn-sm" style="margin-right: 3px;">Edit</a>
            {{ Form::open(['url' => '/users/' . $user->id, 'method' => 'DELETE']) }}
            {{ Form::submit('Delete', ['class' => 'btn-sm btn btn-danger'])}}
            {{ Form::close() }}
          </p>
          <div class="table-responsive">
              <table class="table table-bordered table-striped">

                  <thead>
                    <tr>
                      <th>Field</th>
                      <th>Value</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($user as $field => $value)
                      <tr>
                        <td><strong>{{ $field }}:</strong></td>
                        <td>{{ $value }}</td>
                      </tr>
                    @endforeach
                  </tbody>

              </table>
          </div>

          <h2>Connected Networks</h2>
          <div class="table-responsive">
              <table class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Network</th>
                    <th>Network UID</th>
                    <th>Last Login</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($data["user"]["networks"] as $networks)
                    <tr>
                      <td>{{ $networks->id }}</td>
                      <td>{{ $networks->network }}</td>
                      <td>{{ $networks->network_id }}</td>
                      <td>{{ $networks->updated_at }}</td>
                    </tr>
                  @endforeach
                </tbody>

              </table>
          </div>

        @endforeach

      </div>

    </div>
  </div>

</div>

@include('partials.page_close')
