<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
        };
    },
    mounted() {
        this.fetchLoggedInUser();
    },
    methods: {
        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/student/info'); // Change this URL if needed
                console.log(response.data);
                this.user = response.data;

            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },
        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                // console.log('Image URL:', imageUrl); // Log the image URL
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
        }

    },
};
</script>


<template>
    <div class="h-100" v-if="user">


        <div class="dashboard_ContainerFluid">
            <div class="row flex-nowrap">
                <div class=" col-md-4 col-xl-2 px-sm-2 min-vh-100 " style=" background-color: #233673;">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-23text-white">

                        <router-link to="/student/dashboard" class="text-decoration-none">
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


                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
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
                                <router-link :to="{ name: 'headDisplayStudentEnroll', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span class="ms-1 d-none d-sm-inline text-white fs-5">Student Enroll</span>
                                    </a>
                                </router-link>
                            </li>

                            <li class="nav-item mx-4 mt-56">
                                <div class="dropdown mt-0  ">
                                    <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img :src="getUserImageURL(user)" ui:alt="user.name"
                                            class="rounded-circle img-fluid mx-5" style="width: 50px; height: 50px;">

                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                        aria-labelledby="dropdownUser1">
                                        <router-link :to="{ name: 'headProfile', params: { userId: user.id } }"
                                            class="text-decoration-none">
                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                            <li class="mt-1">
                                                <a href="#" class="dropdown-item " @click="logout">
                                                    <span class="ms-1 d-none d-sm-inline">Logout</span>
                                                </a>
                                            </li>
                                        </router-link>

                                    </ul>
                                </div>
                            </li>

                        </ul>
                        <hr>
                    </div>
                </div>

                <div class="col custom-scrollbar justify-content-center mt-2 overflow-scroll flex-nowrap">
                    <p class="lead mt-3 text-muted mx-2 mb-2 fs-1">Head of Program Dashboard</p>

                    <hr>

                    <div class="card mt-5 w-75 d-grid m-auto text-white gap-2 overflow-visible h-50 border-0">
                        <div class="item flex-column d-flex w-100 h-100 rounded-4 align-items-center justify-content-center bg-blue-300" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="w-25 h-25 mb-2">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M17 15.245v6.872a.5.5 0 0 1-.757.429L12 20l-4.243 2.546a.5.5 0 0 1-.757-.43v-6.87a8 8 0 1 1 10 0zm-8 1.173v3.05l3-1.8 3 1.8v-3.05A7.978 7.978 0 0 1 12 17a7.978 7.978 0 0 1-3-.582zM12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"
                                    fill="rgba(149,149,255,1)"></path>
                            </svg>
                            <span class="fs-3 fw-bold fs-3 fw-bold"> 90+ </span>
                            <span class="text text-primary"> Icons </span>
                        </div>
                        <div class="item flex-column d-flex w-100 h-100 rounded-4 align-items-center justify-content-center bg-gray-300">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-25 h-25 mb-2">
                                <path d="M0 0L24 0 24 24 0 24z" fill="none"></path>
                                <path fill="rgba(252,161,71,1)"
                                    d="M16 16c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zM6 12c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm10 6c-.552 0-1 .448-1 1s.448 1 1 1 1-.448 1-1-.448-1-1-1zM6 14c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zm8.5-12C17.538 2 20 4.462 20 7.5S17.538 13 14.5 13 9 10.538 9 7.5 11.462 2 14.5 2zm0 2C12.567 4 11 5.567 11 7.5s1.567 3.5 3.5 3.5S18 9.433 18 7.5 16.433 4 14.5 4z">
                                </path>
                            </svg> <span class="fs-3 fw-bold"> 70+ </span>
                            <span class="text text-muted"> Illustrations </span>
                        </div>
                        <div class="item flex-column d-flex w-100 h-100 rounded-4 align-items-center justify-content-center bg-green-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="w-25 h-25 mb-2">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M20.083 15.2l1.202.721a.5.5 0 0 1 0 .858l-8.77 5.262a1 1 0 0 1-1.03 0l-8.77-5.262a.5.5 0 0 1 0-.858l1.202-.721L12 20.05l8.083-4.85zm0-4.7l1.202.721a.5.5 0 0 1 0 .858L12 17.65l-9.285-5.571a.5.5 0 0 1 0-.858l1.202-.721L12 15.35l8.083-4.85zm-7.569-9.191l8.771 5.262a.5.5 0 0 1 0 .858L12 13 2.715 7.429a.5.5 0 0 1 0-.858l8.77-5.262a1 1 0 0 1 1.03 0zM12 3.332L5.887 7 12 10.668 18.113 7 12 3.332z"
                                    fill="rgba(66,193,110,1)"></path>
                            </svg>
                            <span class="fs-3 fw-bold"> 150+ </span>
                            <span class="text text-success"> Components </span>
                        </div>
                        <div class="item flex-column d-flex w-100 h-100 rounded-4 align-items-center justify-content-center bg-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="w-25 h-25 mb-2">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 20h8v2h-8C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10a9.956 9.956 0 0 1-2 6h-2.708A8 8 0 1 0 12 20zm0-10a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm-4 4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm8 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm-4 4a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                                    fill="rgba(220,91,183,1)"></path>
                            </svg>
                            <span class="fs-3 fw-bold"> 30+ </span>
                            <span class="text text-danger"> Animations </span>
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

.course {
    img {
        width: 8rem;
    }
}

// li:hover{
//     background-color: aliceblue;
// }
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


.card {
 
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;

}




</style>
