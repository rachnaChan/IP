
<template>
    <div>
        <div class=" rounded-bottom mt-5 fonts" style="background-color: pink; width: 400px; height: 30px;">
            <h5 class="fs-5 text-center mt-4">Home > Product's Info > Product title</h5>
        </div>
        <div class="justify-content-between m-auto d-flex">
            <div class=" m-auto">
                <div>
                    <div>
                        <!-- product image -->
                        {{ data[index].image }}
                        <!--<img src="{{data[index]['image']}}" alt="">-->
                        <p>{{ data[index]["name"] }}</p>
                        <hr />
                    </div>
                </div>
                <div class="d-flex m-auto justify-content-between">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div>
                <div class="d-flex m-auto justify-content-between">
                    <p>{{ data[index]["name"] }}</p>
                    <p>{{ data[index]["price"] }}</p>
                </div>
                <hr>
                <div>
                    <div class="d-flex m-auto justify-content-between "> 
                        <p>Size</p> 
                        <p class="text-decoration-underline">Sizing Chart</p>
                    </div>
                    <div> 
                    <div class="d-flex m-auto justify-content-between">
                        <button></button>
                        <button></button>
                        <button></button>
                    </div>
                    <div>

                    </div>

                    </div>
                   
                </div>
            </div>
            
        </div>
    </div>
</template>
  
<script >
import { RouterLink } from 'vue-router'
export default{
    name: 'productdetail',

}
</script>
  
<style lang="scss" scoped>
* {
    box-sizing: border-box;
}

.fonts {
    font-family: "papyrus";
    font-size: 2.8rem;
}
</style>
  
  
  