<script type="text/x-template" id="user-create">
  <div>
    <el-button type="primary" @click="modal = true">ADD NEW</el-button>
    <el-dialog title="Create user" :visible.sync="modal" v-loading.body="loading">
      <div class="form-group">
        <el-input type="text" v-model="form.name" placeholder="Please input user name"></el-input>
        <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
      </div>
      <div class="form-group">
        <el-input type="text" v-model="form.email" placeholder="Please input user email"></el-input>
        <span class="help-block text-danger" v-if="errors.email">@{{ errors.email.toString() }}</span>
      </div>
      <div class="form-group">
        <el-input type="password" v-model="form.password" placeholder="Password"></el-input>
        <span class="help-block text-danger" v-if="errors.password">@{{ errors.password.toString() }}</span>
      </div>
      <div class="form-group">
        <el-input type="password" v-model="form.confirm_password" placeholder="Confirm password"></el-input>
        <span class="help-block text-danger" v-if="errors.confirm_password">@{{ errors.confirm_password.toString() }}</span>
      </div>
      <div class="form-group">
        <el-select v-model="form.role_id" slot="append" placeholder="User role">
          @foreach ($roles as $role)
            <el-option label="{{ $role->name }}" value="{{ $role->id }}"></el-option>
          @endforeach
        </el-select>
        <span class="help-block text-danger" v-if="errors.role_id">@{{ errors.role_id.toString() }}</span>
      </div>

      <span slot="footer" class="dialog-footer">
        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="create">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>

<script>
  Vue.component('user-create', {
    template: '#user-create',
    data: function () {
      return {
        form: { username: '', email: '', password: '', confirm_password: '', role_id: '' },
        errors: {},
        modal: false,
        loading: false
      }
    },
    methods: {
      create: function () {
        var that = this
        that.loading = true

        this.$http.post('user', this.form, function(response) {
          Bus.$emit('user-created', response.data.data)
          that.loading = false
          that.modal = false
          that.form = { username: '', email: '', password: '', confirm_password: '', role_id: '' }
        }, function(error) {
          that.loading = false
          that.errors = error.response.data
        })
      }
    }
  })
</script>
