import Vue from 'vue'
import Comments from './components/Comments'

console.log('comments.js')

var commentsVm = new Vue({
  el: '#comments',
  data: {
    bookId: ''
  },
  template: '<Comments v-bind:bookId="bookId"/>',
  components: { Comments },
  beforeMount () {
    this.bookId = this.$el.attributes['data-book-id'].value
  }
})
