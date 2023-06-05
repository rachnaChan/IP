<template>
  <div>
    <main>
      <nav class="navbar navbar-expand-lg navbar-light justify-content-between w-100 d-flex">
        <div class="logo d-flex w-25 justify-content-center img-container">
            <img src="../assets/Admin.jpg" alt="logo" class="store-img">
            <a class="navbar-brand justify-content-center text-center" href="#">
                <p>Gic Cafe</p>
            </a>
        </div>

        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-75 justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav w-50 justify-content-between ml-50" style="margin-left: 40%;">
                <a class="nav-item nav-link active" href="#Home">
                    <h5 class="fs-1">Home</h5>
                </a>
                <a class="nav-item nav-link" href="#AboutUs">
                    <h5 class="fs-1">About Us</h5>
                </a>
                <a class="nav-item nav-link" href="#Menu">
                    <h5 class="fs-1">Menu</h5>
                </a>
                <a class="nav-item nav-link">
                    <button type="submit" @click="created">LogOut</button>
                </a>
            </div>
        </div>
    </nav>
      <!-- <button @onclick="created"> Back to Login</button> -->

      <label v-if="data != null"> Username : {{ data.data.username }}</label><br>
      <label v-if="data != null"> Firstname: {{ data.data.firstname }}</label><br>
      <label v-if="data != null"> Lastname : {{ data.data.lastname }}</label><br>
      <label v-if="data != null"> Email    : {{ data.data.email }}</label><br><br><br><br><br>

      <!-- <button
        class="w-100 btn btn-lg btn-primary"
        type="submit"
        @click="created">
        Log out
      </button> -->
    </main>
  </div>
</template>


<script>
export default {
  data() {
    return {
      data: null,
    };
  },

  async mounted() {
    const requestOptions = {
      method: "GET",
      credentials: "include",
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Credentials": true,
      },
      body: JSON.stringify(),
      // session: {"jwt": "document.cookie"}
    };

    console.log(requestOptions);
    //post data to api
    const response = await fetch("http://localhost:3001/me", requestOptions);

    const data = await response.json();
    console.log("data: ", data);
    this.data = data;
   
  },
  methods: {
    async created() {
      
        const request = {
          method: "POST",
          credentials: "include",
          headers: {
            "Content-Type": "application/json",
            "Access-Control-Allow-Credentials": true,
          },
          body: JSON.stringify(),
        };

        const response = await fetch("http://localhost:3001/logout", request);

        const data = await response.json();
        console.log("data: ", data);

        this.$router.push({ name: "login", hash: "" });
      
    },
  },
};
</script>


<style>
header {
  display: none;
}
h3 {
  background-color: rgba(111, 168, 220, 0.8);
  text-align: center;
  margin-bottom: 20px;
}
#app {
  display: flex;
  flex-direction: column;
  align-items: center;
}
#btn_logout {
  cursor: pointer;
  background-color: rgba(239, 54, 54);
  color: white;
  border-style: outset;
  border-color: #0066a2;
  height: 2rem;
  width: 4rem;
  font: sans-serif;
  text-shadow: none;
  margin-top: 0.645rem;
  border-radius: 0.165rem;
  margin: 0.5rem 0 0.67rem 0;
}


@import url('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@400;500&display=swap');

p {
  font-size: 3rem;
  font-family: 'Dosis';
  text-align: center;
  margin-top: 8px;
}

h5,
h2 {
  font-family: 'Dosis';
}

.navbar {
  background-color: aliceblue;
  height: 100px;
}

.navbar img {
  width: 72px;
  height: 72px;
  border-radius: 50%;

}
</style>
