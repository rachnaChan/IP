<script>
// @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
import axios from "axios";
import Swiper from "swiper";

export default {
  data() {
    return {
      books: [],
      searchQuery: "",
      searchResults: [],
      latest_book: [],
      categories: ["GIC", "AMS", "GIM", "GCA", "GEE", "GTR", "OAC", "GGG"],
      selectedCategory: null,
      events: [],
      loopArray: ["30%", "40%", "50%", "60%", "70%"],
      backgroundImage: "1bg.jpg",
      activeNavItem: null,
      showModal: false,
      currentYear: new Date().getFullYear()

    };
  },
  mounted() {
    // let a = this.$ref.books.image;
    let qmxnasgyd = this.$refs.qmxnasgyd;
    let cmkndndsj = this.$refs.cmkndndsj;
    let nckjndjkk = this.$refs.nckjndjkk;
    let klnckjndn = this.$refs.klnckjndn;
    let kfjkdnjdn = this.$refs.kfjkdnjdn;
    let coverIndex = 1;
    setInterval(() => {
      coverIndex += 1;
      this.backgroundImage = coverIndex + "bg.jpg";
      if (coverIndex === 3) coverIndex = 0;
      this.loopArray.push(this.loopArray.shift());
      qmxnasgyd.style.left = this.loopArray[0];
      cmkndndsj.style.left = this.loopArray[1];
      nckjndjkk.style.left = this.loopArray[2];
      klnckjndn.style.left = this.loopArray[3];
      kfjkdnjdn.style.left = this.loopArray[4];
    }, 4000);
    this.fetchBook();
    this.fetchEvents();
  },

  computed: {
    getFilteredBooks() {
      // If a category is selected, filter books based on the selected category; otherwise, show all books
      return this.selectedCategory
        ? this.latest_book.filter(
          (book) => book.categories_type === this.selectedCategory
        )
        : this.latest_book;
    },
  },

  methods: {
    fetchBook() {
      axios
        .get(`http://localhost:8000/api/listarrivalBooks`)
        .then((response3) => {
          this.latest_book = response3.data;

          console.log(this.latest_book);
        })
        .catch((error) => {
          console.error("Error fetching Book:", error);
        });
    },

    loadBooks() {
      this.fetchBook();
      this.isDataLoaded = true;
    },

    search() {
      // Make a request to your backend API for searching books
      axios
        .get(`http://localhost:8000/api/searchBook/${this.searchQuery}`)
        .then((response) => {
          this.searchResults = response.data;
          console.log(this.searchQuery);
          this.showModal = true;
        })
        .catch((error) => {
          console.error("Error fetching search results:", error);
        });
    },

    closeModal() {
      // Close the modal
      this.showModal = false;
    },

    getBookImageURL(books) {
      if (books.image) {
        const imageUrl = `http://localhost:8000/storage/${books.image}`;
        // console.log('Image URL:', imageUrl); // Log the image URL
        return imageUrl;
      } else if (books.image == null) {
        const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
        // console.log(imageAuto);
        return imageAuto;
      }
    },

    // selectCategory(category) {
    //     this.selectedCategory = category === this.selectedCategory ? null : category;
    // },

    selectCategory(category) {
      this.selectedCategory = category;
    },
    getCategoryImage(category) {
      // Add logic to return the image path based on the selected category
      switch (category) {
        case "GIC":
          return "../../public/gic.png";
        case "AMS":
          return "../../public/ams.png";
        case "GIM":
          return "../../public/gim.png";
        case "GCA":
          return "../../public/gca.png";
        case "GEE":
          return "../../public/gee.jpg";
        case "GTR":
          return "../../public/gtr.jpg";
        case "OAC":
          return "../../public/oac.jpg";
        case "GGG":
          return "../../public/gge.png";

        default:
          return "../../public/default-image.png"; // Provide a default image path
      }
    },
    resetCategory() {
      this.selectedCategory = null;
    },

    fetchEvents() {
      axios
        .get(`http://localhost:8000/api/get_event`)
        .then((response3) => {
          // this.events = response3.data.slice(0, 1);

          // console.log(this.events);

          const currentDate = new Date();

          // Filter events that have end_date greater than the current date
          const upcomingEvents = response3.data.filter(event => new Date(event.end_date) > currentDate);

          // Sort the upcoming events based on end_date in ascending order
          upcomingEvents.sort((a, b) => new Date(a.end_date) - new Date(b.end_date));

          // Get the event with the closest end_date (the first one after sorting)
          this.events = upcomingEvents.slice(0, 1);

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

    scrollToBooks() {
      // Get the target element by its id
      const targetElement = document.getElementById("booklist");

      // Check if the target element exists
      if (targetElement) {
        // Use smooth scroll behavior
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }

      this.activeNavItem = "books";
    },
    scrollToEvents() {
      // Get the target element by its id
      const targetElement = document.getElementById("eventlist");

      // Check if the target element exists
      if (targetElement) {
        // Use smooth scroll behavior
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }

      this.activeNavItem = "events";
    },
    scrollToAbouts() {
      // Get the target element by its id
      const targetElement = document.getElementById("aboutlist");

      // Check if the target element exists
      if (targetElement) {
        // Use smooth scroll behavior
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }

      this.activeNavItem = "about";
    },

    scrollToContacts() {
      // Get the target element by its id
      const targetElement = document.getElementById("contactlist");

      // Check if the target element exists
      if (targetElement) {
        // Use smooth scroll behavior
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }

      this.activeNavItem = "contact";
    },

    scrollToHome() {
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

    // //display date as 01-september-2023
    dueDateSt(start_date) {
      if (!start_date) return "";
      const date = new Date(start_date);
      const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];

      // Get the month, day, and year components from the Date object
      const day = date.getDate();
      const month = date.toLocaleString("default", { month: "long" }); // Get the full month name
      const year = date.getFullYear();

      // Create the formatted date string
      return `${day} ${month} ${year} `;
      // console.log(this.formattedDate);
    },

    dueDateEnd(end_date) {
      if (!end_date) return "";
      const date = new Date(end_date);
      const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];

      // Get the month, day, and year components from the Date object
      const day = date.getDate();
      const month = date.toLocaleString("default", { month: "long" }); // Get the full month name
      const year = date.getFullYear();

      // Create the formatted date string
      return `${day} ${month} ${year} `;
      // console.log(this.formattedDate);
    },

    dueDateDead(end_date) {
      if (!end_date) return "";
      const date = new Date(end_date);
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
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
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

    dueDateStatus(end_date) {
      if (!end_date) return "No end_date provided";

      const currentDate = new Date();
      const dueDate = new Date(end_date);

      // Calculate the time remaining in milliseconds
      const timeRemainingMillis = dueDate - currentDate;

      // Calculate the days remaining
      const daysRemaining = Math.ceil(
        timeRemainingMillis / (1000 * 60 * 60 * 24)
      );

      if (daysRemaining < 0) {
        // The end_date has passed, calculate the days that have passed
        const daysPassed = Math.abs(daysRemaining);
        return `Due ${daysPassed} day${daysPassed !== 1 ? "s" : ""} ago`;
      } else if (daysRemaining === 0) {
        return "Due Today";
      } else {
        return ` ${daysRemaining}`;
      }
    },

    getUserImageURL(user) {
      if (user.image) {
        const imageUrl = `http://localhost:8000/storage/${user.image}`;
        // console.log('Image URL:', imageUrl); // Log the image URL
        // console.log('Image URL:', getUserImageURL(users));

        return imageUrl;
      } else if (user.image == null) {
        const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
        // console.log(imageAuto);
        return imageAuto;
      }
    },
  },
};
</script>

<template>
  <div>
    <section id="header">
      <div>
        <ul id="navbar">
          <li>
            <a :class="{ active: activeNavItem === 'books' }" href="" @click.prevent="scrollToBooks">New Arrivals</a>
          </li>

          <li>
            <a :class="{ active: activeNavItem === 'events' }" href="" @click.prevent="scrollToEvents">Events</a>
          </li>
        </ul>
      </div>

      <img style="justify-content: center; width: 150px" src="../../public/Library .png" alt="Image" />

      <div>
        <ul id="navbar">
          <li>
            <a :class="{ active: activeNavItem === 'home' }" href="" @click.prevent="scrollToHome">Home</a>
          </li>
          <li>
            <router-link :to="{ name: 'book' }"><a href="#">Book</a>
            </router-link>
          </li>
          <li>
            <a :class="{ active: activeNavItem === 'about' }" href="" @click.prevent="scrollToAbouts">About</a>
          </li>
          <li>
            <a :class="{ active: activeNavItem === 'contact' }" href="" @click.prevent="scrollToContacts">Contact</a>
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

    <div id="home" class="cover-wrapper" :style="{ backgroundImage: `url(${backgroundImage})` }">

      <div class="w-75">
        <div class="search-item">
          <input type="text" v-model="searchQuery" placeholder="Search book by keyword ..." />
          <button @click="search">Search</button>
        </div>
      </div>

      <div v-if="showModal"
        class="fixed w-90 m-auto z-50 mt-5 bg-gray-500 bg-opacity-50 overflow-y-auto max-h-[80vh] scrollbar-hidden ">
        <div class="flex justify-end ">
          <button @click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="grid grid-cols-5 gap-5">

          <div v-if="searchResults.length === 0" class="bg-white rounded-lg p-6 shadow-md text-center">
            <p>No book was found.</p>
          </div>
          <div v-else class="bg-white rounded-lg p-6 shadow-md" v-for="book in searchResults" :key="book.id">
            <p class="font-semibold text-center overflow-hidden m-auto fs-6 h-12">
              isbn : {{ book.isbn }}
            </p>

            <div class="img aspect-square bg-gray-200 z-40 rounded-md">
              <img :src="getBookImageURL(book)"
                class="rounded-2xl mx-2 m-auto text-center mt-3 w-[200px] h-[200px] py-2" />
            </div>
            <p class="text-gray-600 mt-3">
              Author : <span class="text-gray-900">{{ book.author }}</span>
            </p>
            <p class="text-gray-600 mt-3">
              Categories :
              <span class="text-gray-900">{{ book.categories_type }}</span>
            </p>
            <p class="text-gray-600">
              Released year :
              <span class="text-gray-900">{{ book.release_year }}</span>
            </p>
            <div class="btn">
              <router-link :to="{ name: 'book_information', params: { id: book.id } }">
                <button
                  class="uppercase font-semibold text-xs mx-4 px-2 whitespace-nowrap py-1 rounded-full bg-gray-300 text-gray-800 text-center justify-center m-auto">
                  View Detail
                </button>
              </router-link>
            </div>
          </div>
        </div>
      </div>

      <div class="book-wrapper limitation">
        <div class="wl">
          <h1>Featured books of this month</h1>
          <h4>New Arrivals books</h4>
          <button @click.prevent="scrollToBooks">Check</button>
        </div>

        <div class="wr">
          <img class="book-1" src="../../public/1.jpg" ref="qmxnasgyd" />
          <img class="book-2" src="../../public/2.jpg" ref="cmkndndsj" />
          <img class="book-3" src="../../public/3.jpeg" ref="nckjndjkk" />
          <img class="book-4" src="../../public/4.jpg" ref="klnckjndn" />
          <img class="book-5" src="../../public/5.png" ref="kfjkdnjdn" />
        </div>
      </div>
      <div class="dot-wrapper">
        <div :class="loopArray[0] === '30%' ? 'active' : ''"></div>
        <div :class="loopArray[0] === '40%' ? 'active' : ''"></div>
        <div :class="loopArray[0] === '50%' ? 'active' : ''"></div>
        <div :class="loopArray[0] === '60%' ? 'active' : ''"></div>
        <div :class="loopArray[0] === '70%' ? 'active' : ''"></div>
      </div>
    </div>

    <div id="aboutlist" class="flex flex-col lg:flex-row justify-around m-auto py-5 h-auto">
      <div class="shadow-md lg:w-1/2 mx-5">
        <p class="text-[#3d6a70] fw-bold text-2xl">About Us</p>
        <p class="m-auto lg:w-3/4 text-2xl fw-bold py-2">
          Digital Pages: The Evolution of Library Websites
        </p>

        <p class="w-90 m-auto mx-5 text-start text-xl justify-between text-transition text-wrap">
          &ensp; In the late 20th century, libraries embraced the digital age, giving rise to the evolution of library
          websites.
          The shift began with initiatives like the Library of Congress's "Digital Library Initiative" in 1994, marking a
          pivotal moment in making vast collections accessible online. These early endeavors paved the way for the
          comprehensive digital repositories we see today. From simple catalog searches to offering a plethora of digital
          resources, e-books, and databases, library websites have transformed into dynamic portals. The title "Digital
          Pages" encapsulates this evolution, emphasizing the transition from physical to digital collections, showcasing
          the continuous commitment of libraries to provide accessible and diverse information in the digital era.
        </p>
        <router-link :to="{ name: 'about' }" class="text-black">
          <p class="text-right mx-3 fs-5">view more</p>
        </router-link>
      </div>

      <div class="lg:w-1/2 m-auto">
        <div class="w-full lg:w-3/4 m-auto mt-2">
          <img src="../assets/Img/about.jpg" alt="" class="rounded-5 shadow-lg w-[100vh] h-[60vh] object-cover p-2" />
        </div>
        <!-- <div class="container mx-auto px-4 py-8 max-w-md w-full lg:w-3/4">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mx-4">
            <div class="border-1 shadow-lg rounded-4 bg-[#61a7b1]">
              <p class="fs-4 fw-bold" v-for="user in users" :key="user.id">{{ user.length }}</p>
              <p>Staff</p>
            </div>
          </div>
        </div> -->
      </div>
    </div>

    <div class="feature-category limitation">
      <h1 class="text-center mb-4">
        Explore Feature Categories By Clicking on it
      </h1>
      <div class="list-category d-flex justify-content-around flex-wrap">
        <div v-for="category in categories" :key="category" @click="selectCategory(category)"
          :class="{ 'active-category': selectedCategory === category }" class="box-category text-center p-3 mb-3">
          <img :src="getCategoryImage(category)" alt="Category Image" class="category-image" />
          <h4 class="mt-2">{{ category }}</h4>
        </div>
      </div>
    </div>

    <section id="booklist" class="">
      <h2>
        New Arrival
        <span @click="resetCategory" class="cursor-pointer">BOOKS</span>
      </h2>
      <div class="pro-container">
        <div class="container mx-auto w-90 m-auto">
          <div class="grid grid-cols-5 gap-5">
            <div v-for="(book, index) in getFilteredBooks" :key="index" class="bg-white rounded-lg p-6 shadow-md">
              <div class="img aspect-square bg-gray-200 z-40 rounded-md">
                <img :src="getBookImageURL(book)"
                  class="rounded-2xl mx-2 m-auto text-center mt-3 w-[200px] h-[200px] py-2" />
              </div>
              <p class="text-gray-600 mt-3">
                Author : <span class="text-gray-900">{{ book.author }}</span>
              </p>
              <p class="text-gray-600 mt-3">
                Categories :
                <span class="text-gray-900">{{ book.categories_type }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="Footer-pro">
        <router-link :to="{ name: 'book_all' }" class="text-[#3A686E]">
          <h1>View All Books</h1>
        </router-link>
      </div>
    </section>

    <section id="eventlist" class="py-3">
      <h2>Coming Up</h2>
      <p class="text-2xl mb-2 text-[#3A686E] text-center">Book Launch</p>
      <div class="justify-between flex flex-row m-auto p-4" v-for="(event, index) in events" :key="index">
        <div class="w-50 text-start-end mx-3 m-auto text-2xl">
          <p><span class="fw-bold">Events : </span> {{ event.title }}</p>
          <p>
            <span class="fw-bold">By : </span>
            {{ event.user_event.first_name }} {{ event.user_event.last_name }}
          </p>
          <p>
            <span class="fw-bold">When : </span>{{ dueDateSt(event.start_date) }} - {{ dueDateSt(event.end_date) }}
          </p>
          <p>
            <span class="fw-bold">Remaining Days : </span>{{ dueDateStatus(event.end_date) }}
          </p>

          <router-link :to="{ name: 'event' }" class="text-[#3A686E]">
            <button class="hover:bg-gray-700 bg-gray-800 text-gray-100 mt-6 rounded p-2 px-6">
              Explore
            </button>
          </router-link>
        </div>

        <div class="w-50 mx-5">
          <img :src="getEventImageURL(event)"
            class="rounded-2xl mx-2 m-auto text-center shadow-lg mt-3 img-fluid max-h-[70vh] animate-pulse" width="auto"
            height="auto" />
        </div>
      </div>
    </section>

    <section id="contactlist" class="container mx-auto px-4 md:px-6 py-8 shadow-lg">
      <div class="">
        <div class="rounded-lg dark:bg-neutral-700 p-4 lg:flex justify-between flex">
          <div class="h-[240px] w-[900px] ">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.3229660984145!2d104.8955108!3d11.5704027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109517388680e15%3A0x63057e6682968f5!2sInstitute%20of%20Technology%20of%20Cambodia!5e0!3m2!1sen!2sus"
              width="100%" height="100%" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
          </div>
          <div class="mx-5">

            <div class="">
              <router-link :to="{ name: 'contact' }" class="text-decoration-none">
                <button class="font-bold text-white rounded-2 fs-4 bg-[#3A686E] p-2">Contact Us</button>
              </router-link>

            </div>
          </div>
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

    <button class="rounded-full position-sticky z-index-9 right-2 bottom-0" @click="scrollToTop">
      <i class='bx bx-up-arrow-circle fs-1 text-[#3a686e] p-2'></i>
    </button>

  </div>
</template>

<style>
@import url("https://fonts.googleapis.com/css2?family=Dosis&display=swap");

* {
  margin: 0;
  padding: 0;
}


html {
  scroll-behavior: smooth;
}

/* Header Start */

h5 {
  font-family: "dosis";
}

p {
  transition: opacity 0.3s ease-in-out;
}

#header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 80px;
  background: white;
  box-shadow: black;
  z-index: 999;
  height: 10vh;
  position: sticky;
  top: 0;
  left: 0;
  font-family: "dosis";
}

#navbar {
  display: flex;
  align-items: center;
  justify-content: center;
}

#navbar li {
  list-style: none;
  padding: 0 20px;
  position: relative;
}

#navbar li a {
  text-decoration: none;
  font-size: 26px;
  font-weight: 600;
  color: #3a686e;
  transition: 0.3s ease;
}

#navbar li a:hover,
#navbar li a.active {
  color: #707171;
}

#navbar li a.active::after,
#navbar li a:hover::after {
  content: "";
  width: 30%;
  height: 2px;
  background: #707171;
  position: absolute;
  bottom: -4px;
  left: 20px;
}

#mobile {
  display: none;
  align-items: center;
}

#close {
  display: none;
}

.search-wrapper {
  width: 560px;
  height: 6vh;
  background-color: white;
  top: 25%;
  left: 35%;
  right: 65%;
  position: absolute;
}

.search-item {
  background: #fff;
  width: 100%;
  height: 60px;
  display: flex;
  align-items: center;
  padding: 0 25px;
  justify-content: space-between;
  gap: 5px;
}

.search-item input {
  outline: none;
  font-size: 20px;
  flex-grow: 1;
  color: black;
  text-transform: none;
}

.search-item button {
  width: 100px;
  height: 2.8vh;
  border: none;
  background: #ccdee0;
  color: black;
  border-radius: 50px;
  font-size: 20px;
  text-align: center;
}

.text {
  top: 40%;
  left: 4%;
  position: absolute;
  line-height: normal;
}

.text {
  top: 40%;
  left: 4%;
  position: absolute;
  line-height: normal;
}

.text h1 {
  color: #3a686e;
  font-size: 45px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  font-family: "dosis";
}

.explore button {
  background-color: #ccdee0;

  position: absolute;
  width: 170px;
  height: 8vh;
  font-size: 40px;
  border-radius: 25px;
}

.lasttext {
  right: 4%;
  bottom: 10%;
  position: absolute;
  line-height: normal;
}

.lasttext h1 {
  color: #3a686e;
  font-size: 45px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}


#booklist,
#eventlist,
#aboutlist {
  text-align: center;
}

#booklist h2,
#eventlist h2,
#aboutlist h2 {
  font-size: 40px;
  color: #3d6a70;
  margin-bottom: 18px;
}

#booklist .pro-container,
#eventlist .pro-container,
#aboutlist .pro-container {
  display: flex;
  justify-content: space-between;
  padding: 40px 80px;
  flex-wrap: wrap;
}

#booklist .pro,
#eventlist .pro,
#aboutlist .pro {
  width: 350px;
  height: 65vh;
  padding: 10px 12px;
  border: 1px solid #cce7d0;
  border-radius: 25px;
  cursor: pointer;
  box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02);
  margin: 15px 0;
  transition: 0.2s ease;
  position: relative;
}

#booklist .pro1,
#eventlist .pro1,
#aboutlist .pro1 {
  width: 25%;
  height: 70vh;
  padding: 40px 22px;
  border-radius: 0px;
  cursor: pointer;
  margin: 15px 0;
  transition: 0.2s ease;
  position: relative;
}

#booklist .pro:hover,
#eventlist .pro:hover,
#aboutlist .pro:hover {
  box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
}

#booklist .pro img,
#eventlist .pro img,
#aboutlist .pro img {
  width: 100%;
  border-radius: 5px;
}

#booklist .pro1 img,
#eventlist .pro1 img,
#aboutlist .pro1 img {
  width: 100%;
  border-radius: 5px;
}

#booklist .pro .des,
#eventlist .pro .des,
#aboutlist .pro .des {
  text-align: start;
  padding: 10px 0;
}

#booklist .pro1 .des,
#eventlist .pro1 .des,
#aboutlist .pro1 .des {
  text-align: start;
  padding: 10px 0;
}

#booklist .pro .des span,
#eventlist .pro .des span,
#aboutlist .pro .des span {
  color: #2d99a8;
  font-size: 16px;
}

#booklist .pro1 .des span,
#eventlist .pro1 .des span,
#aboutlist .pro .des span {
  color: #2d99a8;
  font-size: 16px;
}

#booklist .pro .des h5,
#eventlist .pro .des h5,
#aboutlist .pro .des h5 {
  padding-top: 7px;
  color: #3d6a70;
  font-size: 15px;
  text-align: center;
  position: relative;
}

#booklist .pro1 .des h5,
#eventlist .pro1 .des h5,
#aboutlist .pro1 .des h5 {
  padding-top: 15px;
  color: #3d6a70;
  font-size: 15px;
  text-align: center;
  position: relative;
}

#booklist .pro .des i,
#eventlist .pro .des i,
#aboutlist .pro .des i {
  font-size: 12px;
  color: rgb(243, 181, 25);
}

#booklist .pro1 .des i,
#eventlist .pro1 .des i,
#aboutlist .pro1 .des i {
  font-size: 12px;
  color: rgb(243, 181, 25);
}

#booklist .pro .des h4,
#eventlist .pro .des h4,
#aboutlist .pro .des h4 {
  padding-top: 7px;
  font-size: 15px;
  text-align: center;
  font-weight: 700;
  color: #088178;
}

#booklist .pro1 .des h4,
#eventlist .pro1 .des h4,
#aboutlist .pro1 .des h4 {
  padding-top: 7px;
  font-size: 15px;
  text-align: center;
  font-weight: 700;
  color: #088178;
}

#booklist .Footer-pro h1,
#eventlist .Footer-pro h1,
#aboutlist .Footer-pro h1 {
  font-size: 20px;
  color: #088178;
  position: relative;
  left: 40%;
}

#booklist .Footer-pro h2,
#eventlist .Footer-pro h2,
#aboutlist .Footer-pro h2 {
  font-size: 20px;
  position: relative;
  left: 38%;
}

#product1 .Footer-pro h1 {
  font-size: 20px;
  color: #088178;
  font-family: "Inknut Antiqua", sans-serif;
  position: relative;
  left: 40%;
}

#product1 .Footer-pro h2 {
  font-size: 20px;
  font-family: "Inknut Antiqua", sans-serif;
  position: relative;
  left: 38%;
}




/* Start Media query */
@media (max-width: 799px) {
  .section-p1 {
    padding: 40px 40px;
  }

  #header img {
    width: 120px;
    right: 35%;
    position: relative;
  }

  #navbar {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    position: fixed;
    top: 0;
    right: -300px;
    height: 80vh;
    width: 300px;
    background-color: #e3e6f3;
    box-shadow: 0 40px 60px rgb(0, 0, 0, 0.1);
    padding: 80px 0 0 10px;
    transition: 0.3s;
  }

  #navbar.active {
    right: 0px;
  }

  #navbar li {
    margin-bottom: 25px;
  }

  #mobile {
    display: flex;
    align-items: center;
  }

  #mobile i {
    color: #1a1a1a;
    font-size: 24px;
    padding-left: 20px;
  }

  #close {
    display: initial;
    position: absolute;
    top: 30px;
    left: 30px;
    color: #222;
    font-size: 24px;
  }

  #lg-bag {
    display: none;
  }

  #hero {
    height: 70vh;
    padding: 0 80px;
    background-position: top 30% right 30%;
  }

  #feature {
    justify-content: center;
  }

  #feature .fe-box {
    margin: 15px 15px;
  }

  #booklist .pro-container,
  #eventlist .pro-container,
  #aboutlist .pro-container {
    justify-content: center;
  }

  #booklist .pro,
  #eventlist .pro,
  #aboutlist .pro {
    margin: 15px;
  }

  #banner {
    height: 20vh;
  }

  #sm-banner .banner-box {
    min-width: 100%;
    height: 30vh;
  }

  #banner3 {
    padding: 0 40px;
  }

  #banner3 .banner-box {
    width: 28%;
  }

  #newsletter .form {
    width: 70%;
  }
}

@media (max-width: 477px) {
  .section-p1 {
    padding: 20px;
  }

  #header {
    padding: 10px 30px;
  }

  h1 {
    font-size: 38px;
  }

  h2 {
    font-size: 32px;
  }

  #feature {
    justify-content: space-between;
  }

  #feature .fe-box {
    width: 120px;
    margin: 0 0 15px 0;
  }

  #booklist .pro,
  #eventlist .pro,
  #aboutlist .pro {
    width: 100%;
  }

}

.active-category {
  border: 2px solid black;
  /* Add your desired border style */
  /* Add any other styling for the active category */
}
</style>
