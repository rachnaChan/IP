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
        </div>

        <!-- form list all Information -->
        <div class="information-language border-2 border-solid border-gray-400 my-[30px] shadow-md  px-[50px]">
            <h1 class="text-[22px] font-medium mt-11 ">IV. Work Experiences </h1>
            <h1 class="text-[20px] font-medium mt-6 px-7">List of working experiences in order</h1>
            <div class="overflow-x-auto mt-7 bg-[#f5f6fa] shadow-md">
                <table class="min-w-full ">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-2 border-gray-300  text-left font-medium  text-[20px]  ">
                                From</th>
                            <th class="px-6 py-3 border-2 border-gray-300  text-left font-medium text-[20px]  ">
                                To</th>
                            <th class="px-6 py-3 border-2 border-gray-300  text-left font-medium text-[20px]  ">
                                Institution / Location</th>
                            <th class="px-6 py-3 border-2 border-gray-300  text-left font-medium text-[20px]  ">
                                Title / Position</th>
                        </tr>
                    </thead>
                    <tbody class=" text-[18px] bg-[#f5f6fa]">
                        <tr>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                2017
                            </td>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                2018
                            </td>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                JAKADA.JTE
                            </td>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                Manager
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                2018
                            </td>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                2019
                            </td>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                JAKADA.JTE
                            </td>
                            <td class="px-6 py-4 border-2 border-gray-300">
                                Manager
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div>
                <h1 class="text-[20px] font-medium mt-6 px-7">Describe your experiences</h1>
                <p class="mt-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                    been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum.</p>
            </div>

            <h1 class="text-[22px] font-medium mt-11 ">V. Document Requirement </h1>

            <section class="loading-area flex-shrink-0 mt-5">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">CV-Uploads</span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>

            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">Baccalaureate-Diploma-Uploaded </span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">Bachelor-Diploma-Uploaded</span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">Transcripts(1st year to final year)-Uploaded</span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">English-Certificate-Uploaded</span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">French-Certificate-Uploaded </span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">Chinese-Certificate-Uploaded </span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">Recommendation-Letter-Uploaded </span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>
            <section class="loading-area flex-shrink-0">
                <li
                    class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[15px] mt-[10px] rounded-[10px] flex justify-between items-center gap-[15px]">
                    <!-- files icon -->
                    <i class="fa-solid fa-file-lines text-[30px] text-[#243673]"></i>
                    <div class="content w-full ">
                        <div class="details text-[16px] flex items-center gap-[20px]">
                            <span class="name">Motivation-Letter-Uploaded </span>
                            <p>62.31 KB</p>

                            <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->


                        </div>
                        <!-- <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                            <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"></div>
                        </div> -->
                    </div>
                </li>
            </section>

            <div>
                <h1 class="text-[22px] font-medium mt-11 ">V. Document Requirement </h1>
                <p class="px-[20px] mt-6 mb-7">I declare that all information provided is true, complete and accurate to the
                    best of my belief and
                    knowledge, and that I have not willfully suppressed any material fact.</p>
            </div>


        </div>


        <!-- Total Score -->
        <div class="px-[30px] ">
            <div class="flex gap-[180px] py-4">
                <h1 class="text-[24px] text-[#243673] font-semibold">Total Score : </h1>
                <h1 class="text-[20px]">90 pionts</h1>
            </div>


            <div class="flex gap-[222px] py-4">
                <h1 class="text-[24px] text-[#243673] font-semibold">Remark : </h1>
                <h1 class="text-[20px]">You can add your comment here for your student</h1>
            </div>

            <div class="flex gap-[75px] py-4">
                <h1 class="text-[24px] text-[#243673] font-semibold">Remark Date & Time : </h1>
                <h1 class="text-[20px]">23-01-2013 08:45:12 AM</h1>
            </div>


            <div class="flex gap-[234px] py-4">
                <h1 class="text-[24px] text-[#243673] font-semibold">Status : </h1>
                <h1 class="text-[20px]">Selected</h1>
            </div>

        </div>
        <div class="line w-full border-2 border-solid border-black"></div>

        <!-- button -->
        <div class="flex justify-between mt-[30px] mb-8">
            <button type="button"
                class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#fff] font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Close</button>
            <div class=" flex gap-6">
                <button type="button"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Previous</button>
                <!-- <button type="submit"
                    class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Next</button> -->
            </div>

        </div>
    </div>
</template>