
<template >
  <main>
    <hr>
    <div class="w-50 m-auto text-center">
      <h1>Product</h1>
    </div>

    <div class="py-5">
      <form @submit="onCreateProduct" method="post">
        <div class="d-flex justify-content-between m-auto ">
          
          <div class="w-50">
             <div class="d-flex">
            <label for="name" class="mt-3"> <p>Title :</p></label>
            <input v-model="name" type="text" placeholder="Title" required style="height: 40px;" />
          </div>

          <div class="d-flex">
            <label for="category" class="mt-3"> <p>Category :</p></label>
            <select v-model="categoryId" name="category" required style="height: 40px;" >
              <option v-for="category in categories" :key="category.name" :value="category._id">
                {{ category.name }}
              </option>
            </select>
          </div>

          <div class="d-flex">
            <label for="item"><p>Item:</p></label>
            <select required v-model="itemId" name="item" style="height: 40px;" >
              <option v-for="item in items" :key="item.name" :value="item._id">
                {{ item.name }}
              </option>
            </select>
          </div>
          </div>

          <div class="w-50">
            <div class="d-flex">
            <label for="imageUrl" class="mt-3"> <p>Image URL :</p></label>
            <input v-model="imageUrl" type="text" placeholder="Image URL" required style="height: 40px;"  />
          </div>
          
          <div class="d-flex">
            <label for="desc" class="mt-3"> <p>Description :</p></label>
            <input v-model="desc" type="text" placeholder="Description" required style="height: 40px;" />
          </div>

          <div class="btn-save1" @click="save_c()">
            <div class="btn-save" style="padding: 3px">
              <button class="button-save btn-sc"> <p class="mt-2">Add</p></button>
            </div>
          </div>
          </div>
          

        </div>
      </form>
    </div>

    <div class="customers">
      <table id="customers">
        <tr>
          <th>Title</th>
          <th>Prices</th>
          <th>Category</th>
          <th>Item</th>
          <th>ImageURL</th>
          <th>Description</th>
          <th>Action</th>
        </tr>

        <tr v-for="product in products" :key="product.name">
          <td>{{ product.title }}</td>

          <td>
            <ul>
              <li v-for="price in product?.prices" :key="price._id">
                <span>{{ price.price }}$</span>
                <span>({{ price.source }})</span>
              </li>
            </ul>
          </td>

          <td>{{ product.category?.name }}</td>
          <td>{{ product.item?.name }}</td>
          <td>{{ product.imageUrl }}</td>
          <td>{{ product.desc }}</td>

          <td >
            <div class="d-flex justify-content-between m-auto">
              <button class="btn btn-outline-success text-uppercase filter-btn m-2" style="height: 20px;"> <p style="font-size: 10px;">Edit</p></button>
              <button class="btn btn-outline-danger text-uppercase filter-btn m-2"  style="height: 20px;"><p style="font-size: 10px;">Delete</p></button>
              <button v-on:click="onSelectProduct(product)" class="btn btn-outline-secondary text-uppercase filter-btn m-2"  style="height: 20px;"><p style="font-size: 10px;">Add price </p></button>
            </div>
          </td>

        </tr>
      </table>
    </div>

    <div v-if="priceModalShown && selectedProduct" class="
        flex
        justify-center
        items-center
        absolute
        top-0
        left-0
        bottom-0
        right-0 ">
      <div class="w-72 h-96 bg-white rounded-lg shadow-md">
        <form @submit="onAddPrice" method="post">
          <div class="h-full w-full flex flex-col">
            <div class="flex flex-grow-0 relative p-2 py-3">
              <div class="font-bold text-center w-full">
                {{ selectedProduct?.title }}
              </div>
            </div>
            <div class="w-full flex flex-grow p-2">
              <div class="w-full flex flex-col space-y-3">
                <div class="border">
                  <input required v-model="price" class="w-full h-10 px-1" type="number" placeholder="Price" />
                </div>
                <div class="border">
                  <input required v-model="source" class="w-full h-10 px-1" type="text" placeholder="Source" />
                </div>
              </div>
            </div>
            <div class="flex flex-grow-0 py-1 justify-center space-x-2">
              <button v-on:click="priceModalShown = false" class="button-save btn-sc">Cancel </button>
              <button type="submit" class="button-save btn-sc ">Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</template>

<style>
@import "@/assets/dist/css/bootstrap.min.css";


#customers {
  font-family: 'Dosis';
  font-size: 14px;
  border-collapse: collapse;
  width: 100%;
}

#customers td,
#customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even) {
  background-color: #f2f2f2;
}

#customers tr:hover {
  background-color: #ddd;
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
import itemBack from "@/method/libs/item";
import productBack from "@/method/libs/product";
import priceBack from "@/method/libs/price";

export default {
  //components: { Button },
  data() {
    return {
      categories: [],
      items: [],
      products: [],
      title: "",
      imageUrl: "",
      desc: "",
      categoryId: "",
      itemId: "",
      priceModalShown: false,
      selectedProduct: null,
      price: "",
      source: "",
    };
  },
  methods: {
    async onCreateProduct(e) {
      e.preventDefault();
      const { title, desc, itemId, categoryId, imageUrl } = this;
      const result = await productBack.create({
        title,
        desc,
        item: itemId,
        category: categoryId,
        imageUrl,
      });
      if (!result) {
        alert(result.error);
        return;
      }

      this.products = await productBack.all();
      this.title =
        this.desc =
        this.categoryId =
        this.itemId =
        this.imageUrl =
        "";
    },
    onSelectProduct(product) {
      this.priceModalShown = true;
      this.selectedProduct = product;
    },
    async onAddPrice(e) {
      e.preventDefault();
      const { price, source, selectedProduct } = this;
      const result = await priceBack.add({
        price,
        source,
        product: selectedProduct?._id,
      });

      console.log(result);
      if (result.error) {
        alert(result.error);
        return;
      }

      this.products = await productBack.all();
      this.price = this.source = this.selectedProduct = "";
    },
  },
  async mounted() {
    this.categories = await categoryBack.all();
    this.items = await itemBack.all();
    this.products = await productBack.all();
  },
};
</script>