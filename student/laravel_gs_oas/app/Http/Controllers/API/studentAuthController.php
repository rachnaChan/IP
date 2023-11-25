<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;


class studentAuthController extends Controller
{

    //change the password
    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {

            return response([
                'message' => 'Password not match'
            ]);
        }

        // Check if the new password is at least 8 characters long
        if (strlen($request->new_password) < 8) {
            return response([
                'message' => 'New password must be at least 8 characters long'
            ]);
        }

        try {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response([
                'message' => 'Password changed successfully',
                'new_password' => $request->new_password,
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'An error occurred while changing the password.',
                'error' => $e->getMessage(), // Include the specific error message for debugging
            ], 500); // 500 Internal Server Error status code indicates a server error
        }
    }

    //display user
    public function getUserIndi(Request $request)
    {
        return $request->user();
    }

    // display user with their programs, courses
    public function getUser(Request $request, string $id)
    {
        return User::where('student_id', $id)
            ->join('student_details', 'student_details.id', '=', 'users.student_id')
            ->join('programs', 'student_details.program_id', '=', 'programs.id')
            //     ->join('courses', 'student_details.program_id', '=', 'courses.program_id')
            ->join('courses', 'courses.program_id', '=', 'programs.id')

            ->select(
                'student_details.*',
                'users.*',
                'courses.*',
                'programs.*'
            )
            ->get();
    }

    //update user
    public function updateUser(Request $request)
    {
        $user = $request->user();

        // Define an array of fields that can be updated
        $updatableFields = ['first_name', 'last_name', 'username', 'phone_number', 'bio', 'dob'];

        // Check if any data has been modified
        $isProfileModified = false;

        foreach ($updatableFields as $field) {
            if ($request->has($field) && $request->$field !== $user->$field) {
                $isProfileModified = true;
                $user->$field = $request->$field;
            }
        }

        if ($request->hasFile('image')) {
            $isProfileModified = true;
            $path = $request->file('image')->store('uploads', 'public');
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->image = $path;
        }

        // If no data has been modified, return a response with a message
        if (!$isProfileModified) {
            return response()->json(['message' => 'No changes were made to your profile.']);
        }

        $user->save();

        return response()->json([
            'message' => 'User information updated successfully',
            'user' => $user, // Include the updated user data
        ]);
    }


    //display program which user enroll
    public function showPUser($id)
    {
        $program = Program::findOrFail($id);

        return response()->json($program);
    }

    //display all programs
    public function showPrograms()
    {
        $programs = Program::all();
        return response()->json($programs);
    }

    //display all courses in database not individual
    public function showCourses()
    {
        $course = Course::all();
        return response()->json($course);
    }

    //display all available courses belong to that program
    public function showCoursesP(string $programId)
    {

        $currentDate = Carbon::now(); // Get the current date and time

        // Find the course with the longest deadline for the given program
        $courseWithLongestDeadline = Course::where('program_id', $programId)
            ->where('deadline', '>=', $currentDate)
            ->orderBy('deadline', 'desc')
            ->first();

        // Get all courses for the given program
        $allCourses = Course::where('program_id', $programId)
            ->where('deadline', '>=', $currentDate)
            ->get();

        if (!$courseWithLongestDeadline) {
            return response()->json(['message' => 'No courses with deadlines found for the given program.']);
        }

        // Return the course with the longest deadline along with all other courses
        return response()->json([
            'course_with_longest_deadline' => $courseWithLongestDeadline,
            'all_courses' => $allCourses,
        ]);
    }

    //display all unavailable courses belong to that program
    public function showCoursesPUn(string $programId)
    {
        $currentDate = Carbon::now(); // Get the current date and time

        $courses = Course::where('program_id', $programId)
            ->where('deadline', '<', $currentDate) // Filter courses with deadlines after the current date
            ->get();

        return response()->json($courses);
    }

// View members in program
public function getInfoProStudent(String $id)
{
    // Fetch programs with student details for the head of the program
    $programs = Program::with(['studentDetail.user.enrollments.course'])
        ->where('id', $id)
        ->get();

    $studentDetailCount = 0; // Initialize the count of users

    foreach ($programs as $program) {
        $studentDetails = $program->studentDetail;
        $studentDetailCount += count($studentDetails); // Count studentDetail for each program

    }

    return response()->json([
        'programs' => $programs,
        'studentDetailCount' => $studentDetailCount,
    ]);
}


}
