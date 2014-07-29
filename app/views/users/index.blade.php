@include('partials.page_open')

<div id="main" class="container-fluid">

  <h2><i class="fa fa-users"></i> Users</h2>

  <p>
    <a href="users/create" class="btn btn-success">Add User</a>
  </p>

  <div class="row">
    <div class="col-lg-12">

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Profile Pic</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($data as $user)
                    <tr>

                      <td>{{ $user->id }}</td>
                      <td><img style="height:40px;" src="{{ $user->pic_url }}" /></td>
                      <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->created_at }}</td>

                      <td>
                        <a href="users/{{ $user->id }}" class="btn btn-success pull-left btn-xs" style="margin-right: 3px; margin-bottom: 3px;">View</a>
                        <a href="users/{{ $user->id }}/edit" class="btn btn-info pull-left btn-xs" style="margin-right: 3px; margin-bottom: 3px;">Edit</a>

                        {{ Form::open(['url' => '/users/' . $user->id, 'method' => 'DELETE']) }}
                        {{ Form::submit('Delete', ['class' => 'btn-xs btn btn-danger'])}}
                        {{ Form::close() }}

                      </td>
                    </tr>
                  @endforeach
                </tbody>

            </table>
        </div>

    </div>
  </div>

</div>

@include('partials.page_close')
