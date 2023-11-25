
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            first_name: '',
            last_name: '',
            username: '',
            dob: '',
            phone_number: '',
            bio: '',
            selectedImage: '',
            image: '',
        };
    },

    mounted() {
        this.fetchLoggedInUser();
    
    },
    methods: {
        handleImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedImage = file;
                this.displayImage();
            }
        },
        //use to display the file 
        displayImage() {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.imageUrl = event.target.result;
            };
            reader.readAsDataURL(this.selectedImage);
        },

        
        fetchLoggedInUser() {

            axios.get(`http://localhost:8000/api/head/info`)
                .then(response => {
                    this.user = response.data;
                    this.first_name = response.data.first_name
                    this.last_name = response.data.last_name
                    this.username = response.data.username
                    this.gender = response.data.gender
                    this.phone_number = response.data.phone_number
                    this.email = response.data.email
                    this.bio = response.data.bio
                    this.dob = response.data.dob
                    this.selectedImage = response.data.image

                    this.image = `http://localhost:8000/storage/${this.selectedImage}`;

                    // console.log(this.selectedImage);

                })
                .catch(error => {
                    console.log("Error:", error);
                });

        },
    
        onImageChange(event) {
            this.selectedImage = event.target.files[0];
            this.selectedImageURL = URL.createObjectURL(this.selectedImage);
        },

        async updateProfile() {

            const userInfo = {
                first_name: this.first_name,
                last_name: this.last_name,
                username: this.username,
                dob: this.dob,
                phone_number: this.phone_number,
                bio: this.bio,

            }
            const formData = new FormData();
            Object.entries(userInfo).forEach(([key, value]) => {
                console.log('Appending:', key, value);
                formData.append(key, value);
            });

            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }

            axios.post(`http://localhost:8000/api/head/updateInfo`, formData)
                .then(response => {

                    this.$emit('user-edited');
                    console.log(FormData);
                    console.log(response.data);
                    // this.$router.push('/student/dashboard');
                    this.$router.go(0);

                })
                .catch(error => {
                    console.log(error)
                });
        },

        getUserImageURL(user) {

            if (user.image) {
                return `http://localhost:8000/storage/${user.image}`;
            } else {
                return 'https://cdn-icons-png.flaticon.com/512/219/219970.png';
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
        }

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
                            <i class="fa-solid fa-user text-[25px] mr-[13px]"></i>
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
                        <h1 class="text-[#243673] font-bold text-[24px]">Profile</h1>
                        <router-link to="/head/profile">
                            <small class="text-gray-400 font-medium">Profile </small>
                        </router-link>
                        <small class="text-[#243673] font-medium"> > Update Profile</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-[50px] h-[50px] mx-auto rounded-circle" :src="getUserImageURL(user)" :alt="user.name">
                        </div>

                    </div>
                </div>

                <div class="container mt-5">
                    <div class="flex justify-center align-items-center ">
                        <form @submit.prevent="updateProfile" enctype="multipart/form-data"
                            class="response row justify-content-around">

                            <div class="col-md-7">
                                <div class="card bg-white rounded-lg shadow-lg"> 
                                    <h1 class="py-2 text-[24px] text-center bg-[#243673] text-white">Update Profile</h1>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-12 flex justify-center my-0">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <div
                                                            class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto">
                                                            <!-- <span class=" text-dark fs-5 ">Select your profile
                                                                picture</span> -->
                                                            <label for="file-input"
                                                                class="drop-container bg-white position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                                                <span
                                                                    class="drop-title text-muted fs-4 text-center ">Drope your profile</span>
                                                                or
                                                                <input type="file" @change="handleImageChange">
                                                                <img :src="image" alt="Selected Image" width="100">

                                                            </label>
                                                        </div>
                                                        <input type="file" @change="handleImageChange" id="file-input"
                                                            class="visually-hidden">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-mt-12">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input v-model="username" type="text" class="form-control"
                                                            id="username" placeholder="Enter here!!">
                                                    </div>
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input v-model="first_name" type="text" class="form-control" id="firstName"
                                                    placeholder="Enter here!!">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input v-model="last_name" type="text" class="form-control" id="lastName"
                                                    placeholder="Enter here!!">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                                <input v-model="phone_number" type="text" class="form-control"
                                                    id="phoneNumber" placeholder="Enter here!!">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="bio" class="form-label">Bio</label>
                                                <input v-model="bio" type="text" class="form-control" id="bio"
                                                    placeholder="Enter here!!">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="dob" class="form-label">Date of Birth</label>
                                                <input v-model="dob" type="date" class="form-control" id="dob"
                                                    placeholder="Enter your Last Name">
                                            </div>
                                            <div class="col-md-12 text-center mt-4">
                                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-[#243673] mt-5  text-white" style="height: 35px;">
                    <p class="text-center pt-2">2022 Graduate school-ITC, All Right Reserved </p>
        </div>
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
