@extends('story-theme::layouts.master')

@section('title') Edit Category @stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      @include('cms::backend.category._edit')
    </div>
  </div>
</div>
@stop
