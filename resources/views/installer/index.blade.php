@extends('cms::layouts.blank')

@section('title', 'Control Panel Install')

@section('content')
  <div class="container">
    <div class="col-md-8 col-md-offset-2">
      <database></database>
    </div>
  </div>
@stop

@section('css')
<style>
  body {
    background-color: #EFEFEF;
  }
  .app-installer {
    background-color: #FFF;
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 40px;
  }
</style>
@stop

@section('js')
  @parent
  <script type="text/x-template" id="installer-database">
    <div>
      <div class="app-installer">
        <h2>Database Information</h2>
        <p>Below you should enter your database connection details. If you’re not sure about these, contact your host.</p>
        <div class="form-group">
          <el-input type="text" v-model="form.database.name" placeholder="Database name"></el-input>
          <span class="help-block">The name of the database you want to use.</span>
        </div>
        <div class="form-group">
          <el-input type="text" v-model="form.database.username" placeholder="Database username"></el-input>
          <span class="help-block">Your database username.</span>
        </div>
        <div class="form-group">
          <el-input type="password" v-model="form.database.password" placeholder="Database password"></el-input>
          <span class="help-block">Your database password.</span>
        </div>
        <div class="form-group">
          <el-input type="type" v-model="form.database.host" placeholder="Database host"></el-input>
          <span class="help-block"> You should be able to get this info from your web host, if localhost doesn’t work.</span>
        </div>
        <div class="form-group">
          <el-input type="type" v-model="form.database.port" placeholder="Database port"></el-input>
          <span class="help-block"> Your host database port connection.</span>
        </div>
        <div class="form-group">
          <el-input type="type" v-model="form.database.charset" placeholder="Database charset"></el-input>
          <span class="help-block">Your database charset.</span>
        </div>
        <div class="form-group">
          <el-input type="type" v-model="form.database.collation" placeholder="Database collation"></el-input>
          <span class="help-block">Your database collation.</span>
        </div>
      </div>
      <div class="app-installer">
        <h2>Website information.</h2>
        <p>Please provide the following information. Don’t worry, you can always change these settings later.</p>
        <div class="form-group">
          <el-input type="type" v-model="form.site.title" placeholder="Website title"></el-input>
          <span class="help-block">Your website title.</span>
        </div>
        <div class="form-group">
          <el-input type="type" v-model="form.site.name" placeholder="Administrator name"></el-input>
          <span class="help-block">Your name information.</span>
        </div>
        <div class="form-group">
          <el-input type="type" v-model="form.site.email" placeholder="Administrator email"></el-input>
          <span class="help-block">Your login information.</span>
        </div>
        <div class="form-group">
          <el-input type="password" v-model="form.site.password" placeholder="Administrator password"></el-input>
          <span class="help-block">Your admin password.</span>
        </div>
      </div>

      <div class="form-group">
        <el-button type="primary" @click="install">Run install</el-button>
      </div>
    </div>
  </script>

  <script type="text/javascript">
    Vue.component('database', {
      template: '#installer-database',
      data: function () {
        return {
          form: {
            database: {
              name: '',
              host: 'localhost',
              driver: 'mysql',
              port: '3306',
              username: '',
              password: '',
              charset: 'utf8',
              collation: 'utf8_general_ci'
            },
            site: {
              title: '',
              name: '',
              email: '',
              password: ''
            }
          }
        }
      },
      methods: {
        install: function () {
          var self = this
          self.$http.post('installer', self.form, function(response) {

          })
        }
      }
    })
  </script>
@stop
