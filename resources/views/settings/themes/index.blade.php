@extends('cms::layouts.app')

@section('title') Themes @stop

@section('css')
  <style type="text/css">
    .themes .themes-image {
      height: 180px;
      background-color: #ddd;
    }
    .themes .themes-meta {
      padding: 20px 0;
      overflow: hidden;
      height: 180px;
      border-bottom: 1px solid #ddd;
    }
    .themes .themes-action {
      padding: 20px 0;
    }
  </style>

@stop

@section('content')
  <div class="container-fluid">
    <themes-index />
  </div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="themes-index">
    <div class="row">
      <div class="col-md-3" v-for="item in themes">
        <div class="themes">
          <div class="themes-image"></div>
          <div class="themes-meta">
            <p class="lead">@{{ item.name }}</p>
            <p>@{{ item.description }}</p>
          </div>
          <div class="themes-action">
            <el-button type="primary" @click="activate(item.key)" v-show="item.key != theme">Activate</el-button>
          </div>
        </div>
      </div>
    </div>
  </script>
  <script>
    Vue.component('themes-index', {
      template: '#themes-index',
      data: function () {
        return {
          themes: {!! $themes !!},
          theme: '{{ $theme }}'
        }
      },
      methods: {
        activate: function (theme) {
          var self = this
          self.$http.post('setting/theme', {key: theme}, function (response) {
            self.theme = theme
          }, function (error) {

          })
        }
      }
    })
  </script>
@stop
