import Vue from 'vue'
import App from './App.vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'

Vue.use(ElementUI)
Vue.component('ImagesTab', require('./components/ImagesTab.vue'))
Vue.component('SettingTab', require('./components/SettingTab.vue'))
Vue.component('ImgList', require('./components/ImgList.vue'))
Vue.component('AddNew', require('./components/AddNew.vue'))

new Vue({
  el: '#app',
  render: h => h(App)
})