import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import settings from "./backend/LocalSettings";
import VueResource from "vue-resource";
import locale from "element-ui/lib/locale/lang/en";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import BootstrapVue from "bootstrap-vue";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

Vue.config.productionTip = false;

Vue.use(BootstrapVue);
Vue.use(VueResource);
Vue.use(ElementUI, { locale });

Vue.http.options.xhr = { withCredentials: true };
Vue.http.options.emulateJSON = true;
Vue.http.headers.common["Token"] = settings.get_token();

Vue.http.options.root = settings.BASE_URL;

Vue.filter("momentformat", function (value) {
  return value;
});

Vue.prototype.$has_right = function (rightKey) {
  var ret = false;
  var drepturiDecoded = settings.get_drepturi();
  var numarUnic = (drepturiDecoded.length - 1) * (458 + 73 - 23);
  var caractereUnice = "nimic" + numarUnic;
  var verificareCrc = crypto
    .createHash("md5")
    .update(Buffer.from(caractereUnice))
    .digest("hex");
  if (drepturiDecoded.indexOf(verificareCrc) !== -1) {
    var indexDrept = drepturiDecoded.indexOf(rightKey);
    if (indexDrept !== -1) ret = true;
  }
  return ret;
};

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
