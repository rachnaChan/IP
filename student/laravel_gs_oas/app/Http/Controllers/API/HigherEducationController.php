<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HigherEducation;
use Carbon\Carbon;

class HigherEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HigherEducation::all();
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
            'institution' => $request->institution,
            'province' => $request->province,
            'country' => $request->country,
            'major' => $request->major,
            'degree_obtained' => $request->degree_obtained,
            // 'degree_start_date' => Carbon::parse($request->degree_start_date)->format('Y-m-d'),
            // 'degree_end_date' => Carbon::parse($request->degree_end_date)->format('Y-m-d'),
            'applicant_id' => $request->applicant_id,
        ];

        if($request->degree_start_date !== null && $request->degree_start_date !== 'null') {
            $data["degree_start_date"] = Carbon::parse($request->degree_start_date)->format('Y-m-d');
        }

        if($request->degree_end_date !== null && $request->degree_end_date !== 'null') {
            $data["degree_end_date"] = Carbon::parse($request->degree_end_date)->format('Y-m-d');
        }

        return HigherEducation::create($data);
    }

    //search id that has applicant id
    public function retrieveApplicant(string $id){

        return HigherEducation::where('applicant_id', $id)->get();
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return HigherEducation::find($id);
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
        $higherEducation = HigherEducation::find($id);

        if ($request->degree_start_date !== 'null' && $request->degree_start_date !== null) {
            $higherEducation->degree_start_date = Carbon::parse($request->degree_start_date)->format('Y-m-d');
        } else {
            $higherEducation->degree_start_date = null;
        }
        
        // Check if degree_end_date is not 'null' and not null
        if ($request->degree_end_date !== 'null' && $request->degree_end_date !== null) {
            $higherEducation->degree_end_date = Carbon::parse($request->degree_end_date)->format('Y-m-d');
        } else {
            $higherEducation->degree_end_date = null;
        }

        // Update the other fields from the request
        $higherEducation->update($request->except(['degree_start_date', 'degree_end_date']));

        // return $request->degree_end_date;
        return $higherEducation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return HigherEducation::destroy($id);
    }
}