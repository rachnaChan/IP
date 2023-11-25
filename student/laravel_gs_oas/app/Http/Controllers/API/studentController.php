<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class studentController extends Controller
{

    //display user
    public function getUserIndi(Request $request)
    {
        return $request->user();
    }

    // display user with their programs, courses
    public function getUser(string $id)
    {
        return User::where('student_id', $id)
            ->join('student_details', 'student_details.id', '=', 'users.student_id')
            ->join('programs', 'student_details.program_id', '=', 'programs.id')
            ->join('courses', 'student_details.program_id', '=', 'courses.program_id')
            ->select(
                'student_details.*',
                'users.*',
                'courses.*',
                'programs.*',

            )
            ->get();
    }

    //update user
    public function updateUser(Request $request)
    {
        $user = $request->user();
        $user->update($request->all());

        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            $user->update(['image' => $path]);
        }

        return $user;
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


    //display all courses
    public function showCourses()
    {
        $course = Course::all();
        return response()->json($course);
    }


    //display all courses belong to that program
    public function showCoursesP(string $programId)
    {
        $courses = Course::where('program_id', $programId)
        ->get();
        return response()->json($courses);
    }


    //elective courses for 1 & 2 semester
    public function getElectiveCoursesBySemester( $programId, $semester)
{
     $semester = Str::title($semester);

     $electiveCourses = Course::where('program_id', $programId)
         ->where('syllabus', true)
         ->where('semester', $semester) // Add this condition to filter by semester
         ->get();

     // Separate elective courses by semester
     $firstSemesterCourses = $electiveCourses->filter(function ($course) use ($semester) {
         return $course->semester === '1';
     });

     $secondSemesterCourses = $electiveCourses->filter(function ($course) use ($semester) {
         return $course->semester === '2';
     });

     $response = [
         '1' => $firstSemesterCourses,
         '2' => $secondSemesterCourses,
     ];

     return response()->json(['elective_courses' => $response]);
}



    //enroll a course
    // public function enrollCourses(Request $request)
    // {
    //     // Get the logged-in student
    //     $student = Auth::user();

    //     // Get the selected course and its credits
    //     $course = Course::find($request->input('course_id'));

    //     $credits = $course->credit;

    //     // Check if the student has already enrolled in this course
    //     $existingEnrollment = Enrollment::where('student_id', $student->id)
    //         ->where('course_id', $course->id)
    //         ->first();

    //     if ($existingEnrollment) {
    //         return response()->json(['message' => 'You are already enrolled in this course.'], 400);
    //     }

    //     // Check if the student's total credits after enrolling won't exceed 20
    //     $totalCredits = $student->enrollments->sum('credit') + $credits;

    //     if ($totalCredits > 20) {
    //         return response()->json(['message' => 'You cannot exceed 20 credits.'], 400);
    //     }

    //     // Enroll the student in the course
    //     $enrollment = new Enrollment();
    //     $enrollment->enrollment_date = now(); // Use the current date
    //     $enrollment->student_id = $student->id;
    //     $enrollment->course_id = $course->id;
    //     $enrollment->grade = false; // Admin approval required
    //     $enrollment->save();

    //     return response()->json(['message' => 'Enrollment request sent.']);
    // }


    public function enrollCourses(Request $request)
{
    // Get the logged-in student
    $student = Auth::user();

    // Get the selected course ID from the array input
    $courseId = $request->input('course_id');

    // Check if the course ID is valid and exists
    $course = Course::find($courseId);

    if (!$course) {
        return response()->json(['message' => 'Invalid course ID.'], 400);
    }

    // Get the credits for the course
    $credits = $course->credit;

    // Check if the student has already enrolled in this course
    $existingEnrollment = Enrollment::where('student_id', $student->id)
        ->where('course_id', $course->id)
        ->first();

    if ($existingEnrollment) {
        return response()->json(['message' => 'You are already enrolled in this course.'], 400);
    }

    // Check if the student's total credits after enrolling won't exceed 20
    $totalCredits = $student->enrollments->sum('credit') + $credits;

    if ($totalCredits > 20) {
        return response()->json(['message' => 'You cannot exceed 20 credits.'], 400);
    }

    // Enroll the student in the course
    $enrollment = new Enrollment();
    $enrollment->enrollment_date = now(); // Use the current date
    $enrollment->student_id = $student->id;
    $enrollment->course_id = $course->id;
    $enrollment->grade = false; // Admin approval required
    $enrollment->save();

    return response()->json(['message' => 'Enrollment request sent.']);
}


    //list after enrolled and approved
    public function viewEnrolledCourses()
    {
        // Get the logged-in student
        $student = Auth::user();

        // Fetch enrolled courses for the current student
        $enrolledCourses = Enrollment::where('student_id', $student->id)
            ->where('grade', true) // Filter only approved enrollments
            ->with('course')
            ->get();

        return response()->json($enrolledCourses);
    }


    //head display then can approved
    public function listEnrolledStudents()
    {
        // Fetch students who have enrolled but not yet approved
        $enrolledStudents = User::whereHas('enrollments', function ($query) {
            $query->where('grade', false); // Filter for unapproved enrollments
        })->with(['enrollments' => function ($query) {
            $query->where('grade', false); // Include unapproved enrollments
        }])->get();

        return view('Head_Of_Program.enrolled-students', compact('enrolledStudents'));
    }
}
