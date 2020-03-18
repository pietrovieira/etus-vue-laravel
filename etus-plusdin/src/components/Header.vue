<template>
  <nav
    class="flex items-center justify-between flex-wrap  p-6 w-full z-30 shadow-lg"
  >
    <div class="flex items-center flex-shrink-0 text-green-600 mr-6">
      <router-link :to="homeLink"
        >
      <Logo />
        </router-link
      >
    </div>
    <div class="block sm:hidden">
      <button
        class="flex items-center px-3 py-2 border rounded text-silver-200 border-silver-400"
      >
        <svg
          class="fill-current h-3 w-3"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <title>Menu</title>
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
        </svg>
      </button>
    </div>
    <div
      class="flex flex-col md:justify-around md:float-right text-green-600 text-md md:flex-row"
    >
    <slot v-html="menus">
    </slot>
      <a v-if="getLogged" class="mt-5 md:mt-0 mx-4 cursor-pointer" @click="handleLogout"
        >Logout</a
      >
    </div>
  </nav>
</template>
<script>
import Logo from "@/components/Logo";
import { mapActions,mapGetters } from "vuex";
export default {
  components: {
    Logo
  },
  props: {
    homeLink: {
      type: String,
      default: '/'
    }
  },
  computed: {
    ...mapGetters({
      getLogged: "user/getLogged"
    })
  },
  methods: {
    ...mapActions({
      userLogout: "user/logout"
    }),
    async handleLogout(){
      await this.userLogout();
      this.$noty.success('You have successfully logged out',{
        timeout: 1000,
        progressBar: false,
      });
      this.$router.replace('/login');
    }
  }
};
</script>
