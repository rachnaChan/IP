
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            currentDateTime: null,
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

        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/student/info'); // Change this URL if needed
                // console.log(response.data);
                this.user = response.data;

            } catch (error) {
                console.error('Error fetching user:', error);
            }
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
                    console.log(error);
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

                <div class="col custom-scrollbar overflow-scroll flex-nowrap p-0" style="height: 700px; margin-left: 15%;">

                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Graduate Admission </p>
                            <li class="lead mx-5 fs-6 fw-bold">Dashboard</li>

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

                            <i class='bx bx-bell fs-1 mt-3 mx-4  text-[#233673]'></i>


                        </div>


                    </div>

                    <div class="mt-4 py-5"></div>

                    <p class=" lead fs-5 m-auto mx-5 " style="width: 85%;">

                        &ensp; Once you have chosen a course, it is important to stay focused and motivated. It is also
                        important
                        to be realistic about your expectations. College is a challenging experience, but it can also be a
                        very rewarding one. By choosing a course that you like, you can increase your chances of success.
                    </p>


                    <div id="carouselExampleIndicators" class="carousel slide m-auto" data-bs-ride="fasle"
                        style="z-index: 1;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>

                        </div>
                        <div class="carousel-inner mt-3">
                            <div class="carousel-item active" style="height: 430px;">
                                <img src="../../../assets/img/itc-front-entrance.png"
                                    class="d-block m-auto img-fluid h-100 rounded-4" alt="..." style="width: 90%;">
                            </div>
                            <div class="carousel-item" style="height: 430px;">
                                <img src="https://coolbeans.sgp1.digitaloceanspaces.com/gci-prod/4a736878-a909-469d-9350-91fb66682ca7.jpeg"
                                    class="d-block m-auto img-fluid h-100 rounded-4" alt="..." style="width: 90%;">
                            </div>
                            <div class="carousel-item" style="height: 430px;">
                                <img src="https://itc.edu.kh/wp-content/uploads/2022/02/photo_2022-02-04_08-54-18-1024x745.jpg"
                                    class="d-block m-auto img-fluid h-100 rounded-4" alt="..." style="width: 90%;">
                            </div>


                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <div class="mt-3 d-flex justify-content-around m-auto">

                        <router-link :to="{ name: 'studentDocument', params: { userId: user.id } }"
                            class="text-decoration-none">
                            <button
                                class="learn-more position-relative d-inline-block cursor-pointer outline-none border-0 text-decoration-none p-0 fs-6 h-auto">
                                <span class="circle position-relative d-block m-0 rounded-5 " aria-hidden="true">
                                    <span class="icon arrow top-0 bottom-0 m-auto position-absolute"></span>
                                </span>
                                <span class="lead fs-6 button-text mx-2">My Document</span>
                            </button>
                        </router-link>


                        <router-link
                            :to="{ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } }"
                            class="text-decoration-none"> <button
                                class="learn-more position-relative d-inline-block cursor-pointer outline-none border-0 text-decoration-none p-0 fs-6 h-auto">
                                <span class="circle position-relative d-block m-0  rounded-5 " aria-hidden="true">
                                    <span class="icon arrow top-0 bottom-0 m-auto position-absolute"></span>
                                </span>
                                <span class="lead fs-6 button-text mx-2">Enroll Courses</span>
                            </button>
                        </router-link>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<style lang="scss"  >
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

.carousel-inner {
    transition: transform 1s ease-in-out;
    /* Adjust the time as needed */
}

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

/*Button*/
button {
    vertical-align: middle;
    font-family: inherit;
}

button.learn-more {
    width: 18rem;
}

button.learn-more .circle {
    transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
    width: 3rem;
    height: 3rem;
}

button.learn-more .circle .icon {
    transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
    background: #fff;

}

button.learn-more .circle .icon.arrow {
    transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
    left: 0.625rem;
    width: 1.125rem;
    height: 0.125rem;
    background: none;
    background-color: #243673;

}

button.learn-more .circle .icon.arrow::before {
    position: absolute;
    content: "";
    top: -0.29rem;
    right: 0.0625rem;
    width: 0.625rem;
    height: 0.625rem;
    border-top: 0.125rem solid #fff;
    border-right: 0.125rem solid #fff;
    transform: rotate(45deg);
    background-color: #243673;
}

button.learn-more .button-text {
    transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 0.75rem 0;
    margin: 0 0 0 1.85rem;
    color: #282936;
    font-weight: 700;
    line-height: 1.6;
    text-align: center;
    text-transform: uppercase;
}

button:hover .circle {
    width: 100%;
    background-color: #243673;
}

button:hover .circle .icon.arrow {
    background: #fff;
    transform: translate(1rem, 0);

}

button:hover .button-text {
    color: #fff;
}
</style>
