<template>
    <div class="absolute top-0 left-0 max-w-[946px] w-full flex justify-center items-center
        bg-white/[0.44] backdrop-opacity-[1.5]">
        <form @submit.prevent="addUser" enctype="multipart/form-data"
            class="bg-white px-[40px] py-[30px] w-[785px] rounded-[30px] shadow-[0_4px_15px_0_rgba(0,0,0,0.35)]">
            <div class="text-[28px]">Create User</div>

            <div class="mt-[30px]">
                <div class="grid grid-cols-2 gap-[20px]">
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

                <div class="grid grid-cols-2 gap-[20px] mb-[20px]">
                    <input
                        class="py-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="password" v-model="password" id="" placeholder="Password" required>

                    <input
                        class="p-[20px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="text" id="dobInput" @focus="clearPlaceholder" @blur="restorePlaceholder" v-model="dob"
                        placeholder="Date of birth" onfocus="(this.type='date')" onfocusout="(this.type='text')" required>

                    <input
                        class="py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="text" v-model="phone_number" id="" placeholder="Phone Number" required>

                    <input
                        class="py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD]"
                        type="email" v-model="email" id="" placeholder="Email Address" required>
                </div>

                <textarea class="py-[20px] pl-[15px] w-full rounded-[10px] border-solid border-2 border-[#ADADAD] mb-[20px]"
                    v-model="bio" row="3" placeholder="Description" required></textarea>
            </div>

            <div class="flex justify-between mt-[30px]">
                <button @click="cancelCreate()"
                    class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold">Cancel</button>
                <button type="submit"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        togglePopupCreate: Function,
    },
    data() {
        return {
            roles: [],
            first_name: '',
            last_name: '',
            selectedRole: '',
            selectedImage: '',
            imageUrl: '',
            gender: '',
            password: '',
            phone_number: '',
            email: '',
            bio: '',
            dob: '',
        };
    },
    created() {
        this.fetchRole();
    },
    methods: {
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
        fetchRole() {
            console.log('Fetching role...');
            // const url = this.$baseURL + `/api/roles`
            axios
                .get(`http://localhost:8000/api/roles`)
                .then(response => {
                    console.log(response)
                    this.roles = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        addUser(event) {
            event.preventDefault();

            //format date to DD-MM-YYYY, before send to backend
            const [year, month, day] = this.dob.split('-');
            const formattedDob = `${day}-${month}-${year}`;

            const userInfo = {
                first_name: this.first_name,
                last_name: this.last_name,
                gender: this.gender,
                dob: formattedDob,
                phone_number: this.phone_number,
                email: this.email,
                password: this.password,
                bio: this.bio,
                role_id: this.selectedRole,

            };

            //iterate over the properties (keys and values) of the userInfo object and append them to the FormData object.
            const formData = new FormData();
            Object.entries(userInfo).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }
            console.log("Form data before sending:", formData);

            // const url = this.$baseURL + `/api/users`
            axios.post('http://localhost:8000/api/users', formData)
                .then(response => {
                    console.log('Userinfo:', userInfo);
                    console.log(response.data);
                    this.togglePopupCreate();
                    this.$emit('user-created');
                    this.$router.push('/list-user');
                    // Handle success response
                })
                .catch(error => {
                    console.log(error)
                });
        },

        cancelCreate() {
            this.togglePopupCreate();
        },


    },
}
</script>

<!-- test -->