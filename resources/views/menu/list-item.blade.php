<script type="text/x-template" id="list-item">
  <div class="media">
    <div class="media-left"></div>
    <div class="media-body">
      <div class="col-md-2">@{{ menu.name.en }}</div>
      <div class="col-md-2">@{{ menu.url }}</div>
      <div class="col-md-2">@{{ menu.parent_id }}</div>
      <div class="col-md-2">@{{ menu.active == 1 ? 'Active' : 'Not Active'}}</div>
      <div class="col-md-2"><menu-update :form="menu" :menus="lists" /></div>
    </div>
  </div>
</script>

<script>
  Vue.component('list-item', {
    template: '#list-item',
    props: {
      menu: { type: Array, required: true },
      menus: {type: Array, required: true}
    }
  })
</script>
