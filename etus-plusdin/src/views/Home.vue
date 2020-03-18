<template>
  <section class="flex flex-col h-screen w-full justify-between">
    <Header>
      <router-link class="mt-5 mx-4 md:mt-0" to="/login"
        >
        Login
        </router-link
      >
    </Header>
    <div class="flex flex-wrap my-2 mx-5 justify-between ">
      <div
        v-for="card of getProductList"
        :key="card"
        class="w-full my-4 py-2 md:w-1/2 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4"
      >
        <div class="mx-4 block rounded overflow-hidden shadow-lg">
          <img
            class="w-full"
            :src="card.imagem"
            alt="Sunset in the mountains"
          />
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ card.name }}</div>
            <p class="text-gray-700 text-base">
              {{ card.slug }}
            </p>
          </div>
          <div class="px-6 py-4">
            <span
              class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
              >{{card.category.name}}</span
            >
            <span
              class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
              >{{card.brand.name}}</span
            >
          </div>
        </div>
      </div>
    </div>
    <footer class="text-center py-4 text-white bg-green-600 text-xs w-full">
      &copy;2020 Plusdin. All rights reserved.
    </footer>
  </section>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    Header
  },
  data(){
    return{
      cards: [],
      bottom: false,
    }
  },
  computed: {
    ...mapGetters({
      getProductList: 'product/getList',
      getPage: 'product/getPage'
    })
  },
  async created(){
    this.productSetList([]);
    await this.productFindAll();
    window.onscroll = async () => {
        var scrollHeight, totalHeight;
        scrollHeight = document.body.scrollHeight;
        totalHeight = window.scrollY + window.innerHeight;

        if(totalHeight >= scrollHeight && this.bottom === false)
        {
          this.bottom = true;
          await this.productFindAll(this.getPage);
        }
        if( totalHeight >= (scrollHeight-300))
        {
          this.bottom = false;
        }
    }
  },
  methods: {
    ...mapActions({
      productSetList: 'product/setList',
      productFindAll: 'product/findAll'
    }),
  }
};
</script>
