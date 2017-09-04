<script type="text/x-template" id="category-index">
  <div>
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Slug</th>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in categories">
          <td>@{{ category.name.en }}</td>
          <td>@{{ category.description }}</td>
          <td>@{{ category.slug }}</td>
          <td>
            <category-update :form="category" :categories="categories" />
          </td>
        </tr>
      </tbody>
    </table>
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
      }
    }
  })
</script>
