<script >
import authApi from "@/method/libs/auth";
export default {
  async mounted() { },
  methods: {
    async onLogout() {
      const result = await authApi.logout();
      if (result) this.$router.push({ name: "auth/login" });
    },
  },
};
</script>

<template>
  <main>
    <div class="d-flex py-2 justify-content-between m-auto" style="background: linear-gradient(to right, aliceblue, pink);">
      <h1 class="w-75 text-center">Welcome to zmffhfltm91's Dashboard Page!!</h1>
      <button v-on:click="onLogout()" class="mx-5 btn btn-lg btn-success"> Logout </button>
    </div>
    <div class="">
      <div class="mt-3">
        <div class="w-75 m-auto d-flex justify-content-between">
          <router-link to="/dashboard/category">
            <div class="btn btn-outline-secondary text-uppercase filter-btn m-2"><h1 class="fs-4">Category</h1></div>
          </router-link>
          <router-link to="/dashboard/item">
            <div class="btn btn-outline-secondary text-uppercase filter-btn m-2"><h1 class="fs-4">Item</h1></div>
          </router-link>
          <router-link to="/dashboard/product">
            <div class="btn btn-outline-secondary text-uppercase filter-btn m-2"><h1 class="fs-4">Product</h1></div>
          </router-link>
        </div>
      </div>
      <div class="basic-4/5 p-1 w-full">
        <router-view></router-view>
      </div>
      
    </div>

  </main>
</template>

<style>
h1{
  font-family: 'Dosis';
  font-size: 14px;
  }
button{
  height: 30px;
}
</style>