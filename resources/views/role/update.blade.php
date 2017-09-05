<script type="text/x-template" id="role-update">
  <div>
    <el-button type="primary" @click="modal = true">UPDATE</el-button>
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
        <el-button type="danger" @click="destroy">Destory</el-button>

        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="update">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>
<script>
  Vue.component('role-update', {
    template: '#role-update',
    data: function () {
      return {
        modal: false,
        loading: false,
        errors: {}
      }
    },
    props: {
      form: { type: Object, required: true }
    },
    methods: {
      update: function () {
        var that = this
        that.loading = true
        this.$http.put('role/' + this.form.id, this.form, function(response) {
          that.loading = false
          that.modal = false
          that.form = { name: '', description: '' }
          Bus.$emit('role-updated', response.data.data)
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      },
      destroy: function () {
        var that = this
        this.$http.delete('role/' + this.form.id, {}, function(response) {
          that.loading = false
          that.modal = false
          Bus.$emit('role-destroyed', that.form)
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      }
    }
  })
</script>
