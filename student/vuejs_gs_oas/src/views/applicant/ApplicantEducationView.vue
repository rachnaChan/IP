<template>
    <div class="all w-[1236px] relative h-fit border-2 border-black border-solid m-auto mt-6">
        <h1 class="text-[#243673] text-[25px] font-normal px-[80px] mt-6"> Section 2 - Applicant's Education</h1>
        <Loading v-if="isLoading" />
        <form @submit.prevent="step2" v-if="!isLoading">
            <div class="px-[80px]">
                <h1 class="text-[20px] font-normal py-4">I. Educational Background <small class="text-[15px]">(List all
                        colleges
                        and universities previously attended, if applicable, in chronological order. Use a separate sheet
                        for
                        additional information)</small></h1>

                <div action=""
                    class="information1 w-full shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px]">
                    <div class="flex gap-[30px] px-[30px]">
                        <label class="flex items-center">Have you graduated from ITC?</label>
                        <div class="flex items-center">
                            <input type="radio" v-model="graduationStatus" value="yes">
                            <label class="px-4 py-1">Yes</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" v-model="graduationStatus" value="no">
                            <label class="px-4 py-1">No</label>
                        </div>
                    </div>

                    <div class="flex gap-[30px] px-[30px] mt-6">
                        <div class="w-full text-left">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">If yes,
                                please state year of completion</label>
                            <input type="text" v-model="itc_graduate_year"
                                class="block w-full p-2.5 rounded-[10px] border-solid border-2 border-[#ADADAD] ">
                        </div>
                        <div class="w-full text-left">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major</label>
                            <input type="text" v-model="major"
                                class="block w-full p-2.5 rounded-[10px] border-solid border-2 border-[#ADADAD] ">
                        </div>
                    </div>
                </div>

                <h1 class="text-[20px] font-normal py-4">II. High School Diploma</h1>
                <div
                    class="information1 shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px]">
                    <div class="flex gap-[30px] px-[30px] ">
                        <div class="w-full text-left">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade</label>
                            <input type="text" v-model="high_school_grade"
                                class="block w-full p-2.5 pr-[130px] focus:pr-[175px] rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                required>
                        </div>

                        <div class="w-full text-left">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                            <input type="text" v-model="high_school_year"
                                class="block w-full p-2.5 pr-[130px] focus:pr-[175px] rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                required>
                        </div>

                        <div class="w-full text-left">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Educational
                                Institution</label>
                            <input type="text" v-model="high_school_name"
                                class="block w-full p-2.5 pr-[130px] focus:pr-[175px] rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                required>
                        </div>

                    </div>

                    <div class="flex gap-[30px] px-[30px] mt-6">
                        <div class="w-full text-left">
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province/City</label>
                            <input type="text" v-model="high_school_province"
                                class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                        </div>
                        <div class="w-full text-left">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <input type="text" v-model="high_school_country"
                                class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                        </div>
                    </div>
                </div>
                
                <div v-for="(higherEducation, index) in higherEducations">
                    <div class="flex justify-between">
                        <h1 class="text-[20px] font-normal py-4">III. High Education</h1>
                        <div class="flex items-end mr-[30px]">
                            <button @click="addMoreForm()" type="button" class="text-[16px] font-normal">
                                Add More
                                <i class="fa-solid fa-square-plus text-[20px] ml-[10px]"></i>
                            </button>
                        </div>
                    </div>
                    <!-- information 3 -->
                    <div
                        class="information1 w-full shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] pb-[50px] mb-[50px]">
                        <fieldset>
                            <legend> </legend>
                            <div class="flex gap-[30px] px-[30px] mt-6">
                                <div class="w-full text-left">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Institution/University</label>
                                    <input v-model="higherEducation.institution" type="text"
                                        :name="'institution[' + index + ']'"
                                        class="block w-full p-2.5 pr-[130px] focus:pr-[175px] rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                                <div class="w-full text-left">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province/City</label>
                                    <input v-model="higherEducation.province" type="text" :name="'province[' + index + ']'"
                                        class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                                <div class="w-full text-left">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                    <input v-model="higherEducation.country" type="text" :name="'country[' + index + ']'"
                                        class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                            </div>

                            <div class="flex gap-6 px-6 mt-6">
                                <div class="w-full text-left">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major/Field
                                        of Study</label>
                                    <input v-model="higherEducation.major" type="text" :name="'major[' + index + ']'"
                                        class="block w-full p-2.5 rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                                <div class="w-full text-left">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree
                                        obtained or expected</label>
                                    <input v-model="higherEducation.degree_obtained" type="text"
                                        :name="'degree_obtained[' + index + ']'"
                                        class="block w-full p-2.5 rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                            </div>
                            <!-- Period of Study( MM/YYYY - MM/YYYY) -->
                            <div class="flex gap-6 px-6 mt-6">
                                <div class="w-full text-left">
                                    <label for="date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Period of
                                        Study (Start)</label>
                                    <input v-model="higherEducation.degree_start_date" type="date"
                                        :name="'degree_start_date[' + index + ']'"
                                        class="block w-full p-2.5 rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                                <div class="w-full text-left">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Graduation
                                        date ( or expected)</label>
                                    <input v-model="higherEducation.degree_end_date" type="date"
                                        :name="'degree_end_date[' + index + ']'"
                                        class="block w-full p-2.5 rounded-[10px] border-solid border-2 border-[#ADADAD] "
                                        required>
                                </div>
                            </div>
                        </fieldset>

                        <button v-if="index != 0" type="button" @click="removeGroup(index)"
                            class="w-full text-end py-4 text-[16px] font-normal px-[50px]">
                            Remove
                            <i class="fa-solid fa-minus text-[20px] ml-[10px]"></i>
                        </button>
                    </div>
                </div>

            </div>

            <!-- button -->
            <div class="flex justify-between mt-[30px] px-[80px] mb-8">
                <button type="button" @click="saveDraft"
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
            graduationStatus: '',

            itc_graduate_year: '',
            major: '',

            high_school_grade: '',
            high_school_year: '',
            high_school_name: '',
            high_school_province: '',
            high_school_country: '',

            higherEducations: [
                {
                    institution: '',
                    province: '',
                    country: '',
                    major: '',
                    degree_obtained: '',
                    degree_start_date: '',
                    degree_end_date: '',
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
            this.higherEducations.push({
                institution: '',
                province: '',
                country: '',
                major: '',
                degree_obtained: '',
                degree_start_date: '',
                degree_end_date: '',
                applicant_id: '',
            });
        },

        removeGroup(index) {
            this.higherEducations.splice(index, 1);
            console.log(index)

            //when doing a remove group we will delete it in database as well (new feature)
        },

        storeDataToVuex() {
            var educationalBackground = {
                id: this.$store.getters.educationalBackground.id,
                itc_graduate_year: this.itc_graduate_year,
                major: this.major,
                high_school_grade: this.high_school_grade,
                high_school_year: this.high_school_year,
                high_school_name: this.high_school_name,
                high_school_province: this.high_school_province,
                high_school_country: this.high_school_country,
            }

            this.$store.commit('setEducationalBackground', educationalBackground)
            this.$store.commit('setHigherEducation', this.higherEducations)
            // this.$store.commit('setHigherEducation', null)

            console.log(this.$store.getters.educationalBackground)
            console.log(this.$store.getters.higherEducation)
        },

        //when user click next
        //all data will be save in vuex waiting for user to click save draft in any page or submit
        step2() {
            this.storeDataToVuex();

            this.$router.push('/applicant/form/foreign-language')
        },

        previousPage() {
            this.storeDataToVuex();

            this.$router.push('/applicant/form/personal-detail-form')
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
            //if applicant_id is not undefined, it mean that user that register our form before and have save draft or submit the form
            //so we need to retrieve therir data in database, if it undefined it mean that user never register before
            //which is why we do not need to fetch data from database like the code below do  
            if (applicant_id !== null && applicant_id !== undefined) {
                //fetch applicant detail as well
                var applicantEducationalBackgroundId = null;
                const response = await axios.get(`http://localhost:8000/api/applicantdetails/${applicant_id}`);
                applicantEducationalBackgroundId = response.data.educational_background_id;
                console.log(applicantEducationalBackgroundId)

                if (this.$store.getters.isEducationalBackgroundInitialized) {
                    const educationalBackgroundResponse = await axios.get(`http://localhost:8000/api/educationalbackgrounds/${applicantEducationalBackgroundId}`)
                    //after fetch data from database we also need to store it in vuex 
                    if (educationalBackgroundResponse.data !== null) {
                        this.$store.commit('setEducationalBackground', educationalBackgroundResponse.data)
                    }
                }

                if (this.$store.getters.higherEducation === null) {
                    const higherEducationResponse = await axios.get(`http://localhost:8000/api/highereducations/search/${applicant_id}`)
                        
                    // this.higherEducations = response.data
                    if (higherEducationResponse.data !== null) {
                        this.$store.commit('setHigherEducation', higherEducationResponse.data)
                    }
                }

                this.isLoading = false
            } else {
                console.log('no data is feched from database')
            }

            //fetch the data of formal personl info from vuex
            if (this.$store.state.educationalBackground !== null && this.$store.state.educationalBackground !== undefined) {
                this.itc_graduate_year = this.$store.getters.educationalBackground.itc_graduate_year;
                this.major = this.$store.getters.educationalBackground.major;
                this.high_school_grade = this.$store.getters.educationalBackground.high_school_grade
                this.high_school_year = this.$store.getters.educationalBackground.high_school_year
                this.high_school_name = this.$store.getters.educationalBackground.high_school_name
                this.high_school_province = this.$store.getters.educationalBackground.high_school_province
                this.high_school_country = this.$store.getters.educationalBackground.high_school_country
            }

            if(this.itc_graduate_year !== null || this.major !== null) {
                this.graduationStatus = "yes"
            }

            if (this.$store.getters.higherEducation !== null && this.$store.getters.higherEducation !== undefined) {
                this.higherEducations = this.$store.getters.higherEducation
            } else {
                console.log('No higher education')
            }

            this.isLoading = false
        },


    }
}

</script>
