<template>
    <nav>
        <div class="w-100 d-flex m-auto justify-content-between">
            <!-- style="background-color: rgb(139, 138, 135);" -->

            <div class="mt-4 w-50 justify-content-between d-flex mx-3">
                <div class="mx-3">
                    <h4>Shop</h4>

                    <div class="d-flex">
                        <div>
                            <p>Cake</p>
                            <p>Cookies</p>
                            <p>Cupcakes</p>
                        </div>
                        <div class="mx-3">
                            <p>Donut</p>
                            <p>Drink</p>
                            <p>Gummy</p>
                        </div>
                    </div>

                </div>

                <div>
                    <h4>Help</h4>
                    <p>Contact Us</p>

                </div>

                <div>
                    <h4>About</h4>
                    <p>Our Store</p>

                </div>
            </div>


            <div class="w-25">
                <div class="fonts mt-4">
                    <h5>Stay in Touch!! Join our Newletter</h5>
                </div>

                <div class="input-group">
                    <input type="email" class="input" id="Email" name="Email" placeholder="abc@gmail.com" autocomplete="off"
                        required autofocus="autofocus">
                    <input class="button--submit" value="Subscribe" type="submit">
                </div>
            </div>




        </div>


    </nav>
</template>
<script setup>
import { RouterLink } from 'vue-router'
</script>

<style lang="scss" scoped>
* {
    box-sizing: border-box;
}

nav {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #dbbf88;
    // background: linear-gradient(to right, aliceblue, rgb(234, 206, 211), aliceblue, rgb(234, 206, 211), aliceblue);
    padding: 1rem 2rem;
    // height: 120px;

    p {
        font-family: 'Dosis';
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input {
        min-height: 50px;
        max-width: 150px;
        padding: 0 1rem;
        color: #fff;
        font-size: 15px;
        border: 1px solid gray;
        border-radius: 6px 0 0 6px;
        background-color: transparent;
    }

    .button--submit {
        min-height: 50px;
        padding: .5em 1em;
        border: none;
        border-radius: 0 6px 6px 0;
        background-color: gray;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
        transition: background-color .3s ease-in-out;
    }

    .button--submit:hover {
        background-color: #2cac8c;
    }

    .input:focus,
    .input:focus-visible {
        border-color: #2cac8c;
        outline: none;
    }

    .fonts{
        font-family: 'Dokdo';
    }


}
</style>