<script type="text/x-template" id="menu-index">
  <div>
    <table class="table table-stripped">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Url</th>
          <th>Parent ID</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="menu in menus">
          <th>@{{ menu.id }}</th>
          <td>@{{ menu.name.en }}</td>
          <td>@{{ menu.url }}</td>
          <td>@{{ menu.parent_id }}</td>
          <td>@{{ menu.active == 1 ? 'Active' : 'Not Active'}}</td>
          <td>
            <menu-update :form="menu" :menus="menus" />
          </td>
        </tr>
      </tbody>
    </table>
    <menu-create :menus="menus" />
  </div>
</script>
<script>
  Vue.component('menu-index', {
    template: '#menu-index',
    data: function () {
      return {
        menus: {!! $menus ? json_encode($menus->items) : '{}' !!},
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
