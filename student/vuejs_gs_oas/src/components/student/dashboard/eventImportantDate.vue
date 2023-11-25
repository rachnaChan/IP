
<script>
import axios from 'axios';

export default {

    data() {
        return {
            user: null,
            currentDateTime: null,
            activeNavItem: null,
            event: [],

        };
    },

    mounted() {
        this.fetchInfoUser();
        this.fetchLoggedInUser();
        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000);

        this.fetchEventInfo();
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

        getUserImageURL(event) {
            if (event.image) {
                const imageUrl = `http://localhost:8000/storage/${event.image}`;
                // console.log('Image URL:', imageUrl); // Log the image URL
                return imageUrl;
            } else if (event.image == null) {
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

        fetchEventInfo() {
            axios.get(`http://localhost:8000/api/student/getEvent`)
                .then(response3 => {
                    this.event = response3.data;
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });
        },

        // //display date as 01-september-2023
        dueDateSt(start_date) {

            if (!start_date) return '';
            const date = new Date(start_date);
            const monthNames = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];

            // Get the month, day, and year components from the Date object
            const day = date.getDate();
            const month = date.toLocaleString('default', { month: 'long' }); // Get the full month name
            const year = date.getFullYear();


            // Create the formatted date string
            return `${day} ${month} ${year} `;
            // console.log(this.formattedDate);
        },

        dueDateEnd(deadline) {

            if (!deadline) return '';
            const date = new Date(deadline);
            const monthNames = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];

            // Get the month, day, and year components from the Date object
            const day = date.getDate();
            const month = date.toLocaleString('default', { month: 'long' }); // Get the full month name
            const year = date.getFullYear();


            // Create the formatted date string
            return `${day} ${month} ${year} `;
            // console.log(this.formattedDate);
        },


        dueDateDead(deadline) {
            if (!deadline) return '';
            const date = new Date(deadline);
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayOfWeek = daysOfWeek[date.getDay()]; // Get the day of the week as a string

            const monthNames = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];
            const month = monthNames[date.getMonth()]; // Get the month as a string
            const day = date.getDate();
            const daySuffix = this.getDaySuffix(day); // Get the day suffix (e.g., "st", "nd", "rd", "th")

            // Create the formatted date string
            return `${month} ${day < 10 ? '0' : ''}${day}  ${dayOfWeek}`;
        },

        getDaySuffix(day) {
            if (day >= 11 && day <= 13) {
                return 'th';
            }
            const lastDigit = day % 10;
            switch (lastDigit) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
                default:
                    return 'th';
            }
        },

        dueDateStatus(deadline) {
            if (!deadline) return 'No deadline provided';

            const currentDate = new Date();
            const dueDate = new Date(deadline);

            // Calculate the time remaining in milliseconds
            const timeRemainingMillis = dueDate - currentDate;

            // Calculate the days remaining
            const daysRemaining = Math.ceil(timeRemainingMillis / (1000 * 60 * 60 * 24));

            if (daysRemaining < 0) {
                // The deadline has passed, calculate the days that have passed
                const daysPassed = Math.abs(daysRemaining);
                return `Due ${daysPassed} day${daysPassed !== 1 ? 's' : ''} ago`;
            } else if (daysRemaining === 0) {
                return 'Due Today';
            } else {
                return `Days remaining: ${daysRemaining}`;
            }
        }

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

                            <div
                                :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'importantDate' }]">
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
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Events </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                                    Dashboard
                                </span> > Events
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
                                    <button
                                        @click="$router.push({ name: 'studentDashboard', params: { userId: user.student_id } })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="mt-4 py-5"></div>

                    <div class="m-auto mt-2 h-auto border-4 rounded-4 py-4 border-[#243673]"
                        style="width: 85%; z-index: 1;">

                        <div class="d-flex justify-content-around" v-for="event in event" :key="event.id">
                            <div class="col-sm-3 mx-1 my-3 border-1 border-dark py-4 rounded-4" style="width: 90%;">
                                <p class=" mx-5 fw-bold">{{ dueDateDead(event.deadline) }} <span class="mx-4 lead fs-6">{{
                                    dueDateStatus(event.deadline) }}
                                    </span></p>

                                <div class="d-flex justify-content-between m-auto mx-5">


                                    <div>
                                        <p class="lead fs-5 fw-bold mt-2 text-[#243673]">{{ event.title }}</p>
                                        <!-- <p class="lead fs-5 ">Due at </p> -->
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-success h-10 " data-bs-toggle="modal"
                                            :data-bs-target="'#exampleModal' + event.id">
                                            Read More
                                        </button>

                                        <div class="modal fade" :id="'exampleModal' + event.id" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center lead fw-bold fs-1 m-auto text-[#243673]">{{
                                                            event.title }}</p>
                                                        <div class="d-flex mt-2">
                                                            <img :src="getUserImageURL(event)" :alt="event.name"
                                                                class="rounded-1 img-fluid mx-4 m-auto text-center mt-5"
                                                                style="width: 300px; height: 300px;">
                                                            <p class="lead fs-5 m-auto py-4 mx-5 "> &emsp;{{
                                                                event.description }}
                                                            </p>
                                                        </div>

                                                        <p class="lead text-right fs-5 m-auto py-4 mx-5"><span
                                                                class="fw-bold fs-4"> Date:
                                                            </span> {{ dueDateSt(event.start_date) }} until {{
                                                                dueDateEnd(event.deadline) }}
                                                        </p>
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
