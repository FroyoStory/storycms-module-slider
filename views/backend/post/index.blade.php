@extends('story-theme::layouts.master')

@section('title') Post Pages @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>Pages</h1>
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
        <th>Date</th>
        @foreach (config()->get('translatable.locales') as $locale)
        <th>{{ $locale }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user->name }}</td>
        <td>{{ $post->created_at }}</td>
        @foreach (config()->get('translatable.locales') as $locale)
        <td>
          <a href="/backend/cms/elements/post/{{ $post->id }}?locale={{ $locale }}">
            <i class="material-icons font-size-14">create</i>
          </a>
        </td>
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
