<script>
import axios from "axios";

export default {
  data() {
    return {
      user: null,
      books: null,
      title: "",
      author: "",
      release_year: "",
      description: "",
      image: "",
      isbn: "",
      categories_type: "",
      file: "",
      activeNavItem: null,
      filename: null,
      bookId: null,
      file_path: null,
      fileURL: "",
      activeNavItem: null,
      searchQuery: "",
      searchResults: [],
      latest_book: [],
      booksPerPage: 5,
      currentPage: 1,
      errormessage: "",
      id: "",
      selectedBook: null,
    };
  },

  mounted() {
    this.fetchLoggedInUser();
    this.fetchBook();
    // this.updateBook();
  },

  computed: {
    DisplayBook() {
      // return this.searchQuery ? this.searchResults : this.latest_book;

      const booksToDisplay = this.searchQuery
        ? this.searchResults
        : this.latest_book;
      const startIndex = (this.currentPage - 1) * this.booksPerPage;
      return booksToDisplay.slice(startIndex, startIndex + this.booksPerPage);
    },

    totalPages() {
      const totalBooks = this.searchQuery
        ? this.searchResults.length
        : this.latest_book.length;
      return Math.ceil(totalBooks / this.booksPerPage);
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

    setBookId(bookId) {
      this.bookId = bookId;
    },

    onFileChange(event) {
      this.file = event.target.files[0];
    },

    onImageChange(event) {
      this.image = event.target.files[0];
    },

    fetchBook() {
      axios
        .get(`http://localhost:8000/api/listallBook`)
        .then((response3) => {
          this.latest_book = response3.data.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));

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
          if (response.data.length > 0) {
            this.searchResults = response.data;
            this.currentPage = 1;
          } else {
            this.errormessage =
              "No results found for book of : " + this.searchQuery;
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

    uploadBook() {
      let formData = new FormData();

      formData.append("file", this.file);
      formData.append("image", this.image);
      formData.append("isbn", this.isbn);
      formData.append("title", this.title);
      formData.append("author", this.author);
      formData.append("release_year", this.release_year);
      formData.append("description", this.description);
      formData.append("categories_type", this.categories_type);

      axios
        .post("http://localhost:8000/api/admin/uploadBook", formData)
        .then((response) => {
          // Handle success
          console.log(response.data.message);
          this.$router.go(0);
        })
        .catch((error) => {
          // Handle error
          alert(error.response.data.message);
        });
    },

    async deleteBook(bookId) {
      try {
        await axios.delete(
          `http://localhost:8000/api/admin/deleteBook/${bookId}`
        );
        this.$router.go(0);
      } catch (error) {
        console.error("Error deleting Book:", error);
      }
    },

    filterBooks(categories_type) {
      this.selectedFileType = categories_type; // Set the selected file type
    },

    viewBookDetails(index) {
      this.selectedBook = this.latest_book[index];
    },

    handleUpdateClick(book) {
      // Set the form fields based on the selected book
      this.title = book.title;
      this.author = book.author;
      this.isbn = book.isbn;
      this.release_year = book.release_year;
      this.description = book.description;
      this.image = book.image;
      this.categories_type = book.categories_type;
      this.selectedBook = book;
    },
    updateBook() {
      const bookInfo = {
        title: this.title,
        author: this.author,
        isbn: this.isbn,
        release_year: this.release_year,
        description: this.description,
        categories_type: this.categories_type,
      };

      const formData = new FormData();
      Object.entries(bookInfo).forEach(([key, value]) => {
        // Append only if the value is not null or undefined
        if (value !== null && value !== undefined) {
          formData.append(key, value);
        }
      });
      if (this.file && this.file !== this.selectedBook.file) {
        formData.append("file", this.file);
      }
      if (this.image && this.image !== this.selectedBook.image) {
        formData.append("image", this.image);
      }
      console.log("Updating book with ID:", this.selectedBook.id);
      console.log("Data being sent to server:", formData);

      axios
        .post(
          `http://localhost:8000/api/admin/updateBook/${this.selectedBook.id}`,
          formData
        )
        .then((response) => {
          console.log("Update successful:", response.data);

          this.$emit("updateBook", this.selectedBook.id);
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
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold bg-[#c5ede0] border-black">
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
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold border-black">
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
                  placeholder="Search Books by title, author, isbn" required />
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

        <div class="main-contentflex flex-col flex-grow p-1">
          <div class="flex justify-between">
   

            <div class="text-right mx-5 mt-2">
              <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <i class="bx bx-add-to-queue text-[#243673] fs-2"></i>
                <p>Upload Book</p>
              </button>

              <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form @submit.prevent="uploadBook">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100" id="exampleModalLabel">
                          Upload your Book
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
                                  <input id="username" name="username" type="text" v-model="author"
                                    class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Author</label>
                                </div>
                              </div>
                            </div>

                            <div class="flex m-auto justify-around mt-3">
                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="number" v-model="release_year"
                                    class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Release
                                    Year</label>
                                </div>
                              </div>

                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="text" v-model="isbn"
                                    class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Isbn</label>
                                </div>
                              </div>
                            </div>

                            <div class="flex m-auto justify-around mt-3">
                              <div class="flex items-center justify-center w-50">
                                <div class="relative">
                                  <input id="username" name="username" type="text" v-model="description"
                                    class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                  <label for="username"
                                    class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Description</label>
                                </div>
                              </div>

                              <div class="editInput lead position-relative m-auto w-50 mb-4">
                                <label for="fileGenre" class="lead fw-bold text-[#243673]">Book's Genre</label>
                                <select v-model="categories_type" id="fileGenre"
                                  class="custom-select lead fs-5 p-2 border-0 border-bottom w-100 bg-transparent">
                                  <option value="null">
                                    Select a genre...
                                  </option>
                                  <option value="GIC">GIC</option>
                                  <option value="AMS">AMS</option>
                                  <option value="GIM">GIM</option>
                                  <option value="GCA">GCA</option>
                                  <option value="GEE">GEE</option>
                                  <option value="GTR">GTR</option>
                                  <option value="OAC">OAC</option>
                                  <option value="GGG">GGG</option>
                                </select>
                              </div>
                            </div>

                            <div class="flex justify-around m-auto">
                              <label for="file-input"
                                class="h-auto dashboard_textBox m-auto py-3 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted">
                                <p class="fs-6 text-center mx-5">
                                  <span class="lead fw-bold text-decoration-underline">Noted</span>&ensp; : Accept only
                                  File PDF
                                </p>

                                <span class="lead drop-title text-muted fs-5 text-center">Drop file here</span>
                                or
                                <input type="file" class="m-auto" multiple @change="onFileChange" />
                              </label>

                              <div class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto py-4">
                                <span class="lead text-dark fs-5 fw-bold">Select your Book picture</span>
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
                              ISBN
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm text-left rtl:text-right">
                              Title
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm text-left rtl:text-right">
                              Release Year
                            </th>

                            <th scope="col ">
                              <span class="mx-5 px-4 py-3.5 text-sm text-left rtl:text-right">Actions</span>
                            </th>

                            <th scope="col ">
                              <span class="px-4 py-3.5 text-sm text-left rtl:text-right">View Detail</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody v-for="(book, index) in DisplayBook" :key="book.id"
                          class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                          <tr>
                            <td
                              class="px-4 py-2 text-sm fw-bold font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                              <div class="inline-flex items-center gap-x-3">
                                {{ index + 1 }}
                              </div>
                            </td>
                            <td class="px-4 py-2 text-sm dark:text-gray-300 whitespace-nowrap">
                              {{ book.isbn }}
                            </td>
                            <td class="px-4 py-2 text-sm dark:text-gray-300 whitespace-nowrap">
                              {{ book.title }}
                            </td>

                            <td class="px-4 py-2 text-sm dark:text-gray-300 whitespace-nowrap">
                              {{ book.release_year }}
                            </td>

                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                              <div class="flex items-center gap-x-6">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate"
                                  @click="handleUpdateClick(book)"
                                  class="fs-6 fw-bold transition-colors duration-200 dark:hover:text-success dark:text-gray-300 hover:text-green-700 focus:outline-none">
                                  <i class="bx bx-edit text-success fs-5"></i>
                                  <span class="mx-1">Edit</span>
                                </button>

                                <div class="modal fade" id="exampleModalUpdate" tabindex="-1"
                                  aria-labelledby="exampleModalLabel" aria-hidden="true" v-if="selectedBook">
                                  <form @submit.prevent="updateBook">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100"
                                            id="exampleModalLabel">
                                            Update your Book
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
                                                    <input id="username" name="username" type="text" v-model="author"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Author</label>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="flex m-auto justify-around mt-3">
                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="number"
                                                      v-model="release_year"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Release
                                                      Year</label>
                                                  </div>
                                                </div>

                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="text" v-model="isbn"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Isbn</label>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="flex m-auto justify-around mt-3">
                                                <div class="flex items-center justify-center w-50">
                                                  <div class="relative">
                                                    <input id="username" name="username" type="text" v-model="description"
                                                      class="border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" />
                                                    <label for="username"
                                                      class="absolute left-0 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 fw-bold text-[#243673]">Description</label>
                                                  </div>
                                                </div>

                                                <div class="editInput lead position-relative m-auto w-50 mb-4">
                                                  <label for="fileGenre" class="lead fw-bold text-[#243673]">Book's
                                                    Genre</label>
                                                  <select v-model="categories_type" id="fileGenre"
                                                    class="custom-select lead fs-5 p-2 border-0 border-bottom w-100 bg-transparent">
                                                    <option value="null">
                                                      Select a genre...
                                                    </option>
                                                    <option value="GIC">
                                                      GIC
                                                    </option>
                                                    <option value="AMS">
                                                      AMS
                                                    </option>
                                                    <option value="GIM">
                                                      GIM
                                                    </option>
                                                    <option value="GCA">
                                                      GCA
                                                    </option>
                                                    <option value="GEE">
                                                      GEE
                                                    </option>
                                                    <option value="GTR">
                                                      GTR
                                                    </option>
                                                    <option value="OAC">
                                                      OAC
                                                    </option>
                                                    <option value="GGG">
                                                      GGG
                                                    </option>
                                                  </select>
                                                </div>
                                              </div>

                                              <div class="flex justify-around m-auto">
                                                <label for="file-input"
                                                  class="h-auto dashboard_textBox m-auto py-3 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted">
                                                  <p class="fs-6 text-center mx-5">
                                                    <span
                                                      class="lead fw-bold text-decoration-underline">Noted</span>&ensp; :
                                                    Accept only File
                                                    PDF
                                                  </p>

                                                  <span class="lead drop-title text-muted fs-5 text-center">Drop file
                                                    here</span>
                                                  or
                                                  <input type="file" class="m-auto" multiple @change="onFileChange" />
                                                </label>

                                                <div
                                                  class="formUploadImg bg-white rounded-4 text-center fs-6 border-0 m-auto py-4">
                                                  <span class="lead text-dark fs-5 fw-bold">Select your Book
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

                                <button @click="deleteBook(book.id)"
                                  class="fs-6 fw-bold transition-colors duration-200 hover:text-red-700 focus:outline-none">
                                  <i class="bx bx-trash text-danger fs-5"></i>
                                  <span class="mx-1">Delete</span>
                                </button>
                              </div>
                            </td>

                            <td
                              class="px-4 py-2 text-sm fw-bold cursor-pointer text-gray-500 dark:text-gray-300 whitespace-nowrap"
                              data-bs-toggle="modal" data-bs-target="#exampleModal3" @click="viewBookDetails(index)">
                              <i class="bx bx-file-find fs-4 text-secondary mx-4"></i>
                            </td>

                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100"
                                      id="exampleModalLabel">
                                      Book Detail
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                      @click="this.$router.go(0)"></button>
                                  </div>
                                  <div class="modal-body" v-if="selectedBook">
                                    <div class="flex justify-around items-center">
                                      <div class="book-card flex justify-between">
                                        <img :src="getBookImageURL(selectedBook)"
                                          class="book-cover w-[300px] h-[300px] img-fluid" alt="Book Cover" />
                                        <div class="book-info mx-4">
                                          <h2 class="text-xl font-semibold">
                                            Title : {{ selectedBook.title }}
                                          </h2>
                                          <p class="text-gray-600">
                                            Author : {{ selectedBook.author }}
                                          </p>
                                          <p class="text-gray-800">
                                            {{ selectedBook.description }}
                                          </p>
                                          <p class="text-gray-700">
                                            Genre:
                                            {{ selectedBook.categories_type }}
                                          </p>
                                          <p class="text-gray-700">
                                            Publication Year:
                                            {{ selectedBook.release_year }}
                                          </p>
                                          <p class="text-gray-700">
                                            File name:
                                            {{ selectedBook.file_name }}
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
