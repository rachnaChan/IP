<template>
    <div class="all w-[1236px] relative h-fit border-2 border-black border-solid m-auto mt-6 px-[50px]">
        <div class="header flex justify-between  pt-[40px]">
            <div class="left-header text-[#243673]">
                <h1 class="font-semibold text-[24px]">Applicant's Submission</h1>
                <small class="text-[12px]">Submission > All Sumission > view details</small>
            </div>
            <div class="rigth-header flex">
                <h1 class="text-[18px] text-[#243673] font-bold">Lay Vicha</h1>
                <div class="text-[#243673]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <!-- 
        <div class="flex justify-end gap-3">
            <button>
                <svg class="rounded border-solid border-2 border-blue-500 w-9 h-8 text-black"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
            </button>
            <button class=" text-white rounded border-[1px] border-[#2770AD] border-solid bg-[#2770AD] p-1">
                Evaluate
            </button>
        </div> -->

        <div
            class="information-language border-2 border-solid border-gray-400 my-[30px] shadow-md px-[50px] flex justify-between w-full ">
            <div class="subject w-[40%] mt-5">
                <h1 class="font-semibold text-[28px] text-[#243673]">Subjects</h1>
                <p class="py-3">Transcript (40 points) : </p>
                <p class="py-3">Language (py-20 points) :</p>
                <p class="py-3">CV (5 points) : </p>
                <p class="py-3">Recommend Letter (5 points) :</p>
                <p class="py-2">Motivation Letter(10 points) : </p>
                <p class="py-2">Related Experience(10 points) : </p>
                <p class="py-2">Educational Background(10 points) : </p>
            </div>

            <div class="scoring w-[50%] mt-5 mb-8 px-7">
                <h1 class="font-semibold text-[28px] text-[#243673]">Scoring</h1>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input py-2">
                </div>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input py-2">
                </div>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input py-2">
                </div>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input py-2">
                </div>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input py-2">
                </div>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input  py-2">
                </div>
                <div class="input">
                    <input type="number" class="w-[350px] custom-input py-2">
                </div>

            </div>


        </div>
        <!-- button -->
        <div class="flex justify-between mt-[30px] mb-8">
            <button type="button"
                class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#fff] font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Close</button>
            <div class=" flex gap-6">
                <button type="button"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Submit</button>
                <!-- <button type="submit"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Next</button> -->
            </div>

        </div>
    </div>
</template>
<style>
/* Custom CSS */
/* .custom-input {
 
    width: 100%;
    border: none;
    outline: none;
    border-bottom: 2px solid black;
} */

.custom-input {
    width: 100%;
    border-left: none !important;
    border-right: none !important;
    border-top: none !important;
    border-bottom: 2px solid black !important;
    outline: none !important;
    /* Remove the default focus outline */
}
</style>