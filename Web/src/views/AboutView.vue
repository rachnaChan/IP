<template>
  <div>
    <div class="mt-5 m-auto w-75">
      <h1 class=" text-info fonts text-center">Welcome to <span class="text-muted">Zmffhfltm91's</span> Store!!</h1>
    </div>


    <div class="m-auto rounded-bottom  mt-3 fonts" style="background-color: pink; width: 300px; height: 30px;">
      <h5 class="fs-5 text-center mt-4">Simple and Tasty Receipe</h5>
    </div>

    <div class="mt-5 m-auto w-75 textInfo text-center">
      <p>jahsdkhwaiueuahduwaedhwuehcasbawehwewfasdafwa
        efwqeedfqefqeqfeebhcadadjahsdkhwaiueuadcadsfawa
        hduwaedhwuehcasbawehwewfddewqfqasdwefdqcdaevadd
        efwqeedfqefqeqfeebhcadadefwqeedfqefqeqfadsdewfc
        eebhcadad</p>
    </div>
    <div class="w-25 m-auto d-flex">
      <div class="w-25 ">
        <img src="../assets/Img/profile.png" alt="" class="imageProfile">
      </div>

      <div class="w-75 m-auto">
        <h1 class="fs-3 fonts text-center">By Zmffhfltm91 (Chloris)</h1>
      </div>
      <!-- <div class="w-50" v-for="user in users" :key="user._id">
        <h5 class="fonts">By {{ user.username }}</h5>
      </div> -->


    </div>

    <div class="d-flex justify-content-between m-auto " style="width: 90%;">
      <div class="w-25">

        <div class="w-75 m-auto justify-content-center my-5 c0 c1">

          <div class=" img-container">
            <img src="../assets/Img/cake02.jpg" alt="logo" class="mt-3 img-fluid store-img">

          </div>
          <div class="text-center mt-3">
            <p>cake</p>
            <p>portion: 3-4 persons</p>
          </div>

        </div>

        <div class="w-75 m-auto justify-content-center my-5 c0 c2">

          <div class="img-container">
            <img src="../assets/Img/donut02.jpeg" alt="logo" class="mt-3 img-fluid store-img">

          </div>
          <div class="text-center mt-3">
            <p>donut</p>
            <p>portion: 2 persons</p>
          </div>

        </div>

        <div class="w-75 m-auto justify-content-center my-5 c0 c3">

          <div class="img-container">
            <img src="../assets/Img/cupcake02.jpg" alt="logo" class="mt-3 img-fluid store-img">

          </div>
          <div class="text-center mt-3">
            <p>cake</p>
            <p>portion: 1 person</p>
          </div>

        </div>

      </div>

      <div class="w-75">

        <div class="my-5" style="margin-left: 40%;">
          <div class="w-75 m-auto">
            <p class="fonts text-danger" style="height: 50px;">Easy Sweets</p>
            <p class="textInfo">asdaiwjfajdcadsasd</p>
            <hr class="w-100 hr-danger" />
          </div>

          <div class="textInfo m-auto w-75">
            <p> jahsdkhwaiueuahduwaedhwuehcasbawehwewf
              efwqeedfqefqeqfeebhcadadjahsdkhwaiueuad
              hduwaedhwuehcasbawehwewfddewqfqasdwefdq
              efwqeedfqefqeqfeebhcadadefwqeedfqefqeqf
              eebhcadad</p>
          </div>
        </div>
        <div>
          <div class="w-75 m-auto my-5">
            <p class="fonts text-danger" style="height: 50px;">Affordable</p>
            <p class="textInfo">asdaiwjfajdcadsasdadd</p>
            <hr class="w-75 hr-danger" />
          </div>

          <div class="textInfo m-auto w-75">
            <p> jahsdkhwaiueuahduwaedhwuehcasbawehwewf
              efwqeedfqefqeqfeebhcadadjahsdkhwaiueuad
              hduwaedhwuehcasbawehwewfddewqfqasdwefdq
              efwqeedfqefqeqfeebhcadadefwqeedfqefqeqf
              eebhcadad</p>
          </div>
        </div>

        <div class="text-right">
          <RouterLink :to="{ name: 'menu' }">
            <p class="fs-3 text-danger text-decoration-underline"
              style="text-align:right; font-family: 'Dokdo'; margin-right: 5%;">Start Now</p>
          </RouterLink>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import { ref } from 'vue'

const index = ref(0)
const users = ref()

fetch("http://localhost:8000/api/user/me")
  .then(res => res.json())
  .then(a => {
    users.value = a
  })


</script>

<style lang="scss" scoped>
* {
  box-sizing: border-box;
}

.fonts {
  font-family: "Dokdo";
  font-size: 2.8rem;
}

.textInfo {
  font-family: 'papyrus';
  font-size: 1.5rem;
}

.imageProfile {
  width: 3rem;
}

.img-container {
  width: 90%;
  height: 150px;
  margin: auto;
  position: relative;
  overflow: hidden;
  cursor: pointer;
}

.store-img {
  transition: all 1s ease-in-out;
}

.img-container:hover .store-img {
  transform: scale(1.3);
}

.img-container:hover .store-item-icon {
  transform: translate(0, 0);
}

.c0 {
  font-family: 'Papyrus';
  width: 20%;
  height: 240px;
}

.c1 {
  background-color: #d0e2e7;

}

.c2 {
  background-color: #bdf0df;
}

.c3 {
  background-color: #fad4f2;
}

.hr-danger {
  width: 50%;
  background-image: -webkit-linear-gradient(left, rgba(244, 67, 54, .8), rgba(244, 67, 54, .6), rgba(0, 0, 0, 0));
}
</style>