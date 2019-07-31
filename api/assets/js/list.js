import Vue from 'vue'
import Booklist from './Booklist'
import { store } from './store/store'

// eslint-disable-next-line no-new
new Vue({
  el: '#book-list',
  store,
  template: '<Booklist/>',
  components: { Booklist },
  beforeMount: function () {
    console.log(process.env.API_TOKEN)
    store.commit('token', process.env.API_TOKEN)
  }
})
