<script type="text/x-template" id="menu-update">
  <div>
    <el-button type="primary" @click="modal = true">EDIT</el-button>
    <el-dialog title="Update menu" :visible.sync="modal" v-loading.body="loading">
      <div class="form-group">
        <label>Menu Name</label>
        <div class="row">
          <div class="col-md-10">
            <el-input type="text" v-model="form.name.en" placeholder="Menu name" v-show="locale=='en'"></el-input>
            <el-input type="text" v-model="form.name.id" placeholder="Menu name" v-show="locale=='id'"></el-input>
            <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
          </div>
          <div class="col-md-2">
            <el-select v-model="locale" slot="append" placeholder="Eng">
              <el-option label="en" value="en"></el-option>
              <el-option label="id" value="id"></el-option>
            </el-select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Menu Url</label>
        <el-input type="text" v-model="form.url" placeholder="Url"></el-input>
        <span class="help-block text-danger" v-if="errors.url">@{{ errors.url.toString() }}</span>
      </div>
      <div class="form-group">
        <label>Post ID</label>
        <el-input type="text" v-model="form.post_id" placeholder="Post Id"></el-input>
        <span class="help-block text-danger" v-if="errors.post_id">@{{ errors.post_id.toString() }}</span>
      </div>
      <div class="form-group">
        <label>Active?   </label>
        <el-switch
          v-model="form.active"
          on-color="#13ce66"
          off-color="#ff4949"
          :on-value="1"
          :off-value="0">
        </el-switch>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button type="danger" @click="destroy">Destory</el-button>

        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="update">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>
<script>
  Vue.component('menu-update', {
    template: '#menu-update',
    data: function () {
      return {
        locale: 'en',
        modal: false,
        loading: false,
        errors: {}
      }
    },
    props: {
      menus: { type: Array, required: true },
      form: { type: Object, required: true }
    },
    methods: {
      update: function() {
        var that = this
        this.loading = true
        this.$http.put('menu/' + this.form.id, this.form, function(response) {
          Bus.$emit('menu-updated', response.data.data)
          that.loading = false
          that.modal = false
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      },
      destroy: function() {
        var that = this
        this.$http.delete('menu/' + this.form.id, {}, function(response) {
          Bus.$emit('menu-destroyed', that.form)
          that.loading = false
          that.modal = false
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      }
    }
  })
</script>
