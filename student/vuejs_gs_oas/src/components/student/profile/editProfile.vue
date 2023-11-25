
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
            currentDateTime: null,
            activeNavItem: null,
            updateMessage: "", // Message to display after enrollment

        };
    },

    mounted() {
        this.fetchLoggedInUser();

        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000);

    },

    methods: {
        displayImage() {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.imageUrl = event.target.result;
            };
            reader.readAsDataURL(this.selectedImage);
        },

        handleImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedImage = file;
                this.displayImage();
            }
        },


        fetchLoggedInUser() {

            axios.get(`http://localhost:8000/api/student/info`)
                .then(response => {
                    this.user = response.data;
                    this.programs = response.data;
                    this.courses = response.data;
                    this.student_details = response.data;
                    this.first_name = response.data.first_name
                    this.last_name = response.data.last_name
                    this.selectedImage = response.data.image
                    this.username = response.data.username
                    this.gender = response.data.gender
                    this.phone_number = response.data.phone_number
                    this.email = response.data.email
                    this.bio = response.data.bio
                    this.dob = response.data.dob

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

            const isProfileModified = Object.values(userInfo).some(value => value !== null);

            if (!isProfileModified) {
                this.updateMessage = "No changes were made to your profile.";

            }

            axios.post(`http://localhost:8000/api/student/updateInfo`, formData)
                .then(response => {

                    this.$emit('user-edited');
                    console.log(FormData);
                    // console.log(response.data);
                    this.updateMessage = response.data.message;

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

        fetchInfoUser() {
            const userId = this.$route.params.userId;
            console.log('User ID:', userId); // Check the student_id

            axios.get(`http://localhost:8000/api/student/info/${userId}`)
                .then(response => {
                    this.user = response.data[0];
                    this.programs = response.data[0];
                    this.courses = response.data[0];

                    this.first_name = response.data.first_name
                    this.last_name = response.data.last_name
                    this.selectedImage = response.data.image
                    this.username = response.data.username
                    this.gender = response.data.gender
                    this.phone_number = response.data.phone_number
                    this.email = response.data.email
                    this.bio = response.data.bio
                    this.dob = response.data.dob

                    this.image = `http://localhost:8000/storage/${this.selectedImage}`;
                    // console.log(response.data);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });


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
    <div class="h-100" v-if="user">

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

                <div class="col custom-scrollbar col justify-content-center overflow-scroll flex-nowrap"
                    style="height: 700px; margin-left: 15%;">
                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Profile's Info: <span class="text-[#243673]"> Update
                                    Info</span> </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead  fs-6 fw-bold cursor-pointer">
                                    Dashboard >
                                </span>


                                <span @click="$router.push({ name: 'studentProfile', params: { userId: user.student_id } })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                                    Profile
                                </span>
                                > Update info
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
                                        @click="$router.push({ name: 'studentProfile', params: { userId: user.student_id } })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="lead mt-5 py-5">
                        <div class="container rounded bg-white mt-4 mb-5">

                            <form @submit.prevent="updateProfile" enctype="multipart/form-data"
                                class="response row justify-content-around">

                                <div class="col-md-4 border-2 rounded-3 mb-4 border-[#243673]"
                                    style="height: 550px; margin-left: 2%;">

                                    <div class="custom-scrollber mb-4" style="height: 560px; ">
                                        <div
                                            class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto py-4 ">
                                            <span class="lead text-dark fs-5 fw-bold">Select your profile picture</span>
                                            <label for="file-input"
                                                class="drop-container  position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                                <span class="lead drop-title text-muted fs-4  text-center ">Drop here
                                                    !!</span>
                                                or

                                                <input type="file" @change="handleImageChange"
                                                    class="dashboard_textBox  m-auto fs-6 ">
                                                <img :src="image" alt="Selected Image" width="100">

                                            </label>
                                        </div>

                                        <div class="mt-4 editInput lead position-relative m-auto w-75 mb-5 ">
                                            <label for="fname" class="lead fw-bold text-[#243673]">User name</label>
                                            <input v-model="username"
                                                class="input-box lead fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="text" placeholder="Enter here!!">
                                            <span class="underline position-absolute w-100 "></span>
                                        </div>


                                        <div class="w-100 mt-5 text-right">
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#profileModal"
                                                class="bg-[#243673] positon-relative rounded-2 border-1 h-10 w-25 text-white fw-bold">Update</button>
                                        </div>

                                        <div class="modal fade" id="profileModal" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="profileModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <h1 class="modal-title lead text-center fs-3 m-auto text-muted ">
                                                            Update Info</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                            @click="$router.push({ name: 'studentProfile', params: { userId: user.student_id } })"></button>
                                                    </div>
                                                    <div v-if="updateMessage"
                                                        class="modal-body lead m-auto text-center fs-6 ">
                                                        {{ updateMessage }} &#128142;

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success lead"
                                                            @click="$router.push({ name: 'studentProfile', params: { userId: user.student_id } })"
                                                            data-bs-dismiss="modal">Got
                                                            it!!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                                <div class="col-md-7 border-2 border-dashed rounded-3 border-[#243673]"
                                    style="height: 550px;">
                                    <div class="p-3 py-2 text-center custom-scrollbar" style="height: 560px;">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class='bx bx-edit fs-1' style='color:#243673'></i>
                                            <h4 class="text-right mx-3 fs-2  fw-bold lead">Update Info</h4>
                                        </div>

                                        <div class="d-flex justify-content-around">

                                            <div class="editInput position-relative mt-3 m-auto w-50 ">
                                                <label for="fname" class="lead fw-bold text-[#243673]">First name</label>
                                                <input v-model="first_name"
                                                    class="input-box fs-5 p-2 border-0 border-bottom  w-75 bg-transparent"
                                                    type="text" placeholder="Enter here!!">
                                                <span class="underline position-absolute w-100 "></span>
                                            </div>


                                            <div class="editInput position-relative mt-3 m-auto w-50 ">
                                                <label for="lname" class="lead fw-bold text-[#243673]">Last name</label>
                                                <input v-model="last_name"
                                                    class="input-box fs-5 p-2 border-0 border-bottom  w-75 bg-transparent"
                                                    type="text" placeholder="Enter here!!">
                                                <span class="underline position-absolute w-100  "></span>
                                            </div>

                                        </div>

                                        <div class="editInput position-relative mt-4 m-auto w-75 ">
                                            <label for="lname" class="lead fw-bold text-[#243673]">Phone Number</label>
                                            <input v-model="phone_number"
                                                class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="text" placeholder="Enter here!!">
                                            <span class="underline position-absolute w-100  "></span>
                                        </div>
                                        <div class="editInput position-relative mt-4 m-auto w-75">
                                            <label for="lname" class="lead fw-bold text-[#243673]">Bio </label>
                                            <input v-model="bio"
                                                class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="text" placeholder="Enter here!!">
                                            <span class="underline position-absolute w-100  "></span>
                                        </div>
                                        <div class="editInput position-relative mt-4 m-auto w-75 ">
                                            <label for="lname" class="lead fw-bold text-[#243673]">Dob</label>
                                            <input v-model="dob"
                                                class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="date" placeholder="Enter your Last Name">
                                            <span class="underline position-absolute w-100  "></span>
                                        </div>


                                    </div>

                                </div>
                            </form>

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
    width: 85%;
    overflow: hidden;
    word-wrap: break-word;
    font-size: 16px;

    @media screen and (max-width: 768px) {
        font-size: 12px;
    }

    @media screen and (max-width: 480px) {
        font-size: 12px;
    }
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

/* width */
::-webkit-scrollbar {
    width: 10px;
}



/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #ffffff;
}

.formUploadImg {
    padding: 2rem .7rem .7rem .7rem;
    max-width: 320px;
}

.drop-container {
    transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
    background: rgba(0, 140, 255, 0.164);
}

.drop-container:hover .drop-title {
    color: #222;
}

.drop-title {
    transition: color .2s ease-in-out;
}

#file-input {
    width: 350px;
    max-width: 100%;
}

#file-input::file-selector-button {
    margin-right: 20px;
    border: none;
    background: #243673;
    padding: 10px 20px;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    transition: background .2s ease-in-out;
}

#file-input::file-selector-button:hover {
    background: #243673;
}


.input-box {

    transition: border-color 0.3s ease-in-out;
}

.underline {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    background-color: #243673;
    transform: scaleX(0);
    transition: transform 0.3s ease-in-out;
}

.input-box:focus {
    border-color: #243673;
    outline: none;
}

.input-box:focus+.underline {
    transform: scaleX(1);
}
</style>

