<script type="text/x-template" id="media-list">
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-7">
          <el-select v-model="form.mime_type" placeholder="All media items">
            <el-option label="All media items" value=""></el-option>
            <el-option label="Images" value="images"></el-option>
            <el-option label="Audio" value="audio"></el-option>
            <el-option label="Video" value="video"></el-option>
          </el-select>
        </div>
        <div class="col-md-5">
          <el-input type="text" v-model="form.search" placeholder="Search name"></el-input>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-3" v-for="media in medias">
          <figure style="min-height: 300px">
            <img :src="media.slug" class="img-responsive" />
            @{{ media.title }}
          </figure>
        </div>
      </div>
    </div>
    <div class="col-md-4">

    </div>
  </div>
</script>
<script>
  Vue.component('media-list', {
    template: '#media-list',
    data: function () {
      return {
        form: {
          mime_type: '',
          search: ''
        },
        medias: {!! $medias ? json_encode($medias->items, 0) : '[]' !!},
        pagination: {!! $medias ? json_encode($medias->pagination) : '{}' !!}
      }
    }
  })
</script>
