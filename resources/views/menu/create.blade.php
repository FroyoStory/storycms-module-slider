<script type="text/x-template" id="menu-create">
  <div>
    <el-button type="primary" @click="modal = true">ADD NEW</el-button>
    <el-dialog title="Create New Menu" :visible.sync="modal" v-loading.body="loading">
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
        <label>Parent Menu</label>
        <div>
          <el-select v-model="form.parent_id" placeholder="Select Parent">
            <el-option
              v-for="item in menus"
              :key="item.id"
              :label="item.name[locale]"
              :value="item.id">
            </el-option>
          </el-select>
          <span class="help-block text-danger" v-if="errors.name">@{{ errors.parent_id.toString() }}</span>
        </div>
      </div>
      <div class="form-group">
        <label>Post ID</label>
        <el-input type="text" v-model="form.post_id" placeholder="Post Id"></el-input>
        <span class="help-block text-danger" v-if="errors.post_id">@{{ errors.post_id.toString() }}</span>
      </div>
      <div class="form-group">
        <label>Active</label>
        <el-radio-group v-model="form.active">
          <el-radio-button label="1">Active</el-radio-button>
          <el-radio-button lavel="0">Not Active</el-radio-button>
        </el-radio-group>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="create">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>
<script>
  Vue.component('menu-create', {
    template: '#menu-create',
    data: function () {
      return {
        locale: 'en',
        form: { name: {}, parent_id: 1, url: '', post_id: '', active: 1},
        errors: {},
        modal: false,
        loading: false
      }
    },
    props: {
      menus: { type: Array, required: true}
    },
    methods: {
      create: function () {
        var that = this
        this.loading = true
        this.$http.post('menu', this.form, function(response) {
          Bus.$emit('menu-created', response.data.data)
          that.loading = false
          that.modal = false
          that.form = { name: {}, parent_id: 1, url: '', post_id: '', active: 1}
        }, function(error) {
          that.loading = false
          that.errors = error.response.data
        })
      }
    }
  })
</script>
