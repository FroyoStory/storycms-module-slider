@extends('story-theme::layouts.master')

@section('title') General Settings @stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <form class="" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}

        <div class="form-group">
          <label>Site Title</label>
          <input type="text" name="site_title" placeholder="" class="form-control" value="{{ Configuration::get('site_title') }}">
          <small class="help-block">This website title</small>
        </div>
        <div class="form-group">
          <label>Site Tagline</label>
          <input type="text" name="site_tagline" placeholder="" class="form-control" value="{{ Configuration::get('site_tagline') }}">
          <small class="help-block">In a few words, explain what this site is about.</small>
        </div>
        <div class="form-group">
          <label>Site Membership</label>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="site_membership" value="on" {{  Configuration::get('site_membership') == 'on' ?  'checked' : '' }}> Anyone can register
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>New User Default Role</label> <br />
          <select class="" name="site_default_role">
            <option value="user" {{ Configuration::get('site_default_role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="author" {{ Configuration::get('site_default_role') == 'author' ? 'selected' : '' }}>Author</option>
            <option value="editor" {{ Configuration::get('site_default_role') == 'editor' ? 'selected' : '' }}>Editor</option>
            <option value="admin" {{ Configuration::get('site_default_role') == 'admin' ? 'selected' : '' }}>Administrator</option>
          </select>
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
