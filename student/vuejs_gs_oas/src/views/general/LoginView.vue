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
            <form action="" @submit.prevent="login"
                class="w-[988px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px] px-[225px]">
                <h1 class="text-xl mb-[50px]">LOGIN FORM</h1>
                <div class="pb-8">
                    <input class=" p-[20px] w-[500px] rounded-[10px] border-solid border-2 border-[#ADADAD]" type="email"
                        v-model="email" id="" placeholder="Enter your email" required>
                </div>
                <div class="">
                    <input class=" p-[20px] w-[500px] rounded-[10px] border-solid border-2 border-[#ADADAD] "
                        type="password" v-model="password" placeholder="Enter your password" required>
                </div>
                <div class="flex justify-between mb-8">
                    <div class="flex px-5 py-5 gap-[6px] text-[19px]">
                        <input class="scale-125" type="checkbox" v-model="rememberMe" id="rememberMe"><br>
                        <label class="h-[23px]" for="rememberMe">Remember Me</label>
                    </div>
                    <div class="px-5 py-5 text-[19px] text-[#243673]">
                        <div>
                            <a href="/forget-password"> Forgot password? </a>
                        </div>
                    </div>
                </div>
                <button class="text-white bg-[#243673] text-[25px] py-[12px] px-[216px] " type="submit">Log In</button>
                <p v-if="hasError" class="text-red-500">Error: Wrong credentials</p>

                <div class="p-4 text-[#243673]">
                    <p><router-link class=" font-semibold" to="/register"> Register?</router-link> for Graduate of
                        School/ITC</p>
                </div>
            </form>
        </div>
    </div>

    <Footer />
</template>
<script>
import axios from 'axios'
import VueCookies from 'vue-cookies'
import Footer from '../../components/Footer.vue'
import setAuthHeader from '../../libs/apis/axiosConfig'

export default {
    components: {
        Footer
    },
    data() {
        return {
            email: "",
            password: "",
            hasError: false,
            rememberMe: false,
        }
    },
    mounted() {
        const rememberedEmail = VueCookies.get('rememberedEmail');
        const rememberedPassword = VueCookies.get('rememberedPassword');

        if (rememberedEmail && rememberedPassword) {
            this.email = rememberedEmail;
            this.password = rememberedPassword;
        }
    },
    methods: {
        login() {
            const userData = {
                "email": this.email,
                "password": this.password,
            };

            // const url = this.$baseURL + '/api/login'

            axios.post('http://localhost:8000/api/login', userData)
                .then(response => {
                    console.log(response.data);
                    if (response.data.message == "Wrong credentials") {
                        this.hasError = true;
                        this.$router.push('/login');
                    } else {
                        // Save the token to vuex after successful login
                        this.$store.commit('setUser', response.data.user)
                        this.$store.commit('setToken', response.data.token)
                        this.$store.commit('setRole', response.data.role)

                        this.hasError = false;
                        setAuthHeader(response.data.token);

                        if (this.rememberMe) {
                            VueCookies.set('rememberedEmail', this.email, '3d'); // Set cookie for 3 days
                            VueCookies.set('rememberedPassword', this.password, '3d');      
                        }

                        var routeName = response.data.role.toLowerCase();
                        if(routeName == 'applicant') {
                            this.$router.push(`/${routeName}/admission`);
                        } else {
                            this.$router.push(`/${routeName}/dashboard`);
                        }
                    }
                })
                .catch(error => {
                    console.log(error)
                });
        },
    }
}
</script>