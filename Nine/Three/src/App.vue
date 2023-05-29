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
          <img src="@/assets/zmffhfltm.png">
        </div>
        <div class="space">
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Enter an email" required>
        </div>
        <div class="space">
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Enter a password" required>
        </div>
        <div class="space">
          <button type="submit">Login </button>
        </div>
        <div class="gray"></div>
        <div class="display">
          <p>Forgot <span style="color:green">password</span></p>
        </div>

      </form>
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
*{
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