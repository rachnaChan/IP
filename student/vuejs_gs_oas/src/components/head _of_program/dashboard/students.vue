
<script>
import axios from 'axios'
export default {
    data() {
        return {
            user: null,
            programs: [],
            userId: null,
            selectedEnrollments: [],
            selectedStudentUser: null,

        };
    },
    mounted() {
        this.fetchLoggedInUser();
        this.fetchStudentList();
    },
    methods: {
        setUserID() {
            this.userId = this.userId;
        },
        // async fetchLoggedInUser() {
        //     try {
        //         const response = await axios.get('http://localhost:8000/api/head/info');
        //         console.log('Response Data:', response.data); // Add this line
        //         this.user = response.data;
        //         // Store the user's ID in userId
        //         this.userId = this.user.id;

        //         // Call the fetchInfoUser method to use the user's ID
        //         this.fetchInfoUser();
        //     } catch (error) {
        //         console.error('Error fetching user:', error);
        //     }
        // },
        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/info'); // Change this URL if needed
                console.log(response.data);
                this.user = response.data;
                this.userId = this.user.id;
                this.fetchStudentList();

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
        //     fetchStudentList() {
        //         axios.get(`http://localhost:8000/api/head/student_list/${this.userId}`)
        //             .then((response) => {
        //                 this.programs = response.data;
        //             })
        //             .catch((error) => {
        //                 console.error('Error fetching student list:', error);
        //             });
        //     },
        //     toggleEnrollmentDetails(studentDetail) {
        //   studentDetail.showEnrollmentDetails = !studentDetail.showEnrollmentDetails;
        // },
        fetchStudentList() {
            axios.get(`http://localhost:8000/api/head/student_list/${this.userId}`)
                .then((response) => {
                    this.programs = response.data.map((program) => {
                        return {
                            ...program,
                            student_detail: program.student_detail.map((studentDetail) => {
                                return {
                                    ...studentDetail,
                                    showEnrollmentDetails: false, // Initialize the property

                                };
                            }),
                        };
                    });
                })
                .catch((error) => {
                    console.error('Error fetching student list:', error);
                });
        },
        // toggleEnrollmentDetails(studentDetail) {
        //     // Toggle the showEnrollmentDetails property for the specific studentDetail
        //     studentDetail.showEnrollmentDetails = !studentDetail.showEnrollmentDetails;
        // },
        toggleEnrollmentDetails(studentDetail) {
            // Set the selected enrollments
            this.selectedEnrollments = studentDetail.user.enrollments;

            // Trigger the modal to open
            //   ('#exampleModal0').modal('show');
        },
        setSelectedStudentUser(user) {
            this.selectedStudentUser = user;
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
                        <h1 class="text-[#243673] font-bold text-[24px]">List of All Students</h1>
                        <!-- <router-link to="/head/program">
                        <small class="text-[#243673] font-medium">Dashboard </small>
                    </router-link> -->
                        <small class="text-[#243673] font-medium">Students</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-[50px] h-[50px] mx-auto rounded-circle" :src="getUserImageURL(user)"
                                :alt="user.name">
                        </div>

                    </div>
                </div>
                <div class="container mt-3" v-for="program in programs" :key="program.id">
                    <h1 class="text-[#243673] font-bold text-[24px] text-center mb-4 mt-3">{{ program.name }} </h1>
                    <!-- Table for Courses -->
                    <div class="overflow-x-auto w-full">
                        <table
                            class="mx-auto max-w-4xl h-1 w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                            <thead class="bg-[#243673]">
                                <tr class="text-white  text-center">
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> No </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> ID </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Profile </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Student Name </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Action </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-3"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(studentDetail, index) in program.student_detail" :key="studentDetail.id"
                                    class="divide-y divide-gray-200 text-center">
                                    <td class="px-6 py-4">{{ index + 1 }}</td>
                                    <td class="px-6 py-4">{{ studentDetail.unique_id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space">
                                            <div class="inline-flex">
                                                <img class="w-[50px] h-[50px] mx-auto rounded-circle"
                                                    :src="getUserImageURL(studentDetail.user)"
                                                    :alt="studentDetail.user.first_name">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">&emsp;{{ studentDetail.user.first_name }} {{
                                        studentDetail.user.last_name }}</td>
                                    
                                    <td class="px-6 py-4">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#studentUserModal"
                                            :class="['btn', 'm-auto', 'mx-3', 'btn-primary']"
                                            @click="setSelectedStudentUser(studentDetail.user)">
                                            Student Info
                                        </button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#enroll"
                                            :class="['btn', 'm-auto', 'mx-3', 'btn-success']"
                                            @click="toggleEnrollmentDetails(studentDetail)">
                                            Enrollment Info
                                        </button>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="studentUserModal" tabindex="-1" role="dialog"
                    aria-labelledby="studentUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="studentUserModalLabel">Student Information</h5>
                            </div>
                            <div class="modal-body">
                                <div v-if="selectedStudentUser">
                                    <img class="w-36 h-36 mx-auto rounded-full my-3" :src="getUserImageURL(selectedStudentUser)" alt="User Image" >
                                    <h1 class="text-2xl font-bold text-center mt-4">{{ selectedStudentUser.first_name }} {{ selectedStudentUser.last_name }}</h1>
                                    <div class="text-center text-gray-600 mt-4">
                                    <p><strong>Username:</strong> {{ selectedStudentUser.username }}</p>
                                    <p><strong>Email:</strong> {{ selectedStudentUser.email }}</p>
                                    <p><strong>Date of Birth:</strong> {{ selectedStudentUser.dob }}</p>
                                    <p><strong>Contect:</strong> {{ selectedStudentUser.phone_number }}</p>
                                    <p><strong>Gender:</strong> {{ selectedStudentUser.gender }}</p>
                                    <p><strong>Bio:</strong> {{ selectedStudentUser.bio }}</p>
                                </div>
                                    
                                </div>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <div class="flex justify-center my-3">
                                    <span aria-hidden="true" class="btn btn-primary">Close</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ----------------------------------------------------------- -->
                <div class="modal fade" id="enroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Enrollment Details</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Display enrollment details within the modal -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Course Name</th>
                                            <th>Enrollment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(enrollment, index) in selectedEnrollments" :key="enrollment.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ enrollment.course.name }}</td>
                                            <td>{{ enrollment.enrollment_date }}</td>
                                            <td>{{ enrollment.status }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <div class="flex justify-center my-3">
                                    <span aria-hidden="true" class="btn btn-primary">Close</span>
                                </div>
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            </button>

                        </div>
                    </div>
                </div>


            </div>
        </div>



    </div>
</template>