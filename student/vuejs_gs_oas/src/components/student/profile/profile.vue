
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            programs: null,
            courses: [],
            student_details: null,
            currentDateTime: null,
            activeNavItem: null,

        };
    },

    mounted() {
        this.fetchInfoUser();
        this.fetchLoggedInUser();
        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000)
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
                    this.programs = response3.data[0];
                    this.courses = response3.data[0];
                    this.student_details = response3.data[0];
                    // console.log(response3.data);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });


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
                            <div
                                class="d-flex align-items-center pb-3 mt-2 mb-md-0 me-md-auto text-white text-decoration-none">
                                <div class="d-flex text-center align-items-center m-auto justify-content-center mx-5">
                                    <img src="../../../assets/img/GS_logo.png" alt="" class="img-fluid "
                                        style="width:6rem;">
                                    <img src="../../../assets/img/ITC_logo.png" alt="" class="img-fluid"
                                        style="width:6rem;">
                                </div>
                            </div>
                        </router-link>


                        <div class=" align-items-center ">

                            <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'programs' }]">
                                <router-link :to="{ name: 'studentCourse', params: { userId: user.student_id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5 text-white'></i>
                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Program</span>
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
                                        <router-link
                                            :to="{ name: 'studentDraftCourse', params: { userId: user.student_id } }"
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

                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Events</span>
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
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Profile's Info </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                                    Dashboard
                                </span> > Profile
                            </li>


                        </div>

                        <div class="d-flex bg-white ">
                            <div class="dropdown mt-3 " style="margin-left: 15%;">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="getUserImageURL(user)" ui:alt="user.name"
                                        class="rounded-circle img-fluid mx-5" style="width: 50px; height: 50px;">

                                </a>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                    aria-labelledby="dropdownUser1">
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
                                    <button @click="$router.push({ name: 'studentDashboard' })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 py-4"></div>

                    <div class="row justify-content-around mt-4 py-2" style="margin-left: 2%;">

                        <div class="left col-md-3 border-2 border-[#243673] rounded-3 border-dashed mx-2 "
                            style="height: 570px;">
                            <div class=" align-items-center text-center m-auto justify-content-center custom-scrollbar"
                                style="height: 560px;">

                                <div>
                                    <img class="rounded-circle mt-4 align-items-center text-center justify-content-center m-auto"
                                        style="width: 230px; height: 230px;" :src="getUserImageURL(user)" :alt="user.name">

                                </div>


                                <div class="d-flex align-items-center text-center justify-content-center m-auto">
                                    <p class="lead mt-2">{{ user.first_name }} </p>
                                    <p class="lead mt-2 mx-2">{{ user.last_name }}</p>
                                </div>

                                <div class="">
                                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                                        id="menu">

                                        <li
                                            :class="['nav-item', 'type', 'mx-4', 'btn', { 'active': activeNavItem === 'documents' }]">
                                            <div class="text-decoration-none " @click="goToEditProfile">
                                                <a href="#" class="nav-link align-middle px-0">
                                                    <i class='lead mx-2 bx bxs-user fs-6' style='color:#243673'></i>
                                                    <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">Edit
                                                        Profile</span>
                                                </a>
                                            </div>
                                            <hr class="mt-0 w-100">
                                        </li>

                                        <li
                                            :class="['nav-item', 'mx-4', 'type', 'btn', { 'active': activeNavItem === 'documents' }]">
                                            <router-link
                                                :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                                                class="text-decoration-none">
                                                <a href="#" class="nav-link align-middle px-0">
                                                    <i class='lead mx-2 bx bxs-dashboard bx-rotate-180 fs-6'
                                                        style='color:#243673'></i>
                                                    <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">Edit
                                                        Document</span>
                                                </a>
                                            </router-link>
                                            <hr class="mt-0 w-100">
                                        </li>

                                        <li
                                            :class="['nav-item', 'mx-4', 'type', 'btn', { 'active': activeNavItem === 'documents' }]">
                                            <router-link
                                                :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                                                class="text-decoration-none">
                                                <a href="#" class="nav-link align-middle px-0">
                                                    <i class='lead mx-2 bx bx-book-open fs-6' style='color:#243673'></i>
                                                    <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">My
                                                        Course</span>
                                                </a>
                                            </router-link>
                                            <hr class="mt-0 w-100">
                                        </li>
                                        <li
                                            :class="['nav-item', 'mx-4', 'type', 'btn', { 'active': activeNavItem === 'documents' }]">
                                            <router-link
                                                :to="{ name: 'studentChangePass', params: { userId: user.student_id } }"
                                                class="text-decoration-none">
                                                <a href="#" class="nav-link align-middle px-0">
                                                    <i class='lead bx bx-message-dots mx-2 fs-6' style='color:#243673'></i>
                                                    <span class="lead fw-bold ms-1 d-none d-sm-inline text-dark fs-6">Change
                                                        Password</span>
                                                </a>
                                            </router-link>
                                            <hr class="mt-0 w-100">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="right col-md-8 border-2 border-[#243673] mx-2 rounded-3" style="height: 570px;">
                            <div class="p-3 py-2 text-center custom-scrollbar" style="height: 560px;">
                                <div class="d-flex align-items-center mb-1">
                                    <i class='bx bx-edit fs-2' style='color:#243673'></i>
                                    <p class="text-right mx-3 fs-3 mt-1 lead fw-bold">Profile's Info</p>
                                </div>

                                <div class="w-100 m-auto">
                                    <div class="lead d-flex m-auto fs-5 justify-content-between ">

                                        <div class="d-flex mt-2 ">
                                            <p class="text-uppercase fw-bold">First name &ensp; :</p>
                                            <p class="mx-5">{{ user.first_name }}</p>
                                        </div>

                                        <div class="d-flex fs-5 m-auto mt-2">
                                            <p class="text-uppercase fw-bold">Student Id &ensp; :</p>
                                            <p class="mx-5">{{ student_details.unique_id }} </p>

                                        </div>


                                    </div>

                                    <div class="lead d-flex fs-5 mt-2">
                                        <p class="text-uppercase fw-bold">Last name &ensp; :</p>
                                        <p class="mx-5">{{ user.last_name }}</p>
                                    </div>

                                    <div class="lead d-flex mt-2 fs-5">
                                        <p class="text-uppercase fw-bold">Username &ensp; :</p>
                                        <p class="mx-5">{{ user.username }}</p>
                                    </div>


                                    <div class="lead d-flex fs-5 m-auto mt-2 ">
                                        <p class="text-uppercase fw-bold">Email &ensp; :</p>
                                        <p class="mx-5">{{ user.email }}</p>
                                    </div>

                                    <div class="lead d-flex m-auto fs-5 justify-content-between mt-2 ">
                                        <div class="d-flex fs-5 m-auto w-50">
                                            <p class="text-uppercase fw-bold">Date of Birth &ensp; :</p>
                                            <p class="mx-5">{{ user.dob }}</p>
                                        </div>

                                        <div class="d-flex fs-5 m-auto w-50 ">
                                            <p class="text-uppercase fw-bold">Gender &ensp; :</p>
                                            <p class="mx-5">{{ user.gender }}</p>
                                        </div>
                                    </div>


                                    <div class="lead d-flex fs-5 m-auto mt-2">
                                        <p class="text-uppercase fw-bold">Phone Number &ensp; :</p>
                                        <p class="mx-5">{{ user.phone_number }}</p>
                                    </div>


                                    <div class="lead d-flex fs-5 m-auto mt-2">
                                        <p class="text-uppercase fw-bold">Bio &ensp; :</p>
                                        <p class="mx-5">{{ user.bio }}</p>

                                    </div>

                                    <div class="lead d-flex fs-5 m-auto mt-2">
                                        <p class="text-uppercase fw-bold">Program &ensp; :</p>
                                        <p class="mx-5 signIn_textBox">{{ programs.name }} </p>

                                    </div>

                                </div>

                                <div class="border-2 border-dashed rounded-4 border-[#243673]" style="margin-left: 75%;">
                                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start text-center"
                                        id="menu">

                                        <li class="nav-item text-center m-auto">

                                            <a href="#" class="nav-link align-middle px-0" @click="logout">
                                                <i class='mx-2 fs-5 bx bx-exit' style='color:#243673'></i>
                                                <span
                                                    class="lead ms-1 mx-3 d-none d-sm-inline text-dark fs-5 fw-bold ">Logout</span>
                                            </a>

                                        </li>
                                    </ul>
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

