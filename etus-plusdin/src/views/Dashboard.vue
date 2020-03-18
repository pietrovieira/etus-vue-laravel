<template>
  <section v-show="isShow" class="flex flex-col justify-between">
    <Header homeLink="/dashboard">
      <a @click="addProduct" class="mt-5 cursor-pointer mx-4 md:mt-0">
        Add Product
      </a>
    </Header>
    <div class="h-full flex flex-col items-center">
      <div class="w-full max-w-md my-6">
        <div class="flex border-b border-b-2 border-green-500 py-2">
          <input
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text"
            placeholder="Credit card name"
            aria-label="Credit card name"
            v-model="search"
            @keyup.enter="handleSearch"
          />
          <button
            @click="handleSearch"
            class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-sm border-4 text-white py-1 px-2 rounded"
            type="button"
          >
            Search
          </button>
        </div>
      </div>
      <div class="container overflow-auto mx-auto">
        <table class="w-full">
          <thead>
            <tr>
              <th class="px-4 py-2">Image</th>
              <th class="px-4 py-2">Name</th>
              <th class="px-4 py-2" style="width: 170px;">Slug</th>
              <th class="px-4 py-2" style="width: 80px;">Brand</th>
              <th class="px-4 py-2" style="width: 80px;">Category</th>
              <th class="px-4 py-2" style="width: 80px;">Limit</th>
              <th class="px-4 py-2" style="width: 80px;">Rate/Year</th>
              <th class="px-4 py-2">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="card of getCardList" :key="card.id" class="bg-gray-100">
              <td class="border px-4 py-2">
                <img class="w-full max-w-img" :src="card.imagem" alt="Sunset in the mountains">
              </td>
              <td class="border px-4 py-2">{{card.name}}</td>
              <td class="border px-4 py-2">{{card.slug}}</td>
              <td class="border px-4 py-2">{{card.brand.name}}</td>
              <td class="border px-4 py-2">{{card.category.name}}</td>
              <td class="border px-4 py-2">{{card.limit}}</td>
              <td class="border px-4 py-2">{{card.limit_tax}}</td>
              <td class="border px-4 py-2 w-50">
                <div class="flex">
                <button
                  @click="goDetail(card)"
                  class="flex-shrink-0 bg-green-500 w-1/2 hover:bg-green-700 border-green-500 hover:border-green-700 text-sm border-4 text-white py-1 px-2 rounded"
                  type="button"
                >
                  Edit
                </button>
                <button
                  @click="handleDelete(card.id)"
                  class="flex-shrink-0 ml-3 bg-red-500 w-1/2 hover:bg-red-700 border-red-500 hover:border-red-700 text-sm border-4 text-white py-1 px-2 rounded"
                  type="button"
                >
                  {{labelDeleted[card.id] === undefined ? 'Delete' : 'Loading...' }}
                </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <!--  -->
        <div class="inline-flex w-full justify-between my-8">
          <button @click="handlePrevPage" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
            Prev
          </button>
          <button @click="handleNextPage" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
            Next
          </button>
        </div>
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    Header,
    Footer
  },
  computed: {
    ...mapGetters({
      getPage: "card/getPage",
      getCardList: 'card/getList'
    })
  },
  data() {
    return {
      isShow: false,
      labelDeleted: [],
      cards: [],
      search: ''
    };
  },
  async created() {
    try
    {
      await this.cardFindAll();
      this.isShow = true;
    }catch(error){
      this.isShow = false;
      if ( error.status ){
        this.$router.replace('/');
      }
    }
  },
  methods: {
    async handleSearch(){
      await this.cardSearch(this.search);
    },
    async handlePrevPage(){
      let _page = this.getPage - 1;
      await this.cardFindAll(_page,6);
    },
    async handleNextPage(){
      let _page = this.getPage + 1;
      await this.cardFindAll(_page,6);
    },
    goDetail(detail){
      this.setCardEdit(detail);
      this.$router.push('/edit-product');
    },
    addProduct(){
      this.setCardEdit({
        name: null,
        slug: null,
        category: {
          id: null
        },
        brand: {
          id: null
        },
        limit_tax: 0,
        limit: 0,
      });
      this.$router.push('/add-product');
    },
    async handleDelete(id){
      const _confirm = confirm('Are you sure?');
      const _vm = this;
      if ( _confirm )
      {
        const _id = parseInt(id);
        _vm.labelDeleted[_id] = true;
        const res = await _vm.cardDelete(_id);
        if ( res.status === 200 ){
          _vm.labelDeleted[_id] = undefined;
          await _vm.cardFindAll();
          _vm.$noty.success(res.data.message);
        }
      }
    },
    ...mapActions({
      cardSearch: 'card/search',
      cardFindAll: 'card/findAll',
      setCardEdit: 'card/setEdit',
      cardDelete: 'card/delete'
    })
  }
};
</script>
