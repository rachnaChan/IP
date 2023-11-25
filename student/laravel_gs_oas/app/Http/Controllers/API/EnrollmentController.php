<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        return Enrollment::all();
    }

    public function store(Request $request)
    {
        // Validate and create a new enrollment
        $this->validate($request, [
            'enrollment_date' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        return Enrollment::create($request->all());
    }

    public function update(Request $request, $id)
    {
        // Validate and update the enrollment
        $this->validate($request, [
            'enrollment_date' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());

        return $enrollment;
    }

    public function show($id)
    {
        return Enrollment::find($id);
    }

    public function destroy($id)
    {
        Enrollment::destroy($id);

        return response()->json(['message' => 'Enrollment deleted'], 200);
    }
    

    
}
