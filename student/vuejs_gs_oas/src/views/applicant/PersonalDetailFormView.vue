<template>
    <div class="all w-[1236px] relative h-fit m-auto mt-6">
        <h1 class="text-[#243673] text-[25px] font-normal px-[80px] mt-6"> Section 1 - Applicant's Personal Detail</h1>
        <Loading v-if="isLoading" />
        <form @submit.prevent="step1" enctype="multipart/form-data" v-if="!isLoading">
            <div class="px-[80px] flex justify-between">
                <div class="">
                    <h1 class="text-[20px] font-normal p-4"> Please choose a program*</h1>
                    <!-- <div v-for="program in programs" :key="program.id">
                        <input type="radio" v-model="program_id" :value="program.id" :check="this.program_id === program.id">
                        <label class="">{{ program.name }}</label><br>
                    </div> -->
                    <div class="px-4">
                        <label v-for="program in programs" :key="program.id">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="radio" required v-model="program_id" :value="program.id"
                                        :check="this.program_id === program.id">
                                    <p class="px-4 py-1">{{ program.name }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="image">
                    <!-- <button @click="deleteImage"> delete image</button> -->
                    <div class="flex flex-col items-center">
                        <img :src="imageUrl"
                            class="w-[200px] h-[300px] border-2 border-[#ADADAD] border-solid  mb-[20px] object-cover"
                            alt="Size 4x6" />
                        <input type="file" @change="handleImageChange" class="" />
                        <span v-if="isFileError" class="text-red-500 text-xl font-bold">FIlE REQUIRED</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between px-[80px] mt-5">
                <div class="pathway_study">
                    <h1 class="text-[20px] font-normal p-4">Select study pathway *</h1>
                    <div class="px-4">
                        <label v-for="studyPathway in studyPathways" :key="studyPathway.value">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="radio" v-model="study_pathway" :value="studyPathway.value"
                                        :check="this.study_pathway === studyPathway.value" required>
                                    <p class="px-4 py-1">{{ studyPathway.label }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="type_of_degree">
                    <h1 class="text-[20px] font-normal p-4">Type of Degree *</h1>
                    <div class="px-4">
                        <label v-for="typeOfDegree in typeOfDegrees" :key="typeOfDegree.value">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="radio" v-model="type_of_degree" :value="typeOfDegree.value"
                                        :check="this.type_of_degree === typeOfDegree.value" required>
                                    <p class="px-4 py-1">{{ typeOfDegree.label }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="registration px-[80px]">
                <h1 class="text-[20px] font-normal p-4">Registration *</h1>
                <div class="px-4">
                    <label v-for="registrationLevel in registrationLevels" :key="registrationLevel.value">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <input type="radio" v-model="registration_level" :value="registrationLevel.value"
                                    :check="this.registration_level === registrationLevel.value" required>
                                <p class="px-4 py-1">{{ registrationLevel.label }}</p>
                                <p v-if="registrationLevel.label == 'Level M2'" class="ml-[-10px]">(for ITC student with GPA
                                    at least 2.5)</p>
                            </div>
                        </div>
                    </label>

                    <div class="py-2 flex mt-[15px]">
                        *
                        <div class="pl-[5px] inline-block">
                            <p class="inline-block">please see the details of each program in the leaflet for the possible
                                types of diploma
                                and
                                pathway via this link</p>
                            <a href="http://bit.ly/itcmaster2022-23"
                                class="text-[#063CF5]">http://bit.ly/itcmaster2022-23</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Form for complete all Information -->
            <div class=" items-center px-[80px] py-4">

                <!-- form information1 -->
                <h1 class="text-[20px] font-normal p-4">I. Particular of Applicant</h1>
                <div
                    class="information1 w-[1088px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px] grid grid-cols-2 gap-x-[30px] gap-y-[20px] px-[30px]">

                    <div class="w-full text-left">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Family
                            Name /
                            Surname</label>
                        <input type="text" v-model="family_name"
                            class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                    </div>

                    <div class="w-full text-left">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Given
                            Name /
                            First name</label>
                        <input type="text" v-model="given_name"
                            class=" block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                    </div>


                    <div class="w-full text-left">
                        <label for="text"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                        <select class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" id="gender"
                            v-model="gender" required>
                            <option value="" disabled>Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>

                    <div class="w-full text-left">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marital
                            Status</label>
                        <select class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                            v-model="marital_status" required>
                            <option disabled selected value="">Marital Status</option>
                            <option value="single">Single</option>
                            <option value="taken">Taken</option>
                            <option value="married">married</option>
                            <option value="divorced">divorced</option>
                        </select>
                    </div>


                    <div class="w-full text-left">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                            Birth</label>
                        <input class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD]" type="date"
                            v-model="dob" required>
                    </div>

                    <div class="w-full text-left">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Place of
                            Birth</label>
                        <input type="text" v-model="place_of_birth" id="text"
                            class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                    </div>


                    <div class="w-full text-left">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country
                            of
                            Birth</label>
                        <input type="text" v-model="country_of_birth" id="text"
                            class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                    </div>
                    <div class="w-full text-left">
                        <label for="text"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
                        <input type="text" v-model="nationality" id="text"
                            class="p-[10px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                    </div>
                </div>

                <!-- form information2 -->
                <div class="information2 py-4">
                    <h1 class="text-[20px] font-normal py-6">II. Current Contact Information</h1>
                    <div action=""
                        class="w-[1088px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px]">
                        <div class="w-full text-left px-[30px]">
                            <label for="text"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" v-model="cur_address" id="text"
                                class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                        </div>

                        <div class="flex gap-[30px] px-[30px] mt-6">
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal
                                    Code</label>
                                <input type="text" v-model="cur_postal_code" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province/City</label>
                                <input type="text" v-model="cur_province" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                <input type="text" v-model="cur_country" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                        </div>

                        <div class="flex gap-[30px] px-[30px] mt-6">
                            <div class="w-full text-left">
                                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                    Number</label>
                                <input type="text" v-model="cur_phone_number" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                    Address</label>
                                <input type="email" v-model="cur_email" id="email"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- form information3 -->
                <div class="information3">
                    <h1 class="text-[20px] font-normal py-6">III. Secondary Contact Information <small
                            class="text-[15px] text-red-500"> (We will use this address if we can not reach you at the first
                            address) </small></h1>
                    <div action=""
                        class="w-[1088px] shadow-[0_3px_3px_0_rgba(0,0,0,0.33)] rounded-[15px] backdrop-opacity-[1.5] text-center py-[50px]">
                        <div class="flex gap-[30px] px-[30px] mt-6">
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                                    Personal's Name</label>
                                <input type="text" v-model="sec_contact_person_name" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                <input type="text" v-model="sec_address"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                        </div>

                        <div class="flex gap-[30px] px-[30px] mt-6">
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal
                                    Code</label>
                                <input type="text" v-model="sec_postal_code" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province/City</label>
                                <input type="text" v-model="sec_province" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                <input type="text" v-model="sec_country" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                        </div>

                        <div class="flex gap-[30px] px-[30px] mt-6">
                            <div class="w-full text-left">
                                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                    Number</label>
                                <input type="text" v-model="sec_phone_number" id="text"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                            <div class="w-full text-left">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                    Address</label>
                                <input type="email" v-model="sec_email"
                                    class="block w-full rounded-[10px] border-solid border-2 border-[#ADADAD] " required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- button -->
            <div class="flex justify-between mt-[30px] px-[80px] mb-8">
                <button @click="saveDraft" type="button"
                    class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold hover:bg-[#243673] hover:text-[#ffffff]">Save
                    Draft</button>
                <button type="submit"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Next</button>
                <!-- <butoon @click="test" type="button">Test</butoon> -->
            </div>
        </form>
    </div>
</template>
<script>
import axios from 'axios';
import saveDraftForm from '../../libs/apis/saveDraftForm'
import Loading from '../../components/Loading.vue';

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading: true,
            imagePath: '',

            selectedImage: '',
            imageUrl: '',
            isFileError: false,
            programs: [],
            formalPersonalInfoData: [],
            tmpfile: {},
            //applicant detail
            program_id: null,
            //formal personal info
            study_pathway: null,
            type_of_degree: null,
            registration_level: null,
            family_name: null,
            given_name: null,
            gender: null,
            marital_status: null,
            dob: null,
            place_of_birth: null,
            country_of_birth: null,
            nationality: null,
            //current contact info
            cur_address: null,
            cur_postal_code: null,
            cur_province: null,
            cur_country: null,
            cur_phone_number: null,
            cur_email: null,
            //secondary contact info
            sec_contact_person_name: null,
            sec_address: null,
            sec_postal_code: null,
            sec_province: null,
            sec_country: null,
            sec_phone_number: null,
            sec_email: null,

            // formalPersonalInfoId: null,
            // currentContactInfoId: null,
            // secondaryContactInfoId: null,
            // educationalBackgroundId: null,
            // higherEducationId: null,

            studyPathways: [
                { value: 'Course-Research', label: 'Course-Research' },
                { value: 'Research-Based', label: 'Research-Based' },
            ],

            typeOfDegrees: [
                { value: 'Regular Degree', label: 'Regular Degree' },
                { value: 'Double Diploma', label: 'Double Diploma' },
            ],

            registrationLevels: [
                { value: 'Level M1', label: 'Level M1' },
                { value: 'Level M2', label: 'Level M2' },
            ],
        };
    },
    created() {
        this.fetchProgram();
        this.fetchApplicant();
    },
    methods: {
        test() {
            //just for testing
            console.log(this.$store.getters.isFormalPersonalInfoInitialized);
            console.log(this.$store.getters.isCurrentContactInfoInitialized);
            console.log(this.$store.getters.isSecondaryContactInfoInitialized);
            console.log(this.$store.getters.isEducationalBackgroundInitialized);
            console.log(this.$store.getters.isHigherEducationInitialized);
            console.log(this.$store.getters.isForeignLanguageInitialized);
            console.log(this.$store.getters.isWorkExperienceInitialized);


            console.log(this.$store.getters.formalPersonalInfo?.id)
            console.log(this.$store.getters.formalPersonalInfo);
            console.log(this.$store.getters.currentContactInfo);
            console.log(this.$store.getters.secondaryContactInfo);
            console.log(this.$store.getters.educationalBackground);
            console.log(this.$store.getters.higherEducation);
        },

        getBase64(file) {
            return new Promise((resolve, reject) => {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    resolve(reader.result)
                };
                reader.onerror = function (error) {
                    reject({
                        msp: error
                    })
                };
            })
        },

        deleteImage() {
            //just for testing
            // alert("Tets")
            this.imageUrl = ''
        },

        //keeping track with input element(input image) if there is file added to the element and to keep track if a new is updated
        async handleImageChange(event) {
            const file = event.target.files[0];
            this.imageUrl = await this.getBase64(file);
            if (file) {
                this.selectedImage = file;
                this.displayImage();
            }
        },

        //fetch all program, (formal personal infos part)
        fetchProgram() {
            axios.get(`http://localhost:8000/api/programs`)
                .then(response => {
                    this.programs = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },

        storeDataToVuex() {
            var formalPersonalInfo = {
                id: this.$store.getters.formalPersonalInfo.id,
                image: this.imageUrl,
                type_of_degree: this.type_of_degree,
                study_pathway: this.study_pathway,
                family_name: this.family_name,
                given_name: this.given_name,
                gender: this.gender,
                marital_status: this.marital_status,
                dob: this.dob,
                place_of_birth: this.place_of_birth,
                country_of_birth: this.country_of_birth,
                nationality: this.nationality,
                registration_level: this.registration_level,
            }

            var currentContactInfo = {
                id: this.$store.getters.currentContactInfo?.id || null,
                address: this.cur_address,
                postal_code: this.cur_postal_code,
                province: this.cur_province,
                country: this.cur_country,
                phone_number: this.cur_phone_number,
                email: this.cur_email
            }

            var secondaryContactInfo = {
                id: this.$store.getters.secondaryContactInfo.id,
                contact_person_name: this.sec_contact_person_name,
                address: this.sec_address,
                postal_code: this.sec_postal_code,
                province: this.sec_province,
                country: this.sec_country,
                phone_number: this.sec_phone_number,
                email: this.sec_email
            }

            this.$store.commit('setProgramId', this.program_id)
            this.$store.commit('setFormalPersonalInfo', formalPersonalInfo)
            this.$store.commit('setCurrentContactInfo', currentContactInfo)
            this.$store.commit('setSecondaryContactInfo', secondaryContactInfo)

            console.log(this.$store.getters.formalPersonalInfo)
            console.log(this.$store.getters.currentContactInfo)
            console.log(this.$store.getters.secondaryContactInfo)
        },

        //when user click next
        //all data will be save in vuex waiting for user to click save draft in any page or submit
        step1() {
            console.log(this.imagePath)
            if (this.imageUrl.base64 == undefined && (this.imagePath === undefined || this.imagePath === null)) {
                this.isFileError = true
                return alert('Please choose an image');
            }
            if (this.program_id === null) {
                return alert('please select a program');
            }
            if (this.study_pathway === null) {
                return alert('please select a study pathway');
            }
            if (this.type_of_degree === null) {
                return alert('please select a type of degree');
            }
            if (this.registration_level === null) {
                return alert('please select a registration');
            }

            this.storeDataToVuex();
            //when go to next store the image first (to backend directly) so we need to create applicant detail and update the user table here

            this.$router.push('/applicant/form/education')
        },

        async saveDraft() {
            this.storeDataToVuex();

            // console.log(!this.$store.getters.isFormalPersonalInfoInitialized)
            // console.log(!this.$store.getters.isCurrentContactInfoInitialized)
            // console.log(!this.$store.getters.isSecondaryContactInfoInitialized)
            // console.log(!this.$store.getters.isHigherEducationInitialized)

            this.isLoading = true
            await saveDraftForm()
            this.isLoading = false
        },

        async fetchApplicant() {
            var applicant_id = this.$store.state.user?.applicant_id
            console.log(applicant_id);
            //if applicant_id is not undefined, it mean that user that register our form before and have save draft or submit the form
            //so we need to retrieve therir data in database, if it undefined it mean that user never register before
            //which is why we do not need to fetch data from database like the code below do  
            if (applicant_id !== undefined && applicant_id !== null) {
                //fetch applicant detail as well
                var applicantFormalPersonalInfoId = null;
                var applicantCurrentContactInfoId = null;
                var applicantSecondaryContactInfoId = null;
                var applicantEducationalBackgroundId = null;
                const response = await axios.get(`http://localhost:8000/api/applicantdetails/${applicant_id}`);
                applicantFormalPersonalInfoId = response.data.formal_personal_info_id;
                applicantCurrentContactInfoId = response.data.current_contact_info_id;
                applicantSecondaryContactInfoId = response.data.secondary_contact_info_id;
                applicantEducationalBackgroundId = response.data.educational_background_id;
                // this.program_id = response.data.program_id
                this.$store.commit('setProgramId', response.data.program_id)


                if (this.$store.getters.isFormalPersonalInfoInitialized) {
                    const formalPersonalInfoResponse = await axios.get(`http://localhost:8000/api/formalpersonalinfos/${applicantFormalPersonalInfoId}`)
                    //after fetch data from database we also need to store it in vuex 
                    if (formalPersonalInfoResponse.data !== null) {
                        this.$store.commit('setFormalPersonalInfo', formalPersonalInfoResponse.data)
                    }
                    console.log(this.imageUrl)
                }

                // if (this.$store.state.currentContactInfo === undefined || this.$store.state.currentContactInfo === null) {
                if (this.$store.getters.isCurrentContactInfoInitialized) {
                    const currentContactInfoResponse = await axios.get(`http://localhost:8000/api/currentcontactinfos/${applicantCurrentContactInfoId}`)
                    if (currentContactInfoResponse.data !== null) {
                        this.$store.commit('setCurrentContactInfo', currentContactInfoResponse.data)
                    }
                        
                }

                // if (this.$store.state.secondaryContactInfo === undefined || this.$store.state.secondaryContactInfo === null) {
                if (this.$store.getters.isSecondaryContactInfoInitialized) {
                    const secondaryContactInfoResponse = await axios.get(`http://localhost:8000/api/secondarycontactinfos/${applicantSecondaryContactInfoId}`)
                    if (secondaryContactInfoResponse.data !== null) {
                        this.$store.commit('setSecondaryContactInfo', secondaryContactInfoResponse.data)
                    }
                }

                if(this.$store.getters.isEducationalBackgroundInitialized) {
                    const educationalBackgroundResponse = await axios.get(`http://localhost:8000/api/educationalbackgrounds/${applicantEducationalBackgroundId}`)
                    if (educationalBackgroundResponse.data !== null) {
                        this.$store.commit('setEducationalBackground', educationalBackgroundResponse.data)
                    }
                }

                if (this.$store.getters.isHigherEducationInitialized) {
                    const higherEducationResponse = await axios.get(`http://localhost:8000/api/highereducations/search/${applicant_id}`)
                        
                    // this.higherEducations = response.data
                    if (higherEducationResponse.data !== null) {
                        this.$store.commit('setHigherEducation', higherEducationResponse.data)
                    }
                }

                if (this.$store.getters.isForeignLanguageInitialized) {
                    const foreignLanguageResponse = await axios.get(`http://localhost:8000/api/foreignlanguages/search/${applicant_id}`)
                    if (foreignLanguageResponse.data !== null) {
                        this.$store.commit('setForeignLanguage', foreignLanguageResponse.data)
                    }
                }

                if (this.$store.getters.isWorkExperienceInitialized) {
                    const workExperienceResponse = await axios.get(`http://localhost:8000/api/workexperiences/search/${applicant_id}`)
                    if (workExperienceResponse.data !== null) {
                        this.$store.commit('setWorkExperience', workExperienceResponse.data)
                    }
                }
                this.isLoading = false;
            }

            if (this.$store.state.programId !== undefined && this.$store.state.programId !== null) {
                this.program_id = this.$store.state.programId
            }

            //fetch the data of formal personl info from vuex
            if (this.$store.state.formalPersonalInfo !== undefined && this.$store.state.formalPersonalInfo !== null) {
                this.imageUrl = this.$store.getters.formalPersonalInfo.image
                this.study_pathway = this.$store.getters.formalPersonalInfo.study_pathway;
                this.type_of_degree = this.$store.getters.formalPersonalInfo.type_of_degree
                this.registration_level = this.$store.getters.formalPersonalInfo.registration_level
                this.family_name = this.$store.getters.formalPersonalInfo.family_name
                this.given_name = this.$store.getters.formalPersonalInfo.given_name
                this.gender = this.$store.getters.formalPersonalInfo.gender
                this.marital_status = this.$store.getters.formalPersonalInfo.marital_status
                this.dob = this.$store.getters.formalPersonalInfo.dob
                this.country_of_birth = this.$store.getters.formalPersonalInfo.country_of_birth
                this.place_of_birth = this.$store.getters.formalPersonalInfo.place_of_birth
                this.nationality = this.$store.getters.formalPersonalInfo.nationality
            }

            if (this.$store.state.currentContactInfo !== undefined && this.$store.state.currentContactInfo !== null) {
                this.cur_address = this.$store.getters.currentContactInfo.address;
                this.cur_postal_code = this.$store.getters.currentContactInfo.postal_code
                this.cur_province = this.$store.getters.currentContactInfo.province
                this.cur_country = this.$store.getters.currentContactInfo.country
                this.cur_phone_number = this.$store.getters.currentContactInfo.phone_number
                this.cur_email = this.$store.getters.currentContactInfo.email
            }

            if (this.$store.state.secondaryContactInfo !== undefined && this.$store.state.secondaryContactInfo !== null) {
                this.sec_contact_person_name = this.$store.getters.secondaryContactInfo.contact_person_name;
                this.sec_address = this.$store.getters.secondaryContactInfo.address;
                this.sec_postal_code = this.$store.getters.secondaryContactInfo.postal_code
                this.sec_province = this.$store.getters.secondaryContactInfo.province
                this.sec_country = this.$store.getters.secondaryContactInfo.country
                this.sec_phone_number = this.$store.getters.secondaryContactInfo.phone_number
                this.sec_email = this.$store.getters.secondaryContactInfo.email
            }

            this.isLoading = false;
        }
    }
}
</script>