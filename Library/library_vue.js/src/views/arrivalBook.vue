<script>
import axios from "axios";
export default {
  data() {
    return {
      books: [],
      latest_book: [],
      categories: ["GIC", "AMS", "GIM", "GCA", "GEE", "GTR", "OAC", "GGG"],
      selectedCategory: null,
    };
  },
  mounted() {
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
        .get(`http://localhost:8000/api/listarrivalBooks`)
        .then((response3) => {
          this.latest_book = response3.data;

          console.log(this.latest_book);
        })
        .catch((error) => {
          console.error("Error fetching Book:", error);
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
  },
};
</script>

<template>
  <div>
    <section id="header">
      <div>
        <ul id="navbar">
          <li><a class="active" href="#">New Arrivals</a></li>
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
            <router-link :to="{ name: 'book' }"><a href="#" class="">Book</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'about' }"><a href="#">About Us</a>
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

    <div>
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

      <div class="book-category limitation">
        <h1 @click="resetCategory" class="cursor-pointer">New Arrival Books</h1>
        <div class="container mx-auto py-6 w-90 m-auto">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
