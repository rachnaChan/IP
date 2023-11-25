
<script>
import axios from 'axios';

export default {

    data() {
        return {
            user: null,
            selectedFile: null,
            documents: [],
            currentDateTime: null,
            filename: null,
            documentId: null, // Store the selected document's ID
            file_type: '',
            file_path: null,
            fileURL: '',
            selectedFileType: null,
            activeNavItem: null,

        };
    },

    mounted() {
        this.fetchLoggedInUser();
        this.fetchDocuments();
        this.previewDocument();
        this.fetchInfoUser()

        setInterval(() => {
            this.currentDateTime = new Date();
        }, 1000)

    },

    computed: {
        filteredDocuments() {
            if (this.selectedFileType === '' || this.selectedFileType === 'null') {
                // Filter for documents with file_type=null or 'null'
                return this.documents.filter(document => !document.file_type || document.file_type === 'null');
            } else if (!this.selectedFileType) {
                return this.documents; // No filter, return all documents
            }

            // Filter documents by selected file type
            return this.documents.filter(document => document.file_type === this.selectedFileType);
        },
    },

    methods: {

        logout() {
            axios.post('http://localhost:8000/api/logout')
                .then(response => {
                    console.log(response.data);
                    this.$store.commit('setUser', null)
                    this.$store.commit('setToken', null)
                    this.$store.commit('setRole', null)
                    this.$router.push('/login');
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async fetchLoggedInUser() {
            try {
                const response = await axios.get('http://localhost:8000/api/student/info'); // Change this URL if needed
                // console.log(response.data);
                this.user = response.data;
                this.programs = response.data;
                this.courses = response.data;

            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },

        fetchInfoUser() {
            const userId = this.$route.params.userId;
            console.log('User ID:', userId); // Check the student_id

            axios.get(`http://localhost:8000/api/student/info/${userId}`)
                .then(response3 => {
                    // this.user = response3.data[0];
                    this.programs = response3.data[0];
                    this.courses = response3.data[0];
                    this.student_details = response3.data[0];
                    // console.log(response3.data);
                })
                .catch(error => {
                    console.error('Error fetching courses:', error);
                });
        },

        getUserImageURL(user) {
            if (user.image) {
                const imageUrl = `http://localhost:8000/storage/${user.image}`;
                // console.log('Image URL:', imageUrl); // Log the image URL
                return imageUrl;
            } else if (user.image == null) {
                const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
                // console.log(imageAuto);
                return imageAuto;
            }
        },

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
        },

        setDocumentId(documentId) {
            // Set the documentId when a document is selected for replacement
            this.documentId = documentId;
        },

        fetchDocuments() {
            axios.get(`http://localhost:8000/api/student/getFile`)
                .then(response => {
                    this.documents = response.data;
                    // console.log(this.documents);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        async deleteDocument(documentId) {
            try {
                await axios.delete(`http://localhost:8000/api/student/deleteDoc/${documentId}`);
                this.$router.go(0);

                // Handle successful deletion here, e.g., removing the document from the list
            } catch (error) {
                console.error('Error deleting document:', error);
            }
        },

        uploadFile() {

            const docInfo = {
                file_type: this.file_type,

            }
            const formData = new FormData();

            Object.entries(docInfo).forEach(([key, value]) => {
                console.log('Appending:', key, value);
                formData.append(key, value);
            });

            formData.append('file', this.selectedFile);

            axios.post('http://localhost:8000/api/student/uploadFile', formData)
                .then(response => {
                    // Handle success
                    console.log(response.data.message);
                    // this.$router.push('/student/document');
                    this.$router.go(0);
                })
                .catch(error => {
                    // Handle error
                    console.error(error);
                });
        },

        async updateFile(documentId) {

            const userFile = {
                filename: this.filename,
            }

            const formData = new FormData();
            Object.entries(userFile).forEach(([key, value]) => {
                console.log('Appending : ', key, value);
                formData.append(key, value);
            });

            if (this.selectedFile) {
                formData.append('file', this.selectedFile);
            }

            axios.post(`http://localhost:8000/api/student/updateFile/${documentId}`, formData)
                .then(response => {
                    // this.$emit('user-edited');
                    console.log(formData);
                    console.log(response.data);
                    console.log(response.data.message);
                    // Refresh the list of documents after updating
                    this.fetchDocuments();
                    // Clear the selected file
                    this.selectedFile = null;
                    this.$router.go(0);
                })

                .catch(error => {
                    console.log(error);
                })
        },

        previewDocument(file_path) {
            if (file_path) {

                fetch(`http://localhost:8000/api/student/previewFile/${file_path}`, {
                    headers: {
                        'Authorization': `Bearer ${this.$store.getters.token}`,
                    }
                }).then(res => {
                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }

                    // Read the response body as a Blob
                    return res.blob();
                }).then(blob => {
                    // Create an object URL for the Blob
                    const objectURL = URL.createObjectURL(blob);
                    this.fileURL = objectURL;

                    // Open the Blob URL in a new window or tab
                    // window.open(objectURL, '_blank');
                }).catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            }
        },

        filterDocuments(fileType) {
            this.selectedFileType = fileType; // Set the selected file type
        },

        
    },

};
</script>

<template>
    <div v-if="user">
        <div class="dashboard_ContainerFluid">
            <div class="row flex-nowrap">
                <div class="position-fixed col-lg-2 col-xl-2 bg-[#243673]" style="height: 700px; z-index: 3;">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 text-white">

                        <router-link :to="{ name: 'studentDashboard', params: { userId: user.student_id } }"
                            class="text-decoration-none">
                            <div
                                class="d-flex align-items-center pb-3 mt-2 mb-md-0 me-md-auto text-white text-decoration-none">
                                <div class="d-flex text-center align-items-center m-auto justify-content-center mx-5">
                                    <img src="../../../assets/img/GS_logo.png" alt="" class="img-fluid "
                                        style="width:6rem;">
                                    <img src="../../../assets/img/ITC_logo.png" alt="" class="img-fluid"
                                        style="width:6rem;">
                                </div>
                            </div>
                        </router-link>


                        <div class=" align-items-center ">


                            <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'programs' }]">
                                <router-link :to="{ name: 'studentCourse', params: { userId: user.student_id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-dashboard bx-rotate-180 fs-5 text-white'></i>
                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Program</span>
                                    </a>
                                </router-link>
                            </div>


                            <div class="nav-item mx-2">
                                <a href="#" class="nav-link align-middle px-0  mx-4">
                                    <i class='mx-2 bx bx-book-open fs-5 text-white'></i>
                                    <span class="lead ms-1 d-none d-sm-inline text-white fs-5">My
                                        Courses</span>
                                </a>

                                <div class="align-items-center m-auto mx-5 py-2 w-75">

                                    <li>
                                        <router-link :to="{ name: 'studentMyCourse', params: { userId: user.student_id } }"
                                            class="lead fs-6 text-decoration-none text-white"
                                            :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'approved' }]">
                                            Approved
                                        </router-link>

                                    </li>

                                    <li>
                                        <router-link
                                            :to="{ name: 'studentEnrollCourse', params: { userId: user.student_id, programId: programs.id } }"
                                            class="lead fs-6 text-decoration-none text-white"
                                            :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'enroll' }]">
                                            Enroll
                                        </router-link>

                                    </li>

                                    <li>
                                        <router-link
                                            :to="{ name: 'studentDraftCourse', params: { userId: user.student_id } }"
                                            class="lead fs-6 text-decoration-none text-white"
                                            :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'requested' }]">
                                            Requested
                                        </router-link>
                                    </li>
                                </div>
                            </div>

                            <div :class="['nav-item', 'type', 'btn', { 'active': activeNavItem === 'importantDate' }]">
                                <router-link :to="{ name: 'studentImportantDate', params: { userId: user.student_id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link align-middle px-0  mx-4">
                                        <i class='mx-2 bx bxs-calendar-event bx-rotate-180 fs-5 text-white'></i>

                                        <span
                                            class="lead ms-1 d-none d-sm-inline text-white fs-5 hover-overlay">Events</span>
                                    </a>
                                </router-link>
                            </div>

                            <div
                                :class="['nav-item', 'type', 'btn', 'bg-secondary', { 'active': activeNavItem === 'documents' }]">
                                <router-link :to="{ name: 'studentDocument', params: { userId: user.student_id } }"
                                    class="text-decoration-none">
                                    <a href="#" class="nav-link px-0 align-middle  mx-4">
                                        <i class='mx-2 bx bxs-file-doc fs-5 text-white'></i>
                                        <span class="lead ms-1 d-none d-sm-inline text-white fs-5">Documents</span></a>
                                </router-link>
                            </div>


                            <div class="nav-item">
                                <p class="lead mt-5 text-white fs-6  text">{{ currentDateTime }}</p>

                            </div>

                        </div>

                        <hr>
                    </div>
                </div>

                <div class="col custom-scrollbar justify-content-center overflow-scroll flex-nowrap"
                    style="height: 700px; margin-left: 15%;">
                    <div class="position-fixed h-18 d-flex justify-content-between bg-white"
                        style="z-index: 2; width: 80%; margin-left: 2%;">

                        <div class="w-75">
                            <p class="lead text-muted mx-5 mt-1 fs-2  "> Documents </p>
                            <li class="lead mx-5 fs-6 fw-bold">
                                <span @click="$router.push({ name: 'studentDashboard' })"
                                    class="lead text-[#243673] fs-6 fw-bold cursor-pointer">
                                    Dashboard
                                </span> > Document
                            </li>

                        </div>

                        <div class="d-flex bg-white ">
                            <div class="dropdown mt-3 " style="margin-left: 15%;">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none "
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="getUserImageURL(user)" ui:alt="user.name"
                                        class="rounded-circle img-fluid mx-5" style="width: 50px; height: 50px;">

                                </a>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow"
                                    aria-labelledby="dropdownUser1">
                                    <router-link :to="{ name: 'studentProfile', params: { userId: user.student_id } }"
                                        class="text-decoration-none">
                                        <li><a class="dropdown-item " href="#">Profile</a></li>
                                    </router-link>
                                    <li class="mt-1">
                                        <a href="#" class="dropdown-item " @click="logout">
                                            <span class="ms-1 d-none d-sm-inline">Logout</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div>
                                <i class='bx bx-bell fs-1 mt-3 mx-4  text-[#233673]'></i>
                                <div class=" dashboard_textBox mt-3 ">
                                    <button
                                        @click="$router.push({ name: 'studentDashboard', params: { userId: user.student_id } })"
                                        class="bg-[#243673] positon-relative rounded-2 border-1 h-8 w-100 text-white fw-bold ">
                                        Back

                                    </button>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="mt-5 py-4"></div>

                    <div class="m-auto h-auto mt-4 border-4 rounded-4 py-4 border-[#243673]"
                        style="width: 85%; z-index: 1;">

                        <div class="text-right mx-5">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                <i class='bx bx-add-to-queue text-[#243673] fs-1'></i>
                            </button>

                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog  modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title lead text-muted fs-3 text-center m-auto w-100"
                                                id="exampleModalLabel">Upload your file</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class=" mx-5 py-2 dashboard_textBox ">

                                                <div
                                                    class="dashboard_textBox  bg-white shadow-lg border-1 border-[#243673] p-2 text-center fs-6 m-auto py-4 h-auto rounded-3 ">

                                                    <p class="lead text-start mx-5"> <span
                                                            class="lead fw-bold text-decoration-underline">Noted</span>&ensp;
                                                        : Accept only File PDF</p>

                                                    <div class="mt-1 editInput lead position-relative m-auto w-75 mb-4">
                                                        <label for="fileGenre" class="lead fw-bold text-[#243673]">File's
                                                            Genre</label>
                                                        <select v-model="file_type" id="fileGenre"
                                                            class="custom-select lead fs-5 p-2 border-0 border-bottom w-100 bg-transparent">
                                                            <option value="null">Select a genre...</option>
                                                            <option value="Assignment">Assignments</option>
                                                            <option value="ClassNote">Class Notes</option>
                                                            <option value="Lesson">Lessons</option>
                                                            <option value="Personal">Personals</option>
                                                            <option value="Project">Projects</option>
                                                        </select>
                                                    </div>

                                                    <label for="file-input"
                                                        class="h-auto dashboard_textBox m-auto py-5 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">

                                                        <span class="lead drop-title text-muted fs-5  text-center ">Drop
                                                            file here</span>
                                                        or
                                                        <input type="file" class="m-auto" multiple
                                                            @change="handleFileChange" />

                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer mx-5">
                                            <button @click="uploadFile"
                                                class="lead btn btn-success mt-3 ml-96">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex m-auto mx-5 leas fs-5 fw-bold mb-5">

                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments(null)" :class="{ active: selectedFileType === null }">All</a>
                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments('Assignment')"
                                :class="{ active: selectedFileType === 'Assignment' }">Assignment</a>
                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments('ClassNote')"
                                :class="{ active: selectedFileType === 'ClassNote' }">Class Note</a>
                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments('Lesson')"
                                :class="{ active: selectedFileType === 'Lesson' }">Lesson</a>
                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments('Personal')"
                                :class="{ active: selectedFileType === 'Personal' }">Personal</a>
                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments('Project')"
                                :class="{ active: selectedFileType === 'Project' }">Projects</a>
                            <a class="type btn btn-outline-secondary text-uppercase filter-btn m-2"
                                @click="filterDocuments('null')"
                                :class="{ active: selectedFileType === 'null' }">Undefined</a>

                        </div>

                        <ul v-if="documents.length >= 0">

                            <li v-for="document in filteredDocuments" :key="document.id"
                                class="d-flex nav-item w-100 text-center m-auto align-items-center justify-content-center">
                                <div class="w-100 m-auto" v-if="document.file_type == 'Assignment'">

                                    <div class="dropdown w-90 border-1 py-2 mb-3 mx-5 d-flex justify-between ">
                                        <div class="w-100  d-flex justify-between dashboard_textBox">
                                            <div class="d-flex dashboard_textBox">

                                                <i class='bx bx-file-blank mx-2 fs-3'></i>
                                                <button @click="previewDocument(document.file_path)"
                                                    class="mx-2 text-decoration-none text-danger dashboard_textBox text-start "
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop1">{{
                                                        document.file_name
                                                    }}</button>


                                                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                                                    <div class="modal-dialog 
                                                    modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title dashboard_textBox fs-5 lead"
                                                                    id="staticBackdropLabel1">Assignment</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe v-if="fileURL != ''" :src="fileURL" width="100%"
                                                                    height="500"></iframe>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <i class=' bx bx-dots-horizontal-rounded mx-4 fs-3 ' id="dropdownUser1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>

                                            <ul class="dropdown-menu dropdown-menu-muted shadow "
                                                aria-labelledby="dropdownUser1">

                                                <li class="mt-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2" data-bs-whatever="@fat"
                                                        @click="setDocumentId(document.id)">
                                                        <a href="#" class="dropdown-item ">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-edit fs-3 text-primary'></i></span>
                                                        </a>
                                                    </button>

                                                </li>


                                                <li class="mt-1">
                                                    <button>
                                                        <a href="#" class="dropdown-item "
                                                            @click="deleteDocument(document.id)">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-trash text-danger fs-3'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                            </ul>

                                            <!-- pop up modal for upload doc -->
                                            <div class="modal fade" id="exampleModal2" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h1 class="lead text-center m-auto modal-title fs-4"
                                                                id="exampleModalLabel">Replace New
                                                                Document
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="mt-3 mx-5 py-5">

                                                                <label for="file-input"
                                                                    class="dashboard_textBox m-auto py-4 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">
                                                                    <span
                                                                        class="lead drop-title text-muted fs-5 fw-bold text-center ">Drop
                                                                        file here</span>
                                                                    or
                                                                    <input type="file" class="m-auto" multiple
                                                                        @change="handleFileChange" />

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer lead">

                                                            <button @click="updateFile(documentId)"
                                                                class="lead btn btn-success">Replace</button>
                                                            <button type="button" class="lead btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li v-for="document in filteredDocuments" :key="document.id"
                                class="d-flex nav-item w-100 text-center m-auto align-items-center justify-content-center">
                                <div class="w-100 m-auto" v-if="document.file_type == 'ClassNote'">

                                    <div class="dropdown w-90 border-1 py-2 mb-3 mx-5 d-flex justify-between ">
                                        <div class="w-100  d-flex justify-between dashboard_textBox">
                                            <div class="d-flex dashboard_textBox">

                                                <i class='bx bx-file-blank mx-2 fs-3'></i>
                                                <button @click="previewDocument(document.file_path)"
                                                    class="mx-2 text-decoration-none text-danger dashboard_textBox text-start "
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop2">{{
                                                        document.file_name
                                                    }}</button>


                                                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel2" aria-hidden="true">
                                                    <div class="modal-dialog 
                                                    modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title dashboard_textBox fs-5 lead"
                                                                    id="staticBackdropLabel2"> Class Note</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe v-if="fileURL != ''" :src="fileURL" width="100%"
                                                                    height="500"></iframe>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <i class=' bx bx-dots-horizontal-rounded mx-4 fs-3 ' id="dropdownUser1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>

                                            <ul class="dropdown-menu dropdown-menu-muted shadow "
                                                aria-labelledby="dropdownUser1">

                                                <li class="mt-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal3" data-bs-whatever="@fat"
                                                        @click="setDocumentId(document.id)">
                                                        <a href="#" class="dropdown-item ">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-edit fs-3 text-primary'></i></span>
                                                        </a>
                                                    </button>

                                                </li>


                                                <li class="mt-1">
                                                    <button>
                                                        <a href="#" class="dropdown-item "
                                                            @click="deleteDocument(document.id)">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-trash text-danger fs-3'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                            </ul>

                                            <!-- pop up modal for upload doc -->
                                            <div class="modal fade" id="exampleModal3" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h1 class="lead text-center m-auto modal-title fs-4"
                                                                id="exampleModalLabel">Replace New
                                                                Document
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="mt-3 mx-5 py-5">

                                                                <label for="file-input"
                                                                    class="dashboard_textBox m-auto py-4 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">
                                                                    <span
                                                                        class="lead drop-title text-muted fs-5 fw-bold text-center ">Drop
                                                                        file here</span>
                                                                    or
                                                                    <input type="file" class="m-auto" multiple
                                                                        @change="handleFileChange" />

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer lead">

                                                            <button @click="updateFile(documentId)"
                                                                class="lead btn btn-success">Replace</button>
                                                            <button type="button" class="lead btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </li>

                            <li v-for="document in filteredDocuments" :key="document.id"
                                class="d-flex nav-item w-100 text-center m-auto align-items-center justify-content-center">
                                <div class="w-100 m-auto" v-if="document.file_type == 'Lesson'">

                                    <div class="dropdown w-90 border-1 py-2 mb-3 mx-5 d-flex justify-between ">
                                        <div class="w-100  d-flex justify-between dashboard_textBox">
                                            <div class="d-flex dashboard_textBox">

                                                <i class='bx bx-file-blank mx-2 fs-3'></i>
                                                <button @click="previewDocument(document.file_path)"
                                                    class="mx-2 text-decoration-none text-danger dashboard_textBox text-start "
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop3">{{
                                                        document.file_name
                                                    }}</button>


                                                <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel3" aria-hidden="true">
                                                    <div class="modal-dialog 
                                                    modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title dashboard_textBox fs-5 lead"
                                                                    id="staticBackdropLabel3">Lesson</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe v-if="fileURL != ''" :src="fileURL" width="100%"
                                                                    height="500"></iframe>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <i class=' bx bx-dots-horizontal-rounded mx-4 fs-3 ' id="dropdownUser1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>

                                            <ul class="dropdown-menu dropdown-menu-muted shadow "
                                                aria-labelledby="dropdownUser1">

                                                <li class="mt-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal4" data-bs-whatever="@fat"
                                                        @click="setDocumentId(document.id)">
                                                        <a href="#" class="dropdown-item ">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-edit fs-3 text-primary'></i></span>
                                                        </a>
                                                    </button>

                                                </li>


                                                <li class="mt-1">
                                                    <button>
                                                        <a href="#" class="dropdown-item "
                                                            @click="deleteDocument(document.id)">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-trash text-danger fs-3'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                            </ul>

                                            <!-- pop up modal for upload doc -->
                                            <div class="modal fade" id="exampleModal4" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h1 class="lead text-center m-auto modal-title fs-4"
                                                                id="exampleModalLabel">Replace New
                                                                Document
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="mt-3 mx-5 py-5">

                                                                <label for="file-input"
                                                                    class="dashboard_textBox m-auto py-4 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">
                                                                    <span
                                                                        class="lead drop-title text-muted fs-5 fw-bold text-center ">Drop
                                                                        file here</span>
                                                                    or
                                                                    <input type="file" class="m-auto" multiple
                                                                        @change="handleFileChange" />

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer lead">

                                                            <button @click="updateFile(documentId)"
                                                                class="lead btn btn-success">Replace</button>
                                                            <button type="button" class="lead btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </li>

                            <li v-for="document in filteredDocuments" :key="document.id"
                                class="d-flex nav-item w-100 text-center m-auto align-items-center justify-content-center">
                                <div class="w-100 m-auto" v-if="document.file_type == 'Personal'">

                                    <div class="dropdown w-90 border-1 py-2 mb-3 mx-5 d-flex justify-between ">
                                        <div class="w-100  d-flex justify-between dashboard_textBox">
                                            <div class="d-flex dashboard_textBox">

                                                <i class='bx bx-file-blank mx-2 fs-3'></i>
                                                <button @click="previewDocument(document.file_path)"
                                                    class="mx-2 text-decoration-none text-danger dashboard_textBox text-start "
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop4">{{
                                                        document.file_name
                                                    }}</button>


                                                <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel4" aria-hidden="true">
                                                    <div class="modal-dialog 
                                                    modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title dashboard_textBox fs-5 lead"
                                                                    id="staticBackdropLabel4">Personal</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe v-if="fileURL != ''" :src="fileURL" width="100%"
                                                                    height="500"></iframe>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <i class=' bx bx-dots-horizontal-rounded mx-4 fs-3 ' id="dropdownUser1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>

                                            <ul class="dropdown-menu dropdown-menu-muted shadow "
                                                aria-labelledby="dropdownUser1">

                                                <li class="mt-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal5" data-bs-whatever="@fat"
                                                        @click="setDocumentId(document.id)">
                                                        <a href="#" class="dropdown-item ">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-edit fs-3 text-primary'></i></span>
                                                        </a>
                                                    </button>

                                                </li>


                                                <li class="mt-1">
                                                    <button>
                                                        <a href="#" class="dropdown-item "
                                                            @click="deleteDocument(document.id)">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-trash text-danger fs-3'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                            </ul>

                                            <!-- pop up modal for upload doc -->
                                            <div class="modal fade" id="exampleModal5" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h1 class="lead text-center m-auto modal-title fs-4"
                                                                id="exampleModalLabel">Replace New
                                                                Document
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="mt-3 mx-5 py-5">

                                                                <label for="file-input"
                                                                    class="dashboard_textBox m-auto py-4 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">
                                                                    <span
                                                                        class="lead drop-title text-muted fs-5 fw-bold text-center ">Drop
                                                                        file here</span>
                                                                    or
                                                                    <input type="file" class="m-auto" multiple
                                                                        @change="handleFileChange" />

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer lead">

                                                            <button @click="updateFile(documentId)"
                                                                class="lead btn btn-success">Replace</button>
                                                            <button type="button" class="lead btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </li>

                            <li v-for="document in filteredDocuments" :key="document.id"
                                class="d-flex nav-item w-100 text-center m-auto align-items-center justify-content-center">
                                <div class="w-100 m-auto" v-if="document.file_type == 'Project'">

                                    <div class="dropdown w-90 border-1 py-2 mb-3 mx-5 d-flex justify-between ">
                                        <div class="w-100  d-flex justify-between dashboard_textBox">
                                            <div class="d-flex dashboard_textBox">

                                                <i class='bx bx-file-blank mx-2 fs-3'></i>
                                                <button @click="previewDocument(document.file_path)"
                                                    class="mx-2 text-decoration-none text-danger dashboard_textBox text-start "
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop5">{{
                                                        document.file_name
                                                    }}</button>


                                                <div class="modal fade" id="staticBackdrop5" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog 
                                                    modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title dashboard_textBox fs-5 lead"
                                                                    id="staticBackdropLabel">Projects</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe v-if="fileURL != ''" :src="fileURL" width="100%"
                                                                    height="500"></iframe>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <i class=' bx bx-dots-horizontal-rounded mx-4 fs-3 ' id="dropdownUser1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>

                                            <ul class="dropdown-menu dropdown-menu-muted shadow "
                                                aria-labelledby="dropdownUser1">

                                                <li class="mt-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal6" data-bs-whatever="@fat"
                                                        @click="setDocumentId(document.id)">
                                                        <a href="#" class="dropdown-item ">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-edit fs-3 text-primary'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                                <li class="mt-1">
                                                    <button>
                                                        <a href="#" class="dropdown-item "
                                                            @click="deleteDocument(document.id)">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-trash text-danger fs-3'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                            </ul>

                                            <!-- pop up modal for upload doc -->
                                            <div class="modal fade" id="exampleModal6" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h1 class="lead text-center m-auto modal-title fs-4"
                                                                id="exampleModalLabel">Replace New
                                                                Document
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="mt-3 mx-5 py-5">

                                                                <label for="file-input"
                                                                    class="dashboard_textBox m-auto py-4 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">
                                                                    <span
                                                                        class="lead drop-title text-muted fs-5 fw-bold text-center ">Drop
                                                                        file here</span>
                                                                    or
                                                                    <input type="file" class="m-auto" multiple
                                                                        @change="handleFileChange" />

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer lead">

                                                            <button @click="updateFile(documentId)"
                                                                class="lead btn btn-success">Replace</button>
                                                            <button type="button" class="lead btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li v-for="document in filteredDocuments" :key="document.id"
                                class="d-flex nav-item w-100 text-center m-auto align-items-center justify-content-center">
                                <div class="w-100 m-auto" v-if="!document.file_type || document.file_type === 'null'">

                                    <div class="dropdown w-90 border-1 py-2 mb-3 mx-5 d-flex justify-between ">
                                        <div class="w-100  d-flex justify-between dashboard_textBox">
                                            <div class="d-flex dashboard_textBox">

                                                <i class='bx bx-file-blank mx-2 fs-3'></i>
                                                <button @click="previewDocument(document.file_path)"
                                                    class="mx-2 text-decoration-none text-danger dashboard_textBox text-start "
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop6">{{
                                                        document.file_name
                                                    }}</button>


                                                <div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog 
                                                    modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title dashboard_textBox fs-5 lead"
                                                                    id="staticBackdropLabel">Undefined Type</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe v-if="fileURL != ''" :src="fileURL" width="100%"
                                                                    height="500"></iframe>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <i class=' bx bx-dots-horizontal-rounded mx-4 fs-3 ' id="dropdownUser1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>

                                            <ul class="dropdown-menu dropdown-menu-muted shadow "
                                                aria-labelledby="dropdownUser1">

                                                <li class="mt-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal7" data-bs-whatever="@fat"
                                                        @click="setDocumentId(document.id)">
                                                        <a href="#" class="dropdown-item ">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-edit fs-3 text-primary'></i></span>
                                                        </a>
                                                    </button>

                                                </li>


                                                <li class="mt-1">
                                                    <button>
                                                        <a href="#" class="dropdown-item "
                                                            @click="deleteDocument(document.id)">
                                                            <span class="ms-1 d-none d-sm-inline"><i
                                                                    class='bx bx-trash text-danger fs-3'></i></span>
                                                        </a>
                                                    </button>

                                                </li>

                                            </ul>

                                            <!-- pop up modal for upload doc -->
                                            <div class="modal fade" id="exampleModal7" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h1 class="lead text-center m-auto modal-title fs-4"
                                                                id="exampleModalLabel">Replace New
                                                                Document
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="mt-3 mx-5 py-5">

                                                                <label for="file-input"
                                                                    class="dashboard_textBox m-auto py-4 drop-container bg-white position-relative d-flex gap-4 flex-column align-items-center p-3 mt-2 border-3 border-dashed border-[#243673] cursor-pointer rounded-2 text-muted ">
                                                                    <span
                                                                        class="lead drop-title text-muted fs-5 fw-bold text-center ">Drop
                                                                        file here</span>
                                                                    or
                                                                    <input type="file" class="m-auto" multiple
                                                                        @change="handleFileChange" />

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer lead">

                                                            <button @click="updateFile(documentId)"
                                                                class="lead btn btn-success">Replace</button>
                                                            <button type="button" class="lead btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<style lang="scss">
// width:1236
@import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');

.dashboard_textBox {
    width: 90%;
    overflow: hidden;
    word-wrap: break-word;
    font-size: 16px;

    @media screen and (max-width: 768px) {
        font-size: 12px;
    }

    @media screen and (max-width: 480px) {
        font-size: 12px;
    }
}


.custom-scrollbar {
    width: 100%;
    height: 900px;
    overflow: scroll;
    word-wrap: break-word;
    font-size: 18px;

    @media screen and (max-width: 768px) {
        font-size: 14px;
    }

    @media screen and (max-width: 480px) {
        font-size: 14px;
    }
}

/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #ffffff;
}

.formUploadImg {
    padding: 2rem .7rem .7rem .7rem;
    max-width: 320px;
}


.drop-container {
    transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
    background: rgba(0, 140, 255, 0.164);
}

.drop-container:hover .drop-title {
    color: #222;
}

.drop-title {
    transition: color .2s ease-in-out;
}

#file-input {
    width: 350px;
    max-width: 100%;
}

#file-input::file-selector-button {
    margin-right: 20px;
    border: none;
    background: #243673;
    padding: 10px 20px;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    transition: background .2s ease-in-out;
}

#file-input::file-selector-button:hover {
    background: #243673;
}
</style>
