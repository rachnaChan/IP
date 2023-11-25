<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Carbon\Carbon;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $path = '';

    // Check if the request has an image file
    if ($request->hasFile('image')) {
        // Store the image and get the path
        $path = $request->image->store('uploads', 'public');
    }

    // Create a new course record
    $course = Course::create([
        'name' => $request->name,
        'description' => $request->description,
        'schedule' => $request->schedule,
        'syllabus' => $request->syllabus,
        'image' => $path,
        'lecturer_id' => $request->lecturer_id,
        'credit' => $request->credit,
        'semester' => $request->semester,
        'deadline' => $request->deadline,
        'program_id' => $request->program_id ?: 15, // Default to 15 if program_id is null
    ]);

    // Return a success response with the newly created course data
    return response()->json(['success' => true, 'message' => 'New course created successfully', 'data' => $course]);
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Course::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $course = Course::find($id);
    //     $course->update($request->all());

    //     $path = '';
    //     if ($request->hasFile('image')) {
    //         $path = $request->image->store('uploads', 'public');
    //         $course->update(['image' => $path]);
    //     }

    //     return $course;
    // }
    public function update(Request $request, $id)
{
    // Find the course by ID
    $course = Course::find($id);

    // Check if the course exists
    if (!$course) {
        return response()->json(['error' => 'Course not found'], 404);
    }

    // Update the course with the request data
    $course->update($request->all());

    // Check if the request has an image file
    if ($request->hasFile('image')) {
        // Store the image and update the course's 'image' attribute
        $path = $request->image->store('uploads', 'public');
        $course->update(['image' => $path]);
    }

    // Return a success response with the updated course data
    return response()->json(['success' => true, 'message' => 'Course updated successfully', 'data' => $course]);
}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     return Course::destroy($id);
    // }
    public function destroy($id)
{
    // Attempt to find the course by ID
    $course = Course::find($id);

    // Check if the course exists
    if (!$course) {
        return response()->json(['error' => 'Course not found'], 404);
    }

    // Delete the course
    $deleted = Course::destroy($id);

    if ($deleted) {
        // Course deleted successfully
        return response()->json(['success' => true, 'message' => 'Course deleted successfully']);
    } else {
        // Failed to delete course
        return response()->json(['error' => 'Failed to delete course'], 500);
    }
}

}
