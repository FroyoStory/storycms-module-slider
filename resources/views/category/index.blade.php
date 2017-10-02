@extends('cms::layouts.app')

@section('title') Category @stop

@section('content')
<div class="container-fluid">
  <category-index />
</div>
@stop

@section('js')
  @parent
  @include('cms::category.item')
  @include('cms::category.create')
  @include('cms::category.update')
  @include('cms::category.list')
@stop

