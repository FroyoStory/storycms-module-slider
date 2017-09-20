// window._ = require('lodash');
import 'element-ui/lib/theme-default/index.css'

import Vue from 'vue'
import ElementUi from 'element-ui'
import Api from './api'
import VueI18n from 'vue-i18n'

Vue.use(ElementUi)
Vue.use(VueI18n)
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
