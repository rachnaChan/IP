import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import MenuView from "../views/MenuView.vue";
import cartProduct from "../views/cartProduct.vue";
import productDetail from "../views/productDetail.vue";
import viewCartProduct from "../views/viewCartProduct.vue";
import productList from "../component/productList.vue";
import paymentmethod from "../views/paymentMethod.vue";
import login from "../views/login.vue";
import signup from "../views/signup.vue";
import checkoutshipping from "../views/checkoutShipping.vue"
import checkoutpayment from "../views/checkoutPayment.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },

  {
    path: "/about",
    name: "about",
    component: AboutView,
  },

  {
    path: "/menu",
    name: "menu",
    component: MenuView,
  },
  {
    path: "/menu/:id",
    name: "productdetail",
    component: productDetail,
  },
  {
    path: "/cartproduct",
    name: "cartproduct",
    component: cartProduct,
  },
  {
    path: "/viewcartproduct",
    name: "viewcartproduct",
    component: viewCartProduct,
  },
  {
    path: "/productlist",
    name: "productlist",
    component: productList,
  },
  {
    path: "/paymentmethod",
    name: "paymentmethod",
    component: paymentmethod,
  },
  {
    path: "/checkoutshipping",
    name: "checkoutshipping",
    component: checkoutshipping,
  },
  {
    path: "/checkoutpayment",
    name: "checkoutpayment",
    component: checkoutpayment,
  },
  // {
  //   path: "/login",
  //   name: "login",
  //   component: login,
  // },
  // {
  //   path: "/signup",
  //   name: "signup",
  //   component: signup,
  // },

],

});


export default router;
