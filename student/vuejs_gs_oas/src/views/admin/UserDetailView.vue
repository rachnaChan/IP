<template>
    <div class="absolute top-0 left-0 max-w-[946px] w-full h-fit-content flex justify-center items-center
        bg-white/[0.44] backdrop-opacity-[1.5]">
        <div class="bg-white px-[40px] py-[30px] w-4/5 rounded-[30px] shadow-[0_4px_15px_0_rgba(0,0,0,0.35)]">
            <div class="flex justify-between">
                <div class="text-[28px]">User Information</div>
                <i @click="close()" class="fa-solid fa-xmark text-[#243673] text-[36px]"></i>
            </div>

            <Loading v-if="isLoading" />

            <div v-if="!isLoading">
                <div class="flex mt-[50px] gap-[50px]">
                    <img :src="getImage(user.image)" class="w-[150px] h-[150px] rounded-[150px]">
                    <div class="flex flex-col justify-center">
                        <div class="text-[25px] font-bold"> {{ this.user.first_name }} {{ this.user.last_name }}</div>
                        <div class="flex justify-evenly">
                            <div class="text-[15px] font-extralight">Student</div>
                            <div class="text-[15px] font-extralight">{{ this.user.id }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-[30px]">
                    <div class="flex gap-[20px]">
                        <div class="text-[25px]">Communication Info</div>
                        <div>
                            <hr class="border-t-2 border-t-black border-t-solid w-[400px] inline-block">
                        </div>
                    </div>

                    <table class="w-full">
                        <tr class="text-left">
                            <td class="font-light text-[15px] pt-[20px]">First nane:</td>
                            <td class="font-semibold text-[15px] pt-[20px]">{{ this.user.first_name }}</td>
                        </tr>
                        <tr class="text-left">
                            <td class="font-light text-[15px] pt-[15px]">Last name:</td>
                            <td class="font-semibold text-[15px] pt-[15px]">{{ this.user.last_name }}</td>
                        </tr>
                        <tr class="text-left">
                            <td class="font-light text-[15px] pt-[15px]">Phone number:</td>
                            <td class="font-semibold text-[15px] pt-[15px]">{{ this.user.phone_number }}</td>
                        </tr>
                        <tr class="text-left">
                            <td class="font-light text-[15px] pt-[15px]">Email:</td>
                            <td class="font-semibold text-[15px] pt-[15px]">{{ this.user.email }}</td>
                        </tr>
                        <tr class="text-left">
                            <td class="font-light text-[15px] pt-[15px]">Date Of Birth:</td>
                            <td class="font-semibold text-[15px] pt-[15px]">{{ this.user.dob }}</td>
                        </tr>
                        <tr class="text-left">
                            <td class="font-light text-[15px] pt-[15px]">Create Date:</td>
                            <td class="font-semibold text-[15px] pt-[15px]">{{ this.user.created_at }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-[30px]">
                    <div class="flex gap-[20px]">
                        <div class="text-[25px]">Description</div>
                        <div>
                            <hr class="border-t-2 border-t-black border-t-solid w-[510px] inline-block">
                        </div>
                    </div>
                    <div class="text-[18px] font-light mt-[20px]">
                        {{ this.user.bio }}
                    </div>
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
            userIdToView: null,
            user: {},
            role: null,
        };
    },
    props: {
        togglePopup: Function,
        userId: Number,
        popupTrigger: Object,
    },
    mounted() {
        this.takeUserId();
    },
    methods: {
        takeUserId() {
            this.userIdToView = this.userId;
            console.log("userIdToView:", this.userIdToView); // Add this line to check the value
            axios.get(`http://localhost:8000/api/users/${this.userIdToView}`)
                .then(response => {
                    console.log("Response:", response.data);
                    this.user = response.data

                    this.isLoading = false;

                })
                .catch(error => {
                    console.log("Error:", error);
                });
        },
        close() {
            this.togglePopup();
        },
        getImage(image) {
            return `http://localhost:8000/storage/${image}`;
        }
    }
}

</script>