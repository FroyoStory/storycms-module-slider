// window._ = require('lodash');
import 'element-ui/lib/theme-default/index.css'

import Vue from 'vue'
import ElementUi from 'element-ui'
import Vddl from 'vddl'
import Api from './api'
import locale from 'element-ui/lib/locale/lang/en'

Vue.use(ElementUi)
Vue.use(Vddl)
Vue.prototype.$http = Api


window.Vue = Vue
window.Bus = new Vue({ name: 'Bus' })
