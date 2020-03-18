<template>
  <div class="w-full max-w-lg">
    <div class="flex flex-wrap">
      <div class="w-full px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="name"
        >
          Name
        </label>
        <input
          class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="name"
          type="text"
          v-model="form.name"
          placeholder="Name"
        />
        <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
      </div>
    </div>
    <div class="flex flex-wrap mt-6">
      <div class="w-full md:w-1/2 px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="slug"
        >
          Slug
        </label>
        <input
          class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="slug"
          type="text"
          v-model="form.slug"
          placeholder="Slug"
        />
        <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="image"
        >
          Image
        </label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="image"
          @change="changeFile"
          type="file"
        />
      </div>
    </div>
    <div class="flex flex-wrap mt-6">
      <div class="w-full md:w-1/2 px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="brand"
        >
          Brand
        </label>
        <div class="relative">
          <select
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="brand"
            v-model="form.brand_id"
          >
            <option v-for="brand of getBrands" :value="brand.id" :key="brand.id">{{brand.name}}</option>
          </select>
          <div
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
          >
            <svg
              class="fill-current h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
              />
            </svg>
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="category"
        >
          Category
        </label>
        <div class="relative">
          <select
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="category"
            v-model="form.category_id"
          >
            <option v-for="category of getCategories" :value="category.id" :key="category.id">{{category.name}}</option>
          </select>
          <div
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
          >
            <svg
              class="fill-current h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
              />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap mt-6">
      <div class="w-full md:w-1/2 px-3 mb-6">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="cc-limit"
        >
          Limit
        </label>
        <money
          class="appearance-none data-js-input block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          v-model="form.limit"
        ></money>
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="limit-tax"
        >
          limit rate per year
        </label>
        <money
          class="appearance-none data-js-input block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          v-model="form.limit_tax"
        ></money>
      </div>
    </div>
    <div class="flex mb-2 w-full max-w-ws justify-center">
      <button
        v-if="!edit"
        @click="handleCreate"
        class="bg-green-500 hover:bg-green-700 w-full mt-6 text-white font-bold py-2 px-4 rounded"
      >
        {{label}}
      </button>
      <button
        v-if="edit"
        @click="handleUpdate"
        class="bg-green-500 hover:bg-green-700 w-full mt-6 text-white font-bold py-2 px-4 rounded"
      >
        {{label}}
      </button>
    </div>
  </div>
</template>
<script>
import { Money } from "v-money";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "FormProduct",
  computed: {
    ...mapGetters({
      getLoaded: 'card/getLoaded',
      getCardEdit: 'card/getEdit',
      getCategories: 'category/getList',
      getBrands: 'brand/getList',
    })
  },
  methods: {
    ...mapActions({
      cardCreate: 'card/create',
      cardUpdate: 'card/update',
    }),
    changeFile(event){
      this.form.imagem = event.target.files[0];
      // console.log("changeFile", event.target.files)
    },
    async handleCreate() {
      try{
        this.label = 'Loading...';
        const res = await this.cardCreate(this.form);
        this.$noty.success(res.data.message,{
          timeout: 2000,
          progressBar: false,
        });
        this.label = 'Create';
        this.$router.replace("/dashboard");
      }catch(error){
        this.label = 'Create';
        const {
          status,
          data : dataError
        } = error;
        switch(status)
        {
          case 422:
            this.$noty.warning('Name, Slug, Image, Brand, Category is required.',{
              timeout: 2000,
              progressBar: false,
            });
          break;
          default:
            this.$noty.error(dataError.message,{
              timeout: 2000,
              progressBar: false,
            });
        }
      }
    },
    async handleUpdate() {
      try{
        this.label = 'Loading...';
        const res = await this.cardUpdate(this.form);
        this.$noty.success(res.data.message,{
          timeout: 2000,
          progressBar: false,
        });
        this.label = 'Update';
        this.$router.replace("/dashboard");
      }catch(error){
        this.label = 'Update';
        const {
          status,
          data : dataError
        } = error;
        switch(status)
        {
          case 422:
            this.$noty.warning('Name, Slug, Image, Brand, Category is required.',{
              timeout: 2000,
              progressBar: false,
            });
          break;
          default:
            this.$noty.error(dataError.message,{
              timeout: 2000,
              progressBar: false,
            });
        }
      }
    }
  },
  created(){
    this.edit = false;
    this.form = this.getCardEdit;
    this.form.category_id = this.getCategories[0].id;
    this.form.brand_id = this.getBrands[0].id;
    if ( this.getCardEdit.name !== null){
      this.edit = true;
      this.form.category_id = this.getCardEdit.category.id;
      this.form.brand_id = this.getCardEdit.brand.id;
    }
  },
  data(){
    return {
      label: 'Create',
      edit: false,
      form: {
        id: 0,
        name: null,
        slug: null,
        category_id: 0,
        brand_id: 0,
        limit_tax: 0,
        limit: 0,
      }
    }
  }
};
</script>
