@extends('cms::layouts.app')

@section('title') Plugin @stop

@section('content')
  <div class="container-fluid">
    <plugin-index />
  </div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="plugin-index">
    <div v-loading.body="loading">
      <table class="table">
        <thead>
          <tr>
            <th>Plugin</th>
            <th width="2%">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="plugin in plugins">
            <td>
              <strong>@{{ plugin.name }}</strong> <br />
              <small>@{{ plugin.description }}</small>
            </td>
            <td>
              <el-button type="primary" icon="edit" v-show="plugin.status == 0" @click="install(plugin)">
                Install
              </el-button>
              <el-button type="danger" icon="edit" v-show="plugin.status == 1" @click="uninstall(plugin)">
                Uninstall
              </el-button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </script>
  <script>
    Vue.component('plugin-index', {
      template: '#plugin-index',
      data: function () {
        return {
          loading: false,
          plugins: {!! $plugins ? : '[]' !!}
        }
      },
      methods: {
        install: function(plugin) {
          var self = this
          self.loading = true
          self.$http.post('plugins', plugin, function(response) {
            self.loading = false
            plugin.status = 1
          }, function(error) {

          })
        },
        uninstall: function (plugin) {
          var self = this
          self.loading = true
          self.$http.delete('plugins', plugin, function(response) {
            self.loading = false
            plugin.status = 0
          }, function(error) {

          })
        }
      }
    })
  </script>
@stop
