<template >
    <div class="all w-[943px] relative h-full border-2 border-black border-solid m-auto mt-6">
        <div class="flex justify-between px-[50px] py-[30px]">
            <h1 class="text-[#243673] font-bold text-[24px]">Users: {{ adminId }}</h1>
            <div class="flex justify-between items-center gap-[15px]">
                <h1 class="text-[18px] text-[#243673] font-bold">{{ this.$store.state.user.first_name }} {{ this.$store.state.user.last_name }}</h1>
                <div class="text-[#243673]">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg> -->
                    <i class="fa-solid fa-circle-user text-[30px]"></i>
                </div>

            </div>
        </div>

        <!-- button search -->
        <div class="p-8 pt-0">
            <form class="flex items-center justify-end ">

                <div class=" flex overflow-hidden border border-[#243673]  rounded-xl">
                    <input type="text" v-model="searchText" class="border-none outline-none py-[7px] text-sm w-[350px] pl-[10px]"
                        placeholder="Search by name, id, role, username, phnoe number" @input="search">
                    <button class="bg-[#243673] px-2 text-white ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- List GEa -->
        <div class="w-full px-[30px] mt-4">
            <div class="w-full overflow-auto border-2 hide-scroll  overflow-y-auto max-h-[300px] ">
                <table class="max-w-[946px] w-full h-[200px]">
                    <tr class="text-white bg-[#243673] text-[20px] font-medium  sticky top-0">
                        <td class="text-center px-4 py-[12px]">User ID</td>
                        <td class="text-center px-4">First Name</td>
                        <td class="text-center px-4">Last Name</td>
                        <td class="text-center px-4">Email</td>
                        <td class="text-center px-[10px]">
                            <select class="border-none w-full text-[20px] bg-[#243673] "
                                v-model="filterRole" @change="filterByRole">
                                <option class="bg-white text-[#243673] border-2 border-[#243673] border-solid text-[16px] font-medium hover:bg-[#243673]" selected value="All">All Roles</option>
                                <option class="bg-white text-[#243673] border-2 border-[#243673] border-solid text-[16px] font-medium" v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                            </select>
                        </td>
                        <td class="text-center px-4">Action</td>
                    </tr>

                    <tr class="text-[18px] font-medium border-collapse border-b-2 border-gray-300 border-solid"
                        v-for="user in searchUsers" :key="user.id" :value="user.id">
                        <td class="text-center py-4 px-4">{{ user.id }}</td>
                        <td class="text-center py-4 px-4">{{ user.first_name }}</td>
                        <td class="text-center py-4 px-4">{{ user.last_name }}</td>
                        <td class="text-center py-4 px-4">{{ user.email }}</td>
                        <td class="text-center py-4 px-4">
                            <div class="flex gap-2 justify-center items-center">
                                <div class="flex-grow">
                                    <!-- value of editmode is true meaning that it is not in edit mode -->
                                    <template v-if="!editMode">
                                        {{ user.role_user.name }}
                                    </template>

                                    <template v-else>
                                        <!--  The @blur event occurs when the input loses focus, meaning the user has finished editing the input field.  -->
                                        <!-- <input v-model="user.role_user.name" @blur="updateRole(user.id, user.role_user.name)" class="border rounded p-1" />
                                    </template> -->
                                        <select v-model="user.role_user.name"
                                            @change="updateRole(user.id, user.role_user.name)" class="border rounded p-1">
                                            <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}
                                            </option>
                                        </select>
                                    </template>
                                </div>

                                <i class="fa-solid fa-pen text-blue-800" @click="toggleEditMode"></i>

                            </div>
                        </td>

                        <td class="text-center">
                            <div class="flex justify-center gap-2 items-center">

                                <i class="fa-solid fa-eye text-green-700"
                                    @click="() => togglePopup('buttonTrigger', user.id)"></i>
                                <detailUserPopup v-if="popupTrigger.buttonTrigger"
                                    :togglePopup="() => togglePopup('buttonTrigger')" :userId="userId"></detailUserPopup>

                                <i class="fa-solid fa-pen-to-square text-blue-800"
                                    @click="() => togglePopupEdit('buttonTrigger', user.id)"></i>
                                <editUserPopup v-if="popupTriggerEdit.buttonTrigger"
                                    :togglePopupEdit="() => togglePopupEdit('buttonTrigger')"
                                    :editUserId="editUserId" @user-edited="fetchUser"></editUserPopup>

                                <i class="fa-solid fa-trash-can text-red-700"
                                    @click="() => togglePopupDelete('buttonTrigger', user.id)"></i>
                                <deleteUserPopup v-if="popupTriggerDelete.buttonTrigger"
                                    :togglePopupDelete="() => togglePopupDelete('buttonTrigger')"
                                    :deleteUserId="deleteUserId" @user-deleted="fetchUser"></deleteUserPopup>
                            </div>
                        </td>
                    </tr>

                </table>

            </div>

            <div class=" flex justify-end my-[40px]">
                <button class="border-2 border-[#243673] p-3 rounded-xl ">
                    <div class="flex gap-2 text-[#243673] font-bold " @click="() => togglePopupCreate('buttonTrigger')">
                        Add User
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                    <createUserPopup v-if="popupTriggerCreate.buttonTrigger"
                        :togglePopupCreate="() => togglePopupCreate('buttonTrigger')" 
                        @user-created="fetchUser">
                    </createUserPopup>
                </button>
            </div>



            <!-- list Users -->

        </div>


    </div>
</template>

<script>
import { ref, registerRuntimeCompiler } from 'vue'
import detailUserPopup from './UserDetailView.vue'
import deleteUserPopup from '../../components/DeleteUser.vue'
import createUserPopup from './CreateUserView.vue'
import editUserPopup from './EditUserView.vue'
import axios from 'axios'
// import { mapGetters } from 'vuex';


export default {
    name: 'header',
    components: {
        detailUserPopup,
        deleteUserPopup,
        createUserPopup,
        editUserPopup,
    },
    setup() {
        var userId = ref(null);
        const deleteUserId = ref(null)
        var editUserId = ref(null);

        const popupTrigger = ref({
            buttonTrigger: false,
        })

        const togglePopup = (trigger, clickedUserId) => {
            popupTrigger.value[trigger] = !popupTrigger.value[trigger]
            userId.value = clickedUserId
        }

        const popupTriggerDelete = ref({
            buttonTrigger: false,
        })

        const togglePopupDelete = (trigger, clickDeleteUserId) => {
            popupTriggerDelete.value[trigger] = !popupTriggerDelete.value[trigger]
            deleteUserId.value = clickDeleteUserId
        }

        const popupTriggerCreate = ref({
            buttonTrigger: false,
        })

        const togglePopupCreate = (trigger) => {
            popupTriggerCreate.value[trigger] = !popupTriggerCreate.value[trigger]
        }

        const popupTriggerEdit = ref({
            buttonTrigger: false,
        })

        const togglePopupEdit = (trigger, clickEditUserId) => {
            popupTriggerEdit.value[trigger] = !popupTriggerEdit.value[trigger]
            editUserId.value = clickEditUserId
        }

        return {
            popupTrigger,
            userId,
            togglePopup,
            togglePopupDelete,
            popupTriggerDelete,
            deleteUserId,
            popupTriggerCreate,
            togglePopupCreate,
            popupTriggerEdit,
            togglePopupEdit,
            editUserId,
            // ...mapGetters(['user']),  //get user obj from vue x used for multiple getters

        }
    },
    // computed: {
    //     // Access user properties using the mapped getter
    //     adminId() {
    //         console.log('user in computed:', this.user);
    //         return this.user.id;
    //     },
    // },
    data() {
        return {
            users: [],
            editMode: false, //not in editmode
            mapRoleNameToId: [],
            roles: [],
            searchText: null,
            searchUsers: [],

            filterRole: 'All',
        }
    },
    created() {
        this.fetchUser();
        this.fetchRole();
        // this.deleteUser();
    },
    methods: {
        fetchUser() {
            console.log('Fetching user...');
            // const url = this.$baseURL + `/api/users`
            axios
                .get(`http://localhost:8000/api/users`)
                .then(response => {
                    this.users = response.data.allUser;
                    this.searchUsers = response.data.allUser;
                    console.log(this.users)
                })
                .catch(error => {
                    console.error(error);
                });
        },
        toggleEditMode() {
            this.editMode = !this.editMode; //in editmode
        },
        //fetch role to map name according to it's id
        fetchRole() {
            console.log('Fetching role...');
            // const url = this.$baseURL + `/api/roles`
            axios
                .get(`http://localhost:8000/api/roles`)
                .then(response => {
                    this.roles = response.data;
                    console.log('role:', this.roles);
                    // Populate mapRoleNameToId
                    this.roles.forEach(role => {
                        this.mapRoleNameToId[role.name] = role.id;

                    });
                    console.log('mapRoleNameToId:', this.mapRoleNameToId);

                })
                .catch(error => {
                    console.error('Error fetching roles:', error);
                });
        },
        updateRole(userId, editedRoleName) {
            const roleId = this.mapRoleNameToId[editedRoleName];
            if (roleId) {
                // const url = this.$baseURL + `/api/users/${userId}`
                axios
                    .post(`http://localhost:8000/api/users/${userId}`, {
                        role_id: roleId    //role_id is the column in our users table
                    })
                    .then(response => {
                        console.log('Role name updated successfully:', response.data);

                    })
                    .catch(error => {
                        console.error('Error updating role name:', error);
                    });
            }
            else {
                console.error(`Role name '${editedRoleName}' not found.`);
            }
        },
        // deleteUser() {
        //     axios
        //         .delete(`$baseURL/api/users/${this.deleteUserId}`, {

        //         })
        //         .then(response => {
        //             console.log('Delete successfully:', response.data);
        //             togglePopupDelete('buttonTrigger'); // Close the delete confirmation popup
        //             this.fetchUser(); // Fetch updated user data
        //         })
        //         .catch(error => {
        //         console.error('Error deleting user:', error);
        //     });
        // },
        search() {
            if(this.searchText.trim() === '') {
                this.searchUsers = this.users
                console.log(this.searchUsers)
            } else {
                // const url = this.$baseURL + `/api/users/search/${this.searchText}`
                axios.get(`http://localhost:8000/api/users/search/${this.searchText}`)
                .then(response => {
                   this.searchUsers = response.data
                })
                .catch(error => {
                    console.error('Error deleting user:', error);
                });
            }
        },
        filterByRole() {
            if(this.filterRole == 'All') {
                this.searchUsers = this.users
            } else {
                // const url = this.$baseURL + `/api/users/search/${this.filterRole}`
                axios.get(`http://localhost:8000/api/users/search/${this.filterRole}`)
                .then(response => {
                   this.searchUsers = response.data
                })
                .catch(error => {
                    console.error('Error deleting user:', error);
                });
            }
        }
    }
}

</script>

<style>
.hide-scroll::-webkit-scrollbar {
    display: none;
}
</style>