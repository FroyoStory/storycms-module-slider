@extends('cms::layouts.blank')

@section('title') Login @stop

@section('content')
<div class="container">
  <div class="login">
    <div class="text-center login-logo">
      <i class="material-icons">album</i>
      <span>STORY CMS PANEL</span>
    </div>

    <story-login></story-login>
  </div>
</div>
@stop

@section('template')
  <script type="text/x-template" id="story-login">
    <div id v-loading.body="loading">
      <div class="form-group">
        <el-input placeholder="Please input your username" v-model="form.email"></el-input>
        <span class="help-block text-danger" v-if="errors.email">@{{ errors.email.toString() }}</span>
      </div>
      <div class="form-group">
        <el-input type="password" placeholder="Please input your password" v-model="form.password"></el-input>
        <span class="help-block text-danger" v-if="errors.password">@{{ errors.password.toString() }}</span>
      </div>
      <div class="form-group">
        <el-button type="primary" @click="login">Login</el-button>
      </div>
    </div>
  </script>
@stop

@section('js')
  @parent
  <script>
    Vue.component('story-login', {
      template: '#story-login',
      data: function () {
        return {
          form: { email: '', password: '' },
          errors: { email: [], password: []},
          loading: false
        }
      },
      methods: {
        login: function () {
          var that = this
          this.loading = true
          this.$http.post('auth', this.form, function(response) {
            that.loading = false
            window.location.href = '/backend/'
          }, function(error) {
            that.loading = false
            that.errors = error.response.data
          })
        }
      }
    })
  </script>
@stop
