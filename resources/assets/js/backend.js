// window._ = require('lodash');
import 'element-ui/lib/theme-default/index.css'

import Vue from 'vue'
import ElementUi from 'element-ui'
import VueTinymce from 'vue-tinymce'
import Api from './api'

Vue.use(ElementUi)
Vue.use(VueTinymce)
Vue.prototype.$http = Api

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
