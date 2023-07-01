<template>
  <div class="h-100 m-auto">
    <img
      class="card-img w-25 justify-content-between m-auto"  src="../../assets/logo.png"
      alt=""
    />
    <div class="card-title d-flex"> <h5> category id : </h5> {{ products.category }}</div>
    <span class="item d-flex"><h5> item id : </h5>{{ products.item }}</span>

    <span>{{ products.item.name }}</span>
    <li v-for="p in products.prices" :key="p._id">
      <span class="item">{{ p.source }}</span>
      <span class="item"> = {{ p.price }}</span>
    </li>
    <!-- <div class="card-price">{{ products.desc }}</div> -->
  </div>
</template>

<script>
export default {
  props: ["products"],
  async mounted() {
    console.log("card", this.products);
  },
};
</script>

<style scoped>
.card {
  width: 160px;
  height: 220px;
  border: 1px solid;
}

.card-img {
  width: 100%;
}

.card-title {
  text-align: center;
}

.card-price {
  color: red;
  font-weight: bold;
  text-align: center;
}
</style>
