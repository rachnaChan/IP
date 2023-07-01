<template>
  <div class="mt-2">


    <div class="d-flex justifuy-content-between m-auto mt-2">
      <div class="bkg-item">
        <span class="" style="padding: 3px">{{ item.name }}</span>
      </div>

      <div class="bkg-item">
        <span class="it" style="padding: 3px">{{ item.desc }}</span>
      </div>

      <div class="bkg-item">
        <span class="it" style="padding: 3px">{{ Category_Name }}</span>
      </div>

      <div class="bkg-btn">
        <div class="btn-edit" style="padding: 3px">
          <button>Edit</button>
        </div>

        <div class="btn-delete" style="padding: 3px">
          <button>Delete</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  props: ["item"],
  data() {
    return {
      id_i: "",
      Category_Name: "",
    };
  },
  async created() {
    const requestOptions = {
      method: "POST",
      credentials: "include",
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Credentials": true,
      },
      body: JSON.stringify({ id: this.item.category }),
    };

    const response = await fetch(
      "http://localhost:3001/category/id",
      requestOptions
    );

    const data = await response.json();
    this.Category_Name = data.data.name;
  },
};
</script>

<style scoped>
button {
  width: 70px;
  height: 30px;
  border-radius: 7px 7px;
  border: rgb(255, 255, 255);
  font-size: 17px;
}

.btn-delete>button {
  color: rgb(240, 240, 240);
  background-color: rgb(255, 0, 0);
}

.btn-edit>button {
  color: rgb(255, 255, 255);
  background-color: rgb(36, 182, 31);
}

.bkg-btn {
  padding-left: 10px;
  padding-right: 10px;
  padding-top: 0px;
  display: flex;
}

.bkg-item {
  width: 50%;
  display: flex;
  justify-content: flex-start;
}

.it {
  position: relative;
  top: auto;
  left: 10px;
}

.bkg-item {
  background-color: rgb(255, 255, 255);
  border: rgb(93, 94, 95) hidden;
  font-size: 15px;
  align-items: center;
  padding-left: 10px;
}
</style>
