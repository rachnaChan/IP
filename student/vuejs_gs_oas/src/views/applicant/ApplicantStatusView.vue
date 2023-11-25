<template>
    <div class="px-[50px] py-[40px] w-full">
        <div class="text-3xl font-semibold text-center">
            <h1>GRADUATE SCHOOL OF THE INSTIUTE OF</h1>
            <h1> TECHNOLOGY OF CAMBODIA</h1>
        </div>

        <hr class="w-full bg-[#ADADAD] h-[3px] mt-[20px]">

        <Loading v-if="isLoading" />
        <div class="flex mt-[80px] gap-[50px]" v-if="!isLoading">
            <div class="">
                <img :src="this.formalPerosnalInfoData.image" alt="profile" class="w-[150px] h-[225px] border border-[#ADADAD] border-solid">
                <div class="mt-[20px]">
                    <div class="text-[18px] text-[#707070]">Applicant ID: {{ this.applicantDetailData.id }}</div>
                    <div class="text-[18px] text-[#707070]">Created On: {{ this.createDate }}</div>
                </div>
            </div>

            <div class="border-2 border-[#243673] border-solid rounded-[10px] p-[40px] w-[587px]">
                <div class="text-[24px] font-bold text-[#243673] text-center">Applicant's Detail {{ this.applicantDetailData.academic_year }}</div>
                <hr class="w-full bg-[#ADADAD] h-[3px] mt-[15px]">
                <table class="px-[50px] mt-[30px] w-full">
                    <tr>
                        <td>Program:</td>
                        <td>{{ this.program.name }}</td>
                    </tr>
                    <tr>
                        <td>Degree:</td>
                        <td>{{ this.formalPerosnalInfoData.type_of_degree }}</td>
                    </tr>
                    <tr>
                        <td>Level:</td>
                        <td>{{ this.formalPerosnalInfoData.registration_level }}</td>
                    </tr>
                    <tr>
                        <td>Study Pathway:</td>
                        <td>{{ this.formalPerosnalInfoData.study_pathway }}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>{{ this.applicantDetailData.applicant_status }}</td>
                    </tr>        
                    <tr>
                        <!-- still need to come back again to change the score display, after i finish the score crud in backend -->
                        <td>Score:</td>
                        <td>{{ this.applicantDetailData.applicant_score }}</td>
                    </tr>
                </table>
                <div class="border-[1px] border-[#ADADAD] border-solid rounded-[10px] h-[100px] px-[20px] py-[15px] mx-[30px] mt-[30px]">
                    Feedback: {{ this.feedback }}
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Loading from '../../components/Loading.vue';

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading: true,

            applicantDetailData: '',
            formalPerosnalInfoData: '',
            program: '',
            feedback: '',
            createDate: '',
        }
    },
    created() {
        this.fetchApplicantData();
    },
    methods: {
        async fetchApplicantData() {
            const applicant_id = this.$store.state.user?.applicant_id;

            const applicantDetailResponse = await axios.get(`http://localhost:8000/api/applicantdetails/${applicant_id}`)
            this.applicantDetailData = applicantDetailResponse.data

            const formalPerosnalInfoResponse = await axios.get(`http://localhost:8000/api/formalpersonalinfos/${this.applicantDetailData.formal_personal_info_id}`)
            this.formalPerosnalInfoData = formalPerosnalInfoResponse.data

            const programResponse = await axios.get(`http://localhost:8000/api/programs/${this.applicantDetailData.program_id}`)
            this.program = programResponse.data

            const feedbackResponse = await axios.get(`http://localhost:8000/api/feedbacks/search/${applicant_id}`)
            this.feedback = feedbackResponse.data
        
            this.createDate = this.applicantDetailData?.created_at?.slice(0, 10)

            this.isLoading = false;
        }
    }
}
</script>