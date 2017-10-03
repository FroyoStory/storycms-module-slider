@include('cms::media.upload')
@include('cms::media.update')

<script type="text/x-template" id="media-browser">
  <span>
    <span slot="button" @click="browse">
      <el-button type="primary" icon="picture" size="small">File browser</el-button>
    </span>
    <el-dialog title="File browser" :visible.sync="modal" v-loading.body="loading" size="large">
      <div class="row">
        <div class="col-md-9">
          <el-tabs v-model="activeName">
            <el-tab-pane label="Media Library" name="library">
              <div class="row">
                <div class="col-md-2" v-for="media in medias">
                  <figure style="min-height: 300px; cursor: pointer;" @click="pick(media)">
                    <img :src="media.slug" class="img-responsive" />
                    <?php echo '{{ media.title.'.App::getLocale() .' }}' ?>
                  </figure>
                </div>
              </div>
            </el-tab-pane>
            <el-tab-pane label="Upload file" name="upload">
              <media-upload v-on:upload-success="handleUploadSuccess"></media-upload>
            </el-tab-pane>
          </el-tabs>
        </div>
        <div class="col-md-3" v-if="image != null">
          <img :src="image.slug" class="img-responsive" />
          <div class="form-group">
            <label>URL</label>
            <el-input type="text" v-model="image.slug"></el-input>
          </div>
          <div class="form-group">
            <label>Title / Caption</label>
            <el-input type="text" v-model="image.title.{{ App::getLocale() }}"></el-input>
          </div>
        </div>
      </div>
      <div slot="footer">
        <div class="form-group">
          <el-button type="primary" @click="selectImage">Set featured image</el-button>
        </div>
      </div>
    </el-dialog>
  </span>
</script>
<script>
  Vue.component('media-browser', {
    template: '#media-browser',
    data: function () {
      return {
        activeName: 'library',
        modal: false,
        loading: false,
        medias: [],
        image: null
      }
    },
    methods: {
      init: function () {
        var self = this
        self.$http.get('media', {}, function(response) {
          self.medias = response.data.data
        })
      },
      browse: function () {
        this.init()
        this.modal = !this.modal
      },
      pick: function (media) {
        if (media != this.image) {
          this.image = media
        } else {
          this.image = null
        }
      },
      handleUploadSuccess: function (response) {
        this.medias.push(response.data)
        this.image = response.data
      },
      selectImage: function () {
        if (this.image == null) {
          this.$notify({
            title: 'Error',
            message: 'You must upload or select an image.',
            type: 'warning'
          });
        } else {
          this.modal = false
          this.$emit('image-selected', this.image)
        }
      }
    }
  })
</script>
