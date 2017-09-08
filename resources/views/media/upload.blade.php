<script type="text/x-template" id="media-upload">
  <el-upload class="upload-demo" drag action="/backend/media" :data="form" :on-preview="handlePreview" :on-remove="handleRemove">
    <i class="el-icon-upload"></i>
    <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
    <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
  </el-upload>
</script>
<script>
  Vue.component('media-upload', {
    template: '#media-upload',
    data: function () {
      return {
        form: {
          _token: '{{ csrf_token() }}'
        }
      }
    },
    methods: {
      handlePreview: function () {

      },
      handleRemove: function () {

      }
    }
  })
</script>
