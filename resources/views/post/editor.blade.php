@include('cms::media.browser')
<script type="text/x-template" id="editor">
  <div id="wp-content-wrap" class="wp-core-ui wp-editor-wrap has-dfw" :class="html_editor == true ? 'tmce-active': 'html-active'">
    <media-browser v-on:image-selected="handleImageSelected"></media-browser>
    <div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
        {{-- <div id="wp-content-media-buttons" class="wp-media-buttons">
          <button type="button" id="insert-media-button" class="button insert-media add_media" data-editor="content"><span class="wp-media-buttons-icon"></span> Add Media</button>
        </div> --}}
        <div class="wp-editor-tabs">
          <button type="button" id="content-tmce" class="wp-switch-editor switch-tmce" @click="swap">Visual</button>
          <button type="button" id="content-html" class="wp-switch-editor switch-html" @click="swap">Text</button>
        </div>
    </div>
    <div id="wp-content-editor-container" class="wp-editor-container">
        <div id="ed_toolbar" class="quicktags-toolbar"></div>
        <div :class="html_editor == true ? '': 'hide'">
          <textarea :id="editorId.tinymce" v-model="content" ref="WysigEditor" style=""></textarea>
        </div>
        <div :class="html_editor == true ? 'hide': ''">
          <textarea :id="editorId.ace" v-model="content" class="form-control" rows="10"></textarea>
        </div>
    </div>
  </div>
</script>
<link rel="stylesheet" href="/vendor/storycms/css/editor.css" type="text/css" media="all" />
<script type="text/javascript" src="/vendor/storycms/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/vendor/storycms/js/ace/ace.js"></script>
<script type="text/javascript" src="/vendor/storycms/js/vkbeautify.0.99.00.beta.js"></script>
<script>
  Vue.component('editor', {
    template: '#editor',
    data: function () {
      return {
        html_editor: true,
        content: '',
        editorId: {},
        focus: 'tinymce',
        tinymce: null,
        ace: null
      }
    },
    props: {
      id: {type: String, required: true },
      value: { type: String, required: true },
      height: { required: false, default: 300 }
    },
    watch: {
      'content': function (value, before) {
        if (value && this.tinymce && this.focus == 'ace') {
          this.tinymce.get(this.editorId.tinymce).setContent(value)
        } else if (value && this.ace && this.focus == 'tinymce') {
          this.ace.setValue(vkbeautify.xml(value), 1)
        }
      }
    },
    mounted: function () {
      this.content = this.value
      this.tinymce = tinymce
      this.editorId = {
        ace: 'ace-' + this.id,
        tinymce: 'tinymce-' + this.id
      }

      this.initTinyMCE()
      this.initAce()
    },
    methods: {
      initTinyMCE: function () {
        this.$nextTick(function () {
          var self = this;
          var options = {
            selector: '#tinymce-' + this.id, formats: {alignleft: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"left"}}, {selector: "img,table,dl.wp-caption", classes: "alignleft"}],aligncenter: [ {selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"center"}},{selector: "img,table,dl.wp-caption", classes: "aligncenter"}],alignright: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"right"}},{selector: "img,table,dl.wp-caption", classes: "alignright"}],strikethrough: {inline: "del"}}, content_css:["/vendor/storycms/js/tinymce/skins/wordpress/wp-content.css?ver=4.8.1",],plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,fullscreen,autoresize",menubar: false,wpautop:true,indent:false,branding: false, remove_script_host:false,  toolbar1:"formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink", toolbar2:"strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,fullscreen", indent: false, protect: [/\<\/?(if|endif)\>/g, /\<xsl\:[^>]+\>/g, /<\?php.*?\?>/g ], height: self.height,
            setup: function (editor) {
              editor.on('NodeChange Change keyup', function () {
                self.content = this.getContent()
                self.focus = 'tinymce'
                self.$emit('input', self.content)
                self.$emit('change', self.content)
              })
              editor.on('init', function () {
                self.$emit('input', self.content)
              })
            }
          }
          this.tinymce.init(options)
        })
      },
      initAce: function () {
        this.$nextTick(function () {
          var self = this
          this.ace = window.ace.edit(this.editorId.ace)
          this.ace.getSession().setMode(`ace/mode/html`)
          this.ace.getSession().setUseWrapMode(true)
          this.ace.setTheme(`ace/theme/chrome`)
          this.ace.setOptions({ maxLines: Infinity })
          this.ace.$blockScrolling = Infinity;
          this.ace.on('change', function () {
            self.content = self.ace.getValue()
          })
          this.ace.on('focus', function () {
            self.focus = 'ace'
          })
        })
      },
      swap: function () {
        // rerender ace editor
        this.ace.resize()
        this.ace.renderer.updateFull()

        return this.html_editor = !this.html_editor
      },
      handleImageSelected: function (image) {
        var temp = '<figure class="image"><img src="'+image.slug+'" alt="'+image.title.{{ App::getLocale()}}+'" /><figcaption>'+image.title.{{ App::getLocale()}}+'</figcaption></figure>'
        this.tinymce.activeEditor.execCommand('mceInsertContent', false, temp)
        // this.tinymce.
      }
    },
    beforeDestroy: function (){
      this.tinymce.instance.remove()
      this.ace.destroy()
    },

  })
</script>
