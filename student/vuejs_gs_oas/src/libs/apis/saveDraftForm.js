import axios from "axios";
import store from '../../store';

const saveDraftForm = async () => {
    if ((store.getters.programId === null || store.getters.programId === undefined) && store.getters.isFormalPersonalInfoInitialized) {
        return alert('please filled choose a program and fill some information to Save Draft');
    }

    //if user have applicant_id as null => it mean that user have never touch the form before
    //in this case we will ***create an applicant detail row for user and update the applicant_id in the users table*** for them 
    //which mean that he is current in the incomplete status
    var appId = store.state.user?.applicant_id
    console.log(appId)
    if (appId === 0 || appId === null || appId === undefined) {
        var formalPersonalInfoId = ''
        if (!store.getters.isFormalPersonalInfoInitialized) {
            const formalPersonalInfoObject = store.getters.formalPersonalInfo
            const formData = new FormData();
            Object.entries(formalPersonalInfoObject).forEach(([key, value]) => {
                formData.append(key, value);
            });

            console.log(formData);
            const response = await axios.post(`http://localhost:8000/api/formalpersonalinfos`, formData)
            console.log('add formal personal info success, ', response.data)
            formalPersonalInfoId = response.data.id

            var form = store.getters.formalPersonalInfo
            console.log(form)
            form.id = response.data.id
            console.log(form.id)
            console.log(response.data.id)
            console.log(form)


            store.commit('setFormalPersonalInfo', form)
        }

        var currentContactInfoId = ''
        // if (store.getters.currentContactInfo !== undefined || store.getters.currentContactInfo !== null) {
        if (!store.getters.isCurrentContactInfoInitialized) {
            const response = await axios.post(`http://localhost:8000/api/currentcontactinfos`, store.getters.currentContactInfo)
            console.log('add current contact info success, ', response.data)
            currentContactInfoId = response.data.id
            console.log(currentContactInfoId)
            var form = store.getters.currentContactInfo
            form.id = response.data.id

            store.commit('setCurrentContactInfo', form)
        }

        var secondaryContactInfoId = ''
        // if (store.getters.secondaryContactInfo !== undefined || store.getters.secondaryContactInfo !== null) {
        if (!store.getters.isSecondaryContactInfoInitialized) {
            const response = await axios.post(`http://localhost:8000/api/secondarycontactinfos`, store.getters.secondaryContactInfo)
            console.log('add secondary contact info success, ', response.data)
            secondaryContactInfoId = response.data.id
            var form = store.getters.secondaryContactInfo
            // console.log(form)
            form.id = response.data.id
            // console.log(form.id)
            // console.log(response.data.id)

            store.commit('setSecondaryContactInfo', form)
        }

        var educationalBackgroundId = ''
        // if (store.getters.educationalBackground !== ndefined || store.getters.educationalBackground !== null) {
        if (!store.getters.isEducationalBackgroundInitialized) {
            const response = await axios.post(`http://localhost:8000/api/educationalbackgrounds`, store.getters.educationalBackground)
            console.log('add educational background success, ', response.data)
            educationalBackgroundId = response.data.id
            var form = store.getters.educationalBackground
            form.id = response.data.id

            store.commit('setEducationalBackground', form)
        }

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const nextYear = currentYear + 1;
        const academic_year = currentYear + "-" + nextYear;

        const applicantData = {
            applicant_status: 'incomplete',
            academic_year: academic_year,
            formal_personal_info_id: formalPersonalInfoId,
            current_contact_info_id: currentContactInfoId,
            secondary_contact_info_id: secondaryContactInfoId,
            educational_background_id: educationalBackgroundId,
            program_id: store.getters.programId,
        }

        console.log(applicantData)
        const res = await axios.post(`http://localhost:8000/api/applicantdetails`, applicantData)
        console.log('applicant create success ', res.data)
        var user = store.state.user
        user.applicant_id = res.data.id
        var userApplicantId = res.data.id
        store.commit('setUser', user)
        // if(store.getters.higherEducation !== undefined || store.getters.higherEducation !== null) {
        if (!store.getters.isHigherEducationInitialized) {
            var form = store.getters.higherEducation
            for (let i = 0; i < form.length; i++) {

                form[i].applicant_id = res.data.id
            }
            console.log(form)
            store.commit('setHigherEducation', form)
        }
        // if(store.getters.foreignLanguage !== undefined || store.getters.foreignLanguage !== null) {
        if (!store.getters.isForeignLanguageInitialized) {
            var form = store.getters.foreignLanguage
            for (let i = 0; i < form.length; i++) {
                form[i].applicant_id = res.data.id
            }

            store.commit('setForeignLanguage', form)
        }
        // if(store.getters.workExperience !== undefined || store.getters.workExperience !== null) {
        if (!store.getters.isWorkExperienceInitialized) {
            var form = store.getters.workExperience
            for (let i = 0; i < form.length; i++) {
                form[i].applicant_id = res.data.id
            }

            store.commit('setWorkExperience', form)
        }

        const userId = store.state.user.id
        const updateUser = {
            applicant_id: userApplicantId,
        }
        const updateResponse = await axios.post(`http://localhost:8000/api/users/${userId}`, updateUser)
        console.log('updated user applicant id successfully ', updateResponse)

        // if (store.getters.higherEducation !== undefined || store.getters.higherEducation !== null) {
        if (!store.getters.isHigherEducationInitialized) {
            var resData = store.getters.higherEducation
            if (store.getters.higherEducation.length > 0) {
                for (let i = 0; i < store.getters.higherEducation.length; i++) {
                    const higherEducationResponse = await axios.post(`http://localhost:8000/api/highereducations`, store.getters.higherEducation[i])
                    console.log(higherEducationResponse.data.id)
                    resData[i].id = higherEducationResponse.data.id

                    console.log(higherEducationResponse)
                }
                store.commit('setHigherEducation', resData)
            }
        }

        // if (store.getters.foreignLanguage !== undefined || store.getters.foreignLanguage !== null) {
        if (!store.getters.isForeignLanguageInitialized) {
            var resData = store.getters.foreignLanguage
            if (store.getters.foreignLanguage.length > 0) {
                for (let i = 0; i < store.getters.foreignLanguage.length; i++) {
                    const foreignLanguageResponse = await axios.post(`http://localhost:8000/api/foreignlanguages`, store.getters.foreignLanguage[i])
                    resData[i].id = foreignLanguageResponse.data.id

                    console.log(foreignLanguageResponse)
                }
                store.commit('setForeignLanguage', resData)
            }
        }

        // if (store.getters.workExperience !== undefined || store.getters.workExperience !== null) {
        if (!store.getters.isWorkExperienceInitialized) {
            var resData = store.getters.workExperience
            if (store.getters.workExperience.length > 0) {
                for (let i = 0; i < store.getters.workExperience.length; i++) {
                    const workExperienceResponse = await axios.post(`http://localhost:8000/api/workexperiences`, store.getters.workExperience[i])
                    resData[i].id = workExperienceResponse.data.id

                    console.log(workExperienceResponse)
                }
                store.commit('setWorkExperience', resData)
            }
        }
        // else, if the applicant id is not null which mean that user have save draft before 
    } else {
        var applicant_id = store.state.user?.applicant_id
        console.log(applicant_id);

        //formal personal info
        var formalPersonalInfoId = null;
        console.log(store.getters.formalPersonalInfo)
        console.log(store.getters.formalPersonalInfo?.id)
        if (store.getters.formalPersonalInfo?.id !== undefined && store.getters.formalPersonalInfo?.id !== null) {
            formalPersonalInfoId = store.getters.formalPersonalInfo?.id
        }
        // if (store.getters.formalPersonalInfo !== undefined || store.getters.formalPersonalInfo !== null) {
        if (!store.getters.isFormalPersonalInfoInitialized) {
            if (formalPersonalInfoId === undefined || formalPersonalInfoId === null || formalPersonalInfoId === 0) {
                console.log(formalPersonalInfoId)
                const formalPersonalInfoObject = store.getters.formalPersonalInfo
                const formData = new FormData();
                Object.entries(formalPersonalInfoObject).forEach(([key, value]) => {
                    formData.append(key, value);
                });

                const response = await axios.post(`http://localhost:8000/api/formalpersonalinfos`, formData)
                console.log('add formal personal info success, ', response.data)
                formalPersonalInfoId = response.data.id
                var form = store.getters.formalPersonalInfo
                form.id = response.data.id

                console.log(form)
                store.commit('setFormalPersonalInfo', form)

            } else {
                const formalPersonalInfoObject = store.getters.formalPersonalInfo
                const formData = new FormData();
                Object.entries(formalPersonalInfoObject).forEach(([key, value]) => {
                    formData.append(key, value);
                });
                const response = await axios.post(`http://localhost:8000/api/formalpersonalinfos/${formalPersonalInfoId}`, formData)
                console.log('update formal personal info success, ', response.data)
            }
        }

        console.log(store.getters.formalPersonalInfo)
        //current contact info 
        var currentContactInfoId = null
        if (store.getters.currentContactInfo?.id !== undefined && store.getters.currentContactInfo?.id !== null) {
            currentContactInfoId = store.getters.currentContactInfo?.id
        }
        console.log(store.getters.currentContactInfo?.id)
        // if (store.getters.currentContactInfo !== undefined || store.getters.currentContactInfo !== null) {
        if (!store.getters.isCurrentContactInfoInitialized) {
            if (currentContactInfoId === undefined || currentContactInfoId === null || currentContactInfoId === 0) {
                const response = await axios.post(`http://localhost:8000/api/currentcontactinfos`, store.getters.currentContactInfo)
                console.log('add current contatc info success, ', response.data)
                currentContactInfoId = response.data.id
                console.log(currentContactInfoId)
                var form = store.getters.currentContactInfo
                form.id = response.data.id

                store.commit('setCurrentContactInfo', form)
            } else {
                const response = await axios.put(`http://localhost:8000/api/currentcontactinfos/${currentContactInfoId}`, store.getters.currentContactInfo)
                console.log('add current contact info success, ', response.data)
            }
        }

        //secondary contact info
        var secondaryContactInfoId = null
        if (store.getters.secondaryContactInfo?.id !== undefined && store.getters.secondaryContactInfo?.id !== null) {
            secondaryContactInfoId = store.getters.secondaryContactInfo?.id
        }
        // if (store.getters.secondaryContactInfo !== undefined || store.getters.secondaryContactInfo !== null) {
        if (!store.getters.isSecondaryContactInfoInitialized) {
            if (secondaryContactInfoId === undefined || secondaryContactInfoId === null || secondaryContactInfoId === 0) {
                const response = await axios.post(`http://localhost:8000/api/secondarycontactinfos`, store.getters.secondaryContactInfo)
                console.log('add secondary contact info success, ', response.data)
                secondaryContactInfoId = response.data.id
                var form = store.getters.secondaryContactInfo
                form.id = response.data.id

                store.commit('setSecondaryContactInfo', form)
            } else {
                const response = await axios.put(`http://localhost:8000/api/secondarycontactinfos/${secondaryContactInfoId}`, store.getters.secondaryContactInfo)
                console.log('add secondary contact info success, ', response.data)
            }
        }


        //educational background
        var educationalBackgroundId = null
        if (store.getters.educationalBackground?.id !== undefined && store.getters.educationalBackground?.id !== null) {
            educationalBackgroundId = store.getters.educationalBackground?.id
        }
        // if (store.getters.educationalBackground !== undefined || store.getters.educationalBackground !== null) {
        if (!store.getters.isEducationalBackgroundInitialized) {
            if (educationalBackgroundId === undefined || educationalBackgroundId === null || educationalBackgroundId === 0) {
                const response = await axios.post(`http://localhost:8000/api/educationalbackgrounds`, store.getters.educationalBackground)
                console.log('add educational background success, ', response.data)
                educationalBackgroundId = response.data.id
                var form = store.getters.educationalBackground
                form.id = response.data.id

                store.commit('setEducationalBackground', form)
            } else {
                const response = await axios.put(`http://localhost:8000/api/educationalbackgrounds/${educationalBackgroundId}`, store.getters.educationalBackground)
                console.log('add educational background success, ', response.data)
            }
        }

        const applicantData = {
            applicant_status: 'incomplete',
            formal_personal_info_id: formalPersonalInfoId,
            current_contact_info_id: currentContactInfoId,
            secondary_contact_info_id: secondaryContactInfoId,
            educational_background_id: educationalBackgroundId,
            program_id: store.getters.programId,
        }

        const response = await axios.put(`http://localhost:8000/api/applicantdetails/${applicant_id}`, applicantData)
        console.log('applicant update success ', response.data)

        if (!store.getters.isHigherEducationInitialized) {
            var form = store.getters.higherEducation
            for (let i = 0; i < form.length; i++) {

                form[i].applicant_id = applicant_id
            }
            console.log(form)
            store.commit('setHigherEducation', form)
        }
        if (!store.getters.isForeignLanguageInitialized) {
            var form = store.getters.foreignLanguage
            for (let i = 0; i < form.length; i++) {
                form[i].applicant_id = applicant_id
            }

            store.commit('setForeignLanguage', form)
        }
        if (!store.getters.isWorkExperienceInitialized) {
            var form = store.getters.workExperience
            for (let i = 0; i < form.length; i++) {
                form[i].applicant_id = applicant_id
            }

            store.commit('setWorkExperience', form)
        }

        // if (store.getters.higherEducation !== undefined || store.getters.higherEducation !== null) {
        if (!store.getters.isHigherEducationInitialized) {
            var resData = store.getters.higherEducation
            // get all higher applicant data in database 
            const higherEducationInDatabase = await axios.get(`http://localhost:8000/api/highereducations/search/${applicant_id}`)
            const higherEducationDataInDatabase = higherEducationInDatabase.data
            if (store.getters.higherEducation.length > 0) {
                var toDeleteHigherEducationId = []
                var existHigherEducationId = []
                for (let i = 0; i < store.getters.higherEducation.length; i++) {
                    if (store.getters.higherEducation[i]?.id === null || store.getters.higherEducation[i]?.id === undefined) {
                        const higherEducationResponse = await axios.post(`http://localhost:8000/api/highereducations`, store.getters.higherEducation[i])
                        resData[i].id = higherEducationResponse.data.id
                        console.log(higherEducationResponse)
                    } else {
                        for(let j=0; j<higherEducationDataInDatabase.length; j++) {
                            if(higherEducationDataInDatabase[j].id === store.getters.higherEducation[i]?.id){
                                const higherEducationResponse = await axios.put(`http://localhost:8000/api/highereducations/${store.getters.higherEducation[i]?.id}`, store.getters.higherEducation[i])
                                console.log(higherEducationResponse)
                                existHigherEducationId.push(higherEducationDataInDatabase[j].id)
                            }
                        }
                    }
                }

                for(let k=0; k<higherEducationDataInDatabase.length; k++) {
                    if(existHigherEducationId.includes(higherEducationDataInDatabase[k].id)) {
                        console.log(higherEducationDataInDatabase[k].id, ' is exist')
                    } else {
                        toDeleteHigherEducationId.push(higherEducationDataInDatabase[k].id)
                    }
                }

                console.log(toDeleteHigherEducationId)
                for(let l=0; l<toDeleteHigherEducationId.length; l++) {
                    const deleteHigherEducation = await axios.delete(`http://localhost:8000/api/highereducations/${toDeleteHigherEducationId[l]}`)
                    console.log('delete success ', toDeleteHigherEducationId[l])
                }
                store.commit('setHigherEducation', resData)
            }
        }

        // if (store.getters.foreignLanguage !== undefined || store.getters.foreignLanguage !== null) {
        if (!store.getters.isForeignLanguageInitialized) {
            var resData = store.getters.foreignLanguage
            const foreignLanguageInDatabase = await axios.get(`http://localhost:8000/api/foreignlanguages/search/${applicant_id}`)
            const foreignLanguageDataInDatabase = foreignLanguageInDatabase.data
            if (store.getters.foreignLanguage.length > 0) {
                var toDeleteForeignLanguageId = []
                var existForeignLanguageId = []
                for (let i = 0; i < store.getters.foreignLanguage.length; i++) {
                    if (store.getters.foreignLanguage[i]?.id === null || store.getters.foreignLanguage[i]?.id === undefined) {
                        const foreignLanguageResponse = await axios.post(`http://localhost:8000/api/foreignlanguages`, store.getters.foreignLanguage[i])
                        resData[i].id = foreignLanguageResponse.data.id
                        console.log(foreignLanguageResponse)
                    } else {
                        for(let j=0; j<foreignLanguageDataInDatabase.length; j++) {
                            if(foreignLanguageDataInDatabase[j].id === store.getters.foreignLanguage[i]?.id) {
                                const foreignLanguageResponse = await axios.put(`http://localhost:8000/api/foreignlanguages/${store.getters.foreignLanguage[i]?.id}`, store.getters.foreignLanguage[i])
                                console.log(foreignLanguageResponse)
                                existForeignLanguageId.push(foreignLanguageDataInDatabase[j].id)
                            }
                        }                            
                    }
                }

                for(let k=0; k<foreignLanguageDataInDatabase.length; k++) {
                    if(existForeignLanguageId.includes(foreignLanguageDataInDatabase[k].id)) {
                        console.log(foreignLanguageDataInDatabase[k].id, ' is exist')
                    } else {
                        toDeleteForeignLanguageId.push(foreignLanguageDataInDatabase[k].id)
                    }
                }

                console.log(toDeleteForeignLanguageId)
                for(let l=0; l<toDeleteForeignLanguageId.length; l++) {
                    const deleteForeignLanguage = await axios.delete(`http://localhost:8000/api/foreignlanguages/${toDeleteForeignLanguageId[l]}`)
                    console.log('delete success ', toDeleteForeignLanguageId[l])
                }

                store.commit('setForeignLanguage', resData)
            }
        }

        // if (store.getters.workExperience !== undefined || store.getters.workExperience !== null) {
        if (!store.getters.isWorkExperienceInitialized) {
            var resData = store.getters.workExperience
            const workExperienceInDatabase = await axios.get(`http://localhost:8000/api/workexperiences/search/${applicant_id}`)
            const workExperienceDataInDatabase = workExperienceInDatabase.data
            if (store.getters.workExperience.length > 0) {
                var toDeleteWorkExperienceId = []
                var existWorkExperienceId = []
                for (let i = 0; i < store.getters.workExperience.length; i++) {
                    if (store.getters.workExperience[i]?.id === null || store.getters.workExperience[i]?.id === undefined) {
                        const workExperienceResponse = await axios.post(`http://localhost:8000/api/workexperiences`, store.getters.workExperience[i])
                        resData[i].id = workExperienceResponse.data.id
                        console.log(workExperienceResponse)
                    } else {
                        for(let j=0; j<workExperienceDataInDatabase.length; j++) {
                            if(workExperienceDataInDatabase[j].id === store.getters.workExperience[i]?.id) {
                                const workExperienceResponse = await axios.put(`http://localhost:8000/api/workexperiences/${store.getters.workExperience[i]?.id}`, store.getters.workExperience[i])
                                console.log(workExperienceResponse)
                                existWorkExperienceId.push(workExperienceDataInDatabase[j].id)
                            }
                        }
                    }
                }

                for(let k=0; k<workExperienceDataInDatabase.length; k++) {
                    if(existWorkExperienceId.includes(workExperienceDataInDatabase[k].id)) {
                        console.log(workExperienceDataInDatabase[k].id, ' is exist')
                    } else {
                        toDeleteWorkExperienceId.push(workExperienceDataInDatabase[k].id)
                    }
                }
                
                console.log(toDeleteWorkExperienceId);
                for(let l=0; l<toDeleteWorkExperienceId.length; l++) {
                    const deleteWorkExperience = await axios.delete(`http://localhost:8000/api/workexperiences/${toDeleteWorkExperienceId[l]}`)
                    console.log('delete success ', toDeleteHigherEducationId[l]);
                }

                store.commit('setWorkExperience', resData)
            }
        }
    }    
}

export default saveDraftForm;