@extends('cms::layouts.app')

@section('title') Media Settings @stop

@section('content')
<div class="container-fluid">
  <h2>Image sizes</h2>
  <p>The sizes listed below determine the maximum dimensions in pixels to use when adding an image to the Media Library.</p>
  <br />
  <setting-media />
</div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="setting-media">
    <div>
      <div class="row">
        <div class="col-md-3"><label>Thumbnail size</label></div>
        <div class="col-md-2">
          <div class="form-group">
            <el-input type="text" v-model="form.site_media_thumbnail.width" placeholder="width"></el-input>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <el-input type="text" v-model="form.site_media_thumbnail.height" placeholder="height"></el-input>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"><label>Medium size</label></div>
        <div class="col-md-2">
          <div class="form-group">
            <el-input type="text" v-model="form.site_media_medium.width" placeholder="width"></el-input>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <el-input type="text" v-model="form.site_media_medium.height" placeholder="height"></el-input>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"><label>Large size</label></div>
        <div class="col-md-2">
          <div class="form-group">
            <el-input type="text" v-model="form.site_media_large.width" placeholder="width"></el-input>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <el-input type="text" v-model="form.site_media_large.height" placeholder="height"></el-input>
          </div>
        </div>
      </div>

      <hr />
      <div class="form-group">
        <el-button type="primary" @click="save">Save setting</el-button>
      </div>
    </div>
  </script>
  <script>
    Vue.component('setting-media', {
      template: '#setting-media',
      data: function () {
        return {
          form: {
            site_media_thumbnail: {!! json_encode($config['thumbnail']) !!},
            site_media_medium: {!! json_encode($config['medium']) !!},
            site_media_large: {!! json_encode($config['large']) !!},
          }
        }
      },
      methods: {
        save: function () {
          this.$http.post('setting/media', this.form)
        }
      }
    })
  </script>
@stop
