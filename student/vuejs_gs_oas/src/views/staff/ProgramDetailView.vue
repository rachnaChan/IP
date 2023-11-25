<template>
    <div class="all w-[943px] relative h-full border-2 border-black border-solid m-auto mt-6">
        <div class="flex justify-between px-[50px] py-[30px]">
            <div>
                <h1 class="text-[#243673] font-bold text-[24px]">Program Information</h1>
                <small class="text-[#243673] font-medium">Program Information > All Courses</small>
            </div>
            <div class="flex justify-between items-center gap-[15px]">
                <h1 class="text-[18px] text-[#243673] font-bold">Lay Vicha</h1>
                <div class="text-[#243673]">
                    <i class="fa-solid fa-circle-user text-[30px]"></i>
                </div>

            </div>
        </div>

        <div class="flex justify-between">

            <div class="flex justify-between gap-[30px] px-[50px]">
                <div id="allSubmission" class="cursor-pointer">
                    <h1 class="text-[#CFCFCF] font-semibold hover:text-[#243673] hover:underline">All Courses</h1>
                </div>
                <div id="updated" class="cursor-pointer">
                    <h1 class="text-[#CFCFCF] font-semibold hover:text-[#243673] hover:underline">All Students</h1>
                </div>
                <div id="pending" class="cursor-pointer">
                    <h1 class="text-[#CFCFCF] font-semibold hover:text-[#243673] hover:underline">All teachers</h1>
                </div>
            </div>



            <!-- button search -->
            <div class="px-8 py-6 pt-0">
                <form class="flex items-center justify-end ">

                    <div class=" flex overflow-hidden border border-[#243673]  rounded-xl">
                        <input type="text" class="border-none outline-none py-[7px] text-sm w-[350px] pl-[10px]"
                            placeholder="Search by name, id, role, username, phone number">
                        <button class="bg-[#243673] px-2 text-white ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>


        <!-- inforamtion about each Program -->
        <div class="w-[835px] border-2 border-[#243673] rounded-3xl m-auto px-[30px]">
            <h1 class="mt-[30px] text-[20px] font-semibold">Data Science</h1>
            <small class="text-[#707070] text-[14px]">Master’s degree</small>

            <div class="flex gap-[17px] mt-[16px]">
                <div
                    class="border border-solid border-[#243673] rounded-xl w-[81px] h-[68px] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="37" viewBox="0 0 38 37" fill="none">
                        <path
                            d="M19 0L18.3073 0.35L2.47396 8.2L1.58333 8.65V11.4H36.4167V8.65L35.526 8.2L19.6927 0.35L19 0ZM19 3.6L28.3021 8.2H9.69792L19 3.6ZM4.75 13V29H3.16667V32.2H34.8333V29H33.25V13H30.0833V29H26.9167V13H23.75V29H20.5833V13H17.4167V29H14.25V13H11.0833V29H7.91667V13H4.75ZM0 33.8V37H38V33.8H0Z"
                            fill="#243673" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-[20px] font-semibold">Institute of Technology of Cambodia</h1>
                    <small class="text-[#707070] text-[14px]">Phnom Penh, Cambodia</small>
                </div>
            </div>

            <div class="line w-[780px]  border-2 border-solid border-gray-400 mt-[38px] mb-9"></div>

            <div class="flex gap-10 text-[#707070] text-[14px] font-medium">
                <div>
                    <h1>Enrollment date </h1>
                    <h1 class="py-3">15-August-2023</h1>
                </div>
                <div>
                    <h1>Study Type </h1>
                    <h1 class="py-3">Full time</h1>
                </div>
                <div>
                    <h1>Attendance </h1>
                    <h1 class="py-3">On Campus</h1>
                </div>
            </div>


            <!-- about Program -->
            <div class=" border-2 border-[#243673] rounded-2xl px-6 py-[30px] m-auto mt-[30px] mb-[130px]">
                <h1 class="text-[18px] tracking-[0.72px] font-medium">About :</h1>
                <p class="text-[#707070] font-medium text-[14px]">A Master's in Data Science is an advanced program spanning 1 to 2 years that trains students in using
                    data to make informed decisions. It combines computer science, statistics, and domain expertise. The
                    curriculum covers statistics, machine learning, programming (Python/R), big data technologies
                    (Hadoop/Spark), data mining, visualization, ethics, and domain-specific applications. A capstone project
                    showcases skills. Graduates can pursue roles like Data Analyst, Scientist, ML Engineer, and more.
                    Prerequisites include a bachelor's in relevant fields, strong quantitative skills, and programming
                    abilities. The program equips students with the skills to analyze complex data challenges across
                    industries.</p>
            </div>
        </div>
    </div>
</template>