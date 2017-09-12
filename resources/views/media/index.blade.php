@extends('cms::layouts.app')

@section('title') Category @stop

@section('content')
  <div class="container-fluid">
    <media-index />
  </div>
@stop

@section('js')
  @parent
  @include('cms::media.update')
  @include('cms::media.upload')
  @include('cms::media.list')
  <script type="text/x-template" id="media-index">
    <el-tabs v-model="activeName">
      <el-tab-pane label="Media Library" name="library">
        <media-list />
      </el-tab-pane>
      <el-tab-pane label="Upload file" name="upload">
        <media-upload />
      </el-tab-pane>
    </el-tabs>
  </script>
  <script>
    Vue.component('media-index', {
      template: '#media-index',
      data: function () {
        return {
          activeName: 'library'
        }
      }
    })
  </script>
@stop
