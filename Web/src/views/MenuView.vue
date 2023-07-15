
<template>

        <section class=" py-5">
            <div class="container">

                <div class="row">
                    <div class="col-10 mx-auto col-sm-6 text-center menu ">
                        <p>Menu</p>
                    </div>
                </div>

                <!-- <div class="row d-flex justify-content-between ">
                    <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 flex-wrap text-dark">
                        <div
                            class=" btn btn-outline-secondary text-uppercase filter-btn m-2 justify-content-between d-flex">
                        </div>
                        <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" date-filter="cake" @click="index=0;isAll=false">cake</a>
                        <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="cookie" @click="index=1;isAll=false">cookie</a>
                        <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="cupcake" @click="index=2;isAll=false">cupCake</a>
                        <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="donut" @click="index=3;isAll=false">donut</a>
                        <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="drink" @click="index=4;isAll=false">drink</a>
                        <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2" data-filter="gummy" @click="index=5;isAll=false">gummy</a>
                    </div>
                </div> -->

                <!-- <div class="row">

                    <div class="col-10 mx-auto col-md-6">
                        <form>
                            <div class="input-group mb-3 justify-content-center">
                                <div class="input-group-prepend mx-3 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                    <span class="input-group-text "><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" id="item" placeholder='item ...'>
                            </div>

                        </form>
                    </div>
                </div> -->

                <div class="row align-items-center w-90 m-auto justify-content-between">

                    <!-- <div class="itemBox col-sm-3 mx-1 my-3  c0 c2 " v-for="product in products" v-bind:key="product.id">
                        <div class=" mt-3">
                            <div class="img-container">
                                <img v-bind:src="product.imagePath" class=" img-fluid store-img" alt="">
                            </div>
                            <div>
                                <div class=" d-flex justify-content-between text-capitalize">
                                    {{ data from mongoosdb}}
                                    <h5>{{ product.name }} </h5>
                                    <h5><strong>{{ product.price }}</strong>$</h5>
                                    <div class="mt-0 card-button">
                                        <router-link v-bind:to="'/products/' + 'product.id'">
                                            <svg class="svg-icon" viewBox="0 0 20 20">
                                                <path
                                                    d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                                </path>
                                                <path
                                                    d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                                </path>
                                                <path
                                                    d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                                </path>
                                            </svg>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->

                    <div class="card col-sm-3 mx-2 my-3 c0" v-for="product in products" :key="product.id">

                        <div class="img-container">
                            <div class="card-img ">
                                <img v-bind:src="product.imagePath" class=" img-fluid" alt="">
                            </div>
                        </div>


                        <div class="mt-4">
                            <h5 class=" text-center">{{ product.name }} </h5>
                            <h6>{{ product.desc }}</h6>
                        </div>

                        <div class="card-footer">

                            <span class="text-title price">{{ product.price }}</span>

                            <div class="card-button">
                                <router-link v-bind:to="'/menu/' + product.id">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path
                                            d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                        </path>
                                        <path
                                            d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                        </path>
                                        <path
                                            d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                        </path>
                                    </svg>
                                </router-link>
                            </div>

                        </div>
                    </div>


                </div>


            </div>
        </section>
   
</template>
  
<script>

export default {
    name: 'menu',
    data() {
        return {
            products
        }
    }

};
import { products } from '../data';

</script>
  
<style lang="scss" scoped>
* {
    box-sizing: border-box;
}

.aboutUs {
    font-family: "Papyrus";
    font-size: 36px;

    span {
        color: red;
    }
}

.menu {
    font-family: 'papyrus';
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
    height: 180px;
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

.price::before {
    /* content: "\20B9"; */
    content: "$";
    font-family: Arial;
    text-align: right;
}

.c2 {
    background: linear-gradient (to right, pink, aliceblue, pink);
}


.title {
    font-size: 1.5em;
    font-weight: 900;
    text-align: center;
    margin: 0;
}

/*cart*/
// .card {
//     width: 190px;
//     height: 280px;
//     padding: .8em;
//     background: #f5f5f5;
//     position: relative;
//     overflow: visible;
//     // box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
// }


.card {
    width: 250px;
    height: 300px;
    padding: .8em;
    background: #f5f5f5;
    position: relative;
    overflow: visible;
    // box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.card-img {
    // background-image: url(../assets/Img/cake03.jpg);
    height: 100px;
    width: 100%;
    border-radius: .5rem;
    transition: .3s ease;
}

svg {
    width: 20px;
    height: 20px;
}

.card-footer {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 5px;
    border-top: 1px solid #686464;
}

.text-body {
    font-size: .5em;
    padding-bottom: 10px;
}

/*Button*/
.card-button {
    border: 1px solid #252525;
    display: flex;
    padding: .3em;
    cursor: pointer;
    border-radius: 50px;
    transition: .3s ease-in-out;
}

/*Hover*/
.card-img:hover {
    transform: translateY(-25%);
    box-shadow: rgba(226, 196, 63, 0.25) 0px 13px 47px -5px, rgba(180, 71, 71, 0.3) 0px 8px 16px -8px;
}

.card-button:hover {
    border: 1px solid #ffcaa6;
    background-color: #ffcaa6;
}
</style>
  
  
  
<!-- 
<template>
    <div id="page-wrap">
      <ProductsGrid :products="products" />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import ProductsGrid from '../components/ProductsGrid.vue';
  
  export default {
      name: 'ProductsPage',
      components: {
        ProductsGrid,
      },
      data() {
        return {
          products: [],
        };
      },
      async created() {
        const result = await axios.get('http://localhost:8000/api/product');
        const products = result.data;
        this.products = products;
      }
  };
  </script> -->
  
  