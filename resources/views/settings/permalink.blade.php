@extends('cms::layouts.app')

@section('title') Permalink Settings @stop

@section('content')

<div class="container-fluid">
  <p>Story CMS offers you the ability to create a custom URL structure for your permalinks and archives. Custom URL structures can improve the aesthetics, usability, and forward-compatibility of your links. A number of tags are available, and here are some examples to get you started.</p>
  <setting-permalink></setting-permalink>
</div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="setting-permalink">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <el-radio class="radio" v-model="form.site_permalink" label="/{year}/{month}/{day}/{postname}/">Day and name</el-radio>
            </div>
            <div class="col-md-9"><p style="margin: 10px 0">https://domain.id/2017/09/06/sample-post/</p></div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <el-radio class="radio" v-model="form.site_permalink" label="/{year}/{month}{postname}/">Mont and name</el-radio>
            </div>
            <div class="col-md-9"><p style="margin: 10px 0">https://domain.id/2017/09/sample-post/</p></div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <el-radio class="radio" v-model="form.site_permalink" label="/{postname}/">Post name</el-radio>
            </div>
            <div class="col-md-9"><p style="margin: 10px 0">https://domain.id/sample-post/</p></div>
          </div>
        </div>

        <hr />
        <div class="form-group">
          <el-button type="primary" @click="save">Save setting</el-button>
        </div>
      </div>
    </div>
  </script>
  <script>
    Vue.component('setting-permalink', {
      template: '#setting-permalink',
      data: function () {
        return {
          form: {
            site_permalink: '{!! $config->SITE_PERMALINK !!}'
          }
        }
      },
      methods: {
        save: function () {
          this.$http.post('setting/permalink', this.form)
        }
      }
    })
  </script>
@stop
