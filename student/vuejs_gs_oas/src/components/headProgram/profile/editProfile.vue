
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

            axios.get(`http://localhost:8000/api/head/info`)
                .then(response => {
                    this.user = response.data;
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

            axios.post(`http://localhost:8000/api/head/updateInfo`, formData)
                .then(response => {

                    this.$emit('user-edited');
                    console.log(FormData);
                    console.log(response.data);
                    this.$router.go(0);
                    // this.$router.push({ name: 'studentProfile', params: { userId: user.student_id } });

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
    <div class="h-100" v-if="user">


        <div class="dashboard_ContainerFluid">
            <div class="row flex-nowrap">
                <div class=" col-md-3 col-xl-2 px-sm-2 min-vh-100 " style=" background-color: #233673;">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-23text-white">

                        <router-link to="/head/dashboard" class="text-decoration-none">
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


                        <!-- <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">

                            <li class="nav-item ">
                                <router-link :to="{ name: 'studentCourse', params: { userId: user.student_id } }"
                                    class="text-decoration-none"> <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5' style='color:white'></i>
                                        <span class="ms-1 d-none d-sm-inline text-white fs-5">Course</span>
                                    </a>
                                </router-link>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="nav-link align-middle px-0  mx-4" id="dropdownUser1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='mx-2 bx bx-book-open fs-4' style='color:white'></i>
                                    <span class="ms-1 d-none d-sm-inline text-white fs-5">My
                                        Course</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                    aria-labelledby="dropdownUser1">

                                    <li>
                                        <router-link
                                            :to="{ name: 'studentDraftCourse', params: { userId: user.student_id } }"
                                            class="text-decoration-none text-dark">
                                            <a class="dropdown-item " href="#">Courses Requested</a>
                                        </router-link>
                                    </li>
                                    <li class="mt-1">
                                        <router-link :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                                            class="text-decoration-none">
                                            <a href="#" class="dropdown-item ">
                                                Course Approved
                                            </a>
                                        </router-link>

                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item ">
                                <router-link :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                                    class="text-decoration-none"> <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-file-doc fs-5' style='color:white'></i>
                                        <span class="ms-1 d-none d-sm-inline text-white fs-5">Document</span></a>
                                </router-link>
                            </li>

                            <li class="nav-item  mt-5">
                                <div class="dropdown mt-0  ">
                                    <a href="#" class="d-flex align-items-center text-white text-decoration-none  mx-4"
                                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img :src="getUserImageURL(user)" ui:alt="user.name"
                                            class="rounded-circle img-fluid mx-5" style="width: 50px; height: 50px;">

                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                        aria-labelledby="dropdownUser1">
                                        <router-link :to="{ name: 'studentProfile', params: { userId: user.student_id } }"
                                            class="text-decoration-none">
                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                            <li class="mt-1">
                                                <a href="#" class="dropdown-item " @click="logout">
                                                    <span class="ms-1 d-none d-sm-inline">Logout</span>
                                                </a>
                                            </li>
                                        </router-link>

                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <p class="lead mt-5 text-white mx-4 fs-6  text">{{ currentDateTime }}</p>

                            </li>

                        </ul> -->
                        <hr>
                    </div>
                </div>

                <div class="col custom-scrollbar col justify-content-center overflow-scroll flex-nowrap">
                    <div class="position-fixed w-100 h-16 d-flex justify-content-between bg-white">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-1  ">Update Info </p>

                        </div>

                        <div class="d-flex w-25 text-right m-auto mx-5">

                            <i class='bx bx-bell fs-1 mt-3' style=" color: #233673;"></i>

                            <div class="dropdown mt-2  ">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="getUserImageURL(user)" ui:alt="user.name"
                                        class="rounded-circle img-fluid mx-5" style="width: 50px; height: 50px;">

                                </a>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                    aria-labelledby="dropdownUser1">
                                    <router-link :to="{ name: 'headProfile', params: { userId: user.id } }"
                                        class="text-decoration-none">
                                        <li><a class="dropdown-item " href="#">Profile</a></li>
                                        <li class="mt-1">
                                            <a href="#" class="dropdown-item " @click="logout">
                                                <span class="ms-1 d-none d-sm-inline">Logout</span>
                                            </a>
                                        </li>
                                    </router-link>

                                </ul>
                            </div>
                        </div>


                    </div>

                    <div class="lead py-5 mt-5">
                        <div class="container rounded bg-white mt-5 mb-5">

                            <form @submit.prevent="updateProfile" enctype="multipart/form-data"
                                class="response row justify-content-around">

                                <div class="col-md-4 border border-dark ">
                                    <div class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto">
                                        <span class=" text-dark fs-5 fw-bold">Select your profile picture</span>
                                        <label for="file-input"
                                            class="drop-container  position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                            <span class="drop-title text-muted fs-4  text-center ">Drop here
                                                !!</span>
                                            or

                                            <input type="file" @change="handleImageChange"
                                                class="dashboard_textBox  m-auto fs-6 ">
                                            <img :src="image" alt="Selected Image" width="100">

                                        </label>
                                    </div>
                                    
                                    <div class="editInput position-relative mt-4 m-auto w-75 mb-5 ">
                                        <label for="fname">User name</label>
                                        <input v-model="username"
                                            class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                            type="text" placeholder="Enter here!!">
                                        <span class="underline position-absolute w-100 "></span>
                                    </div>

                                    <div>
                                        <router-link :to="{ name: 'headProfile', params: { userId: user.id } }"
                                            class="text-decoration-none text-dark">
                                            <button
                                                class="d-flex align-items-center justify-content-center bg-secondary border-0 bg-white rounded-3 cursor-pointer">
                                                <i class='bx bx-left-arrow-alt' style='color:#243673'></i>
                                                <span>Back</span>
                                            </button>
                                        </router-link>
                                    </div>




                                </div>

                                <div class="col-md-7 border border-dark">
                                    <div class="p-3 py-5 text-center">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class='bx bx-edit' style='color:#243673'></i>
                                            <h4 class="text-right mx-3 fs-2 mt-1">Update Info</h4>


                                        </div>

                                        <div class="d-flex justify-content-around">

                                            <div class="editInput position-relative mt-3 m-auto w-50 ">
                                                <label for="fname">First name</label>
                                                <input v-model="first_name"
                                                    class="input-box fs-5 p-2 border-0 border-bottom  w-75 bg-transparent"
                                                    type="text" placeholder="Enter here!!">
                                                <span class="underline position-absolute w-100 "></span>
                                            </div>


                                            <div class="editInput position-relative mt-3 m-auto w-50 ">
                                                <label for="lname">Last name</label>
                                                <input v-model="last_name"
                                                    class="input-box fs-5 p-2 border-0 border-bottom  w-75 bg-transparent"
                                                    type="text" placeholder="Enter here!!">
                                                <span class="underline position-absolute w-100  "></span>
                                            </div>

                                        </div>

                                        <div class="editInput position-relative mt-4 m-auto w-75 ">
                                            <label for="lname">Phone Number</label>
                                            <input v-model="phone_number"
                                                class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="text" placeholder="Enter here!!">
                                            <span class="underline position-absolute w-100  "></span>
                                        </div>
                                        <div class="editInput position-relative mt-4 m-auto w-75">
                                            <label for="lname">Bio </label>
                                            <input v-model="bio"
                                                class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="text" placeholder="Enter here!!">
                                            <span class="underline position-absolute w-100  "></span>
                                        </div>
                                        <div class="editInput position-relative mt-4 m-auto w-75 ">
                                            <label for="lname">Dob</label>
                                            <input v-model="dob"
                                                class="input-box fs-5 p-2 border-0 border-bottom  w-100 bg-transparent"
                                                type="date" placeholder="Enter your Last Name">
                                            <span class="underline position-absolute w-100  "></span>
                                        </div>



                                        <button type="submit"
                                            class="text-center mt-5 d-flex align-items-center justify-content-center bg-secondary border-0 bg-white rounded-3 cursor-pointer "
                                            style="margin-left: 70%;">
                                            Update
                                            <i class='bx bxs-right-top-arrow-circle' style='color:#243673'></i>
                                        </button>

                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>

                    <!-- <div class="bg-slate-100 mt-5 " style="height: 35px;">
                        <p class="text-center">2022 Graduate school-ITC, All Right Reserved </p>
                    </div> -->



                </div>

            </div>
        </div>
    </div>
</template>

<style lang="scss" >
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

p {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.dashboard_ContainerFluid {
    height: 370px;

}

.dashboard_Container {
    width: 100%;
    height: 60px;
    background-color: #243673;
}

.dashboard_Header {
    width: 200px;
}

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


.response {
    @media screen and (max-width: 100%) {
        height: auto;
    }
}

.dashboard_InputSearch {

    height: 30px;
    width: 50px;
    padding: 10px;
    transition: .5s ease-in-out;
    box-shadow: 0px 0px 3px #f3f3f3;
    padding-right: 40px;


}

.dashboard_IconInput {
    right: 0px;
    cursor: pointer;
    width: 50px;
    height: 30px;
    pointer-events: painted;
    transition: .2s linear;
}

.dashboard_IconInput:focus~.dashboard_InputSearch,
.dashboard_InputSearch:focus {
    box-shadow: none;
    width: 250px;
    border-radius: 0px;
    background-color: transparent;
    border-bottom: 3px solid #243673;
    transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}

// li:hover {
//     background-color: aliceblue;
// }

.custom-scrollbar {
    width: 100%;
    height: 700px;
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

/*Button*/
.card-button {
    padding: .3em;
    cursor: pointer;
    height: 50px;
    transition: .3s ease-in-out;
}

.card-button:hover {
    border: 1px solid #000000;
    background-color: gray;
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

button {
    height: 3em;
    width: 120px;
    letter-spacing: 1px;
    transition: all 0.2s linear;

}

button>i {
    margin-right: 5px;
    margin-left: 5px;
    font-size: 20px;
    transition: all 0.1s ease-in;
}

button:hover>i {
    font-size: 1.2em;
    transform: translateX(-5px);
}

button:hover {
    box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
    transform: translateY(-2px);
}
</style>

