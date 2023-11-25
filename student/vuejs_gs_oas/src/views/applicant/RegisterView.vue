<template>
    <div class="all w-[1236px] h-fit border-2 border-black border-solid">
        <div class="w-full flex justify-center gap-[50px] mt-[70px] items-center">
            <div class="flex ">
                <img class="w-[130px]" src="../../assets/ITC_logo.png" alt="">
                <img class="w-[120px]" src="../../assets/GS_logo.png" alt="">
            </div>
            <div class="text-3xl font-semibold p-8">
                <h1>GRADUATE SCHOOL OF THE INSTIUTE OF</h1>
                <h1 class="px-20">TECHNOLOGY OF CAMBODIA</h1>
            </div>
        </div>
        <div class="flex justify-center mt-[134px] ">
            <form action="" @submit.prevent="register"
                class="w-[988px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px] px-[65px]">
                <h1 class="text-xl mb-[50px]">APPLICANT REGISTER</h1>
                <div class="pb-8 grid grid-cols-2 gap-[30px]">
                    <input class=" p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" type="text"
                        v-model="first_name" id="" placeholder="First name" required>
                    <input class=" p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" type="text"
                        v-model="last_name" id="" placeholder="Last name" required>

                    <select class="p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" id="gender"
                        v-model="gender" required>
                        <option value="" disabled>Gender</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>

                    <!-- <input class=" p-[20px] w-[332px] rounded-[10px] border-solid border-2 border-[#ADADAD]" type="date"
                    v-model="dob" id="" required> -->

                    <!-- <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                    </div> -->

                    <input class="p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" type="text"
                        id="dobInput" @focus="clearPlaceholder" @blur="restorePlaceholder" v-model="dob"
                        placeholder="Date of birth" onfocus="(this.type='date')" onfocusout="(this.type='text')" required>
                </div>
                <div class="pb-8">
                    <input class=" py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="text" v-model="phone_number" id="" placeholder="Phone Number" required>
                </div>
                <div class="pb-8">
                    <input class=" py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="email" v-model="email" id="" placeholder="Email Address" required>
                </div>
                <div class="pb-8 flex gap-[30px]">
                    <input class=" p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" type="password"
                        v-model="password" id="" placeholder="Password" required>
                    <input class=" p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" type="password"
                        v-model="password_confirmation" id="" placeholder="Confirm password" required>
                </div>

                <button class="text-white bg-[#243673] text-[25px] py-[12px] px-[216px] rounded-[10px]" type="submit"> Sign
                    Up</button>
                <p v-if="hasError" class="text-red-500">{{ this.err }}</p>
            </form>
        </div>
    </div>

    <Footer />
</template>
<script>
import { initFlowbite } from 'flowbite'
import axios from 'axios'
import Footer from '../../components/Footer.vue'
import setAuthHeader from '../../libs/apis/axiosConfig'

export default {
    components: {
        Footer,
    },
    data() {
        return {
            first_name: '',
            last_name: '',
            gender: '',
            dob: '',
            phone_number: '',
            email: "",
            password: "",
            password_confirmation: '',

            hasError: false,
            err: '',
        };
    },
    computed: {
        showPlaceholder() {
            return this.selectedGender === '';
        },
    },
    methods: {
     
        register() {
            //format date to DD-MM-YYYY, before send to backend
            const [year, month, day] = this.dob.split('-');
            const formattedDob = `${day}-${month}-${year}`;

            //data that we want to send to backend
            const userData = {
                first_name: this.first_name,
                last_name: this.last_name,
                gender: this.gender,
                dob: formattedDob,
                phone_number: this.phone_number,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            };
            const url = this.$baseURL + '/api/register'
            axios.post(url, userData)
                .then(response => {
                    console.log(response.data);
                    if (response.data.errors) {
                        this.hasError = true;
                        this.err = 'The given email is already taken'
                        this.$router.push('/register');
                    } else {
                        // Save the token to vuex after successful login
                        this.$store.commit('setUser', response.data.user)
                        this.$store.commit('setToken', response.data.token)
                        this.$store.commit('setRole', response.data.role)

                        this.hasError = false;
                        setAuthHeader(response.data.token);

                        this.$router.push('/applicant/admission');

                    }
                })
                .catch(error => {
                    console.log(error)
                });
        },
    },

};
</script>