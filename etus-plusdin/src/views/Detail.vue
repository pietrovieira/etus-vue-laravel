<template>
  <section class="flex flex-col h-screen w-full justify-between">
    <Header>
      <router-link class="mt-5 mx-4 md:mt-0" to="/login">
        Login
      </router-link>
    </Header>
    <div class="flex m-12 justify-center h-screen">
      <div>
        <div
          class="mx-4 cursor-pointer block rounded overflow-hidden shadow-lg"
        >
          <div class="max-w-md" style="margin: 0 auto">
            <img class="w-full" :src="card.imagem" :alt="card.name" />
          </div>
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
          <div class="px-6 py-4">
            <span
            v-if="card.limit"
              class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
              >Limit: R$ {{ card.limit }}</span
            >
            <span
            v-if="card.limit_tax"
              class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
              >Limit Tax Per Year: R$ {{ card.limit_tax }}</span
            >
          </div>
        </div>
        <div class="flex justify-end mr-4">
          <button
            @click="goBack"
            class="bg-green-500 hover:bg-green-700 mt-6 text-white font-bold py-2 px-4 rounded"
          >
            Back
          </button>
        </div>
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { mapGetters } from "vuex";
export default {
  components: {
    Header,
    Footer
  },
  computed: {
    ...mapGetters({
      getProductList: "product/getList"
    })
  },
  data() {
    return {
      card: null
    };
  },
  methods: {
    goBack() {
      this.$router.replace("/");
    }
  },
  created() {
    try {
      if (this.$route.params.id) {
        const _card = this.getProductList.filter(
          e => e.id === this.$route.params.id
        )[0];
        if (_card) {
          this.card = _card;
        } else {
          this.$router.replace("/");
        }
      } else {
        this.$router.replace("/");
      }
    } catch (error) {
      this.$router.replace("/");
    }
  }
};
</script>
