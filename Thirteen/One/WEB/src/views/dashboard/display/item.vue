
<template >

  <main>
    <hr>
    <div class="w-50 m-auto text-center">
      <h1>Item</h1>
    </div>

    <div class="py-5">
      <form @submit="onSubmit" method="post">
        <div class="d-flex justify-content-between m-auto">

          <div class="d-flex">
            <label for="name" class="mt-3"> <p>Name :</p></label>
            <input v-model="name" type="text" placeholder="Name" required />
          </div>

          <div class="d-flex">
            <label for="category" class="mt-3"> <p>Category :</p></label>
            <select v-model="categoryId" name="category" required class="px-2 mx-2 rounded-sm bg-green-100">
              <option v-for="category in categories" :key="category.name" :value="category._id">
                {{ category.name }}
              </option>
            </select>
          </div>

          <div class="d-flex">
            <label for="description" class="mt-3"> <p>Description :</p></label>
            <input v-model="desc" required type="text" placeholder="Description" />
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
        <tr  style="font-family: 'Dosis'; font-size: 14px;" >
          <th>Name</th>
          <th>Category</th>
          <th>Description</th>
        </tr>

        <tr v-for="item in items" :key="item.name">
          <td>{{ item.name }}</td>
          <td>{{ item.category?.name }}</td>
          <td>{{ item.desc }}</td>
        </tr>
      </table>
    </div>
  </main>
</template>

<style>
@import "@/assets/dist/css/bootstrap.min.css";

p{
  font-size: 14px;
  font-family: 'papyrus';
}
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
import categoryApi from "@/method/libs/category";
import itemApi from "@/method/libs/item";

export default {
  data() {
    return {
      categories: [],
      items: [],
      name: "",
      categoryId: "",
      desc: "",
    };
  },
  methods: {
    async onSubmit(e) {
      e.preventDefault();
      const { name, desc, categoryId } = this;
      const result = await itemApi.create({ name, desc, category: categoryId });
      if (!result) {
        alert(result.error);
        return;
      }

      this.items = await itemApi.all();
      this.name = this.desc = this.categoryId = "";
    },
  },
  async mounted() {
    this.categories = await categoryApi.all();
    this.items = await itemApi.all();
  },
};
</script>