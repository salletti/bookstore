import Vue from 'vue'
import Comments from './components/Comments'
import { store } from './store/store'

console.log('comments.js')

// eslint-disable-next-line no-unused-vars
var commentsVm = new Vue({
  el: '#comments',
  store,
  data: {
    bookId: ''
  },
  template: '<Comments v-bind:bookId="bookId"/>',
  components: { Comments },
  beforeMount () {
    this.bookId = this.$el.attributes['data-book-id'].value
    store.commit('token', process.env.API_TOKEN)
  }
})
