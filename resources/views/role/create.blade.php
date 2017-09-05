<script type="text/x-template" id="role-create">
  <div>
    <el-button type="primary" @click="modal = true">ADD NEW</el-button>
    <el-dialog title="Create role" :visible.sync="modal" v-loading.body="loading">
      <div class="form-group">
        <el-input type="text" v-model="form.name" placeholder="Role name"></el-input>
        <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
      </div>
      <div class="form-group">
        <el-input type="textarea" v-model="form.description" :rows="4" placeholder="Role description"></el-input>
        <span class="help-block text-danger" v-if="errors.description">@{{ errors.email.toString() }}</span>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="create">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>
<script>
  Vue.component('role-create', {
    template: '#role-create',
    data: function () {
      return {
        form: { name: '', description: '' },
        modal: false,
        loading: false,
        errors: {}
      }
    },
    methods: {
      create: function () {
        var that = this
        that.loading = true
        this.$http.post('role', this.form, function(response) {
          Bus.$emit('role-created', response.data.data)
          that.loading = false
          that.modal = false
          that.form = { name: '', description: '' }
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      }
    }
  })
</script>
