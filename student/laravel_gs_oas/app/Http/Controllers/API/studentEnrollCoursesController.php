<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Notifications\EnrollApprovedNotification;
use App\Notifications\EnrollmentRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class studentEnrollCoursesController extends Controller
{

    //enroll a course
    public function enrollCourse(Request $request)
    {
        // Get the logged-in student
        $student = Auth::user();

        // check enrollment status
        $approvedEnrollments = $student->enrollments->where('status', Enrollment::STATUS_APPROVED);
        $rejectedEnrollments = $student->enrollments->where('status', Enrollment::STATUS_REJECTED);
        $pendingEnrollments = $student->enrollments->where('status', Enrollment::STATUS_PENDING);

        //check for pending enrollments
        if ($pendingEnrollments->isNotEmpty()) {
            return response()->json(['message' => 'Cannot Enroll Course Anymore!! Courses are still Pending!!'], 400);
        }
        
        // Get the selected course IDs and their credits from the form
        $courseIds = $request->input('course_ids'); // Assuming 'course_ids' is an array of selected course IDs
        $courses = Course::whereIn('id', $courseIds)->get();

        // Calculate the total credits of the selected courses
        $totalCredits = $courses->sum('credit');

        // If this is the first enrollment, enforce a credit limit of exactly 54
        if ($approvedEnrollments->isEmpty() && $rejectedEnrollments->isEmpty()) {
            $requiredCreditLimit = 54;

            // Check if the total credits are not equal to the required limit
            if ($totalCredits < $requiredCreditLimit) {
                return response()->json(
                    ['message' => 'Your first enrollment must consist of courses totaling at least '
                     . $requiredCreditLimit . ' credits.'], 400);
            }
        } else {
            // If this is not the first enrollment, check if the admin has rejected a course
            $adminRejectedCourseIds = $rejectedEnrollments->pluck('course_id')->toArray();

            // Check if any of the selected courses have been rejected by the admin
            $rejectedCourses = $courses->whereIn('id', $adminRejectedCourseIds);

            if ($rejectedCourses->isEmpty()) {
                $approvedCourses = $courses->whereIn('id', $approvedEnrollments->pluck('course_id')->toArray());
                if ($approvedCourses->isNotEmpty()) {
                    return response()->json(['message' => 'This Course has been Approved!!'], 400);
                }
            }
        }

        // Check if the student has already enrolled in any of the selected courses
        $existingEnrollments = Enrollment::where('student_id', $student->id)
            ->whereIn('course_id', $courseIds)
            ->get();

        if (!$existingEnrollments->isEmpty()) {
            $unapprovedEnrollments = $existingEnrollments->where('status', Enrollment::STATUS_REJECTED);

            if ($unapprovedEnrollments->isNotEmpty()) {
                return response()->json(['message' => 'This Course has been Rejected!!'], 400);
            }
        }


        // Enroll the student in the selected courses
        foreach ($courses as $course) {
            $enrollment = new Enrollment();
            $enrollment->enrollment_date = now(); // Use the current date
            $enrollment->student_id = $student->id;
            $enrollment->course_id = $course->id;
            $enrollment->status = Enrollment::STATUS_PENDING; // Admin approval required
            $enrollment->save();
        }
        return response()->json([
            'message' => 'Enrollment requests sent for selected courses.',
            'data'=> $courses,
    ]);
    }

    //list after enrolled
    public function viewCourseEnrollmentAll()
    {
        // Get the logged-in student
        $student = Auth::user();

        // Fetch enrolled courses for the current student
        $enrolledCourses = Enrollment::where('student_id', $student->id)
            ->with('course')
            ->get();

        $enrolledCourses->each(function ($enrollment) {
            switch ($enrollment->status) {
                case Enrollment::STATUS_APPROVED:
                    $enrollment->statusLabel = 'Approved';
                    break;
                case Enrollment::STATUS_REJECTED:
                    $enrollment->statusLabel = 'Rejected';
                    break;
                default:
                    $enrollment->statusLabel = 'Pending';
                    break;
            }
        });

        return response()->json($enrolledCourses);
    }

    //change status by head

    public function changeEnrollmentStatus(Request $request)
    {

         // Validate the request data
         $request->validate([
            'studentId' => 'required|integer',
            'courseId' => 'required|integer',
            'newStatus' => 'required|string|in:Approved,Rejected,Pending', // Add other valid status values here
        ]);

        // Retrieve the enrollment record to update
        $enrollment = Enrollment::where('student_id', $request->input('studentId'))
            ->where('course_id', $request->input('courseId'))
            ->first();

        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found'], 404);
        }

        // Update the enrollment status
        $enrollment->status = $request->input('newStatus');
        $enrollment->save();

        // Return a success response
        return response()->json(['success' => true]);
    }
}
