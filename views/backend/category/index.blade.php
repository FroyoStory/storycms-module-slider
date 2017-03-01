@extends('story-theme::layouts.master')

@section('title') Category @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>Categories</h1>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      @include('cms::backend.category._create')
    </div>
    <div class="col-md-7">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
            @foreach (config()->get('translatable.locales') as $locale)
            <th>{{ $locale }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
          <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->slug }}</td>
            @foreach (config()->get('translatable.locales') as $locale)
            <td>
              <a href="/backend/cms/elements/category/{{ $category->id }}?locale={{ $locale }}"><i class="material-icons font-size-14">create</i> </a>
            </td>
            @endforeach
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop
