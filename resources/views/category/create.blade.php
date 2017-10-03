<script type="text/x-template" id="category-create">
  <div>
    <el-button type="primary" @click="modal = true">ADD NEW</el-button>
    <el-dialog title="Create category" :visible.sync="modal" v-loading.body="loading">
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            @foreach (config()->get('multilangual.locales') as $locale)
            <el-input type="text" v-model="form.name.{{ $locale }}" placeholder="Category name" v-show="locale=='{{ $locale }}'"></el-input>
            @endforeach
            <span class="help-block text-danger" v-if="errors.name">@{{ errors.name.toString() }}</span>
          </div>
          <div class="col-md-2">
            <el-select v-model="locale" slot="append" placeholder="Eng">
              @foreach (config()->get('multilangual.locales') as $locale)
              <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
              @endforeach
            </el-select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <el-input type="text" v-model="form.slug" placeholder="Slug"></el-input>
        <span class="help-block text-danger" v-if="errors.slug">@{{ errors.slug.toString() }}</span>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            @foreach (config()->get('multilangual.locales') as $locale)
            <el-input type="textarea" v-model="form.description.{{ $locale }}" placeholder="Description" :rows="4" v-show="locale=='{{ $locale }}'"></el-input>
            @endforeach
            <span class="help-block text-danger" v-if="errors.description">@{{ errors.description.toString() }}</span>
          </div>
          <div class="col-md-2">
            <el-select v-model="locale" slot="append" placeholder="Eng">
              @foreach (config()->get('multilangual.locales') as $locale)
              <el-option label="{{ $locale }}" value="{{ $locale }}"></el-option>
              @endforeach
            </el-select>
          </div>
        </div>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="modal = false">Cancel</el-button>
        <el-button type="primary" @click="create">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</script>
<script>
  Vue.component('category-create', {
    template: '#category-create',
    data: function () {
      return {
        locale: 'en',
        form: { name: {en: '', id: ''}, description: {en: '', id: ''}, slug: ''},
        errors: {},
        modal: false,
        loading: false
      }
    },
    methods: {
      create: function () {
        var that = this
        this.loading = true
        this.$http.post('category', this.form, function(response) {
          Bus.$emit('category-created', response.data.data)
          that.loading = false
          that.modal = false
          that.form = { name: {}, description: {}, slug: ''}
        }, function(error) {
          that.loading = false
          that.errors = error.response.data
        })
      }
    }
  })
</script>
