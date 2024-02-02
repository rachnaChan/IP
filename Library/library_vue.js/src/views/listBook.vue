<script>
// @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
import axios from "axios";
export default {
  data() {
    return {
      loopArray: ["30%", "40%", "50%", "60%", "70%"],
      backgroundImage: "1bg.jpg",
      books: [],
      searchQuery: "",
      searchResults: [],
      latest_book: [],
      categories: ["GIC", "AMS", "GIM", "GCA", "GEE", "GTR", "OAC", "GGG"],
      selectedCategory: null,
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
        .get(`http://localhost:8000/api/listallBook`)
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
        })
        .catch((error) => {
          console.error("Error fetching search results:", error);
        });
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
              <a :class="{ active: activeNavItem === 'books' }" href="">New Arrivals</a>
            </router-link>
          </li>

          <li>
            <router-link :to="{ name: 'event' }">
              <a :class="{ active: activeNavItem === 'events' }" href="">Events</a>
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
            <router-link :to="{ name: 'book' }"><a href="#" class="active">Book</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'about' }">
              <a :class="{ active: activeNavItem === 'about' }" href="">About</a>
            </router-link>
          </li>
          <li><a href="">Contact</a></li>
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

    <div class="flex justify-around m-auto mx-5">

      <div class="text-center mb-6">
        <label for="categorySelect" class="block text-gray-700 text-sm font-bold  py-4 fs-5">Select Gerne Below:</label>
        <div class="relative w-3/4 mx-auto">
          <select v-model="selectedCategory" @change="filterByCategory" id="categorySelect"
            class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="" disabled>choosing the gerne</option>
            <option v-for="category in categories" :key="category" :value="category">
              {{ category }}
            </option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4zM18 8a8 8 0 11-16 0 8 8 0 0116 0z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="book-category limitation">
        <h1 @click="resetCategory" class="cursor-pointer">BOOKS</h1>
        <div class="container mx-auto  w-90 m-auto">
          <div class="grid grid-cols-4 gap-5">
            <div v-for="(book, index) in getFilteredBooks" :key="index" class="bg-white rounded-lg p-3 shadow-md">

              <div class="img aspect-square bg-gray-200 z-40 rounded-md">
                <img :src="getBookImageURL(book)"
                  class="rounded-2xl mx-2 m-auto text-center mt-3 w-[200px] h-[200px] py-2" />
              </div>
              <p class="text-gray-600 mt-3">
                Author : <span class="text-gray-900">{{ book.author }}</span>
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
      </div>
    </div>


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
