<script type="text/x-template" id="category-update">
  <div>

    <el-button type="primary" @click="modal = true">EDIT</el-button>
    <el-dialog title="Create category" :visible.sync="modal" v-loading.body="loading">
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            <el-input type="text" v-model="form.name.en" placeholder="Category name" v-show="locale=='en'"></el-input>
            <el-input type="text" v-model="form.name.id" placeholder="Category name" v-show="locale=='id'"></el-input>
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
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-10">
            <el-input type="textarea" v-model="form.description.en" placeholder="Category name" :rows="4" v-show="locale=='en'"></el-input>
            <el-input type="textarea" v-model="form.description.id" placeholder="Category name" :rows="4" v-show="locale=='id'"></el-input>
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
