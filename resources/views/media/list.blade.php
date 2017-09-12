<script type="text/x-template" id="media-list">
  <div>
    <div class="row">
      <div class="col-md-2" v-for="media in medias">
        <media-update :media="media"></media-update>
      </div>
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
