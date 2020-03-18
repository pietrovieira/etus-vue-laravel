import Vue from 'vue';
import Vuex from 'vuex';

import card from './modules/card';
import category from './modules/category';
import brand from './modules/brand';
import user from './modules/user';
import product from './modules/product';

import VuexPersistence from 'vuex-persist';

Vue.use(Vuex)

const vuexLocal = new VuexPersistence({
  storage: localStorage,
  key: '@plusdin',
})

export default new Vuex.Store({
  modules: {
    user,
    card,
    brand,
    category,
    product
  },
  plugins: [vuexLocal.plugin]
})