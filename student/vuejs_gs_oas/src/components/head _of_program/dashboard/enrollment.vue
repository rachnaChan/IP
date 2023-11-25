<script>
import axios from 'axios'
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
import "bootstrap/dist/css/bootstrap.min.css";

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
            selectedStudent: null,
            showModal: false,
            selectedCourses: [],
            selectedEnrollments: [],
            status: '',
            approved: '',
            rejected: '',
            userId: null,
            selectedStudentInfo: null,
            popUp: false,
            totalCredits: 0,
            totalCreditsSemesterOne: 0,
            totalCreditsSemesterTwo: 0,


        };
    },
    mounted() {
        this.fetchLoggedInUser();
        this.fetchInfoUser();
        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000);
    },
    computed: {
        totalCredits() {
            return this.selectedStudent.courses.reduce((sum, course) => sum + course.credit, 0);
        },
        totalCreditsPerSemester() {
            const semesters = [...new Set(this.selectedStudent.courses.map(course => course.semester))];
            const totalCreditsPerSemester = {};

            semesters.forEach(semester => {
                const semesterCourses = this.selectedStudent.courses.filter(course => course.semester === semester);
                totalCreditsPerSemester[semester] = semesterCourses.reduce((sum, course) => sum + course.credit, 0);
            });

            return totalCreditsPerSemester;
        },
        PanddingCredits() {
            const approvedCourses = this.selectedStudent.courses.filter(course =>
                this.selectedStudent.enrollments.some((enrollment, index) =>
                    enrollment.status === 'approved' && index === this.selectedStudent.courses.indexOf(course)
                )
            );
            return approvedCourses.reduce((sum, course) => sum + course.credit, 0);
        },
        PanddingSemester() {
            const semesters = [...new Set(this.selectedStudent.courses.map(course => course.semester))];
            const totalCreditsPerSemester = {};

            semesters.forEach(semester => {
                const semesterCourses = this.selectedStudent.courses.filter(
                    course =>
                        course.semester === semester &&
                        this.selectedStudent.enrollments.some((enrollment, index) =>
                            enrollment.status === 'approved' && index === this.selectedStudent.courses.indexOf(course)
                        )
                );
                totalCreditsPerSemester[semester] = semesterCourses.reduce((sum, course) => sum + course.credit, 0);
            });

            return totalCreditsPerSemester;
        },
    },

    methods: {
        setUserID() {
            this.userId = this.userId;
        },
        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/info');
                console.log('Response Data:', response.data); // Add this line
                this.user = response.data;
                // Store the user's ID in userId
                this.userId = this.user.id;

                // Call the fetchInfoUser method to use the user's ID
                this.fetchInfoUser();
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
        },

        async fetchInfoUser() {
            // if (!this.userId) {
            //     console.error('User ID is not available.');
            //     return;
            // }

            axios.get(`http://localhost:8000/api/head/info/${this.userId}`)
                .then(response => {
                    this.students = response.data;
                    this.programs = response.data[0];
                    console.log(this.students);

                })

                .catch(error => {
                    console.error('Error fetching info:', error);
                });
        },

        async viewStudentInfo(student) {
            try {
                // Fetch the student's information based on their ID
                const response = await axios.get(`http://localhost:8000/api/student/info/${student.id}`);
                const studentInfo = response.data; // Assuming the API returns the student's information

                // Set the selected student's information
                this.selectedStudentInfo = studentInfo;

                // Show a modal or update the UI to display the student info
                this.showStudentInfoModal = true;
            } catch (error) {
                console.error('Error fetching student info:', error);
            }
        },
        viewCourses(student) {

            this.selectedStudent = student;
            this.selectedCourses = student.courses;
            this.selectedPrograms = student.programs;
            this.selectedEnrollments = student.enrollments;
            this.popUp = true;

        },

        closeModal() {
            this.selectedStudent = null;
            this.selectedCourses = [];
            this.showModal = false;
        },


        viewCoursePending() {
            if (this.selectedStudent) {

            }
        },

        updateStatus(cIndex, newStatus) {
            const isConfirmed = window.confirm(`Are you sure you want to update the status to "${newStatus}"?`);

            if (!isConfirmed) {
                // If the user cancels the confirmation, do nothing
                return;
            }

            // Get the selected student and the course for which you want to update the status
            const selectedStudent = this.selectedStudent;
            const selectedCourse = selectedStudent.courses[cIndex];

            // Prepare the data to send to your backend
            const requestData = {
                studentId: selectedStudent.studentInfo.id,
                courseId: selectedCourse.id,
                newStatus: newStatus,
            };

            // Make an HTTP request to update the status
            axios.post('http://localhost:8000/api/head/setEnrollment', requestData)
                .then((response) => {
                    // Assuming your backend returns a success response
                    if (response.data.success) {
                        // Update the status locally in the selectedStudent object
                        selectedStudent.enrollments[cIndex].status = newStatus;
                    } else {
                        console.error('Failed to update status:', response.data.error);
                    }
                })
                .catch((error) => {
                    console.error('Error updating status:', error);
                });
        },

        getButtonText(student) {
            // Check if there is at least one "pending" status in enrollments
            if (student && student.enrollments) {
                const hasPendingStatus = student.enrollments.some(enrollment => enrollment.status === 'pending');
                return hasPendingStatus ? 'Pending' : 'Checked';
            }
            return 'Checked'; // Default to 'Done' if there are no enrollments
        },

        getButtonColor(student) {
            // Check if there is at least one "pending" status in enrollments
            if (student && student.enrollments) {
                const hasPendingStatus = student.enrollments.some(enrollment => enrollment.status === 'pending');
                return hasPendingStatus ? 'btn-warning' : 'btn-success';
            }
            return 'btn-warning'; // Default to 'btn-warning' if there are no enrollments
        },
        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                return imageUrl;
            } else {
                // If the user has no image, you can provide a default image URL
                return 'https://example.com/default-image.png'; // Replace with your default image URL
            }
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

                // Construct the filename with the student's name
                const studentName = this.selectedStudent.studentInfo.first_name + '_' + this.selectedStudent.studentInfo.last_name;
                const filename = `${studentName}_Learning_Agreement.pdf`;

                // Add the image to the PDF
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight, pageHeight);

                // Save the PDF with the constructed filename
                pdf.save(filename);
            });
        },


    },


};

</script>
<template>
    <div class="w-full min-h-screen border-2 border-black border-solid" v-if="user">
        <div class="flex">
            <div class="bg-[#243673] min-h-screen min-w-[290px] fixed">
                <div class="flex px-[85px] py-[25px]">
                    <img class="w-[60px]" src="../../../assets/img/GS_logo.png" alt="">
                    <img class="w-[60px]" src="../../../assets/img/ITC_logo.png" alt="">
                </div>

                <div class="mt-[15px]">
                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/dashboard" class="px-[30px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-house text-[22px] mr-[13px]"></i>
                            Dashboard
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/students" class="px-[30px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-users text-[22px] mr-[13px]"></i>
                            Students
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/enrollment"
                            class="pl-[30px] pr-[61px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-user-check text-[20px] mr-[13px]"></i>
                            Enrollment
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/program"
                            class="pl-[30px] pr-[116px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-book text-[25px] mr-[13px]"></i>
                            Program Information
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/profile"
                            class="pl-[30px] pr-[129px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-gear text-[25px] mr-[13px]"></i>
                            Profile
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/events"
                            class="pl-[30px] pr-[62px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="bx bxs-calendar-event text-[25px] mr-[13px]"></i>
                            Events
                        </router-link>
                    </div>
                </div>

                <div>
                    <button @click="logout"
                        class="text-[15px] font-medium text-white flex items-center absolute bottom-10 left-[30px]
                                                hover:bg-[#E2F2FF] hover:text-[#243673] hover:pl-[30px] hover:pr-[129px] hover:py-[10px] hover:rounded-tr-[10px] hover:rounded-br-[10px] hover:left-0 hover:bottom-[30px]">
                        <i class="fa-solid fa-arrow-right-from-bracket text-[23px] mr-[13px]"></i>
                        Logout
                    </button>
                </div>
            </div>
            <div class="all w-[943px] flex-1 ml-[330px] p-4">
                <div class="flex justify-between px-[5px] mt-4">
                    <div>
                        <h1 class="text-[#243673] font-bold text-[24px]">Student Enrollment</h1>
                        <!-- <router-link to="/head/program">
                        <small class="text-[#243673] font-medium">Dashboard </small>
                    </router-link> -->
                        <small class="text-[#243673] font-medium">Enrollment</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-[50px] h-[50px] mx-auto rounded-full" :src="getUserImageURL(user)"
                                :alt="user.name">
                        </div>

                    </div>
                </div>
                <div class="container mt-3">
                    <h1 class="text-[#243673] font-bold text-[24px] text-center mb-4 mt-3">List Of Students Enrolled</h1>
                    <!-- Table for Courses -->
                    <div class="overflow-x-auto w-full">

                        <table v-if="students.length >= 0"
                            class="mx-auto max-w-4xl h-1 w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                            <thead class="bg-[#243673]">
                                <tr class="text-white text-left">
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> No </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Profile </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Student Name </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Informatin </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student, index) in students" :key="index" class="divide-y divide-gray-200">
                                    <td class="px-6 py-4 ">{{ index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space">
                                            <div class="inline-flex "> <img class="w-[50px] h-[50px] mx-auto rounded-circle"
                                                    :src="getUserImageURL(student.studentInfo)" alt="Student Image"> </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">&emsp;{{
                                        student.studentInfo.first_name }} {{ student.studentInfo.last_name }}</td>
                                    <td class="px-6 py-4">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal0"
                                            :class="['btn', 'm-auto', 'mx-3', 'btn-primary']" @click="viewCourses(student)">
                                            View
                                        </button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            :class="['btn', 'm-auto', 'mx-3', getButtonColor(student)]"
                                            @click="viewCourses(student)">
                                            {{ getButtonText(student) }}
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade font-times" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" v-if="popUp">
                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="flex justify-center">
                                    <button @click="exportToPdf()" class="btn btn-success">Generate To
                                        PDF File</button>
                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div ref="divToPrint">

                                    <div class="mx-5">
                                        <p class="lead fs-5 fw-bold">Institute of Technology of Cambodia</p>
                                        <p class="lead fs-5 fw-bold">Graduate School</p>

                                    </div>

                                    <div class="text-center m-auto">
                                        <p class="lead fs-3 fw-bold">Learning Agreement</p>
                                        <p class="lead fs-5 fw-bold">Program : {{ selectedStudent.programs.name }}</p>

                                        <div class="flex mx-5">
                                            <div class="w-[60%] text-start">
                                                <p class="fs-5 mx-5">Duration of program :
                                                    <input type="checkbox" v-model="isChecked" class="text-dark">
                                                    <span class="lead mx-1 fs-5">one year</span>
                                                    <input type="checkbox" class="text-dark fs-5">
                                                    <span class="lead mx-1 fs-5">two years</span>
                                                </p>
                                            </div>
                                            <div class="w-[40%]  text-start">
                                                <p class="fs-5 ">Academic year(s) <span class="lead mx-2 fs-5">
                                                        2023-2024</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex mx-5">
                                            <div class="w-[60%] text-start">
                                                <p class="fs-5 d mx-5">First Name : <span class="lead mx-2 fs-5">{{
                                                    selectedStudent.studentInfo.first_name }}</span></p>
                                            </div>
                                            <div class="w-[40%]  text-start">
                                                <p class="fs-5  ">Last Name : <span class="lead mx-2 fs-5">{{
                                                    selectedStudent.studentInfo.last_name }}</span></p>
                                            </div>
                                        </div>

                                        <div class="flex mx-5">
                                            <div class="w-[60%] text-start">
                                                <p class="fs-5  mx-5">Student's ID : <span
                                                        class="lead mx-2 fs-5">m202301</span></p>
                                            </div>
                                            <div class="w-[40%]  text-start">
                                                <p class="fs-5 ">Email : <span class="lead mx-2 fs-5">{{
                                                    selectedStudent.studentInfo.email }}</span></p>
                                            </div>
                                        </div>

                                        <div class="flex mx-5">
                                            <div class="w-[60%] text-start">
                                                <p class="fs-5  mx-5">Date of Birth : <span class="lead mx-2 fs-5">{{
                                                    selectedStudent.studentInfo.dob }}</span></p>
                                            </div>
                                            <div class="w-[40%]  text-start">
                                                <p class="fs-5 ">Telephone : <span class="lead mx-2 fs-5">{{
                                                    selectedStudent.studentInfo.phone_number }}</span></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center my-5">
                                        <p class="lead text-center m-auto fs-5 fw-bold mb-3">Course For Semester One</p>
                                    </div>
                                    <table
                                        class='mx-auto max-w-4xl h-1 w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                        <thead class="bg-[#243673]">
                                            <tr class="text-white text-left w-100">
                                                <th class="font-semibold text-sm uppercase px-6 py-3 w-10"> No </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 w-50"> Course Name</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-10">
                                                    Credit</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-30">Tobe
                                                    Prepared </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-10">
                                                    Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="(course, cIndex,) in selectedStudent.courses" :key="cIndex"
                                            class="divide-y divide-gray-200">
                                            <tr
                                                v-if="selectedStudent.enrollments[cIndex].status == 'approved' && selectedStudent.courses[cIndex].semester == 1">
                                                <td class="px-6 py-4 text-center">{{ cIndex + 1 }}</td>
                                                <td class="px-6 py-4 text-center"> &emsp;{{ course.name }}</td>
                                                <td class="px-6 py-4 text-center"> &emsp;{{ course.credit }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    <p class="lead text-center text-dark m-auto fs-6 fw-bold"><i
                                                            class='bx bx-check-square lead fs-4'></i></p>
                                                </td>
                                                <td class="px-6 py-4 text-center">{{ course.semester }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="text-center my-5">
                                        <p class="lead text-center m-auto fs-5 fw-bold mb-3">Course For Semester Two</p>
                                    </div>
                                    <table
                                        class='mx-auto max-w-4xl h-1 w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                        <thead class="bg-[#243673]">
                                            <tr class="text-white text-left w-100">
                                                <th class="font-semibold text-sm uppercase px-6 py-3 w-10"> No </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 w-50"> Course Name</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-10">
                                                    Credit</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-30">Tobe
                                                    Prepared </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-10">
                                                    Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="(course, cIndex) in selectedStudent.courses" :key="cIndex"
                                            class="divide-y divide-gray-200">
                                            <tr v-if="selectedStudent.enrollments[cIndex].status == 'approved' && selectedStudent.courses[cIndex].semester == 2"
                                                :key="cIndex">
                                                <td class="px-6 py-4 text-center">{{ cIndex + 1 }}</td>
                                                <td class="px-6 py-4 text-center"> &emsp;{{ course.name }}</td>
                                                <td class="px-6 py-4 text-center"> &emsp;{{ course.credit }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    <p class="lead text-center text-dark m-auto fs-6 fw-bold"><i
                                                            class='bx bx-check-square lead fs-4'></i></p>
                                                </td>
                                                <td class="px-6 py-4 text-center">{{ course.semester }}</td>
                                            </tr>
                                        </tbody>
                                        <tr class="divide-y divide-gray-200">
                                                <td class="px-6 py-4 text-center"></td>
                                                <td class="px-6 py-4 text-blue-900 text-center"> Total Credits per Semester
                                                </td>
                                                <td class="px-10 py-4 text-blue-900"
                                                    v-for="(credits, semester) in PanddingSemester" :key="semester">
                                                    Semester {{ semester }}: {{ credits }}
                                                </td>
                                                <td class="px-6 py-4"></td>
                                        </tr>
                                        <tr class="divide-y divide-gray-200">
                                            <td class="px-6 py-4 text-center"></td>
                                            <td class="px-6 py-4 text-center text-blue-900"> Total Credits: </td>
                                            <td class="px-10 py-4 text-center text-blue-900">{{ PanddingCredits }}</td>
                                            <td class="px-6 py-4 text-center"></td>
                                            <td class="px-6 py-4 text-center"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" v-if="popUp">
                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                        <div class="modal-content">
                            <!-- <div class="modal-header">
                                <div class="flex justify-center">
                                    <button @click="exportToPdf()" class="btn btn-success">Generate To
                                        PDF File</button>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div> -->
                            <div class="modal-body">
                                <!-- <div ref="divToPrint"> -->
                                <!-- Table for Courses -->
                                <div class='overflow-x-auto w-full'>
                                    <h1 class=" font-bold text-[24px] text-center mt-4 mb-4">Courses that <span
                                            class="text-[#243673]">{{ selectedStudent.studentInfo.first_name }} {{
                                                selectedStudent.studentInfo.last_name }}</span> has been enrolle</h1>
                                    <table
                                        class='mx-auto max-w-4xl h-1 w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                        <thead class="bg-[#243673]">
                                            <tr class="text-white text-left w-100">
                                                <th class="font-semibold text-sm uppercase px-6 py-3 w-10"> No </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 w-50"> Course Name</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-30">
                                                    Credit </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-10">
                                                    Semester </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-3 text-center w-30">
                                                    Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(course, cIndex) in selectedStudent.courses" :key="cIndex"
                                                class="divide-y divide-gray-200">
                                                <td class="px-6 py-4 text-center">{{ cIndex + 1 }}
                                                </td>
                                                <td class="px-6 py-4"> &emsp;{{ course.name }}</td>
                                                <td class="px-6 py-4"> &emsp;{{ course.credit }}</td>
                                                <td class="px-6 py-4"> &emsp;{{ course.semester }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    <div v-if="selectedStudent.enrollments[cIndex].status">
                                                        <select @change="updateStatus(cIndex, $event.target.value)">
                                                            <option>&emsp;{{ course.status }}</option>
                                                            <option value="Pending">pending</option>
                                                            <option value="Approved">approved</option>
                                                            <option value="Rejected">rejected</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="divide-y divide-gray-200">
                                                <td class="px-6 py-4 text-center"></td>
                                                <td class="px-6 py-4 text-blue-900 text-center"> Total Credits per Semester
                                                </td>
                                                <td class="px-10 py-4 text-blue-900"
                                                    v-for="(credits, semester) in totalCreditsPerSemester" :key="semester">
                                                    Semester {{ semester }}: {{ credits }}
                                                </td>
                                                <td class="px-6 py-4"></td>
                                            </tr>
                                            <tr class="divide-y divide-gray-200">
                                                <td class="px-6 py-4 text-center"></td>
                                                <td class="px-6 py-4 text-blue-900 text-center"> Total Credits </td>
                                                <td class="px-10 py-4 text-blue-900">{{ totalCredits }}</td>
                                                <td class="px-6 py-4"></td>
                                                <td class="px-6 py-4"></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- </div> -->

                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                <button @click="this.$router.go(0)" type="button" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="bg-[#243673] mt-5  text-white" style="height: 35px;">
                    <p class="text-center pt-2">2022 Graduate school-ITC, All Right Reserved </p>
                </div> -->
        </div>
    </div>
</template>
<style lang="scss"  >
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

.font-times {
    font-family: 'times', sans-serif;
    /* Use Times New Roman */
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
</style>