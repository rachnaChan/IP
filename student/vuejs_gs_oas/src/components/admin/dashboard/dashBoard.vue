
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            currentDateTime: null,
            title: '',
            start_date: '',
            deadline: '',
            description: '',
            selectedImage: '',
            image: '',
            selectedFile: null,
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

        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/admin/info'); // Change this URL if needed
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

        addEvent() {

            const eventInfo = {
                title: this.title,
                start_date: this.start_date,
                deadline: this.deadline,
                description: this.description,

            }
            const formData = new FormData();

            Object.entries(eventInfo).forEach(([key, value]) => {
                console.log('Appending:', key, value);
                formData.append(key, value);
            });

            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }


            axios.post('http://localhost:8000/api/admin/addEvent', formData)
                .then(response => {
                    // Handle success
                    console.log(response.data.message);
                    // this.$router.push('/student/document');
                    this.$router.go(0);
                })
                .catch(error => {
                    // Handle error
                    console.error(error);
                });
        },

        onImageChange(event) {
            this.selectedImage = event.target.files[0];
            this.selectedImageURL = URL.createObjectURL(this.selectedImage);
        },

        handleImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedImage = file;
                this.displayImage();
            }
        },

        displayImage() {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.imageUrl = event.target.result;
            };
            reader.readAsDataURL(this.selectedImage);
        },


    },
};

</script>

<template>
    <div v-if="user">


        <div class="dashboard_ContainerFluid">
            <div class="row flex-nowrap p-0">
                <div class="position-fixed col-lg-2 col-xl-2 bg-[#243673]" style="height: 700px; z-index: 3;">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 text-white">

                        <router-link :to="{ name: 'adminDashboard', params: { userId: user.id } }"
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

                            <!-- <div class="nav-item ">
                                <router-link :to="{ name: 'headAllProgram', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Programs</span>
                                    </a>
                                </router-link>
                            </div>
                            <div class="nav-item ">
                                <router-link :to="{ name: 'headAllCourse', params: { userId: user.id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Courses</span>
                                    </a>
                                </router-link>
                            </div>




                            <div class="nav-item">
                                <router-link :to="{ name: 'headAllEnrollment', params: { userId: user.id} }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-file-doc fs-5' style='color:white'></i>
                                        <span class="lead ms-1 d-none d-sm-inline text-white fs-5">Enrollments</span></a>
                                </router-link>
                            </div> -->

                            <div class="nav-item">
                                <p class="lead mt-5 text-white fs-6  text">{{ currentDateTime }}</p>

                            </div>

                        </div>
                        <hr>
                    </div>
                </div>

                <div class="col custom-scrollbar overflow-scroll flex-nowrap p-0" style="height: 700px; margin-left: 15%;">

                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  ">Graduate Admission </p>
                            <li class="lead mx-5 fs-5 fw-bold">Dashboard</li>

                        </div>

                        <div class="d-flex bg-white ">
                            <div class="dropdown mt-3 " style="margin-left: 15%;">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="getUserImageURL(user)" ui:alt="user.id" class="rounded-circle img-fluid mx-5"
                                        style="width: 50px; height: 50px;">

                                </a>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                    aria-labelledby="dropdownUser1">
                                        class="text-decoration-none">
                                        <li><a class="dropdown-item " href="#">Profile</a></li>
                                        <li class="mt-1">
                                            <a href="#" class="dropdown-item " @click="logout">
                                                <span class="ms-1 d-none d-sm-inline">Logout</span>
                                            </a>
                                        </li>

                                </ul>
                            </div>

                            <i class='bx bx-bell fs-1 mt-3 mx-4 ' style=" color: #233673;"></i>


                        </div>


                    </div>

                    <div class="mt-4 py-5"></div>

                    <div class="m-auto h-auto mt-4 border-4 rounded-4 py-4 border-[#243673]"
                        style="width: 85%; z-index: 1;">


                        <div class="text-right mx-5">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                <i class='bx bx-add-to-queue text-[#243673] fs-1'></i>
                            </button>

                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog  modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100"
                                                id="exampleModalLabel">addEvent</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class=" mx-5 py-2 dashboard_textBox ">

                                                <div
                                                    class="dashboard_textBox  bg-white shadow-lg border-1 border-[#243673] p-2 text-center fs-6 m-auto py-4 h-auto rounded-3 ">

                                                    <label for="file-input"
                                                        class="h-auto dashboard_textBox m-auto py-5 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">

                                                        <input type="file" @change="handleImageChange"
                                                    class="dashboard_textBox  m-auto fs-6 ">
                                                <img :src="image" alt="Selected Image" width="100">

                                                    </label>

                                                    <div class="mt-4 editInput lead position-relative m-auto w-75 mb-5 ">
                                                        <label for="fname"
                                                            class="lead fw-bold text-[#243673]">Article</label>
                                                        <input v-model="title"
                                                            class="input-box lead fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                            type="text" placeholder="Enter here!!">
                                                        <span class="underline position-absolute w-100 "></span>
                                                    </div>
                                                    <div class="mt-4 editInput lead position-relative m-auto w-75 mb-5 ">
                                                        <label for="fname"
                                                            class="lead fw-bold text-[#243673]">Description</label>
                                                        <input v-model="description"
                                                            class="input-box lead fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                            type="text" placeholder="Enter here!!">
                                                        <span class="underline position-absolute w-100 "></span>
                                                    </div>
                                                    <div class="editInput position-relative mt-4 m-auto w-75 ">
                                                        <label for="lname" class="lead fw-bold text-[#243673]">Start
                                                            Date</label>
                                                        <input v-model="start_date"
                                                            class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                            type="date" placeholder="Enter your Last Name">
                                                        <span class="underline position-absolute w-100  "></span>
                                                    </div>
                                                    <div class="editInput position-relative mt-4 m-auto w-75 ">
                                                        <label for="lname" class="lead fw-bold text-[#243673]">End
                                                            Date</label>
                                                        <input v-model="deadline"
                                                            class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                            type="date" placeholder="Enter your Last Name">
                                                        <span class="underline position-absolute w-100  "></span>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer mx-5">
                                            <button @click="addEvent" class="lead btn btn-success mt-3 ml-96">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>









                </div>



            </div>
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
