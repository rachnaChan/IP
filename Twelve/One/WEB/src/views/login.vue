


<template>
  <div>
    <main class="form-signin">
      <div class="w-100 text-danger text-center" id="err" style="font-family: 'Dosis';"></div>

      <form class="d-flex m-auto mx-4 justify-content-between">

        <div class="w-50">
          <div>
            <label class="text-muted textUser">Email</label>
            <div class="form-outline">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                v-model="email" />
            </div>
          </div>
          <h1 class="h3 mb-1 fw-normal"></h1>

          <div>
            <label class="text-muted textUser">Password</label>
            <div class="form-outline">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                v-model="password" />
            </div>
          </div>

        </div>

        <div class="text-center w-25">
          <img class="mb-4" src="../assets/logo.png" alt="" width="72" height="57" />
        </div>

      </form>


      <div class="checkbox mb-3"></div>
      <div class="text-center mx-5 mt-5">
        <button class="w-25 m-auto btn btn-lg btn-success" @click="created()" type="submit">
          Sign In
        </button>
      </div>

      <a href="http://localhost:3000/register">
        <h5 class="text-right mt-3" style="margin-left: 23%;">
          Create your new account here.
        </h5>
      </a>

    </main>
  </div>
</template>

<script>
import "@/assets/dist/css/bootstrap.min.css";


export default {
  data() {
    return {
      email: "",
      password: "",
      msg: "",
      input_color: "",
    };
  },
  methods: {


    async created() {

      if (this.email == "" && this.password == 0) {

        var element = document.getElementById("err");
        element.innerHTML = `<h2>Failed!! Invalid information!!</h2>`

      }
      else {
        // POST request using fetch with async/await
        const requestOptions = {
          method: "POST",
          credentials: "include",
          headers: {
            "Content-Type": "application/json",
            "Access-Control-Allow-Credentials": true,
          },
          body: JSON.stringify({ email: this.email, password: this.password }),

        };

        //post data to api
        const response = await fetch(
          "http://localhost:3001/auth/login",
          requestOptions
        );
        const data = await response.json();
        console.log(data);

        if (data.success == true) {

          this.$router.push({ name: "homeform", hash: "#HOME" });
        } else {

        }
      }



    },
  },
};
</script>

<style scoped>
.aa {
  background-image: url(../assets/Admin.jpg);
}


a {
  text-decoration: none;
  color: hsla(160, 100%, 37%, 1);
  transition: 0.4s;
}

h2 {
  text-align: center;
}

.mb-4 {
  height: 200px;
  width: 200px;
}

.textUser {
  padding: 10px;
}

form {
  box-shadow: 0 0 3px #ccc;
  padding: 10px;
}

.form-signin {
  width: 100%;
  max-width: 6 30px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 1;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.bd-placeholder-img {
  font-size: 1.125rem;
  text-anchor: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

@media (min-width: 768px) {
  .bd-placeholder-img-lg {
    font-size: 3.5rem;
  }
}
</style>
  