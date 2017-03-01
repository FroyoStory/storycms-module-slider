@extends('story-theme::layouts.master')

@section('title') Media Settings @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>Media Settings</h1>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <form class="" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}

        <div class="form-group">
          <label>Site Title</label>
          <input type="text" name="site_title" placeholder="" class="form-control">
          <small class="help-block">This website title</small>
        </div>
        <div class="form-group">
          <label>Site Tagline</label>
          <input type="text" name="site_tagline" placeholder="" class="form-control">
          <small class="help-block">In a few words, explain what this site is about.</small>
        </div>
        <div class="form-group">
          <label>Site Membership</label>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="site_membership"> Anyone can register
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>New User Default Role</label> <br />
          <select class="" name="site_role_default">
            <option value="user">User</option>
            <option value="author">Author</option>
            <option value="editor">Editor</option>
            <option value="admin">Administrator</option>
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
