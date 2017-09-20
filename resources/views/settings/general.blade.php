@extends('cms::layouts.app')

@section('title') General Settings @stop

@section('content')

<div class="container-fluid">
  <setting-general></setting-general>
</div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="setting-general">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Site Title</label>
          <el-input type="text" v-model="form.site_title"></el-input>
          <small class="help-block">This website title</small>
        </div>
        <div class="form-group">
          <label>Site Tagline</label>
          <el-input type="textarea" :rows="3" v-model="form.site_tagline"></el-input>
          <small class="help-block">In a few words, explain what this site is about.</small>
        </div>
        <div class="form-group">
          <label>Allow visitor to register?</label>
          <el-switch v-model="form.site_membership" on-text="" off-text="" style="display: block"></el-switch>
        </div>
        <div class="form-group">
          <label>Date format</label>
          <el-radio-group v-model="form.date_format">
            <el-radio label="F j, Y">September 5, 2017</el-radio>
            <el-radio label="Y-m-d">2017-09-05</el-radio>
            <el-radio label="m/d/Y">09/05/2017</el-radio>
            <el-radio label="d/m/Y">05/09/2017</el-radio>
          </el-radio-group>
        </div>
        <div class="form-group">
          <label>Time format</label>
          <el-radio-group v-model="form.time_format">
            <el-radio label="g:i a">3:52 pm</el-radio>
            <el-radio label="g:i A">3:52 PM</el-radio>
            <el-radio label="H:i">15:53</el-radio>
          </el-radio-group>
        </div>
        <hr />
        <div class="form-group">
          <el-button type="primary" @click="save">Save setting</el-button>
        </div>
      </div>
    </div>
  </script>
  <script>
    Vue.component('setting-general', {
      template: '#setting-general',
      data: function () {
        return {
          form: {
            site_title: '{{ $config->SITE_TITLE }}',
            site_tagline: '{{ $config->SITE_TAGLINE }}',
            site_membership: {{ $config->SITE_MEMBERSHIP ? 'true' : 'false' }},
            date_format: '{{ $config->SITE_DATE_FORMAT }}',
            time_format: '{{ $config->SITE_TIME_FORMAT }}'
          }
        }
      },
      methods: {
        save: function () {
          this.$http.post('setting/general', this.form)
        }
      }
    })
  </script>
@stop
