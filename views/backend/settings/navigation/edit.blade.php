@extends('story-theme::layouts.master')

@section('title') Navigation Settings @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="/backend/system/appearance/navigation/create" class="btn btn-link btn-float has-text">
      <i class="material-icons">add_box</i> <span>ADD NEW</span>
    </a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <form class="" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
          <label>Menu name</label>
          <input type="text" name="name" placeholder="" class="form-control" value="{{ $menu->name }}">
        </div>
        <div class="form-group">
          <label>Slug URL</label>
          <input type="text" name="slug" placeholder="" class="form-control" value="{{ $menu->slug }}">
          <small class="help-block">https://yourwebsite.com/{url_slug} .</small>
        </div>
         <div class="checkbox">
          <label>
            <input type="checkbox" name="visibility" {{ $menu->visibility == 1? 'checked' : '' }} value="1"> Active
          </label>
        </div>
        <hr />
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
