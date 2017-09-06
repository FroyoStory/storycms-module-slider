<script type="text/x-template" id="category-update">
  <div>
    <el-button type="primary" @click="modal = true">EDIT</el-button>
    <el-dialog title="Create category" :visible.sync="modal" v-loading.body="loading">
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            <el-input type="text" v-model="form.name.en" placeholder="Category name" v-show="locale=='en'"></el-input>
            <el-input type="text" v-model="form.name.id" placeholder="Category name" v-show="locale=='id'"></el-input>
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
        <el-input type="text" v-model="form.slug" placeholder="Slug"></el-input>
        <span class="help-block text-danger" v-if="errors.slug">@{{ errors.slug.toString() }}</span>
      </div>
      <div class="form-group">
        <el-select v-model="form.parent_id" placeholder="Select">
          <el-option
            v-for="item in categories"
            :key="item.id"
            :label="item.name[locale]"
            :value="item.id">
          </el-option>
        </el-select>
        <span class="help-block text-danger" v-if="errors.name">@{{ errors.parent_id.toString() }}</span>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            <el-input type="textarea" v-model="form.description.en" placeholder="Description" :rows="4" v-show="locale=='en'"></el-input>
            <el-input type="textarea" v-model="form.description.id" placeholder="Description" :rows="4" v-show="locale=='id'"></el-input>
            <span class="help-block text-danger" v-if="errors.description">@{{ errors.description.toString() }}</span>
          </div>
          <div class="col-md-2">
            <el-select v-model="locale" slot="append" placeholder="Eng">
              <el-option label="en" value="en"></el-option>
              <el-option label="id" value="id"></el-option>
            </el-select>
          </div>
        </div>
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
  Vue.component('category-update', {
    template: '#category-update',
    data: function () {
      return {
        locale: 'en',
        modal: false,
        loading: false,
        errors: {}
      }
    },
    props: {
      categories: { type: Array, required: true },
      form: { type: Object, required: true }
    },
    methods: {
      update () {
        var that = this
        this.loading = true
        this.$http.put('category/' + this.form.id, this.form, function(response) {
          Bus.$emit('category-updated', response.data.data)
          that.loading = false
          that.modal = false
        }, function(error) {
          that.errors = error.response.data
          that.loading = false
        })
      },
      destroy () {
        var that = this
        this.$http.delete('category/' + this.form.id, {}, function(response) {
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
