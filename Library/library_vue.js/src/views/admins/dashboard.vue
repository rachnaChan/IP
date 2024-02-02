<script>
import axios from "axios";
import VueApexCharts from "vue3-apexcharts";

export default {
  components: {
    apexchart: VueApexCharts,
  },

  data() {
    return {
      user: null,
      currentDateTime: null,
      activeNavItem: null,
      latest_book: [],
      searchQuery: "",
      searchResults: [],
      booksPerPage: 5,
      currentPage: 1,
      errormessage: "",
      events: [],
      users: [],
      showModal: false,

      chartOptions: {
        labels: [],
        colors: ['#618264', '#79AC78', '#B0D9B1', '#D0E7D2', '#618264'],
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200,
              },
              legend: {
                position: "bottom",
              },
            },
          },
        ],
      },
      chartData: [],

      barOptions: {
        title: {
          text: "Books Created by Month",
          align: 'center',
          margin: 10,
          offsetX: 0,
          offsetY: 0,
          floating: false,
          style: {
            fontSize: '18px',
            fontWeight: 'bold',
            color: '#444',
          },
        },
        subtitle: {
          text: `Total books created in the last two months and the current month: `,
          align: 'center',
          margin: 10,
          offsetX: 0,
          offsetY: 35,
          floating: false,
          style: {
            fontSize: '14px',
            color: '#888',
          },
        },
        xaxis: {
          categories: [],
        },

        plotOptions: {
          bar: {
            barWidth: '50%', // Adjust the width as needed
          },
        },
        colors: ['#618264', '#B0D9B1', '#618264'],
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 800,
              },

            },
          },
        ],
      },


      barData: [

      ],



    };
  },

  mounted() {
    this.fetchLoggedInUser();
    this.fetchBook();
    this.fetchEvent();
    this.fetchUsers();

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

    async fetchBook() {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/listallBook`
        );
        this.latest_book = response.data;

        // Process data for doughnut chart
        const categoriesCount = {};
        this.latest_book.forEach((book) => {
          const category = book.categories_type;
          categoriesCount[category] = (categoriesCount[category] || 0) + 1;
        });

        const chartLabels = Object.keys(categoriesCount);
        const chartData = Object.values(categoriesCount);

        this.updateDoughnutChart(chartLabels, chartData);

        // Process data for bar chart
        const currentDate = new Date();
        const threeMonthsAgo = new Date();
        threeMonthsAgo.setMonth(currentDate.getMonth() - 2);

        const booksCreatedLastThreeMonths = this.latest_book.filter((book) => {
          const bookDate = new Date(book.created_at);
          return bookDate >= threeMonthsAgo && bookDate <= currentDate;
        });

        const monthsCount = {};
        booksCreatedLastThreeMonths.forEach((book) => {
          const date = new Date(book.created_at);
          const monthYear = `${date.toLocaleString('default', { month: 'short' })} ${date.getFullYear()}`;
          monthsCount[monthYear] = (monthsCount[monthYear] || 0) + 1;
        });

        // Set the chart options and data
        const categories = Object.keys(monthsCount);
        const data = Object.values(monthsCount);

        this.barOptions.xaxis.categories = categories;
        this.barData = categories.map((monthYear) => ({
          name: `Books created in ${monthYear}`,
          data: [monthsCount[monthYear]],
        }));

        // Log the barData
        console.log(this.barData);

        // Update the bar chart
        this.updateBarChart(categories, data);


      } catch (error) {
        console.error("Error fetching Book:", error);
      }
    },

    updateDoughnutChart(labels, data) {
      this.chartOptions = {
        series: data,
        labels: labels,
      };
    },

    updateBarChart(labels1, data1) {
      this.barOptions = {
        series: data1,
        labels: labels1,
      };
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

    closeModal() {
      // Close the modal
      this.showModal = false;
    },


    async fetchEvent() {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/admin/get_event"
        ); // Change this URL if needed
        this.events = response.data;
      } catch (error) {
        console.error("Error fetching user:", error);
      }
    },



    async fetchUsers() {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/admin/get_user"
        );
        this.users = response.data.users;
      } catch (error) {
        console.error("Error fetching user:", error);
      }
    },


  },
};
</script>

<template>
  <div>
    <div class="flex flex-row min-h-screen  text-gray-800">
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
                  class="text-decoration-none flex flex-row items-center h-10 px-3 rounded-lg text-black fw-bold bg-[#c5ede0] border-black">
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

        <div class="main-content flex flex-col flex-grow p-1">


          <div class="grid grid-cols-3 w-75 m-auto gap-5 mt-2">

            <div class=" w-100 m-auto rounded-lg p-6  bg-gray-100">
              <div class="w-100 m-auto">
                <div
                  class=" flex justify-center shadow-md bg-gray-100 text-center h-16 px-4 rounded-lg transform transition duration-500 hover:scale-110">
                  <i class="bx bx-book-content fs-2 p-3 gap-4"></i>

                  <div class="flex mx-4 p-3 gap-3 ">
                    <p class="title-font font-medium text-2xl text-gray-900">
                      {{ latest_book.length }}
                    </p>
                    <p class="title-font font-medium text-2xl">Book(s)</p>
                  </div>
                </div>
              </div>
            </div>
            <div class=" w-100 m-auto rounded-lg p-6  bg-gray-100">
              <div class="w-100 m-auto">
                <div
                  class=" flex justify-center shadow-md bg-gray-100 text-center h-16 px-4 rounded-lg transform transition duration-500 hover:scale-110">
                  <i class="bx bx-calendar-event fs-2 p-3 gap-4"></i>

                  <div class="flex mx-4 p-3 gap-3 ">
                    <p class="title-font font-medium text-2xl text-gray-900">
                      {{ events.length }}
                    </p>
                    <p class="title-font font-medium text-2xl">Event(s)</p>
                  </div>
                </div>
              </div>
            </div>


            <div class=" w-100 m-auto rounded-lg p-6 shadow-sm bg-gray-100">
              <div class="w-100 m-auto">
                <div
                  class="flex justify-center text-center h-16 shadow-md bg-gray-100 border-gray-600 px-4 rounded-lg transform transition duration-500 hover:scale-110">
                  <i class='bx bx-user fs-2 gap-4 p-3'></i>
                  <div class="flex mx-4 p-3 gap-3">
                    <p class="title-font font-medium text-2xl text-gray-900">
                      {{ users.length }}
                    </p>
                    <p class="title-font font-medium text-2xl">Staff(s)</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container mx-auto px-4 py-8 max-w-md ">
            <div class="grid grid-cols-2 gap-6">

              <div class=" rounded-lg p-6 bg-white ">

                <apexchart type="bar" height="300" :options="barOptions" :series="barData"></apexchart>
              </div>
              <div class=" rounded-lg p-6 bg-[#edf9f5] ">
                <h2 class="text-xl mb-5 text-center fw-bold fs-4">
                  Percentage of Categories Books
                </h2>

                <apexchart type="donut" height="300" :options="chartOptions" :series="chartData"></apexchart>
              </div>
            </div>
          </div>

          <div
            class="fixed w-75 justify-center items-center mx-5  z-50 mt-5 shadow-md m-auto bg-opacity-50 overflow-y-auto max-h-[80vh] scrollbar-hidden "
            v-if="showModal">


            <div v-if="searchResults.length === 0" class="bg-white rounded-lg p-6 shadow-md text-center ">
              <p>No book was found.</p>
            </div>
            <div v-else class=" rounded-lg p-6 shadow-sm bg-white h-[60vh]">
              <div class="flex justify-between">
                <h2 class="text-xl mb-2 mx-5 text-center fw-bold fs-4">
                  Books List
                </h2>
                <div class="flex justify-end ">
                  <button @click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              </div>

              <div>
                <section class="container px-2 mx-auto">
                  <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-3 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-[#768e86] dark:bg-gray-800">
                              <tr class="text-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <th scope="col" class="px-2 py-2 text-sm text-left rtl:text-right">
                                  ISBN
                                </th>

                                <th scope="col" class="px-2 py-2 text-sm text-left rtl:text-right">
                                  Title
                                </th>

                                <th scope="col" class="px-2 py-2 text-sm text-left rtl:text-right">
                                  Author
                                </th>


                              </tr>
                            </thead>

                            <tbody v-for="(book, index) in DisplayBook" :key="index"
                              class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                              <tr>
                                <td class="px-2 py-2 text-sm text-gray-500 dark:text-gray-300 ">
                                  {{ book.isbn }}
                                </td>
                                <td class="px-2 py-2 text-sm  text-gray-700 ">
                                  {{ book.title }}
                                </td>
                                <td class="px-2 py-2 text-sm text-gray-500 dark:text-gray-300 ">
                                  <div class="flex items-center gap-x-2">
                                    {{ book.author }}
                                  </div>
                                </td>

                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="flex items-center justify-between mt-6 mb-4">
                    <a href="#" @click.prevent="prevPage"
                      class="flex items-center px-5 py-2 text-sm capitalize transition-colors duration-200 bg-[#768e86] text-white text-decoration-none fs-4 border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                      </svg>

                      <span> previous </span>
                    </a>

                    <div class="items-center hidden md:flex gap-x-3">
                      <a href="#" v-for="page in totalPages" :key="page" class="px-2 py-1 text-sm" :class="{
                        'text-secondary fw-bold fs-3': currentPage === page,
                        'text-secondary': currentPage !== page,
                      }" @click.prevent="goToPage(page)">
                        {{ page }}
                      </a>
                    </div>

                    <a href="#" @click.prevent="nextPage"
                      class="flex items-center px-5 py-2 text-sm bg-[#768e86] text-white text-decoration-none fs-4 capitalize transition-colors duration-200 border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                      <span>Next</span>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                      </svg>
                    </a>
                  </div>

                  <div v-if="errormessage" class="lead m-auto text-center fs-6 bg-[#a4c7da] w-75 rounded-5  py-2">
                    {{ errormessage }} &#128142;
                    <button type="button" class="btn-close" @click="$router.go(0)"></button>
                  </div>
                </section>
              </div>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>
</template>
