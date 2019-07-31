import Vue from 'vue'
import VueRouter from 'vue-router'
import AppRouter from './AppRouter'
import routes from './routes/routes'
import { store } from './store/authentication-store'

Vue.use(VueRouter)

const router = new VueRouter({
  routes: routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    console.log('route need authentication')
    if (store.getters.isAuthenticated !== false && store.getters.isAuthenticated !== 'false') {
      console.log('user is authenticated: ' + store.getters.isAuthenticated)
      next()
    } else {
      console.log('page should be redirect')
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    }
  } else {
    next()
  }
})

// eslint-disable-next-line no-unused-vars
var routeVm = new Vue({
  el: '#router-app',
  store,
  data: {
    csrf_token: '',
    last_email: ''
  },
  router,
  template: '<AppRouter v-bind:csrf_token="csrf_token" v-bind:last_email="last_email"/>',
  components: { AppRouter },
  beforeMount () {
    this.csrf_token = this.$el.attributes['data-token'].value
    this.last_email = this.$el.attributes['data-last-email'].value
    this.$store.commit('change', this.$el.attributes['data-is-authenticated'].value)
  }
})
