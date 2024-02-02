<script>
import axios from "axios";
import VueCookies from "vue-cookies";
import setAuthHeader from "../libs/apis/axiosConfig";
import store from "../store";
export default {
  data() {
    return {
      user: null,
      email: "",
      password: "",
      hasError: false,
      errormessage: "",
      rememberMe: false,
      loginUser: null,
    };
  },
  mounted() {
    const rememberedEmail = VueCookies.get("rememberedEmail");
    const rememberedPassword = VueCookies.get("rememberedPassword");

    if (rememberedEmail && rememberedPassword) {
      this.email = rememberedEmail;
      this.password = rememberedPassword;
    }
  },
  methods: {
    login() {
      const userData = {
        email: this.email,
        password: this.password,
      };

      axios
        .post("http://localhost:8000/api/login", userData)
        .then((response) => {
          console.log(response.data);
          if (response.data.message == "Wrong credentials") {
            this.hasError = true;
            this.$router.push("/login");
            this.errormessage = "Invalid Email Or Password!!";
          } else {
            this.loginUser = response.data.user;
            // Save the token to vuex after successful login
            this.$store.commit("setUser", response.data.user);
            this.$store.commit("setToken", response.data.token);
            this.$store.commit("setRole", response.data.role);

            this.hasError = false;
            setAuthHeader(response.data.token);

            if (this.rememberMe) {
              VueCookies.set("rememberedEmail", this.email, "1d"); // Set cookie for 1 days
              VueCookies.set("rememberedPassword", this.password, "1d");
            }

            var routeName = response.data.role.toLowerCase();
            if (routeName === "admin") {
              // this.$router.push(`/student/dashboard`);
              this.$router.push({ name: "adminDashboard" });
            } else if (routeName === "") {
              this.$router.push({ name: "home" });

            } else {
              // Handle other roles or default route
              this.$router.push("/unauthorized");
            }
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<template>
  <section>
    <div class="w-50 m-auto text-center mt-3">
      <p v-if="errormessage" class="alert alert-secondary w-50 m-auto" role="alert">
        {{ errormessage }}
      </p>
    </div>
    <div class="backgroud relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-20 max-w-7xl">
      <div class="w-full max-w-md mx-auto md:max-w-sm md:px-0 md:w-96 sm:px-4">
        <div class="flex flex-col">
          <div>
            <h2 class="text-4xl text-black">Login</h2>
          </div>
        </div>
        <form @submit.prevent="login">
          <input value="https://jamstacker.studio/thankyou" type="hidden" name="_redirect" />
          <div class="mt-4 space-y-6">
            <div class="col-span-full">
              <label class="block mb-3 text-sm font-medium text-gray-600">
                email
              </label>
              <input type="email" placeholder="email" v-model="email"
                class="block w-full px-6 py-3 text-black bg-white border border-gray-200 rounded-full appearance-none placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" />
            </div>
            <div class="col-span-full">
              <label class="block mb-3 text-sm font-medium text-gray-600">
                password
              </label>
              <input type="password" v-model="password" placeholder="password"
                class="block w-full px-6 py-3 text-black bg-white border border-gray-200 rounded-full appearance-none placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" />
            </div>
            <label class="material-checkbox d-flex align-items-center text-dark fs-6 cursor-pointer">
              <input type="checkbox" v-model="rememberMe" />
              <span class="checkmark position-relative d-inline-block border border-1 border-primary rounded-2"></span>
              Remember Me
            </label>
            <div class="col-span-full">
              <button type="submit"
                class="items-center justify-center w-full px-6 py-2.5 text-center text-white duration-200 bg-black border-2 border-black rounded-full nline-flex hover:bg-transparent hover:border-black hover:text-black focus:outline-none focus-visible:outline-black text-sm focus-visible:ring-black">
                sign In
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<style lang="scss">
.background {
  background-image: url("../assets/Img/c1.jpg");
}
</style>
