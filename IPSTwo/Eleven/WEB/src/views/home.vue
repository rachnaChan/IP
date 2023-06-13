<template>
  <div>
    <main>

      <!-- <nav class="navbar navbar-expand-lg navbar-light justify-content-between w-100 d-flex">
      <div class="logo d-flex w-25 justify-content-center img-container">
        <img src="./assets/Admin.jpg" class="store-img">
        <a class="navbar-brand justify-content-center text-center" href="#">
          <p class="mt-5 text-muted m">IPTP</p>
        </a>
      </div>

    </nav> -->
    <div>
      
      <label v-if="data != null"> Username : {{ data.username }}</label><br>
      <label v-if="data != null"> Firstname: {{ data.firstname }}</label><br>
      <label v-if="data != null"> Lastname : {{ data.lastname }}</label><br>
      <label v-if="data != null"> Email : {{ data.email }}</label><br><br><br><br><br>
    </div>


      <div>
        <button class="w-100 btn btn-lg btn-success" type="submit" @click="created">
        LogOut
      </button>
      </div>
      
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
    const response = await fetch("http://localhost:3001/auth/me", requestOptions);

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

      const response = await fetch("http://localhost:3001/auth/logout", request);

      const data = await response.json();
      console.log("data: ", data);

      this.$router.push({ name: "login", hash: "" });

    },
  },
};
</script>


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
  background: linear-gradient(to right, #dcf5fa, #efc9e9);
  height: 100px;
}

.navbar img {
  width: 72px;
  height: 72px;
  border-radius: 50%;

}

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
</style>
