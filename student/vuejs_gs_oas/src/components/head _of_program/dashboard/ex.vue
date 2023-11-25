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

        };
    },
    mounted() {
        this.fetchLoggedInUser();
        this.fetchInfoUser();
        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000);
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

            console.log(student.courses);
            console.log(student.enrollments);


            this.showModal = true;
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
                return hasPendingStatus ? 'View' : 'Done';
            }
            return 'Done'; // Default to 'Done' if there are no enrollments
        },

        getButtonColor(student) {
            // Check if there is at least one "pending" status in enrollments
            if (student && student.enrollments) {
                const hasPendingStatus = student.enrollments.some(enrollment => enrollment.status === 'pending');
                return hasPendingStatus ? 'btn-success' : 'btn-secondary';
            }
            return 'btn-secondary'; // Default to 'btn-secondary' if there are no enrollments
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
                    <h1 class="text-[#243673] font-bold text-[24px] text-center mb-3">Available Courses</h1>
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
                                    <td class="px-6 py-4"><button type="button" class="btn btn-success"
                                            data-bs-toggle="modal" data-bs-target="#viewinfo"
                                            @click="viewStudentInfo(student)">
                                            View Info
                                        </button></td>
                                    <td class="px-6 py-4">
                                        <button type="button" :class="['btn', getButtonColor(student)]"
                                            @click="viewCourses(student)" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            {{ getButtonText(student) }}
                                        </button>
                                    </td>

                                    <div class="modal" v-if="showStudentInfoModal" id="viewinfo"
                                        :key="student.studentInfo.id" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Student Information</h5>
                                                    <button type="button" class="close" @click="closeStudentInfoModal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Display the student's information here -->
                                                    <p>{{ student.studentInfo.first_name }}</p>
                                                    <!-- <p>Name: {{ studentInfo.first_name }} {{ studentInfo.last_name }}</p>
                                <p>Email: {{ studentInfo.email }}</p> -->
                                                    <!-- Add more fields as needed -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        @click="closeStudentInfoModal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered ">
                        <div class="modal-content" v-if="showModal">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title">Enrollment </h5> -->
                            </div>
                            <div class="modal-body">
                                <div class="flex justify-center">
                                    <button @click="exportToPdf()" class="btn btn-success">Generate To PDF File</button>
                                </div>
                                <div ref="divToPrint">
                                    <body class="bg-gray-100 p-8">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-xl mx-auto custom-font">
        <!-- Institute Header -->
        <div class="text-center">
            <p class="text-lg font-bold">Institute of Technology of Cambodia</p>
            <p class="text-sm">Graduate School</p>
        </div>

        <!-- Learning Agreement Header -->
        <div class="text-center mt-4">
            <h1 class="text-xl font-bold">Learning Agreement</h1>
            <p class="text-sm font-bold">Master’s program: Computer Science (M-ECS)</p>
            <div class="mt-2">
                <p class="text-sm">
                    Duration of program:
                    <input type="checkbox" class="form-checkbox ml-1" id="one-year">
                    <label for="one-year" class="mr-2">one year</label>
                    <input type="checkbox" class="form-checkbox ml-1" id="two-years">
                    <label for="two-years">two years</label>
                </p>
                <p class="text-sm">Academic year(s) 2021… to 2022…</p>
            </div>
        </div>

        <!-- Student Information -->
        <div class="mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-bold">Student’s ID: ....</p>
                    <p class="text-sm font-bold">First name: ...</p>
                    <p class="text-sm font-bold">Surname: ...</p>
                    <p class="text-sm font-bold">Date of birth: ...</p>
                    <p class="text-sm font-bold">Place of birth: ...</p>
                </div>
                <div>
                    <p class="text-sm font-bold">Telephone: ...</p>
                    <p class="text-sm font-bold">Address: ...</p>
                    <p class="text-sm font-bold">Email: ...</p>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="mt-4 w-full text-center text-sm border-collapse border border-gray-800">
            <thead>
                <tr>
                    <th class="w-1/12 border border-black">No</th>
                    <th class="w-6/12 border border-black">Subject</th>
                    <th class="w-1/12 border border-black">Credit</th>
                    <th class="w-2/12 border border-black">To be</th>
                    <th class="w-2/12 border border-black">Time</th>
                </tr>
            </thead>
            <tbody>
                <!-- Repeat these rows as needed -->
                <tr>
                    <td class="border border-black">1</td>
                    <td class="border text-left pl-2 border-black">Course Name</td>
                    <td class="border border-black">3</td>
                    <td class="border border-black">
                        <input type="checkbox" class="form-checkbox mx-auto">
                    </td>
                    <td class="border border-black">Semester 1</td>
                </tr>
                <!-- End of repeated rows -->
            </tbody>
        </table>

        <!-- Total Credits -->
        <div class="mt-4">
            <p class="text-sm font-bold">Name: Total Number of Credits</p>
        </div>

        <!-- Supervisor's Section -->
        <div class="grid grid-cols-2 mt-4">
            <div>
                <p class="text-sm">Date: ........................</p>
                <p class="text-sm">Name and Signature of Supervisor</p>
            </div>
            <div>
                <p class="text-sm text-right">Date: ........................</p>
                <p class="text-sm text-right">Name and Signature of Supervisor</p>
            </div>
        </div>

        <!-- Approval Section -->
        <div class="mt-8">
            <p class="text-sm">Seen and approved by</p>
            <div class="grid grid-cols-2 mt-2">
                <div>
                    <p class="text-sm">Director of Graduate School</p>
                </div>
                <div class="text-right">
                    <p class="text-sm">Date: ........................</p>
                    <p class="text-sm">Signature of Coordinator of Master’s Program of M-ECS</p>
                </div>
            </div>
        </div>

        <!-- Names -->
        <div class="grid grid-cols-2 mt-4">
            <div>
                <p class="text-sm">Dr. Sim Tepmony</p>
            </div>
            <div class="text-right">
                <p class="text-sm">Mr. Heng Rathpisey</p>
            </div>
        </div>
    </div>
                                    </body>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button> -->
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
}</style>