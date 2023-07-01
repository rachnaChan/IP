

<template >
  <main>
    <hr>
    <div class="w-50 m-auto text-center">
      <h1>Category</h1>
    </div>

    <div class="py-5">
      <form @submit="onSubmit" method="post">
        <div class="d-flex justify-content-between m-auto">
          
          <div class="d-flex">
            <label for="name" class="mt-3"> <p>Name :</p></label>
            <input v-model="name" type="text" placeholder="Name" required />
          </div>

          <div class="d-flex">
            <label for="description" class="mt-3"> <p>Description :</p></label>
            <input v-model="desc" required type="text" placeholder="Description" />
          </div>

           <div class="d-flex">
            <label for="image" class="mt-3"> <p>Image URL :</p></label>
            <input v-model="desc" required type="text" placeholder="Image URL" />
          </div>

          <div class="btn-save1" @click="save_c()">
            <div class="btn-save" style="padding: 3px">
              <button class="button-save btn-sc"> <p class="mt-2">Add</p></button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div>
      <table id="customers">
        <tr style="font-family: 'Dosis'; font-size: 14px;">
          <th>Name</th>
          <th>Description</th>
          <th>ImageURL</th>
        </tr>

        <tr v-for="cate in categories" :key="cate.name">
          <td>{{ cate.name }}</td>
          <td>{{ cate.desc }}</td>
          <td>{{ cate.imageUrl }}</td>
        </tr>
      </table>
    </div>
  </main>
</template>

<style>

@import "@/assets/dist/css/bootstrap.min.css";
#customers {
  font-family: 'Dosis';
  border-collapse: collapse;
  width: 100%;
}

.button-save,
.button-update {
  width: 70px;
  height: 30px;
  border-radius: 7px 7px;
  border: rgb(255, 255, 255);
  font-size: 17px;
}

.btn-save>button,
.btn-cancle>button,
.btn-update>button {
  color: rgb(255, 255, 255);

  text-align: center;
}

.btn-save>button {
  background-color: rgb(197, 124, 16);
}
</style>

<script >

import categoryBack from "@/method/libs/category";
export default {
  data() {
    return {
      categories: [],
      name: "",
      desc: "",
      imageUrl: "",
    };
  },
  methods: {
    async onSubmit(e) {
      e.preventDefault();
      const { name, desc, imageUrl } = this;
      const result = await categoryBack.create({ name, desc, imageUrl });
      if (!result) {
        alert(result.error);
        return;
      }

      this.categories = await categoryBack.all();
      this.name = this.desc = this.imageUrl = "";
    },
  },
  async mounted() {
    this.categories = await categoryBack.all();
  },
};
</script>