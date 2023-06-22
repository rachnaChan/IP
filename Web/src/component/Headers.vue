<template>
    <nav>
        <main>
            <div class="section1">
                <img src="../assets/Img/a.png" alt="logo">
            </div>
            <div class="section2">
                <RouterLink :to="{ name: 'home' }">Home</RouterLink>
                <RouterLink :to="{ name: 'about' }">About</RouterLink>
                <RouterLink :to="{ name: 'menu' }">Menu</RouterLink>
            </div>
            <div class="section3">
                <!-- <div class="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </div> -->
                <div class="cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <p>cart</p>
                </div>
            </div>
        </main>

    </nav>
</template>
<script setup>
import { RouterLink } from 'vue-router'
</script>

<style lang="scss" scoped>
*{
  box-sizing: border-box;
}
nav {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, aliceblue , rgb(234, 206, 211),  aliceblue,  rgb(234, 206, 211),aliceblue );
    padding: 1rem 2rem;
    height: 100px;

    main {
        width: 90%;
        display: flex;
        justify-content: space-between;
        align-items: center;

        .section1 {
            img {
                width: 4.5rem;
                background: transparent;
            }
        }

        .section2 {
            display: flex;
            gap: 1rem;
            font-family: 'Dosis';
            font-size: 64px;

            a {
                font-size: 2rem;
                text-decoration: none;
                color: black;

                &.router-link-exact-active {
                    color: rgb(117, 117, 118);
                    text-decoration: underline;
                }
            }
        }

        .section3 {
            display: flex;
            align-items: center;
            gap: .7rem;
            --size: 35px;

            .search {
                display: flex;
                align-items: center;

                svg {
                    width: var(--size);
                    height: var(--size);
                }
            }

            .cart {
                display: flex;
                gap: .5rem;
                align-items: center;
                font-family: 'Dosis', sans-serif;
                font-size: 48px;
                font-weight: 300;

                svg {
                    width: var(--size);
                    height: var(--size);
                }
            }
        }
    }
}
</style>