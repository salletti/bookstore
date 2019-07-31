import Vue from 'vue'
import Stock from './components/Stock'

console.log('stock.js')

var stockVm = new Vue({
  el: '#stock',
  data: {
    book: {
      stock: 0,
      id: 0
    }
  },
  template: '<Stock v-bind:book="book"/>',
  components: { Stock },
  beforeMount: function () {
    this.book.stock = this.$el.attributes['data-book-stock'].value
    this.book.id = this.$el.attributes['data-book-id'].value
  }
})
