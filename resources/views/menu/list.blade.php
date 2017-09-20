<script type="text/x-template" id="menu-index">
  <div class="container">
    <div class="row" style="border-bottom: 1px solid #ddd; margin-bottom: 11px; line-height: 41px">
      <div class="col-md-2">Name</div>
      <div class="col-md-2">Url</div>
      <div class="col-md-2">Parent ID</div>
      <div class="col-md-2">Active</div>
      <div class="col-md-2">Action</div>
    </div>
      <div class="media-list" v-for="menu in menus" style="margin-bottom: 15px">
        <div class="media">
          <div class="media-left"></div>
          <div class="media-body">
            <div class="row">
              <div class="col-md-2">@{{ menu.name.en }}</div>
              <div class="col-md-2">@{{ menu.url }}</div>
              <div class="col-md-2">@{{ menu.parent_id }}</div>
              <div class="col-md-2">@{{ menu.active == 1 ? 'Active' : 'Not Active'}}</div>
              <div class="col-md-2"><menu-update :form="menu" :menus="lists" /></div>
              <list-item :menu="menu" :menus="lists" />
            </div>
          </div>
        </div>
      </div>
    <menu-create :menus="lists" />
  </div>
</script>
<script>
  Vue.component('menu-index', {
    template: '#menu-index',
    data: function () {
      return {
        menus: {!! $menus ? json_encode($menus->items) : '{}' !!},
        lists: {!! $lists ? json_encode($lists->items) : '{}' !!},
        modal: { create: false, update: false }
      }
    },
    mounted: function () {
      Bus.$on('menu-created', this.menuCreated)
      Bus.$on('menu-updated', this.menuUpdated)
      Bus.$on('menu-destroyed', this.menuDestroyed)
    },
    methods: {
      menuCreated: function (data) {
        this.menus.push(data)
      },
      menuUpdated: function (data) {
        var index = this.menus.indexOf(data)
        this.$set(this.menus, index, data)
      },
      menuDestroyed: function (data) {
        var index = this.menus.indexOf(data)
        this.menus.splice(index, 1)
      }
    }
  })
</script>
