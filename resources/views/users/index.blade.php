@extends('cms::layouts.app')

@section('title') Users @stop

@section('content')
<div class="container-fluid">
  <user-index />
</div>
@stop

@section('js')
  @parent
  @include('cms::users.list')
  @include('cms::users.create')
  @include('cms::users.update')
@stop
