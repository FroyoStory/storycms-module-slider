<script type="text/x-template" id="media-update">
  <div>
    <figure style="min-height: 300px; cursor: pointer;" @click="modal=true">
      <img :src="media.slug" class="img-responsive" />
      <?php echo '{{ media.title.'.App::getLocale() .' }}' ?>
    </figure>
    <el-dialog title="Media" :visible.sync="modal" v-loading.body="loading">

      <div class="form-group">
        <label>URL</label>
        <el-input placeholder="Please input" v-model="media.slug" :disabled="true"></el-input>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            <el-input type="text" v-model="media.title.en" placeholder="Media title" v-show="locale=='en'"></el-input>
            <el-input type="text" v-model="media.title.id" placeholder="Media title" v-show="locale=='id'"></el-input>
            <span class="help-block text-danger" v-if="errors.title">@{{ errors.title.toString() }}</span>
          </div>
          <div class="col-md-2">
            <el-select v-model="locale" slot="append" placeholder="Eng">
              @foreach(config()->get('multilangual.locales') as $locale)
              <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
              @endforeach
            </el-select>
          </div>
        </div>
      </div>

      <hr />

      <img :src="media.slug" class="img-responsive" />

      <span slot="footer" class="dialog-footer">
        <el-button type="danger" @click="destroy">Destory</el-button>

        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="update">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>
<script>
  Vue.component('media-update', {
    template: '#media-update',
    data: function () {
      return {
        loading: false,
        modal: false,
        locale: '{{ App::getLocale() }}',
        errors: {}
      }
    },
    props: {
      media: { type: Object, required: true }
    },
    methods: {
      destroy: function () {
        var that = this
        that.loading = true
        that.$http.delete('media/' + this.media.id, {}, function (response) {
          that.loading = false
          that.modal = false
        }, function (error) {
          console.log(error)
        })
      },
      update: function () {
        var that = this
        that.loading = true
        that.$http.put('media/'+ this.media.id, this.media, function (response) {
          that.loading = false
          that.modal = false
        }, function (error) {
          console.log(error)
        })
      }
    }
  })
</script>
