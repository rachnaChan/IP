
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            programs: null,
            courses: [],
        };
    },
    mounted() {
        this.fetchInfoUser();
    },
    methods: {
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
            this.$router.push({ name: 'studentEditProfile', params: { userId: user.student_id } });
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
                    console.log(response3.data);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });


        },

    },
};
</script>

<template>
    <div class="h-100" v-if="user">
        <div class="dashboard_Container d-flex m-auto position-sticky">

            <div class="text-white d-flex text-box mt-3 mx-5 ">
                <!-- routerlink -->
                <h5>Contact &emsp;|&emsp;</h5>
                <i class='bx bxl-facebook-circle mt-2'>&emsp;</i>

            </div>

            <div class="dashboard_Header d-flex text-white mt-1 ">

                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img :src="getUserImageURL(user)" :alt="user.name" width="20" height="53"
                            class="rounded-circle img-fluid w-25">

                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <router-link to="/student/profile" class="text-decoration-none">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                        </router-link>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item cursor-pointer" @click="logout">Sign Out</a>
                        </li>

                    </ul>
                </div>

            </div>

        </div>

        <div class="dashboard_ContainerFluid">
            <div class="row flex-nowrap">
                <div class=" col-md-3 col-xl-2 px-sm-2 bg-white" style=" height: 570px; border-right: 1px solid #233673;">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-23text-white">

                        <router-link to="/student/dashboard" class="text-decoration-none">
                            <div
                                class="d-flex align-items-center pb-3 mt-2 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="text-center align-items-center m-auto justify-content-center mx-5">
                                    <img src="../../../assets/img/itc_logo.png" alt="" class="img-fluid w-100">
                                </span>
                            </div>
                        </router-link>


                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">

                            <li class="nav-item ">
                                <router-link :to="{ name: 'studentCourse', params: { userId: user.student_id } }"
                                    class="text-decoration-none"> <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:#243673'></i>
                                        <span class="ms-1 d-none d-sm-inline text-dark fs-5">Course</span>
                                    </a>
                                </router-link>
                            </li>

                            <li class="nav-item ">
                                <router-link :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                                    class="text-decoration-none"> <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bx-book-open fs-4' style='color:#243673'></i>
                                        <span class="ms-1 d-none d-sm-inline text-dark fs-5">My
                                            Course</span>
                                    </a>
                                </router-link>
                            </li>

                            <li class="nav-item ">
                                <router-link :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-file-doc fs-5' style='color:#243673'></i>
                                        <span class="ms-1 d-none d-sm-inline text-dark fs-5">Document</span></a>
                                </router-link>
                            </li>

                            <li class="nav-item ">
                                <router-link :to="{ name: 'studentProfile', params: { userId: user.student_id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle">
                                        <i class='mx-2 bx bx-user fs-5' style='color:#243673'></i>
                                        <span class="ms-1 d-none d-sm-inline text-dark fs-5">Profile</span></a>
                                </router-link>
                            </li>

                        </ul>
                        <hr>
                    </div>
                </div>

                <div class="col py-3 custom-scrollbar mt-2 justify-content-center">
                    <p class=" text-center text-muted mb-5 fs-1">Matser's Programs </p>

                    <div class="lead mb-5" v-for="program in programs" :key="program.id">
                        <div class="d-flex m-auto justify-content-around">
                            <div class="course d-flex w-75">
                                <img src="../../../assets/img/itc_logo.png" alt="" class="img-fluid">
                                <div class="mx-5">
                                    <p class="fw-bold">{{ program.name }}</p>
                                    <router-link to="/student/detailCourse" class="text-decoration-none text-dark">
                                        <h6>{{ program.description }}</h6>
                                    </router-link>

                                </div>
                            </div>

                            <div class="card-button d-flex rounded-4 ">
                                <router-link :to="{ name: 'studentEnrollCourse', params: { programId: program.id } }">
                                    <button class="border-0 bg-transparent">Enroll Course</button>

                                </router-link>
                            </div>

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</template>

<style lang="scss">
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

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

/* width */
::-webkit-scrollbar {
    width: 10px;
}



/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #ffffff;
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

/*Button*/
.card-button {
    padding: .3em;
    cursor: pointer;

    transition: .3s ease-in-out;
}

.card-button:hover {
    border: 1px solid #000000;
    background-color: gray;
}
</style>

