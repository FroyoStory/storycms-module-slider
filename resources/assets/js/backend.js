// window._ = require('lodash');
import Vue from 'vue'
import Axios from 'axios'
import ElementUi from 'element-ui'
import 'element-ui/lib/theme-default/index.css'

Axios.defaults.baseURL = '/backend/'
Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.use(ElementUi)
Vue.prototype.$http = Axios.create()

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.Vue = Vue
window.$ = window.jQuery = require('jquery')
window.Bus = new Vue({name: 'Bus'})

require('bootstrap-sass')

// require vendor plugins
require('./vendors/aim.js')
require('./components/backend-sidebar')
