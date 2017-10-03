@extends('cms::layouts.app')

@section('title') Post Update @stop

@section('content')
<div class="container-fluid">
  <post-edit></post-edit>
</div>
@stop

@section('js')
  @parent
  @include('cms::post.editor')
  <script type="text/x-template" id="post-edit">
    <div class="clearfix" v-loading.body="loading">
      <div class="postbox-container-editor">
        <div class="form-group">
          <div class="row">
            <div class="col-md-11">
              @foreach (config()->get('multilangual.locales') as $locale)
              <el-input type="text" size="large" v-model="form.title.{{ $locale }}" placeholder="Enter title name" v-show="locale=='{{ $locale }}'"></el-input>
              @endforeach
              <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
            </div>
            <div class="col-md-1">
              <el-select v-model="locale" slot="append" placeholder="Eng">
                @foreach (config()->get('multilangual.locales') as $locale)
                <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
                @endforeach
              </el-select>
            </div>
          </div>

          <p class="help-block">
            <strong>Permalink:</strong>
            <span v-show="permalink == false">
              <?php echo str_replace($post->slug, '{{ form.slug }}', $post->url) ;?> <el-button size="mini" @click="permalink = true">Edit</el-button>
            </span>
            <span v-show="permalink == true">
              {!! str_replace($post->slug, ' <div class="el-input el-input--mini" style="min-width: 300px; width: auto"><input v-model="form.slug" autocomplete="off" size="mini" type="text" rows="2" validateevent="true" class="el-input__inner"></div> ', $post->url) !!} <el-button size="mini" @click="permalink = false">OK</el-button>
            </span>
          </p>

        </div>

        <div class="form-group">
          <div class="postbox">
            <div class="row">
              <div class="col-md-11">
                @foreach (config()->get('multilangual.locales') as $locale)
                <editor id="editor-{{ $locale }}-content" v-model="form.content.{{ $locale }}" v-show="locale=='{{ $locale }}'"></editor>
                @endforeach
              </div>
              <div class="col-md-1">
                <el-select v-model="locale" slot="append" placeholder="Eng">
                  @foreach (config()->get('multilangual.locales') as $locale)
                  <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
                  @endforeach
                </el-select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Excerpt</label>
          <div class="row">
            <div class="col-md-11">
              @foreach (config()->get('multilangual.locales') as $locale)
              <el-input type="textarea" :rows="3" placeholder="Please input your excerpt"  v-model="form.excerpt.{{ $locale }}" v-show="locale=='{{ $locale }}'"></el-input>
              @endforeach
            </div>
            <div class="col-md-1">
              <el-select v-model="locale" slot="append" placeholder="Eng">
                @foreach (config()->get('multilangual.locales') as $locale)
                <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
                @endforeach
              </el-select>
            </div>
          </div>
        </div>
      </div>

      <div class="postbox-container">
        <div class="form-group">
          <el-select v-model="form.post_status" style="width:100%">
            <el-option label="Select Status" value=""></el-option>
            <el-option v-for="item in status" v-bind:value="item.value" :key="item.value"></el-option>
          </el-select>
        </div>

        <div class="form-group">
          <label>Post Date</label>
          <el-date-picker v-model="form.publish_date" type="datetime" format="yyyy-MM-dd HH:mm:ss" placeholder="Select date and time" style="width:100%"></el-date-picker>
        </div>

        @if (request()->input('type') != 'page')
        <div class="form-group">
          <label>Categories</label>
          @include('cms::post._category')
        </div>
        @endif

        @if (request()->input('type') == 'page')
        <div class="form-group">
          <label>Template</label>
          <el-select v-model="form.meta.template" style="display: block">
            @foreach($templates as $template)
            <el-option label="{{ $template }}" value="{{ $template }}"></el-option>
            @endforeach
          </el-select>
        </div>
        @endif

        <div class="form-group">
          <el-button type="primary" @click="update">Save post</el-button>
        </div>

        <hr />

        @include('cms::post._thumbnail')

        <div class="form-group">
          <label>Post Meta Title</label>
          <el-input placeholder="Input Meta title" v-model="form.meta.title"></el-input>
        </div>

        <div class="form-group">
          <label>Post Meta Description</label>
          <el-input type="textarea" :rows="3" placeholder="Input Meta Description" v-model="form.meta.description"> </el-input>
        </div>

        <div class="form-group">
          <label style="display: block;">Post Tags</label>
          <el-tag style="background-color:#ffbd28; margin: 0 5px 5px 0; "
            :key="tag"
            v-for="tag in form.tags"
            :closable="true"
            :close-transition="false"
            @close="handleClose(tag)">
            @{{tag}}
          </el-tag>

            <li style="list-style: none">
              <el-input
                class="input-new-tag"
                v-if="tag.visible"
                v-model="tag.input"
                ref="saveTagInput"
                size="small"
                @keyup.enter.native="handleInputConfirm"
                @blur="handleInputConfirm">
              </el-input>
              <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Tag</el-button>
            </li>
        </div>

      </div>
    </div>
  </script>

  <script>
    Vue.component('post-edit', {
      template: '#post-edit',
      data: function () {
        return {
          form: {
            id: {{ $post->id }},
            slug: '{{ $post->slug }}',
            title: {!! json_encode($post->getAttributeValue('title'), JSON_FORCE_OBJECT) !!},
            content: {!! json_encode($post->getAttributeValue('content'), JSON_FORCE_OBJECT) !!},
            excerpt: {!! json_encode($post->getAttributeValue('excerpt'), JSON_FORCE_OBJECT) !!},
            meta: {!! $post->meta !!},
            post_status: '{{ $post->post_status }}',
            publish_date: '{{ $post->publish_date->format('Y-m-d H:i:s') }}',
            categories: {!! $post->category->pluck('id') !!},
            tags: {!! $post->tags->pluck('name') !!},
            type: '{{ $post->type }}'
          },
          tag: {
            input: '',
            visible: false
          },
          status: [
            { label: 'Draft', value: 'draft' },
            { label: 'Pending Review', value: 'pending' },
            { label: 'Publish', value: 'publish' }
          ],
          permalink: false,
          loading: false,
          errors: {},
          locale: '{{ App::getLocale() }}',
        }
      },
      computed: {
        slug: function() {
          return this.sanitizeTitle(this.form.title.en);
        }
      },
      methods: {
        update: function () {
          var that = this
          that.loading = true
          this.$http.put('post/' + this.form.id, this.form, function(response) {
            Bus.$emit('post-created', response.data.data)
            that.loading = false
          },
          function(error) {
            that.loading = false
            that.errors = error.response.data
          })
        },

        /*taken from: https://codepen.io/tatthien/pen/xVBxZQ*/
        sanitizeTitle: function(title) {
          var slug = "";
          // Change to lower case
          var titleLower = title.toLowerCase();
          // Letter "e"
          slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
          // Letter "a"
          slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
          // Letter "o"
          slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
          // Letter "u"
          slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
          // Letter "d"
          slug = slug.replace(/đ/gi, 'd');
          // Trim the last whitespace
          slug = slug.replace(/\s*$/g, '');
          // Change whitespace to "-"
          slug = slug.replace(/\s+/g, '-');

          return slug;
        },

        handleClose: function (tag) {
          this.form.tags.splice(this.form.tags.indexOf(tag), 1);
        },

        handleImageSelected: function (image) {
          this.form.meta.featured_image = image.slug
        },

        showInput: function () {
          this.tag.visible = true;
          this.$nextTick(function () {
            this.$refs.saveTagInput.$refs.input.focus();
          });
        },

        handleInputConfirm: function () {
          if (this.tag.input) {
            this.form.tags.push(this.tag.input);
          }
          this.tag.visible = false;
          this.tag.input = '';
        },
      }
    })
  </script>
@stop
