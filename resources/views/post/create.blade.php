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

      <div class="postbox-container-editor">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <el-input type="text" v-model="form.title.en" placeholder="Enter title name" v-show="locale=='en'"></el-input>
              <el-input type="text" v-model="form.title.id" placeholder="Enter title name" v-show="locale=='id'"></el-input>
              <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
              <p class="help-block"><?php echo url('/').'/{{ slug }}' ;?></p>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="postbox">
            <editor id="editor-en-content" v-model="form.content.en" v-show="locale=='en'"></editor>
          </div>
        </div>

        <div class="form-group">
          <label>Excerpt</label>
          <el-input
            type="textarea"
            :rows="3"
            placeholder="Please input your excerpt"
            v-model="form.content.en"
            v-show="locale=='en'">
          </el-input>
        </div>
      </div>

      <div class="postbox-container">
        <div class="form-group">
          <label>Post URL</label>
          <el-input placeholder="Input URL" v-model="form.url"></el-input>
          </el-input>
        </div>


        <div class="form-group">
          <label>Post Meta Title</label>
          <el-input placeholder="Input Meta title" v-model="form.meta_title"></el-input>
        </div>

        <div class="form-group">
          <label>Post Meta Description</label>
          <el-input
            type="textarea"
            :rows="3"
            placeholder="Input Meta Description"
            v-model="form.meta_desc">
          </el-input>
        </div>

        <div class="form-group">
          <label>Post Tags</label>
            <li style="list-style: none">
              <el-tag style="background-color:#ffbd28; margin: 0 5px 5px 0; "
                :key="tag"
                v-for="tag in form.dynamicTags"
                :closable="true"
                :close-transition="false"
                @close="handleClose(tag)">
                @{{tag}}
              </el-tag>
            </li>

            <li style="list-style: none">
              <el-input
                class="input-new-tag"
                v-if="form.inputVisible"
                v-model="form.tags"
                ref="saveTagInput"
                size="small"
                @keyup.enter.native="handleInputConfirm"
                @blur="handleInputConfirm">
              </el-input>
              <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Tag</el-button>
            </li>
        </div>

        <div class="form-group">
          <label>Status</label>
          <el-select v-model="form.status" style="width:100%">
            <el-option label="Select Status" value=""></el-option>
            <el-option
              v-for="item in status" v-bind:value="item.value" :key="item.value">
            </el-option>
          </el-select>
        </div>

        <div class="form-group">
          <label>Post Date</label>
          <el-date-picker
            v-model="form.publish_date"
            type="datetime"
            placeholder="Select date and time" style="width:100%">
          </el-date-picker>
        </div>

        <div class="form-group">
          <label>Categories</label>
          <ul style="overflow-Y:scroll; height:200px; list-style: none; border: 1px solid #bfcbd9; padding: 11px;">
            @foreach ($categories as $category)
            <li>
              <el-checkbox
                v-model="form.categories_id"
                value="{{ $category->id}}"
                label="{{ $category->name }}">
              </el-checkbox>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="form-group">
          <el-button type="primary" @click="create">Publish</el-button>
        </div>

      </div>
    </div>
  </script>

  <script>
    Vue.component('post-create', {
      template: '#post-create',
      data: function () {
        return {
          form: {
            title: { en:'' , id:''},
            content: { en: '', id: ''},
            excerpt: { en: '', id: ''},
            url:'',
            meta_title:'',
            meta_desc:'',
            status:'',
            publish_date:'',
            categories_id: [],
            tags:'',
            dynamicTags: [],
            inputVisible: false,
          },
          status: [
            { value: 'Draft' },
            { value: 'Pending Review' },
          ],
          errors: {},
          locale: '{{ App::getLocale() }}',
        }
      },
      computed: {
        slug: function() {
          return slug = this.sanitizeTitle(this.form.title.en);
        }
      },
      methods: {
        create: function () {
          var that = this
          that.loading = true
          this.$http.post('post', this.form, function(response) {
            Bus.$emit('post-created', response.data.data)
            that.loading = false
            that.modal = false
            that.form= { content: {en: 'Content', id: 'Kontent'}, url:'', tags:'', excerpt:'', select: '' }
          }, function(error) {
            that.loading = false
            that.errors = error.response.data
          })
        },

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

        handleClose(tag) {
          this.form.dynamicTags.splice(this.form.dynamicTags.indexOf(tag), 1);
        },

        showInput() {
          this.form.inputVisible = true;
          this.$nextTick(_ => {
            this.$refs.saveTagInput.$refs.input.focus();
          });
        },

        handleInputConfirm() {
          let tags = this.form.tags;
          if (tags) {
            this.form.dynamicTags.push(tags);
          }
          this.form.inputVisible = false;
          this.form.tags = '';
        },
      }
    })
  </script>
@stop
