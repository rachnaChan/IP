
<template>
  <div class="aa">
    <section class="about py-5">
      <div class="container">

        <div class="row justify-content-between">

          <div class="col-10 col-md-6 align-self-center my-5">
            <div >
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
            <div >
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
          <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 flex-wrap text-dark">
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">all</a>
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">cake</a>
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">cookie</a>
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">cupCake</a>
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">donut</a>
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">drink</a>
            <a href="#" class="btn btn-outline-secondary text-uppercase filter-btn m-2">gummy</a>
          </div>
        </div>

        <div class="row">

          <div class="col-10 mx-auto col-md-6">
            <form>
              <div class="input-group mb-3 justify-content-center">
                <div class="input-group-prepend mx-3 mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                  <!-- <span class="input-group-text "><i class="fas fa-search"></i></span> -->
                </div>
                <input type="text"  class="form-control" id="item" placeholder='item ...'>
              </div>

            </form>
          </div>
        </div>

        <div class="row align-items-center w-90">

          <div class="col-sm-3 mx-1 my-3 store-item c0 c1 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/cake01.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Cake-01</h5>
                  <h5><strong>15.99</strong>$</h5>
                </div>
              </div>
            </div>

          </div>

          <div class=" col-sm-3 mx-auto my-3 store-item c0 c2  mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/cookie01.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Cookie-01</h5>
                  <h5><strong>3.5</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c3 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/cupcake01.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>CupCake-01</h5>
                  <h5><strong>2.2</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c4 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/donut01.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Donut-01</h5>
                  <h5><strong>1.5</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-1 my-3 store-item c0 c5 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/drink01.jpeg" class=" img-fluid store-img" alt="">

              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Drink-01</h5>
                  <h5><strong>4.2</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c6 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/gummy01.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Gummy-01</h5>
                  <h5><strong>0.99</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c7 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/cake02.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Cake-02</h5>
                  <h5><strong>22</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c8 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/cookie02.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Cookie-02</h5>
                  <h5><strong>15.99</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-1 my-3 store-item c0 c9 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/cupcake02.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>CupCake-02</h5>
                  <h5><strong>1.87</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c10 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/donut02.jpeg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Donut-02</h5>
                  <h5><strong>2.1</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c11 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/drink02.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Drink-02</h5>
                  <h5><strong>3.99</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 mx-auto my-3 store-item c0 c12 mt-5">
            <div class="about-img__container mt-3">
              <div class="img-container shadow-lg">
                <img src="../assets/Img/gummy02.jpg" class=" img-fluid store-img" alt="">
              </div>
              <div>
                <div class="mt-2 d-flex justify-content-between text-capitalize">
                  <h5>Gummy-01</h5>
                  <h5><strong>2.5</strong>$</h5>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>

<style lang="scss" scoped>
.aa {
  background-image: url(../assets/Img/background.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  width: 100%;
  z-index: -99;
}
.aboutUs{
  font-family: "Papyrus";font-size: 48px;
  span{
    color: red;
  }
}
.menu{
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
  z-index: -2;
  transition: all 1s ease-in-out;
}

.about-img__container:hover:before {
  top: 0;
  left: 0;
}

.img-container {
  width:95%;
  height: 110px;
  border-radius: 10px;
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
  height: 160px;
}

.c1 {
  background-color: #C9E0E7;

}

.c2 {
  background-color: #F5CECE;
}

.c3 {
  background-color: #C9E0E7;
}

.c4 {
  background-color: #F5CECE;
  
}

.c5 {
  background-color: #F5CECE;
}

.c6 {
  background-color: #C9E0E7;
}

.c7 {
  background-color: #F5CECE;
}

.c8 {
  background-color: #C9E0E7;
}

.c9 {
  background-color: #C9E0E7;
}

.c10 {
  background-color: #F5CECE;
}

.c11 {
  background-color: #C9E0E7;
}

.c12 {
  background-color: #F5CECE;
}

</style>