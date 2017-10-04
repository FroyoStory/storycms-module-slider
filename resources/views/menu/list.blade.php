<script type="text/x-template" id="menu-index">
  <div>
    <vddl-list :list="menus" effect-allowed="move" :external-source="true" style="padding: 10px; border: 1px solid #DEDEDE">
      <list-item v-for="(menu, menuIndex) in menus" :key="menu.id" :menus="menus" :menu="menu" :index="menuIndex"/>
    </vddl-list>
    <br />
    <menu-create :menus="lists" />
  </div>
</script>
<script>
  Vue.component('menu-index', {
    template: '#menu-index',
    data: function () {
      return {
        menus: {!! $menus ? : '[]' !!},
        lists: {!! $lists ? json_encode($lists->items) : '{}' !!},
        modal: { create: false, update: false }
      }
    },
    mounted: function () {
      Bus.$on('menu-created', this.menuCreated)
      Bus.$on('menu-updated', this.menuUpdated)
      Bus.$on('menu-destroyed', this.menuDestroyed)
      Bus.$on('menu-list-item-moved', this.menuTreeMoved)
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
      },
      menuTreeMoved: function () {
        var self = this
        self.$http.post('menu/arrange', { menus: this.menus }, function(response) {

        }, function(error) {

        })
      }
    }
  })
</script>
