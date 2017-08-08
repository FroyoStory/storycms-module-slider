@extends('story-theme::layouts.master')

@section('title') Post Pages @stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <form action="member/{user->id}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="panel panel-default">
          <div class="panel-heading">Edit</div>
          <div class="panel-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
              <label>Username</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
              @if ($errors->has('name'))
                <small class="help-block">{{ $errors->first('name') }}</small>
              @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
              <label>Email</label>
              <input type="text" class="form-control" name="email" value="{{ $user->email }}">
              @if ($errors->has('email'))
                <small class="help-block">{{ $errors->first('email') }}</small>
              @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
              <label>New Password</label>
              <input type="text" class="form-control" name="password" value="">
              @if ($errors->has('password'))
                <small class="help-block">{{ $errors->first('password') }}</small>
              @endif
            </div>
            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error': '' }}">
              <label>Confirm New Password</label>
              <input type="text" class="form-control" name="confirm_password" value="">
              @if ($errors->has('confirm_password'))
                <small class="help-block">{{ $errors->first('confirm_password') }}</small>
              @endif
            </div>
            <div class="form-group {{ $errors->has('role') ? 'has-error': '' }}">
              <label>Role</label>
              <select name="role">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('role'))
                <small class="help-block">{{ $errors->first('role') }}</small>
              @endif
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save changes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
