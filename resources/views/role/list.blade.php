<script type="text/x-template" id="role-index">
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="role in roles">
          <td>@{{ role.name }}</td>
          <td>@{{ role.description }}</td>
          <td>
            <role-update :form="role"/>
          </td>
        </tr>
      </tbody>
    </table>
    <role-create />
  </div>
</script>
<script>
  Vue.component('role-index', {
    template: '#role-index',
    data: function () {
      return {
        roles: {!! $roles ? json_encode($roles->items) : '[]' !!}
      }
    },
    mounted: function () {
      Bus.$on('role-created', this.roleCreated)
      Bus.$on('role-updated', this.roleUpdated)
      Bus.$on('role-destroyed', this.roleDestroyed)
    },
    methods: {
      roleCreated: function (role) {
        this.roles.push(role)
      },
      roleUpdated: function (role) {
        var index = this.roles.indexOf(role)
        this.$set(this.roles, index, role)
      },
      roleDestroyed: function (role) {
        var index = this.roles.indexOf(role)
        this.roles.splice(index, 1)
      }
    }
  })
</script>
