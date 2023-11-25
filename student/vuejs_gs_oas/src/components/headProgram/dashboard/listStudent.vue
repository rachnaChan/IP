
<script>
import axios from 'axios';

export default {

    data() {
        return {
            user: null,
            students: [],
            programs: null,
            currentDateTime: null,
            courses: [],
            student_details: [],
            enrollments: [],
            userId: null,
            activeNavItem: null,


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

        setUserID() {
            this.userId = this.userId;
        },

        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/info'); // Change this URL if needed
                this.user = response.data;
                this.userId = this.user.id;
                this.fetchInfoUser();


            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },

        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                //console.log('Image URL:', imageUrl); // Log the image URL
                return imageUrl;
            } else if (user.image == null) {
                const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
                // console.log(imageAuto);
                return imageAuto;
            }
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

            axios.get(`http://localhost:8000/api/head/showStudent/${this.userId}`)
                .then(response => {
                    this.students = response.data;


                })
                .catch(error => {
                    console.error('Error fetching info:', error);
                });
        },



    },
};

</script>

<template>
    <div v-if="user">
        <div class="dashboard_ContainerFluid">
            <div class="row flex-nowrap p-0">
                <div class="position-fixed col-lg-2 col-xl-2 bg-[#243673]" style="height: 700px; z-index: 3;">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 text-white">

                        <router-link :to="{ name: 'headDashboard', params: { userId: user.id } }"
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


                            <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'courses' }]">
                                <router-link :to="{ name: 'headAllCourse', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Courses</span>
                                    </a>
                                </router-link>
                            </div>




                            <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'enrollments' }]">
                                <router-link :to="{ name: 'headAllEnrollment', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-file-doc fs-5' style='color:white'></i>
                                        <span class="lead ms-1 d-none d-sm-inline text-white fs-5">Enrollments</span></a>
                                </router-link>
                            </div>

                            <div
                                :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'students' }]">
                                <router-link :to="{ name: 'headAllStudent', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-user fs-5' style='color:white'></i>
                                        <span class="lead ms-1 d-none d-sm-inline text-white fs-5">Students</span></a>
                                </router-link>
                            </div>
                            <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'events' }]">
                                <router-link :to="{ name: '', params: { userId: user.id } }" class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-calendar-event bx-rotate-180 fs-5' style='color:white'></i>
                                        <span class="lead ms-1 d-none d-sm-inline text-white fs-5">Events</span></a>
                                </router-link>
                            </div>

                            <div class="nav-item">
                                <p class="lead mt-5 text-white fs-6  text">{{ currentDateTime }}</p>

                            </div>

                        </div>



                        <hr>
                    </div>
                </div>

                <div class="col custom-scrollbar overflow-scroll flex-nowrap p-0" style="height: 700px; margin-left: 15%;">

                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2 " v-for="student in students" :key="student.id">{{
                                student.name }}</p>
                            <li class="lead mx-5 fs-5 fw-bold">
                                <span class="text-[#243673] cursor-pointer"
                                    @click="$router.push({ name: 'headDashboard', params: { userId: user.id } })">Dashboard

                                </span>
                                >
                                Students
                            </li>

                        </div>

                        <div class="d-flex bg-white ">
                            <div class="dropdown mt-3 " style="margin-left: 15%;">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="getUserImageURL(user)" ui:alt="user.id" class="rounded-circle img-fluid mx-5"
                                        style="width: 50px; height: 50px;">

                                </a>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                    aria-labelledby="dropdownUser1">
                                    <router-link :to="{ name: 'headProfile', params: { userId: user.id } }"
                                        class="text-decoration-none">
                                        <li><a class="dropdown-item " href="#">Profile</a></li>
                                        <li class="mt-1">
                                            <a href="#" class="dropdown-item " @click="logout">
                                                <span class="ms-1 d-none d-sm-inline">Logout</span>
                                            </a>
                                        </li>
                                    </router-link>

                                </ul>
                            </div>

                            <i class='bx bx-bell fs-1 mt-3 mx-4 ' style=" color: #233673;"></i>


                        </div>


                    </div>

                    <div class="mt-4 py-5"></div>


                    <div class="m-auto h-auto mt-4 border-4 rounded-4 py-4 border-[#243673]"
                        style="width: 85%; z-index: 1;">

                        <div class="m-auto text-center">

                            <div>

                                <table class="m-auto table-bordered mt-5 mb-5" style="width: 90%;">
                                    <thead>
                                        <tr class="text-white bg-[#243673] m-auto text-center fs-4">
                                            <th scope="col" style="width: 10%;">No</th>
                                            <th scope="col" style="width: 55%;">Student</th>
                                            <th scope="col" style="width: 15%;">ID</th>
                                            <th scope="col" style="width: 20%;">Profile</th>

                                        </tr>
                                    </thead>
                                    <tbody v-for="program in students" :key="program.id">
                                        <tr v-for="(studentDetail, index) in program.student_detail" :key="studentDetail.id">
                                            <th>
                                                {{ index + 1 }}
                                            </th>
                                            <td>
                                                {{ studentDetail.user.last_name }}
                                            </td>
                                            <td>
                                                {{ studentDetail.unique_id }}
                                            </td>
                                            <td>
                                                <img :src="getUserImageURL(studentDetail.user)" alt="profile"
                                                    class="w-[60px] h-[60px] m-auto rounded-3">
                                            </td>



                                        </tr>

                                    </tbody>
                                </table>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss"  >
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

.dashboard_textBox {
    width: 75%;
    overflow: hidden;
    word-wrap: break-word;
    font-size: 16px;
}


.custom-scrollbar {
    width: 100%;
    height: 700px;
    word-wrap: break-word;
    font-size: 18px;
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
