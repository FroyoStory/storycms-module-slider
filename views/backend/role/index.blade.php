@extends('story-theme::layouts.master')

@section('title') Post Pages @stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <form action="/backend/user/groups/roles" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="panel panel-default">
          <div class="panel-heading">Create New</div>
          <div class="panel-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
              <label>Name</label>
              <input type="text" class="form-control" name="name">
              @if ($errors->has('name'))
                <small class="help-block">{{ $errors->first('name') }}</small>
              @endif
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Create</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-5">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Member count</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
          <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->user->count() }}</td>
            <td>{{ $role->created_at }}</td>
            <td>{{ $role->updated_at }}</td>
            <td>
              <a href="/backend/user/groups/roles/{{ $role->id }}">
                <i class="material-icons font-size-14">create</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop
