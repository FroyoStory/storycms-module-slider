@extends('story-theme::layouts.master')

@section('title') Post Pages @stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <form action="" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="panel panel-default">
          <div class="panel-heading">Create New</div>
          <div class="panel-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $role->name }}">
              @if ($errors->has('name'))
                <small class="help-block">{{ $errors->first('name') }}</small>
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
