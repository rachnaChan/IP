<template>
    <nav>
        <div class="w-100 d-flex m-auto justify-content-between">

            <div class="mt-4 w-25 justify-content-between d-flex mx-3">

                <div class="mx-3">

                    <h4>Shop</h4>

                    <div class="d-flex">

                        <div>
                            <p>Cake</p>
                            <p>Cookies</p>
                            <p>Cupcakes</p>
                        </div>

                        <div class="mx-3">
                            <p>Donut</p>
                            <p>Drink</p>
                            <p>Gummy</p>
                        </div>

                    </div>
                </div>

                <div>

                    <h4>About</h4>

                    <div class="section2">
                        <RouterLink :to="{ name: 'about' }">
                            <p>Our Store</p>
                        </RouterLink>
                    </div>

                </div>

            </div>

            <div class="w-25">

                <div class="input-group mt-4">
                    <input type="email" class="input" id="Email" name="Email" placeholder="abc@gmail.com" autocomplete="off"
                        required autofocus="autofocus">
                    <input class="button--submit" value="Subscribe" type="submit">
                </div>

                <div class="main m-auto mt-5 d-flex">

                    <div class="card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="gmail">
                            <path fill="#d2919f"
                                d="M5.856 6.84a.75.75 0 0 0-1.106.66V17a.75.75 0 0 0 1.5 0V8.756l5.394 2.904c.222.12.49.12.712 0l5.394-2.904V17a.75.75 0 0 0 1.5 0V7.5a.75.75 0 0 0-1.106-.66L12 10.148L5.856 6.84Z" />
                            <path fill="#d2919f" fill-rule="evenodd"
                                d="M17.31 3.722a59.632 59.632 0 0 0-10.62 0l-1.518.135a3.53 3.53 0 0 0-3.179 3.006a35.508 35.508 0 0 0 0 10.274a3.53 3.53 0 0 0 3.18 3.005l1.516.136c3.534.316 7.088.316 10.622 0l1.517-.136a3.53 3.53 0 0 0 3.179-3.005a35.508 35.508 0 0 0 0-10.274a3.53 3.53 0 0 0-3.18-3.006l-1.516-.135ZM6.824 5.216a58.133 58.133 0 0 1 10.354 0l1.517.136a2.03 2.03 0 0 1 1.829 1.728a34.005 34.005 0 0 1 0 9.84a2.03 2.03 0 0 1-1.829 1.728l-1.517.136c-3.444.308-6.91.308-10.354 0l-1.517-.136a2.03 2.03 0 0 1-1.829-1.728a34.008 34.008 0 0 1 0-9.84a2.03 2.03 0 0 1 1.829-1.728l1.517-.136Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class="card">
                        <svg height="30px" width="30px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                            class="twitter">
                            <path
                                d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429">
                            </path>
                        </svg>
                    </div>

                    <div class="card">
                        <svg height="30px" width="30px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                            class="telegram">
                            <path d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path>
                            <path
                                d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z"
                                fill="#fff"></path>
                            <path
                                d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z"
                                fill="#b0bec5"></path>
                            <path
                                d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z"
                                fill="#cfd8dc"></path>
                        </svg>
                    </div>

                    <p class="text text-uppercase fs-6">hover for social</p>
                    <div class="main_back"></div>

                </div>

            </div>

        </div>
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
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, aliceblue, #ffe3e2);
    padding: 1rem 2rem;

    p {
        font-family: 'papyrus';
        font-size: 20px;
    }

    h4 {
        font-family: inherit;
    }
    .section2 {

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
    .input-group {
        display: flex;
        align-items: center;
    }
    .input {
        min-height: 50px;
        max-width: 150px;
        padding: 0 1rem;
        color: #fff;
        font-size: 15px;
        border: 1px solid gray;
        border-radius: 6px 0 0 6px;
        background-color: transparent;
    }
    .button--submit {
        min-height: 50px;
        padding: .5em 1em;
        border: none;
        border-radius: 0 6px 6px 0;
        background-color: gray;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
        transition: background-color .3s ease-in-out;
    }
    .button--submit:hover {
        background-color: #2cac8c;
    }
    .input:focus,
    .input:focus-visible {
        border-color: #2cac8c;
        outline: none;
    }
    .main_back {
        position: absolute;
        border-radius: 10px;
        transform: rotate(90deg);
        width: 5em;
        height: 5em;
        background: linear-gradient(270deg, #03a9f4, #cc39a4, #ffb5d2);
        z-index: -2;
        box-shadow: inset 0px 0px 180px 5px #ffffff;
    }

    .main {
        display: flex;
        flex-wrap: wrap;
        width: 8rem;
        align-items: center;
        justify-content: center;
        z-index: -1;
    }

    .card {
        width: 60px;
        height: 30px;
        border-top-left-radius: 10px;
        background: lightgrey;
        transition: .4s ease-in-out, .2s background-color ease-in-out, .2s background-image ease-in-out;
        background: rgba(255, 255, 255, 0.596);
        backdrop-filter: blur(5px);
        border: 1px solid transparent;
        -webkit-backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card .gmail {
        opacity: 0;
        transition: .2s ease-in-out;
        fill: #cc39a4;
    }

    .card:nth-child(2) {
        border-radius: 20px;
    }

    .card:nth-child(2) .twitter {
        opacity: 0;
        transition: .2s ease-in-out;
        fill: #03A9F4;
    }

    .card:nth-child(8) .telegram {
        opacity: 0;
        transition: .2s ease-in-out;
        fill: #29b6f6;
    }

    .main:hover {
        width: 8em;
        cursor: pointer;
    }

    .main:hover .main_back {
        opacity: 0;
    }

    .main:hover .card {
        margin: .2em;
        border-radius: 10px;
        box-shadow: 0 4px 30px rgba(79, 78, 78, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        background: rgba(211, 243, 242, 0.2);
    }
    .main:hover .card:nth-child(5) {
        border: transparent;
    }
    .main:hover .text {
        opacity: 0;
        z-index: -3;
    }
    .main:hover .gmail {
        opacity: 1;
    }
    .main:hover .twitter {
        opacity: 1;
    }

    .main:hover .telegram {
        opacity: 1;
    }
    .card:nth-child(1):hover {
        background-color: #c5dfb6;
    }
    .card:nth-child(1):hover gmail {
        fill: rgb(29, 1, 1);
    }
    .card:nth-child(2):hover {
        background-color: #03A9F4;
    }
    .card:nth-child(2):hover .twitter {
        fill: white;
    }
    .text {
        position: absolute;
        font-size: 0.4em;
        transition: .4s ease-in-out;
        color: black;
        text-align: center;
        font-weight: bold;
        letter-spacing: 0.1em;
        z-index: 3;
    }
}
</style>