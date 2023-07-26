
<template>
    <div>
        <div class=" rounded-bottom mt-5 fonts"
            style="margin-left: 10%; background-color: pink; width: 400px; height: 30px;">
            <h5 class="fs-5 text-center mt-4">Home > Product's Info > Product title</h5>
        </div>
        <div class="mx-5 m-auto d-flex justiy-content-around">
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
                <div class="d-flex m-auto justify-content-between">
                    <h5>{{ product.name }}</h5>
                    <h5 class="price">{{ product.price }}</h5>
                </div>
                <hr>
                <div>
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

                        <div class="mt-0" style="margin-left: 5%;">
                            <input type="number" name="qty[]" v-model="product.quantity" class="form-select form-select-lg"
                                aria-label=".form-select-lg example">
                        </div>

                        <hr class="mt-3">

                        <router-link v-bind:to="'/menu'">
                            <div class="m-auto justify-centent-center text-center">
                                <button style="background-color: pink;" @click="addToCart(product)">
                                    <h5 class="mt-2 mx-4">Add To Cart</h5>
                                </button>

                            </div>
                        </router-link>


                        <hr class="mt-3">

                        <div class="text-center m-auto">
                            <h5>{{ product.desc }}</h5>
                        </div>
                        <router-link v-bind:to="'/menu'">
                            <div class=" align-items-end text-center" style="margin-left: 75%;">
                                <button style="background-color:aliceblue">
                                    <h5 class=" mt-2 mx-3">Back</h5>
                                </button>

                            </div>
                        </router-link>
                    </div>

                </div>
            </div>

        </div>
        <hr class="mt-3 w-75 m-auto">
        <h5 class="mt-5 m-auto w-75 fw-bold fs-1">You might also like this</h5>

        <div class="w-75 d-flex mt-4 py-5 justify-content-between m-auto">

            <div class="card col-sm-3 mx-1 my-3 c0 c1">
                <div class="card-img ">
                    <img src="../assets/Img/cake01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-6 mx-1 my-3 c0 c1">
                <div class="card-img ">
                    <img src="../assets/Img/cookie01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-6 mx-1 my-3 c0 c1">
                <div class="card-img ">
                    <img src="../assets/Img/cupcake01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-6 mx-1 my-3 c0 c1">

                <div class="card-img ">
                    <img src="../assets/Img/donut01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-6 mx-1 my-3 c0 c1">

                <div class="card-img ">
                    <img src="../assets/Img/drink01.jpeg" class=" img-fluid store-img" alt="">
                </div>
            </div>

            <div class="card col-sm-6 mx-1 my-3 c0 c1">

                <div class="card-img ">
                    <img src="../assets/Img/gummy01.jpg" class=" img-fluid store-img" alt="">
                </div>
            </div>

        </div>
    </div>
</template>
  
<script >

import { products } from '../data';

// export default {
//     name: 'productdetail',
//     methods:{
//         addToCart(cartes){
//             if(this.cart)
//             // this.$emit('add-to-cart', this.product.id, 1);
//         }
//     },
//     data() {
//         return {
//             product: products.find((p) => p.id === this.$route.params.id),
//         };
//     }

// };

export default {
    name: 'productdetail',
    data: () => ({

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
                // cart: false,
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
        ],
        cart: [],
        // purchase: [],
    }),

    //   mutations: {
    //     addProduct(state, id) {
    //       state.cart.push(id);
    //     },

    //     removeProduct(state, id) {
    //       state.cart = state.cart.filter((p) => p.id != id);
    //     },

    //     increase(state, id) {
    //       state.cart.map((p) => {
    //         if (p.id == id) {
    //           p.quantity += 1;
    //         }
    //       });
    //     },

    //     decrease(state, id) {
    //       state.cart.map((p) => {
    //         if (p.id == id && p.quantity > 1) {
    //           p.quantity -= 1;
    //         }
    //       });
    //     },

    //     buy(state) {
    //       state.cart = {
    //         id: uuidv4(),
    //         products: state.cart,
    //       };
    //       state.purchase.push(state.cart);
    //       state.cart = [];
    //     },
    //     login(state, user) {
    //       console.log("login", user);
    //       if (
    //         (state.admin.email =
    //           user.email && state.admin.password == user.password)
    //       ) {
    //         state.admin.state = true;
    //       }
    //     },

    //     logout(state) {
    //       state.admin.state = false;
    //     },
    //     // addProduct(state,product){
    //     //   state.cart.push(product)
    //     //   state.products.map((p)=>{
    //     //     if(p.id == product.id){
    //     //       p.cart = true
    //     //     }
    //     //   })
    //     // }

    //     // removeProduct(state,id){
    //     //   state.cart = state.cart.filter((p)=> p.id != id)
    //     //   state.products.map((p)=>{
    //     //     if(p.id == id){
    //     //       p.cart = false;
    //     //     }
    //     //   })
    //     // },
    //   },

    //   actions: {
    //     addProduct({ commit }, id) {
    //       commit("addProduct", id);
    //     },
    //     removeProduct({ commit }, id) {
    //       commit("removeProduct", id);
    //     },
    //     increase({ commit }, id) {
    //       commit("increase", id);
    //     },
    //     decrease({ commit }, id) {
    //       commit("decease", id);
    //     },
    //     buy({ commit }, id) {
    //       console.log("buying product with ID:", id);
    //       commit("but");
    //     },
    //     login({ commit }, user) {
    //       commit("login", user);
    //     },
    //     logout({ commit }, user) {
    //       commit("logout", user);
    //     },
    //   },

    //   getters: {
    //     getProducts: (state) => {
    //       return state.products;
    //     },

    //     getCart: (state) => {
    //       return state.cart;
    //     },

    //     getTotal: (state) => {
    //       let total = 0;
    //       state.cart.map((p) => {
    //         let x=0;
    //         // total+= (parseInt(p.price)* parseInt(p.quantity))
    //         // total += p.price * p.quantity;
    //         state.cart.map(p=> x+=p.quantity*p.price)
    //         return x
    //       });
    //       return total;
    //     },

    //     getPurchase: state=>{
    //       return state.purchase
    //     },

    //     getAdminState: state=>{
    //       return state.admin.state
    //     },


    //   },
    methods: {
        addToCart(product) {
            if (this.cart[product.id]) {
                this.cart[product.id] += 1
                return
            }
            this.cart[product.id] = 1
        }
    },

    data() {
        return {
            product: products.find((p) => p.id === this.$route.params.id),
        };
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
    padding: .7em;
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
  
  
  