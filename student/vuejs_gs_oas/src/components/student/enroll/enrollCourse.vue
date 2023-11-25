
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            programs: [],
            courses: [],
            selectedProgram: null,
            enrollmentMessage: "", // Message to display after enrollment
            selectedCourses: [],  // To store selected courses for enrollment
            newCourses: [],
            currentDateTime: null,
            totalselectCredit: 0,
            activeNavItem: null,
            deadline: "",
            formattedTime: "",
            formattedDate: "",
            timerInterval: null,

        };
    },

    mounted() {

        this.fetchLoggedInUser();
        this.fetchEnrolledCourses();

        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000);

        this.timerInterval = setInterval(this.remainingTime, 1000); // Update every 1 second
        this.remainingTime(); // Initial update
        this.dueDate();
    },

    beforeDestroy() {
        clearInterval(this.timerInterval);
    },

    created() {
        this.fetchCourseUser();
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

        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/student/info'); // Change this URL if needed
                // console.log(response.data);
                this.user = response.data;

            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },

        fetchCourseUser() {
            const programId = this.$route.params.programId;
            console.log('Program ID:', programId); // Check the programId


            axios.get(`http://localhost:8000/api/student/showProgram/${programId}/courses`)
                .then(response3 => {
                    this.courses = response3.data.all_courses;
                    this.deadline = response3.data.course_with_longest_deadline;

                    // this.selectedProgram = this.programs.find(program => program.id === programId);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });

        },

        // courses's list then enroll 
        async enrollCourse() {
            const userId = this.$route.params.userId;
            console.log('User ID:', userId); // Check the student_id

            try {
                const response = await axios.post('http://localhost:8000/api/student/enroll', {
                    course_ids: this.newCourses
                });

                if (response.data.message === 'Enrollment requests sent for selected courses.') {
                    this.enrollmentMessage = 'Successfully on enroll Courses!!';
                    this.$router.push(`/student/draftCourse/${userId}`);
                    // console.log(response.data);
                } else {
                    this.enrollmentMessage = error.response.data.message;
                }
            } catch (error) {
                this.enrollmentMessage = error.response.data.message; 
            }
        },

        //display update courses's list after enroll
        fetchEnrolledCourses() {
            axios.get('http://localhost:8000/api/student/course_enrollment_all')
                .then(response4 => {
                    let courses = response4.data;
                    courses.forEach(course => {
                        this.selectedCourses.push(course.course_id)
                    });
                    // console.log(this.enrolledCourses);
                })

                .catch(error => {
                    console.error('Error fetching courses enrollment:', error);
                });
        },

        //total credit courses
        calculateTotalCredits() {
            this.totalselectCredit = this.newCourses.reduce((total, courseId) => {
                const selectedCourse = this.courses.find(course => course.id === courseId);
                if (selectedCourse) {
                    total += selectedCourse.credit;
                }
                return total;
            }, 0);
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

        //remaining time for deadline
        remainingTime() {
            if (!this.deadline) return '';

            // Calculate the remaining time
            const deadline = new Date(this.deadline.deadline);
            const now = new Date();

            const timeDifference = deadline - now;

            if (timeDifference <= 0) {
                clearInterval(this.timerInterval); // Stop the timer when the deadline is reached
                // this.formattedTime = "Deadline expired!!";
                return "Deadline expired!"; // Return the message directly
            }
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            //   return `${days} days ${hours} hours ${minutes} minutes ${seconds}s`;
            this.formattedTime = `${days}d ${hours}h ${minutes}m ${seconds}s`;

        },

        //display deadline courses
        dueDate(deadline) {

            if (!deadline) return '';
            const date = new Date(this.deadline.deadline);
            const monthNames = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];

            // Get the month, day, and year components from the Date object
            const month = monthNames[date.getMonth()];
            const day = date.getDate();
            // const year = date.getFullYear();

            // Create the formatted date string
            return `${month} ${day} 11:59 pm`;
            // console.log(this.formattedDate);
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
                                            :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'enroll' }]">
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

                    <div class="position-fixed h-32 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Course Enrollment: <span class="text-[#243673]">
                                    Enroll</span> </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                                    Dashboard
                                </span>
                                > Course Enrollment
                            </li>

                            <div class="d-flex justify-content-between">
                                <p class="lead mx-5 fs-6 mt-2 text-[#243673]"><span class="mx-3"></span>Due to {{
                                    dueDate(deadline.deadline) }}</p>
                                <p v-if="deadline" class="lead  fs-6 mt-2 text-[#243673]">Time Left : <span>{{ formattedTime
                                }}</span></p>

                            </div>

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
                                        @click="$router.push({ name: 'studentCourse', params: { userId: user.student_id } })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="mt-5 py-4 "> </div>

                    <div class="mt-5 m-auto border-4 rounded-4 py-4 border-[#243673] " style="width: 85%; height: auto;">

                        <div
                            class="w-75 dashboard_textBox border-2 rounded-2 border-dashed border-[#243673] text-center m-auto lead h-12 ">
                            <p><span class="text-decoration-underline fw-bold fs-4">Noted</span>: &emsp; In this
                                Program,
                                At least You must select <span class="fw-bold lead fs-6 text-warning">54</span> Credits for
                                the first
                                course enrollment include S1 and S2!! </p>
                        </div>

                        <div>
                            <p v-if="totalselectCredit < 54" class=" mx-5 lead fs-6 text-right mt-2">You has been selected :
                                <span class="text-warning lead fs-6 fw-bold">{{ totalselectCredit }} </span> credits!!
                                &#128070;!!
                            </p>
                            <p v-else-if="totalselectCredit > 54" class=" mx-5 lead fs-6 text-right mt-2">You has been
                                selected
                                : <span class="text-success lead fs-6 fw-bold">{{ totalselectCredit }} </span> credits!!
                                &#128077;!!</p>
                            <p v-else-if="totalselectCredit == 54" class=" mx-5 lead fs-6 text-right mt-2">You has been
                                selected
                                : <span class="text-success lead fs-6 fw-bold">{{ totalselectCredit }} </span> credits!!
                                &#128076; !!</p>
                        </div>


                        <div class="m-auto" style="width: 85%;">
                            <form @submit.prevent="enrollCourse">
                                <p class="lead text-center m-auto fs-5 fw-bold mb-4">Courses For Semester One</p>
                                <table class="w-100 table-bordered ">


                                    <thead>
                                        <tr class="text-white bg-[#243673] m-auto text-center fs-4">
                                            <th scope="col" style="width: 10%;">No</th>
                                            <th scope="col" style="width: 45%;">Subject</th>
                                            <th scope="col" style="width: 15%;">Semester</th>
                                            <th scope="col" style="width: 15%;">Credit</th>
                                            <th scope="col" style="width: 15%;">Selected</th>
                                        </tr>
                                    </thead>


                                    <tbody v-for="(course, index) in courses" :key="course.id">
                                        <tr >
                                            <th scope="row" class="text-center" style="width: 10%;">{{ index + 1 }}</th>
                                            <td class="lead fs-6 mx-3" style="width: 45%;">&emsp;{{ course.name }}</td>
                                            <td class="text-center" style="width: 15%;">{{ course.semester }}</td>
                                            <td class="text-center fw-bold" style="width: 15%;">{{ course.credit }}</td>

                                            <td class="text-center" style="width: 15%;">
                                                <div v-if="selectedCourses.includes(course.id)">
                                                    <div class="">
                                                        <span class="text-center m-auto mx-5"> <i class='bx bx-check'
                                                                style='color:#243376'></i></span>
                                                    </div>
                                                </div>
                                                <input v-else type="checkbox" v-model="newCourses" multiple
                                                    :value="course.id"
                                                    class="text-success rounded-5 m-auto text-center mx-5"
                                                    @change="calculateTotalCredits">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- <p class="lead text-center m-auto fs-5 fw-bold mt-5 mb-4">Courses For Semester Two</p>

                                <table class="w-100 table-bordered ">

                                    <thead>
                                        <tr class="text-white bg-[#243673] m-auto text-center fs-4">
                                            <th scope="col" style="width: 10%;">No</th>
                                            <th scope="col" style="width: 45%;">Subject</th>
                                            <th scope="col" style="width: 15%;">Semester</th>
                                            <th scope="col" style="width: 15%;">Credit</th>
                                            <th scope="col" style="width: 15%;">Selected</th>
                                        </tr>
                                    </thead>


                                    <tbody v-for="(course, index) in courses" :key="course.id">
                                        <tr v-if="course.semester == '2'">
                                            <th scope="row" class="text-center" style="width: 10%;">{{ index + 1 }}</th>
                                            <td class="lead fs-6 mx-3" style="width: 45%;">&emsp;{{ course.name }}</td>
                                            <td class="text-center" style="width: 15%;">{{ course.semester }}</td>
                                            <td class="text-center fw-bold" style="width: 15%;">{{ course.credit }}</td>

                                            <td class="text-center" style="width: 15%;">
                                                <div v-if="selectedCourses.includes(course.id)">
                                                    <div class="">
                                                        <span class="text-center m-auto mx-5"> <i class='bx bx-check'
                                                                style='color:#243376'></i></span>
                                                    </div>
                                                </div>
                                                <input v-else type="checkbox" v-model="newCourses" multiple
                                                    :value="course.id"
                                                    class="text-success rounded-5 m-auto text-center mx-5"
                                                    @change="calculateTotalCredits">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> -->


                                <button type="submit" data-bs-toggle="modal" data-bs-target="#enrollmentModal"
                                    class="btn btn-success lead mt-5 fs-5 fw-bold dashboard_textBox h-12"
                                    style="margin-left: 80%; width: 120px;">Request</button>


                                <div class="modal fade" id="enrollmentModal" tabindex="-2"
                                    aria-labelledby="enrollmentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h1 class="modal-title lead text-center fs-3 m-auto text-muted ">Course
                                                    Enrollment</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div v-if="enrollmentMessage" class="modal-body lead m-auto text-center fs-6 ">
                                                {{ enrollmentMessage }} &#128142;

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success lead"
                                                    data-bs-dismiss="modal">Got
                                                    it!!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
</style>