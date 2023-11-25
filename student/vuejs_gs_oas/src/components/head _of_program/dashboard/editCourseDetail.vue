
<script>
import axios from 'axios';
export default {
    data() {
        return {
            user: null,
            courseId: null, // Course ID received from route parameters
      editedCourseName: '',
      courseCredit: '',
      courseSemester: ''
        };
        
    },
    created() {
    // Retrieve the course ID from route parameters
    this.courseId = this.$route.params.id;

    // Fetch the course data for editing
    this.fetchCourseData();
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

        editCourse(id) {
      // Assuming you are using Vue Router for navigation
      // Pass the selected course ID as a route parameter
      this.$router.push({
        name: 'edit-course',
        params: { courseId: id },
      });
    },

      // Update a course
// updateCourse() {
//   // Ensure you have a valid `selectedCourse` object with an `id` property
//   if (this.selectedCourse) {
//     const courseId = this.selectedCourse.id; // Get the course ID from the selected course

//     // Prepare the data to be sent to the backend
//     const updatedCourseData = {
//       name: this.editedCourseName,
//       credit: this.courseCredit,
//       semester: this.courseSemester,
//     };

//     // Make a PUT request to update the course
//     axios
//       .put(`http://localhost:8000/api/head/courses/${courseId}`, updatedCourseData)
//       .then((response) => {
//         console.log('Course updated:', response.data);
//         this.isEditing = false;
//         // Assuming you want to refresh the course list after updating
//         this.fetchCourses();
//       })
//       .catch((error) => {
//         console.error('Error updating course:', error);
//       });
//   } else {
//     console.error('No course selected for editing');
//   }
// },
// Fetch the course data for editing
fetchCourseData() {
      axios.get(`http://localhost:8000/api/head/courses/${this.courseId}`)
        .then((response) => {
          const courseData = response.data;
          this.editedCourseName = courseData.name;
          this.courseCredit = courseData.credit;
          this.courseSemester = courseData.semester;
        })
        .catch((error) => {
          console.error('Error fetching course details:', error);
        });
    },

    // Update the course data and navigate back to courseDetail.vue
    updateCourse() {
      // Prepare the updated course data
      const updatedCourseData = {
        name: this.editedCourseName,
        credit: this.courseCredit,
        semester: this.courseSemester,
      };

      // Make an API request to update the course
      axios.put(`http://localhost:8000/api/head/courses/${this.courseId}`, updatedCourseData)
        .then((response) => {
          console.log('Course updated:', response.data);

          // Navigate back to courseDetail.vue
          this.$router.push({ name: 'course-detail' });
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
            <div class="bg-[#243673] min-h-screen min-w-[290px] relative">
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
            <div class="all w-[943px] relative h-full  m-auto mt-0">
            <div class="flex justify-between px-[5px] mt-4">
                <div>
                    <h1 class="text-[#243673] font-bold text-[24px]">Head of Program Dashboard</h1>
                    <!-- <router-link to="/head/program">
                        <small class="text-[#243673] font-medium">Dashboard </small>
                    </router-link> -->
                    <small class="text-[#243673] font-medium"> Dashboard</small>
                </div>
                <div class="flex justify-between items-center gap-[15px]">
                    <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                    <div class="text-[#243673]">
                        <img class="w-10 h-10 mx-auto rounded-full" :src="getUserImageURL(user)" :alt="user.name">
                    </div>

                </div>
            </div>
            <!-- <div class="all w-[943px] relative h-full  m-auto mt-1 px-[50px]">
                <h1 class="text-[#243673] font-semibold text-[24px] mt-[40px]">Head of Certain program Dashboard</h1> -->
                <div class="container mt-5" v-if="isEditing">
    <h2>Edit Course</h2>
    <form @submit.prevent="updateCourse">
        <div class="input-group mb-3">
            <input v-model="editedCourseName" type="text" class="form-control" />
            <input v-model="courseCredit" type="text" class="form-control" placeholder="credit" />
            <input v-model="courseSemester" type="text" class="form-control" placeholder="Semester" />
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <button @click="isEditing = false" class="btn btn-secondary">Close</button>
</div>

                <div class="bg-[#243673] mt-5  text-white" style="height: 35px;">
                    <p class="text-center pt-2">2022 Graduate school-ITC, All Right Reserved </p>
                </div>
            </div>
        </div>
    </div>
</template>
