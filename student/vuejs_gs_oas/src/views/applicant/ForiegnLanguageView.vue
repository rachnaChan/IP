<template>
    <div class="all w-[1236px] relative h-fit border-2 border-black border-solid m-auto mt-6">
        <h1 class="text-[#243673] text-[25px] font-normal px-[80px] mt-6">Section 3 - Applicant's Foreign Language
            Proficiency</h1>
        <Loading v-if="isLoading" />
        <form @submit.prevent="step3" v-if="!isLoading">
            <div v-for="(foreignLanguage, index) in foreignLanguages" class="px-[80px] py-[40px]">
                <fieldset>
                    <div class="flex justify-between">
                        <h1 v-if="index == 0" class="text-[20px] font-normal py-4">I. English</h1>
                        <h1 v-if="index != 0" class="text-[20px] font-normal py-4">II. Other Language</h1>
                        <div class="flex items-end mr-[30px]">
                            <button type="button" class="text-[16px] font-normal" @click="addMoreForm()">
                                Add More
                                <i class="fa-solid fa-square-plus text-[20px] ml-[10px]"></i>
                            </button>
                        </div>
                    </div>


                    <div class="shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5]">
                        <div
                            class="information1 px-[45px] w-full text-center py-[50px] flex justify-between items-center gap-[100px]">
                            <div class="left_box w-[300px]">
                                <div class="w-full text-left py-2" v-if="index != 0">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What
                                        other language?</label>
                                    <input v-model="foreignLanguage.name" type="text" :name="'name[' + index + ']'"
                                        class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                                <div class="w-full text-left py-2">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Certifacate</label>
                                    <input v-model="foreignLanguage.certificate" type="text"
                                        :name="'certificate[' + index + ']'"
                                        class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                                <div class="w-full text-left py-2">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                        of
                                        Reciever</label>
                                    <input v-model="foreignLanguage.date_of_received" type="date"
                                        :name="'date_of_received[' + index + ']'"
                                        class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                            </div>

                            <!-- line at middle between left_box and right_box -->
                            <!-- <div class="middie_box h-[281.002px] w-[1px] bg-[#707070]">-->

                            <table class="right-box w-full table-fixed h-[180px]">
                                <tr class="text-center py-[10px]">
                                    <td class="py-[10px]">Skills</td>
                                    <td class="py-[10px]">Excellent</td>
                                    <td class="py-[10px]">Good</td>
                                    <td class="py-[10px]">Fair</td>
                                    <td class="py-[10px]">Poor</td>
                                </tr>

                                <tr class="text-center ">
                                    <td class="py-[5px]">Reading</td>
                                    <td v-for="scale in scales" :key="scale.value">
                                        <input type="radio" v-model="foreignLanguage.reading" :value="scale.value"
                                            class="py-[5px]" :check="this.reading === scale.value" required>
                                    </td>
                                </tr>

                                <tr class="text-center  ">
                                    <td class="py-[5px]">Writing</td>
                                    <td v-for="scale in scales" :key="scale.value">
                                        <input type="radio" v-model="foreignLanguage.writing" :value="scale.value"
                                            class="py-[5px]" :check="this.writing === scale.value" required>
                                    </td>
                                </tr>
                                <tr class="text-center  ">
                                    <td class="py-[5px]">Speaking</td>
                                    <td v-for="scale in scales" :key="scale.value">
                                        <input type="radio" v-model="foreignLanguage.speaking" :value="scale.value"
                                            class="py-[5px]" :check="this.speaking === scale.value" required>
                                    </td>
                                </tr>
                                <tr class="text-center  ">
                                    <td class="py-[5px]">Listening</td>
                                    <td v-for="scale in scales" :key="scale.value">
                                        <input type="radio" v-model="foreignLanguage.listening" :value="scale.value"
                                            class="py-[5px]" :check="this.listening === scale.value" required>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <button v-if="index != 0" type="button" @click="removeGroup(index)"
                            class="w-full text-end pb-4 text-[16px] font-normal px-[50px]">
                            Remove
                            <i class="fa-solid fa-minus text-[20px] ml-[10px]"></i>
                        </button>
                    </div>
                </fieldset>
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
</template>

<script>
import { ref } from 'vue'
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

            foreignLanguages: [
                {
                    certificate: '',
                    name: '',
                    date_of_received: '',
                    reading: '',
                    writing: '',
                    speaking: '',
                    listening: '',
                    applicant_id: '',
                }
            ],

            scales: [
                { value: 'Excellent', label: 'Excellent' },
                { value: 'Good', label: 'Good' },
                { value: 'Fair', label: 'Fair' },
                { value: 'Poor', label: 'Poor' },
            ],
        }
    },
    created() {
        this.fetchApplicant();
    },
    methods: {
        addMoreForm() {
            this.foreignLanguages.push({
                certificate: '',
                name: '',
                date_of_received: '',
                reading: '',
                writing: '',
                speaking: '',
                listening: '',
                applicant_id: '',
            });
        },

        removeGroup(index) {
            this.foreignLanguages.splice(index, 1);
            console.log(index)

            //when doing a remove group we will delete it in database as well (new feature)
        },

        storeDataToVuex() {
            // this.$store.commit('setForeignLanguage', null)
            this.$store.commit('setForeignLanguage', this.foreignLanguages)

            console.log(this.$store.getters.foreignLanguage)
        },

        //when user click next
        //all data will be save in vuex waiting for user to click save draft in any page or submit
        step3() {
            this.storeDataToVuex();

            this.$router.push('/applicant/form/work-experience')
        },

        previousPage() {
            this.storeDataToVuex();

            this.$router.push('/applicant/form/education')
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
                if (this.$store.getters.foreignLanguage === null) {
                    const foreignLanguageResponse = await axios.get(`http://localhost:8000/api/foreignlanguages/search/${applicant_id}`)
                    if (foreignLanguageResponse.data !== null) {
                        this.$store.commit('setForeignLanguage', foreignLanguageResponse.data)
                    }
                }

                this.isLoading = false
            } else {
                console.log('no data is feched from database')
            }
            console.log(this.$store.getters.foreignLanguage)

            if (this.$store.state.foreignLanguage !== null && this.$store.state.foreignLanguage !== undefined) {
                this.foreignLanguages = this.$store.getters.foreignLanguage
            }

            this.isLoading = false
        },
    }
}

</script>
