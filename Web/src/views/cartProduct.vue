
<template>
    <div>
        <div class=" rounded-bottom mt-5 fonts"
            style="margin-left: 10%; background-color: pink; width: 400px; height: 30px;">
            <h5 class="fs-5 text-center mt-4">Your Cart</h5>
        </div>
        <div class=" d-flex justify-content-around m-auto" v-for="product in cartItems" :key="product.id">
            <div class="w-50">
                <hr>
                <div class="d-flex m-auto w-50 justify-content-between">
                    <h5>Item</h5>
                    <h5>Price</h5>
                    <h5>Quantity</h5>
                </div>

                <hr>
                <div class="d-flex m-auto w-50 justify-content-between">
                    <div class="img-container">
                        <img :src="product.imagePath" alt="" class="img-fluid">
                    </div>

                    <h5 class="mx-5 mt-2">{{ product.price }}</h5>
                    <div class="mt-0" style="margin-left: 5%;">
                        <input type="number" class="form-select form-select-lg" aria-label=".form-select-lg example">
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <h5 class="mx-5">Subtotal</h5>
                    <h5 class="mx-4 price">{{ tprice }}</h5>
                </div>


            </div>
            <div class="w-25 border border-dark">
                <h5 class="mx-5 mt-3">Summary</h5>
                <h5 class="mx-5">Subtotal</h5>
                <h5 class="mx-5">Shopping</h5>
                <div class="d-flex">
                    <h5 class="mx-5">Exit Taxes</h5>
                    <h5 class="price mx-2"> {{ product.price * 0.25 }}</h5>

                </div>
                <hr>
                <div class="d-flex justify-content-around">
                    <h5>Total</h5>
                    <p class="price mx-5"> 33</p>
                </div>

                <div class="d-flex justify-content-around m-auto mx-5 py-4">

                    <router-link v-bind:to="'/paymentmethod'">
                        <div class="">
                            <button class="border border-dark btn btn-success">
                                <h5 class="text-white">Checkout</h5>
                            </button>
                        </div>
                    </router-link>

                    <div class="">
                        <button class="border border-dark btn btn-danger">
                            <h5 class="text-white">Cancel</h5>
                        </button>
                    </div>

                </div>




            </div>
        </div>
    </div>
</template>
  
<script >

import { cartItems } from '../data';

export default {
    name: 'cartproduct',
    data() {
        return {
            cartItems,
            
        }
    },
    computed:{
        tprice(){
            return this.cartItems.reduce(
                (sum, item) => sum + Number(item.price),
                0,
            );
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
</style>
  
  
  