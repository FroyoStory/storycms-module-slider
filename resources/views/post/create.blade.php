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
        </div> <!-- End title -->

        <div class="form-group">
          <div class="postbox">
            <editor id="editor-en-content" v-model="form.content.en" v-show="locale=='en'"></editor>
          </div>
        </div>

        <div class="form-group">
          <strong>Excerpt</strong> 
          <el-input
            type="textarea"
            :rows="3"
            placeholder="Please input"
            v-model="form.excerpt">
          </el-input> 
        </div>

      </div>

      <div class="postbox-container">
        <div class="form-group">
          <strong>Post URL</strong>
          <el-input placeholder="Input URL" v-model="form.url"></el-input> 
          </el-input>
        </div>

        <div class="form-group">
          <strong>Post Tags</strong>
          <el-input placeholder="Input Tags" v-model="form.tags"></el-input> 
        </div>

        <div class="form-group">
          <strong>Post Meta Title</strong>
          <el-input placeholder="Input Meta title" v-model="form.meta"></el-input> 
        </div>


        <div class="form-group">
          <strong>Authors</strong>
          <el-select v-model="form.select" style="width:100%">
            <el-option label="Select Authors" value=""></el-option>
            <el-option
              v-for="item in authors" v-bind:value="item.value" :key="item.value">
            </el-option>
          </el-select> 
        </div>

        <div class="form-group">
          <strong>Status</strong>
          <el-select v-model="form.select" style="width:100%">
            <el-option label="Draft" value=""></el-option>
            <el-option
              v-for="item in status" v-bind:value="item.value" :key="item.value">
            </el-option>
          </el-select> 
        </div> 

        <div class="form-group">
          <strong>Post Date</strong>
          <el-date-picker
            v-model="form.value1"
            type="datetime"
            placeholder="Select date and time" style="width:100%">
          </el-date-picker>
        </div>        

          <div class="form-group">
            <strong>Categories</strong>
            <ul style="overflow-Y:scroll; height:200px; list-style: none; border: 1px solid #bfcbd9; padding: 11px;">
              <li v-for="item in categories">
                <el-checkbox v-model="form.checked" :value="item.value" :label="item.label"></el-checkbox>
              </li>
              <label>@{{form.checked}}</label>
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
            url:'',
            tags:'',
            meta:'',
            excerpt:'',
            select: '',
            value1:'',
            checked: [],
          },
            authors: [
              { value: 'Froyoadm' },
              { value: 'Prasaja' },
              { value: 'Aldiawan' }
            ],
            status: [
              { value: 'Draft' },
              { value: 'Pending Review' },
            ],            
          errors: {},
          locale: '{{ App::getLocale() }}',
          categories: [
            {value: 1, label: 'Business'},
            {value: 2, label: 'Campaign'},
            {value: 3, label: 'Creative'},
            {value: 4, label: 'Entertainment'},
            {value: 5, label: 'Opinion'},
            {value: 6, label: 'Story'},
            {value: 7, label: 'Technology'},
            {value: 8, label: 'Trend'},
            {value: 9, label: 'Uncategorized'},
          ],
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
      }
    })
  </script>   
@stop
