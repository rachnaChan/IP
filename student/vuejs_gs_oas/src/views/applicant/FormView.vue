<template>
    <div class=" w-[1236px] border-2 border-black border-solid ">
        <div class="flex justify-center items-center">
            <div class="flex ">
                <img class="w-[130px]" src="../../assets/ITC_logo.png" alt="">
                <img class="w-[120px]" src="../../assets/GS_logo.png" alt="">
            </div>
            <div class="text-[20px] font-semibold p-8">
                <h1>GRADUATE SCHOOL OF THE INSTIUTE OF TECHNOLOGY OF CAMBODIA</h1>
            </div>
        </div>

        <div class="text-center text-[22px] font-semibold leading-[45px] mt-[20px]">
            <div>Application Form for Master's Program</div>
            <div>Academic Year: {{ this.currentYear}}-{{ this.nextYear }}</div>
            <p  class="text-red-600 text-center text-[16px]"> Deadline: December 30th, {{ this.currentYear}}</p>
            <!-- <p class="text-red-600 text-center text-[16px]"> Incomplete applications are inadmissible.</p> -->
        </div>

        <div>
            <div class="pb-[50px] mt-[40px] shadow-[0_4px_4px_0_rgba(0,0,0,0.16)]">
            <div class="h-[7px] w-fit-content rounded-[10px] mx-[50px] bg-[#243673]">
                <div class="flex justify-between items-center ml-[-5px]">
                    <div
                        class="bg-white text-[#243673] text-xl border-2 border-[#243673] border-solid font-bold mt-[-15px] flex justify-center items-center rounded-[30px] w-[38px] h-[38px]">
                        <div :class="personalDetail"  class="rounded-[30px]">
                            1
                        </div>
                    </div>

                    <div
                        class="bg-white text-[#243673] text-xl border-2 border-[#243673] border-solid font-bold mt-[-15px] flex justify-center items-center rounded-[30px] w-[38px] h-[38px]">
                        <div :class="education" class="rounded-[30px]">
                            2
                        </div>
                    </div>
                    <div 
                        class="bg-white text-[#243673] text-xl border-2 border-[#243673] border-solid font-bold mt-[-15px] flex justify-center items-center rounded-[30px] w-[38px] h-[38px]">
                        <div :class="foreignLanguage" class="rounded-[30px]">
                            3
                        </div>
                    </div>
                    <div
                        class="bg-white text-[#243673] text-xl border-2 border-[#243673] border-solid font-bold mt-[-15px] flex justify-center items-center rounded-[30px] w-[38px] h-[38px]">
                        <div :class="workExperience" class="rounded-[30px]">
                            4
                        </div>
                    </div>
                    <div
                        class="bg-white text-[#243673] text-xl border-2 border-[#243673] border-solid font-bold mt-[-15px] flex justify-center items-center rounded-[30px] w-[38px] h-[38px]">
                        <div :class="uploadDocument" class="rounded-[30px]">
                            5
                        </div>
                    </div>
                    <!-- <div
                        class="bg-white text-[#243673] text-xl border-2 border-[#243673] border-solid font-bold mt-[-15px] flex justify-center items-center rounded-[30px] w-[38px] h-[38px]">
                        <div :class="declaration" class="rounded-[30px]">
                            6
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

        <div>
            <router-view></router-view>
        </div>

        </div>
    </div>
</template>

<script>
export default {
    computed: {
        personalDetail() {
            // Check the current route and return Tailwind CSS classes as needed
            return this.$route.path.includes('/applicant/form/personal-detail-form')
                ? 'px-[14px] py-[5px] text-white bg-[#243673]'
                : 'rounded-[30px]';
        },

        education() {
            return this.$route.path.includes('/applicant/form/education')
                ? 'px-[13px] py-[5px] text-white bg-[#243673]'
                : 'rounded-[30px]';
        },

        foreignLanguage() {
            return this.$route.path.includes('/applicant/form/foreign-language')
                ? 'px-[13px] py-[5px] text-white bg-[#243673]'
                : 'rounded-[30px]';
        },

        workExperience() {
            return this.$route.path.includes('/applicant/form/work-experience')
                ? 'px-[13px] py-[5px] text-white bg-[#243673]'
                : 'rounded-[30px]';
        },

        uploadDocument() {
            return this.$route.path.includes('/applicant/form/upload-document')
                ? 'px-[13px] py-[5px] text-white bg-[#243673]'
                : 'rounded-[30px]';
        },
    },

    data() {
        return {
            currentYear: '',
            nextYear: '',
        }
    },
    created() {
        this.getYear();
    },
    methods: {
        getYear() {
            const currentDate = new Date();
            this.currentYear = currentDate.getFullYear();
            this.nextYear = this.currentYear + 1;
        }
    },
}
</script>