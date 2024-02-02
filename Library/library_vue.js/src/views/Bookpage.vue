<script>
// @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
import axios from "axios";
export default {
  data() {
    return {
      loopArray: ["30%", "40%", "50%", "60%", "70%"],
      backgroundImage: "1bg.jpg",
      // books: [],
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
          this.latest_book = response3.data.slice(0, 8);

          console.log(this.latest_book);
        })
        .catch((error) => {
          console.error("Error fetching Book:", error);
        });
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
              <a class="" href="">New Arrivals</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'event' }">
              <a class="" href="">Events</a>
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

    <div class="cover-wrapper" :style="{ backgroundImage: `url(${backgroundImage})` }">
      <div class="w-75">
        <div class="search-item">
          <input type="text" v-model="searchQuery" placeholder="Search book by keyword ..." />
          <button @click="search">Search</button>
        </div>
      </div>

      <div class="book-wrapper limitation">
        <div class="wl">
          <div class="feature-category limitation">
            <h1 class="text-center mb-4">
              Explore Feature Categories
            </h1>

            <div class="text-center mb-6">
              <label for="categorySelect" class="block text-gray-700 text-sm font-bold mb-2">Select Category here:</label>
              <div class="relative">
                <select v-model="selectedCategory" @change="filterByCategory" id="categorySelect"
                  class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                  <option value="" disabled>Select a category</option>
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

            <!-- Display Filtered Categories -->
            <div class="list-category d-flex justify-content-around flex-wrap">
              <div v-for="category in filteredCategories" :key="category"
                :class="{ 'active-category': selectedCategory === category }" class="box-category text-center p-3 mb-3">
                <img :src="getCategoryImage(category)" alt="Category Image" class="category-image" />
                <h4 class="mt-2">{{ category }}</h4>
              </div>
            </div>
          </div>
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

    <div class="container mx-auto py-6 w-90 m-auto">
      <div class="grid grid-cols-5 gap-5">
        <div class="bg-white rounded-lg p-6 shadow-md" v-for="book in searchResults" :key="book.id">
          <p class="font-semibold text-center overflow-hidden m-auto fs-6 h-12">
            isbn : {{ book.isbn }}
          </p>

          <div class="img aspect-square bg-gray-200 z-40 rounded-md">
            <img :src="getBookImageURL(book)" class="rounded-2xl mx-2 m-auto text-center mt-3 w-[200px] h-[200px] py-2" />
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

    <div>
      <div class="book-category">
        <h1 @click="resetCategory" class="text-center m-auto cursor-pointer">
          BOOKS
        </h1>
        <div class="container mx-auto p-3 w-90 m-auto">
          <div class="grid grid-cols-5 gap-5">
            <div v-for="(book, index) in getFilteredBooks" :key="index" class="bg-white rounded-lg p-6 shadow-md">
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
            <router-link :to="{ name: 'book_all' }" class="mt-5 bg-gray-200 m-auto">
              <button>View more</button>
            </router-link>
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

<style>
.cover-wrapper {
  display: flex;
  flex-direction: column;

  padding: 20px;
  width: 100%;
  height: calc(50vh + 80px);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  align-items: center;
}

.cover-wrapper .search-wrapper {
  width: 100%;
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.cover-wrapper .search-item {
  background: #fff;
  width: 75%;
  height: 44px;
  border-radius: 25px;
  display: flex;
  align-items: center;
  padding: 0 25px;
  justify-content: space-between;
  gap: 5px;
}

.cover-wrapper .search-item input {
  outline: none;
  font-size: 16px;
  flex-grow: 1;
}

.cover-wrapper .search-item button {
  border: none;
  background: #ccdee0;
  padding: 0 px;
  height: 36px;
  color: #1f1f1f;
  border-radius: 10px;
  font-weight: 600;
}

.cover-wrapper .book-wrapper {
  width: 100%;
  flex: 3;
  display: flex;
  margin-bottom: 10px;
}

.cover-wrapper .book-wrapper .wl {
  flex: 1;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 10px;
}

.cover-wrapper .book-wrapper .wl h1 {
  font-size: 32px;
  color: #3d6a70;
}

.cover-wrapper .book-wrapper .wl button {
  border: none;
  background: #9cc9d7;
  color: #4a787f;
  font-size: 20px;
  padding: 8px 40px;
  border-radius: 10px;
  margin-top: 25px;
}

.cover-wrapper .book-wrapper .wr {
  flex: 1;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.cover-wrapper .book-wrapper .wr img {
  aspect-ratio: 9/16;
  max-width: 120px;
  position: absolute;
  z-index: 0;
  box-shadow: -2px 5px 33px 6px rgba(0, 0, 0, 0.35);
}

.cover-wrapper .book-wrapper .wr .book-1 {
  left: 30%;
  transform: translateX(-50%);
  transition: 0.5s ease;
}

.cover-wrapper .book-wrapper .wr .book-2 {
  left: 40%;
  transform: translateX(-50%) scale(1.1);
  transition: 0.5s ease;
}

.cover-wrapper .book-wrapper .wr .book-3 {
  left: 50%;
  transform: translateX(-50%) scale(1.3) translateY(-2%);
  z-index: 2;
  transition: 0.5s ease;
}

.cover-wrapper .book-wrapper .wr .book-4 {
  left: 60%;
  transform: translateX(-50%) scale(1.1);
  z-index: 1;
  transition: 0.5s ease;
}

.cover-wrapper .book-wrapper .wr .book-5 {
  left: 70%;
  transform: translateX(-50%);
  transition: 0.5s ease;
}

.cover-wrapper .dot-wrapper {
  display: flex;
  align-items: center;
  gap: 5px;
}

.cover-wrapper .dot-wrapper div {
  width: 5px;
  height: 5px;
  border-radius: 50%;
  background: black;
  box-shadow: -2px 5px 33px 6px rgba(0, 0, 0, 0.1);
  transform: 0.5s ease;
}

.cover-wrapper .dot-wrapper div.active {
  background: #fff;
}

.feature-category {
  padding: 40px 80px;
}

.feature-category h1 {
  font-size: 26px;
  color: #3d6a70;
  margin-bottom: 18px;
}

.feature-category .list-category {
  display: flex;
  justify-content: space-between;
}

.feature-category .list-category .box-category {
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: center;
  justify-content: center;
  padding: 20px 50px;
  background: #ccdee0;
  min-width: 280px;
  transition: 0.5s;
  cursor: pointer;
  user-select: none;
}

.feature-category .list-category .box-category:hover {
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px,
    rgb(51, 51, 51) 0px 0px 0px 3px inset;
}



.feature-category .list-category .box-category img {
  width: 100%;
  max-height: 100px;
  object-fit: contain;
}

.feature-category .list-category .box-category h4 {
  font-size: 22px;
  color: #406d73;
}

.book-category {
  padding: 20px 80px 80px 80px;
}

.book-category h1 {
  font-size: 26px;
  color: #fff;
  margin-bottom: 65px;
  background-color: #3d6a70;
  width: fit-content;
  padding: 2px 20px;
  border-top-right-radius: 25px;
  border-bottom-right-radius: 25px;
}

.book-category .book-container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  gap: 20px;
  row-gap: 40px;
}

.book-category .book-container .book-card {
  display: flex;
  align-items: center;
  justify-content: center;
}

.book-category .book-container .book-card .book {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  max-width: 200px;
}

.book-category .book-container .book-card .book img {
  margin-bottom: 20px;
  aspect-ratio: 9/16;
  cursor: pointer;
}

.book-category .book-container .book-card .book h6 {
  font-size: 16px;
  font-weight: 500;
  color: #334d53;
  cursor: pointer;
  text-align: center;
}

.book-category .book-container .book-card .book h6:hover {
  text-decoration: underline;
}

.book-category .button {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 40px;
}

.book-category button {
  border: none;
  background: #61a7b1;
  padding: 5px 28px;
  color: #ffffff;
  border-radius: 10px;
  font-weight: 600;
  align-self: center;
}

.book-category button:hover {
  background: #3d6a70;
}

@media (max-width: 1300px) {
  .cover-wrapper .search-item {
    width: 100%;
  }

  .cover-wrapper .book-wrapper .wr img {
    max-width: 100px;
  }

  .cover-wrapper .search-item {
    padding: 0 20px;
  }

  .feature-category {
    padding: 20px 40px;
  }

  .feature-category .list-category {
    justify-content: start;
    gap: 20px;
  }

  .feature-category .list-category .box-category {
    width: 140px;
    min-width: auto;
    justify-content: space-between !important;
  }

  .book-category {
    padding: 40px 40px 80px 40px;
  }

  .book-category h1 {
    margin-bottom: 40px;
  }

  .book-category .book-container .book-card .book img {
    margin-bottom: 10px;
  }
}

@media (max-width: 1000px) {
  .book-category .book-container {
    grid-template-columns: 1fr 1fr 1fr;
  }
}

@media (max-width: 830px) {
  .feature-category .list-category {
    flex-wrap: wrap;
  }

  .feature-category .list-category .box-category {
    width: 120px;
    padding: 20px 40px;
  }

  .feature-category .list-category .box-category h4 {
    font-size: 16px;
  }

  .book-category .book-container {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 550px) {
  .feature-category {
    padding: 10px 20px;
  }

  .feature-category .list-category {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

  .feature-category .list-category .box-category {
    width: auto !important;
    min-width: auto !important;
  }

  .book-category {
    padding: 20px 20px 60px 20px;
  }

  .book-category .book-container {
    grid-template-columns: 1fr;
  }

  .cover-wrapper .book-wrapper .wr>* {
    max-width: 90px !important;
  }
}
</style>
