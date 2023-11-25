<template>
    <div class="all w-[1236px] relative h-fit border-2 border-black border-solid m-auto mt-6">
        <h1 class="text-[#243673] text-[22px] font-normal px-[80px] mt-6">Section 5 - Document requirement (only in pdf file
            )</h1>
        <Loading v-if="isLoading" />
        <div v-if="!isLoading">
            <div class="px-[80px] py-[30px]">

                <div
                    class="information1 px-[48px] w-[1074px] h-[569px] py-[50px] flex-shrink-0 border-2 border-[#707070] border-solid">

                    <div class=" leading-[40px] pb-[60px] w-full flex-shrink-0">
                        <p> a. CV with a photo
                            ...................................................................................................................................................................
                            1 copy </p>
                        <p> b. Baccalaureate or equivalent diploma
                            *...............................................................................................................................
                            1 copy </p>
                        <p> c. Bachelor degree, engineer degree or equivalent degree
                            *................................................................................................
                            1
                            copy </p>
                        <p> d. Complete transcripts (1st year to final year) of obtained degree
                            *................................................................................... 1 copy </p>
                        <p> e. Certificate of language proficiency
                            .....................................................................................................................................
                            1 copy </p>
                        <p> f. Enclosed recommendation letters (from supervisor/ professor/lecturer)
                            ......................................................................... 1 copy </p>
                        <p> g. Motivation letter
                            .....................................................................................................................................................................
                            1 copy </p>
                        <p> h. Additional documents required by each program (if any) </p>
                    </div>


                    <div class="py-[13.5px] border-t-2 border-[#707070]">

                        <p class="text-red-600">
                            Note:
                        </p>
                        <p class="text-red-600">
                            * All Submitted documents be must be certified copies.
                        </p>
                        <p class="text-red-600">
                            If this is a re registration, please submit only the updated documents
                        </p>
                        <p class="text-red-600">
                            Please do not refresh the page during file submission, otherwise all files will be lost.
                        </p>
                    </div>
                </div>

            </div>

            <form @submit.prevent="submit">
                <div class="px-[80px] py-[60px]">
                    <div class="flex justify-between">
                        <h1 class="text-[#243673] text-[28px] font-bold"> File Submission Here </h1>
                        <div>
                            <p class="text-[#707070] font-semibold text-[20px]">Maximun file size:10MB, maximum</p>
                            <p class="text-[#707070] font-semibold text-[20px]">number of 8 </p>
                        </div>
                    </div>

                    <div class="upload-box px-[40px] py-[20px]">
                        <!-- <p> Upload your file here</p> -->
                        <div class="py-[25px] px-[25px] bg-[#E9F0FF]">
                            <form class="px-[70px] py-[70px] text-center border-dashed border-[#6892F1] border-4 bg-white">
                                <input class="file-input" id="file-input" type="file" name="file" ref="fileInput" hidden
                                    multiple @change="uploadFile" />
                                <div class="icon text-[#243673] py-[20px]" @click="triggerFileInput($event)">
                                    <i class="fa-solid fa-cloud-arrow-up icon text-[40px]" aria-hidden="true"></i>
                                </div>
                                <p class="text-[#243673]"> You can drag and drop file here </p>
                                <p class="text-[#243673]"> or click to upload </p>
                            </form>
                        </div>

                        <!-- display files upload area -->
                        <section class="loading-area flex-shrink-0" v-if="showProgress">
                            <li v-for="(file, index) in files"
                                class="row list-none h-[80px] bg-[#E9F0FF] px-[20px] py-[20px] mt-[50px] rounded-[10px] flex justify-between items-center gap-[15px]">
                                <!-- files icon -->
                                <i class="fa-solid fa-file-lines text-[30px]"></i>
                                <div class="content w-full ">
                                    <div class="details text-[16px] flex items-center justify-between gap-[400px]">
                                        <span class="name"> {{ file.name }} </span>

                                        <!-- the idea  v-if="file.loading > 5" is to prevent the progress bar to display if it's lower than 5% -->
                                        <span class="percent" v-if="file.loading > 5">{{ file.loading }}%</span>

                                    </div>
                                    <div class="loading-bar h-[6px] bg-[#ffff] rounded-[30px]">
                                        <div class="loading h-full w-[20%] bg-[#243673] rounded-[30px]"
                                            :style="{ width: file.loading + '%' }"></div>
                                    </div>
                                </div>
                            </li>
                        </section>

                        <section class="uploaded-area h-max-[232px] overflow-y-scroll mt-[20px]">
                            <li v-for="(file, index) in uploadFiles" :key="index"
                                class="row flex justify-between items-center list-none bg-[#E9F0FF] px-[20px] py-[10px] rounded-[10px] mb-[10px]">

                                <div class="content-upload  flex justify-between items-center gap-[20px]">
                                    <i class="fa-solid fa-file-lines text-[30px]"></i>
                                    <div class="details flex flex-col">
                                        <span id="file-input" class="name">
                                            <button @click.prevent="openFileInNewTab(file)"> {{ file.fileName }} </button>
                                        </span>

                                        <span class="size"> {{ file.size }} </span>
                                    </div>
                                </div>

                                <i class="fa-solid fa-xmark" @click="removeFile(index)"></i>

                            </li>
                        </section>
                    </div>

                    <!-- alert message -->
                    <!-- Display a message if the file upload limit is exceeded -->
                    <div v-if="maxFileUploadExceeded" class="px-[40px] max-upload-message text-red-600">
                        You have exceeded the maximum limit of 8 files.
                    </div>

                </div>

                <!-- checkbox -->
                <!-- <label> I declare that all information provided is true, complete and accurate to the best of my belief and knowledge,
         and  that I have not willfully suppressed any material fact.</label> -->
                <div class="px-[120px]">
                    <div class=" py-[30px] flex gap-[20px]  justify-between border-t-[1px] border-gray-700 border-solid">
                        <input type="checkbox" v-model="declaration" required class="mt-[5px]">
                        <p class="font-medium"> I declare that all information provided is true, complete and accurate to
                            the
                            best of my belief and
                            knowledge,
                            and that I have not willfully suppressed any material fact.
                        </p>
                    </div>

                </div>


                <!-- button -->
                <div class="flex justify-between mt-[30px] px-[80px] mb-8">

                    <!-- <button type="button" @click="uploadAndNavigate"
                        class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold hover:bg-[#4fe361] hover:text-[#ffffff] hover:border-[#4fe361]">Save
                        Draft</button> -->
                    <a>
                        <button type="button" @click="previousPage"
                            class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Previous</button>
                    </a>
                    <div class=" flex  gap-6">
                        <!-- <a>
                            <button type="button" @click="previousPage"
                                class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Previous</button>
                        </a> -->
                        <button type="submit"
                            class="border-[1px] border-[#243673] border-solid bg-[#243673] py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold hover:bg-[#ffffff] hover:text-[#243673]">Submit</button>

                    </div>
                </div>

                <!-- Display the custom alert with OK and Cancel buttons -->
                <div>
                    <p>Refresh the page to trigger the confirmation alert:</p>
                    <button onclick="handleUnloadChoice('ok')">OK</button>
                    <button onclick="handleUnloadChoice('cancel')">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</template>

<style>
.uploaded-area::-webkit-scrollbar {
    width: 0px;
}
</style>

<script>
import axios from 'axios';
import Loading from '../../components/Loading.vue';
import saveDraftForm from '../../libs/apis/saveDraftForm';

export default (await import('vue')).defineComponent({
    data() {
        return {
            isLoading: false,
            declaration: false,

            files: [],
            uploadFiles: [],
            selectedFiles: [],
            showProgress: false,
            formData: new FormData(),
            fileName: '',
            maxFileUploadExceeded: false,
        };
    },
    mounted() {

        window.addEventListener('beforeunload', this.handleBeforeUnload);

        //mounted to dusplay in frontend by getting it from vuex
        // if (this.uploadFiles.length === 0) {
        //     const uploadedFiles = this.$store.getters.uploadedFiles;
        //     this.uploadFiles = uploadedFiles
        //         .filter(file => file.content !== null)
        //         .map(file => ({
        //             fileName: file.name,
        //             size: file.size
        //         }));
        // }
    },
    destroyed() {
        // Remove the event listener when the component is destroyed to prevent memory leaks
        window.removeEventListener('beforeunload', this.handleBeforeUnload);
    },

    methods: {
        previousPage() {
            this.$router.push('/applicant/form/work-experience')
        },

        triggerFileInput(event) {
            event.preventDefault();
            this.$refs.fileInput.click();
        },

        handleBeforeUnload(event) {
            const confirmationMessage = 'Files will be lost, Are you sure you want to refresh the page?';

            // Set a custom confirmation message
            event.returnValue = confirmationMessage;
        },


        //temporary store selected files defines an upload file in a vue
        uploadFile(event) {
            const fileList = event.target.files;
            if (fileList.length === 0)
                return;
            if (this.selectedFiles.length + fileList.length > 8) {
                this.maxFileUploadExceeded = true;
                return;
            }
            // StoredFiles is a var to use with, vuex Retrieve files from Vuex state 
            let storedFiles = this.$store.state.uploadedFiles || [];
            for (let i = 0; i < fileList.length; i++) {
                const file = fileList[i];
                // Generate a name to display in the UI
                const fileName = (file.name.length >= 12) ? file.name.substring(0, 13) + '... .' + file.name.split('.')[1] : file.name;
                // Validation
                const allowedTypes = ['png', 'jpg', 'pdf', 'jpeg'];
                const fileType = file.name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(fileType)) {
                    alert('Invalid file type. Allowed types: png, jpg, mp4, pdf, jpeg');
                    continue; // Skip this file
                }
                const fileSize = (file.size < 1024) ? file.size + 'KB' : (file.size / (1024 * 1024)).toFixed(2) + 'MB';
                //add valid file into selectedFiles to keeps track of it
                this.selectedFiles.push(file);
                // Create a new file object with initial values 
                const newFile = { name: fileName, loading: 0 };
                // Add the file to the files array to display progress in the ui
                this.files.push(newFile);
                this.showProgress = true; // Display the progress bar in the UI while uploading
                // Append the new file to the existing storedFiles array
                // storedFiles.push({ name: fileName, content: null, size: fileSize,isSave:false });

                storedFiles.push({ name: fileName, content: null, size: fileSize });
                // Read the file as a base64 string in order to save in local storage
                const reader = new FileReader();
                reader.onload = (e) => {
                    const base64File = e.target.result;
                    const fileIndex = storedFiles.findIndex(f => f.name === fileName);
                    if (fileIndex !== -1) {
                        // Update the content of the file in storedFiles
                        storedFiles[fileIndex].content = base64File;
                    }
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 15; // Simulate progress update
                        if (progress >= 100) {
                            clearInterval(interval);
                            // const fileSize = (file.size < 1024) ? file.size + 'KB' : (file.size / (1024 * 1024)).toFixed(2) + 'MB';
                            this.uploadFiles.push({ fileName: fileName, size: fileSize });
                            this.files = []; // Clear the files array after finishing uploadFiles
                            this.showProgress = false; // Hide the progress bar
                        }
                        else {
                            const fileIndex = this.files.findIndex(fileObj => fileObj.name === fileName);
                            if (fileIndex !== -1) {
                                this.files[fileIndex].loading = progress;
                            }
                        }
                    }, 500);
                };
                reader.readAsDataURL(file);
            }
        },
        base64toBlob(base64, contentType = '') {
            const byteCharacters = atob(base64);
            const byteArrays = [];
            for (let offset = 0; offset < byteCharacters.length; offset += 512) {
                const slice = byteCharacters.slice(offset, offset + 512);
                const byteNumbers = new Array(slice.length);
                for (let i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }
                const byteArray = new Uint8Array(byteNumbers);
                byteArrays.push(byteArray);
            }
            return new Blob(byteArrays, { type: contentType });
        },
        openFileInNewTab(file) {
            //getters are used to perform manipulation on the file before accessing it
            const uploadedFiles = this.$store.getters.uploadedFiles;
            const storedFile = uploadedFiles.find(f => f.name === file.fileName);
            if (storedFile && storedFile.content) {
                const contentType = 'application/pdf';
                // Convert the base64 content to a Blob
                const base64Content = storedFile.content.replace(/^data:[^;]+;base64,/, '');
                const blob = this.base64toBlob(base64Content, contentType);
                // Create a URL for the Blob
                const blobUrl = URL.createObjectURL(blob);
                window.open(blobUrl, '_blank');
            }
            else {
                console.log('File or content is missing');
            }
        },

        // Method to remove a file from the files array problems lies in synchronization when deleting files

        removeFile(index) {
            const removedFile = this.uploadFiles.splice(index, 1)[0];
            const removedFileName = removedFile.fileName;
            // Remove the file from selectedFiles array
            const selectedFileIndex = this.selectedFiles.findIndex(file => file.name === removedFileName);
            //check if a valid was found
            if (selectedFileIndex !== -1) {
                //delete the selectedFileIndex and the second argument only 1 files is removed
                this.selectedFiles.splice(selectedFileIndex, 1);
            }
            // Update the files array for UI display by filtering out the removed file
            this.files = this.files.filter(fileObj => fileObj.name !== removedFileName);
            this.$store.commit('removeFileByName', removedFileName);
            console.log('remove files:', this.selectedFiles);
            // update this.uploadFiles after a removal of file in the this.selectedFiles
            setTimeout(() => {
                this.uploadFiles = this.selectedFiles.map(file => ({
                    fileName: file.name,
                    size: (file.size < 1024) ? file.size + 'KB' : (file.size / (1024 * 1024)).toFixed(2) + 'MB'
                }));
            }, 0);
        },

        // async uploadAndNavigate() {
        //     if (this.selectedFiles.length > 0) {
        //         // Create a new FormData instance
        //         // const formData = new FormData();
        //         // formData.append("user_id", this.$store.state.user?.id);
        //         // this.selectedFiles.forEach(file => {
        //         //     formData.append("files[]", file);
        //         // });

        //         let stored = this.$store.state.uploadedFiles || [];
        //         this.$store.commit('updateStoredFiles', stored);


        //         var resData = this.$store.getters.uploadedFiles;
        //         const documentInDB = await axios.get(`http://localhost:8000/api/uploaddocument/search/${this.$store.state.user?.id}`);
        //         const res = documentInDB.data;

        //         if (resData.length > 0) {
        //             var toDeleteDocumentID = [];
        //             var existDocumentID = [];

        //             for (let i = 0; i < res.length; i++) {
        //                 const deleteDocument = await axios.delete(`http://localhost:8000/api/documents/${res[i].id}`);


        //             }
        //             const response = await axios.post('http://localhost:8000/api/upload-document', formData);
        //             alert('Safe file successfully');

        //             this.$store.commit('updateStoredFiles', resData);

        //         }
        //     }
        // },

        async submit() {
            this.isLoading = true;
            if (this.selectedFiles.length > 0) {
                // Create a new FormData instance
                const formData = new FormData();
                formData.append("user_id", this.$store.state.user?.id);
                this.selectedFiles.forEach(file => {
                    formData.append("files[]", file);
                });

                // let stored = this.$store.state.uploadedFiles || [];
                // this.$store.commit('updateStoredFiles', stored);


                // var resData = this.$store.getters.uploadedFiles;
                // const documentInDB = await axios.get(`http://localhost:8000/api/uploaddocument/search/${this.$store.state.user?.id}`);
                // const res = documentInDB.data;

                // if (resData.length > 0) {
                //     var toDeleteDocumentID = [];
                //     var existDocumentID = [];

                //     for (let i = 0; i < res.length; i++) {
                //         const deleteDocument = await axios.delete(`http://localhost:8000/api/documents/${res[i].id}`);


                //     }

                //     this.$store.commit('updateStoredFiles', resData);

                // }

                const response = await axios.post('http://localhost:8000/api/upload-document', formData);
                this.selectedFiles = []
                alert('Safe file successfully');
            }

            await saveDraftForm();

            const applicantData = {
                applicant_status: 'complete',
                declaration: this.declaration,
            }

            const applicant_id = this.$store.state.user?.applicant_id;

            const response = await axios.put(`http://localhost:8000/api/applicantdetails/${applicant_id}`, applicantData)
            console.log('applicant update success ', response.data)

            this.isLoading = false
            this.$router.push(`/applicant/admission`);
        },


    },
    components: { Loading }
})
</script>

