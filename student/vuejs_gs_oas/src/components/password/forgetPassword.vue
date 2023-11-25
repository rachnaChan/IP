<script>
import axios from 'axios';
// import store from './store';
export default {
    data() {
        return {
            email: "",
        }
    },
    methods: {
        async forgotPassword() {
            try {
                const response = await axios.post('http://localhost:8000/api/forgot-password', {
                    email: this.email
                });

                // Set the email in the Vuex store
                this.$store.commit('setEmail', this.email);
                console.log("Stored Email in Vuex:", this.email);

                console.log(response);
                // Redirect to Reset Password page with email and token
                this.$router.push({ name: 'newPassword', params: { email: this.email, token: response.data.token } });
            } catch (error) {

                console.error(error.response.data);
            }
        }
    }
}
</script>

<template>
    <div class="forgetPass_Container">
  <div class="w-75 m-auto d-flex justify-content-around py-5">

    <div class="w-20 d-flex mt-4">
      <img src="../../assets/img/ITC_logo.png" alt="" class="img-fluid" style="width: 120px; height: 120px;">
      <img src="../../assets/img/GS_logo.png" alt="" class="img-fluid" style="width: 120px; height: 120px;">
    </div>

    <div class="forgetPass_textBox mt-3 mx-5 w-90">
      <h6 class="text-uppercase fs-4 fw-bold mt-5">graduate school of the institute of technology of cambodia</h6>
    </div>
  </div>

    <div class="w-50 m-auto text-center mt-5 py-4">
        <h6 class="text-uppercase fs-4">Request New Password</h6>
    </div>

    <form
        class="forgetPass_Form border border-top-0  align-items-center d-flex flex-column justify-content-center bg-white rounded-5 w-75 m-auto py-2 gap-3"
        @submit.prevent="forgotPassword">

        <div class="forgetPass_Input form-outline mb-2 w-75 m-auto d-flex position-relative flex-column">
            <label class="forgetPass_Label" for="email_field">Email</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                class="forgetPass_Icon position-absolute">
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                    d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5"></path>
                <path stroke-linejoin="round" stroke-width="1.5" stroke="#141B34"
                    d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z">
                </path>
            </svg>
            <input placeholder="name@mail.com" title="Inpit title" name="input-name" type="email"
                class="forgetPass_Field rounded-3 border-1 outline-none " v-model="email" id="email_field" required="">
        </div>


        <router-link v-bind:to="'/login'" class=" text-decoration-none w-75">
            <p>Remember Your Password?</p>
        </router-link>

        <button title="Reset Pass" type="submit"
            class="forgetPass_Btn m-auto outline-none text-white rounded-3 border-0 w-75 mb-4">
            <span class="fs-4">Send Email</span>
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
          <p class="text-box">Graduate School, A public higher education institution offering master & doctoral degrees in
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

.forgetPass_Container {
    width: 100%;
    height: 60px;
    background-color: #243673;
}

.forgetPass_Header {
    margin-left: 90%;
    word-wrap: break-word;
}


.forgetPass_textBox {
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

.forgetPass_Input {
    width: 100%;
    height: fit-content;
    gap: 5px;
}

.forgetPass_Icon {
    width: 35px;
    z-index: 99;
    left: 12px;
    bottom: 17px;
}

.forgetPass_Label {
    font-size: 1.2rem;
    color: #8B8E98;
    font-weight: 600;
}

.forgetPass_Field {
    width: auto;
    height: 60px;
    padding: 0 0 0 50px;
    outline: none;
    filter: drop-shadow(0px 1px 0px #efefef) drop-shadow(0px 1px 0.5px rgba(239, 239, 239, 0.5));
    transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
}

.forgetPass_Field:focus {
    border: 1px solid transparent;
    box-shadow: 0px 0px 0px 2px #242424;
    background-color: transparent;
}

.forgetPass_Btn {
    width: 120px;
    height: 60px;
    background: #243673;
    cursor: pointer;
}
</style>

