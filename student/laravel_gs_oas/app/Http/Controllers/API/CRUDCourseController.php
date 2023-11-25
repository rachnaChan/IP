<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CRUDCourseController extends Controller
{
    //add course
    public function addCourse(Request $request)
    {

        $path = '';
        if ($request->hasFile('image')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path = $request->image->store('uploads', 'public');
        }

        return Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'program_id' => $request->program_id,
            'semester' => $request->semester,
            'credit' => $request->credit,
            'image' => $path,
        ]);
    }

    //get courses
    public function showCourses()
    {
        $course = Course::all();
        return response()->json($course);
    }

    //delete course
    public function deleteCourse($id)
    {
        return Course::destroy($id);
    }

    //delete course
    public function updateCourse(Request $request, string $id)
    {
        $program = Course::find($id);
        $program->update($request->all());

        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            $program->update(['image' => $path]);
        }

        return $program;
    }

    public function search($query)
    {
        $courses = Course::where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('program_id', '=', "$query")
                ->orwhere('semester', '=', $query);
        })

        //search based on role
        ->orWhereHas('programId', function ($q) use ($query){
            $q->where('program_id','like',"%$query%");
        })
        ->with('ProgramId')
        ->get();

        return response()->json($courses);
    }

}
