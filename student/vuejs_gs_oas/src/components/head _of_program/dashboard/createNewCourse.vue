<script>
import axios from 'axios';
export default {
    data() {
        return {
            user: null,
            courses: [], // Array to store courses
            newCourseName: '', // Input field for course name
            programID: '',     // Input field for program ID
            editedCourseName: '', // Input field for editing a course
            selectedCourse: null, // Selected course for showing details
            isEditing: false, // Flag for showing/hiding edit form
            isShowing: false, // Flag for showing/hiding details
            courseCredit: '',
            courseSemester: '',
        };
    },
    mounted() {
        this.fetchLoggedInUser();
    },
    methods: {
        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/info'); // Change this URL if needed
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
        },
        // Fetch courses from the backend
        fetchCourses() {
            axios.get('http://localhost:8000/api/head/courses') // Adjust the URL to match your Laravel API endpoint
                .then((response) => {
                    // Assuming your API returns an array of courses in the response
                    this.courses = response.data;
                })
                .catch((error) => {
                    console.error('Error fetching courses:', error);
                });
        },

        // Create a new course
        createCourse() {
            // Prepare the data to be sent to the backend
            const courseData = {
                name: this.newCourseName,
                credit: this.courseCredit,
                semester: this.courseSemester,
                deadline: this.newCourseDeadline,
                program_id: this.programID, // Use the correct field name based on your database
            };

            // Make a POST request to create the course
            axios.post('http://localhost:8000/api/head/courses', courseData)
                .then((response) => {
                    console.log('Course created:', response.data);
                    // Assuming you want to refresh the course list after creating a course
                    this.fetchCourses();
                    this.$router.go(0);
                })
                .catch((error) => {
                    console.error('Error creating course:', error);
                });

        },

        // Edit a course
        editCourse(id) {
            console.log(id);
            axios.get(`http://localhost:8000/api/head/courses/${id}`) // Adjust the URL to match your Laravel API endpoint
                .then((response) => {
                    // Assuming you want to edit the course's name
                    this.editedCourseName = response.data.name;
                    this.isEditing = true; // Show the edit form
                })
                .catch((error) => {
                    console.error('Error fetching course details:', error);
                });
        },

        // Update a course
        updateCourse() {
            axios.post(`http://localhost:8000/api/head/courses/${this.selectedCourse.id}`, { name: this.editedCourseName }) // Adjust the URL and data as needed
                .then((response) => {
                    console.log('Course updated:', response.data);
                    this.isEditing = false;
                    // Assuming you want to refresh the course list after updating
                    this.fetchCourses();
                })
                .catch((error) => {
                    console.error('Error updating course:', error);
                });
        },

        confirmDelete(id) {
            const confirmation = window.confirm('Are you sure you want to delete this course?');
            if (confirmation) {
                this.deleteCourse(id);
            }
        },
        //delete course
        deleteCourse(id) {
            axios.delete(`http://localhost:8000/api/head/courses/${id}`)
                .then(() => {
                    console.log('Course deleted');
                    // Assuming you want to refresh the course list after deleting
                    this.fetchCourses();
                })
                .catch((error) => {
                    console.error('Error deleting course:', error);
                });
        },


        // Show course details
        showCourse(id) {
            axios.get(`http://localhost:8000/api/head/courses/${id}`) // Adjust the URL to match your Laravel API endpoint
                .then((response) => {
                    this.selectedCourse = response.data;
                    this.isShowing = true; // Show the details
                })
                .catch((error) => {
                    console.error('Error fetching course details:', error);
                });
        },
    },
    created() {
        // Fetch courses when the component is created
        this.fetchCourses();
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
            <!-- ==== -->
            <div class="all w-[943px] flex-1 ml-[330px] p-4">
                <div class="flex justify-between px-[5px] mt-4">
                    <div>
                        <h1 class="text-[#243673] font-bold text-[24px]">Program</h1>
                        <router-link to="/head/program">
                            <small class="text-gray-400 font-medium">Program Information </small>
                        </router-link>
                        <small class="text-[#243673] font-medium"> > Create New Course</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-[50px] h-[50px] mx-auto rounded-circle" :src="getUserImageURL(user)" :alt="user.name">
                        </div>

                    </div>
                </div>
                <!-- Create Course Form -->
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card bg-white rounded-lg shadow-lg">
                                <div class="py-2 text-center bg-[#243673] text-white">
                                    <h2 class="text-[24px] text-center ">Create New Course</h2>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="createCourse">
                                        <div class="text-center">
                                            <!-- <div class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto">
                                                
                                                <label for="file-input"
                                                    class="drop-container bg-white position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                                    <span class="drop-title text-muted fs-4 text-center ">Drope Course
                                                        Image</span>
                                                    or
                                                    <input type="file" @change="handleImageChange">
                                                    <img :src="image" alt="Selected Image" width="100">

                                                </label>
                                            </div> -->
                                            <input type="file" @change="handleImageChange" id="file-input"
                                                class="visually-hidden">
                                        </div>
                                        <div class="form-group">
                                            <label for="courseName">Course Name</label>
                                            <input v-model="newCourseName" type="text" class="form-control my-2"
                                                id="courseName" placeholder="Enter Course Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="courseCredit">Course Credit</label>
                                            <input v-model="courseCredit" type="number" class="form-control my-2"
                                                id="courseCredit" placeholder="Enter Course Credit" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="courseSemester">Course Semester</label>
                                            <input v-model="courseSemester" type="number" class="form-control my-2"
                                                id="programID" placeholder="Enter Course Semester" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="courseDeadline">Course Deadline</label>
                                            <input v-model="newCourseDeadline" type="date" class="form-control my-2"
                                                id="courseDeadline" required>
                                        </div>
                                        <div class="flex justify-center">
                                            <button type="submit" class="btn btn-success btn-block my-3">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="bg-[#243673] mt-5  text-white" style="height: 35px;">
                    <p class="text-center pt-2">2022 Graduate school-ITC, All Right Reserved </p>
                </div> -->
    </div>
</template>
<style>
.formUploadImg {
    padding: 0rem .7rem .7rem .7rem;
    max-width: 320px;
}

.drop-container {
    transition: background .2s ease-in-out, border .2s ease-in-out;
}
</style>  
  
  
  