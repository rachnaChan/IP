
<template>
    <div style="width: 100%;">

        <div class=" rounded-bottom mt-5 fonts"
            style="margin-left: 10%; background-color: pink; width: 700px; height: 30px;">
            <h5 class="fs-5 text-center mt-4">Cart > Customer information > shipping information > payment Method</h5>
        </div>

        <!-- <div class=" d-flex justify-content-around m-auto" v-for="product in cartItems" :key="product.id"> -->
        <div class=" d-flex justify-content-around m-auto" v-for="product in cartItems" :key="product.id">

            <div class="w-50 ">

                <hr>

                <div class=" m-auto w-100 justify-content-between">

                    <div class="d-flex m-auto justify-content-between ">

                        <label for="email">
                            <h5 class="text-bold d-flex ">Shiping Address <span>
                                    <h6 class="mx-3 mt-1">address info</h6>
                                </span></h5>
                        </label>

                        <h5>
                            <router-link v-bind:to="'/paymentmethod'">
                                Edit
                            </router-link>
                        </h5>

                    </div>

                    <hr>

                </div>

                <div class=" m-auto w-100 justify-content-between mt-4">

                    <div class=" m-auto justify-content-between ">
                        <label for="email">
                            <h5 class="text-bold">Shipping Method</h5>
                        </label>
                    </div>

                    <div>

                        <div class="d-flex m-auto justify-content-between">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">

                                <label class="form-check-label" for="inlineRadio1">UPS Ground</label>
                            </div>

                            <div class="d-flex mx-5">
                                <h5 class="price">2.4</h5>

                            </div>
                        </div>
                        <div class="d-flex m-auto justify-content-between">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">

                                <label class="form-check-label" for="inlineRadio1">UPS 3 Days Select</label>
                            </div>

                            <div class="d-flex mx-5">
                                <h5 class="price">4.4</h5>

                            </div>
                        </div>
                        <div class="d-flex m-auto justify-content-between">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">

                                <label class="form-check-label" for="inlineRadio1">UPS 2nd Day Air</label>
                            </div>

                            <div class="d-flex mx-5">
                                <h5 class="price">8.4</h5>

                            </div>
                        </div>
                        <div class="d-flex m-auto justify-content-between">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">

                                <label class="form-check-label" for="inlineRadio1">UPS Next Day After</label>
                            </div>

                            <div class="d-flex mx-5">
                                <h5 class="price">12.4</h5>

                            </div>
                        </div>



                        

                        <!-- <div class="form-check">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                                value="option3" disabled>
                            <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
                        </div> -->

                    </div>

                </div>

                <hr>

                <div class="return d-flex justify-content-between m-auto">

                    <RouterLink :to="{ name: 'viewcartproduct' }">
                        <h5 class=" mt-3 text-decoration-none"> > Return to Cart</h5>
                    </RouterLink>

                    <router-link v-bind:to="'/checkoutpayment'">
                        <div class="">
                            <button class="border border-dark btn btn-secondary">
                                <h5 class="text-white">Continue Shipping Method</h5>
                            </button>
                        </div>
                    </router-link>

                </div>





            </div>


            <div class="w-25 border border-dark">

                <h5 class="mx-5 mt-3">Summary</h5>

                <div class="d-flex">
                    <h5 class="mx-5">Subtotal</h5>
                    <h5 class="mx-5">---</h5>
                </div>

                <div class="d-flex">
                    <h5 class="mx-5">Shopping</h5>
                    <h5 class="mx-5">---</h5>
                </div>

                <div class="d-flex">
                    <h5 class="mx-5">Exit Taxes</h5>
                    <h5 class="price mx-4"> {{ product.price * 0.25 }}</h5>

                </div>

                <hr>

                <h6 class="m-auto mx-5 fw-5">Gift card or discount code <span class="price mx-4">33</span></h6>

                <div>
                    <form action="" class="d-flex m-auto justify-content-around mt-3">
                        <input type="text" class="mx-2 w-75">
                        <button type="submit" class="btn btn-success"> Apply</button>
                    </form>
                </div>

                <hr>

                <div class="d-flex justify-content-around">
                    <h5>Total</h5>
                    <p class="price mx-5"> 33</p>
                </div>

            </div>

        </div>

    </div>
</template>
  
<script >

import { cartItems } from '../data';

export default {
    name: 'paymentmethod',
    data() {
        return {
            cartItems,

        }
    },
    computed: {
        tprice() {
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

h5,
h6 {
    font-family: 'papyrus';
}

.fonts {
    font-family: "papyrus";
    font-size: 2.8rem;
}

.return {
    a {
        font-size: 2rem;
        text-decoration: none;
        color: black;

        &.router-link-exact-active {
            color: gray;
            // text-decoration: underline;
        }
    }
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
  
  
  