@extends('cms::layouts.app')

@section('title') Post Pages @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="/backend/cms/elements/post/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Date</th>
        <th>Status</th>
        <th>Active</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td>{{ $post->title }}</td>
        <td>{{ $post->category ? $post->category->name : '' }}</td>
        <td>{{ $post->created_at }}</td>
        <td>{{ ucfirst(strtolower($post->status)) }}</td>
        <td>{{ $post->active == 0 ? 'No' : 'Yes' }}</td>
        <td>
          <form action="/backend/cms/elements/post/{{ $post->id }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">X</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
