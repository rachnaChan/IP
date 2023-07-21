<template>
    <nav>
        <main>
            <div class="d-flex justify-content-between m-auto align-items-center">

                <div class="section1">
                    <img src="../assets/Img/a.png" alt="logo">
                </div>

                <div class="section3">

                    <div class="d-flex">
                        <img src="../assets/Img/phone.png" alt="" class="mt-3">
                        <p class="mt-4 font-weight-bold ">Call Us (+855-92) 000 000</p>
                    </div>

                    <div class="input-container">
                        <input type="text" name="text" class="input" placeholder="search...">
                        <span class="icon">
                            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2"
                                        stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                    </div>

                    <div class="cart d-flex align-items-center">

                        <router-link v-bind:to="'/viewcartproduct'">
                            <div>
                                <img src="../assets/Img/cart.png" alt="">
                            </div>
                        </router-link>


                        <p class=" font-weight-bold fs-1 mt-2"> ({{cart.length}}) cart</p>
                        <!-- <p class=" font-weight-bold fs-1 mt-2"> cart</p> -->
                    </div>

                </div>

            </div>
            <hr class="border-top border-3 border-dark m-auto " style="width: 100%;">

            <div class="d-flex justify-content-between">

                <div class="section2 mt-2">

                    <RouterLink :to="{ name: 'home' }"> Home</RouterLink>
                    <RouterLink :to="{ name: 'about' }">About</RouterLink>
                    <RouterLink :to="{ name: 'menu' }">Shop</RouterLink>
                </div>

                <div class="d-flex mt-3 ">
                    <RouterLink :to="{ name: 'login' }">
                        <button class="learn-more"> Login
                    </button>
                    </RouterLink>
                    <!-- <button class="learn-more"> Login
                    </button> -->

                    <RouterLink :to="{ name: 'signup' }">
                        <button class="learn-more"> Register
                    </button>
                    </RouterLink>

                    <!-- <button class="learn-more mx-2"> Register
                    </button> -->
                </div>

            </div>
        </main>
    </nav>
</template>

<script >
import { RouterLink } from 'vue-router'
import { cartItems } from '../data';

import img1 from "../assets/Img/cake01.jpg";
import img2 from "../assets/Img/cake02.jpg";
import img3 from "../assets/Img/cake03.jpg";
import img4 from "../assets/Img/cake04.jpg";
import img5 from "../assets/Img/cookie01.jpg";
import img6 from "../assets/Img/cookie02.jpg";
import img7 from "../assets/Img/cookie03.jpg";
import img8 from "../assets/Img/cookie04.jpg";
import img9 from "../assets/Img/cupcake01.jpg";
import img10 from "../assets/Img/cupcake02.jpg";
import img11 from "../assets/Img/cupcake03.jpg";
import img12 from "../assets/Img/cupcake04.jpg";
import img13 from "../assets/Img/donut01.jpg";
import img14 from "../assets/Img/donut02.jpeg";
import img15 from "../assets/Img/donut03.jpg";
import img16 from "../assets/Img/donut04.jpg";
import img17 from "../assets/Img/drink01.jpeg";
import img18 from "../assets/Img/drink02.jpg";
import img19 from "../assets/Img/drink03.jpg";
import img20 from "../assets/Img/drink04.jpg";
import img21 from "../assets/Img/gummy01.jpg";
import img22 from "../assets/Img/gummy02.jpg";
import img23 from "../assets/Img/gummy03.jpg";
import img24 from "../assets/Img/gummy04.jpg";

export default {
    name: 'menu',
    data() {
        return {
            // products
            cart: [],
            products: [
                {
                    id: "1",
                    name: "cake-01",
                    price: "15.99",
                    imagePath: img1,
                    desc: "Cake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "2",
                    name: "cake-02",
                    price: "17.68",
                    imagePath: img2,
                    desc: "Cake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "3",
                    name: "cake-03",
                    price: "12.99",
                    imagePath: img3,
                    desc: "Cake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "4",
                    name: "cake-04",
                    price: "14.88",
                    imagePath: img4,
                    desc: "Cake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "5",
                    name: "cookie-01",
                    price: "3.88",
                    imagePath: img5,
                    desc: "Cookie, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "6",
                    name: "cookie-02",
                    price: "4.88",
                    imagePath: img6,
                    desc: "Cookie, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },

                {
                    id: "7",
                    name: "cookie-03",
                    price: "5.44",
                    imagePath: img7,
                    desc: "Cookie, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "8",
                    name: "cookie-04",
                    price: "3.66",
                    imagePath: img8,
                    desc: "Cookie, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "9",
                    name: "cuppcake-01",
                    price: "3.66",
                    imagePath: img9,
                    desc: "Cupcake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "10",
                    name: "cupcake-02",
                    price: "4.56",
                    imagePath: img10,
                    desc: "Cupcake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "11",
                    name: "cupcake-03",
                    price: "2.99",
                    imagePath: img11,
                    desc: "Cupcake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "12",
                    name: "cupcake-04",
                    price: "4.88",
                    imagePath: img12,
                    desc: "Cupcake, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "13",
                    name: "donut-01",
                    price: "2.55",
                    imagePath: img13,
                    desc: "Donut, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "14",
                    name: "donut-02",
                    price: "3.2",
                    imagePath: img14,
                    desc: "Donut, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "15",
                    name: "donut-03",
                    price: "2.78",
                    imagePath: img15,
                    desc: "Donut, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "16",
                    name: "donut-04",
                    price: "3.5",
                    imagePath: img16,
                    desc: "Donut, Nice for a potato person!!",
                    cart: false,
                    quantity: 1,
                },
                {
                    id: "17",
                    name: "drink-01",
                    price: "5.2",
                    imagePath: img17,
                    desc: "Drink, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "18",
                    name: "drink-02",
                    price: "6.1",
                    imagePath: img18,
                    desc: "Drink, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "19",
                    name: "drink-03",
                    price: "4.6",
                    imagePath: img19,
                    desc: "Drink, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "20",
                    name: "drink-04",
                    price: "5.4",
                    imagePath: img20,
                    desc: "Drink, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "21",
                    name: "gummy-01",
                    price: "1.56",
                    imagePath: img21,
                    desc: "Gummy, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "22",
                    name: "gummy-02",
                    price: "2.2",
                    imagePath: img22,
                    desc: "Gummy, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "23",
                    name: "gummy-03",
                    price: "1.99",
                    imagePath: img23,
                    desc: "Gummy, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
                {
                    id: "24",
                    name: "gummy-04",
                    price: "3.1",
                    imagePath: img24,
                    desc: "Gummy, Nice for a potato person!!",
                    // cart: false,
                    quantity: 1,
                },
            ]
        };
    },

    methods:{
        addItemToCart(product){
            console.log(product);
            this.cart.push(product);
            console.log(this.cart);
        }
        
    },


};
</script>

<style lang="scss" scoped>
* {
    box-sizing: border-box;
}

nav {
    width: 100%;
    padding: 1rem 2rem;
    height: 160px;

    main {
        width: 100%;

        .section1 {
            img {
                width: 18rem;
                height: 80px;
                margin-left: 10%;
                // background: transparent;
            }
        }

        .section2 {
            display: flex;
            gap: 2.4rem;
            font-family: inherit;
            font-size: 48px;
            margin-left: 10%;

            img {
                width: 5rem;
            }

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

        .section3 {
            margin-left: 10%;
            display: flex;
            align-items: center;
            gap: 1rem;
            --size: 42px;

            p {
                font-family: 'papyrus';
            }

            img {
                width: 4rem;
                height: 50px;
            }

            .cart {
                gap: 1rem;
            }
        }

        .input-container {
            width: 160px;
            position: relative;
        }

        .icon {
            position: absolute;
            right: 10px;
            top: calc(50% + 5px);
            transform: translateY(calc(-50% - 5px));
        }

        .input {
            width: 100%;
            height: 40px;
            padding: 10px;
            transition: .2s linear;
            border: 2.5px solid black;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .input:focus {
            outline: none;
            border: 0.5px solid black;
            box-shadow: -5px -5px 0px black;
        }

        .input-container:hover>.icon {
            animation: anim 1s linear infinite;
        }

        @keyframes anim {

            0%,
            100% {
                transform: translateY(calc(-50% - 5px)) scale(1);
            }

            50% {
                transform: translateY(calc(-50% - 5px)) scale(1.1);
            }
        }

        button {
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            vertical-align: middle;
            text-decoration: none;
            font-family: inherit;
            font-size: 15px;
        }

        button.learn-more {
            font-weight: 600;
            color: #382b22;
            text-transform: uppercase;
            padding: .4em 2em;
            background: #fff0f0;
            border: 2px solid #b18597;
            border-radius: 0.75em;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-transition: background 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-transform 150ms cubic-bezier(0, 0, 0.58, 1);
            transition: transform 150ms cubic-bezier(0, 0, 0.58, 1), background 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-transform 150ms cubic-bezier(0, 0, 0.58, 1);
        }

        button.learn-more::before {
            position: absolute;
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f9c4d2;
            border-radius: inherit;
            -webkit-box-shadow: 0 0 0 2px #b18597, 0 0.625em 0 0 #ffe3e2;
            box-shadow: 0 0 0 2px #b18597, 0 0.625em 0 0 #ffe3e2;
            -webkit-transform: translate3d(0, 0.75em, -1em);
            transform: translate3d(0, 0.75em, -1em);
            transition: transform 150ms cubic-bezier(0, 0, 0.58, 1), box-shadow 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-transform 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-box-shadow 150ms cubic-bezier(0, 0, 0.58, 1);
        }

        button.learn-more:hover {
            background: #ffe9e9;
            -webkit-transform: translate(0, 0.25em);
            transform: translate(0, 0.25em);
        }

        button.learn-more:hover::before {
            -webkit-box-shadow: 0 0 0 2px #b18597, 0 0.5em 0 0 #ffe3e2;
            box-shadow: 0 0 0 2px #b18597, 0 0.5em 0 0 #ffe3e2;
            -webkit-transform: translate3d(0, 0.5em, -1em);
            transform: translate3d(0, 0.5em, -1em);
        }

        button.learn-more:active {
            background: #ffe9e9;
            -webkit-transform: translate(0em, 0.75em);
            transform: translate(0em, 0.75em);
        }

        button.learn-more:active::before {
            -webkit-box-shadow: 0 0 0 2px #b18597, 0 0 #ffe3e2;
            box-shadow: 0 0 0 2px #b18597, 0 0 #ffe3e2;
            -webkit-transform: translate3d(0, 0, -1em);
            transform: translate3d(0, 0, -1em);
        }
    }
}
</style>