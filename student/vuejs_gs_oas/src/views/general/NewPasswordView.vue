
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
            <form @submit.prevent="resetPassword"
                class="w-[988px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px] px-[225px]">
                <h1 class="text-xl mb-[50px]">SET NEW PASSWORD</h1>
                <div class="pb-6">
                    <input
                        class=" p-[20px] w-[500px] rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="password" v-model="newPassword" id="" placeholder="New Password" required>
                </div>
                <div class="pb-6">
                    <input
                        class=" p-[20px] w-[500px] rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="password" v-model="confirmPassword" id="" placeholder="Confirm new Password" required>
                </div>
                <div class="flex justify-between mb-6 px-5 text-[#243673]">
                    <router-link to="/login">
                        <h1>Go back to Login</h1>
                    </router-link>
                    
                </div>
                <button type="submit" class="text-white bg-[#243673] text-[25px] py-[12px] px-[216px] rounded-[10px] ">Submit</button>       
            </form>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data(){
            return{
                newPassword: '',
                confirmPassword: '',
            };
        },
        created() {
            // Retrieve token from the URL
            this.token = this.$route.query.token;
            console.log("Token:", this.token);

            // Retrieve email from Vuex Use getters.email here
            this.email = this.$store.getters.email; 
            console.log("Email:", this.email);
        },
        methods: {
            async resetPassword() {
                try {
                    // const url = this.$baseURL + '/api/reset-password'
                    const response = await axios.post('http://localhost:8000/api/reset-password', {
                    email: this.email,
                    token: this.$route.query.token,
                    password: this.newPassword,
                    password_confirmation: this.confirmPassword
                });
                
                console.log(response);
                
                this.$router.push('/login');
            } catch (error) {
              
                console.error(error.response.data);
        }
            },
        },
   
    }
</script>
