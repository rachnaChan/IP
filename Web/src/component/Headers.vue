<template>
    <nav>
        <main class="d-flex justify-content-between m-auto align-items-center">
            <div class="section1">
                <img src="../assets/Img/a.png" alt="logo">
            </div>
            <div class="section2">
                <RouterLink :to="{ name: 'home' }"> Home</RouterLink>
                <RouterLink :to="{ name: 'about' }">About</RouterLink>
                <RouterLink :to="{ name: 'menu' }">Shop</RouterLink>
            </div>
            <div class="section3">

                <div class="input-container">
                    <input type="text" name="text" class="input" placeholder="search...">
                    <span class="icon">
                        <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2"
                                    stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </span>
                </div>
                <!-- <div class="search d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </div> -->
                <div class="cart d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <p class=" font-weight-light">cart</p>
                </div>
            </div>
        </main>

    </nav>
</template>
<script setup>
import { RouterLink } from 'vue-router'
</script>

<style lang="scss" scoped>
* {
    box-sizing: border-box;
}

nav {
    width: 100%;
    // background: linear-gradient(to right, aliceblue, rgb(234, 206, 211), aliceblue, rgb(234, 206, 211), aliceblue);
    padding: 1rem 2rem;
    height: 100px;

    main {
        width: 90%;

        .section1 {
            img {
                width: 14rem;
                height: 80px;
                margin-left: 10%;
                // background: transparent;
            }
        }

        .section2 {
            display: flex;
            gap: 2.4rem;
            font-family: 'Dosis';
            font-size: 64px;

            a {
                font-size: 2rem;
                text-decoration: none;
                color: black;

                &.router-link-exact-active {
                    color: gray;
                    // text-decoration: underline;
                }
            }
        }

        .section3 {
            display: flex;
            align-items: center;
            gap: 2rem;
            --size: 42px;

            .search {
                // display: flex;
                // align-items: center;

                svg {
                    width: var(--size);
                    height: var(--size);
                }
            }

            .cart {

                gap: 2rem;
                font-family: 'Dosis', sans-serif;
                font-size: 48px;

                svg {
                    width: var(--size);
                    height: var(--size);
                }
            }
        }

        .input-container {
            width: 220px;
            position: relative;
        }

        .icon {
            position: absolute;
            right: 10px;
            top: calc(50% + 5px);
            transform: translateY(calc(-50% - 5px));
        }

        .input {
            width: 100%;
            height: 40px;
            padding: 10px;
            transition: .2s linear;
            border: 2.5px solid black;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .input:focus {
            outline: none;
            border: 0.5px solid black;
            box-shadow: -5px -5px 0px black;
        }

        .input-container:hover>.icon {
            animation: anim 1s linear infinite;
        }

        @keyframes anim {

            0%,
            100% {
                transform: translateY(calc(-50% - 5px)) scale(1);
            }

            50% {
                transform: translateY(calc(-50% - 5px)) scale(1.1);
            }
        }
    }
}</style>