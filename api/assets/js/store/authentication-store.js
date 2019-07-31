import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    authenticated: false
  },
  mutations: {
    change (state, value) {
      state.authenticated = value
    }
  },
  getters: {
    isAuthenticated: state => {
      if (state.authenticated === 'true' || state.authenticated === true) {
        return true
      }

      return false
    }
  }
})
