

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: null,
      programs: null,
      courses: [],

      old_password: "",
      new_password: "",
      new_password_confirmation: "",
      message: '',

      currentDateTime: null,
    };
  },
  mounted() {
    this.fetchLoggedInUser();

    setInterval(() => {
      this.currentDateTime = new Date();
    }, 1000);
  },
  methods: {

    async fetchLoggedInUser() {
      try {
        const response = await axios.get('http://localhost:8000/api/head/info'); // Change this URL if needed
        console.log(response.data);
        this.user = response.data;

      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },

    getUserImageURL(user) {
      if (user.image) {
        const imageUrl = `http://localhost:8000/storage/${user.image}`;
        return imageUrl;
      } else {
        const imageAuto =
          'https://cdn-icons-png.flaticon.com/512/219/219970.png';
        return imageAuto;
      }
    },

    goToEditProfile() {
      this.$router.push('/head/editProfile');
    },

    logout() {
      axios.post('http://localhost:8000/api/logout')
        .then(response => {
          console.log(response.data);
          this.$store.commit('setUser', null)
          this.$store.commit('setToken', null)
          this.$store.commit('setRole', null)
          this.$router.push('/login');
        })
        .catch(error => {
          console.log(error)
        });
    },


    async changePassword() {
      const requestData = {
        old_password: this.old_password,
        new_password: this.new_password,
        new_password_confirmation: this.new_password_confirmation,
      };
      console.log(requestData);

      try {
        const response = await axios.post('http://localhost:8000/api/head/change-password', requestData);

        if (response.data.message === 'Password changed successfully') {
          this.message = 'Password changed successfully!! ';
          this.old_password = '';
          this.new_password = '';
          this.new_password_confirmation = '';
          console.log(response.data.message);
        } else {
          this.message = 'Password not Match!!';
          console.log(response.data.message);
        }
      } catch (error) {
        console.error(error);
        this.message = 'An error occurred while changing the password.';
      }
    },


  },
};
</script>

<template>
  <div class="h-100" v-if="user">

    <div class="dashboard_ContainerFluid">
      <div class="row flex-nowrap">
        <div class=" col-md-3 col-xl-2 px-sm-2 min-vh-100 " style=" background-color: #233673;">
          <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-23text-white">

            <router-link to="/head/dashboard" class="text-decoration-none">
              <div class="d-flex align-items-center pb-3 mt-2 mb-md-0 me-md-auto text-white text-decoration-none">
                <div class="d-flex text-center align-items-center m-auto justify-content-center mx-5">
                  <img src="../../../assets/img/GS_logo.png" alt="" class="img-fluid " style="width:6rem;">
                  <img src="../../../assets/img/ITC_logo.png" alt="" class="img-fluid" style="width:6rem;">
                </div>
              </div>
            </router-link>


            <!-- <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

              <li class="nav-item ">
                <router-link :to="{ name: 'studentCourse', params: { userId: user.student_id } }"
                  class="text-decoration-none">
                  <a href="#" class="nav-link align-middle px-0  mx-4">
                    <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                    <span class="ms-1 d-none d-sm-inline text-white fs-5">Course</span>
                  </a>
                </router-link>
              </li>

              <li class="nav-item ">
                <router-link :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                  class="text-decoration-none">
                  <a href="#" class="nav-link align-middle px-0  mx-4">
                    <i class='mx-2 bx bx-book-open fs-4' style='color:white'></i>
                    <span class="ms-1 d-none d-sm-inline text-white fs-5">My
                      Course</span>
                  </a>
                </router-link>
              </li>


              <li class="nav-item ">
                <router-link :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                  class="text-decoration-none">
                  <a href="#" class="nav-link px-0 align-middle  mx-4">
                    <i class='mx-2 bx bxs-file-doc fs-5' style='color:white'></i>
                    <span class="ms-1 d-none d-sm-inline text-white fs-5">Document</span></a>
                </router-link>
              </li>

              <li class="nav-item">
                <p class="lead mt-5 text-white mx-4 fs-6  text">{{ currentDateTime }}</p>

              </li>

              <li class="nav-item mx-4 mt-5">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                  <li class="nav-item mx-4">

                    <a href="#" class="nav-link align-middle px-0" @click="logout">
                      <i class='mx-2 fs-5 bx bx-exit text-white'></i>
                      <span class="ms-1 d-none d-sm-inline text-white fs-5">Logout</span>
                    </a>

                  </li>
                </ul>
              </li>

            </ul> -->
            <hr>
          </div>
        </div>

        <div class="col custom-scrollbar justify-content-center overflow-scroll flex-nowrap">
          <div class="position-fixed w-100 h-16 d-flex justify-content-between bg-white">

            <div class="w-75">
              <p class="lead text-muted mx-5 mt-1 fs-1  ">Change Password</p>

            </div>

            <div class="d-flex w-25 text-right m-auto mx-5 ">

              <i class='bx bx-bell fs-1 mt-3' style=" color: #233673;"></i>

              <div class="dropdown mt-2  ">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <img :src="getUserImageURL(user)" ui:alt="user.name" class="rounded-circle img-fluid mx-5"
                    style="width: 50px; height: 50px;">

                </a>
                <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1">
                  <router-link :to="{ name: 'headProfile', params: { userId: user.id } }" class="text-decoration-none">
                    <li><a class="dropdown-item " href="#">Profile</a></li>
                    <li class="mt-1">
                      <a href="#" class="dropdown-item " @click="logout">
                        <span class="ms-1 d-none d-sm-inline">Logout</span>
                      </a>
                    </li>
                  </router-link>

                </ul>
              </div>
            </div>


          </div>

          <div class="row justify-content-around mt-5 py-5">

            <div class="left col-md-3 border border-dark mx-2 mt-5">
              <div class=" align-items-center text-center m-auto justify-content-center">


                <div>
                  <img class="rounded-circle mt-5 align-items-center text-center justify-content-center m-auto"
                    style="width: 240px; height: 240px;" :src="getUserImageURL(user)" :alt="user.name">

                </div>


                <div class="d-flex align-items-center text-center justify-content-center m-auto">
                  <p class="mt-2">{{ user.first_name }} </p>
                  <p class="mt-2 mx-2">{{ user.last_name }}</p>
                </div>

                <div class=" py-4">
                  <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                    <li class="nav-item mx-4">
                      <div class="text-decoration-none " @click="goToEditProfile">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='mx-2 bx bxs-user fs-5' style='color:#243673'></i>
                          <span class="ms-1 d-none d-sm-inline text-dark fs-5">Edit
                            Profile</span>
                        </a>
                      </div>
                      <hr class="mt-0 w-100">
                    </li>

                    <li class="nav-item mx-4">
                      <router-link :to="{ name: 'headAddProgram', params: { userId: user.id } }"
                        class="text-decoration-none">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:#243673'></i>
                          <span class="ms-1 d-none d-sm-inline text-dark fs-5">Add Program</span>
                        </a>
                      </router-link>
                      <hr class="mt-0 w-100">
                    </li>

                    <li class="nav-item mx-4">
                      <router-link :to="{ name: 'headAddCourse', params: { userId: user.id } }"
                        class="text-decoration-none">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='mx-2 bx bx-book-open fs-5' style='color:#243673'></i>
                          <span class="ms-1 d-none d-sm-inline text-dark fs-5">Add
                            Course</span>
                        </a>
                      </router-link>
                      <hr class="mt-0 w-100">
                    </li>

                    <li class="nav-item mx-4">
                      <router-link :to="{ name: 'studentChangePass', params: { userId: user.id } }"
                        class="text-decoration-none">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='bx bx-message-dots mx-2 fs-5' style='color:#243673'></i>
                          <span class="ms-1 d-none d-sm-inline text-dark fs-5">Change
                            Password</span>
                        </a>
                      </router-link>
                      <hr class="mt-0 w-100">
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-md-8 border border-dark mt-5">
              <div class="p-3 py-5 text-center">
                <div class="d-flex align-items-center mb-3">
                  <i class='bx bx-edit' style='color:#243673'></i>
                  <h4 class="text-right mx-3 fs-2 mt-1">Update Password</h4>
                </div>


                <form
                  class="signIn_Form border border-top-0  align-items-center d-flex flex-column justify-content-center bg-white rounded-5 w-75 m-auto py-1 gap-2"
                  @submit.prevent="changePassword">

                  <div v-if="message" class="text-primary">{{ message }} &#128142;</div>


                  <div class="signIn_Input form-outline mb-2 w-75 m-auto d-flex position-relative flex-column">
                    <label class="text-muted" for="password_field">Current Password</label>
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
                    <input placeholder="old" title="Inpit title" name="input-name" type="password" id="old_password"
                      class="signIn_Field rounded-3 border-1 outline-none" v-model="old_password" required="">
                  </div>

                  <div class="signIn_Input form-outline mb-2 w-75 m-auto d-flex position-relative flex-column">
                    <label class="text-muted" for="password_field">New Password</label>
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
                    <input placeholder="new" title="Inpit title" name="input-name" type="password"
                      class="signIn_Field rounded-3 border-1 outline-none" v-model="new_password" required=""
                      id="new_password">
                  </div>

                  <div class="signIn_Input form-outline mb-2 w-75 m-auto d-flex position-relative flex-column">
                    <label class="text-muted" for="password_field">Confirm New Password</label>
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
                    <input placeholder="confirm new" title="Inpit title" name="input-name" type="password"
                      id="new_password_confirmation" class="signIn_Field rounded-3 border-1 outline-none"
                      v-model="new_password_confirmation" required="">
                  </div>


                  <button type="submit"
                    class="buttons fs-5 fw-bold text-muted bg-secondary-dark border border-1 rounded-4 p-3 mt-4 ml-80 ">
                    Update
                  </button>


                </form>

              </div>
            </div>

          </div>


        </div>

      </div>
    </div>
  </div>
</template>

<style lang="scss" >
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

p {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.dashboard_ContainerFluid {
  height: 370px;

}

.dashboard_Container {
  width: 100%;
  height: 60px;
  background-color: #243673;
}

.dashboard_Header {
  width: 200px;
}

.dashboard_textBox {
  width: 75%;
  overflow: hidden;
  word-wrap: break-word;
  font-size: 16px;

  @media screen and (max-width: 768px) {
    font-size: 12px;
  }

  @media screen and (max-width: 480px) {
    font-size: 12px;
  }
}

.dashboard_InputSearch {

  height: 30px;
  width: 50px;
  padding: 10px;
  transition: .5s ease-in-out;
  box-shadow: 0px 0px 3px #f3f3f3;
  padding-right: 40px;


}

.dashboard_IconInput {
  right: 0px;
  cursor: pointer;
  width: 50px;
  height: 30px;
  pointer-events: painted;
  transition: .2s linear;
}

.dashboard_IconInput:focus~.dashboard_InputSearch,
.dashboard_InputSearch:focus {
  box-shadow: none;
  width: 250px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom: 3px solid #243673;
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}



@media screen and (max-width: 1236px) {

  .left,
  .right {
    width: 100%;
    /* The width is 100%, when the viewport is 800px or smaller */
  }
}

.custom-scrollbar {
  width: 100%;
  height: 700px;
  overflow: scroll;
  word-wrap: break-word;
  font-size: 18px;

  @media screen and (max-width: 768px) {
    font-size: 14px;
  }

  @media screen and (max-width: 480px) {
    font-size: 14px;
  }
}

/* width */
::-webkit-scrollbar {
  width: 10px;
}



/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #ffffff;
}

/*Button*/
.card-button {
  width: 260px;
  padding: .3rem;
  cursor: pointer;
  height: 50px;
  transition: .3s ease-in-out;
}

.card-button:hover {
  border: 1px solid #000000;
  background-color: gray;
}
</style>

