<script type="text/x-template" id="list-item">
  <vddl-draggable :draggable="menu" effect-allowed="move" :index="index" :wrapper="menus" :dragend="moved">
    <vddl-nodrag class="nodrag">
      <div class="row" style="margin-bottom: 10px">
        <div class="col-md-2"><vddl-handle :handle-left="20" :handle-top="20" class="handle"> <i class="material-icons font-size-14">menu</i> </vddl-handle></div>
        <div class="col-md-2">@{{ menu.name.en }}</div>
        <div class="col-md-2">@{{ menu.url }}</div>
        <div class="col-md-2">@{{ menu.active == 1 ? 'Active' : 'Not Active'}}</div>
        <div class="col-md-2"><menu-update :form="menu" :menus="menus" /></div>
      </div>
      <vddl-list :list="menu.children" :external-source="true" style="margin-left: 20px; min-height: 5px;" :dragend="moved">
        <list-item v-for="(item, childindex) in menu.children"
        :menus="menu.children"
        :menu="item"
        :index="childindex"
        :key="item.id">
        </list-item>
      </vddl-list>
    </vddl-nodrag>
  </vddl-draggable>
</script>

<script>
  Vue.component('list-item', {
    template: '#list-item',
    props: {
      menu: { type: Object, required: true },
      menus: {type: Array, required: true},
      index: {required: true}
    },
    methods: {
      moved: function (data) {
        Bus.$emit('menu-list-item-moved', {})
      }
    }
  })
</script>

<style type="text/css">
.selected{
  background: #f9f9f9;
}
.selected-item {
  line-height: 40px;
}
.vddl-dragging{
  opacity: 0.7;
}
.handle {
  cursor: move;
  display: inline;
  width: 40px;
  height: 40px;
  background-size: 20px 20px;
}

.nodrag p {
  display: inline-block;
}
.vddl-draggable {
  padding-top: 10px;
  padding-bottom: 10px;
}
.vddl-dragging-source {
  display: none;
}
.vddl-placeholder {
  width: 100%;
  min-height: 20px;
  line-height: 20px;
  border: 1px dotted #eee;
  padding: 0 15px;
  background-color: #DEEBFF;
}

</style>
