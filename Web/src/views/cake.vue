
<template>
    <div class="aa">
        <section class="about py-5">
            <div class="container">

                <div class="row justify-content-between">

                    <div class="col-10 col-md-6 align-self-center my-5">
                        <div>
                            <div class="about-img__container">
                                <img src="../assets/Img/cake04.jpg" class="img-fluid" alt="">
                            </div>

                        </div>
                    </div>

                    <div class="aboutUs col-10 mx-auto col-md-6 my-5">
                        <div>About <span>Us</span> </div>
                        <p>djdsahhdahdiusadferfqeerferr
                            fefwefewqfrerddudaswefqfqdwed
                            weqcehaduw eqyqwywqydhuwqeudh
                            wewfcsadcfewqewdedsfafe</p>
                        <div class="text-right">
                            <RouterLink :to="{ name: 'about' }">
                                <p class="text-danger text-decoration-underline" style="text-align:right">see more</p>
                            </RouterLink>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section class=" py-5">
            <div class="container">

                <div class="row">
                    <div class="col-10 mx-auto col-sm-6 text-center menu text-decoration-underline">
                        <p>Menu</p>
                    </div>
                </div>

                <div class="row">
                    <div class="btn col-lg-8 mx-auto d-flex justify-content-around my-2 flex-wrap text-dark">

                        <RouterLink :to="{ name: 'home' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">all</a></RouterLink>
                        <RouterLink :to="{ name: 'cake' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">cake</a></RouterLink>
                        <RouterLink :to="{ name: 'cookie' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">cookie</a></RouterLink>
                        <RouterLink :to="{ name: 'cupcake' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">cupcake</a>
                        </RouterLink>
                        <RouterLink :to="{ name: 'donut' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">donut</a></RouterLink>
                        <RouterLink :to="{ name: 'drink' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">drink</a></RouterLink>
                        <RouterLink :to="{ name: 'gummy' }"><a
                                class="type btn btn-outline-secondary text-uppercase filter-btn m-2">gummy</a></RouterLink>


                    </div>
                </div>

                <div class="search m-auto w-75 justify-content-center">

                    <form class="w-100 m-auto justify-content-center d-flex">
                        <div>
                            <i class="bx bxs-search-alt-2 mt-3 mx-4"></i>
                        </div>

                        <div>
                            <input type="text" id="find" placeholder="Find Your Cup of Tea..." onkeyup="search()">
                        </div>
                    </form>

                </div>

                <div class="row produclist align-items-center w-90">

                    <div class="col-sm-3 mx-1 my-3 store-item c0 c1 ">
                        <div class="product mt-3">
                            <div class="img-container">
                                <img src="../assets/Img/cake01.jpg" class=" img-fluid store-img" alt="">
                            </div>
                            <div>
                                <div class=" d-flex justify-content-between text-capitalize">
                                    <h5>Cake-01</h5>
                                    <h5><strong>15.99</strong>$</h5>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- <div class="col-sm-3 mx-auto my-3 store-item c0 c2">
                        <div class="product mt-3">
                            <div class="img-container">
                                <img src="../assets/Img/cake02.jpg" class=" img-fluid store-img" alt="">
                            </div>
                            <div>
                                <div class=" d-flex justify-content-between text-capitalize">
                                    <h5>Cake-02</h5>
                                    <h5><strong>22</strong>$</h5>
                                </div>
                            </div>
                        </div>
                    </div>
 -->


                </div>

            </div>
        </section>
    </div>
</template>
  
<script >
import { RouterLink } from 'vue-router'

function search() {
    let dataFilter = document.getElementById('find').value.toUpperCase();

    let items = document.querySelectorAll('.product')
    let list = document.getElementsByTagName('h5');

    for (var i = 0; i <= list.length; i++) {
        let aa = items[i].getElementsByTagName('h5')[0];

        let value = aa.innerHTML || aa.innerText || aa.textContent;

        if (value.toUpperCase().indexOf(dataFilter) > -1) {
            items[i].style.display = "";
        } else {

            items[i].style.display = "none";

        }
    }
}
</script>
  
<style lang="scss" scoped>
.aa {
    // background-image: url(../assets/Img/background.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    width: 100%;
    z-index: -99;
}

.aboutUs {
    font-family: "Papyrus";
    font-size: 48px;

    span {
        color: red;
    }
}

.menu {
    font-family: 'Dokdo';
    font-size: 5rem;
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
    background-color: #C9E0E7;

}

.c2 {
    background-color: #F5CECE;
}</style>