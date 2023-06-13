<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <main>
    <nav class="navbar navbar-expand-lg navbar-light justify-content-between w-100 d-flex">
      <div class="logo d-flex w-25 justify-content-center img-container">
        <img src="./assets/Admin.jpg" class="store-img">
        <a class="navbar-brand justify-content-center text-center" href="#">
          <p class="mt-5 text-muted m">IPTP</p>
        </a>
      </div>


    </nav>
  </main>

  <RouterView />
</template>

<style>
@import url('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@400;500&display=swap');
@import url('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@400;500&display=swap');
@import "https://unpkg.com/open-props";
@import "https://unpkg.com/open-props/normalize.min.css";

p {
  font-size: 4rem;
  font-family: 'Dosis';
}

h5 {
  font-family: 'Dosis';
}

.navbar {
  background: linear-gradient(to right, #daddde, #fbdbae);
  height: 100px;
}

.navbar img {
  width: 72px;
  height: 72px;
  border-radius: 50%;

}

.store-img {
  transition: all 1s ease-in-out;
}


template {
  width: 100%;
}

#app {
  max-width: 50%;
  margin: 0 auto;
  padding: 2rem;

  font-weight: normal;
}

header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

a,
.green {
  text-decoration: none;
  color: hsla(160, 100%, 37%, 1);
  transition: 0.4s;
}

@media (hover: hover) {
  a:hover {
    background-color: hsla(160, 100%, 37%, 0.2);
  }
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  body {
    display: flex;
    place-items: center;
  }

  #app {
    width: 100%;
    padding: 0 2rem;
  }

  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
