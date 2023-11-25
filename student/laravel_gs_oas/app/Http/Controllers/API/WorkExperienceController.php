<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkExperience;
use Carbon\Carbon;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WorkExperience::all();
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
        $data = [
            'company_name' => $request->company_name,
            'position' => $request->position,
            'description' => $request->description,
            'applicant_id' => $request->applicant_id,
        ];

        if($request->date_to !== null && $request->date_to !== 'null') {
            $data["date_to"] = Carbon::parse($request->date_to)->format('Y-m-d');
        }

        if($request->date_from !== null && $request->date_from !== 'null') {
            $data["date_from"] = Carbon::parse($request->date_from)->format('Y-m-d');
        }

        return WorkExperience::create($data);
    }

    public function retrieveApplicant(string $id){

        return WorkExperience::where('applicant_id', $id)->get();
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return WorkExperience::find($id);
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
        $workExperience = WorkExperience::find($id);

        if ($request->date_from !== 'null' && $request->date_from !== null) {
            $workExperience->date_from = Carbon::parse($request->date_from)->format('Y-m-d');
        } else {
            $workExperience->date_from = null;
        }
        
        // Check if degree_end_date is not 'null' and not null
        if ($request->date_to !== 'null' && $request->date_to !== null) {
            $workExperience->date_to = Carbon::parse($request->date_to)->format('Y-m-d');
        } else {
            $workExperience->date_to = null;
        }

        // Update the other fields from the request
        $workExperience->update($request->except(['date_from', 'date_to']));

        return $workExperience;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return WorkExperience::destroy($id);
    }
}