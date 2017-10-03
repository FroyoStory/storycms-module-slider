<div class="form-group">
  <label>Featured image</label>
  <div>
    <img :src="form.meta.featured_image" class="img-responsive" v-show="form.meta.featured_image" style="margin-bottom: 10px">
    <el-button type="danger" icon="picture" size="small" @click="form.meta.featured_image = ''" v-show="form.meta.featured_image">Remove featured image</el-button>
  </div>

  <media-browser v-on:image-selected="handleImageSelected" v-show="!form.meta.featured_image"></media-browser>
</div>
