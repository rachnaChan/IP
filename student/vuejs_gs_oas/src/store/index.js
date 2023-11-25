import { createStore } from "vuex";
import createPersistedState from "vuex-plugin-persistedstate";
import setAuthHeader from '../libs/apis/axiosConfig'

//var token = this.$store.getters.token

const store = createStore({
    state: {
        token: null,
        user: {},
        uploadedFiles: [
            {
                id: null,
                name: null,
                content: null,
                size: null
            }
        ],
        role: null,
        email: null,
        id:null,
        programId: null,
        formalPersonalInfo: {
            id: null,
            image: {},
            study_pathway: null,
            type_of_degree: null,
            registration_level: null,
            family_name: null,
            given_name: null,
            gender: null,
            marital_status: null,
            dob: null,
            place_of_birth: null,
            country_of_birth: null,
            nationality: null,
        },
        currentContactInfo: {
            id: null,
            address: null,
            postal_code: null,
            province: null,
            country: null,
            phone_number: null,
            email: null,
        },
        secondaryContactInfo: {
            id: null,
            contact_person_name: null,
            address: null,
            postal_code: null,
            province: null,
            country: null,
            phone_number: null,
            email: null,
        },
        educationalBackground: {
            id: null,
            itc_graduate_year: null,
            major: null,
            high_school_grade: null,
            high_school_year: null,
            high_school_name: null,
            high_school_province: null,
            high_school_country: null,
        },
        higherEducation: [
            {
                id: null,
                institution: null,
                province: null,
                country: null,
                major: null,
                degree_obtained: null,
                degree_start_date: null,
                degree_end_date: null,
                applicant_id: null,
            }
        ],
        foreignLanguage: [
            {
                id: null,
                certificate: null,
                name: null,
                date_of_received: null,
                reading: null,
                writing: null,
                speaking: null,
                listening: null,
                applicant_id: null,
            }
        ],
        workExperience: [
            {
                id: null,
                date_from: null,
                date_to: null,
                company_name: null,
                position: null,
                description: null,
                applicant_id: null,
            }
        ]
    },

    getters: {
        token: state => state.token,
        user: state => state.user,
        user: state => state.id,
        role: state => state.role,
        email: state => state.email,
        uploadedFiles: state => state.uploadedFiles,
        programId: state => state.programId,
        formalPersonalInfo: state => state.formalPersonalInfo,
        currentContactInfo: state => state.currentContactInfo,
        secondaryContactInfo: state => state.secondaryContactInfo,
        educationalBackground: state => state.educationalBackground,
        higherEducation: state => state.higherEducation,
        foreignLanguage: state => state.foreignLanguage,
        workExperience: state => state.workExperience,

        // checking if formal personal info is empty or not
        isFormalPersonalInfoInitialized: (state) => {
            let s = true;
            // console.log(state.foreignLanguage.dob)
            Object.keys(state.formalPersonalInfo).forEach(key => {
                if (key === 'image') {
                    if (state.formalPersonalInfo[key].base64 !== undefined && state.formalPersonalInfo[key].name !== undefined && state.formalPersonalInfo[key].type !== undefined) {
                        s = false
                        // console.log(state.formalPersonalInfo[key], s);
                    }
                } else {
                    if (state.formalPersonalInfo[key] === null || state.formalPersonalInfo[key] === undefined || state.formalPersonalInfo[key] === '') {
                        // s = true
                        // console.log(key, state.formalPersonalInfo[key], s)
                    } else {
                        s = false
                        console.log(key, state.formalPersonalInfo[key], s)
                        return s
                    }
                }
                // console.log( s)
            });
            // console.log( s)

            return s;
        },

        isCurrentContactInfoInitialized: (state) => {
            let s = true;
            Object.keys(state.currentContactInfo).forEach(key => {
                if (state.currentContactInfo[key] === null || state.currentContactInfo[key] === undefined || state.currentContactInfo[key] === '') {
                    // s = true
                    // console.log(key, state.currentContactInfo[key], s)
                } else {
                    s = false
                    return s
                }
            });

            return s;
        },

        isSecondaryContactInfoInitialized: (state) => {
            let s = true;
            Object.keys(state.secondaryContactInfo).forEach(key => {
                if (state.secondaryContactInfo[key] === null || state.secondaryContactInfo[key] === undefined || state.secondaryContactInfo[key] === '') {
                    // s = true
                    // console.log(key, state.secondaryContactInfo[key], s)
                } else {
                    s = false
                    return s
                }
            });

            return s;
        },

        isEducationalBackgroundInitialized: (state) => {
            let s = true
            Object.keys(state.educationalBackground).forEach(key => {
                if (state.educationalBackground[key] === null || state.educationalBackground[key] === undefined || state.educationalBackground[key] === '') {
                    // s = true
                    // console.log(key, state.educationalBackground[key], s)
                } else {
                    s = false
                    return s
                }
            });

            return s;
        },

        isHigherEducationInitialized: (state) => {
            let s = true;

            if (state.higherEducation.length > 1) {
                s = false
            } else {
                Object.keys(state.higherEducation[0]).forEach(key => {
                    if (state.higherEducation[0][key] === null || state.higherEducation[0][key] === undefined || state.higherEducation[0][key] === '') {
                        // s = true
                        // console.log(key, state.higherEducation[0][key], s)
                    } else {
                        s = false
                        // console.log(key, state.higherEducation[0][key], s)
                        return s
                    }
                });
            }
            return s
        },

        isForeignLanguageInitialized: (state) => {
            let s = true;

            if (state.foreignLanguage.length > 1) {
                s = false
            } else {
                Object.keys(state.foreignLanguage[0]).forEach(key => {
                    if (state.foreignLanguage[0][key] === null || state.foreignLanguage[0][key] === undefined || state.foreignLanguage[0][key] === '') {
                        // s = true
                        // console.log(key, state.foreignLanguage[0][key], s)
                    } else {
                        s = false
                        // console.log(key, state.foreignLanguage[0][key], s)
                        return s
                    }
                });
            }
            return s
        },

        isWorkExperienceInitialized: (state) => {
            let s = true;

            if (state.workExperience.length > 1) {
                s = false
            } else {
                Object.keys(state.workExperience[0]).forEach(key => {
                    if (state.workExperience[0][key] === null || state.workExperience[0][key] === undefined || state.workExperience[0][key] === '') {
                        // s = true
                        // console.log(key, state.workExperience[0][key], s)
                    } else {
                        s = false
                        // console.log(key, state.workExperience[0][key], s)
                        return s
                    }
                });
            }
            return s
        }
    },

    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        clearTokenAndUser(state, value) {
            //whenever user logout everything inside the vuex will be deleted
            state.token = value;
            state.user = value;
            state.role = value;

            state.formalPersonalInfo = value;
            state.currentContactInfo = value;
            state.secondaryContactInfo = value;
            state.educationalBackground = value;
            state.foreignLanguage = value;
            state.workExperience = value;
        },
        setUser(state, user) {
            state.user = user;
        },
        setRole(state, role) {
            state.role = role;
        },
        setEmail(state, email) {
            state.email = email;
        },
        setId(state, id) {
            state.id = id;
        },
        updateStoredFiles(state, selectedFiles) {
            state.uploadedFiles = selectedFiles;
        },
        removeFileByName(state, fileName) {
            state.uploadedFiles = state.uploadedFiles.filter(file => file.name !== fileName);
            
        },
        setProgramId(state, programId) {
            state.programId = programId;
        },
        setFormalPersonalInfo(state, data) {
            state.formalPersonalInfo = data;
        },
        setCurrentContactInfo(state, data) {
            state.currentContactInfo = data;
        },
        setSecondaryContactInfo(state, data) {
            state.secondaryContactInfo = data;
        },
        setEducationalBackground(state, educationalBackground) {
            state.educationalBackground = { ...state.educationalBackground, ...educationalBackground };
        },
        setHigherEducation(state, higherEducation) {
            state.higherEducation = higherEducation;
        },
        setForeignLanguage(state, foreignLanguage) {
            state.foreignLanguage = foreignLanguage;
        },
        setWorkExperience(state, workExperience) {
            state.workExperience = workExperience;
        },
    },

    actions: {
        setAuthHeaderIfNeeded({ state }) {
            if (state.token) {
                setAuthHeader(state.token);
            } else {
                setAuthHeader(false);
            }
        },


    },

    plugins: [createPersistedState(
        // {
        //     key: 'VUEX-PERSISTEDSTATE', // Use the correct key
        //     paths: ['setUser', 'setToken', 'setRole', 'setEmail', 'setWorkExperience', 'setForeignLanguage', ' setHigherEducation', ' setEducationalBackground',
        //         ' setSecondaryContactInfo', 'setCurrentContactInfo', ' setFormalPersonalInfo', ' setProgramId'], // Include only the state properties you want to persist
        //     // Optionally, add the `rehydrated` callback to remove `uploadedFiles` from the state
        //     rehydrated(state) {
        //         if (state.uploadedFiles) {
        //             delete state.uploadedFiles;
        //         }
        //     },
        // }


    )],
})

export default store