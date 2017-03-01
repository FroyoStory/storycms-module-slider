@extends('story-theme::layouts.master')

@section('title') Category @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>Categories</h1>
    </div>
    <div class="heading-elements">
      <div class="heading-btn-group">
        <a href="/backend/cms/elements/category/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
      </div>
    </div>
  </div>
</div>
@stop
