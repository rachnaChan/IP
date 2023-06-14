
<template>
  <div class="aa">
    <section class="about py-5">
      <div class="container">

        <div class="row justify-content-between">

          <div class="col-10 col-md-6 align-self-center my-5">
            <div>
              <div>
                <img src="../assets/Img/cake04.jpg" class="img-fluid" alt="">
              </div>

            </div>
          </div>

          <div class="aboutUs col-10 mx-auto col-md-6 my-5">
            <div>About <span>Us</span> </div>
            <p>djdsahhdahdiusadferfqeerferr
              fefwefewqfrerddudaswefqfqdwed
              weqcehaduw eqyqwywqydhuwqeudh
              wewfcsadcfewqewdedsfafe</p>
            <div class="text-right">
              <RouterLink :to="{ name: 'about' }">
                <p class="text-danger text-decoration-underline" style="text-align:right">see more</p>
              </RouterLink>
            </div>
          </div>

        </div>

      </div>
    </section>

    <section class=" py-5">
      <div class="container">

        <div class="row">
          <div class="col-10 mx-auto col-sm-6 text-center menu text-decoration-underline">
            <p>Menu</p>
          </div>
        </div>

        <div class="row d-flex justify-content-between">
          <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 flex-wrap text-dark" >
            <div class=" btn btn-outline-secondary text-uppercase filter-btn m-2 justify-content-between d-flex" v-for="item in category" :key="item._id" @click="isAll=true">{{item.name}}</div>
            <!-- <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" date-filter="cake" @click="index=0;isAll=false">cake</a>
            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="cookie" @click="index=1;isAll=false">cookie</a>
            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="cupcake" @click="index=2;isAll=false">cupCake</a>
            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="donut" @click="index=3;isAll=false">donut</a>
            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="drink" @click="index=4;isAll=false">drink</a>
            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="gummy" @click="index=5;isAll=false">gummy</a> -->
          </div>
        </div>

        <div class="row">

          <div class="col-10 mx-auto col-md-6">
            <form>
              <div class="input-group mb-3 justify-content-center">
                <div class="input-group-prepend mx-3 mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                    viewBox="0 0 16 16">
                    <path
                      d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg>
                  <!-- <span class="input-group-text "><i class="fas fa-search"></i></span> -->
                </div>
                <input type="text" class="form-control" id="item" placeholder='item ...'>
              </div>

            </form>
          </div>
        </div>

        <div class="row align-items-center w-90 m-auto justify-content-between">

          <div  class="itemBox col-sm-3 mx-1 my-3  c0 c1 " v-for="item in data" :key="item._id" >
            <div class=" mt-3">
              <div class="img-container">
                <img :src="`http://localhost:8000/api/product/static/${item.imagePath}`" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class=" d-flex justify-content-between text-capitalize">
                  <!-- {{ data from mongoosdb}} -->
                  <h5>{{ item.name }} </h5>
                  <h5><strong>{{ item.price }}</strong>$</h5>
                </div>
              </div>
            </div>

          </div>


        </div>


      </div>
    </section>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import { ref } from 'vue'
const index=ref(0)
const data=ref()
const category=ref()

fetch("http://localhost:8000/api/product")
.then(res=>res.json())
.then(d=>{
  data.value=d
})

fetch("http://localhost:8000/api/category")
.then(res=>res.json())
.then(c=>{
  category.value=c
})

</script>

<style lang="scss" scoped>
* {
  box-sizing: border-box;
}

.aa {
  background-image: url(../assets/Img/background.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  width: 100%;
  z-index: -99;
}

.aboutUs {
  font-family: "Papyrus";
  font-size: 48px;

  span {
    color: red;
  }
}

.menu {
  font-family: 'Dokdo';
  font-size: 5rem;
}

svg {
  width: 35px;
  height: 35px;
}

.about-img__container {
  position: relative;
}

.about-img__container::before {
  content: "";
  position: absolute;
  top: -2rem;
  left: -1.5rem;
  width: 100%;
  height: 100%;
  outline: 0.5rem outset pink;
  z-index: -1;
  transition: all 1s ease-in-out;
}

.about-img__container:hover:before {
  top: 0;
  left: 0;
}

.img-container {
  width: 90%;
  height: 170px;
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
  height: 220px;
}

.c1 {
  background-color: #C9E0E7;

}

.c2 {
  background-color: #F5CECE;
}
</style>


<!-- $(document).ready(function () {
  $('.type').click(function () {
    const value = $(this).attr('data-filter');

    if (value == 'all') {
      $('.itemBox').show('1000');
    } else {
      $('.itemBox').not('.' + value).hide('1000');
      $('.itemBox').filter('.' + value).show('1000');
    }
  })

  $('.type').click(function () {
    $(this).addClass('active').siblings().removeClass('active');
  })
}) -->

