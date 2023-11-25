<script>
import axios from 'axios';
export default {
    data() {
        return {
            user: null,
            events: [], // Store the list of events
            editingEvent: null, // Store the event being edited
            editedEvent: {}, // Store the edited event data
            imageUrl: '',
            currentDateTime: null,
            title: '',
            start_date: '',
            deadline: '',
            description: '',
            selectedImage: '',
            image: '',
            selectedFile: null,
            updateMessage: "",
        };
    },
    mounted() {
        this.fetchLoggedInUser();
        this.fetchEvents();
        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000);
    },
    methods: {
        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/info'); // Change this URL if needed
                console.log(response.data);
                this.user = response.data;


            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },
        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                // console.log('Image URL:', imageUrl); // Log the image URL
                return imageUrl;
            } else if (user.image == null) {
                const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
                // console.log(imageAuto);
                return imageAuto;
            }
        },

        logout() {
            axios.post('http://localhost:8000/api/logout')
                .then(response => {
                    console.log(response.data);
                    this.$store.commit('setUser', null)
                    this.$store.commit('setToken', null)
                    this.$store.commit('setRole', null)
                    this.$router.push('/login');
                })
                .catch(error => {
                    console.log(error)
                });
        },
        addEvent() {

            const eventInfo = {
                title: this.title,
                start_date: this.start_date,
                deadline: this.deadline,
                description: this.description,

            }
            const formData = new FormData();

            Object.entries(eventInfo).forEach(([key, value]) => {
                console.log('Appending:', key, value);
                formData.append(key, value);
            });

            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }


            axios.post('http://localhost:8000/api/head/addEvent', formData)
                .then(response => {
                    // Handle success
                    console.log(response.data.message);
                    // this.$router.push('/student/document');
                    this.$router.go(0);
                })
                .catch(error => {
                    // Handle error
                    console.error(error);
                });
        },
        dueDateDead(deadline) {
            if (!deadline) return '';
            const date = new Date(deadline);
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayOfWeek = daysOfWeek[date.getDay()]; // Get the day of the week as a string

            const monthNames = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];
            const month = monthNames[date.getMonth()]; // Get the month as a string
            const day = date.getDate();
            const daySuffix = this.getDaySuffix(day); // Get the day suffix (e.g., "st", "nd", "rd", "th")

            // Create the formatted date string
            return `${month} ${day < 10 ? '0' : ''}${day}  ${dayOfWeek}`;
        },

        getDaySuffix(day) {
            if (day >= 11 && day <= 13) {
                return 'th';
            }
            const lastDigit = day % 10;
            switch (lastDigit) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
                default:
                    return 'th';
            }
        },

        dueDateStatus(deadline) {
            if (!deadline) return 'No deadline provided';

            const currentDate = new Date();
            const dueDate = new Date(deadline);

            // Calculate the time remaining in milliseconds
            const timeRemainingMillis = dueDate - currentDate;

            // Calculate the days remaining
            const daysRemaining = Math.ceil(timeRemainingMillis / (1000 * 60 * 60 * 24));

            if (daysRemaining < 0) {
                // The deadline has passed, calculate the days that have passed
                const daysPassed = Math.abs(daysRemaining);
                return `Due ${daysPassed} day${daysPassed !== 1 ? 's' : ''} ago`;
            } else if (daysRemaining === 0) {
                return 'Due Today';
            } else {
                return `Days remaining: ${daysRemaining}`;
            }
        },
        async fetchEvents() {
            try {
                const response = await axios.get('http://localhost:8000/api/head/getEvent');
                this.events = response.data.map(event => ({
                    ...event,
                    imageUrl: this.getUserImageURL(event)
                }));
            } catch (error) {
                console.error('Error fetching events:', error);
            }
        },
        handleImageChange(event) {
            const file = event.target.files[0];
            this.selectedImage = file;
            this.editedEvent.image = URL.createObjectURL(file); // Update the editedEvent.image property to show the selected image
        },

        editEvent(event) {
            // Open the edit modal and populate the editedEvent data
            this.editingEvent = event;
            this.editedEvent = { ...event };
            this.editedEvent.imageUrl = event.imageUrl;

        },
        async saveEditedEvent() {
            try {
                // Prepare the FormData with event data
                const formData = new FormData();
                formData.append('title', this.editedEvent.title);
                formData.append('start_date', this.editedEvent.start_date);
                formData.append('deadline', this.editedEvent.deadline);
                formData.append('description', this.editedEvent.description);


                // Check if a new image has been selected
                if (this.selectedImage) {
                    formData.append('image', this.selectedImage);
                }

                // Send a PUT request to update the event
                await axios.post(`http://localhost:8000/api/head/updateEvent/${this.editingEvent.id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                // Clear the editing state
                this.editingEvent = null;
                this.editedEvent = {};
                this.selectedImage = null;

                // Refetch events to update the list
                this.fetchEvents();
                this.$router.go(0);
            } catch (error) {
                console.error('Error updating event:', error);
            }
        },
        async deleteEvent(eventId) {
            try {
                // Send a DELETE request to delete the event
                await axios.delete(`http://localhost:8000/api/head/deleteEvent/${eventId}`);

                // Refetch events to update the list
                this.fetchEvents();
            } catch (error) {
                console.error('Error deleting event:', error);
            }
        },
        confirmDelete(eventId) {
            const confirmation = window.confirm('Are you sure you want to delete this event?');
            if (confirmation) {
                this.deleteEvent(eventId);
            }
        },

        clearFields() {
            // Clear all fields by resetting the editedEvent object
            this.editedEvent = {
                title: '',
                start_date: '',
                deadline: '',
                description: '',
                imageUrl: '', // You may need to reset the image preview as well
            };
            this.$router.go(0);
        },

        


    }
};
</script>
<template>
    <div class="w-full min-h-screen border-2 border-black border-solid" v-if="user">
        <div class="flex">
            <div class="bg-[#243673] min-h-screen min-w-[290px] fixed">
                <div class="flex px-[85px] py-[25px]">
                    <img class="w-[60px]" src="../../../assets/img/GS_logo.png" alt="">
                    <img class="w-[60px]" src="../../../assets/img/ITC_logo.png" alt="">
                </div>

                <div class="mt-[15px]">
                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/dashboard" class="px-[30px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-house text-[22px] mr-[13px]"></i>
                            Dashboard
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/students" class="px-[30px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-users text-[22px] mr-[13px]"></i>
                            Students
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/enrollment"
                            class="pl-[30px] pr-[61px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-user-check text-[20px] mr-[13px]"></i>
                            Enrollment
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/program"
                            class="pl-[30px] pr-[116px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-book text-[25px] mr-[13px]"></i>
                            Program Information
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/profile"
                            class="pl-[30px] pr-[129px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="fa-solid fa-gear text-[25px] mr-[13px]"></i>
                            Profile
                        </router-link>
                    </div>

                    <div class="text-[15px] font-medium mb-[16px] text-white flex items-center">
                        <router-link to="/head/events"
                            class="pl-[30px] pr-[62px] py-[10px] rounded-tr-[10px] rounded-br-[10px]"
                            active-class="text-[#243673] bg-[#E2F2FF]">
                            <i class="bx bxs-calendar-event text-[25px] mr-[13px]"></i>
                            Events
                        </router-link>
                    </div>
                </div>

                <div>
                    <button @click="logout"
                        class="text-[15px] font-medium text-white flex items-center absolute bottom-10 left-[30px]
                                                hover:bg-[#E2F2FF] hover:text-[#243673] hover:pl-[30px] hover:pr-[129px] hover:py-[10px] hover:rounded-tr-[10px] hover:rounded-br-[10px] hover:left-0 hover:bottom-[30px]">
                        <i class="fa-solid fa-arrow-right-from-bracket text-[23px] mr-[13px]"></i>
                        Logout
                    </button>
                </div>
            </div>
            <div class="all w-[943px] flex-1 ml-[330px] p-4">
                <div class="flex justify-between px-[5px] mt-4" >
                    <div>
                        <h1 class="text-[#243673] font-bold text-[24px]">Events</h1>
                        <!-- <router-link to="/head/program">
                        <small class="text-[#243673] font-medium">Dashboard </small>
                    </router-link> -->
                        <small class="text-[#243673] font-medium">New Events</small>
                    </div>
                    <div class="flex justify-between items-center gap-[15px]">
                        <h1 class="text-[18px] text-[#243673] font-bold">{{ user.first_name }} {{ user.last_name }}</h1>
                        <div class="text-[#243673]">
                            <img class="w-[50px] h-[50px] mx-auto rounded-circle" :src="getUserImageURL(user)"
                                :alt="user.name">
                        </div>

                    </div>
                </div>
                <!-- ==== -->

                <!-- ==== -->
                <div class="container mx-auto p-4">
                    <!-- Display Events -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" >
                        <div v-for="event in events" :key="event.id" class="bg-white p-4 shadow-lg rounded-lg" style="max-height: 650px; overflow-y: auto;">
                            <div class="text-center">
                                <div class="w-64 h-48 mx-auto relative">
                                    <img :src="event.imageUrl" class="object-cover w-full h-full rounded-md"
                                        alt="Event Image" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <h2 class="text-xl font-semibold">{{ event.title }}</h2>
                                <p class="text-sm">
                                    <span class="text-gray-600">{{ event.start_date }} - </span>
                                    <span class="text-red-500">{{ event.deadline }}</span>
                                </p>

                                <p class="text-gray-800">{{ event.description }}</p>
                            </div>
                            <div class="mt-4 flex justify-end" >
                                <!-- Edit Button -->
                                <div data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                <button @click="editEvent(event)"
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Edit
                                </button>
                            </div>
                                <!-- Delete Button -->
                                <button @click="confirmDelete(event.id)"
                                    class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                    Delete
                                </button>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        <i class="fa fa-plus-circle fa-lg mr-2"></i>Create New Events
                    </button>
                </div>
                <!-- Edit Event Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-m">
                        <div class="modal-content">
                            <div class="container mt-0">
                                <div class="card bg-white rounded-lg shadow-lg">
                                    <div class="card bg-white rounded-lg shadow-lg">
                                        <div class="py-2 text-center bg-[#243673] text-white">
                                            <h2 class="text-[24px] text-center ">Edit Events</h2>
                                        </div>
                                        <div class="modal-body" v-if="editingEvent">
                                            <!-- <div  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"> -->
                                            <div class="bg-white p-4 rounded-md shadow-lg">
                                                <h2 class="text-xl font-semibold mb-4">Edit Event</h2>
                                                <div class="mb-4">
                                                    <label for="title"
                                                        class="block text-sm font-medium text-gray-700">Title</label>
                                                    <input v-model="editedEvent.title" type="text" id="title"
                                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                                </div>
                                                <div class="mb-4">
                                                    <label for="start_date"
                                                        class="block text-sm font-medium text-gray-700">Start
                                                        Date</label>
                                                    <input v-model="editedEvent.start_date" type="date" id="start_date"
                                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                                </div>
                                                <div class="mb-4">
                                                    <label for="deadline"
                                                        class="block text-sm font-medium text-gray-700">End Date</label>
                                                    <input v-model="editedEvent.deadline" type="date" id="deadline"
                                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                                </div>
                                                <div class="mb-4">
                                                    <label for="description"
                                                        class="block text-sm font-medium text-gray-700">Description</label>
                                                    <textarea v-model="editedEvent.description" id="description"
                                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="image" class="block text-sm font-medium text-gray-700">Event
                                                        Image</label>
                                                    <input type="file" @change="handleImageChange" id="image"
                                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                                    <img :src="editedEvent.image" alt="Selected Image"
                                                        class="mt-2 max-w-full h-auto rounded-md" />
                                                </div>

                                                <div class="text-right">
                                                    <button @click="saveEditedEvent"
                                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save</button>
                                                    <button @click="clearFields"
                                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 ml-2">Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-m">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="container mt-0">
                                    <div class="card bg-white rounded-lg shadow-lg">
                                        <div class="card bg-white rounded-lg shadow-lg">
                                            <div class="py-2 text-center bg-[#243673] text-white">
                                                <h2 class="text-[24px] text-center ">Create New Events</h2>
                                            </div>
                                            <div class="card-body">
                                                <div class="row g-3">
                                                    <div class="col-md-12 flex justify-center my-0">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <div
                                                                    class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto">
                                                                    <!-- <span class=" text-dark fs-5 ">Select your profile
                                                                picture</span> -->

                                                                    <label for="file-input"
                                                                        class="drop-container bg-white position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                                                        <span
                                                                            class="drop-title text-muted fs-4 text-center ">Drop
                                                                Events Image</span>
                                                                        or
                                                                        <input type="file" @change="handleImageChange"
                                                                            class="dashboard_textBox  m-auto fs-6 ">
                                                                        <img :src="image" alt="Selected Image" width="100">

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="fname" class="form-label">Artical</label>
                                                        <input v-model="title" type="text" class="form-control"
                                                            id="phoneNumber" placeholder="Enter here!!">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="fname" class="form-label">Description</label>
                                                        <input v-model="description" type="text" class="form-control"
                                                            id="phoneNumber" placeholder="Enter here!!">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="lname" class="form-label">Start Date</label>
                                                        <input v-model="start_date" type="date" class="form-control"
                                                            id="phoneNumber" placeholder="Enter here!!">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="lname" class="form-label">End Date</label>
                                                        <input v-model="deadline" type="date" class="form-control"
                                                            id="phoneNumber" placeholder="Enter here!!">
                                                    </div>
                                                    <div class="text-right">
                                                        <button @click="addEvent"
                                                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-600">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>
  
  
  
  