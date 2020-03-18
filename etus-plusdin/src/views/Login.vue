<template>
  <div class="flex w-screen justify-center items-center h-screen">
    <div class="w-full max-w-xs">
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4 w-full text-center">
          <Logo />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            E-mail
          </label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            v-model="email"
            id="email"
            type="email"
            placeholder="email"
          />
        </div>
        <div class="mb-6">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="password"
          >
            Password
          </label>
          <input
            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="password"
            type="password"
            v-model="password"
            placeholder="******************"
          />
        </div>
        <div class="flex items-center justify-between">
          <button
            @click="handleLogin"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button"
          >
            Sign In
          </button>
          <a
            class="inline-block align-baseline font-bold text-sm text-green-500 hover:text-green-800"
            href="#"
          >
            Forgot Password?
          </a>
        </div>
      </div>
      <p class="text-center text-gray-500 text-xs">
        &copy;2020 Plusdin. All rights reserved.
      </p>
    </div>
  </div>
</template>

<script>
import Logo from "@/components/Logo";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    Logo
  },
  data(){
    return {
      email: 'email@email.com',
      password: '123456'
    }
  },
  methods: {
    ...mapActions({
      userAuth: "user/auth"
    }),
    async handleLogin() {
      try {
        await this.userAuth({
          email: this.email,
          password: this.password
        });
        this.$router.replace("/dashboard");
      } catch (error) {
        this.$noty.error(error.data.error,{
          timeout: 2000
        });
      }
    }
  }
};
</script>
