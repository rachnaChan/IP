<script>
// @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
import axios from "axios";
export default {
  data() {
    return {
      events: [],
      activeNavItem: null,
      selectedEvent: null,
    };
  },
  mounted() {
    this.fetchEvents();
  },

  methods: {
    setEventId(eventId) {
      this.eventId = eventId;
    },
    fetchEvents() {
      axios
        .get(`http://localhost:8000/api/get_event`)
        .then((response3) => {
          this.events = response3.data;

          console.log(this.events);
        })
        .catch((error) => {
          console.error("Error fetching Event:", error);
        });
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

    // //display date as 01-september-2023
    dueDateSt(start_date) {
      if (!start_date) return "";
      const date = new Date(start_date);
      const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sept",
        "Oct",
        "Nov",
        "Dec",
      ];

      // Get the month, day, and year components from the Date object
      const day = date.getDate();
      const month = date.toLocaleString("default", { month: "long" }); // Get the full month name
      const year = date.getFullYear();

      // Create the formatted date string
      return `${day} ${month} ${year} `;
      // console.log(this.formattedDate);
    },

    dueDateEnd(deadline) {
      if (!deadline) return "";
      const date = new Date(deadline);
      const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sept",
        "Oct",
        "Nov",
        "Dec",
      ];

      // Get the month, day, and year components from the Date object
      const day = date.getDate();
      const month = date.toLocaleString("default", { month: "long" }); // Get the full month name
      const year = date.getFullYear();

      // Create the formatted date string
      return `${day} ${month} ${year} `;
      // console.log(this.formattedDate);
    },

    dueDateDead(deadline) {
      if (!deadline) return "";
      const date = new Date(deadline);
      const daysOfWeek = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ];
      const dayOfWeek = daysOfWeek[date.getDay()]; // Get the day of the week as a string

      const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sept",
        "Oct",
        "Nov",
        "Dec",
      ];
      const month = monthNames[date.getMonth()]; // Get the month as a string
      const day = date.getDate();
      const daySuffix = this.getDaySuffix(day); // Get the day suffix (e.g., "st", "nd", "rd", "th")

      // Create the formatted date string
      return `${month} ${day < 10 ? "0" : ""}${day}  ${dayOfWeek}`;
    },

    getDaySuffix(day) {
      if (day >= 11 && day <= 13) {
        return "th";
      }
      const lastDigit = day % 10;
      switch (lastDigit) {
        case 1:
          return "st";
        case 2:
          return "nd";
        case 3:
          return "rd";
        default:
          return "th";
      }
    },

    dueDateStatus(deadline) {
      if (!deadline) return "No deadline provided";

      const currentDate = new Date();
      const dueDate = new Date(deadline);

      // Calculate the time remaining in milliseconds
      const timeRemainingMillis = dueDate - currentDate;

      // Calculate the days remaining
      const daysRemaining = Math.ceil(
        timeRemainingMillis / (1000 * 60 * 60 * 24)
      );

      if (daysRemaining < 0) {
        // The deadline has passed, calculate the days that have passed
        const daysPassed = Math.abs(daysRemaining);
        return `Due ${daysPassed} day${daysPassed !== 1 ? "s" : ""} ago`;
      } else if (daysRemaining === 0) {
        return "Due Today";
      } else {
        return `Days remaining: ${daysRemaining}`;
      }
    },

    viewEventDetail(index) {
      this.selectedEvent = this.events[index];
    },

    scrollToTop() {
      // Get the target element by its id
      const targetElement = document.getElementById("home");

      // Check if the target element exists
      if (targetElement) {
        // Use smooth scroll behavior
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }

      this.activeNavItem = "home";
    },
  },
};
</script>

<template>
  <div id="home">
    <section id="header">
      <div>
        <ul id="navbar">
          <li>
            <router-link :to="{ name: 'home' }">
              <a class="" href="">New Arrivals</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'event' }">
              <a class="active" href="">Events</a>
            </router-link>
          </li>
        </ul>
      </div>

      <img style="justify-content: center; width: 150px" src="../../public/Library .png" alt="Image" />
      <div>
        <ul id="navbar">
          <li>
            <router-link :to="{ name: 'home' }">
              <a href="">Home</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'book' }"><a href="#">Book</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'about' }"><a href="#">About</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'home' }"><a href="#">Contact</a>
            </router-link>
          </li>
          <li class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser1"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bx bx-user-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1"
              style="min-width: 0">
              <li class="mt-1">
                <router-link :to="{ name: 'login' }">
                  <a href="#" class="dropdown-item">
                    <span class="ms-1 d-none d-sm-inline text-sm">Login As Admin</span>
                  </a>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div id="mobile">
        <a href=""><i class="fa-solid fa-bars"></i></a>
      </div>
    </section>

    <section id="eventlist" class="py-3 flex ">
      <div class="container mx-auto px-4 py-8 max-w-md w-75">
        <div class="grid grid-cols-2 gap-6 w-100">
          <div v-for="(event, index) in events" :key="index" class="rounded-lg border-2 relative h-[300px] " style="
              background-size: cover;
              background-repeat: no-repeat;
              background-position: center;
              overflow: hidden;
            ">
            <img :src="getEventImageURL(event)" class="w-full h-full object-cover blur-md  " alt="Event Image"
              style="transform: scale(1.05)" />

            <div class="absolute bottom-0 left-0 right-0 p-4 text-white text-start flex justify-between">
              <div>
                <p class="text-lg font-bold">{{ event.title }}</p>
                <p>
                  {{ dueDateSt(event.start_date) }} -
                  {{ dueDateSt(event.end_date) }}
                </p>
              </div>
              <div>
                <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal3"
                  @click="viewEventDetail(index)">
                  Detail
                </button>
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100" id="exampleModalLabel">
                          Event Detail
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                          @click="this.$router.go(0)"></button>
                      </div>
                      <div class="modal-body" v-if="selectedEvent">
                        <div class="flex justify-around items-center">
                          <div class="Event-card flex justify-between">
                            <img :src="getEventImageURL(selectedEvent)"
                              class="Event-cover w-[300px] h-[300px] img-fluid animate-pulse" alt="Event Cover" />
                            <div class="Event-info mx-4">
                              <h2 class="text-xl font-semibold">
                                Title : {{ selectedEvent.title }}
                              </h2>
                              <p class="text-gray-800">
                                By : {{ selectedEvent.user_event.first_name }} {{ selectedEvent.user_event.last_name }}
                              </p>

                              <p class="text-gray-800">
                                {{ selectedEvent.description }}
                              </p>

                              <p class="text-gray-700">
                                Start Date:
                                {{ dueDateSt(selectedEvent.start_date) }}
                              </p>
                              <p class="text-gray-700">
                                End Date:
                                {{ dueDateSt(selectedEvent.end_date) }}
                              </p>

                              <p class="text-gray-700">
                                {{ dueDateStatus(selectedEvent.end_date) }}
                              </p>
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

      <div
        class="flex flex-col gap-1  mx-5 w-25 justify-center items-start w-[280px] bg-white dark:bg-transparent px-4 py-4 shadow-sm rounded-lg">
        <p class="font-semibold text-xl text-gray-600 mb-2">See more</p>
        <div class="flex flex-wrap gap-2">
          <router-link :to="{ name: 'about' }" class="text-decoration-none">
            <p
              class="px-3 py-1 text-[12px] bg-[#d9dfe3] max-w-max rounded font-semibold text-[#7281a3] hover:bg-[#c5ede0]">
              #about
            </p>
          </router-link>

          <router-link :to="{ name: 'book_all' }" class="text-decoration-none">
            <p class="px-3 py-1 text-[12px] bg-[#d9dfe3] max-w-max rounded font-semibold text-[#7281a3]">
              #book
            </p>
          </router-link>

          <router-link :to="{ name: 'contact' }" class="text-decoration-none">
            <p class="px-3 py-1 text-[12px] bg-[#d9dfe3] max-w-max rounded font-semibold text-[#7281a3]">
              #contact
            </p>
          </router-link>
        </div>
      </div>
    </section>

    <section class="bg-[#ccdee0] h-24 mt-5">

      <div class="px-4 py-6 flex justify-between ">

        <div class="mt-2">
          <div class="text-lg sm:text-center ">© {{ currentYear }}<a href="https://www.facebook.com/itckh?mibextid=ZbWKwL"
              class=" text-decoration-none"> &ensp; Library Website</a>. All Rights Reserved.
          </div>
        </div>

        <div class="flex mt-2 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
          <a href="https://itc.edu.kh/">
            <i class="bx bxs-webcam fs-2 text-center m-auto "></i>
          </a>

          <a href="https://www.facebook.com/itckh?mibextid=ZbWKwL">
            <i class="bx bxl-meta fs-2 text-center m-auto "></i>
          </a>


          <a href="https://weibo.com/u/6333691724">
            <i class="bx bxl-reddit fs-2 text-center m-auto "></i>
          </a>

        </div>
      </div>


    </section>

    <button class="rounded-full position-sticky z-index-999 right-2 bottom-0" @click="scrollToTop">
      <i class='bx bx-up-arrow-circle fs-1 text-[#3a686e] p-2'></i>
    </button>

  </div>
</template>
