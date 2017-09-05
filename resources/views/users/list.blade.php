<script type="text/x-template" id="user-index">
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created at</th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users">
          <td>@{{ user.name }}</td>
          <td>@{{ user.email }}</td>
          <td></td>
          <td>@{{ user.created_at }}</td>
          <td>
            <user-update :form="user"/>
          </td>
        </tr>
      </tbody>
    </table>
    <user-create />
  </div>
</script>
<script>
  Vue.component('user-index', {
    template: '#user-index',
    data: function () {
      return {
        users: {!! $users ? json_encode($users->items) : '[]' !!},
        pagination: {!! $users ? json_encode($users->pagination) : '{}' !!}
      }
    },
    mounted: function () {
      Bus.$on('user-created', this.userCreated)
      Bus.$on('user-updated', this.userUpdated)
      Bus.$on('user-destroyed', this.userDestroyed)
    },
    methods: {
      userCreated: function (user) {
        this.users.push(user)
      },
      userUpdated: function (user) {
        var index = this.users.indexOf(user)
        this.$set(this.users, index, user)
      },
      userDestroyed: function (user) {
        var index = this.users.indexOf(user)
        this.users.splice(index, 1)
      },

      next: function () {

      },
      prev: function () {

      }
    }
  })
</script>
