@extends('cms::layouts.app')

@section('title') Profile @stop

@section('content')
  <div class="container-fluid">
    <profile-updated :user="user"/>
  </div>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="profile-update">
    <div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="name">User Name</label>
          </div>
          <div class="col-md-4">
            <el-input type="text" v-model="user.name" name="name"></el-input>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="email">User Email</label>
          </div>
          <div class="col-md-4">
            <el-input type="text" v-model="user.email" name="email"></el-input>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="password">New Password</label>
          </div>
          <div class="col-md-4">
            <el-input type="password" v-model="user.password" placeholder="leave empty if no change"></el-input>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="confirm_password">Confirm New Password</label>
          </div>
          <div class="col-md-4">
          <el-input type="password" v-model="user.confirm_password" placeholder="leave empty if no change"></el-input>
          </div>
        </div>
      </div>
        <el-input type="hidden" v-model="user.id" name="id"></el-input>
      <div>
        <button type="submit" class="btn btn-submit" v-on:click="update" name="button">Update Profile</button>
      </div>
    </div>
  </script>
  <script>
    Vue.component('profile-updated', {
      template: '#profile-update',
      data: function() {
        return {
          user: {!! $profile !!},
          errors: {}
        }
      },
      // props: {
      //   name: {
      //     type: String,
      //     required: true,
      //     default: 'default'
      //   }
      // },
      methods: {
        update: function() {
          var that = this
          this.$http.post('profile', this.user, function(response) {
            that.user = {name: that.user.name, email: that.user.email, password: '', confirm_password: '', id: that.user.id}
          }, function(error) {
            that.errors = error.response.data
        })
        }
      }
    })
  </script>
@stop
