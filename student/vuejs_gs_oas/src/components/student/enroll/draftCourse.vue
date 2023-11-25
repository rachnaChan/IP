
<script>
import axios from 'axios';

export default {

    data() {
        return {
            user: null,
            programs: null,
            courses: [],
            student_details: null,
            selectedProgram: null,
            enrolledCourses: [],
            currentDateTime: null,
            activeNavItem: null,

            pendingCredits: 0,
            approvedCredits: 0,
            rejectedCredits: 0,

        };
    },

    mounted() {
        this.fetchInfoUser();
        this.fetchLoggedInUser();
        this.fetchEnrolledCourses();

        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000)

    },

    methods: {

        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/student/info'); // Change this URL if needed
                this.user = response.data;
                // console.log(response.data);

            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },

        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                return imageUrl;
            } else {
                const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
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
            console.log('User ID:', userId); // Check the student_id

            axios.get(`http://localhost:8000/api/student/info/${userId}`)
                .then(response3 => {
                    this.programs = response3.data[0];
                    this.courses = response3.data[0];
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });


        },

        fetchEnrolledCourses() {
            axios.get('http://localhost:8000/api/student/course_enrollment_all')
                .then(response4 => {
                    this.enrolledCourses = response4.data;
                    // console.log(response4.data);

                    this.enrolledCourses.forEach(course => {
                        if (course.status === 'approved') {
                            this.approvedCredits += parseFloat(course.course.credit);
                        } else if (course.status === 'rejected') {
                            this.rejectedCredits += parseFloat(course.course.credit);
                        } else if (course.status === 'pending') {
                            this.pendingCredits += parseFloat(course.course.credit);
                        }
                    });

                    // Log the calculated credits
                    // console.log('Approved Credits:', this.approvedCredits);
                    // console.log('Rejected Credits:', this.rejectedCredits);
                    // console.log('Pending Credits:', this.pendingCredits);

                })

                .catch(error => {
                    console.error('Error fetching courses enrollment:', error);
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
                                            :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'requested' }]">
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

                <div class="col custom-scrollbar overflow-scroll  p-0" style="height: 700px; margin-left: 15%;">
                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Course Enrollment: <span class="text-[#243673]">
                                    Requested</span> </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead  fs-6 fw-bold cursor-pointer">
                                    Dashboard >
                                </span>

                                <!-- <span @click="$router.push({ name: 'studentCourse', params: { userId: user.student_id } })"
                                    class="lead  fs-6 fw-bold cursor-pointer">Program Detail ></span> -->
                                <span
                                    @click="$router.push({ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">Course Enrollment</span>
                                > Course Requested
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
                                        @click="$router.push({ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="mt-5 py-4"></div>

                    <div class="m-auto h-auto mt-4 border-4 rounded-4 py-4 border-[#243673]"
                        style="width: 85%; z-index: 1;">

                        <div class="lead py-1 fw-bold">

                            <div class="border-1 border-[#243673] text-center m-auto w-50 rounded-4">
                                <p class="lead mt-2 fs-4 fw-bold">Your Courses's List Enrollment</p>
                            </div>

                        </div>

                        <div class="mt-3 m-auto  " v-if="enrolledCourses.length >= 0" style="width: 85%;">


                            <table class="w-100 table-bordered">
                                <thead class="">
                                    <tr class="text-white bg-[#243673] m-auto text-center fs-4">
                                        <th scope="col" style="width: 10%;">No</th>
                                        <th scope="col" style="width: 70%;">Subject</th>
                                        <th scope="col" style="width: 20%;">Status</th>
                                    </tr>
                                </thead>



                                <tbody v-for="(course, index) in enrolledCourses" :key="course.id">
                                    <tr v-if="course.status == 'approved'">
                                        <th scope="row" class=" text-center" style="width: 10%;">{{ index + 1 }}</th>
                                        <td class="lead fs-6" style="width: 70%;">&emsp; {{ course.course.name }}
                                        </td>
                                        <td class="w-25 " style="width: 20%;">
                                            <p class="lead text-center text-success m-auto fs-6 fw-bold"><i
                                                    class='lead bx bx-user-check fs-4'></i></p>
                                        </td>

                                    </tr>

                                    <tr v-else-if="course.status == 'pending'">
                                        <th scope="row" class=" text-center" style="width: 10%;">{{ index + 1 }}</th>
                                        <td class="lead fs-6 " style="width: 70%;">&emsp; {{ course.course.name }}
                                        </td>
                                        <td class="w-25" style="width: 20%;">
                                            <p class="lead text-center text-warning m-auto fs-6 fw-bold"><i
                                                    class='lead bx bx-user-minus fs-4'></i></p>
                                        </td>

                                    </tr>

                                    <tr v-else-if="course.status == 'rejected'">
                                        <th scope="row" class=" text-center" style="width: 10%;">{{ index + 1 }}</th>
                                        <td class="lead fs-6 " style="width: 70%;">&emsp; {{ course.course.name }}
                                        </td>
                                        <td class="w-25" style="width: 20%;">
                                            <p class="lead text-center text-danger m-auto fs-6 fw-bold"><i
                                                    class='lead bx bx-user-x fs-4'></i></p>
                                        </td>

                                    </tr>
                                </tbody>

                            </table>



                            <div class="d-flex justify-content-between mt-4 ">

                                <div
                                    class="h-auto w-75 m-auto lead border-3 border-dashed border-[#243673] py-2 rounded-2 dashboard_textBox">
                                    <p class="lead text-center fs-6"><span
                                            class="lead fw-bold text-decoration-underline fs-5">Noted</span> :
                                        Course Enrollment's status
                                    </p>
                                    <div class="m-auto h-auto " style="width: 85%;">

                                        <table class="table border-white ">

                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <li class="lead text-warning"></li>
                                                    </th>
                                                    <td><i
                                                            class='lead bx bx-user-minus text-warning  fw-bold mt-1 fs-4 mx-3 '></i>
                                                    </td>
                                                    <td class="lead fs-5 text-warning fw-bold">Pending</td>
                                                    <td class="lead fs-5 text-warning fw-bold">{{ pendingCredits }}</td>
                                                    <td class="lead fs-5 fw-bold">Credit(s)</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <li class="lead text-success "></li>
                                                    </th>
                                                    <td><i
                                                            class='lead bx bx-user-check text-success fw-bold mt-1 fs-4 mx-3 '></i>
                                                    </td>
                                                    <td class="lead fs-5 text-success fw-bold">Approved</td>
                                                    <td class="lead fs-5 text-success fw-bold">{{ approvedCredits }}</td>
                                                    <td class="lead fs-5 fw-bold">Credit(s)</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <li class="lead text-danger "></li>
                                                    </th>
                                                    <td><i class='lead bx bx-user-x text-danger fw-bold mt-1 fs-4 mx-3'></i>
                                                    </td>
                                                    <td class="lead fs-5 text-danger fw-bold">Rejected</td>
                                                    <td class="lead fs-5 text-danger fw-bold">{{ rejectedCredits }}</td>
                                                    <td class="lead fs-5 fw-bold">Credit(s)</td>

                                                </tr>
                                            </tbody>
                                        </table>


                                        <p v-if="pendingCredits > 0" class="lead fs-6 text-center"> You have a pending
                                            Courses!! Cannot Enroll a new Course at this moment!! </p>

                                        <div class="lead fs-6 text-center "
                                            v-if="(pendingCredits == 0) && (approvedCredits > 0)">

                                            <p>
                                                You have two options while You do not have pending courses!!
                                            </p>

                                            <p>
                                                <a href="" class="text-dark text-decoration-none">
                                                    <router-link
                                                        :to="{ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } }"
                                                        class="text-decoration-none text-dark">
                                                        click <span
                                                            class="text-success text-decoration-underline">here</span> to
                                                        enroll a new courses
                                                    </router-link>
                                                </a>
                                            </p>

                                            <p>or</p>

                                            <p>
                                                <a href="" class="text-dark text-decoration-none">
                                                    <router-link
                                                        :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                                                        class="text-decoration-none text-dark">
                                                        click <span
                                                            class="text-success text-decoration-underline">here</span> to
                                                        see your courses
                                                    </router-link>
                                                </a>
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
</template>

<style lang="scss">
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
</style>

