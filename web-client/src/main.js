import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios';
import VueAxios from 'vue-axios';
import Toasted from 'vue-toasted'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import Pager from '@/components/Pager'
import Multiselect from 'vue-multiselect'

Vue.config.productionTip = true

var ax = axios.create({
  //baseURL: 'https://fb.bitsweaver.net/ghhospitals/public',
  // baseURL: 'http://192.168.100.64:8000'
  baseURL: 'http://localhost:8000/api/v1',
  headers: {'Access-Control-Allow-Origin': '*'}
});

// before a request is made start the nprogress
// ax.interceptors.request.use(config => {
//   NProgress.start()
//   return config
// },  (error) => {
//   NProgress.done();
//   return Promise.reject(error)
// });

// before a response is returned stop nprogress
ax.interceptors.response.use(null,req => {
  //NProgress.done()
  if (req.response.status == 401) {
    localStorage.clear();
    router.push('/login');
  }
  return req
});


Vue.use(VueAxios, ax);
Vue.use(Toasted);
Vue.use(require('vue-moment').default)
Vue.component('pager', Pager)
Vue.use(VueLodash, {name: 'custom', lodash: lodash}),
Vue.component('multiselect', Multiselect)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
