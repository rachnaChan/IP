
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
            <form  @submit.prevent="forgotPassword"
                class="w-[988px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px] px-[225px]">
                <h1 class="text-xl mb-[50px]">REQUEST NEW PASSWORD</h1>
                <div class="pb-6">
                    <input
                        class=" p-[20px] w-[500px] rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="email" v-model="email" id="" placeholder="Email address" required>
                </div>
                <div class="flex justify-between mb-6 px-5 text-[#243673]">
                    <router-link to="/login">
                        <h1>Remember Your Password?</h1>
                    </router-link>
                    
                </div>
                <button class="text-white bg-[#243673] text-[25px] py-[12px] px-[216px] rounded-[10px] ">Submit</button>
                
            </form>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    // import store from './store';
    export default {
        data() {
            return {
                email: "",
            }
        },
        methods: {
        async forgotPassword() {
            try {
                console.log(this.email)
                // const url = this.$baseURL + '/api/forgot-password'
                const response = await axios.post('http://localhost:8000/api/forgot-password', {
                email: this.email 
               
                });
                console.log(this.email);

                // Set the email in the Vuex store
                this.$store.commit('setEmail', this.email);
                console.log("Stored Email in Vuex:", this.email);
                
                console.log(response);
                // Redirect to Reset Password page with email and token
                this.$router.push({ name: 'login', params: { email: this.email, token: response.data.token } });
            } catch (error) {
              
                // console.error(error.response.data);
        }
    }
}
    }
</script>
