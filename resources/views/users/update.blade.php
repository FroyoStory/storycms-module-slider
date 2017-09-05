<script type="text/x-template" id="user-update">
  <div>
    <el-button type="primary" @click="modal = true">EDIT</el-button>
    <el-dialog title="Create user" :visible.sync="modal" v-loading="loading">
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
            <el-option label="{{ $role->name }}" :value="{{ $role->id }}"></el-option>
          @endforeach
        </el-select>
        <span class="help-block text-danger" v-if="errors.role_id">@{{ errors.role_id.toString() }}</span>
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
  Vue.component('user-update', {
    template: '#user-update',
    data: function () {
      return {
        modal: false,
        loading: true,
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
        this.$http.put('user/' + this.form.id, this.form, function(response) {
          Bus.$emit('user-updated', response.data.data)
          that.loading = false
          that.modal = false
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      },
      destroy: function () {
        var that = this
        this.$http.delete('user/' + this.form.id, {}, function(response) {
          Bus.$emit('category-destroyed', that.form)
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
