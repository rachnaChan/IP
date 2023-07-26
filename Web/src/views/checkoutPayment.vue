
<template>
    <div style="width: 100%;" class="mb-5">

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

                    <div class="d-flex m-auto justify-content-between ">

                        <label for="email">
                            <h5 class="text-bold d-flex ">Shiping Method <span>
                                    <h6 class="mx-3 mt-1">shipping info</h6>
                                </span></h5>
                        </label>

                        <h5>
                            <router-link v-bind:to="'/checkoutshipping'">
                                Edit
                            </router-link>
                        </h5>

                    </div>

                    <hr>

                </div>

                <div class=" m-auto w-100 justify-content-between mt-4">

                    <div class=" m-auto justify-content-between ">
                        <label for="email">
                            <h5 class="text-bold">Payment Method</h5>
                        </label>
                    </div>

                    <div>
                        <div>
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" placeholder="Card name" aria-label="Username"
                                    aria-describedby="addon-wrapping">
                                <span class="input-group-text" id="addon-wrapping">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </span>
                            </div>
                        </div>

                        <div class="mt-3 d-flex m-auto justify-content-between">

                            <input type="text" placeholder="Name on Card" id="floatingInput" class="form-control w-75 "
                                v-model="email">

                            <input type="date" id="floatingInput" class="form-control mx-4 w-25" v-model="email">

                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" placeholder="CVV" aria-label="Username"
                                    aria-describedby="addon-wrapping">
                                <span class="input-group-text" id="addon-wrapping">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </span>
                            </div>

                            <hr>

                        </div>

                        <div class="mt-3">
                            <div class=" m-auto justify-content-between ">
                                <label for="email">
                                    <h5 class="text-bold">Billing Address</h5>
                                </label>
                            </div>

                            <div class="input-group flex-nowrap form-control">
                                <span class="input-group-text bg-white border-0" id="addon-wrapping">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="option1">

                                        <label class="form-check-label" for="inlineRadio1">Same ad shipping Address</label>
                                    </div>


                                </span>


                            </div>

                            <div class="input-group flex-nowrap form-control mt-1">
                                <span class="input-group-text bg-white border-0" id="addon-wrapping">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="option1">

                                        <label class="form-check-label" for="inlineRadio1">Use a different billing
                                            address</label>
                                    </div>


                                </span>


                            </div>

                        </div>

                        <div class="mt-3">
                            <div class=" m-auto justify-content-between ">
                                <label for="email">
                                    <h5 class="text-bold">Remember Me</h5>
                                </label>
                            </div>

                            <div class="input-group flex-nowrap form-control mt-1">
                                <span class="input-group-text bg-white border-0" id="addon-wrapping">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inlineRadioOptions"
                                            id="inlineCheckbox1" value="option1">

                                        <label class="form-check-label" for="inlineCheckbox1">Save my information for faster
                                            checkout</label>
                                    </div>


                                </span>

                            </div>

                        </div>


                    </div>

                </div>

                <hr>

                <div class="return d-flex justify-content-between m-auto">

                    <RouterLink :to="{ name: 'paymentmethod' }">
                        <h5 class=" mt-3 text-decoration-none"> > Return to Customer information</h5>
                    </RouterLink>

                    <router-link v-bind:to="'/'">
                        <div class="">
                            <button class="border border-dark btn btn-secondary">
                                <h5 class="text-white">Complete Order</h5>
                            </button>
                        </div>
                    </router-link>

                </div>
            </div>


            <div class="w-25 border border-dark h-100 mb-5 ">

                <h5 class="mx-5 mt-3">Summary</h5>

                <div class="d-flex">
                    <h5 class="mx-5">Subtotal</h5>
                    <h5 class="mx-5">{{ product.quantity }} qty</h5>
                </div>

                <div class="d-flex">
                    <h5 class="mx-5">Shopping</h5>
                    <h5 class="mx-5">{{ product.name }}</h5>
                </div>

                <div class="d-flex">
                    <h5 class="mx-5">Exit Taxes</h5>
                    <h5 class="price mx-4"> {{ product.price * 0.25 }}</h5>

                </div>

                <hr>

                <h6 class="m-auto mx-5 fw-5">Gift card or discount code <span class="price mx-4">{{ tprice +
                    product.price * 0.25 }}</span></h6>

                <div>
                    <form action="" class="d-flex m-auto justify-content-around mt-3">
                        <input type="text" class="mx-2 w-75">
                        <button type="submit" class="btn btn-success"> Apply</button>
                    </form>
                </div>

                <hr>

                <div class="d-flex justify-content-around">
                    <h5>Total</h5>
                    <p class="price mx-5" v-if="product.ground"> {{ mOne + product.price * 0.25 }}</p>
                    <p class="price mx-5" v-else-if="product.threedays"> {{ mTwo + product.price * 0.25 }}</p>
                    <p class="price mx-5" v-else-if="product.secondair"> {{ mThree + product.price * 0.25 }}</p>
                    <p class="price mx-5" v-else> {{ mFour + product.price * 0.25 }}</p>
                </div>

            </div>

        </div>

    </div>
</template>
  
<script >

import { cartItems, products } from '../data';

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
                (sum, item) => sum + Number(item.price) * Number(item.quantity),
                0,
            );
        },
        mOne() {
            return this.cartItems.reduce(
                (sum, item) => sum + Number(item.price) * Number(item.quantity) + (item.ground),
                0,
            );
        },
        mTwo() {
            return this.cartItems.reduce(
                (sum, item) => sum + Number(item.price) * Number(item.quantity) + (item.threedays),
                0,
            );
        },
        mThree() {
            return this.cartItems.reduce(
                (sum, item) => sum + Number(item.price) * Number(item.quantity) + (item.secondair),
                0,
            );
        },
        mFour() {
            return this.cartItems.reduce(
                (sum, item) => sum + Number(item.price) * Number(item.quantity) + (item.nextday),
                0,
            );
        },
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
  
  
  