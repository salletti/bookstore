import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    bookList: [],
    api_x_token: ''
  },
  mutations: {
    change (state, bookList) {
      state.bookList = bookList
    },
    token (state, token) {
      state.token = token
    }
  },
  getters: {
    getBookList: state => {
      return state.bookList
    },
    countBooks: state => {
      return state.bookList.length
    },
    getToken: state => {
      return 'API-X-TOKEN ' + state.token
    }
  }
})
