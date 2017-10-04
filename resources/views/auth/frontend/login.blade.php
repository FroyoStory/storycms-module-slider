@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form action="" method="POST" accept-charset="utf-8">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Please input your username">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Please input your username">
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop

@render()
