<script>
import axios from "axios";

export default {
  data() {
    return {
      user: null,
      title: "",
      description: "",
      image: "",
      activeNavItem: null,
      searchQuery: "",
      searchResults: [],
      events: [],
      eventsPerPage: 5,
      currentPage: 1,
      errormessage: "",
      start_date: "",
      end_date: "",
      id: "",
      selectedEvent: null,
      eventId: null,
    };
  },

  mounted() {
    this.fetchLoggedInUser();
    this.fetchEvent();
    // this.updateEvent();
  },

  computed: {
    DisplayEvent() {
      // return this.searchQuery ? this.searchResults : this.events;

      const eventsToDisplay = this.searchQuery
        ? this.searchResults
        : this.events;
      const startIndex = (this.currentPage - 1) * this.eventsPerPage;
      return eventsToDisplay.slice(startIndex, startIndex + this.eventsPerPage);
    },

    totalPages() {
      const totalEvents = this.searchQuery
        ? this.searchResults.length
        : this.events.length;
      return Math.ceil(totalEvents / this.eventsPerPage);
    },
  },

  methods: {
    async fetchLoggedInUser() {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/admin/info"
        ); // Change this URL if needed
        // console.log(response.data);
        this.user = response.data;
        console.log(this.user);
      } catch (error) {
        console.error("Error fetching user:", error);
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
      axios
        .post("http://localhost:8000/api/logout")
        .then((response) => {
          console.log(response.data);
          this.$store.commit("setUser", null);
          this.$store.commit("setToken", null);
          this.$store.commit("setRole", null);
          this.$router.push("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },

    setEventId(eventId) {
      this.eventId = eventId;
    },

    onImageChange(event) {
      this.image = event.target.files[0];
    },

    fetchEvent() {
      axios
        .get(`http://localhost:8000/api/admin/get_event`)
        .then((response3) => {
          this.events = response3.data;

          console.log(this.events);
        })
        .catch((error) => {
          console.error("Error fetching Event:", error);
        });
    },

    search() {
      // Make a request to your backend API for searching Events
      axios
        .get(`http://localhost:8000/api/admin/searchEvent/${this.searchQuery}`)
        .then((response) => {
          if (response.data.length > 0) {
            this.searchResults = response.data;
            this.currentPage = 1;
          } else {
            this.errormessage =
              "No results found for Event of : " + this.searchQuery;
          }
        })
        .catch((error) => {
          console.error("Error fetching search results:", error);
        });
    },

    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },

    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },

    goToPage(page) {
      this.currentPage = page;
    },

    getEventImageURL(events) {
      if (events.image) {
        const imageUrl = `http://localhost:8000/storage/${events.image}`;
        // console.log('Image URL:', imageUrl); // Log the image URL
        return imageUrl;
      } else if (events.image == null) {
        const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
        // console.log(imageAuto);
        return imageAuto;
      }
    },

    uploadEvent() {
      let formData = new FormData();

      formData.append("start_date", this.start_date);
      formData.append("end_date", this.end_date);
      formData.append("title", this.title);
      formData.append("description", this.description);
      formData.append("image", this.image);

      axios
        .post("http://localhost:8000/api/admin/create_event", formData)
        .then((response) => {
          // Handle success
          console.log(response.data.message);
          this.$router.go(0);
        })
        .catch((error) => {
          // Handle error
          console.error(error);
        });
    },

    async deleteEvent(eventId) {
      try {
        await axios.delete(
          `http://localhost:8000/api/admin/delete_event/${eventId}`
        );
        this.$router.go(0);
      } catch (error) {
        console.error("Error deleting Event:", error);
      }
    },

    viewEventDetails(index) {
      this.selectedEvent = this.events[index];
    },

    handleUpdateClick(event) {
      // Set the form fields based on the selected event
      this.title = event.title;
      this.start_date = event.start_date;
      this.end_date = event.end_date;
      this.description = event.description;
      this.image = event.image;
      this.selectedEvents = event;
    },

    updateEvent() {
      const EventInfo = {
        title: this.title,
        end_date: this.end_date,
        start_date: this.start_date,
        description: this.description,
      };

      const formData = new FormData();
      Object.entries(EventInfo).forEach(([key, value]) => {
        // Append only if the value is not null or undefined
        if (value !== null && value !== undefined) {
          formData.append(key, value);
        }
      });

      if (this.image && this.image !== this.selectedEvent.image) {
        formData.append("image", this.image);
      }
      console.log("Updating Event with ID:", this.selectedEvent.id);
      console.log("Data being sent to server:", formData);

      axios
        .post(
          `http://localhost:8000/api/admin/update_event/${this.selectedEvent.id}`,
          formData
        )
        .then((response) => {
          console.log("Update successful:", response.data);

          this.$emit("updateEvent", this.selectedEvent.id);
          this.$router.go(0);
        })
        .catch((error) => {
          console.log("Update failed:", error.response.data.errors);
        });
    },
  },
};
</script>

<template>
  <div v-if="user">
    <div class="flex flex-row min-h-screen bg-gray-100 text-gray-800">
      <aside
        class="sidebar w-64 md:shadow transform -translate-x-full md:translate-x-0 transition-transform duration-150 ease-in bg-gray-100">
        <div class="sidebar-header flex items-center justify-center py-4">
          <div class="inline-flex">
            <a href="#" class="inline-flex flex-row items-center text-decoration-none">
              <span class="leading-10 text-gray-900 text-2xl font-bold ml-1 uppercase">Library Website</span>
            </a>
          </div>
        </div>
        <div class="sidebar-content px-4 py-6">
          <ul class="flex flex-col w-full">
            <li :class="[
              'nav-item',
              'my-px',
              'type',
              'btn',
              { active: activeNavItem === 'Dasboard' },
            ]">
              <router-link :to="{ name: 'adminDashboard' }" class="text-decoration-none">
                <a href="#"
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold border-black">
                  <span class="flex items-center justify-center text-lg text-black">
                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                      stroke="currentColor" class="h-6 w-6">
                      <path
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                  </span>
                  <span class="ml-3">Dashboard</span>
                </a>
              </router-link>
            </li>

            <li :class="[
              'nav-item',
              'my-px',
              'type',
              'btn',
              { active: activeNavItem === 'Books' },
            ]">
              <router-link :to="{ name: 'crudBooks' }" class="text-decoration-none">
                <a href="#"
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold border-black">
                  <span class="flex items-center justify-center text-lg text-black">
                    <i class="bx bx-book-content fs-4"></i>
                  </span>
                  <span class="ml-3">Books</span>
                </a>
              </router-link>
            </li>

            <li :class="[
              'nav-item',
              'my-px',
              'type',
              'btn',
              { active: activeNavItem === 'Events' },
            ]">
              <router-link :to="{ name: 'crudEvents' }" class="text-decoration-none">
                <a href="#"
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold bg-[#c5ede0] border-black">
                  <span class="flex items-center justify-center text-lg text-black">
                    <i class="bx bx-calendar-event fs-4"></i>
                  </span>
                  <span class="ml-3">Events</span>
                </a>
              </router-link>
            </li>

            <li :class="[
              'nav-item',
              'my-px',
              'type',
              'btn',
              { active: activeNavItem === 'Users' },
            ]">
              <router-link :to="{ name: 'crudStaff' }" class="text-decoration-none">
                <a href="#"
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold border-black">
                  <span class="flex items-center justify-center text-lg text-black">
                    <i class="bx bx-user fs-4"></i>
                  </span>
                  <span class="ml-3">Staff</span>
                </a>
              </router-link>
            </li>

            <li :class="[
              'nav-item',
              'my-px',
              'type',
              'btn',
            ]">
                <a href="#"
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold border-black">
                  <span class="flex items-center justify-center text-lg text-black">
                    <i class="bx bx-log-out fs-4"></i>
                  </span>
                  <span class="ml-3" @click="logout">Log Out</span>
                </a>
            </li>
          </ul>
        </div>
      </aside>
      <main class="main flex flex-col flex-grow -ml-64 md:ml-0 transition-all duration-150 ease-in bg-gray-200">
        <header class="header  py-2 px-4">
          <div class="header-content flex items-center flex-row mx-3">
            <div class="max-w-2xl mx-auto w-50">
              <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
              <div class="relative flex justify-center items-center">
                <input type="search" id="default-search" v-model="searchQuery"
                  class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Search Events by title decription" required />
                <button @click="search"
                  class="text-white right-[10px] absolute bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  Search
                </button>
              </div>
            </div>

            <div class="flex ml-auto" v-if="user">
              <a href class="flex flex-row items-center">
                <img :src="getUserImageURL(user)" :alt="user.image" class="rounded-circle img-fluid mx-2"
                  style="width: 50px; height: 50px" />

                <span class="flex flex-col">
                  <span class="truncate font-semibold tracking-wide leading-none">{{ user.first_name }} {{
                    user.last_name }}</span>
                  <span class="truncate text-gray-500 text-xs leading-none mt-1">{{ user.role_user.role_name }}</span>
                </span>
              </a>
            </div>
          </div>
        </header>

        <div class="main-content flex flex-col flex-grow p-1">
          <div class="flex justify-between">
  

            <div class="text-right mx-5 mt-2">
              <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <i class="bx bx-add-to-queue text-[#243673] fs-2"></i>
                <p>Upload Event</p>
              </button>

              <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form @submit.prevent="uploadEvent">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100" id="exampleModalLabel">
                          Upload your Event
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                          @click="this.$router.go(0)"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mx-5 py-2 dashboard_textBox">
                          <div class="dashboard_textBox w-100 p-2 text-center fs-6 m-auto py-4 h-auto rounded-3">
                            <div class="flex m-auto justify-around">
                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="text" v-model="title"
                                    class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Title</label>
                                </div>
                              </div>

                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="text" v-model="description"
                                    class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Description</label>
                                </div>
                              </div>
                            </div>

                            <div class="flex m-auto justify-around">
                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="date" v-model="start_date"
                                    class="border-b mt-3 border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Start
                                    Date</label>
                                </div>
                              </div>

                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="date" v-model="end_date"
                                    class="border-b mt-3 border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">End
                                    Date</label>
                                </div>
                              </div>
                            </div>

                            <div class="flex justify-around m-auto">
                              <div class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto py-4">
                                <span class="lead text-dark fs-5 fw-bold">Select your Event picture</span>
                                <label for="file-input"
                                  class="drop-container position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                  <span class="lead drop-title text-muted fs-4 text-center">Drop here !!</span>
                                  or

                                  <input type="file" @change="onImageChange" class="dashboard_textBox m-auto fs-6" />
                                  <img :src="image" alt="Selected Image" width="100" />
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer mx-5">
                        <button type="submit" class="lead btn btn-success mt-3 ml-96">
                          Upload
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div>
            <section class="container px-2 mx-auto">
              <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-3 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-[#c5ede0] dark:bg-gray-800">
                          <tr>
                            <th scope="col" class="px-4 py-3.5 text-sm text-left rtl:text-right">
                              ID
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm text-left rtl:text-right">
                              Title
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm text-left rtl:text-right">
                              Start Date
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm text-left rtl:text-right">
                              End Date
                            </th>

                            <th scope="col ">
                              <span class="mx-5 px-4 py-3.5 text-sm text-left rtl:text-right">Actions</span>
                            </th>

                            <th scope="col ">
                              <span class="px-4 py-3.5 text-sm text-left rtl:text-right">View Detail</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody v-for="(event, index) in DisplayEvent" :key="event.id"
                          class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                          <tr>
                            <td
                              class="px-4 py-2 text-sm fw-bold font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                              <div class="inline-flex items-center gap-x-3">
                                {{ index + 1 }}
                              </div>
                            </td>
                            <td class="px-4 py-2 text-sm dark:text-gray-300 whitespace-nowrap">
                              {{ event.title }}
                            </td>
                            <td class="px-4 py-2 text-sm dark:text-gray-300 whitespace-nowrap">
                              {{ event.start_date }}
                            </td>

                            <td class="px-4 py-2 text-sm dark:text-gray-300 whitespace-nowrap">
                              {{ event.end_date }}
                            </td>

                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                              <div class="flex items-center gap-x-6">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate"
                                  @click="handleUpdateClick(event)"
                                  class="fs-6 fw-bold transition-colors duration-200 dark:hover:text-success dark:text-gray-300 hover:text-green-700 focus:outline-none">
                                  <i class="bx bx-edit text-success fs-5"></i>
                                  <span class="mx-1">Edit</span>
                                </button>

                                <div class="modal fade" id="exampleModalUpdate" tabindex="-1"
                                  aria-labelledby="exampleModalLabel" aria-hidden="true" v-if="selectedEvent">
                                  <form @submit.prevent="updateEvent">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100"
                                            id="exampleModalLabel">
                                            Update your Event
                                          </h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            @click="this.$router.go(0)" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="mx-5 py-2 dashboard_textBox">
                                            <div
                                              class="dashboard_textBox w-100 p-2 text-center fs-6 m-auto py-4 h-auto rounded-3">
                                              <div class="flex m-auto justify-around">
                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="text" v-model="title"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Title</label>
                                                  </div>
                                                </div>

                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="text" v-model="description"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Description</label>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="flex m-auto justify-around mt-3">
                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="date" v-model="start_date"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Start
                                                      Date</label>
                                                  </div>
                                                </div>

                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="date" v-model="end_date"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">End
                                                      Date</label>
                                                  </div>
                                                </div>
                                              </div>


                                              <div class=" justify-around m-auto">
                                                <div
                                                  class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto py-4">
                                                  <span class="lead text-dark fs-5 fw-bold">Select your Event
                                                    picture</span>
                                                  <label for="file-input"
                                                    class="drop-container position-relative d-flex flex-column align-items-center justify-content-center p-2 mt-3 rounded-4 border border-dashed text-muted cursor-pointer gap-2">
                                                    <span class="lead drop-title text-muted fs-4 text-center">Drop here
                                                      !!</span>
                                                    or

                                                    <input type="file" @change="onImageChange"
                                                      class="dashboard_textBox m-auto fs-6" />
                                                    <img :src="image" alt="Selected Image" width="100" />
                                                  </label>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer mx-5">
                                          <button type="submit" class="lead btn btn-success mt-3 ml-96">
                                            Update
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                                <button @click="deleteEvent(event.id)"
                                  class="fs-6 fw-bold transition-colors duration-200 hover:text-red-700 focus:outline-none">
                                  <i class="bx bx-trash text-danger fs-5"></i>
                                  <span class="mx-1">Delete</span>
                                </button>
                              </div>
                            </td>

                            <td
                              class="px-4 py-2 text-sm fw-bold cursor-pointer text-gray-500 dark:text-gray-300 whitespace-nowrap"
                              data-bs-toggle="modal" data-bs-target="#exampleModal3" @click="viewEventDetails(index)">
                              <i class="bx bx-file-find fs-4 text-secondary mx-4"></i>
                            </td>

                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100"
                                      id="exampleModalLabel">
                                      Event Detail
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                      @click="this.$router.go(0)"></button>
                                  </div>
                                  <div class="modal-body" v-if="selectedEvent">
                                    <div class="flex justify-around items-center">
                                      <div class="Event-card flex justify-between">
                                        <img :src="getEventImageURL(selectedEvent)"
                                          class="Event-cover w-[300px] h-[300px] img-fluid" alt="Event Cover" />
                                        <div class="Event-info mx-4">
                                          <h2 class="text-xl font-semibold">
                                            Title : {{ selectedEvent.title }}
                                          </h2>

                                          <p class="text-gray-800">
                                            {{ selectedEvent.description }}
                                          </p>

                                          <p class="text-gray-700">
                                            Start Date:
                                            {{ selectedEvent.start_date }}
                                          </p>
                                          <p class="text-gray-700">
                                            End Date:
                                            {{ selectedEvent.end_date }}
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between mt-6 mb-4">
                <a href="#" @click.prevent="prevPage"
                  class="flex items-center px-5 py-2 text-sm capitalize transition-colors duration-200 bg-[#c5ede0] text-black fw-bold fs-4 border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                  </svg>

                  <span> previous </span>
                </a>

                <div class="items-center hidden md:flex gap-x-3">
                  <!-- Display pagination links based on the total number of pages -->
                  <a href="#" v-for="page in totalPages" :key="page" class="px-2 py-1 text-sm" :class="{
                    'text-success fw-bold fs-3': currentPage === page,
                    'text-gray-500': currentPage !== page,
                  }" @click.prevent="goToPage(page)">
                    {{ page }}
                  </a>
                </div>

                <a href="#" @click.prevent="nextPage"
                  class="flex items-center px-5 py-2 text-sm bg-[#c5ede0] text-black fw-bold fs-4 capitalize transition-colors duration-200 border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                  <span>Next</span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                  </svg>
                </a>
              </div>
            </section>
          </div>

          <div v-if="errormessage" class="lead m-auto text-center fs-6 bg-[#a4c7da] w-75 rounded-5 shadow-md py-2">
            {{ errormessage }} &#128142;
            <button type="button" class="btn-close" @click="$router.go(0)"></button>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
