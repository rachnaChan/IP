<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\UserController;

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

//private route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

//public route
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/bookDetail/{id}', [BookController::class, 'bookDetail']);
Route::get('/listallBook', [BookController::class, 'listBooks']);
Route::get('/listarrivalBooks', [BookController::class, 'listArrivalBooks']);
Route::get('/searchBook/{query}', [BookController::class, 'searchBook']);
Route::get('/previewBook/uploads/{bookId}', [BookController::class, 'previewBook']);
Route::get('/get_user', [UserController::class, 'get_users']);
Route::get('/get_event', [EventController::class, 'get_events_pub']);




//private route that only "Admin" can access to
Route::group(['middleware' => ['auth:sanctum', 'role:1']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/admin/info', [AuthenticationController::class, 'getUserIndi']);

    Route::post('/admin/uploadBook', [BookController::class, 'uploadBook']);
    Route::post('/admin/change_password', [AuthenticationController::class, 'changePassword']);
    Route::get('/admin/listallBook', [BookController::class, 'listBooks']);
    Route::post('/admin/updateBook/{id}', [BookController::class, 'updateBook']);
    Route::delete('/admin/deleteBook/{id}', [BookController::class, 'deleteBook']);
    Route::get('/admin/searchBook/{query}', [BookController::class, 'searchBook']);
    Route::get('/admin/previewBook/uploads/{bookId}', [BookController::class, 'previewBook']);
    Route::get('/admin/bookDetail/{id}', [BookController::class, 'bookDetail']);


    //event
    Route::post('/admin/create_event', [EventController::class, 'create_event']);
    Route::get('/admin/get_event', [EventController::class, 'get_events']);
    Route::post('/admin/update_event/{id}',[EventController::class, 'update_event']);
    Route::delete('/admin/delete_event/{id}',[EventController::class, 'delete_event']);
    Route::get('/admin/searchEvent/{query}', [EventController::class, 'searchEvent']);

    //staff
    Route::post('/admin/register', [AuthenticationController::class, 'register']);
    Route::post('/admin/update_user/{id}', [UserController::class, 'update_user']);
    Route::get('/admin/get_user', [UserController::class, 'get_users']);
    Route::get('/admin/delete_user/{id}', [UserController::class, 'deleteUser']);
    Route::get('/admin/searchUser/{query}', [UserController::class, 'searchUser']);
    Route::get('/admin/user/Detail/{id}', [UserController::class, 'userDetail']);




});

