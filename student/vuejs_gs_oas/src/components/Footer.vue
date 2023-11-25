<script>

export default {
    methods: {
        openGoogleMap() {
            // Replace with the latitude and longitude of your specific location
            const latitude = 11.5703139;
            const longitude = 104.8980595;

            // Create a new Google Maps URL with the specified location
            const mapUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;

            // Open the URL in a new tab or window
            window.open(mapUrl, '_blank');
        },
    },
}
</script>

<template>
    <div class="h-[335px] bg-[#243673] py-[82px] px-[90px]">
        <div class="flex gap-[203px]">
            <div class="text-white">
                <div class="font-bold text-[32px] w-[400px] pb-4 mb-4 border-b-2 border-white border-solid">ITC Campus</div>
                <div class="mb-4">Office of the Registrar, Institute of Technology of Cambodia, <span @click="openGoogleMap"
                        class="underline">Russian Confederation Boulevard, P.O. Box 86, Phnom Penh, Cambodia</span></div>
                <div>
                    <span class="font-bold text-xl pr-5 border-r-2 border-white border-solid">Contact</span>
                    <span>
                        <a href="https://www.facebook.com/itckh" target="_blank">
                            <i
                                class="fa-brands fa-facebook-f bg-[#243673] text-white text-xl px-5 border-r-2 border-white border-solid"></i>
                        </a>
                    </span>
                    <span class="font-semibold text-xl px-5 border-r-2 border-white border-solid">info@itc.edu.kh</span>
                    <span class="font-semibold text-xl px-5">023 880 370</span>
                </div>
            </div>
            <div class="text-white">
                <div class="font-bold text-[32px] w-[400px] pb-4 mb-4 border-b-2 border-white border-solid">Graduate school
                </div>
                <div class="mb-4">Graduate School, A public higher education institution offering master & doctoral degrees
                    in field of engineering, <span class="underline">located in ITC Campus</span></div>
                <div>
                    <span class="font-bold text-xl pr-5 border-r-2 border-white border-solid">Contact</span>
                    <span>
                        <a href="https://www.facebook.com/itcgraduate" target="_blank">
                            <i
                                class="fa-brands fa-facebook-f bg-[#243673] text-white text-xl px-5 border-r-2 border-white border-solid"></i>
                        </a>
                    </span>
                    <span class="font-semibold text-xl px-5">graduate@itc.edu.kh</span>
                </div>
            </div>
        </div>
    </div>
</template>