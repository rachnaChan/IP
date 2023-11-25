<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForeignLanguage;
use Carbon\Carbon;


class ForeignLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ForeignLanguage::all();
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
            'name' => $request->name,
            'certificate' => $request->certificate,
            'reading' => $request->reading,
            'writing' => $request->writing,
            'listening' => $request->listening,
            'speaking' => $request->speaking,
            'applicant_id' => $request->applicant_id,
        ];

        if($request->date_of_received !== null && $request->date_of_received !== 'null') {
            $data["date_of_received"] = Carbon::parse($request->date_of_received)->format('Y-m-d');
        }

        return ForeignLanguage::create($data);
    }

    //search id that has applicant id
    public function retrieveApplicant(string $id){

        return ForeignLanguage::where('applicant_id', $id)->get();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ForeignLanguage::find($id);
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
        $foreignLanguage = ForeignLanguage::find($id);

        if($request->date_of_received !== null && $request->date_of_received !== 'null') {
            $foreignLanguage['date_of_received'] = Carbon::parse($request->date_of_received)->format('Y-m-d');
            $foreignLanguage->update($request->all());
        } else {
            $foreignLanguage['date_of_received'] = null;
            $foreignLanguage->update($request->except('date_of_received'));
        }

        return $foreignLanguage;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ForeignLanguage::destroy($id);
    }
}
