<script type="text/x-template" id="menu-index">
  <div>
    <draggable :list="menus">
      <transition-group>
        <list-item v-for="(menu, menuIndex) in menus" :key="menuIndex" :menu="menu" :menus="lists" />
      </transition-group>
    </draggable>
    <menu-create :menus="lists" />
  </div>
</script>
<script>
  Vue.component('menu-index', {
    template: '#menu-index',
    data: function () {
      return {
        menus: {!! $menus ? json_encode($menus) : '[]' !!},
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
