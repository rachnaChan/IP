<template>
  <div class="about">
    <main class="form-signin">
      <div class="w-100 text-danger text-center" id="err" style="font-family: 'Dosis';"></div>

      <form>
        <div class="text-center">
          <p class=" mb-3 text-center text-bold text-muted">Sign Up</p>

        </div>

        <div>
          <label class="text-muted textUser">Email</label>

          <div class="form-outline">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="email" />
          </div>
        </div>


        <div>
          <label class=" text-muted textUser">Username</label>
          <div class="form-outline">
            <input type="" class="form-control" id="" placeholder="username" v-model="username" />
          </div>
        </div>

        <div>
          <label class="text-muted textUser">First name</label>
          <div class="form-outline">
            <input type="" class="form-control" placeholder="firstname" v-model="firstname" />
          </div>
        </div>

        <div>
          <label class="text-muted textUser">Last name</label>
          <div class="form-outline">
            <input type="" class="form-control" placeholder="lastname" v-model="lastname" />
          </div>
        </div>

        <div>
          <label class="text-muted textUser">Password</label>
          <div class="form-outline">
            <input type="password" class="form-control" placeholder="Password" v-model="password" />
          </div>
        </div>

        <div>
          <label class="text-muted textUser">Password</label>
          <div class="form-outline">
            <input type="password" class="form-control" placeholder="repeatPassword" v-model="repeat_password" />
          </div>
        </div>

      </form>
      <label style="display: flex; justify-content: flex-start; padding: 20px">
        By creating an account you agree to our
        <span class="text-primary"> &nbsp; Terms & Privay</span>
      </label>


      <div class="text-center mx-5 mt-2">
        <RouterLink :to="{ name: '' }">

        <button class="w-50 m-auto btn btn-lg btn-success" @click="created()" type="submit">
          Sign Up
        </button>
        </RouterLink>

        <RouterLink :to="{ name: 'login' }">
          <button class="w-25 m-auto btn btn-lg btn-primary mx-4"> Login
          </button>
        </RouterLink>

      </div>
      <!-- <div class="checkbox mb-3"></div> -->
      <!-- <a href="http://localhost:8000/"><p class="text-center mt-1 fs-2 mx-5" >Login
  
          </p>
        </a> -->


    </main>


  </div>
</template>
  
<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
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
  
  
<script>

//   import "@/assets/dist/css/bootstrap.min.css";
export default {
  data() {
    return {
      email: "",
      username: "",
      firstName: "",
      lastName: "",
      pwd: "",
      repeatPws: "",
    };
  },
  methods: {
    async onSubmit(e) {
      e.preventDefault();
      const res = await fetch("http://localhost:8000/user/register", {
        method: "POST",
        headers: {
          "Content-type": "application/json",
        },
        body: JSON.stringify({
          email: this.email,
          username: this.username,
          firstName: this.firstName,
          lastName: this.lastName,
          password: this.pwd,
          repeat_password: this.repeatPws,
        }),
      });

      const result = await res.json();
      if (!result.success) {
        alert(result.error);
        return;
      }

      alert("Successfully registered~");
      this.$router.push({ name: "user/login" });
    },
  },
};
</script>
  
<style scoped>
.redcolor {
  color: red;
}

.container {
  border: 1px solid rgb(204, 203, 203);
  padding: 10px;
  width: 400px;
  height: 600px;
}

a {
  font-weight: 700;
  color: #00a271;
}

.log_in {
  padding: 10px;
  border-radius: 2%;
}

.log_in h4 {
  margin-bottom: 10px;
}

.log_in>input {
  width: 100%;
  border: 1px solid rgb(247, 244, 244);
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
  background-color: rgb(228, 226, 226);
}

#btn_signup {
  justify-content: center;
  align-content: center;
  align-items: center;
  width: 48%;
  background-color: #41b883;
  border: 1px solid white;
  color: white;
  padding-bottom: 4%;
  left: 50%;
  right: 50%;
  transform: translate(-50%, -50%);
  padding-top: 10px;
  margin-top: 10px;
}

#btn_signup:hover {
  color: red;
}
</style>
  

  