import Vue from 'vue'
import Hello from './components/Hello'

require('../css/app.scss')

// eslint-disable-next-line no-new
new Vue({
  el: '#welcome',
  template: '<Hello/>',
  components: { Hello }
})
