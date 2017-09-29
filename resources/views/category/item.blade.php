<script type="text/x-template" id="category-item">
  <vddl-draggable :draggable="category" effect-allowed="move" :index="index" :wrapper="categories" :dragend="moved">
    <vddl-nodrag class="nodrag">
      <div class="row">
        <div class="col-md-4">
          <vddl-handle :handle-left="20" :handle-top="20" class="handle"> <i class="material-icons font-size-14">menu</i> </vddl-handle>
          <span><?php echo '{{ category.name.'.App::getLocale().' }}';?></span>
        </div>
        <div class="col-md-3 ">/@{{category.slug }}</div>
        <div class="col-md-1 col-md-offset-2">
          <category-update :form="category"></category-update>
        </div>
      </div>
      <vddl-list :list="category.children" :external-source="true" style="margin-left: 20px; min-height: 5px;" :dragend="moved">
        <category-item v-for="(children, Cindex) in category.children"
          :categories="category.children"
          :category="children"
          :index="Cindex"
          :key="children.id">
        </category-item>
      </vddl-list>
    </vddl-nodrag>
  </vddl-draggable>
</script>

<script type="text/javascript">
  Vue.component('category-item', {
    template: '#category-item',
    props: {
      categories: { type: Array, required: true },
      category: { type: Object, required: true },
      index: { required: true }
    },
    methods: {
      moved: function (data) {
        Bus.$emit('category-item-moved', {})
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
