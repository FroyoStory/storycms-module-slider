<script type="text/x-template" id="list-item">
  <div class="media">
    <div class="media-left" style="width: 20px"></div>
    <div class="media-body">
      <div class="row">
        <div class="col-md-2">@{{ menu.name.en }}</div>
        <div class="col-md-2">@{{ menu.url }}</div>
        <div class="col-md-2">@{{ menu.parent_id }}</div>
        <div class="col-md-2">@{{ menu.active == 1 ? 'Active' : 'Not Active'}}</div>
        <div class="col-md-2"><menu-update :form="menu" :menus="menus" /></div>
      </div>
      <div v-if="menu.children.length > 0">
        <list-item v-for="(item, index) in menu.children" :key="index" :menu="item" :menus="menus" v-if="menu.children.length > 0">
      </div>
    </div>
  </div>
</script>

<script>
  Vue.component('list-item', {
    template: '#list-item',
    props: {
      menu: { type: Object, required: true },
      menus: {type: Array, required: true}
    }
  })
</script>
