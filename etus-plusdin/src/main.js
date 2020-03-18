import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import "./assets/css/tailwind.css";

import VueNoty from "vuejs-noty";
Vue.use(VueNoty);

import "vuejs-noty/dist/vuejs-noty.css";

import money from 'v-money'
Vue.use(money, {precision: 2})

Vue.config.productionTip = false;


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
