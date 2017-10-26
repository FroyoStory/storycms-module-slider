<script type="text/x-template" id="category-index">
  <div>
    <vddl-list :list="categories" effect-allowed="move" :external-source="true" style="padding: 10px; border: 1px solid #DEDEDE">
      <category-item v-for="(category, index) in categories" :key="category.id" :categories="categories" :category="category" :index="index"></category-item>
    </vddl-list>
    <br />
    <category-create :categories="categories" />
  </div>
</script>
<script>
  Vue.component('category-index', {
    template: '#category-index',
    data: function () {
      return {
        categories: {!! $categories ? : '[]' !!},
        modal: { create: false, update: false }
      }
    },
    mounted: function () {
      Bus.$on('category-created', this.categoryCreated)
      Bus.$on('category-updated', this.categoryUpdated)
      Bus.$on('category-destroyed', this.categoryDestroyed)
      Bus.$on('category-item-moved', this.categoryTreeMoved)
    },
    methods: {
      categoryCreated: function (data) {
        this.categories.push(data)
      },
      categoryUpdated: function (data) {
        var index = this.categories.indexOf(data)
        this.$set(this.categories, index, data)
      },
      categoryDestroyed: function (data) {
        var index = this.categories.indexOf(data)
        this.categories.splice(index, 1)
      },
      categoryTreeMoved: function () {
        var self = this
        self.$http.post('category/rebuild', { categories: this.categories }, function(response) {

        }, function(error) {

        })
      }
    }
  })
</script>
