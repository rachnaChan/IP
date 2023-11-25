
<script>
import axios from 'axios'
export default {
    data() {
        return {
            user: null,
            courses: [], // Array to store courses
            programs: [],
        };
    },
    mounted() {
    this.fetchLoggedInUser();
    this.fetchPrograms(); // Add this line to call the fetchPrograms method
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
        fetchPrograms() {
    this.rowNumber = 1;
    axios.get('http://localhost:8000/api/head/program')
        .then((response) => {
            console.log('Programs API response:', response.data); // Check if data is received
            this.programs = response.data.filter(program => program.head_of_program_id === 4);
            console.log('Filtered Programs:', this.programs); // Check if 'programs' array is populated
        })
        .catch((error) => {
            console.error('Error fetching programs:', error);
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
                            <i class="fa-regular fa-circle-question text-[25px] mr-[13px]"></i>
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
                        <small class="text-[#243673] font-medium">Program Information</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-10 h-10 mx-auto rounded-full" :src="getUserImageURL(user)" :alt="user.name">
                        </div>

                    </div>
                </div>
                <!-- inforamtion about each Program -->
                <div class="w-[835px] border-2 mt-4 border-[#243673] rounded-3xl m-auto px-[30px] " v-for="(program, rowNumber) in programs" :key="program.id">
                    <h1 class="mt-[30px] text-[20px] font-semibold">{{ program.name }}</h1>
                    <small class="text-[#707070] text-[14px]">Master’s degree</small>

                    <div class="flex gap-[17px] mt-[16px]">
                        <div
                            class="border border-solid border-[#243673] rounded-xl w-[81px] h-[68px] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="37" viewBox="0 0 38 37" fill="none">
                                <path
                                    d="M19 0L18.3073 0.35L2.47396 8.2L1.58333 8.65V11.4H36.4167V8.65L35.526 8.2L19.6927 0.35L19 0ZM19 3.6L28.3021 8.2H9.69792L19 3.6ZM4.75 13V29H3.16667V32.2H34.8333V29H33.25V13H30.0833V29H26.9167V13H23.75V29H20.5833V13H17.4167V29H14.25V13H11.0833V29H7.91667V13H4.75ZM0 33.8V37H38V33.8H0Z"
                                    fill="#243673" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-[20px] font-semibold">Institute of Technology of Cambodia</h1>
                            <small class="text-[#707070] text-[14px]">Phnom Penh, Cambodia</small>
                        </div>
                    </div>

                    <div class="line w-[780px]  border-2 border-solid border-gray-400 mt-[38px] mb-9"></div>

                    <div class="flex gap-10 text-[#707070] text-[14px] font-medium">
                        <div>
                            <h5>Study Type </h5>
                            <h5 class="py-3">Full time</h5>
                        </div>
                        <div>
                            <h5>Attendance </h5>
                            <h5 class="py-3">On Campus</h5>
                        </div>
                    </div>


                    <!-- about Program -->
                    <div class=" border-2 border-[#243673] rounded-2xl px-6 py-[30px] m-auto">
                        <h1 class="text-[18px] tracking-[0.72px] font-medium">About :</h1>
                        <p class="text-[#707070] font-medium text-[14px]">{{ program.description }}</p>
                    </div>
                    <div class="mt-4 mb-4 flex justify-between">
                        <router-link to="/head/program/course_detail">
                            <button class="btn btn-primary my-3"><i class="fa fa-book mr-2"></i>View all Available Courses
                                in Program</button>
                        </router-link>
                        <router-link to="/head/program/create_new_course">
                            <button class="btn btn-primary my-3"><i class="fa fa-edit mr-2"></i>Create new Courses</button>
                        </router-link>
                    </div>
                </div>
               

            </div>
                
        </div>
        <div class="bg-[#243673] mt-5  text-white" style="height: 35px;">
                <p class="text-center pt-2">2022 Graduate school-ITC, All Right Reserved </p>
        </div>
    </div>
</template>