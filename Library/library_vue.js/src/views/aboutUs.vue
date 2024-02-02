<script>
// @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
import axios from "axios";
export default {
    data() {
        return {
            users: [],
            activeNavItem: null,
        };
    },
    mounted() {
        this.fetchStaff();
    },

    methods: {

        async fetchStaff() {
            try {
                const response = await axios.get(
                    "http://localhost:8000/api/get_user"
                );
                this.users = response.data.users;
            } catch (error) {
                console.error("Error fetching user:", error);
            }
        },

        getUserImageURL(users) {
            if (users.image) {
                const imageUrl = `http://localhost:8000/storage/${users.image}`;
                // console.log('Image URL:', imageUrl); // Log the image URL
                return imageUrl;
            } else if (users.image == null) {
                const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
                // console.log(imageAuto);
                return imageAuto;
            }
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
                            <a href="">Events</a>
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
                        <router-link :to="{ name: 'about' }"><a href="#" class="active">About</a>
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


        <section id="aboutlist" class="flex flex-col lg:flex-row justify-around m-auto py-5 h-auto">
            <div class="shadow-md lg:w-1/2 mx-5">
                <p class="text-[#3d6a70] fw-bold text-start mx-5 text-2xl">About Us</p>
                <p class="m-auto lg:w-3/4 text-2xl text-start mx-5 fw-bold py-2">
                    Digital Pages: The Evolution of Library Websites
                </p>

                <p class="w-90 m-auto mx-5 text-start text-xl justify-between text-transition">
                    This is a multi-disciplinary library serving the faculty, students, researchers, and staff of the
                    university. It also offers external membership services for corporate organizations, institutions,
                    individual executives, and researchers with certain conditions.

                    The library has a rich and diverse collection of materials, especially in terms of breadth and depth of
                    coverage. The collection is ideally suited to encourage and support both scholarly pursuits and
                    practical research activities.
                </p>
            </div>

            <div class="lg:w-1/2 m-auto">
                <div class="w-full lg:w-3/4 m-auto mt-2">
                    <img src="../assets/Img/about.jpg" alt=""
                        class="rounded-5 shadow-lg w-[100vh] h-[60vh] object-cover p-2" />
                </div>

            </div>
        </section>


        <section class="flex flex-col lg:flex-row justify-around m-auto py-5 h-auto mx-5">
            <div>
                <p class="text-[#3d6a70] text-start mx-5 fw-bold text-2xl">Our Staff</p>

                <div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-700" v-for="user in users" :key="user.id">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 flex ">
                                    <div>
                                        <img :src="getUserImageURL(user)" :alt="user.image" class="rounded-3 img-fluid mx-2"
                                            style="width: 100px; height: 100px" />
                                    </div>

                                    <div>
                                        <p class="mt-2">{{ user.gender === 'female' ? 'Ms' : 'Mr' }}. {{ user.first_name }}
                                            {{ user.last_name }}</p>
                                        <p>{{ user.role_user.role_name }}</p>
                                    </div>

                                </th>
                                <td class="px-6 py-4">
                                    <p>{{ user.email }}</p>
                                    <p>{{ user.phone_number }}</p>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="lg:w-1/2 m-auto mt-4">
                <p class="text-xl m-auto text-start">
                    &ensp; The library has established its reputation in the country by providing excellent services and
                    facilities to fulfill the information needs of its clients. It uses state-of-the-art technology and
                    systems. The library has an extensive collection of over 292,000 printed and 220,000+ online books,
                    45,000 journals, and 3200 other materials, including audio, videos, CD-ROMs, DVDs, etc. The library is
                    manned by qualified and experienced professionals, all dedicated to providing high-quality, innovative
                    services.
                </p>
                <p class="text-xl m-auto text-start mt-2">
                    &ensp; Our mission is to excel in supporting the academic and scholarly endeavors of our users, in their
                    core instructional and research requirements by utilizing the best possible resources, systems, and
                    services.
                </p>

                <div
                    class="flex flex-col gap-1 ml-[500px] justify-center items-start w-[280px] bg-white dark:bg-transparent px-4 py-4 shadow-sm rounded-lg">
                    <p class="font-semibold text-xl text-gray-600 mb-2">See more</p>
                    <div class="flex flex-wrap gap-2">
                        <router-link :to="{ name: 'book_all' }" class="text-decoration-none">
                            <p
                                class="px-3 py-1 text-[12px] bg-[#d9dfe3] max-w-max rounded font-semibold text-[#7281a3] hover:bg-[#c5ede0]">
                                #books
                            </p>
                        </router-link>

                        <router-link :to="{ name: 'contact' }" class="text-decoration-none">
                            <p class="px-3 py-1 text-[12px] bg-[#d9dfe3] max-w-max rounded font-semibold text-[#7281a3]">
                                #contact
                            </p>
                        </router-link>

                        <router-link :to="{ name: 'event' }" class="text-decoration-none">
                            <p class="px-3 py-1 text-[12px] bg-[#d9dfe3] max-w-max rounded font-semibold text-[#7281a3]">
                                #events
                            </p>
                        </router-link>
                    </div>
                </div>

            </div>
        </section>

        <section class="bg-[#ccdee0] h-24 mt-5">

            <div class="px-4 py-6 flex justify-between ">

                <div class="mt-2">
                    <div class="text-lg sm:text-center ">© {{ currentYear }}<a
                            href="https://www.facebook.com/itckh?mibextid=ZbWKwL" class=" text-decoration-none"> &ensp;
                            Library Website</a>. All Rights Reserved.
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
