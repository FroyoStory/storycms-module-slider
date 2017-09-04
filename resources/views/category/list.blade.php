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
