
@include('partials.page_open')

<div id="main" class="container-fluid">

  <div class="row">
  	<div class='col-lg-12 col-md-12'>
  		<p>Welcome {{ $data["logged_in_user"]->full_name }} ({{ $data["logged_in_user"]->email }}).</p>
  	</div>
  </div>

  <p>Note: Data on this server resets every hour.</p>

  <h2>Recent Logins</h2>

  <div class="row">

    <div class='col-lg-8 col-md-8'>

      <div class="table-responsive">
          <table class="table table-bordered table-striped">

              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Profile Pic</th>
                  <th>Full Name</th>
                  <th>Login Method</th>
                  <th>Date/Time</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
              @foreach ($data["users"] as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td><img style="height:40px;" src="{{ $user->pic_url }}" /></td>
                  <td>{{ $user->full_name }}</td>
                  <td>{{ $user->network }}</td>
                  <td>{{ $user->updated_at }}</td>
                  <td><a href="/users/{{ $user->id }}" class="btn btn-success pull-left btn-xs" style="margin-right: 3px; margin-bottom: 3px;">View</a></td>
                </tr>
              @endforeach
              </tbody>

          </table>
      </div>

    </div>

	</div>
</div>

@include('partials.page_close')
