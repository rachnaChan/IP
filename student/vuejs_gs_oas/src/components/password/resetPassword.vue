<script>

import axios from 'axios';
export default {
  data() {
    return {
      newPassword: '',
      confirmPassword: '',
    };
  },
  created() {
    // Retrieve token from the URL
    this.token = this.$route.query.token;
    console.log("Token:", this.token);

    // Retrieve email from Vuex Use getters.email here
    this.email = this.$store.getters.email;
    console.log("Email:", this.email);
  },
  methods: {
    async resetPassword() {
      try {
        const response = await axios.post('http://localhost:8000/api/reset-password', {
          email: this.email,
          token: this.$route.query.token,
          password: this.newPassword,
          password_confirmation: this.confirmPassword
        });

        console.log(response);

        this.$router.push('/login');
      } catch (error) {

        console.error(error.response.data);
      }
    },
  },

}
</script>

<template>
  <div class="resetPass_Container bg-[#243673]">
    <div class="resetPass_textBox w-75 m-auto d-flex justify-content-around py-5">


      <div class="w-20 d-flex mt-4">
        <img src="../../assets/img/ITC_logo.png" alt="" class="img-fluid" style="width: 120px; height: 120px;">
        <img src="../../assets/img/GS_logo.png" alt="" class="img-fluid" style="width: 120px; height: 120px;">
      </div>

      <div class="resetPass_textBox mt-3 mx-5 w-90">
        <h6 class="text-uppercase fs-4 fw-bold mt-5">graduate school of the institute of technology of cambodia</h6>
      </div>
    </div>


    <div class="w-50 m-auto text-center mt-5 py-4">
      <h6 class="text-uppercase fs-4">Set New Password</h6>
    </div>

    <form
      class="resetPass_Form border border-top-0 align-items-center d-flex flex-column justify-content-center bg-white rounded-5 w-75 m-auto py-1 gap-2"
      @submit.prevent="resetPassword">


      <div class="resetPass_Input form-outline mb-2 w-75 m-auto d-flex position-relative flex-column">
        <label class="resetPass_Label" for="password_field">New Password</label>
        <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
          class="resetPass_Icon position-absolute">
          <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22">
          </path>
          <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
          <path fill="#141B34"
            d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z">
          </path>
        </svg>
        <input placeholder="password" title="Inpit title" name="input-name" type="password"
          class="resetPass_Field rounded-3 border-1 outline-none" v-model="newPassword" id="newPassword" required="">
      </div>

      <div class="resetPass_Input form-outline mb-2 w-75 m-auto d-flex position-relative flex-column">
        <label class="resetPass_Label" for="password_field">Confirm New Password</label>
        <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
          class="resetPass_Icon position-absolute">
          <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22">
          </path>
          <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
            d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
          <path fill="#141B34"
            d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z">
          </path>
        </svg>
        <input placeholder="confirm new password" title="Inpit title" name="input-name" type="password"
          class="resetPass_Field rounded-3 border-1 outline-none" v-model="confirmPassword" id="confirmPassword"
          required="">
      </div>


      <router-link v-bind:to="'/'"
        class="resetPass_Btn m-auto outline-none text-white rounded-3 border-0 w-75 mb-4 text-center">
        <button title="Sign In" type="submit"
          class="resetPass_Btn m-auto outline-none text-white rounded-3 border-0 w-75 mb-4">
          <span class="fs-4">Submit</span>
        </button>
      </router-link>



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

<style lang="scss" scoped >
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

body {
  font-family: inherit;
}

.resetPass_Container {
  width: 100%;
  height: 60px;
}

.resetPass_Header {
  margin-left: 90%;
  word-wrap: break-word;
}


.resetPass_textBox {
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



.resetPass_Input {
  width: 100%;
  height: fit-content;
  gap: 5px;
}

.resetPass_Icon {
  width: 35px;
  z-index: 99;
  left: 12px;
  bottom: 17px;
}

.resetPass_Label {
  font-size: 1.2rem;
  color: #8B8E98;
  font-weight: 600;
}

.resetPass_Field {
  width: auto;
  height: 60px;
  padding: 0 0 0 50px;
  outline: none;
  filter: drop-shadow(0px 1px 0px #efefef) drop-shadow(0px 1px 0.5px rgba(239, 239, 239, 0.5));
  transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
}

.resetPass_Field:focus {
  border: 1px solid transparent;
  box-shadow: 0px 0px 0px 2px #242424;
  background-color: transparent;
}

.resetPass_Btn {
  width: 120px;
  height: 60px;
  background: #243673;
  cursor: pointer;
}
</style>
