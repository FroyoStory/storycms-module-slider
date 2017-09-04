@extends('cms::layouts.app')

@section('title') Members @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="/backend/user/groups/member/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <user-index />
</div>
@stop

@section('template')
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
            <td>@{{ user.role.name}}</td>
            <td>@{{ user.created_at }}</td>
            <td>
              <button >
                <i class="material-icons font-size-14">edit</i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </script>
@stop

@section('js')
  @parent
  <script>
    Vue.component('user-index', {
      template: '#user-index',
      data: function () {
        return {
          users: {!! $users ? $users->toJson()->data : '[]' !!}
        }
      }
    })
  </script>
@stop
