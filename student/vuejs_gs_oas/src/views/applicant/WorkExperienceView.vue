<template>
    <div class="all w-[1236px] relative h-fit m-auto mt-6">
        <h1 class="text-[#243673] text-[25px] font-normal px-[80px] mt-6">Section 4 - Applicant's Work Experiences</h1>
        <Loading v-if="isLoading" />
        <div class="px-[80px] py-[52px]" v-if="!isLoading">
            <form @submit.prevent="step4"
                class="information1 ">
                <div v-for="(workExperience, index) in workExperiences" class="shadow-[0_3px_3px_2px_rgba(0,0,0,0.16)] rounded-[15px] backdrop-opacity-[1.5] px-[45px] w-full pb-[50px] pt-[10px] mb-[50px]">
                    <div class="flex justify-between">
                        <h1 class="text-[19px] font-normal py-4 mb-6">(A) List your work experiences in order </h1>
                        <div class="flex items-center">
                            <button type="button" class="text-[16px] font-normal" @click="addMoreForm()">
                                Add More
                                <i class="fa-solid fa-square-plus text-[20px] ml-[10px]"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex gap-[35px] mb-6">
                        <div class="flex gap-[30px] w-2/5">
                            <div class="w-full">
                                <label for="text"
                                    class="text-center block mb-[30px] text-sm font-medium text-gray-900 dark:text-white">
                                    From </label>
                                <input v-model="workExperience.date_from" type="date" :name="'date_from[' + index + ']'" required
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] ">
                            </div>
                            <div class="w-full">
                                <label for="text"
                                    class="text-center block mb-[30px] text-sm font-medium text-gray-900 dark:text-white">
                                    To </label>
                                <input v-model="workExperience.date_to" type="date" :name="'date_to[' + index + ']'" required
                                    class="block w-full  rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                    placeholder="">
                            </div>
                        </div>

                        <div class="middie_box h-fit-content w-[.5px] bg-[#707070]"></div>

                        <div class="flex gap-[30px] w-3/5">
                            <div class="w-full">
                                <label for="text"
                                    class="text-center block mb-[30px] text-sm font-medium text-gray-900 dark:text-white">
                                    Institution/Company </label>
                                <input  v-model="workExperience.company_name" type="text" :name="'company_name[' + index + ']'" required
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                    placeholder="">
                            </div>

                            <div class="w-full">
                                <label for="text"
                                    class="text-center block mb-[30px] text-sm font-medium text-gray-900 dark:text-white">
                                    Title/Position </label>
                                <input v-model="workExperience.position" type="text" :name="'position[' + index + ']'" required
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="">
                         <h1 class="text-[19px] font-normal py-4 mb-6">(B) Describe your experiences related to this proposed study program (if any) </h1>
                        <textarea rows="3" v-model="workExperience.description" type="text" :name="'description[' + index + ']'" required
                            class="information1 px-[45px] w-full shadow-[0_3px_3px_2px_rgba(0,0,0,0.16)] rounded-[15px] backdrop-opacity-[1.5] text-left py-[20px]"> </textarea>
                    </div>

                    <button v-if="index != 0" type="button" @click="removeGroup(index)"
                        class="w-full text-end pt-4 text-[16px] font-normal px-[50px]">
                        Remove
                        <i class="fa-solid fa-minus text-[20px] ml-[10px]"></i>
                    </button>
                </div>

                <!-- button -->
                <div class="flex justify-between mt-[30px] px-[80px] mb-8">
                    <button @click="saveDraft" type="button"
                        class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold hover:bg-[#243673] hover:text-[#ffffff]">Save
                        Draft</button>
                    <div class=" flex gap-6">
                        <button type="button" @click="previousPage"
                            class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Previous</button>
                        <button type="submit"
                            class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import saveDraftForm from '../../libs/apis/saveDraftForm';
import Loading from '../../components/Loading.vue';

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading: true,

            workExperiences: [
                {
                    date_from: '',
                    date_to: '',
                    company_name: '',
                    position: '',
                    description: '',
                    applicant_id: '',
                }
            ]
        }
    },
    created() {
        this.fetchApplicant();
    },
    methods: {
        addMoreForm() {
            this.workExperiences.push({
                date_from: '',
                date_to: '',
                company_name: '',
                position: '',
                description: '',
                applicant_id: '',
        });
        },

        removeGroup(index) {
            this.workExperiences.splice(index, 1);
            console.log(index)

            //when doing a remove group we will delete it in database as well (new feature)
        },

        storeDataToVuex() {
            this.$store.commit('setWorkExperience', this.workExperiences)
            // this.$store.commit('setWorkExperience', null)

            console.log(this.$store.getters.workExperience)
        },

        //when user click next
        //all data will be save in vuex waiting for user to click save draft in any page or submit
        step4() {
            this.storeDataToVuex();

            this.$router.push('/applicant/form/upload-document')
        },

        previousPage() {
            this.storeDataToVuex();

            this.$router.push('/applicant/form/foreign-language')
        },

        async saveDraft() {
            this.storeDataToVuex();

            this.isLoading = true
            await saveDraftForm();
            this.isLoading = false
        },

        async fetchApplicant() {
            var applicant_id = this.$store.state.user?.applicant_id
            console.log(applicant_id);
            if (applicant_id !== undefined && applicant_id !== null) {
                if (this.$store.getters.workExperience === null) {
                    const workExperienceResponse = await axios.get(`http://localhost:8000/api/workexperiences/search/${applicant_id}`)
                    if (workExperienceResponse.data !== null) {
                        this.$store.commit('setWorkExperience', workExperienceResponse.data)
                    }
                }

                this.isLoading = false
            } else {
                console.log('no data is feched from database')
            }

            console.log(this.$store.getters.workExperience)

            if (this.$store.state.workExperience !== null && this.$store.state.workExperience !== undefined) {
                this.workExperiences = this.$store.getters.workExperience
            }

            this.isLoading = false
        },
    }
}
</script>