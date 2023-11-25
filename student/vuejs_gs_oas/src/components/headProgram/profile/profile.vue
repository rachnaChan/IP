

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
        this.fetchLoggedInUser();
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


                        <!-- <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">

                            <li class="nav-item mx-4">
                                <router-link :to="{ name: 'headAddProgram', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span class="ms-1 d-none d-sm-inline text-white fs-5">Program</span>
                                    </a>
                                </router-link>
                            </li>
                            <li class="nav-item mx-4">
                                <router-link :to="{ name: 'headAddCourse', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span class="ms-1 d-none d-sm-inline text-white fs-5">Courses</span>
                                    </a>
                                </router-link>
                            </li>
                            <li class="nav-item mx-4">
                                <router-link :to="{ name: 'headDisplayheadEnroll', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span class="ms-1 d-none d-sm-inline text-white fs-5">head Enroll</span>
                                    </a>
                                </router-link>
                            </li>
                            



                        </ul> -->
                        <hr>
                    </div>
                </div>

                <div class="col custom-scrollbar justify-content-center mt-2 overflow-scroll flex-nowrap">
                    <div class="position-fixed w-100 h-16 d-flex justify-content-between bg-white">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-1  ">Profile Info </p>

                        </div>

                        <div class="d-flex w-25 text-right m-auto mx-5">

                            <i class='bx bx-bell fs-1 mt-3' style=" color: #233673;"></i>

                            <div class="dropdown mt-2  ">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="getUserImageURL(user)" :alt="user.name" class="rounded-circle img-fluid mx-5"
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
                        </div>


                    </div>
                    <div class="py-5"></div>

                    <div class="row justify-content-around mt-5 py-2">



                        <div class="left col-md-3 border border-dark mx-2">
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
                                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                                        id="menu">

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
                                                    <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5'
                                                        style='color:#243673'></i>
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
                                            <router-link :to="{ name: 'headChangePass', params: { userId: user.id } }"
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

                        <div class="right col-md-8 border border-dark mx-2">
                            <div class="p-3 py-5 text-center">
                                <div class="d-flex align-items-center mb-3">
                                    <i class='bx bx-edit fs-1' style='color:#243673'></i>
                                    <p class="text-right mx-3 fs-2 mt-1">Profile's Info</p>
                                </div>

                                <div class="w-100 m-auto">
                                    <div class="d-flex m-auto fs-5 justify-content-between mt-3 ">

                                        <div class="d-flex mt-3 ">
                                            <p class="text-uppercase fw-bold">First name &ensp; :</p>
                                            <p class="mx-5">{{ user.first_name }}</p>
                                        </div>

                                    </div>

                                    <div class="d-flex fs-5 mt-3">
                                        <p class="text-uppercase fw-bold">Last name &ensp; :</p>
                                        <p class="mx-5">{{ user.last_name }}</p>
                                    </div>

                                    <div class="d-flex mt-3 fs-5">
                                        <p class="text-uppercase fw-bold">Username &ensp; :</p>
                                        <p class="mx-5">{{ user.username }}</p>
                                    </div>


                                    <div class="d-flex fs-5 m-auto mt-3 ">
                                        <p class="text-uppercase fw-bold">Email &ensp; :</p>
                                        <p class="mx-5">{{ user.email }}</p>
                                    </div>

                                    <div class="d-flex m-auto fs-5 justify-content-between mt-3 ">
                                        <div class="d-flex fs-5 m-auto w-50">
                                            <p class="text-uppercase fw-bold">Date of Birth &ensp; :</p>
                                            <p class="mx-5">{{ user.dob }}</p>
                                        </div>
                                        <div class="d-flex fs-5 m-auto w-50 ">
                                            <p class="text-uppercase fw-bold">Gender &ensp; :</p>
                                            <p class="mx-5">{{ user.gender }}</p>
                                        </div>
                                    </div>


                                    <div class="d-flex fs-5 m-auto mt-3">
                                        <p class="text-uppercase fw-bold">Phone Number &ensp; :</p>
                                        <p class="mx-5">{{ user.phone_number }}</p>
                                    </div>



                                    <div class="d-flex fs-5 m-auto mt-3">
                                        <p class="text-uppercase fw-bold">Bio &ensp; :</p>
                                        <p class="mx-5">{{ user.bio }}</p>

                                    </div>





                                </div>

                                <div class="mt-5" style="margin-left: 75%;">
                                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                                        id="menu">

                                        <li class="nav-item mx-4">

                                            <a href="#" class="nav-link align-middle px-0" @click="logout">
                                                <i class='mx-2 fs-5 bx bx-exit' style='color:#243673'></i>
                                                <span class="ms-1 d-none d-sm-inline text-dark fs-5">Logout</span>
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

