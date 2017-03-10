@extends('story-theme::layouts.master')

@section('title') Dashboard @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="/backend/cms/elements/category" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>CATEGORY</span></a>
    <a href="/backend/cms/elements/pages/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>POST</span></a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">At a Glance</div>
        <div class="panel-body">
          <ul class="dashboard-stats">
            @foreach($stats as $stat)
            <li class="post-count">
              <a href="edit.php?post_type=post">
                <i class="material-icons">{{ $stat->font}}</i>
                {{ $stat->value }} {{ $stat->key }}
              </a>
            </li>
            @endforeach
          </ul>
          <p>Story CMS 1.0.1 running</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Quick Draft</div>
        <div class="panel-body">
          <form class="">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
              <textarea class="form-control" name="body" rows="4" placeholder="What's on your mind?"></textarea>
            </div>
            <div class="form-group">
              <input type="hidden" name="status" value="DRAFT">
              <button class="btn btn-primary">Save Draft</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
