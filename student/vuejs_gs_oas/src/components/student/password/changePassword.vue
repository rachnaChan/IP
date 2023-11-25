
<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: null,
      programs: null,
      courses: [],
      student_details: null,
      activeNavItem: null,


      old_password: "",
      new_password: "",
      new_password_confirmation: "",
      message: '',

      passwordHidden: false,
      currentDateTime: null,
    };
  },

  mounted() {
    this.fetchInfoUser();
    this.fetchLoggedInUser();

    setInterval(() => {
      this.currentDateTime = new Date();
    }, 1000);
  },
  methods: {

    async fetchLoggedInUser() {
      try {
        const response = await axios.get('http://localhost:8000/api/student/info'); // Change this URL if needed
        // console.log(response.data);
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
      this.$router.push({ name: 'studentEditProfile', params: { userId: this.user.student_id } });
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

    fetchInfoUser() {
      const userId = this.$route.params.userId;
      console.log('User ID:', userId); // Check the student_id

      axios.get(`http://localhost:8000/api/student/info/${userId}`)
        .then(response3 => {
          this.user = response3.data[0];
          this.programs = response3.data[0];
          this.courses = response3.data[0];
          this.student_details = response3.data[0];
          // console.log(response3.data);
        })
        .catch(error => {
          console.error('Error fetching courses:', error);
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
        const response = await axios.post('http://localhost:8000/api/student/change-password', requestData);

        if (response.data.message === 'Password changed successfully') {
          this.message = 'Password changed successfully!! ';
          this.old_password = '';
          this.new_password = '';
          this.new_password_confirmation = '';
          console.log(response.data.message);

        } else if (this.new_password !== this.new_password_confirmation) {
          this.message = 'New passwords do not match';
          return; // Exit the function early
        } else if (this.new_password.length && this.new_password_confirmation.length < 8) {
          this.message = 'New password must be at least 8 characters long';
          return;
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
  <div v-if="user">

    <div class="dashboard_ContainerFluid">
      <div class="row flex-nowrap">
        <div class="position-fixed col-lg-2 col-xl-2 bg-[#243673]" style="height: 700px; z-index: 3;">
          <div class="d-flex flex-column align-items-center align-items-sm-start px-3 text-white">

            <router-link :to="{ name: 'studentDashboard', params: { userId: user.student_id } }"
              class="text-decoration-none">
              <div class="d-flex align-items-center pb-3 mt-2 mb-md-0 me-md-auto text-white text-decoration-none">
                <div class="d-flex text-center align-items-center m-auto justify-content-center mx-5">
                  <img src="../../../assets/img/GS_logo.png" alt="" class="img-fluid " style="width:6rem;">
                  <img src="../../../assets/img/ITC_logo.png" alt="" class="img-fluid" style="width:6rem;">
                </div>
              </div>
            </router-link>


            <div class=" align-items-center ">

              <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'programs' }]">
                <router-link :to="{ name: 'studentCourse', params: { userId: user.student_id } }"
                  class="text-decoration-none">
                  <a href="#" class="nav-link align-middle px-0  mx-4">
                    <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5 text-white'></i>
                    <span class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Program</span>
                  </a>
                </router-link>
              </div>


              <div class="nav-item mx-2">
                <a href="#" class="nav-link align-middle px-0  mx-4">
                  <i class='mx-2 bx bx-book-open fs-5 text-white'></i>
                  <span class="lead ms-1 d-none d-sm-inline text-white fs-5">My
                    Courses</span>
                </a>

                <div class="align-items-center m-auto mx-5 py-2 w-75">

                  <li>
                    <router-link :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                      class="lead fs-6 text-decoration-none text-white"
                      :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'approved' }]">
                      Approved
                    </router-link>

                  </li>

                  <li>
                    <router-link
                      :to="{ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } }"
                      class="lead fs-6 text-decoration-none text-white"
                      :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'enroll' }]">
                      Enroll
                    </router-link>

                  </li>

                  <li>
                    <router-link :to="{ name: 'studentDraftCourse', params: { userId: user.student_id } }"
                      class="lead fs-6 text-decoration-none text-white"
                      :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'requested' }]">
                      Requested
                    </router-link>
                  </li>
                </div>
              </div>

              <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'importantDate' }]">
                <router-link :to="{ name: 'studentImportantDate', params: { userId: user.student_id } }"
                  class="text-decoration-none">
                  <a href="#" class="nav-link align-middle px-0  mx-4">
                    <i class='mx-2 bx bxs-calendar-event bx-rotate-180 fs-5 text-white'></i>

                    <span class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Events</span>
                  </a>
                </router-link>
              </div>



              <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'documents' }]">
                <router-link :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                  class="text-decoration-none">
                  <a href="#" class="nav-link px-0 align-middle  mx-4">
                    <i class='mx-2 bx bxs-file-doc fs-5 text-white'></i>
                    <span class="lead ms-1 d-none d-sm-inline text-white fs-5">Documents</span></a>
                </router-link>
              </div>

              <div class="nav-item">
                <p class="lead mt-5 text-white fs-6  text">{{ currentDateTime }}</p>

              </div>

            </div>

            <hr>
          </div>
        </div>

        <div class="col custom-scrollbar justify-content-center overflow-scroll flex-nowrap"
          style="height: 700px; margin-left: 15%;">
          <div class="position-fixed h-18 d-flex justify-content-between bg-white"
            style="z-index: 2; width: 80%; margin-left: 2%;">

            <div class="w-75">
              <p class="lead text-muted mx-5 mt-1 fs-2  ">Profile's Info: <span class="text-[#243673]"> Update
                  Password</span> </p>
              <li class="lead mx-5 fs-6 fw-bold">
                <span @click="$router.push({ name: 'studentDashboard' })" class="lead  fs-6 fw-bold cursor-pointer">
                  Dashboard >
                </span>


                <span @click="$router.push({ name: 'studentProfile', params: { userId: user.student_id } })"
                  class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                  Profile
                </span>
                > Update password
              </li>

            </div>

            <div class="d-flex bg-white ">
              <div class="dropdown mt-3 " style="margin-left: 15%;">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <img :src="getUserImageURL(user)" ui:alt="user.name" class="rounded-circle img-fluid mx-5"
                    style="width: 50px; height: 50px;">

                </a>
                <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1">
                  <router-link :to="{ name: 'studentProfile', params: { userId: user.student_id } }"
                    class="text-decoration-none">
                    <li><a class="dropdown-item " href="#">Profile</a></li>
                  </router-link>
                  <li class="mt-1">
                    <a href="#" class="dropdown-item " @click="logout">
                      <span class="ms-1 d-none d-sm-inline">Logout</span>
                    </a>
                  </li>

                </ul>
              </div>

              <div>
                <i class='bx bx-bell fs-1 mt-3 mx-4  text-[#233673]'></i>
                <div class=" dashboard_textBox mt-3 ">
                  <button @click="$router.push({ name: 'studentProfile', params: { userId: user.student_id } })"
                    class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                    Back

                  </button>
                </div>
              </div>
            </div>


          </div>

          <div class="py-4 mt-5"></div>

          <div class="row justify-content-around mt-4 py-2" style="margin-left: 2%;">

            <div class="left col-md-3 border-2 border-[#243673] rounded-3  mx-2 " style="height: 570px;">
              <div class=" align-items-center text-center m-auto justify-content-center custom-scrollbar"
                style="height: 560px; ">

                <div>
                  <img class="rounded-circle mt-4 align-items-center text-center justify-content-center m-auto"
                    style="width: 230px; height: 230px;" :src="getUserImageURL(user)" :alt="user.name">

                </div>


                <div class="d-flex align-items-center text-center justify-content-center m-auto">
                  <p class="lead mt-2">{{ user.first_name }} </p>
                  <p class="lead mt-2 mx-2">{{ user.last_name }}</p>
                </div>

                <div class="">
                  <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                    <li :class="['nav-item', 'type', 'mx-4', 'btn', { 'active': activeNavItem === 'profile' }]">
                      <div class="text-decoration-none " @click="goToEditProfile">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='lead mx-2 bx bxs-user fs-6' style='color:#243673'></i>
                          <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">Edit
                            Profile</span>
                        </a>
                      </div>
                      <hr class="mt-0 w-100">
                    </li>

                    <li :class="['nav-item', 'type', 'mx-4', 'btn', { 'active': activeNavItem === 'documents' }]">
                      <router-link :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                        class="text-decoration-none">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='lead mx-2 bx bxs-dashboard bx-rotate-180 fs-6' style='color:#243673'></i>
                          <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">Edit
                            Document</span>
                        </a>
                      </router-link>
                      <hr class="mt-0 w-100">
                    </li>

                    <li :class="['nav-item', 'type', 'mx-4', 'btn', { 'active': activeNavItem === 'courses' }]">
                      <router-link :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                        class="text-decoration-none">
                        <a href="#" class="nav-link align-middle px-0">
                          <i class='lead mx-2 bx bx-book-open fs-6' style='color:#243673'></i>
                          <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">My
                            Course</span>
                        </a>
                      </router-link>
                      <hr class="mt-0 w-100">
                    </li>
                    <li :class="['nav-item', 'type', 'mx-4', 'btn', { 'active': activeNavItem === 'password' }]">
                      <router-link :to="{ name: 'studentChangePass', params: { userId: user.id } }"
                        class="text-decoration-none">
                        <a href="#" class="nav-link align-middle px-0 ">
                          <i class='lead bx bx-message-dots mx-2 fs-6' style='color:#243673'></i>
                          <span class="lead fw-bold ms-1 d-none d-sm-inline text-[#243673] fs-6">Change
                            Password</span>
                        </a>
                      </router-link>
                      <hr class="mt-0 w-100">
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="right col-md-8 border-2 border-[#243673] border-dashed mx-2 rounded-3" style="height: 570px;">
              <div class="p-3 py-2 text-center custom-scrollbar" style="height: 560px;">
                <div class="d-flex align-items-center mb-3">
                  <i class='bx bx-edit fs-1' style='color:#243673'></i>
                  <h4 class="text-right mx-3 fs-2 mt-1 lead fw-bold">Update Password</h4>
                </div>


                <form v-if="!passwordHidden"
                  class="signIn_Form border shadow border-top-0  align-items-center d-flex flex-column justify-content-center bg-white rounded-5 w-75 m-auto py-1 gap-2"
                  @submit.prevent="changePassword">
                  <!-- 
                  <div v-if="message" class="text-primary">{{ message }} &#128142;</div> -->

                  <div class="signIn_Input lead form-outline mb-2 w-75 m-auto d-flex position-relative flex-column"
                    style="z-index: 1;">
                    <label class="text-[#243673] lead fw-bold" for="password_field">Current Password</label>
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

                    <!-- <div class="signIn_Icon position-absolute fa fa-eye-slash" style="margin-left:85%;" @click="hidePassword"></div> -->


                    <input placeholder="old password" title="Inpit title" name="input-name" type="password"
                      id="old_password" class="signIn_Field rounded-3 border-1 outline-none" v-model="old_password"
                      required="">
                  </div>

                  <div class="signIn_Input lead form-outline mb-2 w-75 m-auto d-flex position-relative flex-column"
                    style="z-index: 1;">
                    <label class="text-[#243673] fw-bold lead" for="password_field">New Password</label>
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

                    <!-- <div class="signIn_Icon position-absolute fa fa-eye-slash" style="margin-left:85%;" @click="hidePassword"></div> -->

                    <input placeholder="new passaword" title="Inpit title" name="input-name" type="password"
                      class="signIn_Field rounded-3 border-1 outline-none" v-model="new_password" required=""
                      id="new_password">
                  </div>

                  <div class="signIn_Input lead form-outline mb-2 w-75 m-auto d-flex position-relative flex-column"
                    style="z-index: 1;">
                    <label class="text-[#243673] lead fw-bold" for="password_field">Confirm New Password</label>
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

                    <!-- <div class="signIn_Icon position-absolute fa fa-eye-slash" style="margin-left:85%;" @click="hidePassword"></div> -->

                    <input placeholder="confirm new password" title="Inpit title" name="input-name" type="password"
                      id="new_password_confirmation" class="signIn_Field rounded-3 border-1 outline-none"
                      v-model="new_password_confirmation" required="">
                  </div>


                  <router-link :to="{ name: 'forgetPass' }" class="text-decoration-none text-right m-auto">
                    <p class="m-auto text-right mb-3 ">Forgot your password?</p>

                  </router-link>

                  <div class="w-75 mb-5 mt-2" style="margin-left: 50%;">
                    <button type="submit" data-bs-target="#updatePassword" data-bs-toggle="modal"
                      class="bg-[#243673] positon-relative fs-5 rounded-2 border-1 h-12 w-25 text-white fw-bold">Update</button>
                  </div>

                </form>


                <div class="modal fade" id="updatePassword" tabindex="-2" aria-labelledby="updatePasswordLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header ">
                        <h1 class="modal-title lead text-center fs-3 m-auto text-muted " id="staticBackdropLabel">Change
                          Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div v-if="message" class="modal-body lead m-auto text-center fs-6 ">
                        {{ message }} &#128142;

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success lead" data-bs-dismiss="modal">Got
                          it!!</button>
                      </div>
                    </div>
                  </div>
                </div>

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

.custom-scrollbar {
  width: 100%;
  height: 900px;
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
</style>

