
<script>
import axios from 'axios';
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

import "bootstrap/dist/css/bootstrap.min.css";

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
            totalApproved: 0,
            totalApprovedSOne: 0,
            totalApprovedSTwo: 0,
            activeNavItem: null,
            isChecked: true,

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

                    // this.totalApprovedSOne = 0;
                    // this.totalApprovedSTwo = 0;
                    this.enrolledCourses.forEach(course => {
                        if (course.status === 'approved') {
                            this.totalApproved += parseFloat(course.course.credit);

                            if (course.course.semester === '1') {
                                this.totalApprovedSOne += parseFloat(course.course.credit);
                            } else if (course.course.semester === '2') {
                                this.totalApprovedSTwo += parseFloat(course.course.credit);
                            }

                        }

                    });
                    // console.log('total', this.totalApprovedSOne);
                    // console.log('sone', this.totalApprovedSTwo);
                    // console.log('stwo', this.totalApproved);

                })

                .catch(error => {
                    console.error('Error fetching courses enrollment:', error);
                });
        },

        exportToPdf() {

            const divToPrint = this.$refs.divToPrint; // Get the reference to the element you want to convert to PDF

            // Use html2canvas to capture the element as an image
            html2canvas(divToPrint).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');

                // Create a PDF document
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210; // A4 width in mm (210mm)
                const pageHeight = 297; // A4 height in mm (297mm)
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                // let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);

                // Save the PDF
                pdf.save('learning_agreement.pdf');
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
                                            :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'approved' }]">
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
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Course Enrollment: <span class="text-[#243673]">
                                    Approved</span> </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead  fs-6 fw-bold cursor-pointer">
                                    Dashboard >
                                </span>
                                <span
                                    @click="$router.push({ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">Course Enrollment</span>

                                > Course Approved
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

                    <div class="m-auto mt-4 h-auto border-4 rounded-4 py-5 border-[#243673]"
                        style="width: 85%; z-index: 0;">

                        <button @click="exportToPdf()" class="btn btn-success ml-[900px]">Generate PDF</button>

                        <div ref="divToPrint">

                            <div class="mx-5">
                                <p class="lead fs-5 fw-bold">Institute of Technology of Cambodia</p>
                                <p class="lead fs-5 fw-bold">Graduate School</p>

                            </div>

                            <div class="text-center m-auto">

                                <p class="lead fs-3 fw-bold">Learning Agreement</p>
                                <p class="lead fs-5 fw-bold">Master's Program : {{ programs.name }}</p>
                                <div class="d-flex text-center justify-content-around mx-5">
                                    <p class="fs-5 fw-bold">Duration of program :
                                        <input type="checkbox" v-model="isChecked" class="text-dark">
                                        <span class="lead mx-2 fs-5">one year</span>
                                        <input type="checkbox" class="text-dark fs-5 mx-2">
                                        <span class="lead mx-2 fs-5">two years</span>
                                    </p>
                                    <p class="fs-5 fw-bold">Academic year(s) <span class="lead mx-2 fs-5">{{
                                        student_details.academic_year }}</span>

                                    </p>
                                </div>

                                <div class="d-flex text-center justify-content-around mx-4">
                                    <p class="fs-5 fw-bold">Student's ID : <span class="lead mx-2 fs-5">{{
                                        student_details.unique_id }}</span></p>
                                    <p class="fs-5 fw-bold">First name : <span class="lead mx-2 fs-5">{{ user.first_name
                                    }}</span></p>
                                    <p class="fs-5 fw-bold">Last name : <span class="lead mx-2 fs-5">{{ user.last_name
                                    }}</span>
                                    </p>

                                </div>

                                <div class="d-flex tex-center justify-content-start mx-5">
                                    <p class="fs-5 fw-bold mx-5">Date of Birth : <span class="lead mx-2 fs-5">{{ user.dob
                                    }}</span></p>
                                    <p class="fs-5 fw-bold mx-4">Telephone : <span class="lead mx-2 fs-5">{{
                                        user.phone_number
                                    }}</span></p>
                                </div>

                                <div class="mx-5">
                                    <p class="fs-5 fw-bold mx-5 text-start">Email : <span class="lead mx-2 fs-4">{{
                                        user.email
                                    }}</span></p>

                                </div>

                                <div class="lead fs-6 dashboard_textBox  mb-1" style="width: 360px; margin-left: 60%;">

                                    <div>
                                        <p class=" lead text-center fw-bold fs-5">

                                            Total number of Your credits
                                            <span class="lead fw-bold fs-5 text-success">{{ totalApproved }}</span>
                                            !!
                                        </p>

                                    </div>

                                </div>

                            </div>

                            <div class="m-auto h-auto  " v-if="enrolledCourses.length >= 0">

                                <div class="h-auto m-auto lead  dashboard_textBox " style="width: 90%;">

                                    <p class="lead text-center m-auto fs-5 fw-bold mb-3">Course For Semester One</p>

                                    <table class="w-100 table-bordered border-3 border-[#243673] rounded-3 ">
                                        <thead class="">
                                            <tr class="text-white bg-[#243673] m-auto text-center fs-5">
                                                <th style="width: 5%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>No</p>
                                                </th>
                                                <th style="width: 50%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Subject</p>
                                                </th>
                                                <th style="width: 10%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Credit</p>
                                                </th>
                                                <th style="width: 20%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Tobe Prepared</p>
                                                </th>
                                                <th style="width: 15%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Semester</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody v-for="(course, index) in enrolledCourses" :key="course.id">
                                            <tr v-if="course.status == 'approved' && course.course.semester == 1">
                                                <th scope="row" class=" text-center  fw-bold " style="width: 5%;">
                                                    <p>{{ index + 1 }}</p>
                                                </th>

                                                <td class="lead fs-6  fw-bold" style="width: 50%;">
                                                    <p>&emsp; {{ course.course.name }}</p>
                                                </td>
                                                <td class="lead fs-6  text-center  fw-bold" style="width: 10%;">
                                                    <p>{{
                                                        course.course.credit }}</p>
                                                </td>
                                                <td class="lead fs-6  text-center  fw-bold" style="width: 20%;">
                                                    <p><i class='bx bx-check-square lead fs-4'></i></p>
                                                </td>
                                                <td class="lead fs-6  text-center  fw-bold" style="width: 15%;">
                                                    <p>{{
                                                        course.course.semester }}</p>
                                                </td>

                                            </tr>
                                        </tbody>

                                        <tr class="bg-[#F0F0F0] py-1">
                                            <td colspan="2" class=" border-1 lead fs-5  text-center text-secondary fw-bold"
                                                style="width: 55%;">
                                                <p class="">
                                                    Total number of credits
                                                </p>
                                            </td>
                                            <td class="border-1 lead fs-5 text-center fw-bold text-success"
                                                style="width: 10%;">
                                                <p class="">
                                                    {{ totalApprovedSOne }}
                                                </p>
                                            </td>
                                            <td class="border-1 lead fs-5" style="width: 20%;"></td>
                                            <td class="border-1 lead fs-5" style="width: 15%;"></td>
                                        </tr>

                                    </table>

                                    <p class="lead text-center m-auto fs-5 fw-bold mt-4 mb-3">Course For Semester Two</p>
                                    <table class="w-100 table-bordered  border-3 border-[#243673] rounded-3 ">
                                        <thead class="">
                                            <tr class="text-white bg-[#243673] m-auto text-center fs-5">
                                                <th style="width: 5%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>No</p>
                                                </th>
                                                <th style="width: 50%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Subject</p>
                                                </th>
                                                <th style="width: 10%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Credit</p>
                                                </th>
                                                <th style="width: 20%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Tobe Prepared</p>
                                                </th>
                                                <th style="width: 15%;" class=" lead text-center fs-5 fw-bold">
                                                    <p>Semester</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody v-for="(course, index) in enrolledCourses" :key="course.id">
                                            <tr v-if="course.status == 'approved' && course.course.semester == '2'">
                                                <th scope="row" class=" text-center  fw-bold " style="width: 5%;">
                                                    <p>{{ index + 1 }}</p>
                                                </th>

                                                <td class="lead fs-6  fw-bold" style="width: 50%;">
                                                    <p>&emsp; {{ course.course.name }}</p>
                                                </td>
                                                <td class="lead fs-6  text-center  fw-bold" style="width: 10%;">
                                                    <p>{{
                                                        course.course.credit }}</p>
                                                </td>
                                                <td class="lead fs-6  text-center  fw-bold" style="width: 20%;">
                                                    <p><i class='bx bx-check-square lead fs-4'></i></p>
                                                </td>
                                                <td class="lead fs-6  text-center  fw-bold" style="width: 15%;">
                                                    <p>{{
                                                        course.course.semester }}</p>
                                                </td>

                                            </tr>

                                        </tbody>

                                        <tr class="bg-[#F0F0F0] py-1">
                                            <td colspan="2" class=" border-1 lead fs-5  text-center text-secondary fw-bold"
                                                style="width: 55%;">
                                                <p class="">
                                                    Total number of credits
                                                </p>
                                            </td>
                                            <td class="border-1 lead fs-5 text-center fw-bold text-success"
                                                style="width: 10%;">
                                                <p class="">
                                                    {{ totalApprovedSTwo }}
                                                </p>
                                            </td>
                                            <td class="border-1 lead fs-5" style="width: 20%;"></td>
                                            <td class="border-1 lead fs-5" style="width: 15%;"></td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="lead fs-6 dashboard_textBox mt-4" style="width: 360px; margin-left: 60%;">

                            <a href="" class="text-dark text-decoration-none lead">
                                <router-link
                                    :to="{ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } }"
                                    class="text-decoration-none text-dark lead">
                                    click <span class="text-success text-decoration-underline lead">here</span> if want
                                    to enroll more courses!!
                                </router-link>
                            </a>

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

