@extends('cms::layouts.app')

@section('title') Category @stop

@section('content')
<div class="container-fluid">
  <category-index />
</div>
@stop

@section('template')
  @include('cms::category.create')
  @include('cms::category.update')
  @include('cms::category.list')
@stop

@section('js')
  @parent
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
    Vue.component('category-create', {
      template: '#category-create',
      data: function () {
        return {
          locale: 'en',
          form: { name: {}, parent_id: null, description: {}, slug: ''},
          errors: {},
          modal: false,
          loading: false
        }
      },
      props: {
        categories: { type: Array, required: true}
      },
      methods: {
        create: function () {
          var that = this
          this.loading = true
          this.$http.post('category', this.form)
            .then(function(response) {
              Bus.$emit('category-created', response.data.data)
              that.loading = false
              that.modal = false
              that.form = { name: {}, parent_id: null, description: {}, slug: ''}
            })
            .catch(function(error) {
              that.loading = false
              that.errors = error.response.data
            })
        }
      }
    })

    Vue.component('category-update', {
      template: '#category-update',
      data: function () {
        return {
          locale: 'en',
          modal: false,
          loading: false,
          errors: {}
        }
      },
      props: {
        categories: { type: Array, required: true },
        form: { type: Object, required: true }
      },
      ready: function () {

      },
      methods: {
        update () {
          var that = this
          this.loading = true
          this.$http.put('category/' + this.form.id, this.form)
            .then(function(response) {
              Bus.$emit('category-updated', response.data.data)
              that.loading = false
              that.modal = false
            })
            .catch(function(error) {
              that.errors = error.response.data
              that.loading = false
            })
        },
        destroy () {
          var that = this
          this.$http.delete('category/' + this.form.id)
            .then(function(response) {
              Bus.$emit('category-destroyed', that.form)
              that.loading = false
              that.modal = false
            })
            .catch(function(error) {
              that.errors = error.response.data
              that.loading = false
            })
        }
      }
    })
  </script>
@stop

