import Home from '../components/account/Home.vue'
import Register from '../components/account/Register.vue'
import Login from '../components/account/Login.vue'

const routes = [
  { path: '/', component: Home, meta: { requiresAuth: true } },
  { path: '/register', component: Register },
  { path: '/login', component: Login, props: true }
]

export default routes
