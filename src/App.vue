<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Headers from './component/Headers.vue';
import Footers from './component/Footers.vue';


</script>

<template>
  <Headers />
  <RouterView />
  <Footers />
</template>

<style scoped lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Freehand&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@300;400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Dokdo&display=swap');
</style>
