<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ApplicantDetail;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplicantDetailController extends Controller
{
    /**
     * Display applicants according to their program that head log in as
     */
    public function index()
    {
        $loggedInUserId = Auth::id();

        $applicants = DB::table('applicant_details')
            ->join('programs', 'applicant_details.program_id', '=', 'programs.id')
            ->join('users', 'users.id', '=', 'programs.head_of_program_id')
            ->where('applicant_status', 'complete')
            ->where('users.id', $loggedInUserId)
            ->select('applicant_details.*')
            ->get();

        // Load the user relationship for the applicants
        $applicantsWithUser = ApplicantDetail::with('user')->whereIn('id', $applicants->pluck('id'))->get();

        return response()->json(['allApplicant' => $applicantsWithUser]);
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
        return ApplicantDetail::create([
            'applicant_status' => $request->applicant_status,
            'academic_year' => $request->academic_year,
            'program_id' => $request->program_id,
            'formal_personal_info_id' => $request->formal_personal_info_id,
            'current_contact_info_id' => $request->current_contact_info_id,
            'secondary_contact_info_id' => $request->secondary_contact_info_id,
            'educational_background_id' => $request->educational_background_id,
            'declaration' => $request->declaration,
        ]);
    }

    // head fetch update applicants
    public function updatedApplicant()
    {
        $applicant = DB::table('applicant_details')
            ->join('programs', 'applicant_details.program_id', '=', 'programs.id')
            ->join('users', 'users.id', '=', 'programs.head_of_program_id')
            ->join('feedbacks', 'applicant_details.id', '=', 'feedbacks.applicant_id')
            ->select('*')
            ->get();

        $applicantsWithUser = ApplicantDetail::with('user')->whereIn('id', $applicant->pluck('id'))->get();

        return response()->json(['updatedApplicant' => $applicantsWithUser]);
    }


    //head fetch pedning applicants
    public function pendingApplicant()
    {
        $loggedInUserId = Auth::id();

        $applicantsWithFeedback = Feedback::pluck('applicant_id')->all();

        $applicants = DB::table('applicant_details')
            ->join('programs', 'applicant_details.program_id', '=', 'programs.id')
            ->join('users', 'users.id', '=', 'programs.head_of_program_id')
            ->where('users.id', $loggedInUserId)
            ->whereNotIn('applicant_details.id', $applicantsWithFeedback)
            ->select('applicant_details.*')
            ->get();

        $applicantsWithUser = ApplicantDetail::with('user')->whereIn('id', $applicants->pluck('id'))->get();

        return response()->json(['pendingApplicant' => $applicantsWithUser]);
    }

    //head search for applicants 
    public function search($query)
    {
        $applicants = ApplicantDetail::where(function ($q) use ($query) {
            $q->where('applicant_status', 'like', "$query%")
                ->orwhere('id', '=', $query);
            // ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$query%");
        })

            //search based on user name
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('username', 'like', "%$query%")
                    ->orwhere('email', 'like', "%$query%")
                    ->orwhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$query%");
            })
            ->with('user')
            ->get();

        return response()->json($applicants);
    }

    //admin get all applicant submission 
    public function submittedApplicant(){
        $submitApplicant = ApplicantDetail::where('applicant_status', 'complete')
        ->with('user')
        ->get();
        return response()->json(['allApplicant' => $submitApplicant]);
    }

    //admin get all pending applicant submission
     //head fetch pedning applicants
     public function getPendingApplicant()
     {
         
         $applicantsWithFeedback = Feedback::pluck('applicant_id')->all();
 
         $applicants = DB::table('applicant_details')
             ->join('programs', 'applicant_details.program_id', '=', 'programs.id')
             ->join('users', 'users.id', '=', 'programs.head_of_program_id')
             ->whereNotIn('applicant_details.id', $applicantsWithFeedback)
             ->select('applicant_details.*')
             ->get();
 
         $applicantsWithUser = ApplicantDetail::with('user')->whereIn('id', $applicants->pluck('id'))->get();
 
         return response()->json(['pendingApplicant' => $applicantsWithUser]);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ApplicantDetail::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $applicantDetail = ApplicantDetail::find($id);
        $applicantDetail->update($request->all());
        return $applicantDetail;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ApplicantDetail::destroy($id);
    }
}
