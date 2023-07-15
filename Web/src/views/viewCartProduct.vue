
<template>
    <div>
        <div class=" rounded-bottom mt-5 fonts"
            style="margin-left: 10%; background-color: pink; width: 400px; height: 30px;">
            <h5 class="fs-5 text-center mt-4">Home > Product's Info > Product title</h5>
        </div>
        <div class="mx-5 m-auto d-flex justiy-content-around" v-for="product in cartItems" :key="product.id">
            <div class=" mt-5 border border-dark w-50" style="margin-left: 10%; background-color: rgb(232, 226, 226);">

                <div>
                    <div class="img-container mt-4" style="height: 400px; ">
                        <img v-bind:src="product.imagePath" class="img-fluid rounded" />
                    </div>
                </div>

                <hr>

                <div class="w-75 mt-4 d-flex m-auto justify-content-between">
                    <div class="m-auto position-relative w-50">
                        <img v-bind:src="product.imagePath" class="img-fluid " />
                    </div>

                    <div class="m-auto position-relative w-50 mx-4">
                        <img v-bind:src="product.imagePath" class="img-fluid " />
                    </div>
                    <div class="m-auto position-relative w-50 py-5">
                        <img v-bind:src="product.imagePath" class="img-fluid " />
                    </div>
                </div>
            </div>

            <div class="w-25 mt-5 mx-5">
                <div class=" border border-dark" style="background: aliceblue;">

                    <h5 class="mt-4 mx-3">Item Added to Cart</h5>

                    <hr>

                    <div class="d-flex mx-5 justify-content-around">
                        <h5>{{ product.name }}</h5>
                        <h5>size</h5>
                    </div>

                    <div class="d-flex mx-5 justify-content-around">
                        <h5>quantity</h5>
                        <h5>{{ product.price }}</h5>
                    </div>

                    <div class="d-flex justify-content-around m-auto mx-5 py-4">

                        <router-link v-bind:to="'/cartproduct'">
                            <div class="">
                                <button class="border border-dark btn btn-secondary">
                                    <h5 class="text-white">View Cart</h5>
                                </button>
                            </div>
                        </router-link>

                        <div class="">
                            <button class="border border-dark btn btn-primary"
                                v-on:click="$emit('remove-from-cart', product.id)">
                                <h5 class="text-white">Remove</h5>
                            </button>
                        </div>

                    </div>

                </div>

                <hr>

                <div id="blur"></div>

                <div id="contented">
                    <div class="d-flex m-auto justify-content-between ">
                        <h5>Size</h5>
                        <h5 class="text-decoration-underline">Sizing Chart</h5>
                    </div>
                    <div>
                        <div class="d-flex m-auto justify-content-between mt-3">
                            <div class=" rounded-bottom fonts mx-5"
                                style="background-color: pink; width: 400px; height: 30px;">
                                <h5 class=" text-center mt-1">S</h5>
                            </div>
                            <div class=" rounded-bottom  fonts mx-5"
                                style="background-color: pink; width: 400px; height: 30px;">
                                <h5 class=" text-center mt-1">M</h5>
                            </div>
                            <div class=" rounded-bottom fonts mx-5"
                                style="background-color: pink; width: 400px; height: 30px;">
                                <h5 class=" text-center mt-1">L</h5>
                            </div>
                        </div>


                        <div class="mt-3">
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected>Choose Size...</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                        </div>
                        <hr class="mt-3">

                        <div class="mt-3">
                            <input type="number" placeholder="Quality" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example">
                        </div>

                        <hr class="mt-3">

                        <div class="m-auto justify-centent-center text-center">
                            <router-link v-bind:to="'/cartproduct'">
                                <button style="background-color: pink;">
                                    <h5 class="mt-2 mx-4">Add To Cart</h5>
                                </button>
                            </router-link>

                        </div>

                        <hr class="mt-3">

                        <div class="text-center m-auto">
                            <h5>{{ product.desc }}</h5>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        <hr class="mt-3 w-75 m-auto">
        <h5 class="mt-5 m-auto w-75 fw-bold fs-1">You might also like this</h5>

        <div class="w-75 m-auto d-flex mt-4 py-5 justify-content-around">

            <div class="card col-sm-4 mx-1 my-3 c0 c1">
                <div class="card-img ">
                    <img src="../assets/Img/cake01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-4 mx-1 my-3 c0 c1">
                <div class="card-img ">
                    <img src="../assets/Img/cookie01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-4 mx-1 my-3 c0 c1">
                <div class="card-img ">
                    <img src="../assets/Img/cupcake01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-4 mx-1 my-3 c0 c1">

                <div class="card-img ">
                    <img src="../assets/Img/donut01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-4 mx-1 my-3 c0 c1">

                <div class="card-img ">
                    <img src="../assets/Img/drink01.jpeg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-4 mx-1 my-3 c0 c1">

                <div class="card-img ">
                    <img src="../assets/Img/gummy01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

        </div>
    </div>
</template>
  
<script >

import { cartItems } from '../data';

export default {
    name: 'viewcartproduct',
    props: ['product'],
    data() {
        return {
            cartItems,
        }
    }

};
</script>
  
<style lang="scss" scoped>
* {
    box-sizing: border-box;
}

h5 {
    font-family: 'papyrus';
}

.fonts {
    font-family: "papyrus";
    font-size: 2.8rem;
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
    width: 75%;
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

.price::before {
    /* content: "\20B9"; */
    content: "$";
    font-family: Arial;
    text-align: right;
}

.card {
    width: 190px;
    height: 180px;
    padding: .8em;
    background: #f5f5f5;
    position: relative;
    overflow: visible;
    // box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.card-img {
    background-image: url(../assets/Img/cake03.jpg);
    height: 40%;
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

#contented {

    filter: blur(2px);
    -webkit-filter: blur(2px);
}

#blur {
    z-index: 2;
}
</style>
  
  
  