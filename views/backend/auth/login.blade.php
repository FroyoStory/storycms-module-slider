@extends('story-theme::layouts.blank')

@section('title') Login @stop

@section('content')
<div class="container">
  <div class="login">
    <div class="text-center login-logo">
      <i class="material-icons">album</i>
      <span>STORY CMS PANEL</span>
    </div>

    <form class="" method="POST">
      {{ csrf_field() }}
      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="Please input your username">
        @if ($errors->has('email'))
          <span class="help-block text-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Please input your password">
        @if ($errors->has('password'))
          <span class="help-block text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>
      <hr />
      <div class="form-group text-center">
        <button class="btn btn-primary">Login </button>
      </div>

    </form>
  </div>
</div>
@stop
