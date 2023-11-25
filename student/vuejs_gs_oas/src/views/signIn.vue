<script>
import axios from 'axios'
import VueCookies from 'vue-cookies'
import setAuthHeader from '../libs/apis/axiosConfig'

export default {
  data() {
    return {
      user: null,
      email: "",
      password: "",
      hasError: false,
      errormessage: '',
      rememberMe: false,
      loginUser: null,
    }
  },
  mounted() {
    const rememberedEmail = VueCookies.get('rememberedEmail');
    const rememberedPassword = VueCookies.get('rememberedPassword');

    if (rememberedEmail && rememberedPassword) {
      this.email = rememberedEmail;
      this.password = rememberedPassword;
    }
  },
  methods: {
    login() {
      const userData = {
        "email": this.email,
        "password": this.password,
      };

      axios.post('http://localhost:8000/api/login', userData)
        .then(response => {
          console.log(response.data);
          if (response.data.message == "Wrong credentials") {
            this.hasError = true;
            this.$router.push('/login');
            this.errormessage = 'Invalid Email Or Password!!';
          } else {
            this.loginUser = response.data.user;
            // Save the token to vuex after successful login
            this.$store.commit('setUser', response.data.user)
            this.$store.commit('setToken', response.data.token)
            this.$store.commit('setRole', response.data.role)

            this.hasError = false;
            setAuthHeader(response.data.token);

            if (this.rememberMe) {
              VueCookies.set('rememberedEmail', this.email, '1d'); // Set cookie for 1 days
              VueCookies.set('rememberedPassword', this.password, '1d');
            }

            var routeName = response.data.role.toLowerCase();
            if (routeName === 'student') {
              // this.$router.push(`/student/dashboard`);
              this.$router.push({ name: 'studentDashboard', params: { userId: response.data.user.student_id } }); // Name of the route in the router configuration

            } else if (routeName === 'head') {
              this.$router.push('/head/dashboard');
              // this.$router.push({ name: 'headDashboard', params: { userId: response.data.user.id } }); // Name of the route for the head of program

            } else if (routeName === 'admin') {
              this.$router.push({ name: 'adminDashboard', params: { userId: response.data.user.id } }); // Name of the route for the head of program

            } else {
              // Handle other roles or default route
              this.$router.push('/unauthorized');
            }
          }
        })
        .catch(error => {

          console.log(error)
        });
    },
  }
}
</script>


<template>
  <div class="signIn_Container bg-[#243673]">

    <div class="signIn_textBox w-75 m-auto d-flex justify-content-around py-5">

      <div class="w-20 d-flex mt-4">
        <img src="../assets/img/ITC_logo.png" alt="" class="img-fluid" style="width: 120px; height: 120px;">
        <img src="../assets/img/GS_logo.png" alt="" class="img-fluid" style="width: 120px; height: 120px;">
      </div>

      <div class="signIn_textBox mt-3 mx-5 w-90">
        <h6 class="text-uppercase fs-4 fw-bold mt-5">graduate school of the institute of technology of cambodia</h6>
      </div>
    </div>

    <div class="w-50 m-auto text-center ">
      <h6 class="text-uppercase fs-4">Login Form</h6>
    </div>

    <div class="w-50 m-auto text-center mt-3 ">
      <p v-if="errormessage" class="alert alert-secondary w-50 m-auto " role="alert">{{ errormessage }}</p>
    </div>


    <form
      class="signIn_Form border border-top-0 align-items-center d-flex flex-column justify-content-center bg-white rounded-5 w-75 m-auto py-1 gap-2"
      @submit.prevent="login">

      <div class="signIn_Input form-outline mb-1 w-75 m-auto d-flex position-relative flex-column">
        <label class="signIn_Label" for="email_field">Email</label>
        <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
          class="signIn_Icon position-absolute">
          <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5"></path>
          <path stroke-linejoin="round" stroke-width="1.5" stroke="#141B34"
            d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z">
          </path>
        </svg>
        <input placeholder="name@mail.com" title="Input title" name="input-name" type="email"
          class="signIn_Field rounded-3 border-1 outline-none " v-model="email" id="email_field" required="">
      </div>

      <div class="signIn_Input form-outline mb-1 w-75 m-auto d-flex position-relative flex-column">
        <label class="signIn_Label" for="password_field">Password</label>
        <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
          class="signIn_Icon position-absolute">
          <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22">
          </path>
          <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
          <path fill="#141B34"
            d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z">
          </path>
        </svg>
        <input placeholder="Password" title="Input title" name="input-password" type="password"
          class="signIn_Field rounded-3 border-1 outline-none" v-model="password" id="password_field" required="">
      </div>

      <div class="w-75 d-flex justify-content-between m-auto">

        <label class="material-checkbox d-flex align-items-center text-dark fs-6 cursor-pointer">
          <input type="checkbox" v-model="rememberMe">
          <span class="checkmark position-relative d-inline-block border border-1 border-primary rounded-2"></span>
          Remember Me
        </label>

        <router-link v-bind:to="'/forgetPass'" class="mt-3 text-decoration-none">
          <p class="m-auto text-center mb-3">Forgot your password?</p>
        </router-link>



      </div>

      <button title="Sign In" type="submit"
        class="signIn_Btn m-auto outline-none text-white rounded-3 border-0 w-50 mb-4 bg-[#243673]">
        <span class="fs-4">Sign In</span>
      </button>

    </form>

    <div style="margin-top: 13%;">
      <div class="footers mt-5 m-auto justify-content-around d-flex position-relative">
        <div class=" m-auto p-4 mx-5">

          <div class="text-white">
            <h5>ITC Campus</h5>
            <hr class="w-25 ">
            <p class="text-box">Office of the Registrar, Institute of Technology of Cambodia, Russian Confederation
              Boulevard, P.O. Box 86,
              Phnom Penh, Cambodia</p>
          </div>

          <div class="text-box text-white d-flex  ">
            <!-- routerlink -->
            <p>Contact &emsp;|&emsp;</p>
            <i class='bx bxl-facebook-circle mt-1'>&emsp;</i>
            <!-- routerlink -->
            <p>info@itc.edu.kh &emsp;|&emsp;</p>
            <!-- routerlink -->
            <p>023 880 370</p>
          </div>

        </div>

        <div class=" m-auto p-4 ">

          <div class="text-white">
            <h5>Graduate School</h5>
            <hr class="w-25 ">
            <p class="text-box">Graduate School, A public higher education institution offering master & doctoral degrees
              in
              field of
              engineering, located in ITC Campus</p>
          </div>

          <div class="text-white d-flex text-box m-auto">
            <!-- routerlink -->
            <p>Contact &emsp;|&emsp;</p>
            <i class='bx bxl-facebook-circle mt-1'>&emsp;</i>
            <!-- routerlink -->
            <p>info@itc.edu.kh &emsp;|&emsp;</p>
            <!-- routerlink -->
            <p>023 880 370</p>
          </div>

        </div>


      </div>
    </div>
  </div>
</template>

<style lang="scss" >
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

body {
  font-family: inherit;
}

.signIn_Container {
  width: 100%;
  height: 60px;
  background-color: #243673;
}

.signIn_Header {
  margin-left: 90%;
  word-wrap: break-word;
}



.signIn_textBox {
  width: 70%;
  overflow: hidden;
  word-wrap: break-word;

  @media screen and (max-width: 768px) {
    font-size: 12px;
  }

  @media screen and (max-width: 480px) {
    font-size: 12px;
  }
}



.signIn_Input {
  width: 100%;
  height: fit-content;
  gap: 5px;
}

.signIn_Icon {
  width: 35px;
  z-index: 99;
  left: 12px;
  bottom: 17px;
}

.signIn_Label {
  font-size: 1.2rem;
  color: #8B8E98;
  font-weight: 600;
}

.signIn_Field {
  width: auto;
  height: 60px;
  padding: 0 0 0 50px;
  outline: none;
  filter: drop-shadow(0px 1px 0px #efefef) drop-shadow(0px 1px 0.5px rgba(239, 239, 239, 0.5));
  transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
}

.signIn_Field:focus {
  border: 1px solid transparent;
  box-shadow: 0px 0px 0px 2px #242424;
  background-color: transparent;
}

.signIn_Btn {
  width: 120px;
  height: 60px;
  cursor: pointer;
}


.material-checkbox {
  cursor: pointer;
}

.material-checkbox input[type="checkbox"] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.checkmark {

  width: 20px;
  height: 20px;
  margin-right: 12px;
  transition: all 0.3s;
}

.material-checkbox input[type="checkbox"]:checked~.checkmark {
  background-color: black;
  border-color: gray;
}

.material-checkbox input[type="checkbox"]:checked~.checkmark:after {
  content: "";
  position: absolute;
  top: 2px;
  left: 6px;
  width: 4px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.material-checkbox input[type="checkbox"]:focus~.checkmark {
  box-shadow: 0 0 0 2px #dfec5065;
}

.material-checkbox:hover input[type="checkbox"]~.checkmark {
  border-color: #C3CF34;
}

.material-checkbox input[type="checkbox"]:disabled~.checkmark {
  opacity: 0.5;
  cursor: not-allowed;
}

.material-checkbox input[type="checkbox"]:disabled~.checkmark:hover {
  border-color: #4d4d4d;
}


.footers {
  width: 100%;
  height: 240px;
  background-color: #243673;

  @media (min-width: 1236px) {
    margin: auto;
  }
}

.text-box {
  width: 90%;
  height: 75px;
  // overflow: hidden;
  word-wrap: break-word;
  font-size: 14px;

  @media screen and (max-width: 768px) {
    font-size: 12px;
  }

  @media screen and (max-width: 480px) {
    font-size: 12px;
  }
}
</style>


