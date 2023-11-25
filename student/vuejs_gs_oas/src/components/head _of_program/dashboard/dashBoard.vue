
<script>
import axios from 'axios'
export default {
    data() {
        return {
            user: null,
            courses: [], // Array to store courses
            students: [],
            events: [],
            eventCount: 0,
            studentCount: 0,
            currentEventIndex: 0,
        };
    },
    mounted() {
        this.fetchLoggedInUser();
        this.fetchInfoUser();

    },
    methods: {
        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/info');
                console.log('Response Data:', response.data); // Add this line
                this.user = response.data;
                // Store the user's ID in userId
                this.userId = this.user.id;

                // Call the fetchInfoUser method to use the user's ID
                this.fetchInfoUser();
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
        fetchCourses() {
            axios.get('http://localhost:8000/api/head/courses') // Adjust the URL to match your Laravel API endpoint
                .then((response) => {
                    // Assuming your API returns an array of courses in the response
                    // Filter courses by program_id === 1
                    this.courses = response.data.filter(course => course.program_id === 15);
                })
                .catch((error) => {
                    console.error('Error fetching courses:', error);
                });
        },
        async fetchCourses() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/courses');
                this.courses = response.data;
            } catch (error) {
                console.error('Error fetching courses:', error);
            }
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
        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                return imageUrl;
            } else {
                // If the user has no image, you can provide a default image URL
                return 'https://example.com/default-image.png'; // Replace with your default image URL
            }
        },
        async fetchEvents() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/getEvent');
                this.events = response.data.map(event => ({
                    ...event,
                    imageUrl: this.getUserImageURL(event),
                }));
                this.eventCount = this.events.length; // Update the eventCount property
            } catch (error) {
                console.error('Error fetching events:', error);
            }
        },
        fetchStudentList() {
            axios.get(`http://localhost:8000/api/head/student_list/${this.userId}`)
                .then((response) => {
                    this.programs = response.data.map((program) => {
                        return {
                            ...program,
                            student_detail: program.student_detail.map((studentDetail) => {
                                return {
                                    ...studentDetail,
                                    showEnrollmentDetails: false,
                                };
                            }),
                        };
                    });

                    // Update the studentCount property
                    this.studentCount = this.programs.reduce((count, program) => {
                        return count + program.student_detail.length;
                    }, 0);
                })
                .catch((error) => {
                    console.error('Error fetching student list:', error);
                });
        },
        // Method to navigate to the next event
        nextEvent() {
            if (this.currentEventIndex < this.eventCount - 1) {
                this.currentEventIndex++;
            }
        },

        // Method to navigate to the previous event
        previousEvent() {
            if (this.currentEventIndex > 0) {
                this.currentEventIndex--;
            }
        },
    },
    created() {
        this.fetchCourses();
        this.fetchEvents(); // Add this line to fetch events when the component is created
        this.rowNumber = 1;
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
                        <h1 class="text-[#243673] font-bold text-[24px]">Head Of Program</h1>
                        <!-- <router-link to="/head/program">
                        <small class="text-[#243673] font-medium">Dashboard </small>
                    </router-link> -->
                        <small class="text-[#243673] font-medium">Dashboard</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-[50px] h-[50px] mx-auto rounded-circle" :src="getUserImageURL(user)"
                                :alt="user.name">
                        </div>

                    </div>
                </div>
                <!-- <div class="all w-[943px] relative h-full  m-auto mt-1 px-[50px]">
                <h1 class="text-[#243673] font-semibold text-[24px] mt-[40px]">Head of Certain program Dashboard</h1> -->
                <section id="content">

                    <main>
                        <ul class="box-info">
                            <li>
                                <router-link to="/head/students" class="no-underline">
                                    <i class='bx bxs-group'></i>
                                </router-link>
                                <span class="text">
                                    <h3>Total Students</h3>
                                    <h4 class="text-center text-blue-600">{{ studentCount }}</h4>
                                </span>
                            </li>
                            <li>
                                <router-link to="/head/enrollment" class="no-underline">
                                    <i class='bx bxs-group'></i>
                                </router-link>
                                <span class="text">
                                    <h3>Total Enrollment</h3>
                                    <h4 class="text-center text-yellow-300">{{ students.length }}</h4>
                                </span>
                            </li>
                            <li>
                                <router-link to="/head/program/course_detail" class="no-underline">
                                    <i class='bx bxs-book'></i>
                                </router-link>
                                <span class="text">
                                    <h3>Total Courses</h3>
                                    <h4 class="text-center text-orange-400">{{ courses.length }}</h4>
                                </span>
                            </li>
                            <li>
                                <router-link to="/head/events" class="no-underline">
                                    <i class='bx bxs-calendar-check'></i>
                                </router-link>
                                <span class="text">
                                    <h3>Total Events</h3>
                                    <h4 class="text-center text-pink-500">{{ eventCount }}</h4>
                                </span>
                            </li>
                        </ul>
                        <div class="table-data">
                            <div class="order" style="max-height: 500px; overflow-y: auto;">
                                <div class="head">
                                    <h3>Student Enrollment</h3>
                                    <!-- <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i> -->
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Profile</th>
                                            <th>Students</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(student, index) in students" :key="index"
                                            class="divide-y divide-gray-200">
                                            <td>
                                                {{ index + 1 }}
                                            </td>
                                            <td>
                                                <div class="flex items-center space">
                                                    <div class="inline-flex "> <img
                                                            class="w-[50px] h-[50px] mx-auto rounded-circle"
                                                            :src="getUserImageURL(student.studentInfo)" alt="Student Image">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                &emsp;{{
                                                    student.studentInfo.first_name }} {{ student.studentInfo.last_name }}
                                            </td>

                                            <td><span class="status completed"><router-link to="/head/enrollment">
                                                        <button class=" text-white"> Views</button>
                                                    </router-link></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="todo " style="max-height: 500px; overflow-y: auto;">
                                <div class="head">
                                    <h3>Available Courses</h3>
                                    <router-link to="/head/program/course_detail" class="text-xl">
                                        <i class='bx bx-show' title='View Details'></i>
                                    </router-link>
                                    <router-link to="/head/program/create_new_course" class="text-xl">
                                        <i class='bx bx-plus' title='Create new course'></i>
                                    </router-link>
                                </div>
                                <ul class="todo-list">
                                    <li class="completed" v-for="course in courses" :key="course.id">
                                        <p>{{ course.name }}</p>
                                        <!-- <i class='bx bx-dots-vertical-rounded'></i> -->
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- ------------------------------------------------------------ -->
                        <div class="table-data">
                            <div class="todo" style="max-height: 650px; overflow-y: auto;">
                                <!-- Event navigation buttons -->
                                <div class="head">
                                    <h3 class="mt-2">Events</h3>
                                    <div class="flex space-x-4 mt-0">
                                        <!-- Previous event button -->
                                        <button @click="previousEvent" class="text-xl">
                                            <i class="bx bx-chevron-left" title="Previous Event"></i>
                                        </button>
                                        <!-- Next event button -->
                                        <button @click="nextEvent" class="text-xl">
                                            <i class="bx bx-chevron-right" title="Next Event"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Display the current event -->
                                <div v-if="events.length > 0" :key="currentEventIndex"
                                    class="bg-white p-4 shadow-lg rounded-lg">
                                    <div class="text-center">
                                        <div class="w-64 h-48 mx-auto relative">
                                            <img :src="events[currentEventIndex].imageUrl"
                                                class="object-cover w-full h-full rounded-md" alt="Event Image" />
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h2 class="text-xl font-semibold">{{ events[currentEventIndex].title }}</h2>
                                        <p class="text-sm">
                                            <span class="text-gray-600">{{ events[currentEventIndex].start_date }} - </span>
                                            <span class="text-red-500">{{ events[currentEventIndex].deadline }}</span>
                                        </p>
                                        <p class="text-gray-800">{{ events[currentEventIndex].description }}</p>
                                    </div>
                                </div>
                                <div v-else>
                                    <p>No events available.</p>
                                </div>
                            </div>
                            <div class="order" v-for="program in programs" :key="program.id"
                                style="max-height: 650px; overflow-y: auto;">
                                <div class="head">
                                    <h3>List of Students </h3>
                                    <!-- <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i> -->
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Profile</th>
                                            <th>Student</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(studentDetail, index) in program.student_detail" :key="studentDetail.id"
                                            class="divide-y divide-gray-200">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ studentDetail.unique_id }}</td>
                                            <td>
                                                <div class="flex items-center space">
                                                    <div class="inline-flex "> <img
                                                            class="w-[50px] h-[50px] mx-auto rounded-circle"
                                                            :src="getUserImageURL(studentDetail.user)"
                                                            :alt="studentDetail.user.first_name">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>&emsp;{{ studentDetail.user.first_name }} {{
                                                studentDetail.user.last_name }}
                                            </td>
                                            <td><span class="status completed"><router-link to="/head/students">
                                                        <button class=" text-white"> Views</button>
                                                    </router-link></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        
                    </main>
                </section>
            </div>
        </div>
        <div class="bg-[#243673] mt-3  text-white" style="height: 35px;">
            <p class="text-center pt-2">2022 Graduate school-ITC, All Right Reserved </p>
        </div>
    </div>
</template>
<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

.bx.bx-plus:hover {
    color: var(--orange)
        /* Change this to the color you want */
}

.bx.bx-show:hover {
    color: var(--orange)
        /* Change this to the color you want */
}

:root {
    --poppins: 'Poppins', sans-serif;
    --lato: 'Lato', sans-serif;

    --light: #F9F9F9;
    --blue: #3C91E6;
    --light-blue: #CFE8FF;
    --grey: #eee;
    --dark-grey: #AAAAAA;
    --dark: #342E37;
    --red: #DB504A;
    --yellow: #FFCE26;
    --light-yellow: #FFF2C6;
    --orange: #FD7238;
    --light-orange: #FFE0D3;
    --purple: #fa3bcd;
    --light-purple: #f1b0dc;
}

#content main .box-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    grid-gap: 24px;
    margin-top: 36px;
    width: 100%;
    padding-left: 0;
}

#content main .box-info li {
    padding: 24px;
    background: var(--light);
    border-radius: 20px;
    display: flex;
    align-items: center;
    grid-gap: 24px;

}

#content main .box-info li .bx {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    font-size: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#content main .box-info li:nth-child(1) .bx {
    background: var(--light-blue);
    color: var(--blue);
}

#content main .box-info li:nth-child(2) .bx {
    background: var(--light-yellow);
    color: var(--yellow);
}

#content main .box-info li:nth-child(3) .bx {
    background: var(--light-orange);
    color: var(--orange);
}

#content main .box-info li:nth-child(4) .bx {
    background: var(--light-purple);
    color: var(--purple);
}

#content main .box-info li .text h3 {
    font-size: 24px;
    font-weight: 600;
    color: var(--dark);
}


#content main .table-data {
    display: flex;
    flex-wrap: wrap;
    grid-gap: 24px;
    margin-top: 24px;
    width: 100%;
    color: var(--dark);
}

#content main .table-data>div {
    border-radius: 20px;
    background: var(--light);
    padding: 24px;
    overflow-x: auto;
}

#content main .table-data .head {
    display: flex;
    align-items: center;
    grid-gap: 16px;
    margin-bottom: 24px;
}

#content main .table-data .head h3 {
    margin-right: auto;
    font-size: 24px;
    font-weight: 600;
}

#content main .table-data .head .bx {
    cursor: pointer;
}

#content main .table-data .order {
    flex-grow: 1;
    flex-basis: 500px;
}

#content main .table-data .order table {
    width: 100%;
    border-collapse: collapse;
}

#content main .table-data .order table th {
    padding-bottom: 12px;
    font-size: 15px;
    text-align: left;
    border-bottom: 1px solid var(--grey);
}

#content main .table-data .order table td {
    padding: 16px 0;
}



#content main .table-data .order table tbody tr:hover {
    background: var(--light-orange);
}

#content main .table-data .order table tr td .status {
    font-size: 15px;
    padding: 6px 16px;
    color: white;
    border-radius: 10px;
    font-weight: 700;
}

#content main .table-data .order table tr td .status.completed {
    background: var(--orange);
}

#content main .table-data .todo {
    flex-grow: 1;
    flex-basis: 300px;
}

#content main .table-data .todo .todo-list {
    width: 100%;
}

#content main .table-data .todo .todo-list li {
    width: 100%;
    margin-bottom: 16px;
    background: var(--grey);
    border-radius: 10px;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#content main .table-data .todo .todo-list li .bx {
    cursor: pointer;
}

#content main .table-data .todo .todo-list li:nth-child(odd) {
    /* Apply background color for odd-indexed items */
    background-color: var(--light-blue);
}

#content main .table-data .todo .todo-list li:nth-child(even) {
    /* Apply background color for even-indexed items */
    background-color: var(--light-yellow);
}

#content main .table-data .todo .todo-list li:last-child {
    margin-bottom: 0;
}
</style>