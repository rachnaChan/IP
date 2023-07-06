
<template>
    <div class="mt-5 aa">

        <section class="about py-5" style="background-color: aliceblue;">
            <div class="row justify-content-between m-auto">

                <div class="col-10 col-md-5 align-self-center my-5 store-item">
                    <div class="img-container rounded-5" style="height: 300px; width: 500px;">
                        <img src="../assets/Img/cake03.jpg" class=" img-fluid store-img" alt="">
                    </div>
                </div>

                <div class="aboutUs col-10 mx-auto col-md-6 my-5">

                    <div>About <span>Us</span> </div>

                    <p>djdsahhdahdiusadferfqeerferr
                        fefwefewqfrerddudaswefqfqdwed
                        weqcehaduw eqyqwywqydhuwqeudh
                        wewfcsadcfewqewdedsfafe</p>

                    <div style="margin-left: 70%;">
                        <RouterLink :to="{ name: 'menu' }">
                            <button class="cta">
                                <span class="hover-underline-animation text-danger fw-bold"> Shop now </span>
                                <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg"
                                    id="arrow-horizontal">
                                    <path transform="translate(30)"
                                        d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                        data-name="Path 10" id="Path_10"></path>
                                </svg>
                            </button>
                        </RouterLink>
                    </div>

                </div>

            </div>
        </section>

        <section class="py-1" style="background-color: aliceblue;">
            <div>

                <div class="row">
                    <div class="col-10 mx-auto col-sm-6 text-center menu ">
                        <p>Our Products</p>
                    </div>
                </div>

                <div class="row align-items-center w-90 justify-content-between m-auto">
                    <div class="card col-sm-4 mx-1 my-3 c0 c1">

                        <div class="card-img ">
                            <img src="../assets/Img/cake01.jpg" class=" img-fluid store-img" alt="">
                        </div>

                        <div class="mt-4">
                            <h5 class=" text-center">Cake-01 </h5>
                            <h5>Product description and details</h5>
                        </div>

                        <div class="card-footer">

                            <span class="text-title">$15.99</span>

                            <div class="card-button">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path
                                        d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                    </path>
                                    <path
                                        d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                    </path>
                                    <path
                                        d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                    </path>
                                </svg>
                            </div>

                        </div>
                    </div>

                    <div class="card col-sm-4 mx-1 my-3 c0 c1">

                        <div class="card-img ">
                            <img src="../assets/Img/cookie01.jpg" class=" img-fluid store-img" alt="">
                        </div>

                        <div class="mt-4">
                            <h5 class=" text-center">Cookie-01 </h5>
                            <h5>Product description and details</h5>
                        </div>

                        <div class="card-footer">

                            <span class="text-title">$3.5</span>

                            <div class="card-button">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path
                                        d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                    </path>
                                    <path
                                        d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                    </path>
                                    <path
                                        d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                    </div>

                    <div class="card col-sm-4 mx-1 my-3 c0 c1">

                        <div class="card-img ">
                            <img src="../assets/Img/cupcake01.jpg" class=" img-fluid store-img" alt="">

                        </div>

                        <div class="mt-4">
                            <h5 class=" text-center">Cupcake-01 </h5>
                            <h5>Product description and details</h5>
                        </div>

                        <div class="card-footer">

                            <span class="text-title">$2.2</span>

                            <div class="card-button">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path
                                        d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                    </path>
                                    <path
                                        d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                    </path>
                                    <path
                                        d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                    </div>

                    <div class="card col-sm-4 mx-1 my-3 c0 c1">

                        <div class="card-img ">
                            <img src="../assets/Img/donut01.jpg" class=" img-fluid store-img" alt="">

                        </div>

                        <div class="mt-4">
                            <h5 class=" text-center">Donut-01 </h5>
                            <h5>Product description and details</h5>
                        </div>

                        <div class="card-footer">

                            <span class="text-title">$1.5</span>

                            <div class="card-button">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path
                                        d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                    </path>
                                    <path
                                        d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                    </path>
                                    <path
                                        d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                    </div>

                    <div class="card col-sm-4 mx-1 my-3 c0 c1">

                        <div class="card-img ">
                            <img src="../assets/Img/drink01.jpeg" class=" img-fluid store-img" alt="">

                        </div>

                        <div class="mt-4">
                            <h5 class=" text-center">Drink-01 </h5>
                            <h5>Product description and details</h5>
                        </div>

                        <div class="card-footer">

                            <span class="text-title">$4.2</span>

                            <div class="card-button">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path
                                        d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                    </path>
                                    <path
                                        d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                    </path>
                                    <path
                                        d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                    </div>

                    <div class="card col-sm-4 mx-1 my-3 c0 c1">

                        <div class="card-img ">
                            <img src="../assets/Img/gummy01.jpg" class=" img-fluid store-img" alt="">

                        </div>

                        <div class="mt-4">
                            <h5 class=" text-center">Gummy-01 </h5>
                            <h5>Product description and details</h5>
                        </div>

                        <div class="card-footer">

                            <span class="text-title">$0.99</span>

                            <div class="card-button">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path
                                        d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                    </path>
                                    <path
                                        d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                    </path>
                                    <path
                                        d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>
</template>
  
<script >
import { RouterLink } from 'vue-router'

</script>
  
<style lang="scss" scoped>
h5 {
    font-family: 'papyrus';
    font-size: 14px;
}

.aa {
    // background-image: url(../assets/Img/background.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    width: 100%;
    z-index: -99;
}

.container {
    width: 100%;
}

.aboutUs {
    font-family: "Papyrus";
    font-size: 48px;

    span {
        color: red;
    }
}

.menu {
    font-family: inherit;
    font-size: 4rem;
}

svg {
    width: 35px;
    height: 35px;
}

.about-img__container {
    position: relative;
}

.about-img__container::before {
    content: "";
    position: absolute;
    top: -2rem;
    left: -1.5rem;
    width: 100%;
    height: 100%;
    outline: 0.5rem outset pink;
    z-index: -1;
    transition: all 1s ease-in-out;
}

.about-img__container:hover:before {
    top: 0;
    left: 0;
}

.img-container {
    width: 90%;
    height: 170px;
    margin: auto;
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.store-img {
    transition: all 1s ease-in-out;
}

.img-container:hover .store-img {
    transform: scale(1.3);
}

.img-container:hover .store-item-icon {
    transform: translate(0, 0);
}

.c0 {
    font-family: 'Papyrus';
    width: 20%;
    height: 220px;
}

.c1 {
    background-color: #cce3de;

}

.c2 {
    background-color: #c0ccd2;
}

.cta {
    border: none;
    background: none;
    margin-left: 0%;
}

.cta span {
    padding-bottom: 7px;
    letter-spacing: 4px;
    font-size: 14px;
    padding-right: 15px;
    text-transform: uppercase;
}

.cta svg {
    transform: translateX(-8px);
    transition: all 0.3s ease;
}

.cta:hover svg {
    transform: translateX(0);
}

.cta:active svg {
    transform: scale(0.9);
}

.hover-underline-animation {
    position: relative;
    color: black;
    padding-bottom: 20px;
}

.hover-underline-animation:after {
    content: "";
    position: absolute;
    width: 100%;
    transform: scaleX(0);
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #000000;
    transform-origin: bottom right;
    transition: transform 0.25s ease-out;
}

.cta:hover .hover-underline-animation:after {
    transform: scaleX(1);
    transform-origin: bottom left;
}

.card {
    width: 190px;
    height: 280px;
    padding: .8em;
    background: #f5f5f5;
    position: relative;
    overflow: visible;
    // box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.card-img {
    background-image: url(../assets/Img/cake03.jpg);
    height: 40%;
    width: 100%;
    border-radius: .5rem;
    transition: .3s ease;
}

svg {
    width: 20px;
    height: 20px;
}

.card-footer {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 5px;
    border-top: 1px solid #686464;
}

.text-body {
    font-size: .5em;
    padding-bottom: 10px;
}

/*Button*/
.card-button {
    border: 1px solid #252525;
    display: flex;
    padding: .3em;
    cursor: pointer;
    border-radius: 50px;
    transition: .3s ease-in-out;
}

/*Hover*/
.card-img:hover {
    transform: translateY(-25%);
    box-shadow: rgba(226, 196, 63, 0.25) 0px 13px 47px -5px, rgba(180, 71, 71, 0.3) 0px 8px 16px -8px;
}

.card-button:hover {
    border: 1px solid #ffcaa6;
    background-color: #ffcaa6;
}</style>