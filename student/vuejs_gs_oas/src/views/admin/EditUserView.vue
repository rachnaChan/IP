<template>
    <div  class="absolute top-0 left-0 max-w-[946px] w-full flex justify-center items-center
        bg-white/[0.44] backdrop-opacity-[1.5]">

        <form @submit.prevent="editUserAndClosePopup" enctype="multipart/form-data"
            class="bg-white px-[40px] py-[30px] w-[785px] rounded-[30px] shadow-[0_4px_15px_0_rgba(0,0,0,0.35)]">
            <div class="text-[28px]">Edit User</div>
            <Loading v-if="isLoading" />
            <div class="mt-[30px]"  v-if="!isLoading">
                <div class="flex gap-[20px]">
                    <div>
                        <input class=" p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                            type="text" v-model="first_name" id="" placeholder="First name" required>

                        <input class=" p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                            type="text" v-model="last_name" id="" placeholder="Last name" required>

                        <select class="p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                            v-model="gender" required>
                            <option disabled selected value="">Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>

                        <select class="p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                            v-model="selectedRole" required>
                            <option disabled selected value="">Role</option>
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col items-center">
                        <img :src="imageUrl"
                            class="w-[250px] h-[250px] border-2 border-[#ADADAD] border-solid rounded-[290px] mb-[20px]" />
                        <input type="file" @change="handleImageChange" class="" />
                    </div>
                </div>

                <div class="flex gap-[20px]">
                    <input
                        class="py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                        type="text" v-model="phone_number" id="" placeholder="Phone Number" required>

                    <input
                        class="py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                        type="email" v-model="email" id="" placeholder="Email Address" required>
                </div>

                <input
                    class="p-[20px] w-full focus:w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                    type="text" id="dobInput" @focus="clearPlaceholder" @blur="restorePlaceholder" v-model="dob"
                    placeholder="Date of birth" onfocus="(this.type='date')" onfocusout="(this.type='text')" required>

                <textarea class="py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                    v-model="bio" row="3" placeholder="Description" required></textarea>
            </div>

            <div class="flex justify-between mt-[30px]">
                <button @click="cancelEdit()"
                    class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold">Cancel</button>
                <button type="submit"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold">Edit</button>
            </div>
        </form>
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
            userIdToEdit: null,
            roles: [],
            first_name: '',
            last_name: '',
            selectedRole: '',
            selectedImage: '',
            imageUrl: '',
            gender: '',
            phone_number: '',
            email: '',
            bio: '',
            dob: '',
        };
    },
    props: {
        togglePopupEdit: Function,
        editUserId: Number,
        popupTriggerEdit: Object,
    },
    methods: {
        togglePopupEdit() {
            if (this.popupTriggerEdit.buttonTrigger) {
                this.popupTriggerEdit.buttonTrigger = false;
            }
        },
        takeUserIdAndFetchData() {
            this.userIdToEdit = this.editUserId;
            console.log("userIdToEdit:", this.userIdToEdit); // Add this line to check the value

            axios.get(`http://localhost:8000/api/roles`)
                .then(response => {
                    this.roles = response.data
                })
                .catch(error => {
                    console.log("Error:", error);
                });

            axios.get(`http://localhost:8000/api/users/${this.userIdToEdit}`)
                .then(response => {
                    this.first_name = response.data.first_name
                    this.last_name = response.data.last_name
                    this.selectedRole = response.data.role_id
                    this.selectedImage = response.data.image
                    this.gender = response.data.gender
                    this.phone_number = response.data.phone_number
                    this.email = response.data.email
                    this.bio = response.data.bio
                    this.dob = response.data.dob

                    this.imageUrl = `http://localhost:8000/storage/${this.selectedImage}`;

                    this.isLoading = false;
                    console.log(this.selectedImage);

                })
                .catch(error => {
                    console.log("Error:", error);
                });
            
        },
        cancelEdit() {
            console.log(this.userIdToEdit);
            this.togglePopupEdit();
        },
        editUserAndClosePopup() {
            //format date to DD-MM-YYYY, before send to backend
            // const [year, month, day] = this.dob.split('-');
            // const formattedDob = `${day}-${month}-${year}`;

            const userInfo = {
                first_name: this.first_name,
                last_name: this.last_name,
                gender: this.gender,
                dob: this.dob,
                phone_number: this.phone_number,
                email: this.email,
                bio: this.bio,
                role_id: this.selectedRole,
            };

            //iterate over the properties (keys and values) of the userInfo object and append them to the FormData object.
            const formData = new FormData();
            Object.entries(userInfo).forEach(([key, value]) => {
                console.log('Appending:', key, value);
                formData.append(key, value);
            });

            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }
            console.log("Form data before sending:", formData);
            console.log(formData);
            console.log(userInfo);

            axios.post(`http://localhost:8000/api/users/${this.userIdToEdit}`, formData)
                .then(response => {
                    console.log('Userinfo:',formData);
                    console.log(response.data);
                    this.togglePopupEdit(); //close edit pop up
                    this.$emit('user-edited');
                    this.$router.push('/list-user');
                    // Handle success response
                })
                .catch(error => {
                    console.log(error)
                });
        },
        //keeping track with input element(input image) if there is file added to the element and to keep track if a new is updated
        handleImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedImage = file;
                this.displayImage();
            }
        },
        //use to display the file 
        displayImage() {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.imageUrl = event.target.result;
            };
            reader.readAsDataURL(this.selectedImage);
        },
    },
    mounted() {
        this.takeUserIdAndFetchData();
    },

}

</script>