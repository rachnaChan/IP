<template>
   <div class="flex items-center justify-center h-screen">
    <span class="loader"></span>
  </div>
</template>
<style>
.loader {
  width: 80px;
  height: 80px;
  display: inline-block;
  position: relative;
}
.loader::after,
.loader::before {
  content: '';
  width: 80px;
  height: 80px;
  border: 3px solid #000000;
  position: absolute;
  left: 0;
  top: 0;
  box-sizing: border-box;
  animation: rotation 2s ease-in-out infinite;
}
.loader::after {
  border-color: #FF3D00;
  animation-delay: 1s;
}

@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 

</style>