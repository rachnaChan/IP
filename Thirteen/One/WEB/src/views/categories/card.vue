<template>
  <div class="h-100">
     <div class="card m-auto ">
    <img
      class="card-img w-75 justify-content-between m-auto"  src="./product.png"
      alt=""
    />
    <div class="card-title">{{ products.name }}</div>
    <!-- <div class="card-title">{{ products.name }}</div> -->
    <br />
    <div class="card-price">{{ products.desc }}</div>
  </div>
  </div>
 
</template>

<script>
import "@/assets/dist/css/bootstrap.min.css";
export default {
    props: ["products"]
};
</script>

<style scoped>
.card {
  width: 160px;
  height: 160px;
  border: 1px solid;
}

.card-img {
  width: 75%;
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
