<template>
  <section class="flex flex-col h-screen w-full justify-between">
    <Header>
      <router-link v-if="getLogged" class="mt-5 mx-4 md:mt-0" to="/dashboard">
        Dashboard
      </router-link>
      <router-link v-if="!getLogged" class="mt-5 mx-4 md:mt-0" to="/login">
        Login
      </router-link>
    </Header>
    <div class="flex flex-wrap my-2 mx-5">
      <div
        v-for="card of getProductList"
        :key="card.id"
        class="w-full my-4 py-2 md:w-1/2 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4"
      >
        <div @click="goDetail(card)" class="mx-4 cursor-pointer block rounded overflow-hidden shadow-lg h-full">
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
              >{{ card.category.name }}</span
            >
            <span
              class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
              >{{ card.brand.name }}</span
            >
          </div>
        </div>
      </div>
    </div>
    <div v-if="!loaded" class="text-center py-4 lg:px-4">
      <div
        class="p-2 bg-green-600 items-center px-6 text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
        role="alert"
      >
        <span class="font-semibold mr-2 text-left flex-auto"
          >Loading...</span
        >
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
import Footer from "@/components/Footer";
import Header from "@/components/Header";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    Header,
    Footer
  },
  data() {
    return {
      cards: [],
      bottom: false,
      loaded: true,
      finished: false,
    };
  },
  computed: {
    ...mapGetters({
      getLogged: "user/getLogged",
      getProductList: "product/getList",
      getPage: "product/getPage"
    })
  },
  async created() {
    this.productSetList([]);
    await this.productFindAll();
    window.onscroll = async () => {
      var scrollHeight, totalHeight;
      scrollHeight = document.body.scrollHeight;
      totalHeight = window.scrollY + window.innerHeight;

      if (totalHeight >= scrollHeight && this.bottom === false) {
        this.bottom = true;
        if ( !this.finished )
        {
          this.loaded = false;
          const res = await this.productFindAll(this.getPage);
          if ( res.status === 200){
            this.loaded = true;
            if ( res.data.data.length === 0){
              this.finished = true;
              this.loaded = true;
            }
          }
        }else{
          this.finished = true;
          this.loaded = true;
        }
      }
      if (totalHeight >= scrollHeight - 300) {
        this.bottom = false;
      }
    };
  },
  methods: {
    ...mapActions({
      productSetList: "product/setList",
      productFindAll: "product/findAll"
    }),
    goDetail(card){
      this.$router.replace({ name : 'detail', params: { id: card.id } });
    }
  }
};
</script>
