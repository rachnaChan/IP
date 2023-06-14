<template>
  <div>
    <div class="mt-5 m-auto w-75">
      <h1 class=" text-info fonts text-center">Welcome to <span class="text-muted">Zmffhfltm91's</span> Store!!</h1>
    </div>


    <div class="m-auto rounded-bottom  mt-3 fonts" style="background-color: pink;width: 300px; height: 30px;">
      <h5 class="fs-5 text-center">Simple and Tasty Receipe</h5>
    </div>

    <div class="m-auto w-50 textInfo">
      <p>djdsahhdahdiusadferfqeerferrfefwefewqf
        fefwefewqfrerddudaswefqfqdwefwefewqf
        weqcehaduwh</p>
    </div>
    <div class="w-25 m-auto d-flex"> 
      <div class="w-25 ">
         <img src="../assets/Img/profile.png" alt="" class="imageProfile">
      </div>

      <!-- <div class="w-75 m-auto text-center">
        <h5 class="fonts fs-5">By Zmffhfltm91</h5>
      </div> -->
      <div class="w-50" v-for="user in users" :key="user._id">
        <h5 class="fonts">By {{ user.username }}</h5>
      </div>
        

    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import { ref } from 'vue'

const index=ref(0)
const users=ref()

fetch("http://localhost:8000/api/user/me")
.then(res=>res.json())
.then(a=>{
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

.textInfo{
  font-family: 'papyrus';
  font-size: 1.8rem;
}

.imageProfile{
  width: 3rem;
}
</style>