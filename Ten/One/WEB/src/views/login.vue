<!-- 


<template>
  <div>
    <main class="form-signin">
      <form>
        <div class="text-center">
          <img
            class="mb-4"
            src="../assets/Admin.jpg"
            alt=""
            width="72"
            height="57"
          />
        </div>
        <h1 class="h3 mb-3 fw-normal"></h1>
        <label class="textUser">Usernamer</label>
        <div class="form-floating">
          <input
            type="email"
            class="form-control"
            id="floatingInput"
            placeholder="name@example.com"
            v-model="email"
          />
          <label for="floatingInput">Enter Email</label>
        </div>
        <label class="textUser">Password</label>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            placeholder="Password"
            v-model="password"
          />
          <label for="floatingPassword">Enter Password</label>
        </div>
      </form>
      <div class="checkbox mb-3"></div>
      <button
        class="w-100 btn btn-lg btn-primary"
        @click="created()"
        type="submit"
      >
        Login
      </button>

      <a href="http://localhost:3000/register"
        ><label
          style="
            display: flex;
            justify-content: flex-end;
            padding: 20px;
            color: #41b883;
          "
        >
          Create your new account here.
        </label>
      </a>

      <div class="redcolor" id="err"></div>
    </main>
  </div>
</template>

<script>
// import "@/assets/dist/css/bootstrap.min.css";


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

       if(this.email == "" && this.password == 0) { 
         
         var element = document.getElementById("err");
         element.innerHTML = `<h2>Your information incorrect</h2>`
        
    }
    else{
      // POST request using fetch with async/await
      const requestOptions = {
        method: "POST",
        credentials: "include",
        headers: { "Content-Type": "application/json",  
         "Access-Control-Allow-Credentials": true, },
        body: JSON.stringify({ email: this.email, password: this.password }),
        
      };

      //post data to api
      const response = await fetch(
        "http://localhost:3001/login",
        requestOptions
      );
      const data = await response.json();
      
     
      if (data.suscess == true) {
       
        this.$router.push({ name: "homeform", hash: "#HOME" });
      } else {
       
      }
    }

     
      
    },
  },
};
</script>

<style scoped>
.redcolor{
color: red;}
a {
  text-decoration: none;
  color: hsla(160, 100%, 37%, 1);
  transition: 0.4s;
}
.btn-primary {
  background-color: #41b883;
  border-color: #41b883;
}
.mb-4 {
  height: 200px;
  width: 200px;
}
.textUser {
  padding: 12px;
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
  z-index: 2;
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
   -->


<template>
  <div class="c">

    <section v-if="!isHidden" class="e">
      <div class="d">
        <div class="b">
          <img src="@/assets/logo.svg" class="logo" alt="Vue logo" width="125" height="125" />
        </div>
        <div class="spaces">
          <h1>Welcome</h1>
          <h3>Authentication App~</h3>
          <div class="e">
            <p class="btn btnOne">Login</p>
            <p v-on:click="isHidden = !isHidden" class="btn btnTwo"
              v-bind:class="{ 'dark': !isHidden, 'success': isHidden }">Register</p>
          </div>

        </div>
      </div>

      <form class="space">
        <div class="g">
          <img src="../assets/Admin.jpg">
        </div>
        <div class="space">
          <label for="email">Email</label>
          <input type="email" name="email" placeholder="Enter an email" required v-model="email">
        </div>
        <div class="space">
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Enter a password" required v-model="password">
        </div>

        <div class="space">
          <button type="submit" @click="created()">Login </button>
        </div>

        <a href="http://localhost:3000/register"><label style="
            display: flex;
            justify-content: flex-end;
            padding: 20px;
            color: #41b883;
          ">
            Create your new account here.
          </label>
        </a>
      </form>

      <!-- <div class="gray"></div>
          <div class="display">
            <p>Forgot <span style="color:green">password</span></p>
          </div> -->




    </section>

    <section v-if="isHidden" class="e">
      <div class="d">
        <div class="b">
          <img src="@/assets/logo.svg" class="logo" alt="Vue logo" width="125" height="125" />
        </div>
        <div class="spaces">
          <h1>Welcome</h1>
          <h3>Authentication App~</h3>
          <div class="e">
            <p v-on:click="isHidden = !isHidden" class="btn btnOne">Login</p>
            <p class="btn btnTwo">Register</p>
          </div>

        </div>
      </div>

      <form class="space">
        <div class="mt-1">
          <label for="email">Email</label>
          <input type="email" name="" placeholder="Enter an email" required>
        </div>
        <div class="mt-1">
          <label for="username">Username</label>
          <input type="username" name="" placeholder="Username" required>
        </div>
        <div class="mt-1">
          <label for="firstname">First name</label>
          <input type="text" name="" placeholder="First name" required>
        </div>
        <div class="mt-1">
          <label for="lastname">Last name</label>
          <input type="text" name="" placeholder="Last name" required>
        </div>
        <div class="mt-1">
          <label for="password">Password</label>
          <input type="password" name="" placeholder="Create your password" required>
        </div>
        <div class="mt-1">
          <p>By creating an account you agree to our <span style="color:blue">Term & Privacy</span></p>
          <button type="submit">Sign Up </button>
        </div>
      </form>
    </section>

  </div>
</template>
  
<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:300,300i,400,500,500i,600,700');

* {
  box-sizing: border-box;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

body {
  padding: 0;
  margin: 0;
  background: #c4c7ca;
  font-family: 'Poppins', sans-serif;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.g img {
  margin-left: 25%;
  width: 50%;
  height: 200px;
  justify-content: center;
  align-items: center;

}

.b {
  margin-top: 200px;
}

.c {
  width: 1300px;
  height: 765px;
  margin-top: 100px;
  border: 8px solid black;
  background-color: rgb(202, 211, 221);
}

.d {
  width: 500px;
  margin-left: 30px;
  display: flex;
  margin-top: 100px;
}

.e {
  display: flex;
}

.f {
  margin-left: 25%;
}

h1 {
  color: rgb(96, 132, 96);
  font-size: 2.8rem;
}

h3 {
  font-weight: 200;
  color: grey;
}

p {
  font-size: 20px;
  font-weight: 200;
}

.btn {
  padding: 0.5rem 1.2rem;
  border: none;
  outline: none;
  border-radius: 10px;
  font-family: papyrus;
}

.btn:hover {
  background-color: rgb(240, 234, 235);
}

.btnOne {
  background-color: aliceblue;
}

.btnTwo {
  background-color: aliceblue;
  padding: 0.5rem 1.2rem;
  margin-left: 10px;
}

.display {
  margin-left: 70%;
  margin-top: 20px;
}

.space {
  margin-top: 14px;
  font-weight: 700;
  font-size: 16px;
  margin-left: 10px;
  background-color: rgb(240, 234, 235);
}

.spaces {
  margin-top: 140px;
  margin-left: 25px;
}

.gray {
  margin-top: 10px;
  width: 100%;
  border-bottom: 65px solid rgb(238, 237, 237);
}

span {
  padding-left: 5px;
  cursor: pointer;
}

#app {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

form {
  padding: 30px;
  border-radius: 4px;
  width: 40vw;
  background: #fff;
  box-shadow: 0 8px 32px 0 rgba(255, 255, 255, 0.37);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
}

input {
  margin-top: 25px;
  height: 60px;
  outline: none;
  padding-left: 10px;
  box-sizing: border-box;
  border: 1px solid black;
  transition: .2s;
  font-family: 'Poppins', sans-serif;
  font-size: 22px;
  width: 100%;
}

input:hover {
  border: 1px solid #cdaecf;
  transition: .4s;
}

button {
  background: #9ec9b5;
  border-radius: 8px;
  outline: none;
  border: 0px;
  color: white;
  font-size: 28px;
  cursor: pointer;
  height: 60px;
  width: 100%;

}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

::placeholder {
  font-size: 20px;

}

@media(max-width: 824px) {
  form {
    width: 60vw;
  }
}

@media (max-width: 475px) {
  form {
    width: 70vw;
  }
}

.dark {
  color: black;
}

.success {
  color: #9ec9b5;
}
</style>
<script>
export default {

  data() {
    return {
      isHidden: false
    }
  },
}

</script>