<template>
  <section class="flex flex-col h-screen w-full">
    <Header homeLink="/dashboard">
      <router-link class="mt-5 mx-4 md:mt-0" to="/dashboard">
        Dashboard
      </router-link>
    </Header>
    <div class="flex m-12 justify-center h-screen">
        <FormProduct />
    </div>
    <Footer />
  </section>
</template>

<script>
import axios from "axios";
import FormProduct from "@/components/Forms/Product";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { mapActions } from "vuex";
export default {
  async mounted(){
    await this.findAllCategories();
    await this.findAllBrands();
  },
  methods:{
    ...mapActions({
      findAllCategories: "category/findAll",
      findAllBrands: "brand/findAll"
    }),
  },
  components: {
    Header,
    Footer,
    FormProduct
  }
};
</script>
