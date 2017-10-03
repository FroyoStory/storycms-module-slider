@extends('cms::layouts.app')

@section('title') Post Pages @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="{{ route('post.create', ['type' => request()->input('type') ]) }}" class="btn btn-link btn-float has-text">
      <i class="material-icons">add_box</i> <span>ADD NEW</span>
    </a>
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
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td><a href="{{ route('post.edit', ['post' => $post->id, 'type' => $post->type ]) }}">{{ $post->title }}</a></td>
        <td>{{ $post->user->name }}</td>
        <td></td>
        <td></td>
        <td>
          {{ $post->post_status }}<br />
          <abbr title="{{ $post->created_at }}">{{ $post->created_at }}</abbr>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
