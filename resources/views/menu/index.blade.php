@extends('cms::layouts.app')

@section('title') Menu List @stop

@section('content')
<div class="container-fluid">
  <menu-index />
</div>
@stop

@section('js')
  @parent
  @include('cms::menu.create')
  @include('cms::menu.update')
  @include('cms::menu.list')
@stop
