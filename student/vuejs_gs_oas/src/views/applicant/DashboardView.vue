<template>
    <div class="w-[1236px] min-h-screen border-2 border-black border-solid">
        <div class="flex">
            <div class="bg-[#243673] min-h-screen min-w-[290px] relative">
                <div class="flex px-[85px] py-[25px]">
                    <img class="w-[60px]" src="../../assets/ITC_logo.png" alt="">
                    <img class="w-[60px]" src="../../assets/GS_logo.png" alt="">
                </div>

                <div class="mt-[15px]">
                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/applicant/admission" class="px-[30px] py-[10px] rounded-tr-[10px] rounded-br-[10px]" active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-house text-[22px] mr-[13px]"></i>
                            Graduate Admissions
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/applicant/status" class="pl-[30px] pr-[61px] py-[10px] rounded-tr-[10px] rounded-br-[10px]" active-class="text-[#243673] bg-[#E2F2FF]">   
                            <i class="fa-solid fa-user-check text-[20px] mr-[13px]"></i>
                            Applicant Status
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/applicant/inbox" class="pl-[30px] pr-[116px] py-[10px] rounded-tr-[10px] rounded-br-[10px]" active-class="text-[#243673] bg-[#E2F2FF]">   
                            <i class="fa-solid fa-bell text-[25px] mr-[13px]"></i>
                            My Inbox
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/applicant/setting" class="pl-[30px] pr-[129px] py-[10px] rounded-tr-[10px] rounded-br-[10px]" active-class="text-[#243673] bg-[#E2F2FF]">   
                            <i class="fa-solid fa-gear text-[25px] mr-[13px]"></i>
                            Setting
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/applicant/help-feedback" class="pl-[30px] pr-[62px] py-[10px] rounded-tr-[10px] rounded-br-[10px]" active-class="text-[#243673] bg-[#E2F2FF]">   
                            <i class="fa-regular fa-circle-question text-[25px] mr-[13px]"></i>
                            Help & Feedback
                        </router-link>
                    </div>
                </div>

                <div>
                    <button @click="logout" class="text-[15px] font-medium text-white flex items-center absolute bottom-10 left-[30px]
                                                hover:bg-[#E2F2FF] hover:text-[#243673] hover:pl-[30px] hover:pr-[129px] hover:py-[10px] hover:rounded-tr-[10px] hover:rounded-br-[10px] hover:left-0 hover:bottom-[30px]">
                        <i class="fa-solid fa-arrow-right-from-bracket text-[23px] mr-[13px]"></i>
                        Logout
                    </button>
                </div>
            </div>
            <div>
                <router-view></router-view>
                <h1>Welcome to applicant homepage.</h1>
                <div>{{ this.$store.state.token }}</div>
                <div>{{ this.$store.state.user }}</div>
                <div>{{ this.$store.state.role }}</div>
                
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {

    methods: {
        logout() {
            axios.post('http://localhost:8000/api/logout')
                .then(response => {
                    console.log(response.data);
                    // this.$store.commit('setUser', null)
                    // this.$store.commit('setToken', null)
                    // this.$store.commit('setRole', null)
                    // this.$store.commit('setProgramId', null)
                    // this.$store.commit('setFormalPersonalInfo', null)
                    // this.$store.commit('setCurrentContactInfo', null)
                    // this.$store.commit('setSecondaryContactInfo', null)
                    // this.$store.commit('setEducationalBackground', null)
                    // this.$store.commit('setHigherEducation', null)
                    // this.$store.commit('setForeignLanguage', null)
                    // this.$store.commit('setWorkExperience', null)

                    this.clearStorage();
                    
                    // this.$store.commit('clearTokenAndUser', null)
                    
                })
                .catch(error => {
                    console.log(error)
                });
        },

        async clearStorage() {
            localStorage.clear()
                    
            this.$router.push('/login');
        }
    }
}
</script>