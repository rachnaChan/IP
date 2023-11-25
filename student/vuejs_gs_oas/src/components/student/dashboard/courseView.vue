
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            programs: [],
            courses: [],
            student_details: null,
            deadline: "",
            students:[],
            course: [],
            selectedProgram: null,
            enrolledCourses: [],
            currentDateTime: null,
            totalCourseSOne: 0,
            totalCourseSTwo: 0,

            pendingCredits: 0,
            approvedCredits: 0,
            rejectedCredits: 0,
            activeNavItem: null,
            studentDetailCount:0,
        };
    },
    mounted() {
        this.fetchInfoUser();
        this.fetchEnrolledCourses();
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
                const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
                return imageAuto;
            }
        },

        getProgramsImageURL(programs) {
            if (programs.image) {
                const imageUrl = `http://localhost:8000/storage/${programs.image}`;
                return imageUrl;
            } else {
                const imageAuto =
                    'https://gic.itc.edu.kh/storage/field-studies/August2021/Master%20of%20Engineering-1.png';
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
                    this.user = response3.data[0];
                    this.programs = response3.data[0];
                    this.courses = response3.data;

                    this.fetchUnavailableCourse(this.programs.id);
                    this.fetchCourseUser(this.programs.id);
                    this.fetchMember(this.programs.id);

                    this.totalCourse = response3.data.length;


                    const currentDate = new Date(); // Get the current date

                    this.courses.forEach(course => {
                        const deadlineDate = new Date(course.deadline); // Assuming course has a "deadline" property

                        // Check if the course deadline is in the future
                        if (deadlineDate > currentDate) {
                            if (course.semester === '1') {
                                this.totalCourseSOne++;
                            } else if (course.semester === '2') {
                                this.totalCourseSTwo++;
                            }
                        }
                    });


                    // console.log(this.totalCourseSOne);
                    // console.log(this.totalCourseTwo);
                    // console.log(response3.data);
                    // console.log(this.totalCourse);
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

        //fetch unavailable course
        fetchUnavailableCourse(programId) {
            // const programId = this.$route.params.programId;
            console.log('Program ID:', programId); // Check the programId


            axios.get(`http://localhost:8000/api/student/showProgram/${programId}/unavailableCourses`)
                .then(response3 => {
                    this.courses = response3.data;
                    // this.selectedProgram = this.programs.find(program => program.id === programId);
                    // console.log(this.courses);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });
        },

        fetchCourseUser(programId) {
            // const programId = this.$route.params.programId;
            console.log('Program ID:', programId); // Check the programId


            axios.get(`http://localhost:8000/api/student/showProgram/${programId}/courses`)
                .then(response3 => {
                    this.course = response3.data.all_courses;
                    // console.log(this.course);

                    // this.selectedProgram = this.programs.find(program => program.id === programId);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });

        },

        fetchMember(programId) {

            console.log('Program ID:', programId); // Check the programId
            axios.get(`http://localhost:8000/api/student/showMember/${this.programId}`)
                .then(response => {
                    this.students = response.data.programs;
                    this.studentDetailCount = response.data.studentDetailCount;



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

                            <div
                                :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'programs' }]">
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

                <div class="col custom-scrollbar overflow-scroll  p-0" style="height: 700px; margin-left: 15%;">
                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">{{ programs.name }} </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                                    Dashboard
                                </span> > Program detail
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

                            <i class='bx bx-bell fs-1 mt-3 mx-4  text-[#233673]'></i>

                        </div>

                    </div>

                    <div class="mt-5 py-4"></div>

                    <div class="m-auto mt-2 h-auto border-4 rounded-4 py-4 border-[#243673]" v-if="programs"
                        style="width: 85%; z-index: 1;">

                        <p class="lead mx-4 fs-2 fw-bold text-center text-[#243673]">Master's Degree</p>

                        <div class="d-flex ">
                            <img :src="getUserImageURL(programs)" :alt="programs.name" class="rounded-circle img-fluid mx-5"
                                style="width: 110px; height: 110px;">
                            <div class="mx-2">
                                <p class="lead mt-2 fw-bold fs-4">Institute of Technology of Cambodia</p>
                                <p class="lead fs-5">Phnom Penh, Cambodia</p>

                            </div>

                        </div>

                        <!-- <p class="mx-5 m-auto lead fs-3 fw-bold" >You have members  {{ studentDetailCount }} :</p> -->
                        <p class="mx-5 m-auto lead fs-3 fw-bold">About : </p>


                        <div class=" mt-4 h-auto m-auto" style=" width: 90%;">

                            <div
                                class="w-100 h-auto border-3 rounded-3 border-dashed border-[#243673] mt-1 py-4 m-auto dashboard_textBox ">

                                <p class="lead fs-4 mx-5 ">
                                    &emsp;{{ programs.description }}
                                </p>

                                <p class="lead fs-4 mx-5">
                                    &emsp; In this program, there are a total of <span class="text-[#243676] fw-bold">{{ totalCourse
                                    }}</span> courses. Semester I comprises <span class="text-[#243676] fw-bold">
                                        {{ totalCourseSOne }}</span> courses, while semester II includes <span
                                        class="text-[#243676] fw-bold">{{ totalCourseSTwo }}</span> courses.
                                </p>

                                <p class="lead fs-4 mx-5">
                                    &emsp; Additionally, this program offers <span class="text-[#243676] fw-bold">{{ totalCourse -
                                        (totalCourseSOne + totalCourseSTwo) }}</span> courses that are not available for
                                    enrollment. However, there are still <span class="text-[#243676] fw-bold">{{ totalCourseSOne +
                                        totalCourseSTwo }}</span> courses open for enrollment.
                                </p>

                                <div class="w-90 d-flex justify-content-between m-auto py-2 mt-4">

                                    <table class="table mt-0 mx-2 w-50">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col" class="text-center lead fw-bold fs-4">Available Courses
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="">

                                            <th scope="row" class="text-center fs-5">
                                               

                                                <li class="lead fs-5 text-decoration-none" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModals">
                                                    click <span class="text-success text-decoration-underline">here</span>
                                                    to see availble course!!
                                                </li>

                                            </th>

                                            <div class="modal fade rounded-3" id="exampleModals" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl ">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center m-auto fs-3 fw-bold lead "
                                                                id="exampleModalLabel">Available Course Information
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="w-100 table-bordered " v-if="courses.length >= 0">


                                                                <thead>
                                                                    <tr
                                                                        class="text-white bg-[#243673] m-auto text-center fs-4">
                                                                        <th style="width: 5%;">No</th>
                                                                        <th style="width: 35%;">Subject</th>
                                                                        <th style="width: 10%;">Semester</th>
                                                                        <th style="width: 10%;">Credit</th>
                                                                        <th style="width: 30%;">Description</th>
                                                                        <th style="width: 10%;">Deadline</th>
                                                                    </tr>
                                                                </thead>


                                                                <tbody v-for="(courses, index) in course" :key="courses.id">
                                                                    <tr>
                                                                        <th scope="row" class="text-center"
                                                                            style="width: 5%;">{{ index + 1 }}</th>
                                                                        <td class="lead fs-6 mx-3 fw-bold"
                                                                            style="width: 35%;">
                                                                            &emsp;{{ courses.name }}</td>
                                                                        <td class="text-center" style="width: 10%;">{{
                                                                            courses.semester }}</td>
                                                                        <td class="text-center fw-bold" style="width: 10%;">
                                                                            {{ courses.credit }}</td>
                                                                        <td class="text-center fw-bold" style="width: 30%;">
                                                                            {{ courses.description }}</td>
                                                                        <td class="text-center fw-bold" style="width: 10%;">
                                                                            {{ courses.deadline }}</td>


                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </tbody>
                                    </table>

                                    <table class="table mt-0 mx-2 w-50">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col" class="text-center lead fw-bold fs-4">UnAvailable Courses
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="">

                                            <th scope="row" class="text-center border-0 fs-5">

                                                <li class="lead fs-5 text-decoration-none" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    click <span class="text-success text-decoration-underline">here</span>
                                                    to see unavailble course!!
                                                </li>

                                            </th>

                                            <div class="modal fade rounded-3" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl ">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center m-auto fs-3 fw-bold lead "
                                                                id="exampleModalLabel">Unavailable Course Information
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="w-100 table-bordered " v-if="courses.length >= 0">


                                                                <thead>
                                                                    <tr
                                                                        class="text-white bg-[#243673] m-auto text-center fs-4">
                                                                        <th style="width: 5%;">No</th>
                                                                        <th style="width: 35%;">Subject</th>
                                                                        <th style="width: 10%;">Semester</th>
                                                                        <th style="width: 10%;">Credit</th>
                                                                        <th style="width: 30%;">Description</th>
                                                                        <th style="width: 10%;">Deadline</th>
                                                                    </tr>
                                                                </thead>


                                                                <tbody v-for="(course, index) in courses" :key="course.id">
                                                                    <tr>
                                                                        <th scope="row" class="text-center"
                                                                            style="width: 5%;">{{ index + 1 }}</th>
                                                                        <td class="lead fs-6 mx-3 fw-bold"
                                                                            style="width: 35%;">
                                                                            &emsp;{{ course.name }}</td>
                                                                        <td class="text-center" style="width: 10%;">{{
                                                                            course.semester }}</td>
                                                                        <td class="text-center fw-bold" style="width: 10%;">
                                                                            {{ course.credit }}</td>
                                                                        <td class="text-center fw-bold" style="width: 30%;">
                                                                            {{ course.description }}</td>
                                                                        <td class="text-center fw-bold" style="width: 10%;">
                                                                            {{ course.deadline }}</td>


                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="d-flex m-auto justify-content-around text-center">

                                <div class="mt-4 dashboard_textBox ">
                                    <button @click="$router.push({ name: 'studentDashboard' })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-10 w-25 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>

                                <div class="mt-4 dashboard_textBox ">

                                    <button v-if="pendingCredits > 0"
                                        class="cursor-none bg-warning dashboard_textBox positon-relative rounded-2 border-1 h-10 fw-bold ">
                                        You have a pending
                                        Courses!! </button>


                                    <button v-if="(pendingCredits == 0) && (approvedCredits >= 0)"
                                        @click="$router.push({ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } })"
                                        class="bg-success text-white dashboard_textBox positon-relative rounded-2 border-1 h-10 fw-bold mb-2 ">
                                        click here to <span class="text-dark">enroll</span> the courses!!

                                    </button>

                                    <button v-if="approvedCredits > 0"
                                        class="bg-success text-white dashboard_textBox positon-relative rounded-2 border-1 h-10 fw-bold "
                                        @click="$router.push({ name: 'studentMyCourse', params: { userId: user.student_id } })">
                                        click here to <span class="text-dark">see </span> your courses!!

                                    </button>

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
}</style>
