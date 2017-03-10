@extends('story-theme::layouts.master')

@section('title') Member @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="/backend/cms/elements/pages/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
  </div>
</div>
@stop

@section('content')
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
