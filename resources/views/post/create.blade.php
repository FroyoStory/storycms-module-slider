@extends('cms::layouts.app')

@section('title') Post Pages @stop

@section('content')
<div class="container-fluid">
  <post-create></post-create>
</div>
@stop

@section('js')
  @parent
  @include('cms::post.editor')
  <script type="text/x-template" id="post-create">
    <div class="clearfix">
      {{-- <div class="postbox-container-editor">
        <div class="form-group">
          <div class="row">
            <div class="col-md-10">
              <el-input type="text" v-model="form.title.en" placeholder="Enter title name" v-show="locale=='en'"></el-input>
              <el-input type="text" v-model="form.title.id" placeholder="Enter title name" v-show="locale=='id'"></el-input>
              <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
            </div>
            <div class="col-md-2">
              <el-select v-model="locale" slot="append" placeholder="Eng">
                @foreach(config('multilangual.locales') as $locale)
                <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
                @endforeach
              </el-select>
            </div>
          </div>
        </div> <!-- End title -->
        <div class="form-group">
          <div class="row">
            <div class="col-md-10">
              <editor id="editor-en-content" v-model="form.content.en" v-show="locale=='en'"></editor>
            </div>
            <div class="col-md-2">
              <el-select v-model="locale" slot="append" placeholder="Eng">
                @foreach(config('multilangual.locales') as $locale)
                <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
                @endforeach
              </el-select>
            </div>
        </div><!-- End content -->
      </div> --}}
      <div class="postbox">
        <editor id="editor-en-content" v-model="form.content.en" v-show="locale=='en'"></editor>
      </div>
    </div>
  </script>
  <script>
    Vue.component('post-create', {
      template: '#post-create',
      data: function () {
        return {
          form: {
            title: {},
            content: {
              en: 'Content', id: 'Kontent'
            },
          },
          errors: {},
          locale: '{{ App::getLocale() }}'
        }
      },
      methods: {
        change: function (val) {

        }
      }
    })
  </script>
</script>
@stop
