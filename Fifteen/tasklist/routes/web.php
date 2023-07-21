<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function (){
//     return view('layouts.app');

// });
// Route::get('/task', function (Request $request){
//     return view('task');

// });

// Route::get('/', function () {
//     return view('tasks');
// });

Route::get('/', function(){
    $tasks = Task::orderBy('created_at','asc')->get();
    return view('task',[
        'tasks'=>$tasks
    ]);
    // return view('tasks');
});


Route::post('/task', function(Request $request) {

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task-> save();

    return redirect('/');

});

Route::delete('/task/{id}', function($id){
    Task::findOrFail($id)->delete();
    return redirect('/');
    // return view('tasks');
});

