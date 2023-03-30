<template>
  <nav>
    <main>
      <div class="section1 d-flex">
        <img src="../assets/Img/a.png" alt="logo">
        <div class="mx-4 text-uppercase fs-1 text-muted">gic</div>
      </div>
      <dic class=" section2 navbar navbar-expand-lg text-uppercase">

        <div class="navbar-nav">
          <a class="nav-item nav-link active mx-2" href="#">about us</a>
          <a class="nav-item nav-link mx-2" href="#">why gic</a>
          <a class="nav-item nav-link mx-2" href="#">lifestyle</a>
          <a class="nav-item nav-link disabled mx-2" href="#">contact</a>
        </div>

      </dic>
      <div class="section3">
        <div class="search">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
            viewBox="0 0 16 16">
            <path
              d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
          </svg>
        </div>

        <div class="d-flex ">
          <p class="fs-1 mx-4 mt-2 " style="font-weight:500;"> | </p>
          <p class="mx-4 mt-3 fs-1" style="color:pink; font-weight:500">Logout</p>
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
  background-color: #DEEBEF;
  //padding: 1rem 2rem;
  height: 150px;

  main {
    width: 90%;
    display: flex;
    justify-content: space-between;
    align-items: center;

    .section1 {
      img {
        width: 4.5rem;
      }
    }

    .section2 {
      display: flex;
      gap: 1rem;
      font-family: 'Dosis', cursive;
      font-size: 64px;

      a {
        font-size: 2rem;
        text-decoration: none;
        color: black;

        &.router-link-exact-active {
          color: #C98EC6;
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

    }
  }
}
</style>