@extends('story-theme::layouts.master')

@section('title') Post Pages @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>POST</h1>
    </div>
    <div class="heading-elements">
      <div class="heading-btn-group">
        <a href="/backend/cms/elements/post/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Categories</th>
        <th>Tags</th>
        <th>Date</th>
      </tr>
    </thead>
  </table>
</div>
@stop
