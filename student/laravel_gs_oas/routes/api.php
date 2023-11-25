<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\FormalPersonalInfoController;
use App\Http\Controllers\API\CurrentContactInfoController;
use App\Http\Controllers\API\SecondaryContactInfoController;
use App\Http\Controllers\API\EducationalBackgroundController;
use App\Http\Controllers\API\HigherEducationController;
use App\Http\Controllers\API\HeadController;
use App\Http\Controllers\API\WorkExperienceController;
use App\Http\Controllers\API\UploadDocumentController;
use App\Http\Controllers\API\ProgramController;
use App\Http\Controllers\API\ApplicantDetailController;
use App\Http\Controllers\API\studentAuthController;
use App\Http\Controllers\API\studentEnrollCoursesController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\EnrollmentController;
use App\Http\Controllers\API\studentEventNotification;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//public routee
Route::post('/register', [AuthController::class, 'register']);
Route::post('/registers', [studentAuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
// role table
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/{id}', [RoleController::class, 'show']);
// upload document
Route::post('/upload-document', [UploadDocumentController::class, 'uploadDocument']);
//list of programs
Route::get('head/program', [ProgramController::class, 'index']);
//list of courses
Route::get('head/courses', [CourseController::class, 'index']);

//private route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);


    //get the information of the applicant detail for a specfic applicant
    Route::get('/applicantdetails/{id}', [ApplicantDetailController::class, 'show']);

    // since method put is not working with form-data so i decide to use method post instead to update data
    Route::post('/users/{id}', [UserController::class, 'update']);

    //search for the row that has applicant_id in table higher edu that matches id in table applicant details
    Route::get('/highereducations/search/{id}', [HigherEducationController::class, 'retrieveApplicant']);
    Route::get('/highereducations', [HigherEducationController::class, 'index']);
    Route::get('/foreignlanguages/search/{id}', [ForeignLanguageController::class, 'retrieveApplicant']);
    Route::get('/workexperiences/search/{id}', [WorkExperienceController::class, 'retrieveApplicant']);

    // upload document
    Route::post('/upload-document', [UploadDocumentController::class, 'uploadDocument']);
    Route::get('/getdocuments',[UploadDocumentController::class, 'getDocuments']);
    Route::get('/uploaddocument/search/{id}', [UploadDocumentController::class, 'retrieveDocument']);
    Route::delete('/documents/{id}', [UploadDocumentController::class, 'destroy']);
});


//private route that only "APPLICANT" can access to
Route::group(['middleware' => ['auth:sanctum', 'role:1']], function () {
    Route::get('/formalpersonalinfos', [FormalPersonalInfoController::class, 'index']);
    Route::post('/formalpersonalinfos', [FormalPersonalInfoController::class, 'store']);
    Route::get('/formalpersonalinfos/{id}', [FormalPersonalInfoController::class, 'show']);
    Route::post('/formalpersonalinfos/{id}', [FormalPersonalInfoController::class, 'update']);
    Route::delete('/formalpersonalinfos/{id}', [FormalPersonalInfoController::class, 'destroy']);

    //current contact infos table
    Route::get('/currentcontactinfos', [CurrentContactInfoController::class, 'index']);
    Route::post('/currentcontactinfos', [CurrentContactInfoController::class, 'store']);
    Route::get('/currentcontactinfos/{id}', [CurrentContactInfoController::class, 'show']);
    Route::put('/currentcontactinfos/{id}', [CurrentContactInfoController::class, 'update']);
    Route::delete('/currentcontactinfos/{id}', [CurrentContactInfoController::class, 'destroy']);

    //secondary contact infos table
    Route::get('/secondarycontactinfos', [SecondaryContactInfoController::class, 'index']);
    Route::post('/secondarycontactinfos', [SecondaryContactInfoController::class, 'store']);
    Route::get('/secondarycontactinfos/{id}', [SecondaryContactInfoController::class, 'show']);
    Route::put('/secondarycontactinfos/{id}', [SecondaryContactInfoController::class, 'update']);
    Route::delete('/secondarycontactinfos/{id}', [SecondaryContactInfoController::class, 'destroy']);

    //educational backgrounds table
    Route::get('/educationalbackgrounds', [EducationalBackgroundController::class, 'index']);
    Route::post('/educationalbackgrounds', [EducationalBackgroundController::class, 'store']);
    Route::get('/educationalbackgrounds/{id}', [EducationalBackgroundController::class, 'show']);
    Route::put('/educationalbackgrounds/{id}', [EducationalBackgroundController::class, 'update']);
    Route::delete('/educationalbackgrounds/{id}', [EducationalBackgroundController::class, 'destroy']);

    //higher educations table
    // Route::get('/highereducations', [HigherEducationController::class, 'index']);
    Route::post('/highereducations', [HigherEducationController::class, 'store']);
    Route::get('/highereducations/{id}', [HigherEducationController::class, 'show']);
    Route::put('/highereducations/{id}', [HigherEducationController::class, 'update']);
    Route::delete('/highereducations/{id}', [HigherEducationController::class, 'destroy']);

    //foreign languages table
    Route::get('/foreignlanguages', [ForeignLanguageController::class, 'index']);
    Route::post('/foreignlanguages', [ForeignLanguageController::class, 'store']);
    Route::get('/foreignlanguages/{id}', [ForeignLanguageController::class, 'show']);
    Route::put('/foreignlanguages/{id}', [ForeignLanguageController::class, 'update']);
    Route::delete('/foreignlanguages/{id}', [ForeignLanguageController::class, 'destroy']);

    //work experiences table
    Route::get('/workexperiences', [WorkExperienceController::class, 'index']);
    Route::post('/workexperiences', [WorkExperienceController::class, 'store']);
    Route::get('/workexperiences/{id}', [WorkExperienceController::class, 'show']);
    Route::put('/workexperiences/{id}', [WorkExperienceController::class, 'update']);
    Route::delete('/workexperiences/{id}', [WorkExperienceController::class, 'destroy']);

    //applicant details table
    Route::post('/applicantdetails', [ApplicantDetailController::class, 'store']);
    Route::put('/applicantdetails/{id}', [ApplicantDetailController::class, 'update']);
    Route::delete('/applicantdetails/{id}', [ApplicantDetailController::class, 'destroy']);
});


//private route that only "HEAD OF PROGRAM" can access to
Route::group(['middleware'=> ['auth:sanctum','role:3']], function () {

    //get profile's info after login also update info
    Route::get('/head/info', [HeadController::class, 'getUserIndi']);
    Route::get('/head/info/{id}', [HeadController::class, 'getInfoHeadEnroll']);
    Route::post('/head/updateInfo', [HeadController::class, 'updateUser']);
    Route::post('/head/change-password', [HeadController::class, 'changePassword']);

    //
    Route::get('/head/infor/{id}', [HeadController::class, 'getInfoHeadEnroll2']);
    Route::get('/head/student_list/{id}', [HeadController::class, 'getUsersWithStudentDetails']);

    //show program
    Route::get('/head/program/{id}',[ProgramController::class, 'show']);

    //show all courses in program
    Route::get('/head/showProgram/{programId}/courses',[HeadAuthController::class,"showCoursesP"]);

    // Course routes
    Route::post('/head/courses', [CourseController::class, 'store']);
    Route::get('/head/courses/{id}', [CourseController::class, 'show']);
    Route::post('/head/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/head/courses/{id}', [CourseController::class, 'destroy']);

    //enrollment CRUD
    Route::post('/head/enrollments', [EnrollmentController::class, 'store']);
    Route::get('/head/enrollments/{id}', [EnrollmentController::class, 'show']);
    Route::put('/head/enrollments/{id}', [EnrollmentController::class, 'update']);
    Route::delete('/head/enrollments/{id}', [EnrollmentController::class, 'destroy']);

    //change status enrollment
    Route::post('/head/setEnrollment',[studentEnrollCoursesController::class, 'changeEnrollmentStatus']);

    // events  CRUD
    Route::post('/head/addEvent', [studentEventNotification::class, 'store']);
    Route::get('/head/getEvent',[studentEventNotification::class, 'index']);
    Route::post('head/updateEvent/{id}', [studentEventNotification::class, 'update']);
    Route::delete('head/deleteEvent/{id}', [studentEventNotification::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);

});


   //private route that only "ADMIN" can access to
Route::group(['middleware' => ['auth:sanctum', 'role:2']], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::get('/users/search/{query}', [UserController::class, 'search']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    //role table
    Route::post('/roles', [RoleController::class, 'store']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

    //program table
    Route::post('/programs', [ProgramController::class, 'store']);
    Route::get('/programs/{id}', [ProgramController::class, 'show']);
    // since method put is not working with form-data so i decide to use method post instead to update data
    Route::post('/programs/{id}', [ProgramController::class, 'update']);
    Route::delete('/programs/{id}', [ProgramController::class, 'destroy']);

    // get all the applicant detail (list)
    Route::get('/applicantdetails', [ApplicantDetailController::class, 'index']);
});





//private route that only "STUDENT" can access to
Route::group(['middleware' => ['auth:sanctum', 'role:4']], function () {

    //get profile's info after login also update info
    Route::get('/student/info', [studentAuthController::class, 'getUserIndi']);
    Route::get('/student/info/{id}', [studentAuthController::class, 'getUser']);
    Route::post('/student/updateInfo', [studentAuthController::class, 'updateUser']);
    Route::post('/student/change-password', [studentAuthController::class, 'changePassword']);

    //get program of user enroll
    Route::get("/student/program/{id}",[studentAuthController::class,"showPUser"]);

    //show all programs
    Route::get('/student/showProgram',[studentAuthController::class, 'showPrograms']);

    //show all courses
    Route::get('/student/showCourse',[studentAuthController::class, 'showCourses']);

    //show all courses in program
    Route::get('/student/showProgram/{programId}/courses',[studentAuthController::class,"showCoursesP"]);
    Route::get('/student/showProgram/{programId}/unavailableCourses',[studentAuthController::class,"showCoursesPUn"]);

   //enroll course
    Route::post('/student/enroll',[studentEnrollCoursesController::class, 'enrollCourse']);
    Route::get('/student/course_enrollment_all',[studentEnrollCoursesController::class, 'viewCourseEnrollmentAll']);

   //fetch files, update, delete documents
    Route::post('/student/uploadFile',[UploadDocumentController::class, 'uploadDocumentStudent']);
    Route::get('/student/getFile',[UploadDocumentController::class, 'getDocuments']);
    Route::post('/student/updateFile/{documentId}',[UploadDocumentController::class, 'updateDocument']);
    Route::delete('/student/deleteDoc/{filePath}',[UploadDocumentController::class, 'deleteDocument']);
    Route::post('/student/generateFile',[studentGenerateFile::class, 'generatePDF']);

    Route::get('/student/previewFile/upload/{documentId}',[UploadDocumentController::class, 'previewDocument']);

    //get event notification
    Route::get('/student/getEvent',[studentEventNotification::class, 'index']);

    //view members in program
    Route::get('/student/showMember/{id}',[studentAuthController::class, 'getInfoProStudent']);



   });
