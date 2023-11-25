<template>
    <div class="all w-[1236px] relative h-fit border-2 border-black border-solid m-auto mt-6">
        <h1 class="text-[#243673] text-[25px] font-normal px-[80px] mt-6">Section 6 - Applicant's Declaration</h1>


        <div class="px-[80px] py-[60px]">

            <form action="">
                <!-- <input class="information1 px-[45px] w-[1088px] shadow-[0_3px_3px_2px_rgba(0,0,0,0.16)] rounded-[15px] backdrop-opacity-[1.5] text-left py-[0px] h-[281px] flex justify-between"> -->
                <textarea
                    class="information1 px-[45px] w-[1088px] shadow-[0_3px_3px_2px_rgba(0,0,0,0.16)] rounded-[15px] backdrop-opacity-[1.5] text-left py-[20px] h-[281px] flex justify-between"> </textarea>
            </form>

        </div>
        <div class="text-[#243673] text-base px-[80px]">
            <p>Email: graduate@itc.edu.kh </p>
            Mailbox: Room B-110, P.O.BOX 86, Russian Federation Boulevard, Phnom Penh, Cambodia
        </div>
        <div class="text-red-600 text-center py-[103px]">
            <p  class="text-red-600 text-center py-[103px]"> Deadline: September 30th, 2022 </p>
            <p>Incomplete applications are inadmissible.</p>
        </div>

        <!-- button -->
        <div class="flex justify-between mt-[30px] px-[80px] mb-8">
            <button
                class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold hover:bg-[#4fe361] hover:text-[#ffffff] hover:border-[#4fe361]">Save
                Draft</button>

            <div class=" flex gap-6">
                <router-link to="/applicant/form/upload-document">
                    <button type="button"
                        class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Previous</button>
                </router-link>
                <button type="submit"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Next</button>
            </div>

        </div>
    </div>
</template>