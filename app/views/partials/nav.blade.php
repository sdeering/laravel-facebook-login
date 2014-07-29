<div class="navbar navbar-inverse" navbar="">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="../" class="navbar-brand">
        <img class="logo" src="http://www.gravatar.com/avatar/03490f81e70d7e43a5769a0a886e0314.png" alt="Laravel PHP Framework"></a>
      </a>
    </div>
    <nav class="navbar-collapse bs-navbar-collapse collapse nopadding" role="navigation" style="height: 1px;">
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
        @if(Session::get('session'))
        <li><a href="/users">Users</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(!Session::get('session'))
          <li><a href="/login" title="" alt="">Login</a></li>
        @else
          <li><a href="/logout">Logout</a></li>
        @endif
      </ul>
    </nav>
  </div>
</div>