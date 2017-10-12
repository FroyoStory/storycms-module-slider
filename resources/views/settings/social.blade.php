@extends('cms::layouts.app')

@section('title') Social Settings @stop

@section('content')
<div class="container-fluid">
  <setting-social></setting-social>
</div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="setting-social">
    <div class="row">
      <label>Enable Post to Social Media after publish</label>
      <el-switch
      v-model="form.switch"
      on-color="#13ce66"
      off-color="#ff4949"
      :on-value="1"
      :off-value="0">
      </el-switch>
      <br />
      <div class="col-md-6">
        <div class="title"><i class="material-icons">indeterminate_check_box</i><strong>Facebook</strong></div><br />
        <div class="form-group">
          <label>App ID</label>
          <el-input type="text" v-model="form.fb_app_id"></el-input>
          <small class="help-block">Facebook App ID</small>
        </div>
        <div class="form-group">
          <label>App Secret</label>
          <el-input type="text" v-model="form.fb_app_secret"></el-input>
          <small class="help-block">Facebook App Secret</small>
        </div>
        <div class="form-group">
          <label>Access Token</label>
          <el-input type="text" v-model="form.fb_access_token"></el-input>
          <small class="help-block">Facebook Access Token</small>
        </div>
      </div>

      <div class="col-md-6">
        <div class="title"><i class="material-icons">indeterminate_check_box</i><strong>Twitter</strong></div><br />
        <div class="form-group">
          <label>Access Token</label>
          <el-input type="text" v-model="form.tw_access_token"></el-input>
          <small class="help-block">Twitter Access Token</small>
        </div>
        <div class="form-group">
          <label>Access Token Secret</label>
          <el-input type="text" v-model="form.tw_access_token_secret"></el-input>
          <small class="help-block">Twitter Access Token Secret</small>
        </div>
         <div class="form-group">
          <label>Consumer Key</label>
          <el-input type="text" v-model="form.tw_consumer_key"></el-input>
          <small class="help-block">Twitter Consumer Key</small>
        </div>
         <div class="form-group">
          <label>Consumer Secret</label>
          <el-input type="text" v-model="form.tw_consumer_secret"></el-input>
          <small class="help-block">Twitter Consumer Secret</small>
        </div>
      </div>

      <div class="col-md-6">
        <div class="title"><i class="material-icons">indeterminate_check_box</i><strong>Instagram</strong></div><br />
        <div class="form-group">
          <label>Username</label>
          <el-input type="text" v-model="form.insta_username"></el-input>
          <small class="help-block">Instagram Username</small>
        </div>
        <div class="form-group">
          <label>Password</label>
          <el-input type="password" v-model="form.insta_password"></el-input>
          <small class="help-block">Instagram Password</small>
        </div>
      </div>
      <hr />
      <div class="form-group">
        <el-button type="primary" @click="save">Save setting</el-button>
      </div>
    </div>
  </script>
  <script>
    Vue.component('setting-social', {
      template: '#setting-social',
      data: function () {
        return {
          form: {
            fb_app_id: '{{ $config->FB_APP_ID}}',
            fb_app_secret: '{{ $config->FB_APP_SECRET}}',
            fb_access_token: '{{ $config->FB_ACCESS_TOKEN}}',
            tw_access_token: '{{ $config->TW_ACCESS_TOKEN}}',
            tw_access_token_secret: '{{ $config->TW_ACCESS_TOKEN_SECRET}}',
            tw_consumer_key: '{{ $config->TW_CONSUMER_KEY}}',
            tw_consumer_secret: '{{ $config->TW_CONSUMER_SECRET}}',
            insta_username: '{{ $config->INSTA_USERNAME}}',
            insta_password: '{{ $config->INSTA_PASSWORD}}',
            switch: {{ $config->SWITCH ? 1 : 0 }}
          }
        }
      },
      methods: {
        save: function () {
          this.$http.post('setting/social', this.form)
        }
      }
    })
  </script>
@stop
