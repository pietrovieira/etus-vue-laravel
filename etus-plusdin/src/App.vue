<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters({
      getAccessToken: 'user/getAccessToken',
      getLogged: 'user/getLogged'
    })
  },
  async created(){
    if ( this.getAccessToken ){
      axios.defaults.headers.common = {'Authorization': `Bearer ${this.getAccessToken}`};
      this.$router.replace("/");
    }
  }
}
</script>