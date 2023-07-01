<template>
    <main>
      <router-link to="/dashboard" class=" text-decoration-none text-muted text-center fw-bold"><div><p>Dashboard</p></div></router-link>
  
      <div class="d-flex position-relative justify-content-between m-auto ">
        <div class="position-ablsolute border-1" >
          <ul>
            <li v-for="category in categories" :key="category._id">
              <h4 class="pointer" v-on:click="showItem(category._id)">
                {{ category.name }}
              </h4>
              <ul>
                <li v-for="p in category.items" :key="p._id">
                  <span class="item">-{{ p.name }}</span>
                </li>
              </ul>
            </li>
          </ul>
        </div>
  
        <div class="products border-1 d-flex w-100 mx-3 justify-content-center" style="overflow-y: scroll;">
          <ProductCard class="mx-3"
            v-for="p in products"
            :key="p._id"
            :products="p"
          ></ProductCard>
        </div>
      </div>
    </main>
  </template>
  
  <script >
  import category from "../method/libs/category.js";
  import ProductCard from "./dashboard/card.vue";
  export default {
    components: { ProductCard },
    data() {
      return {
        products: [],
        products1: [],
        categories: [],
      };
    },
    async mounted() {
      const requestOptions = {
        method: "GET",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Access-Control-Allow-Credentials": true,
        },
        body: JSON.stringify(),
      };
  
      const response_item = await fetch(
        "http://localhost:3001/item/all",
        requestOptions
      );
  
      const data_items = await response_item.json();
  
      console.log("data_items: ", data_items);
      this.products1 = data_items;
  
      //post data to api
      const response = await fetch(
        "http://localhost:3001/category/categories-items",
        requestOptions
      );
  
      const data_all = await response.json();
      this.categories = data_all;
      console.log("categorized-items: ", data_all);
  
      const response_product_item = await fetch(
        "http://localhost:3001/product/all",
        requestOptions
      );
      const data_response_product_item = await response_product_item.json();
      console.log("data1: ", data_response_product_item);
      this.products = data_response_product_item;
      // console.log("data1: ", data_response_product_item.);
    },
    methods: {
      categoryClicked: function (idCategory) {
        products = category.getCategory(idCategory);
        // console.log("products123: ", products)
      },
    },
  };
  </script>
  
  
  
  <style scoped>
@import "@/assets/dist/css/bootstrap.min.css";

  .pointer {
    cursor: pointer;
  }
  .item {
    padding: 10px;
  }
  
  @media (min-width: 768px) {
    .products {
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 20px;
    }
  }
  </style>