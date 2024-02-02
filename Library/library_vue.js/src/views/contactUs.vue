<script>
// @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
import axios from "axios";
export default {
    data() {
        return {
            activeNavItem: null,
        };
    },
    methods: {
        openEmailClient() {
            const emailAddress = 'info@itc.edu.kh';
            window.location.href = 'mailto:' + emailAddress;
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
                        <router-link :to="{ name: 'about' }"><a href="#">About</a>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'contact' }"><a href="#" class="active">Contact</a>
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

        <section class="bg-gray-200">
            <div class="grid grid-cols-2 m-auto mx-5 py-5">
                <div class="p-6 mt-56">
                    <p class="fs-1 fw-bold">We'd Love to hear from You!</p>
                    <p class="fs-5">Whether you have a question, comment, or suggestion, we encourage you to reach out to
                        us. We look
                        forward to hearing from you.</p>
                </div>
                <div class="w-full mx-5">
                    <img src="../assets/Img/contact.jpg" alt="" class="h-[70vh]">
                </div>




                <div class="py-5 mx-5 ">
                    <p class="fs-4 fw-bold">Ask Our Experts</p>
                    <p class="fs-5">
                        Call the Library at +(855-12) 3 456 780, or send us a message through chat or email to get in touch
                        with a
                        staff member.
                    </p>
                    <p class="fs-5">
                        Whether you want a personalized book recommendation, need tech support, are looking for help with
                        schoolwork, or need information about current events, our experts can answer any questions you may
                        have or connect you to the appropriate community resource.

                    </p>
                    <p class="fs-5">Library Hotline staff are available Monday to Thursday from 9:00 am to 9:00 pm, Friday
                        from 9:00 am
                        to 6:00 pm, Saturday from 9:00 am to 5:00 pm, and Sunday from noon to 5:00 pm.
                    </p>

                </div>



                <div class=" py-5 ">

                    <div class="grid grid-cols-2 ">

                        <div class="mx-5">
                            <p class="fs-5 fw-bold">For inquires by mail, please contact:</p>
                            <p class="">Calgary Public Library Administration</p>
                            <p class="">Central Library, Level 4
                            </p>
                            <p class="">800 3 St SE
                            </p>
                            <p class="">Calgary, AB T2G 2E7</p>
                        </div>
                        <div class="mx-5 ">
                            <a href="tel:+855123456789" class="text-decoration-none text-black p-4">
                                <i class='bx bx-phone-call text-center fs-3 p-4 m-auto justify-center fw-bold'></i>
                                <p>+(855-12) 3 456 789</p>
                            </a>
                            <a href="" class="text-decoration-none text-black" @click.prevent="openEmailClient">
                                <p>info@itc.edu.kh</p>
                            </a>

                        </div>

                        <div class="mx-5 ">
                            <p class="fs-5 fw-bold">Follow Us:</p>

                            <div class="grid grid-cols-3 w-75">
                                <a href="https://itc.edu.kh/">
                                    <i class="bx bxs-webcam fs-3 text-center m-auto "></i>
                                </a>

                                <a href="https://www.facebook.com/itckh?mibextid=ZbWKwL">
                                    <i class="bx bxl-meta fs-3 text-center m-auto "></i>
                                </a>


                                <a href="https://weibo.com/u/6333691724">
                                    <i class="bx bxl-reddit fs-3 text-center m-auto "></i>
                                </a>

                            </div>
                        </div>

                        <div class="h-[240px] w-full ">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.3229660984145!2d104.8955108!3d11.5704027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109517388680e15%3A0x63057e6682968f5!2sInstitute%20of%20Technology%20of%20Cambodia!5e0!3m2!1sen!2sus"
                                width="100%" height="100%" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <section class="bg-[#ccdee0] h-24">

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
