import { createStore } from "vuex";
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
// import { useAttrs } from "vue";

// Create a new store instance.
export default createStore({
  state: {
    admin: {
      email: "rachnac@gmail.com",
      password: 123456,
      state: false,
    },
    products: [
      {
        id: "1",
        name: "cake-01",
        price: "15.99",
        imagePath: img1,
        desc: "Cake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "2",
        name: "cake-02",
        price: "17.68",
        imagePath: img2,
        desc: "Cake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "3",
        name: "cake-03",
        price: "12.99",
        imagePath: img3,
        desc: "Cake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "4",
        name: "cake-04",
        price: "14.88",
        imagePath: img4,
        desc: "Cake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "5",
        name: "cookie-01",
        price: "3.88",
        imagePath: img5,
        desc: "Cookie, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "6",
        name: "cookie-02",
        price: "4.88",
        imagePath: img6,
        desc: "Cookie, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },

      {
        id: "7",
        name: "cookie-03",
        price: "5.44",
        imagePath: img7,
        desc: "Cookie, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "8",
        name: "cookie-04",
        price: "3.66",
        imagePath: img8,
        desc: "Cookie, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "9",
        name: "cuppcake-01",
        price: "3.66",
        imagePath: img9,
        desc: "Cupcake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "10",
        name: "cupcake-02",
        price: "4.56",
        imagePath: img10,
        desc: "Cupcake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "11",
        name: "cupcake-03",
        price: "2.99",
        imagePath: img11,
        desc: "Cupcake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "12",
        name: "cupcake-04",
        price: "4.88",
        imagePath: img12,
        desc: "Cupcake, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "13",
        name: "donut-01",
        price: "2.55",
        imagePath: img13,
        desc: "Donut, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "14",
        name: "donut-02",
        price: "3.2",
        imagePath: img14,
        desc: "Donut, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "15",
        name: "donut-03",
        price: "2.78",
        imagePath: img15,
        desc: "Donut, Nice for a potato person!!",
        cart: false,
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
        cart: false,
        quantity: 1,
      },
      {
        id: "18",
        name: "drink-02",
        price: "6.1",
        imagePath: img18,
        desc: "Drink, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "19",
        name: "drink-03",
        price: "4.6",
        imagePath: img19,
        desc: "Drink, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "20",
        name: "drink-04",
        price: "5.4",
        imagePath: img20,
        desc: "Drink, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "21",
        name: "gummy-01",
        price: "1.56",
        imagePath: img21,
        desc: "Gummy, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "22",
        name: "gummy-02",
        price: "2.2",
        imagePath: img22,
        desc: "Gummy, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "23",
        name: "gummy-03",
        price: "1.99",
        imagePath: img23,
        desc: "Gummy, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
      {
        id: "24",
        name: "gummy-04",
        price: "3.1",
        imagePath: img24,
        desc: "Gummy, Nice for a potato person!!",
        cart: false,
        quantity: 1,
      },
    ],
    cart: [],
    purchase: [],
  },

  mutations: {
    addProduct(state, id) {
      state.cart.push(id);
    },

    removeProduct(state, id) {
      state.cart = state.cart.filter((p) => p.id != id);
    },

    increase(state, id) {
      state.cart.map((p) => {
        if (p.id == id) {
          p.quantity += 1;
        }
      });
    },

    decrease(state, id) {
      state.cart.map((p) => {
        if (p.id == id && p.quantity > 1) {
          p.quantity -= 1;
        }
      });
    },

    buy(state) {
      state.cart = {
        id: uuidv4(),
        products: state.cart,
      };
      state.purchase.push(state.cart);
      state.cart = [];
    },
    login(state, user) {
      console.log("login", user);
      if (
        (state.admin.email =
          user.email && state.admin.password == user.password)
      ) {
        state.admin.state = true;
      }
    },

    logout(state) {
      state.admin.state = false;
    },
    // addProduct(state,product){
    //   state.cart.push(product)
    //   state.products.map((p)=>{
    //     if(p.id == product.id){
    //       p.cart = true
    //     }
    //   })
    // }

    // removeProduct(state,id){
    //   state.cart = state.cart.filter((p)=> p.id != id)
    //   state.products.map((p)=>{
    //     if(p.id == id){
    //       p.cart = false;
    //     }
    //   })
    // },
  },

  actions: {
    addProduct({ commit }, id) {
      commit("addProduct", id);
    },
    removeProduct({ commit }, id) {
      commit("removeProduct", id);
    },
    increase({ commit }, id) {
      commit("increase", id);
    },
    decrease({ commit }, id) {
      commit("decease", id);
    },
    buy({ commit }, id) {
      console.log("buying product with ID:", id);
      commit("but");
    },
    login({ commit }, user) {
      commit("login", user);
    },
    logout({ commit }, user) {
      commit("logout", user);
    },
  },

  getters: {
    getProducts: (state) => {
      return state.products;
    },

    getCart: (state) => {
      return state.cart;
    },

    getTotal: (state) => {
      let total = 0;
      state.cart.map((p) => {
        let x=0;
        // total+= (parseInt(p.price)* parseInt(p.quantity))
        // total += p.price * p.quantity;
        state.cart.map(p=> x+=p.quantity*p.price)
        return x
      });
      return total;
    },

    getPurchase: state=>{
      return state.purchase
    },

    getAdminState: state=>{
      return state.admin.state
    },

   
  },
   modules: {},
});
