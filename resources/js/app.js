import Vue from 'vue'
//import vuetify from 'vuetify'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import Alpine from 'alpinejs'

//import App from './App.vue'

// eslint-disable-next-line no-undef
//window.Vue = require('vue').default

// eslint-disable-next-line no-undef
require('./bootstrap')
// eslint-disable-next-line no-undef
require('./components')

// mixin for use laravel dynamic routing
Vue.mixin({
  methods: {
    route: window.route,
  },
})

//Vue.use(vuetify)
Vue.use(Buefy)


/*new Vue({
  render: h => h(App),
}).$mount('#app')*/

new Vue({
  el: '#app',
  // eslint-disable-next-line no-undef
  //vuetify: new vuetify(),
  data: {},
})

// eslint-disable-next-line no-undef
Vue.prototype.$axios = require('axios')

// eslint-disable-next-line no-undef
//require('./components')

window.Alpine = Alpine

Alpine.start()
