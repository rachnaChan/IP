<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class HeadController extends Controller
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
                'message' => 'Password not match!!'
            ]);
        }

        try {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response([
                'message' => 'Password changed successfully'
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
        $user = $request->user();

        // // Check if the user is associated with a program
        // if ($user->id) {
        //     // Retrieve the user's program information
        //     $program = Program::where('head_of_program_id', $user->id)->first();

        //     return response()->json([
        //         'user' => $user,
        //         'program' => $program,
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => 'User does not have a program.',
        //     ], 404);
        // }

         return $request->user();


    }

    //update user
    public function updateUser(Request $request)
    {
        $user = $request->user();

        $oldImagePath = $user->image;

        $user->update($request->all());

        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            $user->update(['image' => $path]);

            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        return $user;
    }

    //get info of the enrollment only belong to the head's program which include student's info, courses's selected info

    public function getInfoHeadEnroll(String $id)
    {
        // Find the program(s) managed by the head user
        $programs = Program::where('head_of_program_id', $id)->pluck('id');

        // Retrieve information about the student, program, and courses
        $info = Enrollment::whereIn('course_id', function ($query) use ($programs) {
            $query->select('id')
                ->from('courses')
                ->whereIn('program_id', $programs);
        })
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users as students', 'enrollments.student_id', '=', 'students.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->select(
                'students.id as student_id',
                'students.email',
                'students.first_name',
                'students.last_name',
                'courses.id as course_id',
                'courses.name as course_name',
                'courses.semester as course_semester',
                'courses.credit as course_credit',
                'enrollments.status',
                'programs.id as program_id',
                'programs.name as program_name',
                'programs.description as program_description',
                'courses.program_id as cprogram_id',  // Retrieve program_id from courses
                'students.image',
                'students.dob',
                'students.phone_number',
                'students.gender',

            )
            ->orderBy('enrollments.id', 'desc')
            ->get();

        // Group data by student ID on the backend
        $groupedData = [];
        foreach ($info as $stu) {
            $studentId = $stu->student_id;

            if (!isset($groupedData[$studentId])) {
                $groupedData[$studentId] = [
                    'studentInfo' => [
                        'id' => $stu->student_id,
                        'email' => $stu->email,
                        'first_name' => $stu->first_name,
                        'last_name' => $stu->last_name,
                        'image' => $stu->image,
                        'gender' => $stu->gender,
                        'dob' => $stu->dob,
                        'phone_number' => $stu->phone_number,
                    ],
                    'programs' => [
                        'id' => $stu->program_id,
                        'name' => $stu->program_name,

                    ],
                    'courses' => [],
                    'enrollments' => [],
                ];
            }

            // Find the associated program for this student
            $program = $programs->where('id', $stu->program_id)->first();

            // Add the enrolled course information to the student's courses array
            $groupedData[$studentId]['courses'][] = [
                'name' => $stu->course_name,
                'id' => $stu->course_id,
                'semester' => $stu->course_semester,
                'credit' => $stu->course_credit,
                'status' => $stu->status,
            ];


            // Add the enrolled enrollment information to the student's enrollment array
            $groupedData[$studentId]['enrollments'][] = [
                'status' => $stu->status,
                'course_id' => $stu->course_id,
                'student_id' => $stu->student_id,
            ];
        }

        // Convert grouped data back to an array and return it
        return array_values($groupedData);
    }
    //get info of the enrollment only belong to head
    // public function getInfoHeadEnroll2(string $id)
    // {
    //     $programs = Program::select('*')->with([
    //         'studentDetail:program_id,id,unique_id',
    //     ])->where('head_of_program_id', $id)->get();
    //     $info=User::select('student_id')->with([
    //         'enrollments.*'
    //     ])->where('role_id',3)
    //     ->get();
    //     return $programs;
    // }
    public function getUsersWithStudentDetails(string $programId)
    {
    $programs = Program::with(['studentDetail.user.enrollments.course'])
            ->where('head_of_program_id', $programId)
            ->get();

        return $programs;
    }


    //display all courses belong to that program
    public function showCoursesP(string $programId)
    {
        $courses = Course::where('program_id', $programId)
            ->get();
        return response()->json($courses);
    }

}
 