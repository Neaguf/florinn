// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import settings from "./backend/LocalSettings";
import VueResource from "vue-resource";
import locale from "element-ui/lib/locale/lang/en"
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false;

Vue.use(BootstrapVue);
Vue.use(VueResource);
Vue.use(ElementUI, { locale });

Vue.http.options.xhr = { withCredentials: true };
Vue.http.options.emulateJSON = true;
Vue.http.headers.common["Token"] = settings.get_token();

Vue.http.options.root = settings.BASE_URL;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
